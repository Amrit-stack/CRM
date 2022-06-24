<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\company;

class CompanyController extends Controller
{
    public function show()
    {
        
    }

    public function index()
    {
        $companies=company::all();
        return view('company/index',['companies'=>$companies]);
    }

    public function create()
    {
        return view('company/create');
    }
    public function store(Request $request)
    {
        return "hello";
    }
    public function edit()
    {
        
    }
    public function update()
    {

    }
    public function destroy()
    {
        
    }
}
