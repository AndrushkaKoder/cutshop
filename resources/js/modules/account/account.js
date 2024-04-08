const deleteAccountForm = document.querySelector('.delete_account_form');
if (deleteAccountForm) {
	const deleteButton = deleteAccountForm.querySelector('button');
	if (deleteButton) {
		deleteButton.addEventListener('click', (event) => {
			event.preventDefault()
			if(confirm('Ваш аккаунт будет удален! Вы уверены?')) {
				deleteAccountForm.submit()
			}
		})
	}
}

deleteAlerts()

function deleteAlerts() {
	const alerts = document.querySelectorAll('[role="alert"]')
	if (alert) {
		setTimeout(function () {
			alerts.forEach((alert) => {
				alert.remove()
			})
		}, 10000)
	}
}
