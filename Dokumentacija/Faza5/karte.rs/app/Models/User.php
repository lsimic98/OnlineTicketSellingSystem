<?php namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table      = 'korisnik';
    protected $primaryKey = 'idK';
   protected $allowedFields = ['IdK', 'Ime', 'Prezime', 'Korime', 'Email', 'Sifra', 'Telefon', 'JMBG', 'BRLK', 'Grad', 'Adresa'];
    protected $returnType = 'object';

}