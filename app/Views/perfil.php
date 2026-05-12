<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de <?= esc($usuario['nome']) ?> - Connecta</title>
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

        .header-links {
            display: flex;
            gap: 15px;
        }

        .header-btn {
            text-decoration: none;
            background: rgba(255,255,255,0.05);
            color: var(--text-main);
            padding: 8px 20px;
            border-radius: 10px;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.3s;
            border: 1px solid var(--glass-border);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .header-btn:hover {
            background: rgba(255,255,255,0.1);
        }

        .container {
            max-width: 680px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .profile-card {
            background: var(--glass-bg);
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 24px;
            border: 1px solid var(--glass-border);
            box-shadow: 0 10px 30px -10px rgba(0,0,0,0.3);
            text-align: center;
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .profile-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, #818cf8, #f472b6);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 40px;
            color: white;
            margin: 0 auto 15px auto;
            box-shadow: 0 10px 25px rgba(129, 140, 248, 0.4);
        }

        .profile-name {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 5px;
        }

        .profile-stats {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin: 20px 0;
            padding: 15px 0;
            border-top: 1px solid var(--glass-border);
            border-bottom: 1px solid var(--glass-border);
        }

        .stat-item {
            display: flex;
            flex-direction: column;
        }

        .stat-value {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-main);
        }

        .stat-label {
            font-size: 13px;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-follow {
            display: inline-block;
            background: linear-gradient(135deg, var(--primary), #8b5cf6);
            color: white;
            padding: 10px 30px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
            border: none;
            cursor: pointer;
        }

        .btn-follow:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(99, 102, 241, 0.4);
        }

        .btn-unfollow {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            color: var(--text-main);
            box-shadow: none;
        }

        .btn-unfollow:hover {
            background: rgba(239, 68, 68, 0.1);
            color: #fca5a5;
            border-color: rgba(248, 113, 113, 0.3);
            box-shadow: none;
        }

        /* Post Styles from Feed */
        .card {
            background: var(--glass-bg);
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 24px;
            border: 1px solid var(--glass-border);
            box-shadow: 0 10px 30px -10px rgba(0,0,0,0.3);
            transition: transform 0.3s, box-shadow 0.3s;
            animation: fadeIn 0.5s ease-out;
        }
        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px -10px rgba(0,0,0,0.4);
            border-color: rgba(255,255,255,0.15);
        }
        .post-header { display: flex; align-items: center; gap: 12px; margin-bottom: 15px; }
        .avatar {
            width: 40px; height: 40px; border-radius: 50%;
            background: linear-gradient(135deg, #818cf8, #f472b6);
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 16px; color: white;
        }
        .post-user { font-weight: 600; font-size: 16px; color: var(--text-main); }
        .post-date { margin-left: auto; font-size: 12px; color: var(--text-muted); }
        .post-content { color: #cbd5e1; line-height: 1.6; font-size: 15px; margin-bottom: 20px; padding-left: 52px; }
        .post-image { width: 100%; border-radius: 12px; margin-top: 10px; border: 1px solid var(--glass-border); }
        
        .section-title {
            font-size: 20px;
            font-weight: 600;
            margin: 30px 0 20px 0;
            color: var(--text-main);
            display: flex;
            align-items: center;
            gap: 10px;
        }
    </style>
</head>
<body>

<header>
    <a href="/feed" style="text-decoration: none;"><h1>Connecta</h1></a>

    <div class="header-links">
        <a class="header-btn" href="/feed">
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            Feed
        </a>
    </div>
</header>

<div class="container">
    <div class="profile-card">
        <div class="profile-avatar">
            <?= strtoupper(substr($usuario['nome'], 0, 1)) ?>
        </div>
        <div class="profile-name">
            <?= esc($usuario['nome']) ?>
        </div>
        
        <div class="profile-stats">
            <div class="stat-item">
                <span class="stat-value"><?= $seguidores ?></span>
                <span class="stat-label">Seguidores</span>
            </div>
            <div class="stat-item">
                <span class="stat-value"><?= $seguindo ?></span>
                <span class="stat-label">Seguindo</span>
            </div>
            <div class="stat-item">
                <span class="stat-value"><?= count($posts) ?></span>
                <span class="stat-label">Posts</span>
            </div>
        </div>

        <?php if($usuario['id'] != session()->get('usuario_id')): ?>
            <a href="/follow/<?= $usuario['id'] ?>" class="btn-follow <?= isset($jaSegue) && $jaSegue ? 'btn-unfollow' : '' ?>">
                <?= isset($jaSegue) && $jaSegue ? 'Deixar de Seguir' : 'Seguir' ?>
            </a>
        <?php else: ?>
            <span style="color: var(--text-muted); font-size: 14px;">Este é o seu perfil</span>
        <?php endif; ?>
    </div>

    <div class="section-title">
        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
        Publicações
    </div>

    <?php if(isset($posts) && count($posts) > 0): ?>
        <?php foreach($posts as $post): ?>
            <div class="card">
                <div class="post-header">
                    <div class="avatar">
                        <?= strtoupper(substr($usuario['nome'], 0, 1)) ?>
                    </div>
                    <div class="post-user">
                        <?= esc($usuario['nome']) ?>
                    </div>
                    <div class="post-date">
                        <?= !empty($post['created_at']) ? date('d/m/Y H:i', strtotime($post['created_at'])) : 'Agora' ?>
                    </div>
                </div>
                
                <div class="post-content">
                    <?= nl2br(esc($post['texto'] ?? '')) ?>
                    
                    <?php if(!empty($post['imagem'])): ?>
                        <img src="/uploads/<?= esc($post['imagem']) ?>" alt="Post Image" class="post-image">
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="card" style="text-align: center; color: var(--text-muted); padding: 40px;">
            <p>Nenhuma publicação encontrada.</p>
        </div>
    <?php endif; ?>

</div>
</body>
</html>
