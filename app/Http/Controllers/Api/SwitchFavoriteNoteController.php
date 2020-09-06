<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Note;
use App\FavoriteNote;

class SwitchFavoriteNoteController extends Controller
{
    //favorite（リレーション）があるか否か
    //→なかったらcreateで終了
    //→あるならdeleteで終了

    public function switchFavorite(Request $request){
        $target = ($request->data["favorite_notes"]);
        $this->userCertification();
        if(!$target){
            $this->create($request->data["id"]);
        } else {
            $this->delete($target["id"]);
        }
        return "ok";
    }

    public function userCertification(){
        if(!Auth::user()){
            return redirect('/');
        }
    }

    public function create($note_id){
        $new_favorite_note = new FavoriteNote;
        $new_favorite_note->user_id = Auth::id();
        $new_favorite_note->note_id = $note_id;
        $new_favorite_note->save();
        return;
    }

    public function delete($favorite_note_id){
        $target = FavoriteNote::where("id",$favorite_note_id)->first();
        if($target->user_id === Auth::id()){
            $target->delete();
            return;
        } else {
            return redirect('/');
        }
    }

}
