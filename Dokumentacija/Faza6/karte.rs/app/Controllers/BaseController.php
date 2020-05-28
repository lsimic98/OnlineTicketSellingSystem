<?php
namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use App\Models\News;
use CodeIgniter\Controller;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['form', 'url'];
        protected $method = 'index';
        

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		 $this->session = session();
	}

    protected function prikaz($page, $data) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
    public function index()
    {
        $this->method = 'index';
        $newsDB = new News();
        $data = [
            'news' => $newsDB->paginate(5),
            'pager' => $newsDB->pager
        ];
        $news = $newsDB->where('tip','M')->findAll();
        $this->prikaz("index", ['data'=>$data,'news'=>$news, 'method'=>$this->method]);
    }

    public function pretraga()
    {
        $this->method = 'index';
        $newsDB = new News();
        $news = $newsDB->pretraga(5, $this->request->getVar('search'));
        $data = 
        [
            'news' => $news,
            'pager' => $newsDB->pager
            
        ];
        $this->prikaz("index", ['data'=>$data , 'trazeno'=>$this->request->getVar('search'), 'method'=>$this->method]);
    }
    
    //Dzoni'o
    
     public function userInfo()
    {
        $newsDB = new News();
        $korime = $this->session->get('user')->KorIme;
        $news = $newsDB->where('korime',$korime)->findAll();
        $this->method='userInfo';

        $db= \Config\Database::connect();
        $builder = $db->table('Ima_ulogu');
        $builder->select('*')
            ->join('Korisnik', 'Korisnik.KorIme=Ima_ulogu.KorIme', 'left')
            ->join('Uloga', 'Uloga.Idu=Ima_ulogu.Idu', 'left')
            ->where('Korisnik.KorIme',$korime);
        $uloga = $builder->get();


        $this->prikaz('user',['method'=>$this->method, 'news'=>$news, 'uloga'=>$uloga->getFirstRow()]);

    }
    public function oglasi()
    {
        $newsDB = new News();
        $data = [
            'news' => $newsDB->oglasi(6),
            'pager' => $newsDB->pager
        ];
        $this->prikaz('oglasi',['data'=>$data,'method'=>$this->method, /*'news'=>$news*/]);
    }
    public function objaviOglas()
    {
        $naslov = 'Objavljivanje oglasa';
        $this->method='dodajOglas';
        $news = null;
        $this->prikaz('dodajOglas',['method'=>$this->method, 'news'=>$news, 'naslov'=>$naslov]);

    }
    
    
    
    
    
    //Perin'o
    
    public function addtocart($iddog)
    {
        if(!isset($_SESSION['korpa'][$iddog]))
        {
            echo "dodato";
            $_SESSION['korpa'][$iddog] = 1;
        }
        else
        {
            echo "postoji";
        }

    }

    public function korpa()
    {
        $method = 'korpa';
        $newsDB = new News();
        $iddog = [];
        $news = [];
        if(isset($_SESSION['korpa'])) {
            foreach ($_SESSION['korpa'] as $key => $value) {
                array_push($iddog, $key);
            }
            if(count($iddog) > 0){$news = $newsDB->findid($iddog);}
        }
        $this->prikaz("korpa", ['news'=>$news, 'method'=>$method]);
    }


    public function inccart($iddog)
    {
        $_SESSION['korpa'][$iddog] += 1;
    }

    public function deccart($iddog)
    {
        if($_SESSION['korpa'][$iddog] > 1)
        { $_SESSION['korpa'][$iddog] -= 1;}
    }

    public function delcart($iddog)
    {
        unset($_SESSION['korpa'][$iddog]);
    }

}
