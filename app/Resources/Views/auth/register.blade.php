@extends('layout.default)

@section('content')

<div class="col-md-4 col-md-offset-4">
    <div class="panel panel-info">
        <div class="panel-heading">Register</div>
        <div class="panel-body">
            {{ Form::open(array('url' => 'register')) }}
            @if($errors->any())
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </div>
            @endif
            <div class="form-group">
                {{ Form::label('first_name', 'First Name') }}
                {{ Form::text('first_name', '', array('class' => 'form-control', 'placeholder' => 'John')) }}
            </div>
            <div class="form-group">
                {{ Form::label('last_name', 'Last Name') }}
                {{ Form::text('last_name', '', array('class' => 'form-control', 'placeholder' => 'Doe')) }}
            </div>
            <div class="form-group">
                {{ Form::label('email', 'Email Address') }}
                {{ Form::text('email', '', array('class' => 'form-control', 'placeholder' => 'example@example.com', 'type' => 'email')) }}
            </div>
            <div class="form-group">
                {{ Form::label('password', 'Password') }}
                {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password')) }}
            </div>
            <div class="form-group">
                {{ Form::submit('Register', array('class' => 'btn btn-success')) }}
                {{ HTML::link('/', 'Cancel', array('class' => 'btn btn-danger')) }}
            </div>
        </div>
    </div>
</div>

@stop