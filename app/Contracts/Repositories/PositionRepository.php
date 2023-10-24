<?php

namespace App\Contracts\Repositories;

interface PositionRepository extends BaseRepository
{
    public function all();
    public function paginate($items = null);
    public function find($id);
    public function getPositionIdByName($name);
}
