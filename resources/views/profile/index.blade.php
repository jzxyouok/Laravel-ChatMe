    @extends('template.template')
@section('title', 'Profile')



@section('content')
    <!-- user information & status -->
    <div class="col-lg-8">
        @include('user.partials.userblock')
        <hr />

        <!-- timeline view-->
        <!-- TImeline Status & replies -->
        @if(! $statuses->count())
            <p>
                {{ $user->getFirstNameOrUsername() }} hasn't posted anything yet.
            </p>
        @else

            @foreach($statuses as $status)
                <div class="media">
                    <div class="media-left">
                        <img class="media-object" src="{{ $status->user->getAvatarURL() }}" alt="{{ $status->user->getNameOrUsername() }}">
                    </div>
                    <div class="media-body">
                        <a href="{{ route('profile.index', ['username' => $status->user->username ])}}"><h5 class="media-heading">{{ $status->user->getNameOrUsername() }}</h5></a>
                        <h4>{{ $status->body }}</h4>
                        <ul class="list-inline">
                            <li>{{ $status->created_at->diffForHumans() }}</li>
                            @if($status->user->id !== Auth::user()->id)
                            </li><a href="{{ route('status.like', ['statusID' => $status->id ]) }}">Like</a></li>

                            @endif
                            <li>{{ $status->likes->count() }} {{str_plural('like', $status->likes->count())}}</li>
                        </ul>

                        <!-- media -->
                        @foreach($status->replies as $reply)

                            <div class="media">
                                <div class="media-left">
                                    <img class="media-object" src="{{ $reply->user->getAvatarURL($size = 30) }}" alt="{{ $reply->user->getNameOrUsername() }}">
                                </div>
                                <div class="media-body">
                                    <a href="{{ route('profile.index', ['username' =>  $reply->user->username ])}}"><h5 class="media-heading">{{ $reply->user->getNameOrUsername() }}</h5></a>

                                    <h4>{{ $reply->body }}</h4>
                                    <ul class="list-inline">
                                        <li>{{ $reply->created_at->diffForHumans() }}</li>
                                        @if($reply->user->id !== Auth::user()->id)
                                        </li><a href="{{ route('status.like', ['statusID' => $status->id ]) }}">Like</a></li>

                                        @endif
                                        <li>{{ $reply->likes->count() }} {{str_plural('like', $reply->likes->count())}}</li>
                                    </ul>

                                    <div class="media">
                                        <a class="pull-left" href="#">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- media -->

                        @if($authUserIsFriend || Auth::user()->id === $status->user->id)


                            {{ Form::open( array(
                                    'route' =>  ['status.reply', 'statusID' =>  $status->id ],
                                    'class' =>  'form-vertical',
                                    'role'  =>  'form',
                                    'method'    =>  'post',
                            )
                            )}}
                                <div class="form-group {{ $errors->has('reply-' . $status->id) ? 'has-error' : ''}}">

                                    {{ Form::textarea('reply-'. $status->id, null, array(
                                        'class'         =>  'form-control',
                                        'placeholder'   =>  'Reply to this status',
                                        'rows'          =>  1,
                                    )) }}

                                    @if($errors->has('reply-' . $status->id))
                                        <span class="help-block">{{ $errors->first('reply-' . $status->id)}}</span>
                                    @endif
                                </div>

                                {{ Form::submit('Reply', array(
                                        'class' =>'btn btn-info pull-right',
                                )) }}
                            </form>
                        @endif

                    </div>
                </div>
                <hr />
            @endforeach
        @endif
    </div>

    <!-- Friend & Friend Request -->
    <div class="col-lg-4">

        @if ( Auth::user()->hasFriendRequestPending($user) )
            <p>Waiting for {{ $user->getNameOrUsername() }} to accept your request</p>

        @elseif(Auth::user()->hasFriendRequestReceived($user))
            <a href="{{ route('friend.accept', ['username' =>  $user->username] )}}" class="btn btn-info pull-right btn-request"> Accept Request</a>

        @elseif(Auth::user()->isFriendsWith($user))
            <p>
                You and {{$user->getNameOrUsername() }} are friends.
            </p>
        @elseif(Auth::user()->id !== $user->id)
            <a href="{{ route('friend.add', ['username' =>  $user->username]) }}" class="btn btn-info pull-right btn-request">Add as friend</a>
        @endif

        <h4>{{ $user->getFirstNameOrUsername() }} Friends</h4>
        @if(! $user->friends()->count())
            <p>
                {{ $user->getFirstNameOrUsername()}} has no Friends.
            </p>
        @else

            @foreach($user->friends() as $user)
                @include('user.partials.userblock')
            @endforeach


        @endif

    </div>


@endsection
