<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{

    //show all listings
    public function index(){
        return view('listings.index',[
            'listings'=>Listing::latest()->filter(request(['tag','search']))->paginate(4)
         ]);
    }

    //show single listing
    public function show(Listing $listing){
        return view ('listings.show', [
            'listing'=>$listing
        ]); 
    }

    //show create form
    public function create(Listing $listing){
        return view('listings.create');
    }

    //store listing data
    public function store(Request $request){
        $formFields = $request->validate([
            'title'=> 'required',
            'company'=> ['required', Rule::unique('listings', 'company')],
            'location'=> 'required',
            'website'=> 'required',
            'email'=> ['required', 'email'],
            'tags'=> 'required',
            'description' => 'required'
        ]);

        if ($request->hasFile('logo')) {
            # code...
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        Listing::create($formFields);

       // Session::flash('message', 'Listing Created');

        return redirect('/')->with('message', 'Listing created successfully!');
    }

    //show Edit form
    public function edit(Listing $listing){
        return view('listings.edit', ['listing' => $listing]);
    }
}
