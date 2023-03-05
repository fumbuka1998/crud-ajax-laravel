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

     <!-- edit student model -->
     <div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit/Update Student</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- display error validations --}}
                    <ul id="updateform_errlist"></ul>

                    {{-- <input type="text" id="edit_student_id"> --}}
                    
                    <input type="hidden" id="edit_student_id" class="id form-control">
                   
                    <div class="form-control mb-3">
                        <label for="">Name</label>
                        <input type="text" id="edit_name" class="name form-control">
                    </div>
                    <div class="form-control mb-3">
                        <label for="">Email</label>
                        <input type="text" id="edit_email" class="email form-control">
                    </div>
                    <div class="form-control mb-3">
                        <label for="">Phone</label>
                        <input type="text" id="edit_phone" class="phone form-control">
                    </div>
                    <div class="form-control mb-3">
                        <label for="">Course</label>
                        <input type="text" id="edit_course" class="course form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary update_student">Update</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end of edit student modal --}}


     <!-- sdelete student model -->
     <div class="modal fade" id="deleteStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Student</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    
                    <input type="hidden" id="delete_student_id" class="id form-control">
                    <h3>are you sure you want to delete this student?</h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary delete_student_btn">Yes Delete</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end of delete student modal --}}
    
    <div class="container py-5">
        <div class="row">
            <div class="container text-md-center">
                <h2 class="barge bg-primary text-light">
                    STUDENTS MANEGER
                </h2>
            </div>
            
            <div class="col-md-12">
                {{-- the div tag below display the  success message from ajax response --}}
                <div id="success_message"></div>

                <div class="card">
                    <div class="card-header">
                        <h4>
                            Student Data
                            <a href="#" class="btn btn-primary float-end btn-sm" data-bs-toggle="modal"
                                data-bs-target="#addStudentModal">Add Student</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered  table-striper table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NAME</th>
                                    <th>EMAIL</th>
                                    <th>PHONE</th>
                                    <th>COURSE</th>
                                    <th>EDIT</th>
                                    <th>DELETE</th>
                                </tr>
                            </thead>
                            <tbody>


                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            fetchStudents()
            //ajax function to get data from the database
            function fetchStudents() {
                $.ajax({
                    type: 'GET',
                    url: '/fetchstudents',
                    dataType: 'json',
                    success: function(response) {

                        $('tbody').html(""); //empty he table first
                        // alert(1);
                        // console.log(response.students);
                        $.each(response.students, function(key, item) {
                            $('tbody').append(
                                `<tr>
                                    <td>` + item.id + `</td>
                                    <td>` + item.name + `</td>
                                    <td>` + item.email + `</td>
                                    <td>` + item.phone + `</td>
                                    <td>` + item.course + `</td>
                                    <td><button type="button" value="` + item.id + `"
                                            class="edit_student btn btn-primary btn-sm">edit</button></td>
                                    <td><button type="button" value="` + item.id + `"
                                            class="delete_student btn btn-danger btn-sm">delete</button></td>
                                </tr>`
                            );
                        });

                    }
                });
            }

            // an ajax function to delete data from the list
            $(document).on('click', '.delete_student', function(e){
                e.preventDefault();

                var std_id = $(this).val();
                // alert(std_id);
                $('#delete_student_id').val(std_id);
                $('#deleteStudentModal').modal('show');

            });
            $(document).on('click', '.delete_student_btn', function(e){
                e.preventDefault();

                $(this).text('deleting');
                var std_id = $('#delete_student_id').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'delete',
                    url: '/delete-student/'+ std_id,
                    success: function(response){
                        // alert(response)
                        $('#success_message').text(response.message);
                        $('#success_message').addClass('alert alert-success');
                        $('#deleteStudentModal').modal('hide');
                        setTimeout(function() {
                            $("#success_message").text("").removeClass();
                            }, 5000);
                            $('.delete_student_btn').text('Yes Delete');

                        fetchStudents();
                    }
                });
                

            });
            //function below edit students by id
            $(document).on('click','.edit_student', function(e) {
                e.preventDefault();
                var std_id  = $(this).val();
                // console.log(std_id);
                // alert(1);
                $('#editStudentModal').modal('show');
                //ajax get request to fetch data to be edited
                $.ajax({
                    method: "GET",
                    url: "/edit-student/" + std_id,
                    type: "JSON",
                    success: function(response){
                        // console.log(response);
                        if(response.status == 404){
                            $('#success_message').html("");
                            $('#success_message').addClass('alert alert-danger');
                            $('#success_message').text(response.message);
                        }else{
                            $('#edit_name').val(response.student.name);
                            $('#edit_email').val(response.student.email);
                            $('#edit_phone').val(response.student.phone);
                            $('#edit_course').val(response.student.course);
                            $('#edit_student_id').val(std_id);
                        }
                    }

                });
            });

            //update function appear below 
            $(document).on('click', '.update_student', function(e){
                e.preventDefault();
                $(this).text('Updating');
                var std_id = $('#edit_student_id').val();

                var ed_data = {
                    'name':$('#edit_name').val(),
                    'email':$('#edit_email').val(),
                    'phone':$('#edit_phone').val(),
                    'course':$('#edit_course').val(),

                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'PUT',
                    url: '/update_student/'+std_id,
                    data: ed_data,
                    dataType:'json',
                    success: function(response){
                        // alert(1);
                        // console.log(response);
                        if(response.status == 400){
                            $('#updateform_errlist').html("");
                            $('#updateform_errlist').addClass('alert alert-danger');
                            $.each(response.error, function(key, err_values) {
                                // console.log(err_values);
                                $('#updateform_errlist').append(`<li>` + err_values +
                                    `</li>`);

                            });
                            $('.update_student').text('Update');

                            setTimeout(function() {
                                $("#updateform_errlist").text("").removeClass();
                            }, 5000);

                        }else if(response.status == 404){
                            $('#updateform_errlist').html("");
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.message);

                        }else{
                            $('#updateform_errlist').html("");
                            $('#success_message').html("");
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.message);
                            $('.update_student').text('Update');

                            $('#editStudentModal').modal('hide');

                            fetchStudents();


                        }
                    }
                });
            })

                //below function add students to list
            $(document).on('click', '.add_student', function(e) {
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
                    type: 'POST',
                    url: '/studentstore',
                    data: data,
                    dataType: 'json',
                    success: function(response) {
                        // console.log(response);
                        if (response.status == 400) {
                            $('#saveform_errlist').html("");
                            $('#saveform_errlist').addClass('alert alert-danger');
                            $.each(response.error, function(key, err_values) {
                                // console.log(err_values);
                                $('#saveform_errlist').append(`<li>` + err_values +
                                    `</li>`);

                            });
                            setTimeout(function() {
                                $("#saveform_errlist").text("").removeClass();
                            }, 5000);
                        } else {

                            $('#saveform_errlist').html("");
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.message);
                            $('#addStudentModal').modal('hide');
                            $('#addStudentModal').find('input').val("");
                            fetchStudents();
                            //function to set time out for the success message
                            setTimeout(function() {
                                $("#success_message").text("").removeClass();
                            }, 5000);

                        }
                    }
                });
            });
        });
    </script>
@endsection
