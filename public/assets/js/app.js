function buttonsAction() {
	let buttons = document.querySelectorAll('button');
	if (buttons) {
		for (let btn of buttons) {
			btn.addEventListener('click', (e) => {
				if (confirm('Подтвердить действие?')) {
					btn.closest('form').submit();
				}
			})
		}
	}
}

buttonsAction();