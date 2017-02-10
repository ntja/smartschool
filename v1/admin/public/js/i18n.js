settings.i18n = {
    translations: {
        fr: {
            'login.login.1': 'Champ obligatoire',
            'login.login.2': 'L\'email doit avoir au moins 6 caract&egrave;res',
            'login.login.3': 'Adresse Email Invalide',
            'login.login.4': 'Connexion réussi',
            'login.login.5': 'Email ou mot de passe incorrect',
            'login.login.6': 'Email ou mot de passe incorrect',
            'login.login.7': 'Acc&egrave;s non autoris&eacute;',
            'login.login.8': 'Requete Invalide',
            'login.login.9': 'Format Invalide. Format JSON attendu',
			
			
			'setting.item.1': 'Modification réussie.',
			'setting.add.1': 'Ajout réussi.'
            
        },
        en: {
            'login.login.1': 'Required field',
            'login.login.2': 'Email must have at least 6 characters',
            'login.login.3': 'Invalid Email Address',
            'login.login.4': 'Successfully Connected',
            'login.login.5': 'Email or password incorrect',
            'login.login.6': 'Email or password incorrect',
            'login.login.7': 'Non-authorized access',
            'login.login.8': 'Invalid request',
            'login.login.9': 'Invalid format. JSON expected.',
			
			
			'setting.item.1': 'Successfully updated.',
			'setting.add.1': 'Successfully added.'
        }
    },
    language: 'en',
    setLanguage: function(language){
        try{
            this.language = language;
        } catch (error) {
            console.log(error);
            console.log(error.stack);
        }
    },
    translate: function(key, params){
        try {
            var translation;			
            if(params == undefined){
                params = [];
            }
            translation = this.translations[this.language][key];
		if(params.length != 0){
                    translation = vsprintf(translation, params);
		}
            return translation;
        } catch (error) {
            console.log(error);
            console.log(error.stack);
        }
    }
}
settings.i18n.setLanguage($('body').attr('data-locale'));