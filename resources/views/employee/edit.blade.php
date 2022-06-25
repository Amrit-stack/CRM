@extends('layouts.app');
@section('content')
<div class="container">
<form action="{{ route('employees.update',[$employees->employee_id]) }}" method="POST">
@method('PUT')
@csrf

<div class="mb-3">
    <label for="first_name" class="form-label">First Name</label>
    <input value="{{$employees->first_name}}" name='first_name' type="text" class="form-control" id="first_name" >
  </div>
  <div class="mb-3">
    <label for="last_name" class="form-label">Last Name</label>
    <input value="{{$employees->last_name}}" name='last_name' type="text" class="form-control" id="last_name">
  </div>
  <div class="mb-3">
    <label for="company_id" class="form-label">Company</label>
  <select name="company_id" id="company_id" class="form-control" >
    
    @foreach($companies as $comp)
    <option value="{{$comp->company_id}}" {{ ($comp->company_id == $employees->company_id) ? 'selected=selected' : '' }}>{{$comp->name}}</option>
    @endforeach
  </select>
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input value="{{$employees->email}}" name ='email' type="email" class="form-control" id="email">
  </div>
  <div class="mb-3">
    <label for="phone" class="form-label">Phone</label>
    <input value="{{$employees->phone}}" name ='phone' type="number" class="form-control" id="phone">
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
@endsection