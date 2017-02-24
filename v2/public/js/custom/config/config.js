var settings, config, environment;
settings = {
    environments: {
        development: {
            api_url: 'http://127.0.0.1/smartschool/v2/public/api'
        },
        staging: {
            api_url: 'http://api.smartskul.com/v2/public'
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