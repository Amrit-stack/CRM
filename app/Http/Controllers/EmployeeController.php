<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function show()
    {
        
    }

    public function index()
    {
        return view('employee/index');
    }

    public function create()
    {
        return view('employee/create');
    }
    public function store(Request $request)
    {
        
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
