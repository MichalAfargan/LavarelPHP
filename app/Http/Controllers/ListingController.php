<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{   //show all listings
    public function index(){
        // dd(request('tag'));
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
                
        ]);

    }
    //show one listing
    public function show(Listing $listing){
        return view('listings.show',[
            'listing' => $listing
    
        ]);

    }

    //show creat form
    public function create(){
        return view('listings.create');
    }

    // Store Listing Data
    public function store(Request $request) {
        // dd(auth()->id());
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
            
        ]);
        if($request->hasfile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos','public');
        }

        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);

        return redirect(('/'))->with('message', 'Listing created successfully!');
    }

  //Show Edit Form
  public function edit(Listing $listing) {
    // dd($listing->title);
    return view('listings.edit', ['listing' => $listing]);
  }

      // Update Listing Data
      public function update(Request $request, Listing $listing) {

        //make shure logged in user is oner
        if($listing->user_id != auth()->id()){
            abort(403,'Unauthorized Action');
        }

        // dd($request->file('logo'));
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);
        if($request->hasfile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos','public');
        }

        $listing->update($formFields);

        return back()->with('message', 'Listing updated successfully!');
    }
    //Delete listing
    public function destroy(Listing $listing){
        //make shure logged in user is oner
        if($listing->user_id != auth()->id()){
            abort(403,'Unauthorized Action');
        }
        // dd($listing);
        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully!');

    }

    //manage listing
    public function manage(){
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }


}
