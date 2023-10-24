<?php

namespace App\Helpers;

use Carbon\Carbon;
use App\Contracts\Repositories\PositionRepository;
use App\Contracts\Repositories\TeamRepository;
use App\Contracts\Repositories\TypeOfWorkRepository;
use App\Helpers\Constant;


class ProcessData
{
    protected $teamRepository;
    protected $typeOfWorkRepository;
    protected $positionRepository;

    public function __construct(
        TeamRepository $teamRepository,
        TypeOfWorkRepository $typeOfWorkRepository,
        PositionRepository $positionRepository,

    ) {
        $this->teamRepository = $teamRepository;
        $this->typeOfWorkRepository = $typeOfWorkRepository;
        $this->positionRepository = $positionRepository;
    }

    public function processEmployeeDataUpdate($data)
    {
       
        $team_id = $this->teamRepository->getTeamIdByName($data['team_id']);
        $typeOfWorkId = $this->typeOfWorkRepository->getTypeOfWorkIdbyName($data['type_of_work']);
        $positionId = $this->positionRepository->getPositionIdByName($data['position']);
        $arrayImage = explode("\\" ,$data['avatar_image_hidden']);
        $ImageName = end($arrayImage);
        $data['avatar'] = $ImageName;
        unset($data['avatar_image_hidden']);
        $password = bcrypt($data['password']);
        $data['password'] = $password;
        // dd($data);
        $birthday = Carbon::createFromFormat('d/m/Y', $data['birthday']);
        $data['birthday'] = $birthday->format('Y-m-d');
        $data['team_id'] = $team_id;
        $data['position'] = $positionId;
        $data['type_of_work'] = $typeOfWorkId;
        $data['gender'] = ($data['gender'] === 'Male') ? Constant::MALE : Constant::FEMALE;
        $data['status'] = ($data['status'] === 'On Working') ? Constant::WORKING : Constant::RETIRED;
        return $data;
    }
    public function processData($data)
    {
        // dd($data);
        
        $data['team_name'] = $this->teamRepository->find($data->input('team_name'));
        $data['type_of_work'] = $this->typeOfWorkRepository->find($data->input('type_of_work'));
        $data['positions'] = $this->positionRepository->find($data->input('position'));
        $data['request'] = $data;
        $data['avatar'] = FileHelper::storeImage($data, 'public/images');
        $arrayImage = explode("\\" ,$data['avatar_image_hidden']);
        $ImageName = end($arrayImage);
        $data['avatar_image_hidden']  = $ImageName;
        // dd($data);
        return $data;
    }
}
