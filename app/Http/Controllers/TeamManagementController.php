<?php


namespace App\Http\Controllers;

use App\Contracts\Repositories\TeamRepository;
use App\Helpers\Constant;
use App\Http\Requests\ValidationRequest;
use Illuminate\Http\Request;

class TeamManagementController extends Controller
{
    protected $teamRepository;
    public function __construct(TeamRepository $teamRepository)
    {
        $this->middleware('auth');
        $this->teamRepository = $teamRepository;
    }

    public function search(Request $request)
    {
        if ($request->has('search')) {
            $name = $request->input('name');
            $data = $request->all();
            $webName = $this->teamRepository->searchTeamName($name,$data);
            return  view("clients.team.search_team", compact('webName', 'name','request'));
        }else{
            return  view("clients.team.search_team");
        }
       
    }

    public function edit(Request $request)
    {
        $name = $request->input('name');
        $webName = $this->teamRepository->searchTeamName($name);
        $teamTitle = $this->teamRepository->find($request->id);
        if($teamTitle == null){
            $message = 'Do not exist team !!! ';
            return  view("clients.team.search_team", compact('webName', 'name','request','message'));
        }
        return view("clients.team.edit_team", compact(['teamTitle']));
    }

    public function editConfirm(ValidationRequest $request)
    {
        if ($request->has("save")) {
            $id = $request->id;
            $data = $request->all();
            $this->teamRepository->update($id, $data);
            $message =Constant::MESSAGE_UPDATE_TEAM;
            return view('clients.team.search_team', compact('message'));
        } else {
            $nameAfter =  $request->input('name');
            $teamTitle = $this->teamRepository->find($request->id);
            return view('clients.team.edit_confirm_team', compact('request', 'nameAfter', 'teamTitle'));
        }
    }

    public function create()
    {
        return view('clients.team.create_team');
    }

    public function createConfirm(ValidationRequest $request)
    {
        if ($request->has('save')) {
            $data = $request->all();
            $this->teamRepository->create($data);
            $message = Constant::MESSAGE_CREATE_TEAM;
            return view('clients.team.search_team', compact('message'));
        } else {
            $currentDateTime = date('Y-m-d H:i:s');
            return view('clients.team.create_confirm_team', compact('request','currentDateTime'));
        }
    }
    public function delete(Request $request)
    {
        $data = $request->all();
        $listTeam = $this->teamRepository->find($request->input('id'));

        if($listTeam == null){
            $message = "Do not exsit team !!!";
            return view('clients.team.search_team', compact('message'));
        }
        $this->teamRepository->update($request->input('id'), $data);
        $message = Constant::MESSAGE_DELETE_TEAM;
        return view('clients.team.search_team', compact('message'));
    }
}
