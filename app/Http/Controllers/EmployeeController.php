<?php

namespace App\Http\Controllers;

use App\Models\company;
use App\Models\employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use LengthException;


class EmployeeController extends Controller
{
    public function show()
    {
        
    }

    public function index()
    {
        $employees=employee::all();
       
        return view('employee.index',['employees'=>$employees]);
    }

    public function create()
    {
        $companies=company::all();
        return view('employee.create',['companies'=>$companies]);
    }
    public function store(Request $request)
    {
        // dd($request->all());
        // employee::truncate();
        $validation=Validator::make($request->all(),[
            'first_name'=>'required',
            'last_name'=>'required',
            'phone'=>'numeric|digits:10'
        ]);

        if ($validation->fails()) {

            $message = $validation->messages();

            $response = [
                'status' => false,
                'message' => $message,
                'errStatus' => 'Data Validation Failed. Please Check the provided data and try again.'
            ];
            return response()->json($response, 422);
        }
        $input=array(
            'first_name'=>$request['first_name'],
            'last_name'=>$request['last_name'],
            'company_id'=>$request['company_id'],
            'email'=>$request['email'],
            'phone'=>$request['phone']
        );

        $result=employee::create($input);
        if($result->exists())
        {
            
            return redirect()->route('employees.index')->with('message', 'Employeed has been created successfully!');
        }
        else{
           
           
            return redirect()->route('employees.index')->with('error', 'Error !');
        }

        

    }
    public function edit($id)
    {
        $employees=employee::find($id);
        $companies=company::all();
        return view('employee.edit',['employees'=>$employees,'companies'=>$companies]);
        
    }
    public function update(Request $request,$id)
    {
        $employee=employee::findOrFail($id);
       

        $validation=Validator::make($request->all(),[
            'first_name'=>'required',
            'last_name'=>'required',
            'phone'=>'numeric|digits:10'
        ]);

        

        if ($validation->fails()) {

            $message = $validation->messages();

            $response = [
                'status' => false,
                'message' => $message,
                'errStatus' => 'Data Validation Failed. Please Check the provided data and try again.'
            ];
            return response()->json($response, 422);
        }
       

        
       
       $employee->first_name=$request->first_name;
       $employee->last_name=$request->last_name;
       $employee->company_id=$request->company_id;
       $employee->email=$request->email;
       $employee->phone=$request->phone;

       $result=$employee->save();
        // dd($result);
        if($result)
        {
           
            return redirect()->route('employees.index')->with('message','Employeed has been updated successfully!');
        }
        else{
           
            return redirect()->route('employees.index')->with('error','Error!');
        }
    }
    public function destroy($id)
    {
    
       $employee=employee::where('employee_id','=',$id)->delete();
       return redirect()->route('employees.index')->with('message', 'Employee has been deleted successfully!');
    }
    
}
