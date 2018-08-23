<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * @author maoyingming
     * @description: 首页
     */
    public function index(){
        return view('admin.index');
    }
}
