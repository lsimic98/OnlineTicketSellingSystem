<?php namespace App\Controllers;
use App\Models\User;
use App\Models\News;
class Gost extends BaseController
{

    protected function prikaz($page, $data)
    {
        $data['controller']='Gost';
        echo view('Prototip/header_gost');
         echo view("Prototip/$page", $data);

    }

    public function login($poruka=null)
    {
        $this->prikaz("login", ['poruka'=>$poruka]);
    }

    public function forma($poruka=null)
    {
        $this->prikaz("forma", ['poruka'=>$poruka]);
    }

    public function registracija()
    {
        $userDB = new User();

        if(!$this->validate(
            ['ime'=>'required|min_length[1]|max_length[20]',
            'prezime'=>'required|min_length[1]|max_length[20]',
            'korime'=>'required|min_length[1]|max_length[15]',
            'email'=>'required|min_length[1]|max_length[50]',
            'lozinka'=>'required|min_length[1]|max_length[20]',
            'telefon'=>'required|min_length[1]|max_length[15]',
            'jmbg'=>'required|min_length[1]|max_length[13]',
            'brlk'=>'required|min_length[1]|max_length[9]',
            'grad'=>'required|min_length[1]|max_length[15]',
            'adresa'=>'required|min_length[1]|max_length[30]',
                ]
        )

        ) return $this->prikaz('forma', ['errors'=>$this->validator->listErrors()]);

        $userDB->save(
            [
                'Ime'=>$this->request->getVar("ime"),
                'Prezime'=>$this->request->getVar("prezime"),
                'Korime'=>$this->request->getVar("korime"),
                'Email'=>$this->request->getVar("email"),
                'Sifra'=>$this->request->getVar("lozinka"),
                'Telefon'=>$this->request->getVar("telefon"),
                'JMBG'=>$this->request->getVar("jmbg"),
                'BRLK'=>$this->request->getVar("brlk"),
                'Grad'=>$this->request->getVar("grad"),
                'Adresa'=>$this->request->getVar("adresa"),
            ]
        );
        $this->forma('Uspesno ste se registrovali :)');



    }
    public function loginSubmit()
    {
        if(!$this->validate(['korime'=>'required' , 'lozinka'=>'required']))
            return $this->prikaz('login' ,['errors'=>$this->validator->getErrors()]);


        $userDB = new User();
        $user = $userDB->find($this->request->getVar('korime'));
        if($user==null)
            return $this->login("Korisnik ne postoji");
        if($user->Sifra!=$this->request->getVar('lozinka'))
            return $this->login('Pogresna sifra');

        $this->session->set('user', $user);
        return redirect()->to(site_url('Korisnik'));
    }


    //--------------------------------------------------------------------

}
