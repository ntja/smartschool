/**
 * Script for learner dashboard
 */

(function($) {
    $(document).ready(function() {
        var user_role = window.localStorage.getItem('sm_user_role');        
		if(user_role !== "LEARNER"){
			logout();
		}				
	});
})(jQuery);
