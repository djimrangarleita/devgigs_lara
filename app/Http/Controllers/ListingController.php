<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index(Request $request)
    {
        return view('listings.index', [
            "listings" => Listing::latest()->filter($request->query)->get()
        ]);
    }

    public function show(Listing $job)
    {
        return view('listings.show', [
            "job" => $job
        ]);
    }
}
