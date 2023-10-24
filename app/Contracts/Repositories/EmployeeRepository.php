<?php

namespace App\Contracts\Repositories;

interface EmployeeRepository extends BaseRepository
{
    public function all();
    public function paginate($items = null);
    public function find($id);
    public function checkLogin($email,$password);
    public function getEmployeeByEmail($email);
    public function searchEmployee($data = []);
    public function getEmployeeById($id);        
}

