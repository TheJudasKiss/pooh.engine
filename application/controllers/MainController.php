<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Db;

/**
 * Main Controller
 */
class MainController extends Controller
{
	
	public function indexAction()
	{

		$this->view->render('Main page');
	}

}