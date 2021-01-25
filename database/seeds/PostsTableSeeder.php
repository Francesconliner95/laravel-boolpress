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
            $new_post_object->title = $faker->word(); //word() parola chiave che utilizza il faker per generare parole
            $new_post_object->description = $faker->paragraph();//paragraph() parola chiave che utilizza il faker per generare paragrafi
            $new_post_object->date = $faker->date();
            //date() parola chiave che utilizza il faker per generare date
            $new_post_object->save();
        }

    }
}
