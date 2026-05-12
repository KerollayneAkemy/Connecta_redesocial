<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Publicação - Connecta</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #0f172a;
            --glass-bg: rgba(30, 41, 59, 0.7);
            --glass-border: rgba(255, 255, 255, 0.1);
            --primary: #6366f1;
            --primary-hover: #4f46e5;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background-color: var(--bg-color);
            background-image: 
                radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.08) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(236, 72, 153, 0.08) 0px, transparent 50%);
            color: var(--text-main);
            min-height: 100vh;
            background-attachment: fixed;
        }

        header {
            width: 100%;
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--glass-border);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        header h1 {
            font-size: 24px;
            font-weight: 700;
            background: linear-gradient(to right, #818cf8, #f472b6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -0.5px;
            text-decoration: none;
        }

        .container {
            max-width: 680px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .card {
            background: var(--glass-bg);
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 24px;
            border: 1px solid var(--glass-border);
            box-shadow: 0 10px 30px -10px rgba(0,0,0,0.3);
            animation: fadeIn 0.4s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .section-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
            color: var(--text-main);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        textarea {
            width: 100%;
            height: 150px;
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            padding: 16px;
            color: var(--text-main);
            font-size: 16px;
            resize: none;
            outline: none;
            margin-bottom: 20px;
            transition: all 0.3s;
        }

        textarea:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
        }

        .btn-cancel {
            text-decoration: none;
            background: rgba(255,255,255,0.05);
            color: var(--text-main);
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s;
            border: 1px solid var(--glass-border);
        }

        .btn-cancel:hover {
            background: rgba(255,255,255,0.1);
        }

        .btn-save {
            border: none;
            background: linear-gradient(135deg, var(--primary), #8b5cf6);
            color: white;
            padding: 12px 30px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
        }

        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(99, 102, 241, 0.4);
        }
    </style>
</head>
<body>

<header>
    <a href="/feed" style="text-decoration: none;"><h1>Connecta</h1></a>
</header>

<div class="container">
    <div class="card">
        <div class="section-title">
            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
            Editar Publicação
        </div>

        <form action="/post/update/<?= $post['id'] ?>" method="post">
            <textarea name="texto" required><?= esc($post['texto']) ?></textarea>

            <div class="actions">
                <a href="/feed" class="btn-cancel">Cancelar</a>
                <button type="submit" class="btn-save">Salvar Alterações</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
