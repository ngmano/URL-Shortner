$(document).ready(function() {
	
	const HTTP_SUCCESS = 200;	
	const HTTP_UNPROCESSABLE_ENTITY = 422;
	const HTTP_EXPECTATION_FAILED = 417;
	const LOADER = `Loading...`;

	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});
	
	$("form[data-ajax_submit='true']").submit(function(e) {

		e.preventDefault();
		let form = $(this);
		let url = form.attr('action');
		let method = form.attr('method');
		var formData = new FormData(this);
		let buttonText = form.closest("form").find("[type='submit']").html();

	    $.ajax({
	        url: url,
	        type: method,              
	        data: formData,
	        cache: false,
	        processData: false,
	        contentType: false,
	        beforeSend:function() {
	        	form.closest("form").find("[type='submit']").attr('disabled',true);
				form.closest("form").find("[type='submit']").html(LOADER);
	        },
	        success: function(response) {
	            if(response.status === HTTP_SUCCESS) {
					form.closest("form").find("[type='submit']").attr('disabled',false);
					form.closest("form").find("[type='submit']").html(buttonText);
					// window.location = response.redirect_url;
					form.find("input[type=text]").val("");
					if(response.data !== null) {
						let data = response.data;
						$('#original_url').attr('href',data.original_url);
						$('#original_url').html(data.original_url);
						$('#sorted_url').attr('href',data.shortener_url);
						$('#sorted_url').html(data.shortener_url);
						$('#output-box').removeClass('hide');
					} else {
						$('#output-box').addClass('hide');
					}
	            	iziToast.success({
                        title: 'OK',
                        message: response.message,
                    });
	            }
	        },
	        error: function(xhr	) {
	        	
	        	$('.ajax-validate-error').remove();
	            switch(xhr.status) {
	            	case HTTP_UNPROCESSABLE_ENTITY:
		            	let errors = xhr.responseJSON.errors;	            	
						$.each(errors, function (index, value) {
							let name = index.split(".");
							if(name.length === 2) {
								index = name[0]+'['+[name[1]]+']';								
							}
							let html = `<label class="error ajax-validate-error" for="${index}">${value[0]}</label>`;
							form.children().find("[name='"+index+"']").closest('.form-group').append(html);
						});
		            	iziToast.error({
                            title: 'Error',
                            message: xhr.responseJSON.message,
                        });
		            	break;
		            case HTTP_EXPECTATION_FAILED:		            	
		            	iziToast.error({
                            title: 'Error',
                            message: xhr.responseJSON.message,
                        });
		            	break;
				}
				form.closest("form").find("[type='submit']").attr('disabled',false);
				form.closest("form").find("[type='submit']").html(buttonText);
	        }
	    });
	});	    	
});