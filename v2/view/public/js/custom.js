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
	//html+= '<div class="alert alert-danger" role="alert">';
	html+= '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>';
	html+= '<strong> '+ message+'</strong></div>';
	$('.response-message div').addClass(type);
	$('.response-message').empty().html(html);
}

$('#search').on('click', function(){
	query = $('.query').val();
	uri = $('body').attr('data-base-url')+'/search?query='+encodeURIComponent(query);
	window.location.assign(uri);
});

function get_query(){
	var url = location.search;
	var qs = url.substring(url.indexOf('?') + 1).split('&');
	for(var i = 0, result = {}; i < qs.length; i++){
		qs[i] = qs[i].split('=');
		result[qs[i][0]] = decodeURIComponent(qs[i][1]);
	}
	return result;
}

function logout(){
	var uri;
	Cookies.remove('token');
	Cookies.remove('account_id');
	window.localStorage.removeItem('role');
	uri = $('body').attr('data-base-url')+'/login';
	window.location.assign(uri);
}