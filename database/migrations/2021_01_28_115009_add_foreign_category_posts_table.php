<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//con questa migration PONTE andiamo a gestire la relazione tra due tabelle 'post' e 'categories', successivamente andremo ad agire anche nei rispettivi Model Post e Category (App/Providers/Post.php e App/Providers/Category.php)

class AddForeignCategoryPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    //creiamo relazione
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {

            //creo colonna
            //UnsignedBigInteger deve essere obligatoriamente dello stesso tipo della key di riferimento
            //nullable perchè la categiria potrebbe anche non esserci 'NULL'
            //after('slug') questa colonna 'category_id' sarà posizionata dopo dopo la colonna 'slug'
            $table->unsignedBigInteger('category_id')->nullable()->after('slug');

            //creo vincolo
            //foreign('category_id') specifichiamo che la colonna 'category_id' è una foreign key (quindi una ciave che ci collegherà ad un'altra tabella)
            //on('categories') la tabella a cui ci collegheremo sarà la tabella 'categories'
            //references('id') attraverso la colonna 'id'
            //onDelete('set null') in caso viene eliminato il valore nella cella diventa 'NULL' di default
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    //eliminiamo relazione
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {

            //elimino vincolo
            //per prima cosa andiamo a rimuovere il vincolo tra le tabelle 'posts' e 'category'
            //'posts' tabella in cui è presente il vincolo
            //category_id (il vincolo) la colonna che crea il collegamento
            //foreign nome fisso
            $table->dropforeign('posts_category_id_foreign');

            //elimino colonna
            $table->dropColumn('category_id');
        });
    }
}
