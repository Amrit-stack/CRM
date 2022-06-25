@extends('layouts.app');
@section('content')
<div class="container">
<form action="{{ route('companies.update',[$companies->company_id]) }}" enctype="multipart/form-data" method="POST">
@method('PUT')
@csrf

  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input value="{{ $companies->name }}" name="name" type="text" class="form-control" id="name" >
  </div>
  <div class="mb-3">
    <label for="Email" class="form-label">Email</label>
    <input value="{{ $companies->email }}" name="email" type="email" class="form-control" id="email">
  </div>
  <div class="mb-3">
    <label for="logo" class="form-label">Logo</label>
    <input value="" type="file" name="logo" id="logo">
  </div>
  <div class="mb-3">
    <label for="Website" class="form-label">Website</label>
    <input value="{{ $companies->website }}" name ="website" type="text" class="form-control" id="website">
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
@endsection