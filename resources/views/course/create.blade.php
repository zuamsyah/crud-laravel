@extends('layouts.master')

@section('title')
    <title>admin - add</title>
@endsection

@section('content')
<h1 class="mt-4">Create</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/courses">Course</a></li>
        <li class="breadcrumb-item active">Create</li>
    </ol>
<div class="row">
    <div class="col-md-6">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Courses</h3>

        </div>
        <div class="card-body">
            @if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
    @endif
            <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        {{-- <div class="form-group">
                            <label for="inputStatus">Status</label>
                            <select class="form-control custom-select">
                            <option selected disabled>Select one</option>
                            <option>On Hold</option>
                            <option>Canceled</option>
                            <option>Success</option>
                            </select>
                        </div> --}}
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <a href="{{url('/courses')}}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-success float-right">Create course</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
  {{-- <div class="row">
    <div class="col-12">
      <a href="#" class="btn btn-secondary">Cancel</a>
      <input type="submit" value="Create new Course" class="btn btn-success float-right">
    </div>
  </div> --}}
@endsection