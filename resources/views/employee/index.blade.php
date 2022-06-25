

@extends('layouts.app')
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.1/css/fontawesome.min.css">
<div class="container">
<a href="{{ route('employees.create') }}" class="btn btn-secondary">New<i class="fa-solid fa-plus"></i></a><br>
<table class="table table-success table-striped">
<thead>
    <tr>
      <th scope="col">SN</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Company</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $i=1;
    ?>
  @foreach($employees as $emp)
  
  <tr>
      <td scope="row">{{$i++}}</td>
    
      <td>{{$emp->first_name}}</td>
      <td>{{$emp->last_name}}</td>
      <td>{{$emp->companyname()}}</td>
      <td>{{$emp->email}}</td>
      <td>{{$emp->phone}}</td>
      <td>
        <div>
        <a class="btn btn-primary mr-1" href="{{ route('employees.edit', $emp->employee_id) }}">Edit</a>
        <form action="{{ route('employees.destroy', $emp->employee_id) }}" method="post">
          @method('DELETE')
          @csrf
        <button class="btn btn-primary mr-1" onclick="return confirm('Are ypu sure?')">Delete</button>
        </form>  
      </div>
      
      </td>
    </tr>
    
    @endforeach
  </tbody>
</table>
</div>
@endsection
