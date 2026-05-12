<?php

namespace App\Models;

use CodeIgniter\Model;

class PostagemModel extends Model
{
    protected $table = 'postagens';
    protected $allowedFields = ['usuario_id', 'texto', 'imagem'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';

    public function getPosts()
    {
        return $this->select('postagens.*, usuarios.nome')
            ->join('usuarios', 'usuarios.id = postagens.usuario_id')
            ->orderBy('postagens.created_at', 'DESC')
            ->findAll();
    }
}