<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Services\UserService;

class RegisterController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function index() {
        return view('auth.escolha');
    }

    public function indexLider() {
        return view('auth.cadastroLider');
    }

    public function indexUser() {
        return view('auth.cadastroUsuario');
    }

    public function registerUser(Request $request) {
        $password = $request->password;
        $password_confirmation = $request->password_confirmation;

        if ($password === $password_confirmation) {            
            $user = $this->userService->createUser($request->all());
            return view('auth.login');
        }

    }
}
