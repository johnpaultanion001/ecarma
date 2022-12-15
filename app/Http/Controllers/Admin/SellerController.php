<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\Request;
use Validator;

class SellerController extends Controller
{
    public function index()
    {
        $sellers = Seller::orderBy('name','asc')->where('isRemove', false)->get();
        return view('admin.sellers.sellers', compact('sellers'));
    }

   
    public function store(Request $request)
    {
        $validated =  Validator::make($request->all(), [
            'name' => ['required'],
            'contact_number' => ['required' ,'numeric'],
            'location' => ['required'],
            
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        Seller::create([
            'name' => $request->input('name'),
            'contact_number' => $request->input('contact_number'),
            'location' => $request->input('location'),
            'status'    => $request->input('status'),
        ]);

        return response()->json(['success' => 'Added Successfully.']);
    }
   
    public function edit(Seller $seller)
    {
        if (request()->ajax()) {
            return response()->json(['result' => $seller]);
        }
    }

    
    public function update(Request $request, Seller $seller)
    {
        $validated =  Validator::make($request->all(), [
            'name' => ['required'],
            'contact_number' => ['required' ,'numeric'],
            'location' => ['required'],
            
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        $seller->update([
            'name' => $request->input('name'),
            'contact_number' => $request->input('contact_number'),
            'location' => $request->input('location'),
            'status'    => $request->input('status'),
        ]);

        return response()->json(['success' => 'Updated Successfully.']);
    }
    
    public function destroy(Seller $seller)
    {
        $seller->update([
            'isRemove' => true,
        ]);
        return response()->json(['success' => 'Removed Successfully.']);
    }
}
