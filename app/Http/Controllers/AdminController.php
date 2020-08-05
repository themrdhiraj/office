<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departments;
use App\Employees;

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

    //Employees
    public function viewEmp()
    {
        $data = array(
            'employees' => Employees::paginate(5)
        );
        return view('admin.employee.viewEmp')->with($data);
    }

    public function addEmp()
    {
        $data = array(
            'act' => 'Add',
            'employee' => null
        );
        return view('admin.employee.storeEmp')->with($data);
    }

    public function editEmp($id)
    {
       $data = array(
            'act' => 'Update',
            'employee' => Employees::find($id)
        );
        return view('admin.employee.storeEmp')->with($data);
    }

    public function storeEmp(Request $request)
    {
        $act = $request->input('act');
        $id = $request->input('id');

        $validatedData = $request->validate([
        'empName' => 'required',
        'empEmail' => 'required|unique:employees',
        'empAddress' => 'required',
        'empContact' => 'required',
        ]);

        if ($act == 'Add') {
            $employee = Employees::create([
            'empName' => $request->input('empName'),
            'empEmail' => $request->input('empEmail'),
            'empAddress' => $request->input('empAddress'),
            'empContact' => $request->input('empContact'),
            'addedBy' => auth()->user()->id,
        ]);
        }elseif($act == 'Update'){
           $employee = Employees::find($id)->update([
            'empName' => $request->input('empName'),
            'empEmail' => $request->input('empEmail'),
            'empAddress' => $request->input('empAddress'),
            'empContact' => $request->input('empContact'),
            'empStatus' => $request->input('empStatus'),
            'addedBy' => auth()->user()->id
           ]);
        }else{
            return back()->with('error', 'Invalid Access Token!'); 
        }
        
        if($employee){
            return redirect()->route('viewEmp')->with('success', 'Employee '.$act.'ed successfully!');
        }else{
            return back()->with('error', 'There was a problem!');
        }
    }

    public function delEmp($id)
    {
       $employee = Employees::find($id)->delete();

       if ($employee) {
           return back()->with('success', 'Employee deleted successfully!');
       }else{
           return back()->with('error', 'There was a problem!');
       }
    }
}
