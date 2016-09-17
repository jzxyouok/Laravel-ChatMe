<nav class="navbar  navbar-inverse">
    <div class="container">
        <div class="navbar-header">
              <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
              </button>
              <a href="{{ url('/home') }}" class="navbar-brand">Zoo</a>
        </div>

        <div class="navbar-collapse collapse" id="navbar">
             @if(Auth::check())
                  <ul class="nav navbar-nav">
                      <li><a href="#">Timeline</a></li>
                      <li><a href="{{ url('/friends') }}">Friends</a></li>
                  </ul>

                  {{Form::open( array(
                      'route'   =>  'search.results',
                      'class'   =>  'navbar-form navbar-left',
                      'method'  =>  'GET',
                    ) )}}

                    <div class="form-group">
                        {{Form::text('query', null, array(
                            'class' => "form-control",
                            'placeholder'   =>  'Find People',
                        ))}}
                    </div>

                    {{Form::submit('Search', array(
                        'class' =>  'btn btn-default'
                    ))}}
                  {{Form::close()}}

              @endif


              <ul class="nav navbar-nav navbar-right">
                    @if(Auth::check())

                        <li><a href="{{ route('profile.index', ['username' => Auth::user()->username] )}}">
                            {{ Auth::user()->getNameOrUsername() }}</a></li>
                        <li><a href="{{ route('profile.edit' )}} ">Update Profile</a></li>
                        <li><a href="{{ url('signout')}}">Sign Out</a></li>
                    @else
                    <li><a href="{{ url('signup') }}">Sign Up</a></li>
                    <li><a href="{{ url('signin') }}">Sign in</a></li>
                    @endif
              </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
