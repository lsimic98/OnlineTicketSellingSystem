<?php namespace App\Controllers;

use App\Models\User;
use App\Models\News;
use App\Models\Role;
use App\Models\Roles;

class Moderator extends Korisnik{

    protected function prikaz($page, $data)
    {
        $data['controller']='Moderator';
        $data['user']=$this->session->get('user');
        echo view('Prototip/header_moderator', $data);
        echo view("Prototip/$page", $data);
        echo view("Prototip/footer", $data);

    }
    
    public function moderatorMode()
    {
        $this->method = 'dodajOglas';
        $newsDB = new News();
        $news = $newsDB->oglasi(5);
        $data = [
            'news' => $news,
            'pager' => $newsDB->pager
        ];

        $this->prikaz("moderatorOglasi", ['data'=>$data,'method' =>  $this->method ,'admin'=>  $korime = $this->session->get('user')->KorIme, 'oglasi'=>$news]);


    }
     /**
     * Funkcija za pretragu registrovanih korsinika
     *
     * @return void
     */
     public function pretragaOglasa()
    {
        $ime = $this->request->getVar('pretraziKorisnike');
        if($ime==null)
            $ime="";
        $this->method = 'dodajOglas';
        $newsDB = new News();
        $news = $newsDB->pretragaOglasa(5,$ime);
        $data = [
            'news' => $news,
            'pager' => $newsDB->pager
        ];

        $this->prikaz("moderatorOglasi", ['data'=>$data,'method' =>  $this->method ,'admin'=>  $korime = $this->session->get('user')->KorIme, 'oglasi'=>$news]);

    }
    
    
        /**
     * Funkcija za oglasa iz baze
     *
	 * @param id $idOglas  Oglas se dohvata uz pomoc parametra funkcije
     * @return void
     */
        public function ukloniOglas($idOglas)
    {
            $korime = $this->session->get('user')->KorIme;
            $newsDB = new News();
            $newsDB->where('IdD',$idOglas)->where('KorIme',$korime)->delete();
            return redirect()->to(site_url('Moderator/userInfo'));
                   
        
    }
	
    /**
     * Funkcija za prikaz odredjenog oglasa iz baze
     *
	 * @param id $idOglas  Oglas se dohvata uz pomoc parametra funkcije
     * @return void
     */
    public function izmeniOglas($idOglas)    //Moderator i Admin mogu da edituju i brisu sve oglase
    {
        
        $naslov = 'Izmena oglasa';
        $korime = $this->session->get('user')->KorIme;

            $newsDB = new News();
            $news = $newsDB->where('KorIme',$korime)->where('IdD',$idOglas)->find();
            if($news!=null)
            {
                $this->method='dodajOglas';
                $this->prikaz('dodajOglas',['method'=>$this->method, 'news'=>$news, 'naslov'=>$naslov]);
            }
            else
            {
                return redirect()->to(site_url('Moderator/userInfo'));
            }        
        
    }
        /**
     * Funkcija za dodavanje oglasa u bazi
     *
	 * 
     * @return void
     */
        
    public function ubaciOglas()
    {        
           $slika = file_get_contents($_FILES['slika']['tmp_name']);           
           $date = $this->request->getVar("datum") ." ". $this->request->getVar("vreme");
           $date = date_create($date);
           $date = date_format($date, 'Y-m-d H:i:s');
           
  
            $news = new News();   
             $news->insert(
                [
                    'Naziv'=>$this->request->getVar("naziv"),
                    'Cena'=>$this->request->getVar("cena"),
                    'Datum'=>$date,
                    'Lokacija'=>$this->request->getVar("lokacija"),
                    'Slika'=> $slika,
                    'Tip'=>"O",
                    'BrojKarata'=>$this->request->getVar("brojkarata"),
                    'KorIme'=>$this->session->get('user')->KorIme,
                    'Status'=>"N"
                ]
                );
             
             
             return redirect()->to(site_url('Moderator/userInfo'));
           
             
        }
    
	 /**
     * Funkcija za izmenu oglasa u bazi (Update)
     *
	 * @param id $idOglas  Oglas se dohvata uz pomoc parametra funkcije
     * @return void
     */
    public function azurirajOglas($IdD) 
    {     
        $news = new News();
        $date = $this->request->getVar("datum") ." ". $this->request->getVar("vreme");
        $date = date_create($date);
        $date = date_format($date, 'Y-m-d H:i:s');
        
        if($_FILES['slika']['tmp_name']!=null)
        {
            $slika = file_get_contents($_FILES['slika']['tmp_name']);  
            $news->where('IdD',$IdD);
            $news->set(
                [
                    
                    'Naziv'=>$this->request->getVar("naziv"),
                    'Cena'=>$this->request->getVar("cena"),
                    'Datum'=>$date,
                    'Lokacija'=>$this->request->getVar("lokacija"),
                    'Slika' => $slika,
                    'Tip'=>"O",
                    'BrojKarata'=>$this->request->getVar("brojkarata"),
                    'KorIme'=>$this->session->get('user')->KorIme,
                    'Status'=>"N"
                ]
            );
            $news->update();
        }
        else 
        {
            $news->where('IdD',$IdD);
            $news->set(
                [
                    
                    'Naziv'=>$this->request->getVar("naziv"),
                    'Cena'=>$this->request->getVar("cena"),
                    'Datum'=>$date,
                    'Lokacija'=>$this->request->getVar("lokacija"),
                    'Tip'=>"O",
                    'BrojKarata'=>$this->request->getVar("brojkarata"),
                    'KorIme'=>$this->session->get('user')->KorIme,
                    'Status'=>"N"
                ]
            );
            $news->update();
            
            
        }
             
             
             return redirect()->to(site_url('Moderator/userInfo'));
        
        
    }
    
    
     /**
     * Funkcija za brisanje oglasa iz baze. Poziva se unutar AJAX-a.
     *
	 *
     * @return void
     */
    
    public function obrisiOglas()
    {
        $oglasi = $_POST['favorite'];
        $newsDB = new News();
        foreach ($oglasi as $oglas)
        {
            $newsDB->where("IdD", $oglas)->delete();
        }
        $response['favorite'] = $oglasi;

        echo json_encode($response);

    }
	  /**
     * Funkcija za menjanje statusa oglasa u bazi . Poziva se unutar AJAX-a.
     *
	 *
     * @return void
     */
    public function promeniStatus()
    {
        echo var_dump($_POST['favorite']);
        $oglasi = $_POST['favorite'];
        $newsDB = new News();
        foreach ($oglasi as $oglas)
        {
            $newsDB->where("IdD", $oglas);
            $newsDB->set(
                [
                    "Status"=>"A"
                ]
            );
            $newsDB->update();
        }
        $response['favorite'] = $oglasi;

        echo json_encode($response);
        
       

    }
   
}

?>