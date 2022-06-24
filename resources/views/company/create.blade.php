@extends('layouts.app');
@section('content')
<div class="container">
<form action="{{ route('companies.store') }}" enctype="multipart/form-data" method="POST">
  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input name='name' type="text" class="form-control" id="name" required>
  </div>
  <div class="mb-3">
    <label for="Email" class="form-label">Email</label>
    <input name='email' type="email" class="form-control" id="email">
  </div>
  <div class="mb-3">
    <label for="logo" class="form-label">Logo</label>
    <input type="file" name="logo" id="logo">
  </div>
  <div class="mb-3">
    <label for="Website" class="form-label">Website</label>
    <input name ='name' type="text" class="form-control" id="website">
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
@endsection