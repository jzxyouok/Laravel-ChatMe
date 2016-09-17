@extends('template.template')
@section('title', 'Timeline')



@section('content')
    <div class="row">
        <div class="col-lg-6">
            {{ Form::open( array(
                    'route' =>  'status.post',
                    'class' =>  'form-vertical',
                    'role'  =>  'form',
                    'method'    =>  'post',
            )
            )}}
                <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
                    <label for="exampleInputEmail1">Update Status</label>
                    {{ Form::label('status', 'Update Status') }}
                    {{ Form::textarea('status', null, array(
                        'class' =>  'form-control',
                        'placeholder'   =>  'Whats on your mind...',
                        'rows'  =>  3,
                    )) }}

                    @if($errors->has('status'))
                        <span class="help-block">{{ $errors->first('status')}}</span>
                    @endif
                </div>

                {{ Form::submit('Update Status', array(
                        'class' =>'btn btn-info',
                )) }}
            </form>
            <hr />
        </div>
    </div>


    <div class="row">
        <div class="col-lg-6">
            <!-- TImeline Status & replies -->
            @if(! $statuses->count())
                <p>
                    There is nothing in your timeline, yet.
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
                                <li>{{ $status->created_at->diffForHumans() }}

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
                                            </li><a href="{{ route('status.like', ['statusID' => $status->id ])}}">Like</a></li>

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

                        </div>
                    </div>
                    <hr />
                @endforeach

                {{ $statuses->render() }}
            @endif
        </div>
    </div>
@endsection
