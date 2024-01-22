<?php

namespace App\kernel\Router;

use App\kernel\Database\Database;
use App\kernel\Request\Request;
use App\kernel\View\View;

class Router
{
	private array $routes = [
		'GET' => [],
		'POST' => []
	];

	public function __construct(
		private Request $request,
		private View $view,
		private Database $database,
	)
	{
		$this->init();
	}

	public function dispatch(string $uri, string $method): void
	{
		$route = $this->findRoute($uri, $method);

		if (!$route) $this->notFoundPage();

		if (is_array($route->getAction())) {
			[$controller, $action] = $route->getAction();

			$controller = new $controller;

			call_user_func([$controller, 'setRequest'], $this->request);
			call_user_func([$controller, 'setView'], $this->view);
			call_user_func([$controller, 'setModel'], $this->database);
			call_user_func([$controller, $action]);
		} else {
			call_user_func($route->getAction());
		}
	}

	private function init(): void
	{
		$routes = $this->getRoutes();
		if ($routes) {
			foreach ($routes as $route) {
				/**
				 * @var Route $route
				 */
				$this->routes[$route->getMethod()][$route->getUri()] = $route;
			}
		}
	}

	private function getRoutes(): array
	{
		return include_once  dirname($_SERVER['DOCUMENT_ROOT']) . '/config/routes.php';
	}

	private function findRoute(string $uri, string $method): ?Route
	{
		if (isset($this->routes[$method][$uri])) {
			return $this->routes[$method][$uri];
		}
		return null;
	}

	private function notFoundPage()
	{
		exit("<h1><strong>404</strong> Page not Found!</h1> <a href='/'>go back</a>");
	}
}