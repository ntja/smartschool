<?php 

namespace app\Repositories;

use app\Repositories\Interfaces\IUserRepository;
use app\User;
/**
 * Description of UserRepository
 *
 * @author ThaWeezy
 */
class UserRepository implements IUserRepository{
    //put your code here
    private $user;


    public function __construct(User $user) {
        $this->user = $user;
    }


    public function getAllUsers() {
        return $this->user->all();
    }
    
    public function getUserById($id) {
        return $this->user->findOrNew($id);
    }
    
    public function __call($name, $arguments) {
        return call_user_func_array([$this->user,$name], $arguments);
    }
}
