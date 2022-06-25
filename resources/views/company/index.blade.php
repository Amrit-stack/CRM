@extends('layouts.app')
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.1/css/fontawesome.min.css">
<div class="container">
<a href="{{ route('companies.create') }}" class="btn btn-secondary">New<i class="fa-solid fa-plus"></i></a><br>
<table class="table table-success table-striped">
<thead>
    <tr>
      <th scope="col">SN</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Logo</th>
      <th scope="col">Website</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $i=1;
    ?>
  @foreach($companies as $comp)
 
  <tr>
      <td scope="row">{{$i++}}</td>
    
      <td>{{$comp->name}}</td>
      <td>{{$comp->email}}</td>
      <td>
        <img src="{{ url('/serve-logo/'.$comp->logo) }}" alt="" style="height:70px;width:70px;">
      </td>
      <td>{{$comp->website}}</td>
      <td>
        <div>
        <a class="btn btn-primary mr-1" href="{{ route('companies.edit', $comp->company_id) }}">Edit</a>
        <form action="{{ route('companies.destroy', $comp->company_id) }}" method="post">
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