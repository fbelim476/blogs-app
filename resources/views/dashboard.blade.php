@extends('layouts.app')
@section('content')

<style>

    .col-md-7{

        font-weight: bold;
    }

</style>


<div class="container">
<div class="row">
<div class="col-md-4 p-5 shadow text-dark">
    <ul class="navbar-link">
     <li><a href="/addblogs">Add Blogs</a></li>
     <li><a href="/manageblogs">Manage Blogs</a></li>
     <li><a href="/datatable">DataTable</a></li>
     <li><a href="/users">Users</a></li>
    </ul>
</div>

<div class="col-md-7 ms-5 shadow p-5 text-dark">
    <h4>Welcome to dasboard of Laravel</h4>
</div>
</div>


</div>
@endsection
