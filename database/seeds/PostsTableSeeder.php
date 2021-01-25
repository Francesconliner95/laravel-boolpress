<?php

use Illuminate\Database\Seeder;
use App\Post;
use Faker\Generator as Faker;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        // $posts = config('posts');
        //
        // foreach ($posts as $post) {
        //     $new_post_object = new Post();
        //     $new_post_object->title = $post['title'];
        //     $new_post_object->description = $post['description'];
        //     $new_post_object->date = $post['date'];
        //     $new_post_object->save();
        // }



        for ($i=0; $i < 5; $i++) {
            $new_post_object = new Post();
            $new_post_object->title = $faker->word();
            $new_post_object->description = $faker->paragraph();
            $new_post_object->date = $faker->date();
            $new_post_object->save();
        }

    }
}
