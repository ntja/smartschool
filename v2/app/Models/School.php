<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Exception;
use App\Repositories\Util\LogRepository;

class School extends Authenticatable{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $table = 'schools';
    public $timestamps = false;
    protected $fillable = [
        'name','shortname','logo','address','description','banner','homelink','location','location_city','location_country','location_lon','location_lat','website','webtwitter','webfacebook','webyoutube','pagebanner','city'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    public function __construct() {           
        return $this;
    }
        
    public function course(){
        return $this->hasMany('App\Models\Course');
    }

    public function dbSave($params) {
		//var_dump($params);die();
        try {            
            if (!is_array($params)){
				throw new Exception("Expected Array as parameter, " . (is_object($params) ? get_class($params) : gettype($params)) . ' given.');
			}                

            if (array_key_exists("name", $params)) {
                if (!is_string($params['name'])) {
                    throw new Exception("Expected String for key (name), " . (is_object($params['name']) ? get_class($params['name']) : gettype($params['name'])) . ' found.');
                }
                $this->name = $params['name'];
            }
            if (array_key_exists("shortname", $params)) {
                if (!is_string($params['shortname'])) {
                    throw new Exception("Expected String for key (shortname), " . (is_object($params['shortname']) ? get_class($params['shortname']) : gettype($params['shortname'])) . ' found.');
                }
                $this->shortname = $params['shortname'];
            }

            if (array_key_exists("logo", $params)) {
                if (!is_string($params['logo'])) {
                    throw new Exception("Expected String for key (logo), " . (is_object($params['logo']) ? get_class($params['logo']) : gettype($params['logo'])) . ' found.');
                }
                $this->logo = $params['logo'];
            }
            if (array_key_exists("address", $params)) {
                if (!is_null($params['address'])) {
                    if (!is_string($params['address'])) {
                        throw new Exception("Expected String for key (address), " . (is_object($params['address']) ? get_class($params['address']) : gettype($params['address'])) . ' found.');
                    }
                }                
                $this->address = $params['address'];
            }
            if (array_key_exists("description", $params)) {
                if (!is_null($params['description'])) {
                    if (!is_string($params['description'])) {
                        throw new Exception("Expected String for key (description), " . (is_object($params['description']) ? get_class($params['description']) : gettype($params['description'])) . ' found.');
                    }
                }                
                $this->description = $params['description'];
            }
            if (array_key_exists("banner", $params)) {
                if (!is_null($params['banner'])) {
                    if (!is_string($params['banner'])) {
                        throw new Exception("Expected String for key (banner), " . (is_object($params['banner']) ? get_class($params['banner']) : gettype($params['banner'])) . ' found.');
                    }
                }                
                $this->banner = $params['banner'];
            }
            if (array_key_exists("homelink", $params)) {
                if (!is_null($params['homelink'])) {
                    if (!is_string($params['homelink'])) {
                        throw new Exception("Expected String for key (homelink), " . (is_object($params['homelink']) ? get_class($params['homelink']) : gettype($params['homelink'])) . ' found.');
                    }
                }                
                $this->homelink = $params['homelink'];
            }
            if (array_key_exists("location", $params)) {
                if (!is_null($params['location'])) {
                    if (!is_string($params['location'])) {
                        throw new Exception("Expected String for key (location), " . (is_object($params['location']) ? get_class($params['location']) : gettype($params['location'])) . ' found.');
                    }
                }                
                $this->location = $params['location'];
            }
            if (array_key_exists("location_city", $params)) {
                if (!is_null($params['location_city'])) {
                    if (!is_string($params['location_city'])) {
                        throw new Exception("Expected String for key (location_city), " . (is_object($params['location_city']) ? get_class($params['location_city']) : gettype($params['location_city'])) . ' found.');
                    }
                }                
                $this->location_city = $params['location_city'];
            }            

            if (array_key_exists("location_country", $params)) {
                if (!is_null($params['location_country'])) {
                    if (!is_numeric($params['location_country'])) {
                        throw new Exception("Expected Numeric for key (location_country), " . (is_object($params['location_country']) ? get_class($params['location_country']) : gettype($params['location_country'])) . ' found.');
                    }
                }                
                $this->location_country = $params['location_country'];
            }
            if (array_key_exists("location_lon", $params)) {
                if (!is_null($params['location_lon'])) {
                    if (!is_numeric($params['location_lon'])) {
                        throw new Exception("Expected Numeric for key (location_lon), " . (is_object($params['location_lon']) ? get_class($params['location_lon']) : gettype($params['location_lon'])) . ' found.');
                    }
                }                
                $this->location_lon = $params['location_lon'];
            }
            if (array_key_exists("location_lat", $params)) {
                if (!is_null($params['location_lat'])) {
                    if (!is_numeric($params['location_lat'])) {
                        throw new Exception("Expected Numeric for key (location_lat), " . (is_object($params['location_lat']) ? get_class($params['location_lat']) : gettype($params['location_lat'])) . ' found.');
                    }
                }                
                $this->location_lat = $params['location_lat'];
            }
            if (array_key_exists("website", $params)) {
                if (!is_null($params['website'])) {
                    if (!is_string($params['website'])) {
                        throw new Exception("Expected String for key (website), " . (is_object($params['website']) ? get_class($params['website']) : gettype($params['website'])) . ' found.');
                    }
                }                
                $this->website = $params['website'];
            }
            if (array_key_exists("city", $params)) {
                if (!is_null($params['city'])) {
                    if (!is_numeric($params['city'])) {
                        throw new Exception("Expected Numeric for key (city), " . (is_object($params['city']) ? get_class($params['city']) : gettype($params['city'])) . ' found.');
                    }
                }                
                $this->city = $params['city'];
            }
            if (array_key_exists("webtwitter", $params)) {
                if (!is_null($params['webtwitter'])) {
                    if (!is_string($params['webtwitter'])) {
                        throw new Exception("Expected String for key (webtwitter), " . (is_object($params['webtwitter']) ? get_class($params['webtwitter']) : gettype($params['webtwitter'])) . ' found.');
                    }
                }                
                $this->webtwitter = $params['webtwitter'];
            }
            if (array_key_exists("webfacebook", $params)) {
                if (!is_null($params['webfacebook'])) {
                    if (!is_string($params['webfacebook'])) {
                        throw new Exception("Expected String for key (webfacebook), " . (is_object($params['webfacebook']) ? get_class($params['webfacebook']) : gettype($params['webfacebook'])) . ' found.');
                    }
                }                
                $this->webfacebook = $params['webfacebook'];
            }
            if (array_key_exists("webyoutube", $params)) {
                if (!is_null($params['webyoutube'])) {
                    if (!is_string($params['webyoutube'])) {
                        throw new Exception("Expected String for key (webyoutube), " . (is_object($params['webyoutube']) ? get_class($params['webyoutube']) : gettype($params['webyoutube'])) . ' found.');
                    }
                }                
                $this->webyoutube = $params['webyoutube'];
            }
            if (array_key_exists("pagebanner", $params)) {
                if (!is_null($params['pagebanner'])) {
                    if (!is_string($params['pagebanner'])) {
                        throw new Exception("Expected String for key (pagebanner), " . (is_object($params['pagebanner']) ? get_class($params['pagebanner']) : gettype($params['pagebanner'])) . ' found.');
                    }
                }                
                $this->pagebanner = $params['pagebanner'];
            }            
            if (array_key_exists("date_created", $params)) {
                if (!is_string($params['date_created'])) {
                    throw new Exception("Expected String for key (date_created), " . (is_object($params['date_created']) ? get_class($params['date_created']) : gettype($params['date_created'])) . ' found.');
                }
                $this->date_created = $params['date_created'];
            }            

			//var_dump($params);die();
            return $this->save();
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage() . " in ". $ex->getFile(). " at line ". $ex->getLine());
        }
    }
}