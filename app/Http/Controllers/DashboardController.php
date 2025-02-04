<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prize;

class DashboardController extends Controller
{
    public function index(){
        $data = Prize::get();
        return view('dashboard',compact('data'));
    }
}
