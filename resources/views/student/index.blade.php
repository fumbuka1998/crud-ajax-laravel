@extends('layouts.app')

@section('content')


<!-- add student model -->
<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add Student</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {{-- display error validations --}}
            <ul id="saveform_errlist"></ul>

          <div class="form-control mb-3">
            <label for="">Name</label>
            <input type="text" class="name form-control">
          </div>
          <div class="form-control mb-3">
            <label for="">Email</label>
            <input type="text" class="email form-control">
          </div>
          <div class="form-control mb-3">
            <label for="">Phone</label>
            <input type="text" class="phone form-control">
          </div>
          <div class="form-control mb-3">
            <label for="">Course</label>
            <input type="text" class="course form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary add_student">Save</button>
        </div>
      </div>
    </div>
  </div>
{{-- end of add student modal --}}

<div class="container py-5">
    <div class="row">
        <div class="col-md-12">

            <div id="success_message"></div>

            <div class="card">
                <div class="card-header">
                    <h4>
                        Student Data
                        <a href="#" class="btn btn-primary float-end btn-sm"  data-bs-toggle="modal" data-bs-target="#addStudentModal">Add Student</a>
                    </h4>
                </div>
                <div class="card-body">
                    
                </div>
            </div>
        </div>
    </div>

</div>



@endsection

@section('scripts')

<script>
$(document).ready(function(){
    $(document).on('click', '.add_student', function(e){
        e.preventDefault();
        // alert('fuck');
        //below variable take data from the input field using jquery
        var data = {
            'name': $('.name').val(),
            'email': $('.email').val(),
            'phone': $('.phone').val(),
            'course': $('.course').val()
        };

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        // console.log(data)
        $.ajax({
            type:'POST',
            url: '/studentstore',
            data: data,
            datatype: 'json',
            success: function(response){
                // console.log(response);
                if(response.status == 400){
                    $('#saveform_errlist').html("");
                    $('#saveform_errlist').addClass('alert alert-danger');
                    $.each(response.error, function(key, err_values){
                        // console.log(err_values);
                        $('#saveform_errlist').append(`<li>`+ err_values +`</li>`);

                    } );
                }
                else{
                    
                    $('#saveform_errlist').html("");
                    $('#success_message').addClass('alert alert-success');
                    $('#success_message').text(response.message);
                    $('#addStudentModal').modal('hide');
                    $('#addStudentModal').find('input').val("");

                }
            }
        });
    });
});

</script>

@endsection