	(function($){
    $(document).ready(function () {
	//localStorage.removeItem('token');       
               
        if (!localStorage.token) {
            window.location.href = $('body').attr('data-base-url')+'/login';
        }else{
            localStorage.clear();
            window.location.href = $('body').attr('data-base-url')+'/login';
        }
    });        
})(jQuery);