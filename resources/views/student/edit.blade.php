@extends('layouts.master')

@section('title')
    <title>admin - edit</title>
@endsection

@section('content')
<h1 class="mt-4">Edit</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/courses">Courses</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
<div class="row">
    <div class="col-md-6">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Students</h3>

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
            <form action="{{route('students.update', $students['id'])}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="{{$students['name']}}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" value="{{$students['email']}}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="inputCourses">Students</label>
                            <select name="course" class="form-control custom-select">
                            @foreach($courses as $course)
                                <option value="{{ $course['id'] }}">{{$course['name']}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <a href="{{url('/students')}}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-success float-right">Update student</button>
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
      <input type="submit" value="Create new Porject" class="btn btn-success float-right">
    </div>
  </div> --}}
@endsection