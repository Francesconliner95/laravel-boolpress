<?php

use Illuminate\Database\Seeder;
use App\Tag;
use Faker\Generator as Faker;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 5; $i++) {
            //creiamo una nuova classe Tag a cui assegnamo i seguenti dati
            $new_tag = new Tag();

            $new_tag->name = $faker->words(3, true); //words() parola chiave che utilizza il faker per generare parole

            $slug = Str::slug($new_tag->name); //con questo comando andiamo a generare uno slug(link), che otteniamo concatenando le stringhe del name.

            $slug_base = $slug; //memorizziamo lo slug di partenza cosi quando andremo a modificare $slug avremo un backup

            $tag_presente = Tag::where('slug', $slug)->first(); //controllo attraverso il model Tag che nella mia tebella posts non esista gia' uno slug uguale ( confronto where('slug', $slug) ), nel caso ne trova più di uno attraverso il comando first() specifico di prendere solo il primo.

            $contatore=1;

            //se $tag_presente contiene dati entro nel ciclo, in caso contrario (NULL) lo salto.
            while($tag_presente){
                //devo generare un nuovo slug valido che otteremmo concatenando allo  $slug_base un valore numerico che si incrementerà in caso già esistente
                $slug = $slug_base . '-' . $contatore;
                $contatore++;
                $tag_presente = Tag::where('slug', $slug)->first(); //effettuo novamente la verifica, nel caso trovo nuovamente uno slug ugale rieseguo il ciclo altrimenti vado avanti
            }

            $new_tag->slug = $slug;//dopo essermi accertato che il mio slug non esisteva in precedenza posso assegnarelo come valore

            $new_tag->save(); //e salvare
        }
    }
}
