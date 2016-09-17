@extends('template.template')
@section('title', 'Sign up')



@section('content')

    <div class="col-lg-5">
        <h2>Registration</h2>
        {{Form::open( array(
            'route' =>  'auth.signup',
            'class' =>  'form-vertical',
            'role'  =>  'form',
        ) )}}

        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            {{Form::label('email', 'Choose your Email Address')}}
            {{Form::text('email', Request::old('email') ? : '' , array(
                'class' =>  'form-control',
                'id'    =>  'email',
                'placeholder'   =>  'Enter Email Address',
            ))}}

            <!-- show errors -->
            @if($errors->has('email'))
                <span class="help-block">{{ $errors->first('email') }}</span>
            @endif
        </div>


        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            {{Form::label('username', 'Choose your Username')}}
            {{Form::text('username', Request::old('username') ? : '' , array(
                'class' =>  'form-control',
                'id'    =>  'username',
                'placeholder'   =>  'Enter Username',
            ))}}

            <!-- show errors -->
            @if($errors->has('username'))
                <span class="help-block">{{ $errors->first('username') }}</span>
            @endif
        </div>


        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            {{Form::label('password', 'Choose your Password')}}
            {{Form::password('password', array(
                'class' =>  'form-control',
                'id'    =>  'password',
                'placeholder'   =>  'Enter Password',
            ))}}

            <!-- show errors -->
            @if($errors->has('password'))
                <span class="help-block">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <input type="hidden" name="_token" value="{{ Session::token() }}" />

        <div class="form-group">
            {{Form::submit('Create Account', array(
                'class' =>  'btn btn-primary',
            ))}}
        </div>
        {{ Form::close() }}
    </div>
@endsection
