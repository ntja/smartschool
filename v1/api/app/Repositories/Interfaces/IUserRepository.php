<?php namespace MyCompany\Repositories\Interfaces;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author ThaWeezy
 */
interface IUserRepository {
    //put your code here
    
    /**
     * Get all users
     */
    public function getAllUsers();
    
    /**
     * get user by $id
     * 
     * @param Integer $id
     * 
     * @return array $user
     */
    public function getUserById($id);
}
