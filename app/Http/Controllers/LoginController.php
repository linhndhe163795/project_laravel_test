<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Contracts\Repositories\EmployeeRepository;
use App\Helpers\Constant;
use App\Http\Middleware\Authenticate;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $employeeRespoitory;
    public function __construct(EmployeeRepository $employeeRepository)
    {   
        $this->employeeRespoitory = $employeeRepository;
    }

    public function home()
    {
        return view('clients.home');
    }

    public function login()
    {
        return view('clients.login');
    }

    public function loginPost(Request $request)
    {
        $email = $request->input('email');
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'del_flag' => Constant::DEL_FLAG_ACTIVE])) {
            $profile = $this->employeeRespoitory->getEmployeeByEmail($email);
            Session::put("profile", [[
                'id' => $profile->id,
                'email' => $profile->email
            ]]);
            return redirect(route('home'));
        } else {
            return redirect(route('login'))->with('error', 'Incorrect Input');
        }
    }
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect(route('login'));
    }
}
