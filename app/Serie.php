<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{

    private $id;
    private $nome;

    public $timestamps = false;
    protected $fillable = ['nome'];

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

}
