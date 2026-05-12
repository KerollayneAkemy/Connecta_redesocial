<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class AuthController extends BaseController
{
    public function register()
    {
        return view('auth/register');
    }

    public function store()
    {
        helper(['form']);

        $rules = [
            'nome' => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[usuarios.email]',
            'senha' => 'required|min_length[6]',
            'confirmar_senha' => 'matches[senha]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Verifique os campos do formulário.');
        }

        $model = new UsuarioModel();
$model->save([
            'nome' => $this->request->getPost('nome'),
            'email' => $this->request->getPost('email'),
            'senha' => password_hash(
                $this->request->getPost('senha'),
                PASSWORD_DEFAULT
            )
        ]);

        return redirect()->to('/login')
            ->with('success', 'Cadastro realizado com sucesso.');
    }

    public function login()
    {
        return view('auth/login');
    }

    public function auth()
    {
        $model = new UsuarioModel();

        $email = $this->request->getPost('email');
        $senha = $this->request->getPost('senha');

        $usuario = $model->where('email', $email)->first();

        if ($usuario && password_verify($senha, $usuario['senha'])) {

            session()->regenerate();

            session()->set([
                'usuario_id' => $usuario['id'],
                'nome' => $usuario['nome'],
                'email' => $usuario['email'],
                'isLoggedIn' => true
            ]);

            return redirect()->to('/feed')
                ->with('success', 'Bem-vindo, ' . $usuario['nome']);
        }

        return redirect()->back()
            ->with('error', 'Credenciais inválidas.');
    }
    public function logout()
    {
        session()->remove(['usuario_id', 'nome', 'email', 'isLoggedIn']);

        return redirect()->to('/login')
            ->with('success', 'Você saiu da sua conta.');
    }
}