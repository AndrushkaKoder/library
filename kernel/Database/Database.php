<?php

namespace App\kernel\Database;

class Database
{
	private \PDO $pdo;

	public function __construct()
	{
		$this->connect();
	}

	public function connect(): void
	{
		$host = config('database', 'host');
		$dbName = config('database', 'database');
		$dbUser = config('database', 'user');
		$dbPassword = config('database', 'password');

		try {
			$this->pdo = new \PDO("mysql:host=$host;dbname=$dbName", $dbUser, $dbPassword);
		} catch (\PDOException $exception) {
			die('Ошибка подключения к Database! ' . $exception->getMessage());
		}
	}

	public function insert(string $table, array $data): int|false
	{
		$fields = array_keys($data);
		$columns = implode(', ', $fields);

		if (!$columns) return false;

		$bind = implode(', ', array_map(fn($item) => ":$item", array_values($fields)));

		$query = "INSERT INTO {$table} ($columns) VALUES ($bind)";

		$sql = $this->pdo->prepare($query);

		try {
			$sql->execute($data);
		} catch (\PDOException $e) {
			die($e->getMessage());
		}

		return $this->pdo->lastInsertId();
	}


	public function select(string $table, array $fields = [], array $conditions = []): bool|array
	{
		$dbFields = '*';
		$where = '';

		if ($fields) $dbFields = implode(', ', $fields);

		if ($conditions) $where = "WHERE " . implode(' AND ', array_map(function ($item) {
				return "$item = :$item";
			}, array_keys($conditions)));

		$query = "SELECT {$dbFields} FROM {$table} {$where}";

		$statement = $this->pdo->prepare($query);
		$statement->execute($conditions);

		return $statement->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function first(string $table, int $id)
	{
		$query = "SELECT * FROM $table WHERE id = {$id} LIMIT 1";

		$statement = $this->pdo->prepare($query);
		$statement->execute();
		return $statement->fetch(\PDO::FETCH_ASSOC);
	}

	public function update(string $table, int $id, array $conditions = []): void
	{
		$set = '';
		if ($conditions) {
			$set = "SET " . implode(' AND ', array_map(function ($item) {
					return "$item = :$item";
				}, array_keys($conditions)));
		}

		$query = "UPDATE {$table} {$set} WHERE id = {$id}";

		$statement = $this->pdo->prepare($query);
		$statement->execute($conditions);
	}

	public function delete(string $table, array $conditions = []): void
	{
		$where = '';

		if ($conditions) {
			$where = "WHERE " . implode(' AND ', array_map(function ($item) {
					return "$item = :$item";
				}, array_keys($conditions)));
		}

		$query = "DELETE FROM {$table} {$where}";
		$statement = $this->pdo->prepare($query);
		$statement->execute($conditions);
	}

	public function authors(int $bookId): ?array
	{
		$query = "SELECT * FROM
             authors
            JOIN
            authors_books 
            ON 
            authors.id = authors_books.author_id
         	WHERE book_id = {$bookId}";

		$statement = $this->pdo->prepare($query);
		$statement->execute();

		return $statement->fetchAll(\PDO::FETCH_ASSOC);
	}
}