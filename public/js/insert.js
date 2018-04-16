

$(document).ready(function(){
    $.ajaxSetup({
         headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
});


$('#btn-asignar').click(function(event) {
  event.preventDefault();
  var formId = '#FormRol';


		$.ajax({
			url: $(formId).attr('action'),
			type: $(formId).attr('method'),
			data: $(formId).serialize(),
      alert(data);
			'html',
			success;: function(result){
				if ($(formId).find("input:first-child").attr('value') == 'PUT') {
					var $jsonObject = jQuery.parseJSON(result);
	                                $(location).attr('href',$jsonObject.url);
				}
				else{
					$(formId)[0].reset();
					console.log('Ok');
				}
			},
			error: function(){
				console.log('Error');
			}
})
});

});
