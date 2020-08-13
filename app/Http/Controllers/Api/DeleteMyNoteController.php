<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Note;

class DeleteMyNoteController extends Controller
{
    public function deleteNote(Request $request){
        $this->userCertification();
        $this->noteCertification($request->noteData["user_id"]);
        $this->delete($request);
        return ;
    }

    public function userCertification(){
        if(!Auth::user()){
            return redirect('/');
        }
    }
    public function noteCertification($user_id){
        if(!Auth::id() === $user_id){
            return redirect('/');
        }
    }

    public function delete($request){
        return Note::where('id',$request->noteData["id"])->delete();
    }

}
