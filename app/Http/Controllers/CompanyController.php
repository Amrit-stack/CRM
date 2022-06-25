<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\company;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function show()
    {
        
    }

    public function index()
    {
        $companies=company::with('employees')->get();
       
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
            // $image->resize(100,100);
            $image->move($destinationpath,$logoimage);
            $logo=$logoimage;
       }
       
        $input=array(
            'name'=>$request['name'],
            'email'=>$request['email'],
            'logo'=>$logo,
            'website'=>$request['website']);

        $result=company::create($input);
        if($result->exists())
        {
            
            return redirect()->route('companies.index')->with('message','Company has been created successfully!');
        }
        else{
           
            return redirect()->route('companies.index')->with('error','Error!');
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
            
            return redirect()->route('companies.index')->with('message', 'Company Data Updated');;
        }
        else{
           
            return redirect()->route('companies.index')->with('error','Error!');
        }
    }
    public function destroy($id)
    {
      
       $company=company::with('employees')->where('company_id','=',$id)->first();
      
       $company->delete();

       return redirect()->route('companies.index')->with('message','Company has been deleted successfully!');
    }
    public function getlogo($image_name)
    {

        // if (!Storage::disk('app/public/')->exists($image_name)) {
        //     return response()->file(storage_path('app/public/noimg.svg'));
        // }

        return response()->file(storage_path('app/public/' . DIRECTORY_SEPARATOR . ($image_name)));
    }
}

