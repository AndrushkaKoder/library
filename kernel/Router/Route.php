<?php

namespace App\Kernel\Router;

class Route
{
	public function __construct(
		private string $uri,
		private string $method,
		private        $action
	)
	{

	}

	public static function get(string $uri, $action): Route
	{
		return new self($uri, 'GET', $action);
	}

	public static function post(string $uri, $action): Route
	{
		return new self($uri, 'POST', $action);
	}

	public function getUri(): string
	{
		return $this->uri;
	}

	public function getMethod(): string
	{
		return $this->method;
	}

	public function getAction()
	{
		return $this->action;
	}
}