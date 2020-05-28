<?php namespace App\Controllers;

use App\Models\User;
use App\Models\News;
use App\Models\Role;
use App\Models\Roles;

class Admin extends BaseController{

    protected function prikaz($page, $data)
    {
        $data['controller']='Admin';
        $data['user']=$this->session->get('user');
        echo view('Prototip/header_admin', $data);
        echo view("Prototip/$page", $data);
        echo view("Prototip/footer", $data);

    }


    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(site_url('/'));
    }

    public function pretragaKorisnika()
    {
        $ime = $this->request->getVar('pretraziKorisnike');

         
            $userDB = new User();
            $uloga = $userDB->paginateUsers(5, $ime);
        
            $data = [
                'news' => $uloga,
                'pager' => $userDB->pager
            ];

        $this->prikaz("adminMode", ['data'=>$data,'method' =>  $this->method ,'admin'=>  $korime = $this->session->get('user')->KorIme, 'korisnici'=>$uloga]);

    }
    public function adminMode()
    {
        $this->method = 'dodajOglas';
        $userDB = new User();
        /*$db= \Config\Database::connect();
        $builder = $db->table('Ima_ulogu');
        $builder->select('*')
            ->join('Korisnik', 'Korisnik.KorIme=Ima_ulogu.KorIme', 'left')
            ->join('Uloga', 'Uloga.Idu=Ima_ulogu.Idu', 'left')
            ->where('Uloga.Opis',"Korisnik")->orWhere("Uloga.Opis" , "Moderator");
        $uloga = $builder->get()->getResult();
        $newsDB = new News();*/
        $uloga = $userDB->paginateUsers(5);
        
        $data = [
            'news' => $uloga,
            'pager' => $userDB->pager
        ];

        $this->prikaz("adminMode", ['data'=>$data,'method' =>  $this->method ,'admin'=>  $korime = $this->session->get('user')->KorIme, 'korisnici'=>$uloga]);
    }

    public function adminOglasi()
    {
        $this->method = 'dodajOglas';
        $newsDB = new News();
        $data = [
            'news' => $newsDB->paginate(5),
            'pager' => $newsDB->pager
        ];

        $news = $newsDB->where("Tip" , "O")->findAll();
        $this->prikaz("adminOglasi", ['data'=>$data,'method' =>  $this->method ,'admin'=>  $korime = $this->session->get('user')->KorIme, 'oglasi'=>$news]);


    }
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
        $oglasi = $_POST['favorite'];
        $newsDB = new News();
        foreach ($oglasi as $oglas)
        {
            $newsDB->where("IdD", $oglas);
            $newsDB->set(
                [
                    "status"=>"A"
                ]
            );
            $newsDB->update();
        }
        $response['favorite'] = $oglasi;

        echo json_encode($response);

    }
    public function dodajModeratora()
    {
        $site = $_POST['favorite'];
        $role = new Role();
        foreach ($site as $moderator) {
            $role->where("KorIme", $moderator);
            $role->set(
                [
                    "Idu"=>2
                ]
            );
               $role->update();
               }
        //$this->session->set_userdata('site', $site);
        $response['favorite'] = $site;

        echo json_encode($response);
    }
    public function oduzmiModeratora()
    {
        $site = $_POST['favorite'];
        $role = new Role();
        foreach ($site as $moderator) {
            $role->where("KorIme", $moderator);
            $role->set(
                [
                    "Idu"=>3
                ]
            );
            $role->update();
        }
        //$this->session->set_userdata('site', $site);
        $response['favorite'] = $site;

        echo json_encode($response);
    }

    public function ukloni()
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
    }
}

?>