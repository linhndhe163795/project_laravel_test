<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\EmployeeRepository;
use App\Contracts\Repositories\PositionRepository;
use App\Contracts\Repositories\TeamRepository;
use App\Contracts\Repositories\TypeOfWorkRepository;
use App\Exports\EmployeeExport;
use App\Http\Requests\ValidationRequest;
use Illuminate\Http\Request;
use App\Helpers\Constant;
use App\Helpers\FileHelper;
use App\Helpers\ProcessData;
use App\Jobs\SendEmailJob;
use Maatwebsite\Excel\Facades\Excel;


class EmployeeManagementController extends Controller
{
    protected $employeeRepository;
    protected $teamRepository;
    protected $positionRepository;
    protected $typeOfWorkRepository;
    protected $processData;
    public function __construct(
        EmployeeRepository $employeeRepository,
        TeamRepository $teamRepository,
        PositionRepository $positionRepository,
        TypeOfWorkRepository $typeOfWorkRepository,
        ProcessData $processData
    ) {
        $this->middleware('auth');
        $this->employeeRepository = $employeeRepository;
        $this->teamRepository = $teamRepository;
        $this->positionRepository = $positionRepository;
        $this->typeOfWorkRepository = $typeOfWorkRepository;
        $this->processData = $processData;
    }

    public function home()
    {
        return view('clients.home');
    }
    public function search(Request $request)
    {
        if ($request->has('search')) {
            $data = $request->all();
            $teamName = $this->teamRepository->getTeamName();
            $listEmployee = $this->employeeRepository->searchEmployee($data);
            return view('clients.employee.search_employee', compact('listEmployee', 'teamName', 'request'));
        }
        if ($request->has('export')) {
            $data = $request->all();
            return Excel::download(new EmployeeExport($this->employeeRepository, $request), 'employee-csv.csv');
        } else {
            $data = $request->all();
            $teamName = $this->teamRepository->getTeamName();
            $listEmployee = $this->employeeRepository->searchEmployee($data);
            return view('clients.employee.search_employee', compact('teamName','listEmployee'));
        }
    }

    public function create(Request $request)
    {
        $teamName = $this->teamRepository->getTeamName();
        $position = $this->positionRepository->all();
        $typeOfWork = $this->typeOfWorkRepository->all();
        return view('clients.employee.create_employee', compact('position', 'typeOfWork', 'teamName'));
    }

    public function createConfirm(ValidationRequest $validationRequest)
    {
        $data = $validationRequest->all();
        if ($validationRequest->has('save')) {
            $data = $validationRequest->all();
            $processedData = $this->processData->processEmployeeDataUpdate($data);
            $teamName = $this->teamRepository->getTeamName();
            $this->employeeRepository->create($processedData);
            
            $email = $processedData['email'];
            dispatch(new SendEmailJob([
                'email' => $email,
                'first_name' => $processedData['first_name'],
                'last_name' => $processedData['last_name'],
            ]));
            $listEmployee = $this->employeeRepository->searchEmployee($data);
            $message = Constant::MESSAGE_CREATE_EMPLOYEE;
            return view('clients.employee.search_employee', compact('message', 'teamName','listEmployee'));
        } else {
            $currentDateTime = date('Y-m-d H:i:s');
            $request  = $this->processData->processData($validationRequest);
            return view('clients.employee.create_employee_confirm', compact('request', 'currentDateTime'));
        }
    }
    public function edit($id)
    {
        $teamName = $this->teamRepository->getTeamName();
        $position = $this->positionRepository->all();
        $typeOfWork = $this->typeOfWorkRepository->all();
        $employeeDetails = $this->employeeRepository->getEmployeeById($id);
        if ($employeeDetails == null) {
            $message = 'Do not exist employee !!! ';
            return view('clients.employee.search_employee', compact('message', 'teamName', 'message'));
        }
        return view('clients.employee.edit_employee', compact('position', 'typeOfWork', 'teamName', 'employeeDetails'));
    }
    public function editConfirm(ValidationRequest $validationRequest)
    {
        $position = $this->positionRepository->all();
        $teamName = $this->teamRepository->getTeamName();
        $typeOfWork = $this->typeOfWorkRepository->all();
        $data = $validationRequest->all();
        if ($validationRequest->has('save')) {
            $id = $validationRequest->input('id');
           
            $processedData = $this->processData->processEmployeeDataUpdate($data);
            $emailEmployee = $this->employeeRepository->find($id);
            $newEmail = $validationRequest->input('email');
            $this->employeeRepository->update($id, $processedData);
            if ($validationRequest->input('email') !== $emailEmployee->email) {
                FileHelper::SendMailToUser($processedData, $newEmail);
            }
            $listEmployee = $this->employeeRepository->searchEmployee($data);
            $message = Constant::MESSAGE_UPDATE_EMPLOYEE;
            return view('clients.employee.search_employee', compact('message', 'teamName','listEmployee'));
        }
        if ($validationRequest->has('back')) {
            $request = $validationRequest->all();
            return view('clients.employee.edit_employee', compact('request', 'teamName', 'position', 'typeOfWork'));
        } else {
            $id = $validationRequest->input('id');
            $employeeDetails = $this->employeeRepository->getEmployeeById($id);
            $currentDateTime = date('Y-m-d H:i:s');
            $request  = $this->processData->processData($validationRequest);
            return view('clients.employee.edit_employee_confirm', compact('request', 'currentDateTime', 'employeeDetails'));
        }
    }

    public function delete(Request $request)
    {
        $Employee = $this->employeeRepository->find($request->input('id'));
        $listEmployee = $this->employeeRepository->searchEmployee($request->all());
        $data = $request->all();
        $teamName = $this->teamRepository->getTeamName();
        if($Employee == null){
            $message = 'Do not exist employee !!! ';
            return view('clients.employee.search_employee', compact('message', 'teamName','listEmployee'));
        }
        $this->employeeRepository->update($request->input('id'), $data);
        $message = Constant::MESSAGE_DELETE_EMPLOYEE;
        return view('clients.employee.search_employee', compact('message', 'teamName','listEmployee'));
    }
}
