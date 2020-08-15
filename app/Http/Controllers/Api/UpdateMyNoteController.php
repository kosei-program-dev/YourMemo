<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Note;

class UpdateMyNoteController extends Controller
{
    public function updateNote(Request $request){
        $target = Note::where('id',$request->noteData["id"])->first();
        $this->userCertification();
        $this->noteCertification($target);
        $this->update($request,$target);
        return ;
    }

    public function userCertification(){
        if(!Auth::user()){
            return redirect('/');
        }
    }
    public function noteCertification($target){
        if(!Auth::id() === $target->user_id){
            return redirect('/');
        }
    }

    public function update($request,$target){
        $target->title = $request->noteData["title"];
        $target->comment = $request->noteData["comment"];
        $target->url = $request->noteData["url"];
        $target->save();
        return;
    }

}
