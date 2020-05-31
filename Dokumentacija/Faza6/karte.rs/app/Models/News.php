<?php namespace App\Models;

use CodeIgniter\Model;

class News extends Model
{
    protected $table      = 'dogadjaj';
    protected $primaryKey = 'IdD';
    protected $returnType = 'object';
    
     protected $allowedFields = ['IdD', 'Naziv', 'Cena', 'Datum', 'Lokacija', 'Slika', 'Tip', 'Opis', 'BrojKarata', 'KorIme', 'Odobrio', 'Status', 'Telefon'];


   /* public function pretraga($tekst) {
        return $this->where('Tip','M')->like('Naziv', $tekst)
            ->orLike('Opis', $tekst)->findAll();
    }
    */
    public function findid($iddog) {
        return $this->whereIn('idD', $iddog)->findAll();
    }
    
   
      public function pretraga(int $perPage, string $ime="")
      {
          
          $pager = \Config\Services::pager(null, null, false);
          $page = $pager->getCurrentPage('default');
          
            $query = $this->where('Tip','M')->like('Naziv', $ime)
            ->orLike('Opis', $ime)->where('Tip','M');
          
          
          $total = $query->countAllResults(false);
          $this->pager = $pager->store('default', $page, $perPage, $total, 0);
          $offset = ($page - 1) * $perPage;
          
          return $query->findAll($perPage, $offset);
          
      }
      
      public function oglasi(int $perPage) {
          
          $pager = \Config\Services::pager(null, null, false);
          $page = $pager->getCurrentPage('default');
          
          $query = $this->where('Tip','O');//->where('Status','O');
          
          
          $total = $query->countAllResults(false);
          $this->pager = $pager->store('default', $page, $perPage, $total, 0);
          $offset = ($page - 1) * $perPage;
          
          return $query->orderBy('Status','DESC')->findAll($perPage, $offset);       
      }
      
        public function manifestacije(int $perPage) {
          
          $pager = \Config\Services::pager(null, null, false);
          $page = $pager->getCurrentPage('default');
          
          $query = $this->where('Tip','M');//->where('Status','O');
          
          
          $total = $query->countAllResults(false);
          $this->pager = $pager->store('default', $page, $perPage, $total, 0);
          $offset = ($page - 1) * $perPage;
          
          return $query->findAll($perPage, $offset);       
      }
      
      
           public function pretragaOglasa(int $perPage, string $ime="")
      {
          
           $pager = \Config\Services::pager(null, null, false);
          $page = $pager->getCurrentPage('default');
          
            $query = $this->where('Tip','O')->like('Naziv', $ime)
                    ->orLike('Opis', $ime)->where('Tip','O');
          
          
          $total = $query->countAllResults(false);
          $this->pager = $pager->store('default', $page, $perPage, $total, 0);
          $offset = ($page - 1) * $perPage;
          
          return $query->orderBy('Status','DESC')->findAll($perPage, $offset);
  
      }
      
    
}