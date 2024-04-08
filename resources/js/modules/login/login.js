import IMask from "imask";

const inputPhone = document.querySelector('input[type=tel]');
const alert = document.querySelector('div[role=alert]')
if (inputPhone) {
	const mask = new IMask(inputPhone, {
		mask: '+{7} (000) 000-00-00'
	})
}
if(alert) {
	alert.addEventListener('click', (event) => {
		if(event.target.closest('.close_button')) {
			alert.remove();
		}
	})
}

