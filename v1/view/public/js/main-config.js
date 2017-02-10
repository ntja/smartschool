var settings, config, environment;
settings = {
    environments: {
        development: {
            api_url: 'http://127.0.0.1/smartschool/v2/api/public'
        },
        staging: {
            api_url: 'http://api.smartskul.com/v2/api/public'
        }
    }
};

environment = 'development';
config = settings.environments[environment];

(function($) {
    $(document).ready(function() {
        root_admin = $('body').attr('data-base-url');
    });
})(jQuery);