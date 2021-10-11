<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$employee =  Employee::join('companies','companies.id', '=', 'employees.comapny_id')
                                ->orderBy('id','DESC')
                                ->select('employees.*','companies.name')
                                ->paginate(10);
        return view('employee.index', compact('employee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        $company =  Company::all();
        return view('employee.create', compact('company'));
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
        	'first_name' => 'required|max:191',
        	'last_name' => 'required|max:191',
        	'comapny_id' => 'required',
            'email' => 'required|max:50',
            'phone' => 'required|max:10',
        ]);
 
        $employee = new Employee();
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->comapny_id = $request->comapny_id;        
        if($employee->save()){
            return back()->with("success", "Employee Successfully Created.");
        }else{
            return back()->withInput()->with("error", "Sorry! Some error occured. Please try again.");
        }
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
        $employee =  Employee::join('companies','companies.id', '=', 'employees.comapny_id')
                                ->where('employees.id',$id)
                                ->orderBy('id','DESC')
                                ->select('employees.*','companies.id as comp_id')
                                ->first();
        $company =  Company::all();
        //echo '<pre>';print_r($employee);die;
        return view('employee.edit',compact('employee','company'));
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
            'first_name' => 'required|max:191',
            'last_name' => 'required|max:191',
            'comapny_id' => 'required',
            'email' => 'required|max:50',
            'phone' => 'required|max:10',
        ]);
       $employee =  Employee::find($id);
         $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->comapny_id = $request->comapny_id;       
        if($employee->update()){
            return back()->with("success", "Employee Successfully Updated.");
        }else{
            return back()->withInput()->with("error", "Sorry! Some error occured. Please try again.");
        }
                
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        if($employee->delete()){
            return redirect()->back()->with('success', 'Successfully Deleted Employee Record.');
        }else{
            return back()->withInput()->with("error", "Sorry! Some error occured. Please try again.");
        }
    }
}
