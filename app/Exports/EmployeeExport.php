<?php

namespace App\Exports;

use App\Contracts\Repositories\EmployeeRepository;
use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\IlluminateContractsViewView;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromView;
class EmployeeExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $employeeRepository;
    protected $request;
       public function __construct(EmployeeRepository $employeeRepository,Request $request) {
        $this->employeeRepository = $employeeRepository;
        $this->request = $request;
       }
       public function collection()
       {
            return $this->employeeRepository->searchEmployee($this->request->all());
       }
   
}
