var settings, config, environment;
settings = {
    environments: {
        development: {
            api_url: 'http://127.0.0.1/smartschool/api/public'
        },
        staging: {
            api_url: 'http://127.0.0.1/smartschool/api/public'
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