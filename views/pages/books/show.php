<?php
/**
 * @var array $book
 * @var array $authors
 */
?>
<?php component('head'); ?>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<a href="/books">Назад</a>
				<h2><?= $book['title'] ?></h2>

				<?php if (count($authors)): ?>
					<p>Автор(ы):</p>
					<ul>
						<?php foreach ($authors as $author): ?>
							<li><?= $author['name'] ?></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
			<div class="col-md-6 d-flex">
				<?php if (!$book['is_given']): ?>
					<p>Книга в библиотеке</p>
					<form action="/books/give_out" method="post">
						<input type="hidden" name="book_id" value="<?= $book['id'] ?>">
						<button type="submit" class="btn btn-primary">Выдать книгу</button>
					</form>
				<?php else: ?>
					<p>Книга на руках</p>
				<?php endif; ?>
			</div>

			<div class="col-md-6 d-flex">
				<?php if (!$book['is_lose']): ?>
					<p>Книга числится за библиотекой</p>
					<form action="/books/lose" method="post">
						<input type="hidden" name="book_id" value="<?= $book['id'] ?>">
						<button type="submit" class="btn btn-danger">Списать книгу</button>
					</form>
				<?php else: ?>
					<p>Книга утеряна</p>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php component('footer'); ?>