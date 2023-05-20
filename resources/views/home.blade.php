@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-center">
                    <h2>Student Records</h2>
                </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <button class="btn btn-success btn-sm mb-3" title="Add New Student" data-toggle="modal"
                        data-target="#addStudentModal">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add New
                    </button>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>StudentID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->studentID }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td>
                                        <a href="{{ route('student.edit', ['id' => $item->id]) }}" title="Edit Student"
                                            <a href="{{ route('student.edit', ['id' => $item->id]) }}"
                                            title="Edit Student" data-toggle="modal"
                                            data-target="#editStudentModal{{ $item->id }}">
                                            <button class="btn btn-primary btn-sm">
                                                <i class="fas fa-pencil-alt"></i> <!-- Icon Only -->
                                            </button>
                                        </a>
                                        <button class="btn btn-danger btn-sm" title="Delete Student" data-toggle="modal"
                                            data-target="#deleteModal{{ $item->id }}">
                                            <i class="fas fa-trash"></i> <!-- Icon Only -->
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Student Modal -->
<div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="addStudentModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStudentModalLabel">Add New Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('student') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="studentID">StudentID</label>
                        <input type="text" name="studentID" id="studentID" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" class="form-control" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Student Modals -->
@foreach($students as $item)
<div class="modal fade" id="editStudentModal{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editStudentModalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStudentModalLabel{{ $item->id }}">Edit Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('student') }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="studentID">StudentID</label>
                        <input type="text" name="studentID" id="studentID" class="form-control"
                            value="{{ $item->studentID }}" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $item->name }}"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control" value="{{ $item->email }}"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" class="form-control" value="{{ $item->address }}"
                            required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- Edit Student Modals End Here -->


<!-- Delete Modal -->
@foreach($students as $item)
<div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel{{ $item->id }}">Delete Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this student?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form method="POST" action="{{ url('/student/' . $item->id) }}" accept-charset="UTF-8">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#addStudentModal, .editStudentModal').on('shown.bs.modal', function() {
        $(this).find('input:first').focus();
    });

    $('#addStudentModal').modal('show');
});
</script>
@endpush
