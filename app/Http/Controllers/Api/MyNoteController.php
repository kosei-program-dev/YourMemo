<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Note;

class MyNoteController extends Controller
{
    public function getMyNotes(){
        $data = Note::where('user_id',Auth::id())->with([
            'favoriteNotes' => function($query) {
                $query->where('user_id', Auth::id());
            }
        ])
        ->select('id','title','comment','url','evaluation','created_at')
        ->get();
        return ['data' => $data];
    }
    public function getMyFavoriteNotes(){
        $data = Note::where('user_id',Auth::id())
            ->whereHas('favoriteNotes',function($query){
                $query->where('user_id',Auth::id());
            })->with([
                'favoriteNotes' => function($query) {
                    $query->where('user_id', Auth::id());
            }
        ])->get();
        return ['data' => $data];
    }


}
