<?php

namespace App\Repositories\Util;

use App\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Auth\Access\HandlesAuthorization;

class AclPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    
    private $userCnx;


    public function __construct()
    {
        $userCnx = Auth::user();
        
        if ($this->userCnx)
        {
            $this->userCnx = $userCnx->id;
        }
    }
  
    function createAccommodation($userCnx) {
        $user = new User();
        if($user->getRole() === 'Member'){
            return true;
        } else {
            return false;
        }
    }
}
