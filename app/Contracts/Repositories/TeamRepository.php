<?php

namespace App\Contracts\Repositories;

interface TeamRepository extends BaseRepository
{
    public function all();
    public function paginate($items = null);
    public function find($id);
    public function searchTeamName($name);
    public function getTeamName();
    public function getTeamIdByName($name);
}
