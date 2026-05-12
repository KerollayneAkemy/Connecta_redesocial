<?php

namespace App\Controllers;

use App\Models\PostagemModel;
use App\Models\LikeModel;
use App\Models\ComentarioModel;
use App\Models\UsuarioModel;

class PostController extends BaseController
{
    public function index()
    {
        $postModel = new PostagemModel();
        $likeModel = new LikeModel();
        $comentarioModel = new ComentarioModel();

        $posts = $postModel->getPosts();

        foreach ($posts as &$post) {

            $post['likes'] = $likeModel
                ->where('postagem_id', $post['id'])
                ->countAllResults();

            $post['curtiu'] = $likeModel
                ->where('postagem_id', $post['id'])
                ->where('usuario_id', session()->get('usuario_id'))
                ->first() ? true : false;
                
            $post['comentarios'] = $comentarioModel
                ->select('comentarios.*, usuarios.nome')
                ->join('usuarios', 'usuarios.id = comentarios.usuario_id')
                ->where('postagem_id', $post['id'])
                ->orderBy('comentarios.id', 'ASC')
                ->findAll();
        }

        $usuarioModel = new UsuarioModel();
        $sugestoes = $usuarioModel
            ->where('id !=', session()->get('usuario_id'))
            ->orderBy('id', 'RANDOM')
            ->findAll(3);

        return view('feed/index', [
            'posts' => $posts,
            'sugestoes' => $sugestoes
        ]);
    }

    public function create()
    {
        $model = new PostagemModel();

        $imagem = $this->request->getFile('imagem');
        $nomeImagem = null;

        if ($imagem && $imagem->isValid()) {
            $nomeImagem = $imagem->getRandomName();
            $imagem->move('uploads/', $nomeImagem);
        }

        $model->save([
            'usuario_id' => session()->get('usuario_id'),
            'texto' => $this->request->getPost('texto'),
            'imagem' => $nomeImagem
        ]);

        return redirect()->to('/feed');
    }

    public function like($postId)
    {
        $likeModel = new LikeModel();
        $usuarioId = session()->get('usuario_id');

        $existe = $likeModel
            ->where('usuario_id', $usuarioId)
            ->where('postagem_id', $postId)
            ->first();

        if (!$existe) {
            $likeModel->save([
                'usuario_id' => $usuarioId,
                'postagem_id' => $postId
            ]);
        }

        return $this->response->setJSON(['ok' => true]);
    }

    public function dislike($postId)
    {
        $likeModel = new LikeModel();
        $usuarioId = session()->get('usuario_id');

        $like = $likeModel
            ->where('usuario_id', $usuarioId)
            ->where('postagem_id', $postId)
            ->first();

        if ($like) {
            $likeModel->delete($like['id']);
        }

        return $this->response->setJSON(['ok' => true]);
    }

    public function delete($id)
    {
        $postModel = new PostagemModel();

        $post = $postModel->find($id);

        if ($post['usuario_id'] != session()->get('usuario_id')) {
            return redirect()->to('/feed');
        }

        $postModel->delete($id);

        return redirect()->to('/feed');
    }

    public function edit($id)
    {
        $postModel = new PostagemModel();
        $post = $postModel->find($id);

        if (!$post || $post['usuario_id'] != session()->get('usuario_id')) {
            return redirect()->to('/feed')->with('error', 'Post não encontrado ou sem permissão.');
        }

        return view('feed/edit', ['post' => $post]);
    }

    public function update($id)
    {
        $postModel = new PostagemModel();
        $post = $postModel->find($id);

        if (!$post || $post['usuario_id'] != session()->get('usuario_id')) {
            return redirect()->to('/feed')->with('error', 'Sem permissão para editar.');
        }

        $postModel->update($id, [
            'texto' => $this->request->getPost('texto')
        ]);

        return redirect()->to('/feed')->with('success', 'Postagem atualizada com sucesso!');
    }

    public function comentar($postId)
    {
        $model = new ComentarioModel();

        $model->save([
            'usuario_id' => session()->get('usuario_id'),
            'postagem_id' => $postId,
            'texto' => $this->request->getPost('texto')
        ]);

        return redirect()->back()->with('success', 'Comentário adicionado!');
    }

    public function carregarMais($offset)
    {
        $postModel = new PostagemModel();

        $posts = $postModel
            ->orderBy('created_at', 'DESC')
            ->findAll(5, $offset);

        return $this->response->setJSON($posts);
    }

    public function deleteComentario($id)
    {
        $comentarioModel = new ComentarioModel();
        $comentario = $comentarioModel->find($id);

        if ($comentario && $comentario['usuario_id'] == session()->get('usuario_id')) {
            $comentarioModel->delete($id);
            return redirect()->back()->with('success', 'Comentário excluído.');
        }

        return redirect()->back()->with('error', 'Não autorizado.');
    }
}