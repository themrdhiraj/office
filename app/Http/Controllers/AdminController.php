<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departments;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $data = array(
            'nav' => 'dashboard'
        );
        return view('admin.dashboard')->with($data);
    }

    public function settings()
    {
        $data = array(
            'nav' => 'settings',
            'act' => 'Add',
            'departments' => Departments::paginate(5)
        );
        return view('admin.settings')->with($data);
    }
}
