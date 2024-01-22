<?php

namespace App\kernel\View;

use App\kernel\Exception\ViewNotFoundException;

class View
{

	public function page(string $pathToPage, array $data = [])
	{
		$pathToFile = dirname($_SERVER['DOCUMENT_ROOT']) . '/views/' . $this->dotNotation($pathToPage) . '.php';

		if(!is_file($pathToFile)) throw new ViewNotFoundException('VIEW NOT FOUND');

		extract($data);
		include $pathToFile;
	}

	public function dotNotation(string $path): string
	{
		return preg_replace('/\.+/', '/', $path);
	}

}