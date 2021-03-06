<?php

namespace application\core;

/**
 *  Class view
 */
class View
{

	public 
		$path,
		$route,
		$layout = 'default';

	
	function __construct($route)
	{
		$this->route = $route;
		$this->path = $route['controller'] . '/' . $route['action'];
		//debug($this->path);
	}

	public function render($title, $vars = [])
	{
		extract($vars);
		$path = 'application/views/' . $this->path . '.php';
		if( file_exists($path) )
		{
			ob_start();
			require $path;
			$content = ob_get_clean();
			require 'application/views/layouts/' . $this->layout . '.php';
		}
		
	}

	public function redirect($url)
	{
		header('location: ' . $url);
		exit;
	}

	/**
	* 404 and other error pages
	*/
	public static function errorCode($code)
	{
		http_response_code($code);
		$path = 'application/views/errors/' . $code . '.php';
		if( file_exists($path) ) {
			require $path;
		}
		exit;
	}

	/**
	* message from Ajax form
	*/
	public function message($status, $message)
	{
		exit(json_encode(['status' => $status, 'message' => $message]));
	}

	/**
	* redirect on JS
	*/
	public function location($url)
	{
		exit(json_encode(['url' => $url]));
	}

}