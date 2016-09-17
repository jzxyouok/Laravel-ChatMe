<?php

namespace App;
use App\Status;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements AuthenticatableContract
{

    use Authenticatable;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'firstname',
        'lastname',
        'location',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function getName(){
        if( $this->firstname && $this->lastname ){
            return "{$this->firstname} {$this->lastname}";
        }

        if($this->firstname){
            return $this->firstname;
        }

        return null;
    }


    public function statuses(){
        return $this->hasMany('App\Status', 'userID');
    }

    public function likes(){
        return $this->hasMany('App\Like', 'userID');
    }

    public function getNameOrUsername(){
        return $this->getName() ? : $this->username;
    }


    public function getFirstNameOrUsername(){
        return $this->firstname ? : $this->username;
    }


    public function getAvatarURL($size = null){
        if($size){
            return "https://www.gravatar.com/avatar/{{ md5($this->email) }}?d=mm&s={$size}";
        }else{
            return "https://www.gravatar.com/avatar/{{ md5($this->email) }}?d=mm&s=50";
        }

    }


    public function friendsOfMine(){
        return $this->belongsToMany('App\User', 'friends', 'userID', 'friendID');
    }

    public function FriendOf(){
        return $this->belongsToMany('App\User', 'friends', 'friendID', 'userID');
    }

    public function friends(){
        $friendsList =
            $this->friendsOfMine()->wherePivot('accepted', true)->get()
                ->merge( $this->friendOf()->wherePivot('accepted', true )->get() );
        //dd($friendsList);
        return $friendsList;
    }
    /**
     * FRIEND REQUESTS handling
     */
    public function friendRequests(){
        return $this->friendsOfMine()->wherePivot('accepted', false)->get();
    }

    public function friendRequestsPending(){
        return $this->friendOf()->wherePivot('accepted', false)->get();
    }

    public function hasFriendRequestPending(User $user){
        return (bool) $this->friendRequestsPending()->where('id', $user->id)->count();
    }

    public function hasFriendRequestReceived(User $user){
        return (bool) $this->friendRequests()->where('id', $user->id)->count();
    }

    public function addFriend(User $user){
        return $this->friendOf()->attach($user->id);
    }

    public function acceptFriendRequest(User $user){
        return $this->friendRequests()->where('id', $user->id)->first()
                ->pivot->update([
                    'accepted' => true
            ]);
    }
    public function isFriendsWith(User $user){
        return (bool) $this->friends()->where('id', $user->id)->count();
    }

    public function hasLikesStatus(Status $status){
        return (bool) $status->likes()->where('userID', $this->id)->count();
    }

}
