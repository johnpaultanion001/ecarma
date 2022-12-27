<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Buying;
use App\Models\Selling;

class DashboardController extends Controller
{
    public function dashboard(){
      $total_items = Item::latest()->count();
      $total_buying = Buying::latest()->where('status','APPROVED')->get();
      $total_selling = Selling::latest()->where('status','APPROVED')->get();

      $buying_record = Buying::select(
        \DB::raw("SUM(amount) as amount"),
        \DB::raw("DAY(created_at) as day"),
        \DB::raw("DAYNAME(created_at) as day_name"),
        \DB::raw("DATE_FORMAT(created_at, '%m-%Y-%d') new_date"))
        ->where('status' , 'APPROVED')
        ->groupBy('day_name','day')
        ->orderBy('day')
        ->get();

      $selling_record = Selling::select(
        \DB::raw("SUM(amount) as amount"),
        \DB::raw("DAY(created_at) as day"),
        \DB::raw("DAYNAME(created_at) as day_name"),
        \DB::raw("DATE_FORMAT(created_at, '%m-%Y-%d') new_date"))
        ->where('status' , 'APPROVED')
        ->groupBy('day_name','day')
        ->orderBy('day')
        ->get();

      $buying_data = [];
      $selling_data = [];

      foreach($buying_record as $row) {
        $buying_data['label'][] = $row->new_date;
        $buying_data['data'][] =  $row->amount;
      }

      foreach($selling_record as $row) {
        $selling_data['label'][] = $row->new_date;
        $selling_data['data'][] =  $row->amount;
      }

    $buying = json_encode($buying_data);
    $selling = json_encode($selling_data);

      return view('admin.dashboard', compact('total_items','total_buying','total_selling','buying','selling'));
    }
}
