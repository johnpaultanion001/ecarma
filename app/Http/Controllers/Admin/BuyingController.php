<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buying;
use Illuminate\Http\Request;
use App\Models\Seller;
use App\Models\Item;
use App\Models\Transaction;
use Validator;


class BuyingController extends Controller
{
  
    public function index($transaction_id)
    {
        $sellers = Seller::orderBy('name','asc')->where('isRemove', false)->where('status', 'active')->get();
        $items = Item::orderBy('title','asc')->get();
        if($transaction_id == 0){
            $buyings = Buying::where('status','PENDING')->latest()->get();
        }else{
            $buyings = Buying::where('status','APPROVED')->where('transaction_id',$transaction_id)->latest()->get();
        }
        return view('admin.buyings.buyings', compact('buyings','sellers','items','transaction_id'));
        
    }

    public function expenses($filter, $df, $dt)
    {
        if($filter == 'fbd'){
            $buyings = Buying::where('status','APPROVED')->whereBetween('created_at', [$df, $dt])->latest()->get();
        }else{
            $buyings = Buying::where('status','APPROVED')->latest()->get();
        }
        
        return view('admin.buyings.expenses', compact('buyings','df','dt'));
        
    }

    

    public function store(Request $request)
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
        $amount = $request->input('qty') * $item->buying_price;
        Buying::create([
            'item_id' => $request->input('item_id'),
            'seller_id' => $request->input('seller_id'),
            'qty' => $request->input('qty'),
            'price'  => $item->buying_price,
            'amount'    => $amount,
        ]);

        return response()->json(['success' => 'Added Successfully.']);
    }

    public function edit(Buying $buying)
    {
        if (request()->ajax()) {
            return response()->json(['result' => $buying]);
        }
    }
    public function update(Request $request,Buying $buying )
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
        $amount = $request->input('qty') * $item->buying_price;
        $buying->update([
            'item_id' => $request->input('item_id'),
            'seller_id' => $request->input('seller_id'),
            'qty' => $request->input('qty'),
            'price'  => $item->buying_price,
            'amount'    => $amount,
        ]);

        return response()->json(['success' => 'Updated Successfully.']);
    }

    public function destroy(Buying $buying )
    {
       
        $buying->delete();
        return response()->json(['success' => 'Removed Successfully.']);
    }


    public function saveTransaction()
    {
        $transaction = Transaction::create([
            'type_of_transaction' => 'BUYING',
        ]);

        $buyings = Buying::where('status','PENDING')->get();

        foreach($buyings as $buy){
            Item::where('id', $buy->item_id)->increment('stock', $buy->qty);
        }
           
       $buyings = Buying::where('status','PENDING')->update([
        'transaction_id' => $transaction->id,
        'status'    => "APPROVED",
       ]);



       
        return response()->json(['success' => 'Transaction successfully saved.']);
    }
    

  
}
