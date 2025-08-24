<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    // Método para registrar usuário
    public function registrar(Request $request)
    {
        // Validação dos dados recebidos
        $request->validate([
            'email' => 'required|email|unique:usuario,email',
            'senha' => 'required|min:6',
            'telefone' => 'nullable',
            'id_nivelusu' => 'required|exists:niveis_usuario,id_nivelusu',
            'id_status' => 'required|exists:status,id_status'
        ]);


        // Retornar resposta JSON
        return response()->json([
            'mensagem' => 'Usuário registrado com sucesso!',
            'usuario' => $usuario
        ]);
    }

    // Método para login
    public function entrar(Request $request)
    {
        // Validar campos obrigatórios
        $request->validate([
            'email' => 'required|email',
            'senha' => 'required'
        ]);

        // Buscar usuário pelo e-mail
        $usuario = Usuario::where('email', $request->email)->first();

        // Verificar senha
        if (!$usuario || !Hash::check($request->senha, $usuario->senha)) {
            return response()->json([
                'mensagem' => 'E-mail ou senha incorretos'
            ], 401);
        }

        // Login bem-sucedido
        return response()->json([
            'mensagem' => 'Login realizado com sucesso!',
            'usuario' => $usuario
        ]);
    }
}
