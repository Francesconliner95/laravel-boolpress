<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tag;
use App\Post;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=[
            'tags' => Tag::all()
        ];
        return view('admin.tags.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //aggiungiamo la view alla funzione create, quindi andiamo anche a creare il nuovo file create.blade.php in records
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $new_tag = new Tag();
        $slug = Str::slug($data['name']); //con questo comando andiamo a generare uno slug(link), che otteniamo concatenando le stringhe del titolo.

        $slug_base = $slug; //memorizziamo lo slug di partenza cosi quando andremo a modificare $slug avremo un backup

        $tag_presente = Tag::where('slug', $slug)->first(); //controllo attraverso il model Post che nella mia tebella posts non esista gia' uno slug uguale ( confronto where('slug', $slug) ), nel caso ne trova più di uno attraverso il comando first() specifico di prendere solo il primo.

        $contatore=1;

        //se $post_presente contiene dati entro nel ciclo, in caso contrario (NULL) lo salto.
        while($tag_presente){
            //devo generare un nuovo slug valido che otteremmo concatenando allo  $slug_base un valore numerico che si incrementerà in caso già esistente
            $slug = $slug_base . '-' . $contatore;
            $contatore++;
            $tag_presente = Tag::where('slug', $slug)->first(); //effettuo novamente la verifica, nel caso trovo nuovamente uno slug ugale rieseguo il ciclo altrimenti vado avanti
        }

        $new_tag->slug = $slug;//dopo essermi accertato che il mio slug non esisteva in precedenza posso assegnarelo come valore

        //METODO 2
        //passiamo al database direttamente tutti i parametri grazie al comando fill, pero dobbiamo ricordarci di andare a specificare all'interno del nostro Model Post.php solo i parametri che ci interessano, perchè insieme passa anche il token @csrf che non ci serve
        $new_tag->fill($data);

        //ora possiamo memorizzare i nostri dati sul database
        $new_tag->save();

        //$new_tag->tags()->sync($data['tags']);

        //quando ha finito di salvare, automaticamente reindirizza la pagina in post.index. Reindirizziamo la pagina non appena vengono memorizzati i dati perchè in caso contrario  restando sulla stessa, basterebbe aggiornare la pagina per ricaricare gli stessi dati nel database occupando la riga successiva e cosi via
        return redirect()->route('admin.tags.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {

        ##
        //se vado ad eliminare un tag presente in un post mi da errore

        //dovrei verificare in quali post è presente il tag da rimuovere, attraverso la tabella ponte

        //e rimuoverlo per ogni singolo post

        // Post::all()
        //
        // $post->tags->contains($tag)
        //
        // $tag_presente = Post::where('slug', $tag)->first();

        ##

        //attraverso la funzione delete mi va ad eliminare direttamente la riga nel database
        $tag->delete();

        //successivamente reindirizzo la pagina nella sezione index, in modo da poter visualizzare le lista dei record aggiornata, ovvero senza la riga corrente
        return redirect()->route('admin.tags.index');
    }
}
