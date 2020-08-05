<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employees;
use App\OngoingProjects;

class OngoingProjectController extends Controller
{
    public function index()
    {
        $data = array(
            'projects' => OngoingProjects::orderBy('ongoing_projects.id', 'desc')->join('employees', 'employees.id', '=', 'ongoing_projects.projHand')->select('ongoing_projects.*','employees.empName')->paginate(5)
        );
        return view('admin.project.viewProject')->with($data);
    }

    public function create()
    {
        $data = array(
            'act' => 'Add',
            'employees' => Employees::orderBy('empName', 'asc')->where('empStatus', 1)->get()
        );

        return view('admin.project.createProject')->with($data);
    }

    public function edit($id)
    {
        $data = array(
            'act' => 'Update',
            'project' => OngoingProjects::find($id),
            'employees' => Employees::orderBy('empName', 'asc')->where('empStatus', 1)->get()
        );

        return view('admin.project.createProject')->with($data);
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'projName' => 'required',
            'projDescr' => 'required',
            'projHand' => 'required',
        ]);

        $act = $request->input('act');
        $id = $request->input('id');

        if($act == 'Update'){
            $status = $request->input('projStatus');
        }else{
            $status = 5;
        }

        $data = ([
            'projName' => $request->input('projName'),
            'projDescr' => $request->input('projDescr'),
            'projHand' => $request->input('projHand'),
            'projStatus' => $status
        ]);
        if ($act == 'Add') {
            $project = OngoingProjects::create($data);
        }elseif($act == "Update"){
            $project = OngoingProjects::find($id)->update($data);
        }else{
            return back()->with('error', 'Unknown Error!');
        }

        if ($project) {
            return redirect()->route('project')->with('success', 'Project Submitted');
        }else{
            return back()->with('error', 'Sorry there was a problem while submitting!');
        }
    }

    public function delete($id)
    {
        $project = OngoingProjects::find($id)->delete();

        if ($project) {
            return redirect()->route('project')->with('success', 'Project Deleted!'); 
        }else{
            return back()->with('error', 'Sorry there was a problem while deleting!');
        }
    }
}
