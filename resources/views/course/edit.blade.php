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
    <div class="col-md-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Courses</h3>

        </div>
        <div class="card-body">
            <form action="{{route('courses.update', $courses['id'])}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="{{$courses['name']}}" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <a href="{{url('/courses')}}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-success float-right">Update course</button>
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