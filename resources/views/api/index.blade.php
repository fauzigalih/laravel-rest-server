@extends('layouts.main')
@section('title', 'API')
@section('content')
  @include('layouts.alert')
  <h1 class="mb-4">API</h1>
  <p>In using this API Service you must get a Key first. To get it you can do it below. But before that you have to create data on the Home menu, so that the email can be used to generate keys.</p>
  {!! Form::open(['url' => 'api', 'method' => 'POST']) !!}
    <div class="form-group">
      {!! Form::label('email', 'Email Address') !!}
      {!! Form::email('email', $model->email ?? null, ['class' => 'form-control']) !!}
      @error('email')
        <small class="form-text text-danger">{{ $message }}</small>
      @enderror
      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
      {!! Form::label('action', 'Action') !!}
      <div class="d-flex">
        <div class="form-check mr-3">
          {!! Form::checkbox('action[]', 'create', false, ['class' => 'form-check-input']) !!}
          {!! Form::label('create', 'Create', ['class' => 'form-check-label']) !!}
        </div>
        <div class="form-check mr-3">
          {!! Form::checkbox('action[]', 'read', false, ['class' => 'form-check-input']) !!}
          {!! Form::label('read', 'Read', ['class' => 'form-check-label']) !!}
        </div>
        <div class="form-check mr-3">
          {!! Form::checkbox('action[]', 'update', false, ['class' => 'form-check-input']) !!}
          {!! Form::label('update', 'Update', ['class' => 'form-check-label']) !!}
        </div>
        <div class="form-check mr-3">
          {!! Form::checkbox('action[]', 'delete', false, ['class' => 'form-check-input']) !!}
          {!! Form::label('delete', 'Delete', ['class' => 'form-check-label']) !!}
        </div>
      </div>
      @error('action')
        <small class="form-text text-danger">{{ $message }}</small>
      @enderror
    </div>
    {!! Form::button('<i class="fa fa-key" aria-hidden="true"></i> Generate Key', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
  {!! Form::close() !!}

  <h3 class="mt-4">How to use</h3>
  <p>Use the url below to access the api service.</p>
  <div class="alert alert-info" role="alert">
    http://<strong>base_url</strong>/api/dev
  </div>
  <p>Replace <strong>base_url</strong> according to your local server.</p>
  <p>In my case, I use <strong>php artisan serve</strong> on a laravel project to create a development server or base_url, it will get the following url.</p>
  <div class="alert alert-info" role="alert">
    http://127.0.0.1:8000/api/dev
  </div>
  <p class="text-muted">Note: maybe every device is different in making a development server for the above case, so readjust it to your conditions.</p>

  <h4 class="mt-4">Create</h4>
  <p>This action use to create data user.</p>
  <p>You need Variable: key, name, email, phone.</p>
  <img src="{{ asset('img/create.jpg') }}" alt="">

  <h4 class="mt-4">Read</h4>
  <p>This action use to read data user.</p>
  <h6>1. If you want to see all the data user</h6>
  <p>You need Variable: key.</p>
  <img src="{{ asset('img/read1.jpg') }}" alt="">
  <h6>2. If you want to see specific the data user</h6>
  <p>You need Variable: key, id.</p>
  <img src="{{ asset('img/read2.jpg') }}" alt="">

  <h4 class="mt-4">Update</h4>
  <p>This action use to update data user.</p>
  <p>You need Variable: key, id, name, email, phone.</p>
  <img src="{{ asset('img/update.jpg') }}" alt="">

  <h4 class="mt-4">Delete</h4>
  <p>This action use to update data user.</p>
  <p>You need Variable: key, id.</p>
  <img src="{{ asset('img/delete.jpg') }}" alt="">

  <h3 class="mt-5">Keywords</h3>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Request</th>
        <th scope="col">Description</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">1</th>
        <td>key</td>
        <td>The key is required to access a api service. This is a must use.</td>
      </tr>
      <tr>
        <th scope="row">2</th>
        <td>id</td>
        <td>The id is identity of each record in the database.</td>
      </tr>
      <tr>
        <th scope="row">3</th>
        <td>name</td>
        <td>The name is variables used for create and update.</td>
      </tr>
      <tr>
        <th scope="row">4</th>
        <td>email</td>
        <td>The email is variables used for create and update.</td>
      </tr>
      <tr>
        <th scope="row">5</th>
        <td>phone</td>
        <td>The phone is variables used for create and update.</td>
      </tr>
    </tbody>
  </table>
@endsection