function format(){
		var input = $('.datepicker').val();
		var months = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];
		if(input != "") {  
			var formattedDate = new Date(input);
			var d = formattedDate.getDate();
			var m =  months[formattedDate.getMonth()]
			var y = formattedDate.getFullYear();
			$(".datepicker").val(d + " " + m + " " + y);
		}	
	}
