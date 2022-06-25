@extends('layouts.app');
@section('content')
<div class="container">
<form action="{{ route('employees.store') }}"  method="POST">
 @csrf
  <div class="mb-3">
    <label for="first_name" class="form-label">First Name</label>
    <input name='first_name' type="text" class="form-control" id="first_name" required>
  </div>
  <div class="mb-3">
    <label for="last_name" class="form-label">Last Name</label>
    <input name='last_name' type="text" class="form-control" id="last_name">
  </div>
  <div class="mb-3">
    <label for="company_id" class="form-label">Company</label>
    <select name="company_id" id="company_id" class="form-control">
      <option value="0" disabled selected>Please select company</option>
      @foreach($companies as $comp)
      <option value="{{$comp->company_id}}">{{$comp->name}}</option>
      @endforeach
    </select>
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input name ='email' type="email" class="form-control" id="email">
  </div>
  <div class="mb-3">
    <label for="phone" class="form-label">Phone</label>
    <input name ='phone' type="number" class="form-control" id="phone" >
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
@endsection