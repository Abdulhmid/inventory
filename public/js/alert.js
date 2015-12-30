function swal_alert(el, custom_msg){
	custom_msg = custom_msg || "Anda yakin mau menghapus ?";

	msg = custom_msg;
	swal({
		title: msg,
		// text: "You will not be able to recover this imaginary file!",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: '#DD6B55',
		confirmButtonText: 'Yes!',
		closeOnConfirm: true
	},
	function(isConfirm){  
		if (isConfirm) {     
			location.replace(el);  
		}
	});
}


