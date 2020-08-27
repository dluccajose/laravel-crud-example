<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/* JsonRsource

Un JsonResource nos permite convertir un modelo de nuestra aplicacion en una respuesta JSON. Actua como una capa intermedia
entre nuestra base de datos y la repuesta que otorgamos al cliente

*/

class Publication extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'comments' => $this->comments,
            'user' => $this->user
        ];
    }
}
