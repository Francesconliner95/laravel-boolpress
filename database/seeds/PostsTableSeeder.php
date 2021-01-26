<?php

use Illuminate\Database\Seeder;
//per utilizzare il Model Post lo dichiariamo nel seeder
use App\Post;
//per utilizzare il faker lo dichiariamo nel seeder
use Faker\Generator as Faker;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    //e lo passiamo come parametro nella funzione run assegnandogli una variabile $faker
    public function run(Faker $faker)
    {

        //Metodo con dati memorizzati in un file nella cartella config

        // $posts = config('posts');
        //
        // foreach ($posts as $post) {
        //     $new_post_object = new Post();
        //     $new_post_object->title = $post['title'];
        //     $new_post_object->description = $post['description'];
        //     $new_post_object->date = $post['date'];
        //     $new_post_object->save();
        // }

        //Metodo con dati generati in modo automatico e random dal faker
        //(faker utilizzato 'https://github.com/fzaninotto/Faker#fakerproviderlorem')

        //vogliamo generare 5 righe nel database
        for ($i=0; $i < 5; $i++) {
            //creiamo una nuova classe Post a cui assegnamo i seguenti dati
            $new_post_object = new Post();

            $new_post_object->title = $faker->sentence(); //sentence() parola chiave che utilizza il faker per generare titoli

            $new_post_object->description = $faker->text(500);//text() parola chiave che utilizza il faker per generare paragrafi

            $slug = Str::slug($new_post_object->title); //con questo comando andiamo a generare uno slug(link), che otteniamo concatenando le stringhe del titolo.

            $slug_base = $slug; //memorizziamo lo slug di partenza cosi quando andremo a modificare $slug avremo un backup

            $post_presente = Post::where('slug', $slug)->first(); //controllo attraverso il model Post che nella mia tebella posts non esista gia' uno slug uguale ( confronto where('slug', $slug) ), nel caso ne trova più di uno attraverso il comando first() specifico di prendere solo il primo.

            $contatore=1;

            //se $post_presente contiene dati entro nel ciclo, in caso contrario (NULL) lo salto.
            while($post_presente){
                //devo generare un nuovo slug valido che otteremmo concatenando allo  $slug_base un valore numerico che si incrementerà in caso già esistente
                $slug = $slug_base . '-' . $contatore;
                $contatore++;
                $post_presente = Post::where('slug', $slug)->first(); //effettuo novamente la verifica, nel caso trovo nuovamente uno slug ugale rieseguo il ciclo altrimenti vado avanti
            }

            $new_post_object->slug = $slug;//dopo essermi accertato che il mio slug non esisteva in precedenza posso assegnarelo come valore

            $new_post_object->save(); //e salvare
        }

    }
}
