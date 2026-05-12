<?php

namespace App\Controllers;

use App\Models\LikeModel;

class LikeController extends BaseController
{
    public function like($postId)
    {
        $userId = session()->get('usuario_id');

        $likeModel = new LikeModel();

        $exists = $likeModel->where([
            'user_id' => $userId,
            'post_id' => $postId
        ])->first();

        if (!$exists) {
            $likeModel->insert([
                'user_id' => $userId,
                'post_id' => $postId
            ]);
        }

        return $this->returnLikes($postId);
    }

    public function dislike($postId)
    {
        $userId = session()->get('usuario_id');

        $likeModel = new LikeModel();

        $likeModel->where([
            'user_id' => $userId,
            'post_id' => $postId
        ])->delete();

        return $this->returnLikes($postId);
    }

    private function returnLikes($postId)
    {
        $db = db_connect();

        $count = $db->table('likes')
            ->where('post_id', $postId)
            ->countAllResults();

        return $this->response->setJSON([
            'likes' => (int) $count
        ]);
    }
}