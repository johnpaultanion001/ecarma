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
      $total_buying = Buying::latest()->get();
      $total_selling = Selling::latest()->get();
      return view('admin.dashboard', compact('total_items','total_buying','total_selling'));
    }
}
