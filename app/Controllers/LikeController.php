<?php

namespace App\Controllers;

use App\Models\LikeModel;

class LikeController extends BaseController
{
    public function toggle($postId)
    {
        $likeModel = new LikeModel();
        $usuarioId = session()->get('usuario_id');

        $like = $likeModel
            ->where('postagem_id', $postId)
            ->where('usuario_id', $usuarioId)
            ->first();

        if ($like) {
            $likeModel->delete($like['id']);
        } else {
            $likeModel->save([
                'postagem_id' => $postId,
                'usuario_id' => $usuarioId
            ]);
        }

        return redirect()->to('/feed');
    }
}