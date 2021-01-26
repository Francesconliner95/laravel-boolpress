<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            //definisco la tipologia di dati che la mia tabella dovrà memorizzare
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('slug')->unique();//creiamo una colonna 'slug' nella tabella che conterrà parzialmente(la parte finale) il link per la pagina del post selezionato
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
