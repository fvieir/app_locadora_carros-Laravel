<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // autenticação por email e senha para depois liberar token
        // retornar um token jwt
        $credenciais = $request->all(['email', 'password']);

        $token = auth('api')->attempt($credenciais);
    
        if ($token) {
            // usuário autenticado
            return \response()->json(['token' => $token], 200);
        } else {
            // erro de usuario ou senha
            // 403 = forbidden => proibido (login invalido)
            //401 = Unauthorized => Não autorizado
            return \response()->json(['erro' => 'Usuário ou senha inválido'], 403);
        }
        return 'login';
    }

    public function logout()
    {
        \auth('api')->logout();
        return \response()->json(['msg' => 'Logout feito com sucesso!']);
    }

    public function refresh()
    {
        $token = \auth('api')->refresh();
        return \response()->json(['token' => $token]);
    }
   
    public function me()
    {
        return response()->json(\auth()->user(), 200);
    }
}
