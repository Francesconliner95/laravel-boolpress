<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=[
            'posts' => Post::all()
        ];
        return view('admin.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //la funzione store si passa di default il parametro $request che conterrà i dati da noi inseriti nel form, $request->all() con questo comando andiamo a memorizzare tutti i dati inseriti all'interno della variabile $data
        $data = $request->all();

        //creiamo una nuova classe Post(che prende dal Model Post.php che comunica con il nostro Database)
        $new_post = new Post();

        //METODO 2
        //passiamo al database direttamente tutti i parametri grazie al comando fill, pero dobbiamo ricordarci di andare a specificare all'interno del nostro Model Post.php solo i parametri che ci interessano, perchè insieme passa anche il token @csrf che non ci serve
        $new_post->fill($data);

        //ora possiamo memorizzare i nostri dati sul database
        $new_post->save();

        //quando ha finito di salvare, automaticamente reindirizza la pagina in post.index. Reindirizziamo la pagina non appena vengono memorizzati i dati perchè in caso contrario  restando sulla stessa, basterebbe aggiornare la pagina per ricaricare gli stessi dati nel database occupando la riga successiva e cosi via
        return redirect()->route('admin.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $data = [
            'post'=>$post
        ];

        return view('admin.posts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $data = [
            'post'=>$post
        ];

        return view('admin.posts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //la funzione update si passa di default il parametro $request che conterrà i dati da noi inseriti nel form grazie al fatto che abbiamo specificato il @method('POST'), $request->all() con questo comando andiamo a memorizzare tutti i dati inseriti all'interno della variabile $data
        $data=$request->all();

        //dopo di che attraverso il comando update andiamo a dire di sostituire e salvare direttamente i nuovi dati ($data) all'interno della riga selezionata $post (ovvero la classe Post corrente)
        $post->update($data);

        //successivamente reindirizzo la pagina nella sezione show del record modificato ['post' => $post->id], in modo da poterne visualizzare le modifiche salvate
        return redirect()->route('admin.posts.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //attraverso la funzione delete mi va ad eliminare direttamente la riga nel database
        $post->delete();

        //successivamente reindirizzo la pagina nella sezione index, in modo da poter visualizzare le lista dei record aggiornata, ovvero senza la riga corrente
        return redirect()->route('admin.posts.index');
    }
}
