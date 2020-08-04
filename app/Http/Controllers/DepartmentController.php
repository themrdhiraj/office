<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departments;

class DepartmentController extends Controller
{
    public function index($id)
    {
        $data = array(
            'nav' => 'settings',
            'act' => 'Update',
            'department' => Departments::find($id)
        );
        return view('admin.settings')->with($data);

    }

    public function store(Request $request)
    {
        $department = Departments::create([
            'depName' => $request->input('depName'),
            'addedBy' => auth()->user()->id
        ]);

        if($department){
            return back()->with('success', 'Department successfully added!');
        }else{
            return back()->with('error', 'Sorry, There was a problem!');
        }
    }
    public function update(Request $request, $id)
    {
        $department = Departments::where('id', $id)->update([
            'depName' => $request->input('depName'),
            'depStatus' => $request->input('depStatus'),
            'addedBy' => auth()->user()->id
        ]);

        if($department){
            return redirect('/adminSettings')->with('success', 'Department successfully updated!');
        }else{
            return back()->with('error', 'Sorry, There was a problem!');
        }
    }

    public function delete($id)
    {
        $department = Departments::where('id', $id)->delete();

        if($department){
            return back()->with('success', 'Department deleted!');
        }else{
            return back()->with('error', 'Sorry, There was a problem!');
        }

    }
}