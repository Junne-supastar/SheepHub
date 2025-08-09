<?php 

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService {
    public function createUser(array $data): User {
        $password = Hash::make($data['password']);

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $password,
            'nivel' => '3',
            'atividade' => '1',
            'telefone' => '21999999999',
        ]);
    }
}

?>