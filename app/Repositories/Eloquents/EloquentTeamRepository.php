<?php

namespace App\Repositories\Eloquents;

use App\Contracts\Repositories\TeamRepository;
use App\Models\Team;
use App\Helpers\Constant;
use Kyslik\ColumnSortable\Sortable;

class EloquentTeamRepository extends EloquentBaseRepository implements TeamRepository
{
    use Sortable;
    protected $model;

    public function __construct(Team $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function paginate($items = null)
    {
        return $this->model->paginate($items);
    }
    public function searchTeamName($name, $data = [])
    {

        $query = $this->model->select('id', 'name')
            ->where('del_flag', '=', Constant::DEL_FLAG_ACTIVE);

        if ($name !== null && $name !== '') {
            $query->where('name', 'like', '%' . $name . '%')
                ->where('del_flag', '=', Constant::DEL_FLAG_ACTIVE);
        }
        if (isset($data['sort']) && isset($data['direction'])) {
            $listTeamName = $query->orderBy($data['sort'], $data['direction'])->paginate(Constant::PAGING);
        } else {
            $listTeamName = $query->paginate(Constant::PAGING);
        }


        return $listTeamName;
    }
    public function getTeamName()
    {

        $listTeamName = $this->model->select('id', 'name')
            ->where('del_flag', '=', Constant::DEL_FLAG_ACTIVE)->get();
        return $listTeamName;
    }
    public function getTeamIdByName($name)
    {
        $team_id = $this->model->select('id')
            ->where('del_flag', '=', Constant::DEL_FLAG_ACTIVE)
            ->where('name', '=', $name)->first();
        return $team_id->id;
    }
}
