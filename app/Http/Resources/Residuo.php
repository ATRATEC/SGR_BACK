<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Residuo extends Resource
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
            'codigo' => $this->codigo,
            'descricao' => $this->descricao,
            'id_classe' => $this->id_classe,
            'descricao_classe' => $this->classe_residuo()->first()->descricao,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
        //return parent::toArray($request);
    }
}
