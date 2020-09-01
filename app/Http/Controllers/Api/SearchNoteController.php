<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Note;

class SearchNoteController extends Controller
{
    public function searchNote(Request $request){
        $this->certification();
        $searchWord = $request->searchWord;
        $data = Note::where(function($query) use ($searchWord){
            $query->where('title', 'LIKE', "%".$searchWord."%")
            ->orWhere('comment', 'LIKE', "%".$searchWord,"%");
        })
        ->get();
        return ['data' => $data];
    }

    public function searchMyNote(Request $request){
        $this->certification();
        $user_id = Auth::id();
        $searchWord = $request->searchWord;
        $data = Note::where('user_id',$user_id)
            ->where(function($query) use ($searchWord){
                $query->where('title', 'LIKE', "%".$searchWord."%")
                ->orWhere('comment', 'LIKE', "%".$searchWord,"%");
            })->get();
        return ['data' => $data];
    }

    public function certification(){
        if(!Auth::user()){
            return redirect('/');
        }
    }
}
