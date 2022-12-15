<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buyer;
use Illuminate\Http\Request;
use Validator;

class BuyerController extends Controller
{
    public function index()
    {
        $buyers = Buyer::orderBy('name','asc')->where('isRemove', false)->get();
        return view('admin.buyers.buyers', compact('buyers'));
    }

   
    public function store(Request $request)
    {
        $validated =  Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required'],
            'contact_number' => ['required' ,'numeric'],
            'location' => ['required'],
            
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        Buyer::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'contact_number' => $request->input('contact_number'),
            'location' => $request->input('location'),
            'status'    => $request->input('status'),
        ]);

        return response()->json(['success' => 'Added Successfully.']);
    }
   
    public function edit(Buyer $buyer)
    {
        if (request()->ajax()) {
            return response()->json(['result' => $buyer]);
        }
    }

    
    public function update(Request $request, Buyer $buyer)
    {
        $validated =  Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required'],
            'contact_number' => ['required' ,'numeric'],
            'location' => ['required'],
            
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        $buyer->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'contact_number' => $request->input('contact_number'),
            'location' => $request->input('location'),
            'status'    => $request->input('status'),
        ]);

        return response()->json(['success' => 'Updated Successfully.']);
    }
    
    public function destroy(Buyer $buyer)
    {
        $buyer->update([
            'isRemove' => true,
        ]);
        return response()->json(['success' => 'Removed Successfully.']);
    }
}
