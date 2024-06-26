@extends('layouts.app')
@section('content')

<style>
    .mb-3{
        font-weight:bold;
    }
</style>

<div class="container">
<div class="row">
<div class="col-md-4 p-5 h-50 shadow text-dark">
    <ul class="navbar-link">
     <li><a href="/addblogs">Add Blogs</a></li>
     <li><a href="/manageblogs">Manage Blogs</a></li>
    </ul>
</div>
<div class="col-md-7 ms-5 shadow p-5 text-dark">
<h4>Edit blogs Here</h4>
<!-- success flash laravel message -->
@if(Session('success'))
<div class="alert alert-success">
<span class="text-dark">{{session('success')}}</span>

</div>
@endif
<!-- validations error message -->
@if($errors->any())
<div class="alert alert-danger">

  <ul>
    @foreach($errors->all() as $error)
   <li>{{$error}}</li>
   @endforeach
  </ul>

</div>

@endif
<form method="post">
    @csrf
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label text-success">Edit Titles*</label>
  <input type="text" name="title" value="{{$editblogs->title}}" class="form-control" id="exampleFormControlInput1" placeholder="Blogs title">
</div>

<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label text-success">Edit Blogs descriptions*</label>
  <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{$editblogs->descriptions}}</textarea>
</div>

{{-- <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label text-success">Blog Images</label>
    <input type="file" name="blogimage"  class="form-label" id="exampleFormControlInput1" placeholder="Blog Images">
  </div> --}}

  <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label text-success">Blogs Image*</label>
    <div class="">
        <input type="file" class="form-control" name="blogsimage" value="{{$editblogs->image}}" autocomplete="blogsimage">
    </div>
</div>


  {{-- <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label text-success">Tags*</label>
    <input type="text" data-role="tagsinput" name="tags" class="form-label" id="exampleFormControlInput1" placeholder="Tags">
  </div> --}}

  <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label text-success">Tags*</label>
    <input type="text" data-role="tagsinput" name="tag" value="{{$editblogs->tag}}"  class="form-control" id="exampleFormControlInput1" placeholder="Tags">
  </div>



  <table id="table">
    <tr>
        <th>link</th>
        <th>Name</th>
        <th>action</th>
    </tr>
    <tr>
        <td><input type="text" name="link" value="{{$editblogs->link}}"  class="form-control" placeholder="Enter link" ></td>
        <td><input type="text" name="name" value="{{$editblogs->name}}"  class="form-control" placeholder="Enter Name" ></td>
        <td><button type="button" name="add" id="add" class="btn btn-success">+Add</button></td>
    </tr>
</table>

<div class="mb-3">
<input type="submit" name="updateblogs" value="UpdateBlogs" class="btn btn-lg btn-primary" id="exampleFormControlInput1">
</div>
</form>

</div>

</div>


</div>
@endsection
