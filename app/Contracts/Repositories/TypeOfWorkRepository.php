<?php

namespace App\Contracts\Repositories;

interface TypeOfWorkRepository extends BaseRepository
{
    public function all();
    public function paginate($items = null);
    public function find($id);
    public function getTypeOfWorkIdbyName($name);
}
