<?php

namespace App\Controllers;

use App\kernel\Controller\BaseController;

class BooksController extends BaseController
{
	public function index(): void
	{
		$books = $this->model()->select('books');

		$this->view()->page('pages.books.index', ['books' => $books]);
	}

	public function show(): void
	{
		$book = $this->model()->first('books', $this->request()->input('id'));
		if ($book) {
			$authors = $this->model()->authors($book['id']);
			$this->view()->page('pages.books.show', ['book' => $book, 'authors' => $authors]);
		}
	}

	public function add(): void
	{
		$this->view()->page('pages.books.add');
	}

	public function create(): void
	{
		$requestData = array_map(function ($item) {
			return htmlspecialchars($item);
		}, $this->request()->all());

		if (!isset($requestData['title']) || !isset($requestData['authors'])) {
			header('Location: /');
		}

		$title = $requestData['title'];
		$authors = explode(',', $requestData['authors']);

		$bookId = $this->model()->insert('books', [
			'title' => $title
		]);

		$authorsIds = [];
		foreach ($authors as $author) {
			$authorsIds[] = $this->model()->insert('authors', [
				'name' => $author
			]);
		}

		foreach ($authorsIds as $id) {
			$this->model()->insert('authors_books', [
				'author_id' => $id,
				'book_id' => $bookId
			]);
		}
		header('Location: /books');
	}

	public function giveOut(): void
	{
		$bookId = $this->request()->input('book_id');
		$this->updateBookValue($bookId, 'is_given');
		header("Location: /book?id={$bookId}");
	}

	public function lose(): void
	{
		$bookId = $this->request()->input('book_id');
		$this->updateBookValue($bookId, 'is_lose');
		header("Location: /book?id={$bookId}");
	}

	private function updateBookValue(int $bookId, string $field): void
	{
		$this->model()->update('books', $bookId, [
			$field => 1
		]);
	}
}