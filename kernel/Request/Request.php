<?php

namespace App\Kernel\Request;

class Request
{
	public function __construct(
		protected array $get,
		protected array $post,
		protected array $files,
		protected array $cookies,
		protected array $server,
	)
	{

	}

	public static function createSelfFromGlobals(): self
	{
		return new self($_GET, $_POST, $_FILES, $_COOKIE, $_SERVER);
	}

	public function uri(): string
	{
		return preg_replace('/\?+.*/', '', $this->server['REQUEST_URI']);
	}

	public function method(): string
	{
		return $this->server['REQUEST_METHOD'];
	}

	public function input(string $key): ?string
	{
		$input = $this->get[$key] ?? $this->post[$key] ?? null;
		return $input;
	}

	public function all(): array
	{
		return array_merge($this->get, $this->post, $this->files);
	}

}