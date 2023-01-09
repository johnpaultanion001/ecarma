<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Item;
use App\Models\Type;
use App\Models\Selling;
use App\Models\Buying;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::latest()->get();
        return view('admin.transactions.transactions', compact('transactions'));
        
    }
    public function void(Transaction $transaction)
    {
        if($transaction->type_of_transaction == 'BUYING'){
            foreach($transaction->buyings()->get() as $buy){
                Item::where('id', $buy->item_id)->decrement('stock', $buy->qty);
                $buy->delete();
            }
            
        }else{
            foreach($transaction->sellings()->get() as $buy){
                Item::where('id', $buy->item_id)->increment('stock', $buy->qty);
                $buy->delete();
            }
        }
        $transaction->delete();
        
        
       
        return response()->json(['success' => 'Transaction successfully void.']);
        
    }

    public function net_profit($filter, $df, $dt, $type){
        if($filter == 'fbd'){
            if($type == 'all'){
                $buying = Buying::where('status','APPROVED')->sum('amount');
                $selling = Selling::where('status','APPROVED')->sum('amount');
            }else{
                $buying = Buying::where('type_id', $type)->where('status','APPROVED')->whereBetween('created_at', [$df, $dt])->sum('amount');
                $selling = Selling::where('type_id', $type)->where('status','APPROVED')->whereBetween('created_at', [$df, $dt])->sum('amount');
            }
            
        }else{
            if($type == 'all'){
                $buying = Buying::where('status','APPROVED')->sum('amount');
                $selling = Selling::where('status','APPROVED')->sum('amount');
            }else{
                $buying = Buying::where('type_id', $type)->where('status','APPROVED')->whereBetween('created_at', [$df, $dt])->sum('amount');
                $selling = Selling::where('type_id', $type)->where('status','APPROVED')->whereBetween('created_at', [$df, $dt])->sum('amount');
            }
        }
        $total = $selling - $buying;
        $types = Type::orderBy('title','asc')->get();
        $item_type = Type::where('id',$type)->first();

        return view('admin.net_profit.net_profit', compact('buying','selling', 'total', 'df','dt','types','item_type'));

    }
    
}
