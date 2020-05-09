<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Note;

class EveryoneNoteController extends Controller
{
    public function getAllNotes(){
        $data = Note::select('id','comment','url','evaluation','created_at')->get();
        return ['data' => $data];
    }
}
