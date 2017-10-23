
//notification function
function alertNotify(message, type){
	var html = '';		
	if(type=='success'){
		html+= '<div class="alert alert-success" role="alert"><span class="fa fa-check"></span>';	
	}else if(type=='error'){
		html+= '<div class="alert alert-danger" role="alert"><span class="fa fa-times"></span>';	
	}else if(type=='info'){
		html+= '<div class="alert alert-info" role="alert"><span class="fa fa-info"></span>';	
	}else if(type=='warning'){
		html+= '<div class="alert alert-warning" role="alert">';	
	}
	html+= '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>';
	html+= '<strong> '+ message+'</strong></div>';
	$('.response-message div').addClass(type);
	$('.response-message').empty().html(html);
}

//Check if user token is still valid
function check_token_validity(token){		
	var result = false;
	$.ajax({
		url: config.api_url + "/accounts/authenticate?verify_token="+token,
		method: "POST",
		headers: {
			"x-client-id": "0000",
			"Content-Type": "application/json",
			"cache-control": "no-cache"
		},
		crossDomain:true,
		async:false,
		dataType:"json"
	})
	.done(function (data, textStatus, jqXHR) {
		console.log(data);
		//console.log(data.valid == false);
		if(data.code == 200){			
			result = data.valid;
		}
	})
	.fail(function (jqXHR, textStatus, errorThrown) {
		console.log('request failed !');
	});
	return  result;
}

function logout(){
	var uri;
	window.localStorage.removeItem('sm_user_token');
	window.localStorage.removeItem('sm_user_id');
	window.localStorage.removeItem('sm_user_role');
	
	uri = $('body').attr('data-base-url')+'/login';
	window.location.assign(uri);
}
