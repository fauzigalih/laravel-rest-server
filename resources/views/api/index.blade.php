@extends('layouts.main')
@section('title', 'API')
@section('content')
  @include('layouts.alert')
  <h1>API</h1>
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
@endsection