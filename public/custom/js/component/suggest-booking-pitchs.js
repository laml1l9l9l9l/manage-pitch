$('.card').on('click', function(){
   	var checkbox = $(this).find('input[type="checkbox"]');
   	checkbox.prop('checked', !checkbox.prop('checked'));
});