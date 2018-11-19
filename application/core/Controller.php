<?php

namespace application\core;

use application\core\View;

/**
 *  Class controller
 */
class Controller
{

	public 
		$route,
		$view;
	
	function __construct($route)
	{
		$this->route = $route;
		$this->view = new View($route);
		//debug($this->routes);
	}

}