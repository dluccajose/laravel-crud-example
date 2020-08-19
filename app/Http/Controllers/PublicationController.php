<?php

namespace App\Http\Controllers;

use App\Publication;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // Todas las publicaciones
        $publications = Publication::all();


        return view('publications.showAll', compact('publications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // Formulario para nueva publicacion
        return view('publications.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        
        // Validar datos
        $validData = $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);
 
        
        // Creamos una publicacion
         $publication = new Publication();
         $publication->title = $request['title'];
         $publication->content = $request['content'];
         $publication->user_id = $request->user()->id;
 
        
         // Guardamos la publicacion en la base de datos
         $publication->save();
 
        
         return redirect()->route('publications.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function show(Publication $publication, Request $request)
    {

        $canPostComment = true;

        
        // Si el usuario ya dejo un comentario en la publicacion, no podra dejar otro.
        foreach ($publication->comments as $comment) {
            if($comment->user->id == $request->user()->id) {
                $canPostComment = false;
            }
        }


        return view('publications.show', compact('publication', 'canPostComment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function edit(Publication $publication)
    {

        // Formulario para editar publicacion
        return view('publications.edit', compact('publication'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Publication $publication)
    {

        // Validar datos
        $validData = $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);
 
        
        // Modificamos la publicacion
         $publication->title = $request['title'];
         $publication->content = $request['content'];
 
        
         // Guardamos la publicacion en la base de datos
         $publication->save();
 
        
         return redirect()->route('publications.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publication $publication)
    {
        
        // Eliminar publicacion de la base de datos
        $publication->delete();


        return redirect()->route('publications.index');
    }
}
