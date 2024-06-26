@extends('layouts.app')
@section('content')

  <div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 align="center">DataTables</h1>
          </div>

        </div>
      </div>
    </section>

    <section class="content">
        <span class="alert alert-success" id="alert-success" style="display: none;"></span>
        <span class="alert alert-danger" id="alert-danger" style="display: none;"></span>

      <div class="container-fluid">
        <div class="card">
            <div class="card-header"> <button class="btn btn-success btn-sm float-end" data-bs-toggle="modal" data-bs-target="#addModal">Create New</button></div>
                <span class="alert alert-success" id="alert-success" style="display:none;"></span>
                <span class="alert alert-danger" id="alert-danger" style="display:none;"></span>

            <div class="card-body">
                <table class="table table-sm table-bordered table-striped" id="datatable" >
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Number</th>
                            <th>Gender</th>
                            <th>DOB</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($all_data) > 0)
                        @foreach ($all_data as $item )
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->mobile }}</td>
                                <td>{{ $item->gender }}</td>
                                <td>{{ $item->dob }}</td>
                                <td><button class="btn btn-primary btn-sm editBtn" data-id="{{ $item->id }}" data-name="{{ $item->name }}" data-email="{{ $item->email }}" data-mobile="{{ $item->mobile }}" data-gender="{{ $item->gender }}" data-dob="{{ $item->dob }}" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button></td>
                                <td><button class="btn btn-danger btn-sm deleteBtn" data-id="{{ $item->id }}" data-name="{{ $item->name }}" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button></td>
                            </tr>

                        @endforeach

                        @else

                        @endif
                    </tbody>
                </table>

            </div>

        </div>

      </div>

 <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="addData">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="">
                <span id="name_error" class="text-danger"></span>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="">
                <span id="email_error" class="text-danger"></span>
              </div>
              <div class="form-group">
                <label for="mobile">Number</label>
                <input type="number" name="mobile" class="form-control" id="">
                <span id="mobile_error" class="text-danger"></span>
              </div>
              <div class="form-group">
                <label for="gender">gender</label></br>
                <input type="radio" name="gender" value="male"> Male
                <input type="radio" name="gender" value="female"> Female
                <span id="gender_error" class="text-danger"></span>
            </div>
              <div class="form-group">
                <label for="dob">Dob</label>
                <div class="col-sm-12">
                    <input type="date" id="dob" name="dob" class="form-control">
                <span id="dob_error" class="text-danger"></span>

                </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary addBtn">Save changes</button>
        </div>
    </form>
      </div>
    </div>
  </div>
 </div>




  </div>
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Do You Really Want To Deleted<p class="data_name">?</p>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger deleteButton">Delete</button>
        </div>
      </div>
    </div>
  </div>

    </section>



<script>

     $(document).ready(function(){


        $('#datatable').DataTable({
             processing: true,
             serverSide: true,
             ajax: "{{route('allData')}}",
             columns: [
                 { data: 'id' },
                 { data: 'name' },
                 { data: 'email' },
                 { data: 'mobile' },
                 { data: 'gender' },
                 { data: 'dob' },
                 { data: 'action' },

             ]
         });

      });

    $(document).ready(function(){
        $('#addData').submit(function(e){
            e.preventDefault();
            let formData = $(this).serialize();
            $.ajax({
                url: '{{ route("allData") }}',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $('.addBtn').prop('disabled', true);
                },
                complete: function(){
                    $('.addBtn').prop('disabled', false);
                },
                success: function(data){
                    if(data.success ==  true){
                        $('#addModal').modal('hide');
                        printSuccessMsg(data.msg);

                    }else if(data.success == false){
                        printErrorMsg(data.msg);
                    }else{
                        printValidationErrorMsg(data.msg);
                    }
                }
            });
            return false;

            function  printValidationErrorMsg(msg) {
                $.each(msg, function(field_name,error){

                    $(document).find('#'+field_name+'_error').text(error);
                });
            }

            function printErrorMsg(msg){
                $('#alert-danger').html('');
                $('#alert-danger').css('display','block');
                $('#alert-danger').append(''+msg+'');
            }

            function printSuccessMsg(msg){
                $('#alert-success').html('');
                $('#alert-success').css('display','block');
                $('#alert-success').append(''+msg+'');
                document.getElementById('addData').reset();
            }

        });

        $('.deleteBtn').on('click',function() {

            var data_id = $(this).attr('data-id');
            var name = $(this).attr('data-name');

            $('.data_name').html('');
            $('.data_name').html(name);


            $('.deleteButton').on('click',function(){
         var url = "{{ route('deleteData','data_id') }}";
         url =url.replace('data_id',data_id);

         $.ajax({
            url: url,
                type: 'GET',
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $('.deleteButton').prop('disabled', true);
                },
                complete: function(){
                    $('.deleteButton').prop('disabled', false);
                },
                success: function(data){
                    if(data.success ==  true){
                        $('#deleteModal').modal('hide');
                        printSuccessMsg(data.msg);
                        var reloadInterval = 5000;
                        function reloadPage(){
                            location.reload(true);
                        }
                        var intervalId = setInterval(reloadPage,  reloadInterval);
                    }
                    else
                    {
                     printErrorMsg(data.msg);
                    }
                }
         });
        });

       });


       $('.editBtn').on('click',function(){
            var id = $(this).attr('data-id');
            var name = $(this).attr('data-name');
            var email = $(this).attr('data-email');
            var mobile = $(this).attr('data-mobile');
            var gender = $(this).attr('data-gender');
            if(gender === "male") {
                $("#male").prop("checked", true);
            } else if (gender === "female") {
                $("#female").prop("checked", true);
            }

            var dob = $(this).data('dob');
            $('#id').val(id);
            $('#name').val(name);
            $('#email').val(email);
            $('#mobile').val(mobile);
            $('#gender').val(gender);
            document.getElementById("dob_edit").value = dob;
       });

       $('#updateData').on('click',function(e){
            e.preventDefault();
            $.ajax({
                url: '{{ route("editData") }}',
                type: 'POST',
                data:$('#editForm').serialize(),
                success: function(data){
                    if(data.success ==  true){
                        $('#editModal').modal('hide');
                        printSuccessMsg(data.msg);

                    }else if(data.success == false){
                        printErrorMsg(data.msg);
                    }else{
                        printValidationErrorMsg(data.msg);
                    }
                }
            });
           });

                function  printValidationErrorMsg(msg) {
                    $.each(msg, function(field_name,error){

                        $(document).find('#'+field_name+'_error').text(error);
                    });
                }
                function printErrorMsg(msg){
                    $('#alert-danger').html('');
                    $('#alert-danger').css('display','block');
                    $('#alert-danger').append(''+msg+'');
                }
                function printSuccessMsg(msg){
                    $('#alert-success').html('');
                    $('#alert-success').css('display','block');
                    $('#alert-success').append(''+msg+'');
                    document.getElementById('deleteBtn').reset();
                }

    });


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

@endsection



