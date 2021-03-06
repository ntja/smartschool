var settings, config, environment;

settings = {
    environments: {
        development: {
            api_url: 'http://127.0.0.1/smartschool/v2/api'
        },
        staging: {
            api_url: 'http://stagging.smartskul.com/v2/api'
        },
        production: {
            api_url: 'http://smartskul.com/v2/api'
        }
    }
};

environment = 'development';

config = settings.environments[environment];

(function($) {
    $(document).ready(function() {
        base_url = $('body').attr('data-base-url');
    });
})(jQuery);
