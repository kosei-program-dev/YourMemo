<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'user_id','title','comment','url'
    ];
    protected $guarded = [
        'id'
    ];
    protected $dates   = [
        'created_at'
    ];
    public function favoriteNotes()
    {
        return $this->hasOne('App\FavoriteNote');
    }
}
