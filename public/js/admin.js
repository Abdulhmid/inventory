$(document).ready(function(){
	
	var e=function(e){
		$(e).closest(".form-group").removeClass("success");
	};
	$(".form-valid").validate({
		errorElement:"span",
		errorClass:"text-danger",
		focusInvalid:false,
		ignore:"",
		invalidHandler:function(e,t){},
		highlight:function(e){
			$(e).closest(".form-group").removeClass("success").addClass("has-error");
		},
		unhighlight:function(t){
			$(t).closest(".form-group").removeClass("has-error");
			setTimeout(function(){e(t)},3e3);
		},
		success:function(e){
			e.closest(".form-group").removeClass("has-error").addClass("success");
		},
		submitHandler:function(e){
			e.submit();
		}
	});

});