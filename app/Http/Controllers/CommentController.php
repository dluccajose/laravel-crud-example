<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\Mail\CommentReceived;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        // Validar datos
        $validData = $request->validate([
            'content' => 'required',
            'publication_id' => 'required'
        ]);


        // Crear comentario
        $comment = new Comment();
        $comment->content = $request['content'];
        $comment->publication_id = $request['publication_id'];
        $comment->user_id = $request->user()->id;
        $comment->status = 'APROBADO';

        // Guardar en base de datos
        $comment->save();
        

        $emailData = [
            'content' => $comment->content,
            'publicationTitle' => $comment->publication->title
        ];


        // Enviar notificacion por correo al autor de la publicacion
        Mail::to($comment->publication->user->email)->send(new CommentReceived($emailData));

        
        // Devolver a ruta anterior
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
