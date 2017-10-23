settings.i18n = {
    translations: {
        fr: {
            'home.1': 'Voir',
			'home.2': 'Souscrire',
			'home.3': 'Gratuit',
			'activate.1' : 'Si vous n\'êtes pas redirigé à la page de connexion dans 5 sécondes, veuillez cliquer sur le lien ci-après: ',
			'error.1' : "Une erreur interne est survenue. Veuillez re-essayer plutard",
			"error.2" : "Requête non authorisée",
			'login.1' : "Connexion",
			'login.2' : "Authentification réussi !",
			"validation.1" : "Champs réquis",
			"validation.2" : "Addresse email invalide",
			"validation.3" : "Valeur incorrecte",
			"validation.4" : "8 caractères minimum réquis",
			"validation.5" : "Doit être égal au champ mot de passe",
			"login.3" : "Echec d'authentification. Addresse email ou mot de passe invalide",
			"login.4" : "Champs Invalides ou manquants",
			"login.5" : "Un email de vérification vous à été envoyé. Veuillez d'abord activer votre compte afin de pouvoir vous connecter",
			"register.1" : "Nous vous remerçions",
			"register.2" : "pour votre inscription sur SmartSchool",
			"register.3" : "Nous vous avons envoyé un email d'activation. Veuillez activez votre compte afin de profiter de toutes nos resources." ,
			"register.4" : "Cette addresse email existe déjà dans le système",
			"register.5" : "Champ(s) Invalide(s) ou manquant(s)",
			"reset.password.1" : "Votre mot de passe a été re-initialisé avec succès. Vous pouvez vous connecter à présent.",
			"course.overview.1" : "Ce cours n'a pas de contenu.",
			"course.overview.2" : "Retour au Catalogue",
			"course.overview.3" : "Votre inscription a été effectué avec succès",
			"learner.course.1" : "Vous n'êtes inscrit à aucun cours.",
			"learner.course.2" : "Accéder au catalogue des cours",
			"instructor.course.1" : "Votre cours a été crée avec succès.",
			"instructor.course.2" : "Votre cours a été éditer avec succès",
			"instructor.course.3" : "Votre cours a été publié avec succès",
			"instructor.course.4" : "Votre cours a été rendu non publique avec succès",
			"instructor.course.5" : "Editer",
			"instructor.course.6" : "Publier",
			"instructor.course.7" : "Rendre non publique",
			"instructor.course.8" : "Voir",
			"book.catalog.1" : "Télécharger",
			"book.catalog.2" : "Lire",
        },
        en: {
            'home.1': 'View',
			'home.2': 'Subscribe',
			'home.3': 'Free',
			'activate.1' : 'If you are not redirected to log in page in 5 secondes, Please click on the following link:',
			'error.1' : "An internal server error occurred. Please try again later",
			"error.2" : "You don't have permission for that request",
			'login.1' : "Log In",
			'login.2' : "Well done ! Successful authentication",
			"validation.1" : "This field is required",
			"validation.2" : "Invalid email address",
			"validation.3" : "Incorrect value",
			"validation.4" : "Minimum length : 8 characters",
			"validation.5" : "Must match password field",
			"login.3" : "Authentication failed. Invalid email address or password",
			"login.4" : "Some fields are invalids or missing",
			"login.5" : "We have sent you a verification email. Please verify your email address so we know that it\'s really you !",			
			"register.1" : "Thank you",
			"register.2" : "for joining SmartSchool",
			"register.3" : "We just sent you an activation email. Please activate your account to start exploring our resources." ,
			"register.4" : "Email address already in use",
			"register.5" : "Some field(s) is (are) invalid(s) or missing",
			"reset.password.1" : "Your password has been successfully reset. You can log in now.",
			"course.overview.1" : "No detail Found for this course.",
			"course.overview.2" : "Return to Course Catalog",
			"course.overview.3" : "You successfully enrolled to this course",
			"learner.course.1" : "You are not registered on any Course.",
			"learner.course.2" : "Browse Course Catalog",
			"instructor.course.1" : "Well done ! Your course has been successfully created.",
			"instructor.course.2" : "Well done ! Your course has been successfully edited.",
			"instructor.course.3" : "Your Course has been published successfully",
			"instructor.course.4" : "Your Course has been unpublished successfully",
			"instructor.course.5" : "Edit",
			"instructor.course.6" : "Publish",
			"instructor.course.7" : "Unpublish",
			"instructor.course.8" : "View",
			"book.catalog.1" : "Download",
			"book.catalog.2" : "Read",
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