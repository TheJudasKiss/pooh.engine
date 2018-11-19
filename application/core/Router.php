<?php

namespace application\core;

use application\core\View;

/**
 *  Class router
 */
class Router
{

	protected
		$routes = [],
		$params = [];
	
	function __construct()
	{
		$arr = require 'application/config/routes.php';
		foreach($arr as $key => $val)
		{
			$this->add($key, $val);
		}
		//debug($this->routes);
	}

	public function add($route, $args) 
	{
		$route = '#^'.$route.'$#';
		$this->routes[$route] = $args;
	}

	public function match() 
	{
		$url = trim($_SERVER['REQUEST_URI'], '/');
		foreach($this->routes as $route => $args)
		{
			if( preg_match($route, $url, $matches) )
			{
				$this->args = $args;
				return true;
				// debug($args);
			}
		}
		return false;
	}
	
	public function run() 
	{ 
		if( $this->match() )
		{
			$path = 'application\controllers\\' . ucfirst($this->args['controller'] . 'Controller');
			if( class_exists($path) )
			{
				$action = $this->args['action'] . 'Action';
				if( method_exists($path, $action) )
				{
					$controller = new $path($this->args);
					$controller->$action();
				}
				else
				{
					//echo 'Not found method.';
					//echo '<p><small>' . $action . '</small></p>';
					View::errorCode(404);
				}
			}
			else
			{
				//echo '<p>Not found class.</p>';
				//echo '<p><small>' . $path . '</small></p>';
				View::errorCode(404);
			}
		}
		else
		{
			//echo '<p>Not found route.</p>';
			View::errorCode(404);
		}
	}

}