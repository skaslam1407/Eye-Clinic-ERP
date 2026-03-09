@extends('layouts.app')

@section('content')

<div class="card shadow-lg border-0">
    <div class="card-header bg-dark text-white d-flex justify-content-between">
        <h4>Student Management</h4>
        <button class="btn btn-success" id="addStudentBtn">Add Student</button>
    </div>

    <div class="card-body">

        <table class="table table-bordered table-striped" id="studentsTable">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Course</th>
                    <th width="150">Action</th>
                </tr>
            </thead>
        </table>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="studentModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="studentForm">
                @csrf
                <input type="hidden" id="student_id">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Student Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" id="name" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" id="email" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Phone</label>
                        <input type="text" id="phone" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Course</label>
                        <input type="text" id="course" class="form-control">
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>

$(document).ready(function() {

    let table = $('#studentsTable').DataTable({
        ajax: "{{ route('students.data') }}",
        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'email' },
            { data: 'phone' },
            { data: 'course' },
            {
                data: null,
                render: function(data) {
                    return `
                        <button class="btn btn-warning btn-sm editBtn" data-id="${data.id}">Edit</button>
                        <button class="btn btn-danger btn-sm deleteBtn" data-id="${data.id}">Delete</button>
                    `;
                }
            }
        ]
    });

    // Add button
    $('#addStudentBtn').click(function(){
        $('#studentForm')[0].reset();
        $('#student_id').val('');
        $('#studentModal').modal('show');
    });

    // Submit form
    $('#studentForm').submit(function(e){
        e.preventDefault();

        let id = $('#student_id').val();
        let url = id ? `/students/${id}` : `/students`;
        let method = id ? 'PUT' : 'POST';

        $.ajax({
            url: url,
            type: method,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                name: $('#name').val(),
                email: $('#email').val(),
                phone: $('#phone').val(),
                course: $('#course').val()
            },
            success: function(response){
                $('#studentModal').modal('hide');
                table.ajax.reload();
                Swal.fire('Success', response.message, 'success');
            },
            error: function(xhr){
                let errors = xhr.responseJSON.errors;
                let msg = '';
                $.each(errors, function(key, value){
                    msg += value[0] + '<br>';
                });
                Swal.fire('Error', msg, 'error');
            }
        });
    });

    // Delete
    $(document).on('click', '.deleteBtn', function(){
        let id = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            icon: 'warning',
            showCancelButton: true,
        }).then((result) => {
            if(result.isConfirmed){
                $.ajax({
                    url: `/students/${id}`,
                    type: 'DELETE',
                    data: {_token: $('meta[name="csrf-token"]').attr('content')},
                    success: function(response){
                        table.ajax.reload();
                        Swal.fire('Deleted!', response.message, 'success');
                    }
                });
            }
        });
    });


  // Edit Button Click
$(document).on('click', '.editBtn', function(){

    let id = $(this).data('id');

    $.ajax({
        url: `/students/${id}`,
        type: 'GET',
        success: function(student){

            $('#student_id').val(student.id);
            $('#name').val(student.name);
            $('#email').val(student.email);
            $('#phone').val(student.phone);
            $('#course').val(student.course);

            $('#studentModal').modal('show');
        }
    });

});



});
</script>
@endsection