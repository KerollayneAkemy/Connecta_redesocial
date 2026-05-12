<?php

namespace App\Models;

use CodeIgniter\Model;

class LikeModel extends Model
{
    protected $table = 'likes';
    protected $allowedFields = ['postagem_id', 'usuario_id'];
}