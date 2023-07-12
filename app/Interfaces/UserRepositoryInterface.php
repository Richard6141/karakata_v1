<?php

namespace App\Interfaces;

interface UserRepositoryInterface 
{
    public function getAllUsers();
    public function getUserByDate(String $date);
    public function getUserById(String $userId);
    public function UserPerDate();
    public function UserPerMonth();
    public function getUsersByPeriod(Object $data);
}