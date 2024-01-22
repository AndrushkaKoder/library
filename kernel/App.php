<?php

namespace App\kernel;

use App\kernel\Container\Container;

final class App
{
	private Container $container;

	public function __construct()
	{
		$this->container = new Container();
	}

	public function run(): void
	{
		$router = $this->container->router;
		$request = $this->container->request;
		$router->dispatch($request->uri(), $request->method());
	}
}