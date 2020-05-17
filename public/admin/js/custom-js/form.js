// Expand form search
var btn_expand = document.getElementById('btn-expand');

btn_expand.addEventListener('click', function() {
	icon = document.querySelector('#btn-expand i');
	icon.classList.toggle('ti-angle-up');
	icon.classList.toggle('ti-angle-down');
});