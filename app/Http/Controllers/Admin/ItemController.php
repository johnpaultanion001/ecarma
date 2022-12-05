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

    public function manage($manage)
    {
        if($manage == 'types'){
            $types = Type::orderBy('title','asc')->get();
            return response()->json(['results' => $types]);
        }else{
            $units = Unit::orderBy('title','asc')->get();
            return response()->json(['results' => $units]);
        }
    }
    public function manage_update(Request $request, $manage)
    {
        if($manage == 'types'){
            Type::whereNotIn('title', $request->input('title'))->delete();
            foreach($request->input('title') as $title )
            {
               Type::updateOrCreate(
                            [
                                'title'               => $title,
                            ],
                            [
                                'title'               => $title,
                            ]
                        );
            }
        }else{
            Unit::whereNotIn('title', $request->input('title'))->delete();
            foreach($request->input('title') as $title )
            {
                Unit::updateOrCreate(
                    [
                        'title'               => $title,
                    ],
                    [
                        'title'               => $title,
                    ]
                );
            }
        }
         return response()->json(['success' => 'Successfully Updated.']);
    }


    
    
}
