<?php

namespace application\controllers;

use application\core\Controller;

/**
 * Account Controller
 */
class AccountController extends Controller
{
	
	public function loginAction()
	{
		if(!empty($_POST))
		{
			$this->view->location('/account/register');
		}
		//$this->view->redirect('/');
		$this->view->render('Login');
	}

	public function registerAction()
	{
		$this->view->render('Register');
		//debug($this->route);
	}
}