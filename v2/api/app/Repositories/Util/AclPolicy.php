<?php

namespace App\Repositories\Util;

//use App\Models\Accounts;
//use App\Repositories\Custom\Resource\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class AclPolicy {

    use HandlesAuthorization;
    
    const RESOURCE_ACCOUNT = "App\Repositories\Custom\Resource\Account";
	const RESOURCE_ACCOUNT_AUTHENTICATE = "App\Repositories\Custom\Resource\Accounts\Authenticate";
	const RESOURCE_ACCOUNT_VERIFY = "App\Repositories\Custom\Resource\Accounts\Verify";
	const RESOURCE_ACCOUNT_SOCIAL = "App\Repositories\Custom\Resource\Accounts\Social";
    const RESOURCE_ACCOUNT_PASSWORD = "App\Repositories\Custom\Resource\Accounts\Account\Password";
    const RESOURCE_ACCOUNT_RECORVER_PASSWORD = "App\Repositories\Custom\Resource\Accounts\RecoverPassword";
    const RESOURCE_ACCOUNT_FORGOT_PASSWORD = "App\Repositories\Custom\Resource\Accounts\ForgotPassword";
    const RESOURCE_ACCOUNT_ACCOUNT = "App\Repositories\Custom\Resource\Accounts\Account";
    const RESOURCE_ACCOUNT_ACCOUNT_COURSE = "App\Repositories\Custom\Resource\Accounts\Account\Courses";
    const RESOURCE_ACCOUNT_ACCOUNT_APPLICATION = "App\Repositories\Custom\Resource\Accounts\Account\Application";
    const RESOURCE_ACCOUNT_INFORMATIONS = "App\Repositories\Custom\Resource\Accounts\Account\Informations";
    const RESOURCE_COUNTRY = "App\Repositories\Custom\Resource\Country";
    const RESOURCE_CITY = "App\Repositories\Custom\Resource\City";
    const RESOURCE_SCHOOL = "App\Repositories\Custom\Resource\School";
    const RESOURCE_COURSE = "App\Repositories\Custom\Resource\Course";
    const RESOURCE_COURSE_SEARCH = "App\Repositories\Custom\Resource\Courses\Search";
    const RESOURCE_COURSE_COURSE = "App\Repositories\Custom\Resource\Courses\Course";
    const RESOURCE_COURSE_CATEGORY = "App\Repositories\Custom\Resource\Courses\Category";
    const RESOURCE_COURSE_COURSE_JOIN = "App\Repositories\Custom\Resource\Courses\Course\Join";    
    const RESOURCE_COURSE_COURSE_APPLICATION = "App\Repositories\Custom\Resource\Courses\Course\Application";
    const RESOURCE_BOOK = "App\Repositories\Custom\Resource\Book";
    const RESOURCE_BOOK_SEARCH = "App\Repositories\Custom\Resource\Books\Search";
    const RESOURCE_BOOK_CATEGORY = "App\Repositories\Custom\Resource\Books\Category";
	
	/*
     * Create a new policy instance.
     *
     * @return void
     */

    public function __construct() {
        //
    }

    public function post($user, $resource, $owner = false) {
        if (is_object($resource)) {
            if (!strcasecmp(get_class($resource), self::RESOURCE_ACCOUNT)) {
                $role = ["ADMINISTRATOR", "GUEST"];
                if (in_array($user->getRole(), $role)) {
                    if ($owner) {
                        if ($user->isOwner($resource)) {
                            return true;
                        } else {
                            return false;
                        }
                    }
                    return true;
                } else {
                    return false;
                }
			}elseif (!strcasecmp(get_class($resource), self::RESOURCE_ACCOUNT_AUTHENTICATE)) {
                $role = ["GUEST"];
                if (in_array($user->getRole(), $role)) {                    
                    return true;
                } else {
                    return false;
                }
            } elseif (!strcasecmp(get_class($resource), self::RESOURCE_ACCOUNT_PASSWORD)) {
                $role = ["ADMINISTRATOR", "INSTRUCTOR", "LEARNER","PARENT"];
                if (in_array($user->getRole(), $role)) {
                    if ($owner) {
                        if ($user->isOwner($resource)) {
                            return true;
                        } else {
                            return false;
                        }
                    }
                } else {
                    return false;
                }
            }elseif (!strcasecmp(get_class($resource), self::RESOURCE_ACCOUNT_RECORVER_PASSWORD)) {
                $role = ["GUEST"];
                if (in_array($user->getRole(), $role)) {                    
                    return true;
                } else {
                    return false;
                }
            } elseif (!strcasecmp(get_class($resource), self::RESOURCE_ACCOUNT_FORGOT_PASSWORD)) {
                $role = ["GUEST"];
                if (in_array($user->getRole(), $role)) {                    
                    return true;
                } else {
                    return false;
                }
            }elseif (!strcasecmp(get_class($resource), self::RESOURCE_ACCOUNT_SOCIAL)) {
               $role = ["GUEST"];
                if (in_array($user->getRole(), $role)) {                    
                    return true;
                } else {
                    return false;
                }
            }elseif (!strcasecmp(get_class($resource), self::RESOURCE_ACCOUNT_INFORMATIONS)) {
                $role = ["ADMINISTRATOR","LEARNER", "INSTRUCTOR","PARENT"];
                //die($user->getRole());
                if (in_array($user->getRole(), $role)) {
                    if ($owner) {                                               
                        if ($user->isOwner($resource)) {                            
                            return true;
                        } else {
                            return false;
                        }
                    }else{
                        return false;
                    }
                } else {
                    return false;
                }
            }elseif (!strcasecmp(get_class($resource), self::RESOURCE_COURSE)) {
                $role = ["INSTRUCTOR"];
                if (in_array($user->getRole(), $role)) {                    
                    return true;
                } else {
                    return false;
                }
            }elseif (!strcasecmp(get_class($resource), self::RESOURCE_COUNTRY)) {
                $role = ["ADMINISTRATOR"];
                if (in_array($user->getRole(), $role)) {                    
                    return true;
                } else {
                    return false;
                }
            }elseif (!strcasecmp(get_class($resource), self::RESOURCE_CITY)) {
                $role = ["ADMINISTRATOR"];
                if (in_array($user->getRole(), $role)) {                    
                    return true;
                } else {
                    return false;
                }
            }elseif (!strcasecmp(get_class($resource), self::RESOURCE_SCHOOL)) {
                $role = ["ADMINISTRATOR","INSTRUCTOR"];
                if (in_array($user->getRole(), $role)) {                    
                    return true;
                } else {
                    return false;
                }
            }elseif (!strcasecmp(get_class($resource), self::RESOURCE_COURSE_CATEGORY)) {
                $role = ["ADMINISTRATOR","INSTRUCTOR"];
                if (in_array($user->getRole(), $role)) {                    
                    return true;
                } else {
                    return false;
                }
            }elseif (!strcasecmp(get_class($resource), self::RESOURCE_COURSE_COURSE_JOIN)) {
                $role = ["LEARNER","INSTRUCTOR"];
                if (in_array($user->getRole(), $role)) {                    
                    return true;
                } else {
                    return false;
                }
            }elseif (!strcasecmp(get_class($resource), self::RESOURCE_BOOK)) {
                $role = ["ADMINISTRATOR"];
                if (in_array($user->getRole(), $role)) {                    
                    return true;
                } else {
                    return false;
                }
            }elseif (!strcasecmp(get_class($resource), self::RESOURCE_BOOK_CATEGORY)) {
                $role = ["ADMINISTRATOR"];
                if (in_array($user->getRole(), $role)) {                    
                    return true;
                } else {
                    return false;
                }
            } 
		}
	}

	public function get($user, $resource, $owner = false) {
        if (is_object($resource)) {
            //var_dump($resource);die();
            if (!strcasecmp(get_class($resource), self::RESOURCE_ACCOUNT)) {
                $role = ["ADMINISTRATOR"];
                if (in_array($user->getRole(), $role)) {
                    return true;
                } else {
                    return false;
                }
            }elseif (!strcasecmp(get_class($resource), self::RESOURCE_ACCOUNT_VERIFY)) {
                $role = ["GUEST"];
                if (in_array($user->getRole(), $role)) {
                    return true;
                } else {
                    return false;
                }
            }elseif (!strcasecmp(get_class($resource), self::RESOURCE_ACCOUNT_ACCOUNT)) {
                $role = ["ADMINISTRATOR", "INSTRUCTOR", "LEARNER","PARENT"];
                if (in_array($user->getRole(), $role)) {
                    if ($user->getRole() === "ADMINISTRATOR") {
                        return true;
                    } else {
                        $owner = true;
                    }
                    if ($owner) {
                        if ($user->isOwner($resource)) {
                            return true;
                        } else {
                            return false;
                        }
                    }
                } else {
                    return false;
                }
            }elseif (!strcasecmp(get_class($resource), self::RESOURCE_ACCOUNT_ACCOUNT_APPLICATION)) {
                $role = ["LEARNER"];
                //var_dump($resource);die();
                if (in_array($user->getRole(), $role)) {
                    if ($owner) {             
                    //die("");                                  
                        if ($user->isOwner($resource)) {                            
                            return true;
                        } else {
                            return false;
                        }
                    }else{
                        return false;
                    }
                } else {
                    return false;
                }
            }elseif (!strcasecmp(get_class($resource), self::RESOURCE_COURSE_COURSE_APPLICATION)) {
                $role = ["INSTRUCTOR"];
                //die($user->getRole());
                if (in_array($user->getRole(), $role)) {
                    if ($owner) {                                               
                        if ($user->isCourseOwner($resource)) {                            
                            return true;
                        } else {
                            return false;
                        }
                    }else{
                        return false;
                    }
                } else {
                    return false;
                }
            }elseif (!strcasecmp(get_class($resource), self::RESOURCE_COURSE)) {
                $role = ["ADMINISTRATOR", "INSTRUCTOR", "LEARNER","PARENT","GUEST"];
                if (in_array($user->getRole(), $role)) {
                    return true;
                } else {
                    return false;
                }
            }elseif (!strcasecmp(get_class($resource), self::RESOURCE_ACCOUNT_ACCOUNT_COURSE)) {
                $role = ["ADMINISTRATOR", "INSTRUCTOR", "LEARNER","PARENT"];
                if (in_array($user->getRole(), $role)) {
                    return true;
                } else {
                    return false;
                }
            }elseif (!strcasecmp(get_class($resource), self::RESOURCE_COURSE_COURSE)) {
                $role = ["INSTRUCTOR", "LEARNER","GUEST"];
                if (in_array($user->getRole(), $role)) {
                    return true;
                } else {
                    return false;
                }
            }elseif (!strcasecmp(get_class($resource), self::RESOURCE_BOOK)) {
                $role = ["ADMINISTRATOR","INSTRUCTOR","LEARNER","GUEST"];
                if (in_array($user->getRole(), $role)) {                    
                    return true;
                } else {
                    return false;
                }
            }elseif (!strcasecmp(get_class($resource), self::RESOURCE_BOOK_CATEGORY)) {
                $role = ["ADMINISTRATOR","INSTRUCTOR","LEARNER"];
                if (in_array($user->getRole(), $role)) {                    
                    return true;
                } else {
                    return false;
                }
            }
            elseif (!strcasecmp(get_class($resource), self::RESOURCE_COURSE_SEARCH)) {
                $role = ["ADMINISTRATOR","INSTRUCTOR","LEARNER","GUEST"];
                //var_dump($user->getRole());die();
                if (in_array($user->getRole(), $role)) {                    
                    return true;
                } else {
                    return false;
                }
            }
            elseif (!strcasecmp(get_class($resource), self::RESOURCE_BOOK_SEARCH)) {
                $role = ["ADMINISTRATOR","INSTRUCTOR","LEARNER","GUEST"];
                if (in_array($user->getRole(), $role)) {                    
                    return true;
                } else {
                    return false;
                }
            }
		}
	}
}
