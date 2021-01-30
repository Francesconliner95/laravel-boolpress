<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


//con questa migration vado a creare la tabella PONTE (post_tag) tra le due tabelle Posts e Tags
class CreatePostTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_tag', function (Blueprint $table) {
            //creao la colonna 'post_id'
            $table->bigInteger('post_id')->unsigned();

            //creao la dipendenza tra la colonna 'post_id' (tabella Post_Tag) e la tabella Posts
            $table->foreign('post_id')->references('id')->on('posts');

            //creao la colonna 'tag_id'
            $table->bigInteger('tag_id')->unsigned();

            //creao la dipendenza tra la colonna 'tag_id' (tabella Post_Tag) e la tabella Tags
            $table->foreign('tag_id')->references('id')->on('tags');

            //dichiaro entrambe le colonne come chiavi primarie
            $table->primary(['post_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_tag');
    }
}
