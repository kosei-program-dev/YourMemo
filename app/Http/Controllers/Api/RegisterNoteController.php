<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Note;

class RegisterNoteController extends Controller
{
    public function registerNote(Request $request){
        $this->certification();
        $data =[
            "user_id" => Auth::id(),
            "title"   => $request->registerData["title"],
            "comment" => $request->registerData["comment"],
            "url"     => $request->registerData["url"],
        ];
        $this->create($data);
        return ;
    }

    public function certification(){
        if(!Auth::user()){
            return redirect('/');
        }
    }
    public function create($data){
        return Note::create($data);
    }
}
