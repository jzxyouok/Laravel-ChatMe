<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;


class Status extends Model{

    protected $table = 'statuses';
    protected $fillable = [
        'body'
    ];

    public function user(){
        return $this->belongsTo('App\User', 'userID');
    }

    public function scopeNotReply( $query ) {
    	return $query->whereNull('parentID');
    }

    public function replies(){
        return $this->hasMany('\App\Status', 'parentID');
    }

    public function likes(){
        return $this->morphMany('\App\Like', 'likeable');
    }
}

?>
