<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temporada extends Model
{

    protected $fillable = ['numero'];

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }

    public function episodios()
    {
        return $this->hasMany(Episodio::class)->orderBy('numero');
    }

    public function episodiosAssistidos()
    {
//        return $this->episodios()->where('assistido', '=', true);
        return $this->episodios->filter(function (Episodio $episodio){
            return $episodio->assistido;
        });
    }

}
