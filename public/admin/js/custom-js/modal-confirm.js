$(document).ready(function() {
	$('.btn-delete').click(function() {
		var id_pitch = $(this).data('id-item');
		var urlDelete = urlDeleteItem.replace(/.$/,id_pitch);
		$('#btn-delete-item').attr('href', urlDelete);
	});
});