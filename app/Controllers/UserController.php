<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\PostagemModel;
use App\Models\SeguidorModel;

class UserController extends BaseController
{
    public function meuPerfil()
    {
        $userId = session()->get('usuario_id');

        if (!$userId) {
            return redirect()->to('/login');
        }

        $usuarioModel = new UsuarioModel();
        $postModel = new PostagemModel();
        $seguidorModel = new SeguidorModel();

        $usuario = $usuarioModel->find($userId);

        $posts = $postModel
            ->where('usuario_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        $seguidores = $seguidorModel->where('seguido_id', $userId)->countAllResults();
        $seguindo = $seguidorModel->where('seguidor_id', $userId)->countAllResults();

        return view('perfil', compact('usuario', 'posts', 'seguidores', 'seguindo'));
    }

    public function perfil($id)
    {
        $usuarioModel = new UsuarioModel();
        $postModel = new PostagemModel();
        $seguidorModel = new SeguidorModel();

        $usuario = $usuarioModel->find($id);

        $posts = $postModel
            ->where('usuario_id', $id)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        $meuId = session()->get('usuario_id');

        $seguidores = $seguidorModel->where('seguido_id', $id)->countAllResults();
        $seguindo = $seguidorModel->where('seguidor_id', $id)->countAllResults();

        $jaSegue = $seguidorModel
            ->where('seguidor_id', $meuId)
            ->where('seguido_id', $id)
            ->first();

        return view('perfil', compact('usuario', 'posts', 'seguidores', 'seguindo', 'jaSegue'));
    }

    public function follow($id)
    {
        $seguidorModel = new SeguidorModel();
        $meuId = session()->get('usuario_id');

        $existe = $seguidorModel
            ->where('seguidor_id', $meuId)
            ->where('seguido_id', $id)
            ->first();

        if ($existe) {
            $seguidorModel->delete($existe['id']);
        } else {
            $seguidorModel->insert([
                'seguidor_id' => $meuId,
                'seguido_id' => $id
            ]);
        }

        return redirect()->back();
    }
}