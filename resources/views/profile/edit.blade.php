@extends('template.template')
@section('title', 'Update Your Profile')



@section('content')

    <div class="col-lg-6">
        <h2>Update Profile</h2>
        {{Form::open( array(
            'route' =>  'profile.edit',
            'class' =>  'form-vertical',
        ) )}}


        <div class="form-group {{ $errors->has('firstname') ? 'has-error' : '' }}">
            {{Form::label('username', 'Username')}}
            {{Form::text('username', Auth::user()->username , array(
                'class' =>  'form-control',
                'id'    =>  'firstname',
                'placeholder'   =>  'username',
                'disabled',
            ))}}

            <!-- show errors -->
            @if($errors->has('username'))
                <span class="help-block">{{ $errors->first('username') }}</span>
            @endif
        </div>


        <div class="row">
            <div class="col-lg-6">
                <div class="form-group {{ $errors->has('firstname') ? 'has-error' : '' }}">
                    {{Form::label('firstname', 'First Name')}}
                    {{Form::text('firstname', Auth::user()->firstname ? : Request::old('firstname') , array(
                        'class' =>  'form-control',
                        'id'    =>  'firstname',
                        'placeholder'   =>  'first name',
                    ))}}

                    <!-- show errors -->
                    @if($errors->has('email'))
                        <span class="help-block">{{ $errors->first('email') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group {{ $errors->has('lastname') ? 'has-error' : '' }}">
                    {{Form::label('lastname', 'Last Name')}}
                    {{Form::text('lastname',  Request::old('lastname') ?: Auth::user()->lastname , array(
                        'class' =>  'form-control',
                        'id'    =>  'lastname',
                        'placeholder'   =>  'last name',
                    ))}}

                    <!-- show errors -->
                    @if($errors->has('lastname'))
                        <span class="help-block">{{ $errors->first('lastname') }}</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            {{Form::label('email', 'Choose your Email Address')}}
            {{Form::text('email', Auth::user()->email , array(
                'class' =>  'form-control',
                'id'    =>  'email',
                'placeholder'   =>  'Enter Email Address',
            ))}}

            <!-- show errors -->
            @if($errors->has('email'))
                <span class="help-block">{{ $errors->first('email') }}</span>
            @endif
        </div>


        <div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
            {{Form::label('location', 'Location')}}
            {{Form::text('location',  Auth::user()->location ?: Request::old('location')   , array(
                'class' =>  'form-control',
                'id'    =>  'location',
                'placeholder'   =>  'Dhaka, Bangladesh',
            ))}}

            <!-- show errors -->
            @if($errors->has('location'))
                <span class="help-block">{{ $errors->first('location') }}</span>
            @endif
        </div>

        <input type="hidden" name="_token" value="{{ Session::token() }}" />

        <div class="form-group">
            {{Form::submit('Update Profile', array(
                'class' =>  'btn btn-success',
            ))}}
        </div>
        {{ Form::close() }}
    </div>
@endsection
