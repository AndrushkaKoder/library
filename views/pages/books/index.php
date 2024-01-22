<?php component('head'); ?>
	<div class="container">
		<div class="row">
			<a href="/">Назад</a>
			<?php if (count($books)) : ?>
			<div class="col-12">
				<ul>
					<?php foreach ($books as $book): ?>
						<li><a href="/book?id=<?= $book['id']?>"><?= $book['title'] ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php else:?>
				<p>Книг не найдено</p>
			<?php endif; ?>
		</div>
	</div>
<?php component('footer'); ?>
