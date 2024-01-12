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
            "listings" => Listing::latest()->filter($request->query)->paginate(2)
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
        $formData = $request->validate([
            'title' => ['required'],
            'company' => ['required', Rule::unique('listings', 'company')],
            'email' => ['required', 'email'],
            'location' => ['required'],
            'tags' => ['required'],
            'description' => ['required'],
            'website' => ['url'],
        ]);
        // TODO: Validate the file first
        if ($request->hasFile('logo')) {
            $formData['logo'] = $request->file('logo')->store('logos', 'public');
        }

        Listing::create($formData);

        return redirect('/')->with('success', 'Listing successfully created!');
    }
}
