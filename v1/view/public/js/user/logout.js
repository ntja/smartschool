function logout(){
	var uri;
	Cookies.remove('token');
	Cookies.remove('account_id');
	window.localStorage.removeItem('role');
	uri = $('body').attr('data-base-url')+'/login';
	window.location.assign(uri);
}