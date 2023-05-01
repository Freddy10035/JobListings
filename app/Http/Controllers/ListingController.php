<?php

namespace App\Http\Controllers;

use auth;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Session\Session;

class ListingController extends Controller
{

    //show all listings
    public function index()
    {
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(4)
        ]);
    }

    //show single listing
    public function show(Listing $listing)
    {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    //show create form
    public function create(Listing $listing)
    {
        return view('listings.create');
    }

    //store listing data
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if ($request->hasFile('logo')) {
            # code...
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);

        // Session::flash('message', 'Listing Created');

        return redirect('/')->with('message', 'Listing created successfully!');
    }

    //show Edit form
    public function edit(Listing $listing)
    {
        return view('listings.edit', ['listing' => $listing]);
    }

    //update listing data
    public function update(Request $request, Listing $listing)
    {

        //Make sure the logged in user is owner
        if ($listing->user_id != auth()->id()) {
            abort(403, 'unauthorized action');
        }


        $formFields = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);

        // Session::flash('message', 'Listing Created');

        return back()->with('message', 'Listing updated successfully!');
    }

    //Delete Listing
    public function destroy(Listing $listing)
    {
        //Make sure the logged in user is owner
        if ($listing->user_id != auth()->id()) {
            abort(403, 'unauthorized action');
        }

        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully');
    }

    //Manage Listings

    public function manage()
    {
        //NOT SuRE HOW THE FIRST ONE GETS AN ERROR
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}