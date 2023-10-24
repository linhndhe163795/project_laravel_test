<?php

namespace App\Repositories\Eloquents;

use App\Contracts\Repositories\EmployeeRepository;
use App\Helpers\Constant;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;

class EloquentEmployeeRepository extends EloquentBaseRepository implements EmployeeRepository
{
    protected $model;
    use Sortable;
    public function __construct(Employee $model)
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
    public function checkLogin($email, $password)
    {
        $check =  $this->model->select('email', 'password')
            ->where('email', '=', $email)
            ->where('password', '=', $password)
            ->where('m_employees.del_flag', '=', Constant::DEL_FLAG_ACTIVE)
            ->first();
        return $check ? true : false;
    }
    public function getEmployeeByEmail($email)
    {
        $employee = $this->model->select('*')
            ->where('email', '=', $email)
            ->where('m_employees.del_flag', '=', Constant::DEL_FLAG_ACTIVE)
            ->first();
        return $employee;
    }
    public function searchEmployee($data = [])
    {
        $query = $this->model->select(
            'm_employees.id',
            DB::raw('(m_teams.name) as Team'),
            DB::raw('CONCAT(m_employees.first_name, " ", m_employees.last_name) AS Name'),
            'm_employees.email'
        )->join('m_teams', 'm_teams.id', '=', 'm_employees.team_id')
            ->where('m_employees.del_flag', '=', Constant::DEL_FLAG_ACTIVE)
            ->where('m_teams.del_flag', '=', Constant::DEL_FLAG_ACTIVE);

        if (!empty($data['name'])) {
            $query->where(DB::raw('CONCAT(m_employees.first_name, " ", m_employees.last_name)'), 'like', '%' . $data['name'] . '%');
        }

        if (!empty($data['email'])) {
            $query->where('m_employees.email', 'like', '%' . $data['email'] . '%');
        }

        if (!empty($data['teamName'])) {
            $query->where('m_teams.name', 'like', '%' . $data['teamName'] . '%');
        }

        if (isset($data['sort']) && isset($data['direction'])) {
            $listEmployee = $query->orderBy($data['sort'], $data['direction'])->paginate(Constant::PAGING);
        } else {
            $listEmployee = $query->paginate(Constant::PAGING);
        }
        return $listEmployee;
    }
    public function getEmployeeById($id)
    {
        $employee = $this->model->select(
            'm_employees.id',
            'email',
            'first_name',
            'last_name',
            'password',
            'gender',
            'birthday',
            'address',
            'avatar',
            'salary',
            'm_position.name as position',
            'status',
            'm_type_of_work.type_of_work',
            'm_teams.name'
        )

            ->join('m_teams', 'm_teams.id', '=', 'm_employees.team_id')
            ->join('m_type_of_work', 'm_type_of_work.id', '=', 'm_employees.type_of_work')
            ->join('m_position', 'm_position.id', '=', 'm_employees.position')
            ->where('m_employees.id', '=', $id)
            ->where('m_employees.del_flag', '=', Constant::DEL_FLAG_ACTIVE)
            ->first();
        return $employee;
    }
}
