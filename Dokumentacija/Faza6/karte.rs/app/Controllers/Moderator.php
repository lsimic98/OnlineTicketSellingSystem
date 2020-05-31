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

        
        /*
             $ime = $this->request->getVar('pretraziKorisnike');

         
            $userDB = new User();
            $uloga = $userDB->paginateUsers(5, $ime);
        
            $data = [
                'news' => $uloga,
                'pager' => $userDB->pager
            ];

        $this->prikaz("adminMode", ['data'=>$data,'method' =>  $this->method ,'admin'=>  $korime = $this->session->get('user')->KorIme, 'korisnici'=>$uloga]);
         
         *          */

    }
    
    
    //
        public function ukloniOglas($idOglas)
    {
            $korime = $this->session->get('user')->KorIme;
            $newsDB = new News();
            $newsDB->where('IdD',$idOglas)->where('KorIme',$korime)->delete();
            return redirect()->to(site_url('Moderator/userInfo'));
                   
        
    }
    
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
    
        
    public function ubaciOglas()
    {
            /*if(!$this->validate(
            ['ime'=>'required|min_length[1]|max_length[20]',
            'prezime'=>'required|min_length[1]|max_length[20]',
            'korime'=>'trim|required|min_length[1]|max_length[15]',
            'email'=>'trim|required|min_length[1]|max_length[50]',
            'telefon'=>'required|min_length[1]|max_length[15]',
            'brlk'=>'required|min_length[1]|max_length[9]',
            'grad'=>'required|min_length[1]|max_length[15]',
            'adresa'=>'required|min_length[1]|max_length[30]',
            'drzava' => 'required'
            ]
        ))
       return $this->objaviOglas();*/
            
            
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
    
    
    //
    
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
    

   /* public function ukloni()
    {
        $site = $_POST['favorite'];
        $role = new Role();
        $user = new User();
        $news = new News();
        foreach ($site as $moderator) {
            $role->where("KorIme", $moderator)->delete();
            $news->where("KorIme", $moderator)->delete();
            $role->where("KorIme", $moderator)->delete();

        }
        //$this->session->set_userdata('site', $site);
        $response['favorite'] = $site;

        echo json_encode($response);
    }*/
}

?>