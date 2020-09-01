<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Note;

class MyNoteController extends Controller
{
    public function getMyNotes(){
        $user_id = Auth::id();
        $data = Note::where('user_id',$user_id)->with('favoriteNotes')->get();
        return ['data' => $data];
    }
}
