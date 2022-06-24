@extends('layouts.app')
@section('content')
<div class="container">
<table class="table table-success table-striped">
<thead>
    <tr>
      <th scope="col">SN</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Logo</th>
      <th scope="col">Website</th>
    </tr>
  </thead>
  <tbody>
  <tr>
      <th scope="row">1</th>
      @foreach($companies as $comp)
      <td>$comp->name</td>
      <td>$comp->email</td>
      <td>$comp->logo</td>
      <td>$comp->website</td>
      @endforeach
    </tr>
  </tbody>
</table>
</div>
@endsection