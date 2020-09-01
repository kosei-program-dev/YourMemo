<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoriteNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorite_notes', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('note_id');
            // $table->foreign('note_id')->references('id')->on('notes')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favorite_notes');
    }
}
