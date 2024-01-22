<?php

namespace App\Controllers;

use App\kernel\Controller\BaseController;

class IndexController extends BaseController
{
	public function index()
	{
		$this->view()->page('pages.index.home');
	}

}