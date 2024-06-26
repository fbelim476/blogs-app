@extends('layouts.app')
@section('content')
<div class="container mb-5">
       {{-- <li><a href="/manageblogs">Manage Blogs</a></li> --}}
  <button class="btn btn-md btn-primary p-2 float-end"><a href="/addblogs" class="text-white" style="text-decoration:none;list-style-type:none;"> Add Blogs</a></button>
</div>
<div class="container">
<div class="row">

<div class="col-md-12  shadow p-5 text-dark">
<h4>Manage All blogs Here</h4>
<!-- success flash laravel message -->
@if(Session('del'))
<div class="alert alert-danger">
<span class="text-dark">{{session('del')}}</span>
</div>
@endif

@if(Session('success'))
<div class="alert alert-success">
<span class="text-dark">{{session('success')}}</span>
</div>
@endif
<form method="post">
    @csrf
<div class="mb-3">

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Blogs Title</th>
      <th scope="col">Descriptions</th>
      <th scope="col">Blog Images</th>
      <th scope="col">Tags</th>
      <th scope="col">link</th>
      <th scope="col">Name</th>
      <th scope="col">Added Date</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($data as $row)
    <tr>
      <td>{{$row->id}}</td>
      <td>{{$row->title}}</td>
      <td>{{$row->descriptions}}</td>
      <td>{{$row->image}}</td>
      <td>{{$row->tag}}</td>
      <td>{{$row->link}}</td>
      <td>{{$row->name}}</td>
      <td>{{$row->created_at}}</td>
      <td><a href='{{URL("/manageblogs/".$row->id)}}' class="btn btn-danger btn-sm"><span class="bi bi-trash text-white"></a> | <a href='{{URL("/editblogs/".$row->id)}}' class="btn btn-primary btn-sm"><span class="bi bi-pencil text-white"></a></td>
    </tr>
    @endforeach

  </tbody>
</table>



</div>
</div>

@endsection
