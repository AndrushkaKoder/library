<?php

function config(string $file, string $path): ?string
{
	$config = include dirname($_SERVER['DOCUMENT_ROOT']) . "/config/{$file}.php";
	return $config[$path] ?? null;

}

function component($path): void
{
	$pathToComponent  = TEMPLATE_PATH . '/' . $path . '.php';
	if(is_file($pathToComponent)) include $pathToComponent;
}
