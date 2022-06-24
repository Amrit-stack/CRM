<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\company;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class CompanyController extends Controller
{
    public function show()
    {
        
    }

    public function index()
    {
        $companies=company::all();
        return view('company.index',['companies'=>$companies]);
    }

    public function create()
    {
        return view('company.create');
    }
    public function store(Request $request)
    {
        // dd($request->all());
        // company::truncate();
        $validation=Validator::make($request->all(),[
            'name'=>'required',
            'logo'=>'image|mimes:jpg,png,svg,jpeg'
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
        $logo='noimg.svg';
       if($request->hasFile('logo'))
       {
            $image=$request->file('logo');
            $logoimage=date('Ymdhis') . '.' . $image->getClientOriginalExtension();
            $destinationpath=storage_path('/app/public/');
            $image->move($destinationpath,$logoimage);
            $logo=$logoimage;
       }
       
        $input=array(
            'name'=>$request['name'],
            'email'=>$request['email'],
            'logo'=>json_encode($logo),
            'website'=>$request['website']);

        $result=company::create($input);
        if($result->exists())
        {
            Session::flash('message', 'Company Data Added');
            Session::flash('alert-class', 'alert-success');
            return redirect()->route('companies.index');
        }
        else{
            Session::flash('message', 'An Error occured in adding Company Data');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->route('companies.index');
        }

        

    }
    public function edit($id)
    {
        $companies=company::find($id);
        return view('company.edit',['companies'=>$companies]);
        
    }
    public function update(Request $request,$id)
    {
        $company=company::findOrFail($id);
       

        $validation=Validator::make($request->all(),[
            'name'=>'required',
            'logo'=>'image|mimes:jpg,png,svg,jpeg'
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
       

        if ($request->hasFile('logo')) {

            $feature_img = 'noImg.jpg';
            $image = $request->file('logo');
            $temp_img = date('Ymdhis') . '.' . $image->getClientOriginalExtension();
            $destinationPath = storage_path('/app/public/');
            if ($image->move($destinationPath, $temp_img)) {
                $feature_img = $temp_img;
            }
            $company->logo = $feature_img;
        }
       
       
       $company->name=$request->name;
       
       $company->email=$request->email;
       $company->website=$request->website;

       $result=$company->save();
        // dd($result);
        if($result)
        {
            Session::flash('message', 'Company Data Updated');
            Session::flash('alert-class', 'alert-success');
            return redirect()->route('companies.index');
        }
        else{
            Session::flash('message', 'An Error occured in Updating Company Data');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->route('companies.index');
        }
    }
    public function destroy($id)
    {
    
       $company=company::where('company_id','=',$id)->delete();
       return redirect()->route('companies.index');
    }
}

