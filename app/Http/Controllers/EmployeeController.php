<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use App\Models\Employee;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::latest()->get();
        return view('employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required',
            'email'     => 'required',
            'salary'    => 'required',
            'city'      => 'required',
            'village'   => 'required',
            'phone'     => 'required',
            'image'     => 'required|mimes:png,jpg,jpeg',
        ]);

        if($request->hasFile('image')) {

            $image = $request->file('image');
            $filename = uniqid() . "-" . time() . "." . $image->getClientOriginalExtension();

            Image::make($image)->resize(484,441)->save(public_path('images/employee/'.$filename));
            $img_url ="images/employee/".$filename;
        }

        $employee = new Employee;
        $employee->name       = $request->name;
        $employee->email      = $request->email;
        $employee->salary     = $request->salary;
        $employee->city       = $request->city;
        $employee->village    = $request->village;
        $employee->phone      = $request->phone;
        $employee->image      = $img_url;
        $employee->created_at = Carbon::now();
        $employee->save();

        Toastr::success('Employee added successfully!');
        return back(); 

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employee.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'      => 'required',
            'email'     => 'required',
            'salary'    => 'required',
            'city'      => 'required',
            'village'   => 'required',
            'phone'     => 'required',
            'image'     => 'required|mimes:png,jpg,jpeg',
        ]);

        $employee = Employee::findOrFail($id);
        $old      = $employee->image;

        if($request->hasFile('image')) {
            if (File::exists($old)) {
                File::delete($old);
            }

            $image = $request->file('image');
            $filename = uniqid() . "-" . time() . "." . $image->getClientOriginalExtension();

            Image::make($image)->resize(484,441)->save(public_path('images/employee/'.$filename));
            $img_url ="images/employee/".$filename;
        }

        $employee->name       = $request->name;
        $employee->email      = $request->email;
        $employee->salary     = $request->salary;
        $employee->city       = $request->city;
        $employee->village    = $request->village;
        $employee->phone      = $request->phone;
        $employee->image      = $img_url;
        $employee->updated_at = Carbon::now();
        $employee->update();

        Toastr::success('Employee update successfully!');
        return redirect()->route('employee.index'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $old      = $employee->image;

        if ($employee) {
            if(File::exists($old)){
                File::delete($old);
            }

            $employee->delete();
            Toastr::error('Employee delete successfully!');
            return back();
        }
    }


    //============== Employee active =========

    public function Active($id)
    {
        Employee::findOrFail($id)->update(['status' => 1]);
        Toastr::success('Employee Active successfully!');
        return back();
    }

    //============== Employee inactive =========

    public function Inactive($id)
    {
        Employee::findOrFail($id)->update(['status' => 0]);
        Toastr::error('Employee Inactive successfully!');
        return back();
    }

}
