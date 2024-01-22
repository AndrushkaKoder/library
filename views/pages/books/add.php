<?php component('head'); ?>
<div class="container">
	<div class="row">
		<div class="col-12">
			<h2>Добавление новой книги</h2>
			<p><a href="/">Назад</a></p>
		</div>
		<div class="col-12">
			<form action="/books/create" method="post" class="w-50 m-auto">
				<label for="title" class="form-label">Название книги</label>
				<input type="text" name="title" id="title" class="form-control mb-3" required>
				<label for="authors" class="form-label">Автор(ы)</label>
				<input type="text" name="authors" id="authors" class="form-control mb-3" required
				       placeholder="Введите авторов через запятую">
				<button type="submit" class="btn btn-success">Добавить</button>
			</form>
		</div>
	</div>
</div>
<?php component('footer'); ?>

