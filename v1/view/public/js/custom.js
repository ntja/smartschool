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
	uri = $('body').attr('data-base-url')+'/search?query='+query;
	window.location.assign(encodeURI(uri));
	console.info(encodeURIComponent(query));
});

$('#custom-search-input').keypress(function(e) {	
	var key = e.which;
	if (key == 13) {
		if ($('.query').val() != '') {
			e.preventDefault();
			query = $('.query').val();
			uri = $('body').attr('data-base-url')+'/search?query='+query;
			window.location.assign(encodeURI(uri));
			console.info(encodeURI(query));
		}
	}
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

function getParameterByName(name, url) {
	if (!url) {
	  url = window.location.href;
	}
	name = name.replace(/[\[\]]/g, "\\$&");
	var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
		results = regex.exec(url);
	if (!results) return null;
	if (!results[2]) return '';
	return decodeURIComponent(results[2].replace(/\+/g, " "));
}
		
function logout(){
	var uri;
	Cookies.remove('token');
	Cookies.remove('account_id');
	window.localStorage.removeItem('role');
	var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      console.log('User signed out.');
    });

	uri = $('body').attr('data-base-url')+'/login';
	window.location.assign(uri);
}