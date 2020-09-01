<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//UserとNoteの中間テーブル
class FavoriteNote extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function note()
    {
        return $this->belongsTo(Note::class);
    }
}
