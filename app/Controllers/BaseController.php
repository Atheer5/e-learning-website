<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\CategoriesModel;
use App\Models\coursesModel;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */

class BaseController extends Controller
{
	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = [];

	/**
	 * Constructor.
	 *
	 * @param RequestInterface  $request
	 * @param ResponseInterface $response
	 * @param LoggerInterface   $logger
	 */
	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.: $this->session = \Config\Services::session();

		$this->errors = [];
	}


	protected function loadView($page , $page_title, $data = [] ,$css = [] , $js = [] ) {//for prevent repeat code 
		
		if ( !is_file(APPPATH . '/Views/' . $page . '.php') ) {
			// Whoops, we don't have a page for that!
			throw new \CodeIgniter\Exceptions\PageNotFoundException('/Views/' . $page);
		}

		// prep.  data
		$content['view_file'] = $page;

		$content['page_title'] = $page_title;

		// breadcrubms
		//$this->breadcrumbs = new Breadcrumb();

		//$content['breadcrumbs'] = $this->breadcrumbs->buildAuto();

		$content['controller_data'] = $data;

		$content['css'] = $css;

		$content['js'] = $js;

		$content['errors'] = $this->errors;

		
		$obj=new CategoriesModel();
	    $content['Categories']=$obj->selectallCategories();
		

		echo view('layout/app', $content);

		return;

	}

//____________________________________________________________________________________________________________________

}
?>