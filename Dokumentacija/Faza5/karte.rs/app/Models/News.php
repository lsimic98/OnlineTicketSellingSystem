<?php namespace App\Models;

use CodeIgniter\Model;

class News extends Model
{
    protected $table      = 'manifestacija';
    protected $primaryKey = 'idK';
    protected $returnType = 'object';


    public function pretraga($tekst) {
        return $this->like('Naziv', $tekst)
            ->orLike('Opis', $tekst)->findAll();
    }
}