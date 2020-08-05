<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            'employees' => Employees::orderBy('empName', 'asc')
                ->paginate(5)
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
        'empEmail' => 'required',
        'empAddress' => 'required',
        'empContact' => 'required',
        'empImage' => 'nullable|max:1999',
        ]);

        //handle file upload
        if ($request->hasFile('empImage')) {

            //get file name with the extension
            $fileNameWithExt = $request->file('empImage')->getClientOriginalName();

            //get just file name
            //$filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            //get just ext
            $extension = $request->file('empImage')->getClientOriginalExtension();

            //file name to store

            $fileNameToStore = 'Employee-'.str_replace(' ', '',$request->empName).date('-Ymdhi-').rand(0,999).'.'.$extension;

            //upload image
            $path = $request->file('empImage')->storeAs('public/empImages/', $fileNameToStore);
            
            // On update change
            if ($act == 'Update') {
                $find = Employees::find($id);
                Storage::delete('public/empImages/'.$find->empImage);
            }
        }else{
            $fileNameToStore = 'noimage.jpg';
        }

        // Status Setup
        if ($request->input('empStatus')) {
            $status = $request->input('empStatus');
        }else{
            $status = 1;
        }


        $data = ([
            'empName' => $request->input('empName'),
            'empEmail' => $request->input('empEmail'),
            'empAddress' => $request->input('empAddress'),
            'empContact' => $request->input('empContact'),
            'empStatus' => $status,
            'empImage' => $fileNameToStore,
            'addedBy' => auth()->user()->id,
            ]);

        // Defines to update or insert
        if ($act == 'Add') {
            $employee = Employees::create($data);
        }elseif($act == 'Update'){
           $employee = Employees::find($id)->update($data);
        }else{
            return back()->with('error', 'Invalid Access Token!'); 
        }
        
        // Success or Error Message
        if($employee){
            return redirect()->route('viewEmp')->with('success', 'Employee '.$act.'ed successfully!');
        }else{
            return back()->with('error', 'There was a problem!');
        }
    }

    public function delEmp($id)
    {
       $find = Employees::find($id);

       //Remove file
       if ($find->empImage != 'noimage.jpg') {
           Storage::delete('public/empImages/'.$find->empImage);
        }
        
        $employee = $find->delete();
        
        // Response message
        if ($employee) {
            return back()->with('success', 'Employee deleted successfully!');
        }else{
            return back()->with('error', 'There was a problem!');
        }
    }
}
