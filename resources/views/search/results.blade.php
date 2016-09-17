@extends('template.template')
@section('title', 'Search Results')



@section('content')
    <h2>Search Results</h2>
    <h4>Your search for <b>"{{ Request::input('query') }}"</b></h4>
    <hr />
    <div class="row">
        <div class="col-lg-12">

            @if(!$users->count() )
            <p>
                No results found. Try again.
            </p>
            @endif

            @foreach($users as $user)
                @include('user/partials/userblock')
            @endforeach
        </div>
    </div>
@endsection
