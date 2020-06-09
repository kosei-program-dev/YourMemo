<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;

class RegisterNoteController extends Controller
{
    public function registerNote(Request $request){
        $data =[
            "user_id" => 1,
            "title"   => $request->title,
            "comment" => $request->comment,
        ];
        $this->create($data);
        return redirect('/');
    }

    public function create($data){
        return Note::create([
            'user_id'   => $data["user_id"],
            'title'     => $data["title"],
            'comment'   => $data["comment"],
        ]);
    }
}
