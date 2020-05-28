<?php namespace App\Controllers;
use App\Models\User;
use App\Models\News;
use App\Models\Role;
use App\Models\Roles;
class Korisnik extends BaseController
{
    protected function prikaz($page, $data)
    {
      $data['controller']='Korisnik';
      $data['user']=$this->session->get('user');
      echo view('Prototip/header_kor', $data);
      echo view("Prototip/$page", $data);
      echo view("Prototip/footer", $data);

    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(site_url('/'));
    }
    
   /* public function userInfo()
    {
        $newsDB = new News();
        $korime = $this->session->get('user')->KorIme;
        $news = $newsDB->where('KorIme',$korime)->findAll();
        $this->method='userInfo';
        
        $this->prikaz('user',['method'=>$this->method, 'news'=>$news, 'uloga'=>$this->session->get('user')->Opis]);
    
    }*/
    
    public function ukloniOglas($idOglas)
    {
            $korime = $this->session->get('user')->KorIme;
            $newsDB = new News();
            $newsDB->where('IdD',$idOglas)->where('KorIme',$korime)->delete();
            return redirect()->to(site_url('Korisnik/userInfo'));
                   
        
    }
    
    public function urediProfil()
    {
        
        $naslov = 'Uredi profil';
        $this->method = 'userInfo';
        $poruka = '';
        $this->prikaz("forma", ['poruka'=>$poruka, 'method'=>$this->method, 'naslov'=>$naslov, 'korisnik'=>$this->session->get('user')]);
                     
    }
    
    public function azurirajProfil()
    {
        $nil = null;
        $this->method = 'userInfo';
        $userDB = new User();

        if(!$this->validate(
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
        )

        ) return $this->prikaz('forma', ['naslov'=>'Uredi profil' ,'errors'=>$this->validator->listErrors(), 'method'=>$this->method, 'korisnik'=>$this->session->get('user')]);
        
            $korisnik=null;
            
            
            
            
            if($this->request->getVar("email")!=$this->session->get('user')->Email)
                $korisnik = $userDB->where('Email', $this->request->getVar("email"))->find();
            
            if($korisnik==null && $this->request->getVar("lozinka")==$this->session->get('user')->Sifra && $this->request->getVar("ponlozinka")!=null){
                $userDB->where('KorIme', $this->session->get('user')->KorIme);
                
                $userDB->set(
                [
                    'Ime'=>$this->request->getVar("ime"),
                    'Prezime'=>$this->request->getVar("prezime"),
                    //'KorIme'=>$this->request->getVar("korime"),
                    'Email'=>$this->request->getVar("email"),
                    'Sifra'=>$this->request->getVar("ponlozinka"),
                    'Telefon'=>$this->request->getVar("telefon"),
                    //'JMBG'=>$this->request->getVar("jmbg"),
                    'BRLK'=>$this->request->getVar("brlk"),
                    'Grad'=>$this->request->getVar("grad"),
                    'Adresa'=>$this->request->getVar("adresa"),
                    'Drzava' => $this->request->getVar("drzava")
                ]
                );
                 $userDB->update();
                 return $this->logout();
            }
            else if($korisnik==null && $this->request->getVar("lozinka")==null && $this->request->getVar("ponlozinka")==null)
            {
                $userDB->where('KorIme', $this->session->get('user')->KorIme);
                
                $userDB->set(
                [
                    'Ime'=>$this->request->getVar("ime"),
                    'Prezime'=>$this->request->getVar("prezime"),
                    'Email'=>$this->request->getVar("email"),
                    'Telefon'=>$this->request->getVar("telefon"),
                    'BRLK'=>$this->request->getVar("brlk"),
                    'Grad'=>$this->request->getVar("grad"),
                    'Adresa'=>$this->request->getVar("adresa"),
                    'Drzava' => $this->request->getVar("drzava")
                ]
                );
                 $userDB->update();
                 
                 
                 /*$db= \Config\Database::connect();
                 $builder = $db->table('Ima_ulogu');
                 $builder->select('*')
                 ->join('Korisnik', 'Korisnik.KorIme=Ima_ulogu.KorIme', 'left') 
                 ->join('Uloga', 'Uloga.Idu=Ima_ulogu.Idu', 'left')
                 ->where('Korisnik.KorIme', $this->session->get('user')->KorIme);
                 $user = $builder->get()->getFirstRow();
                 $this->session->set('user', $user);*/
                 
                 $this->session->set('user', $userDB->uzmiKorisnika($this->session->get('user')->KorIme));
                 return $this->userInfo();
                
            }
            else
            {
                 $this->method = 'userInfo';
                 return $this->prikaz('forma', ['method'=>$this->method, 'naslov'=>'Uredi profil', 'korisnik'=>$this->session->get('user')]);
            }
        }
        
    public function objaviOglas()
    {
        $naslov = 'Objavljivanje oglasa';
        $this->method='dodajOglas';
        $news = null;
        $this->prikaz('dodajOglas',['method'=>$this->method, 'news'=>$news, 'naslov'=>$naslov]);
          
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
                return redirect()->to(site_url('Korisnik/userInfo'));
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
             
             
             return redirect()->to(site_url('Korisnik/userInfo'));
           
             
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
             
             
             return redirect()->to(site_url('Korisnik/userInfo'));
        
        
    }
        
        
        
        //Perin'o
        
        
        
        
   
    
    public function kupi()
    {


        if (isset($_SESSION['korpa']) && count($_SESSION['korpa']) > 0 && $this->validate(['brkartice'=>'required' , 'mesec'=>'required' , 'god'=>'required' ,  'cvc'=>'required']))
        {
            $newsDB = new News();
            $usersDB = new User();
            /*$korime = $this->session->get('user')->KorIme;
            $korisnik = $usersDB->where('KorIme', $korime)->find();*/

            $iddog = [];
            foreach ($_SESSION['korpa'] as $key => $value)
                array_push($iddog, $key);

            $news = $newsDB->findid($iddog);

            $suma = 0;

            $maxid = 0;
            $transakcijaDB = new Transakcija();
            $row = $transakcijaDB->selectMax("IdT");
            if(isset($row)) $maxid = $row->IdT;
            $maxid++;

            $stavka = new Stavka();
            foreach ($news as $dog)
            {
                $id = $dog->IdD;

                $s_data['IdD'] = $id;
                $s_data['Cena'] = $dog->Cena;
                $s_data['Kolicina'] = $_SESSION['korpa'][$id];
                $s_data['IdT'] = $maxid;
                $stavka->insert($s_data);
                //array_push($stavke, $s_data);

                $suma += $dog->Cena * $_SESSION['korpa'][$id];
            }
            $brkartice = $_POST['brkartice'];




            $transakcijaDB->insert(
                [
                    'Cena' => $suma,
                    'BrojKartice' => $brkartice,
                    'KorIme' => $this->session->get('user')->KorIme
                ]

            );
            
            $this->korpa();
            //$this->prikaz("index", []);

        }
        else
            return $this->prikaz('korpa' ,['errors'=>"greska"]);
    }
     
      



    
   
    //--------------------------------------------------------------------

}
