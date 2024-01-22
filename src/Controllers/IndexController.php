<?php

namespace App\Controllers;

use App\kernel\Controller\BaseController;

class IndexController extends BaseController
{
	public function index(): void
	{
		$this->view()->page('pages.index.home');
	}

}