<div class="media">
  <div class="media-left">
    <a href="#">
      <img class="media-object" src="{{ $user->getAvatarURL() }}" alt="{{ $user->getNameOrUsername() }}">
    </a>
  </div>
  <div class="media-body">
    <a href="{{ route('profile.index', [$user->username]) }}"><h4 class="media-heading">{{ $user->getNameOrUsername() }}</h4></a>
    @if($user->location)
        {{ $user->location }}
    @endif
  </div>
</div>
