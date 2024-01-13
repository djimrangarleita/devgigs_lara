<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ListingController extends Controller
{
    public function index(Request $request): View
    {
        return view('listings.index', [
            "listings" => Listing::latest()
                ->filter($request->query)
                ->paginate(6)
        ]);
    }

    public function show(Listing $job): View
    {
        return view('listings.show', [
            "job" => $job
        ]);
    }

    public function create(): View
    {
        return view('listings.create');
    }

    public function save(Request $request): RedirectResponse
    {
        $formData = $this->validateForm($request, ['company' => Rule::unique('listings', 'company')]);
        // TODO: Validate the file first
        if ($request->hasFile('logo')) {
            $formData['logo'] = $request->file('logo')->store('logos', 'public');
        }
        $formData['user_id'] = auth()->id();

        Listing::create($formData);

        return redirect('/')->with('success', 'Listing successfully created!');
    }

    public function edit(Listing $job): View
    {
        if ($job->user_id !== auth()->id()) abort(403, 'Unauthorized');

        return view('listings.edit', [
            'job' => $job,
        ]);
    }

    public function update(Request $request, Listing $job): RedirectResponse
    {
        if ($job->user_id !== auth()->id()) abort(403, 'Unauthorized');

        $formData = $this->validateForm($request);

        if ($request->hasFile('logo')) {
            $this->removeFile($job);
            $formData['logo'] = $request->file('logo')->store('logos', 'public');
        }
        $job->update($formData);

        return redirect("/jobs/$job->id")
            ->with(
                'success',
                "$job->title has been updated successfuly"
            );
    }

    public function destroy(Listing $job): RedirectResponse
    {
        if ($job->user_id !== auth()->id()) abort(403, 'Unauthorized');

        $title = $job->title;
        $this->removeFile($job);
        $job->delete();

        return redirect('/')->with('success', "$title deleted successfuly");
    }

    public function manage()
    {
        return view('listings.manage', [
            'listings' => auth()->user()->listings()->latest()->paginate(10),
        ]);
    }

    public function validateForm(Request $request, array $extra = []): array
    {
        return $request->validate([
            'title' => ['required'],
            'company' => ['required', $extra['company'] ?? ''],
            'email' => ['required', 'email'],
            'location' => ['required'],
            'tags' => ['required'],
            'description' => ['required'],
            'website' => ['url'],
        ]);
    }

    public function removeFile(Listing $job): bool
    {
        // TODO: Remove the file associated with job from folder
        return true;
    }
}
