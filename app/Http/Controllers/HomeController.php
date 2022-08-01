<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $users = DB::table('users')
        ->join('ps_permissao_sistema', 'ps_permissao_sistema.u_id', 'users.co_usuario')
        ->where('sistema', 1)
        ->where('in_ativo','S')
        ->whereIn('tipo_usuario', [0,1,2])
        ->whereNull('users.deleted_at')
        ->get();
        return view('home', [
            'users' => $users
        ]);
    }

    public function get_users(Request $request)
    {
        $users=[];
        switch ($request->user_type) {
            case 'consultor':
                $users = DB::table('users')
                ->join('ps_permissao_sistema', 'ps_permissao_sistema.u_id', 'users.co_usuario')
                ->where('sistema', 1)
                ->where('in_ativo','S')
                ->whereIn('tipo_usuario', [0,1,2])
                ->whereNull('users.deleted_at')
                ->get();
                break;
            
            default:
                # code...
                break;
        }
        $listUsers = [];
        $response = [];

        if(count($users) > 0){
            foreach($users as $user){
                array_push($listUsers,[
                    'name' => $user->no_usuario,
                    'id' => $user->co_usuario,
                ]);
            }
            $response = array(
                'listUsers' => $listUsers,
                'status' => true,
                'msg' => null
            );

        }else{
            $response = array(
                'listUsers' => null,
                'status' => false,
                'msg' => 'Nenhum usuário foi encontrado'
            );
        }

        return $response;
        
    }
}
