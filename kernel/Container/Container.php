<?php

namespace App\kernel\Container;

use App\kernel\Database\Database;
use App\kernel\Request\Request;
use App\kernel\Router\Router;
use App\kernel\View\View;

class Container
{
	public Request $request;
	public Router $router;
	public View $view;
	public Database $database;

	public function __construct()
	{
		$this->registerServices();
	}

	public function registerServices(): void
	{
		$this->request = Request::createSelfFromGlobals();
		$this->view = new View();
		$this->database = new Database();
		$this->router = new Router(
			$this->request,
			$this->view,
			$this->database
		);
	}

}