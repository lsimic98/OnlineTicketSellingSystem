<?php namespace App\Controllers;
use App\Models\User;
class Korisnik extends BaseController
{
    protected function prikaz($page, $data)
    {
      $data['controller']='Korisnik';
      $data['user']=$this->session->get('user');
      echo view('Prototip/header_kor', $data);
      echo view("Prototip/$page", $data);

    }


    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(site_url('/'));
    }
    //--------------------------------------------------------------------

}
