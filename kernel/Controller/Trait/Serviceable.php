<?php

namespace App\kernel\Controller\Trait;

use App\kernel\Database\Database;
use App\kernel\Request\Request;
use App\kernel\View\View;

trait Serviceable
{
	private Request $request;
	private View $view;
	private Database $database;

	public function setRequest(Request $request): void
	{
		$this->request = $request;
	}

	public function request(): Request
	{
		return $this->request;
	}

	public function setView(View $view): void
	{
		$this->view = $view;
	}

	public function view(): View
	{
		return $this->view;
	}

	public function setModel(Database $database): void
	{
		$this->database = $database;
	}

	public function model(): Database
	{
		return $this->database;
	}

}