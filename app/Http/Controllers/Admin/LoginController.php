<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\loginCheckRequest;
use App\Services\AdministratorService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    protected $administratorService;
    public function __construct(AdministratorService $administratorService)
    {
        $this->administratorService = $administratorService;
    }

    //
    public function loginSubmit(LoginCheckRequest $request){
        $data = $this->administratorService->loginCheck($request);
        dd($data);
    }
}
