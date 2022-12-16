<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Selling;
use App\Models\Buyer;
use App\Models\Item;
use App\Models\Transaction;
use Validator;
use Illuminate\Http\Request;

class SellingController extends Controller
{
  
    public function index($transaction_id)
    {
        $buyers = Buyer::orderBy('name','asc')->where('isRemove', false)->where('status', 'active')->get();
        $items = Item::where('stock', '>', '0')->orderBy('title','asc')->get();
        if($transaction_id == 0){
            $sellings = Selling::where('status','PENDING')->latest()->get();
        }else{
            $sellings = Selling::where('status','APPROVED')->where('transaction_id',$transaction_id)->latest()->get();
        }
        return view('admin.sellings.sellings', compact('sellings','buyers','items','transaction_id'));
        
    }

    public function income()
    {
     
        $sellings = Selling::where('status','APPROVED')->latest()->get();
        
        return view('admin.sellings.income', compact('sellings'));
        
    }

    public function store(Request $request)
    {
        $validated =  Validator::make($request->all(), [
            'item_id' => ['required'],
            'buyer_id' => ['required'],
            'qty' => ['required' ,'numeric','min:0'],
           
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }
        $item = Item::where('id', $request->input('item_id'))->first();
        $amount = $request->input('qty') * $item->price;
        Selling::create([
            'item_id' => $request->input('item_id'),
            'buyer_id' => $request->input('buyer_id'),
            'qty' => $request->input('qty'),
            'price'  => $item->price,
            'amount'    => $amount,
        ]);

        return response()->json(['success' => 'Added Successfully.']);
    }

    public function edit(Selling $selling)
    {
        if (request()->ajax()) {
            return response()->json(['result' => $selling]);
        }
    }
    public function update(Request $request,Selling $selling)
    {
        $validated =  Validator::make($request->all(), [
            'item_id' => ['required'],
            'seller_id' => ['required'],
            'qty' => ['required' ,'numeric','min:0'],
           
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }
        $item = Item::where('id', $request->input('item_id'))->first();
        $amount = $request->input('qty') * $item->price;
        $selling->update([
            'item_id' => $request->input('item_id'),
            'seller_id' => $request->input('seller_id'),
            'qty' => $request->input('qty'),
            'price'  => $item->price,
            'amount'    => $amount,
        ]);

        return response()->json(['success' => 'Updated Successfully.']);
    }

    public function destroy(Selling $selling)
    {
       
        $selling->delete();
        return response()->json(['success' => 'Removed Successfully.']);
    }


    public function saveTransaction()
    {
        $transaction = Transaction::create([
            'type_of_transaction' => 'SELLING',
        ]);

        $selling = Selling::where('status','PENDING')->get();

        foreach($selling as $buy){
            Item::where('id', $buy->item_id)->decrement('stock', $buy->qty);
        }
           
       $selling = Selling::where('status','PENDING')->update([
        'transaction_id' => $transaction->id,
        'status'    => "APPROVED",
       ]);



       
        return response()->json(['success' => 'Transaction successfully saved.']);
    }
}
