<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilAcademiquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profil_academiques', function (Blueprint $table) {
            $table->id();
            $table->string('code_ue'); 
            $table->string('intitule_ue'); 
            $table->string('code_ec'); 
            $table->string('intitule_ec'); 
            $table->string('code_etape'); 
            $table->string('intitule_etape'); 
            $table->string('note_cc'); 
            $table->string('note_ex'); 
            $table->string('moyenne'); 
            $table->string('session'); 
            $table->string('decision'); 
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profil_academiques');
    }
}
