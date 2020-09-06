<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Note;

class EveryoneNoteController extends Controller
{
    public function getAllNotes(){
        $data = Note::with([
            'favoriteNotes' => function($query) {
                $query->where('user_id', Auth::id());
            }
        ])
        ->select('id','title','comment','url','evaluation','created_at')
        ->get();
        return ['data' => $data];
    }

    public function getAllFavoriteNotes(){
        $data = Note::whereHas('favoriteNotes',function($query){
            $query->where('user_id',Auth::id());
        })->with([
            'favoriteNotes' => function($query) {
                $query->where('user_id', Auth::id());
            }
        ])->get();
        return ['data' => $data];
    }

}
