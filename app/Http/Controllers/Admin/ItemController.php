<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Type;
use App\Models\Unit;
use Illuminate\Http\Request;
use Validator;

class ItemController extends Controller
{
    
    public function index()
    {
        $items = Item::orderBy('title','asc')->get();
        $types = Type::orderBy('title','asc')->get();
        $units = Unit::orderBy('title','asc')->get();
        return view('admin.items.items', compact('items','types','units'));
    }
    public function inventories()
    {
        $items = Item::orderBy('title','asc')->get();
        return view('admin.inventories.inventories', compact('items'));
    }
    

   
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        $validated =  Validator::make($request->all(), [
            'title' => ['required'],
            'type_id' => ['required'],
            'price' => ['required' ,'numeric','min:0'],
            'unit_id' => ['required'],
            'description' => ['nullable'],
           
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        Item::create([
            'title' => $request->input('title'),
            'type_id' => $request->input('type_id'),
            'price' => $request->input('price'),
            'unit_id' => $request->input('unit_id'),
            'description' => $request->input('description'),
        ]);

        return response()->json(['success' => 'Item Added Successfully.']);
    }
   
    public function edit(Item $item)
    {
        if (request()->ajax()) {
            return response()->json(['result' => $item]);
        }
    }

    
    public function update(Request $request, Item $item)
    {
        $validated =  Validator::make($request->all(), [
            'title' => ['required'],
            'type_id' => ['required'],
            'price' => ['required' ,'numeric','min:0'],
            'unit_id' => ['required'],
            'description' => ['nullable'],
           
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        $item->update([
            'title' => $request->input('title'),
            'type_id' => $request->input('type_id'),
            'price' => $request->input('price'),
            'unit_id' => $request->input('unit_id'),
            'description' => $request->input('description'),
        ]);

        return response()->json(['success' => 'Item Updated Successfully.']);
    }
    
    public function destroy(Item $item)
    {
        $item->delete();
        return response()->json(['success' => 'Item Removed Successfully.']);
    }
    //MANAGE TYPES AND UNITS

    public function manage_index($manage_type)
    {
        if($manage_type == 'types'){
            $manages = Type::orderBy('title','asc')->get();
        }else{
            $manages = Unit::orderBy('title','asc')->get();
        }
        return view('admin.items.manage_types_units', compact('manages','manage_type'));
    }
    public function manage_update(Request $request, $manage_type)
    {
        $validated =  Validator::make($request->all(), [
            'title' => ['required'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        if($manage_type == 'types'){
            Type::updateOrCreate(
                [
                    'id'               => $request->input('id') ?? '0',
                ],
                [
                    'title'               => $request->input('title'),
                ]
            );
        }else{
            Unit::updateOrCreate(
                [
                    'id'               => $request->input('id') ?? '0',
                ],
                [
                    'title'               => $request->input('title'),
                ]
            );
        }
         return response()->json(['success' => 'Successfully Updated.']);
    }

    public function manage_edit($manage_type,$id)
    {
        if($manage_type == 'types'){
            $manages = Type::where('id',$id)->first();
            return response()->json(['result' => $manages]);
        }else{
            $manages = Unit::where('id',$id)->first();
            return response()->json(['result' => $manages]);
        }
    }
    public function manage_destroy($manage_type,$id)
    {
        if($manage_type == 'types'){
            $manages = Type::where('id',$id)->first();
            $manages->delete();
        }else{
            $manages = Unit::where('id',$id)->first();
            $manages->delete();
        }
       
        return response()->json(['success' => 'Removed Successfully.']);
    }

    


    
    
}
