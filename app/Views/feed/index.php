<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feed - Connecta</title>
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
        
        .header-btn.logout { color: #f87171; border-color: rgba(248, 113, 113, 0.2); }
        .header-btn.logout:hover { background: rgba(239, 68, 68, 0.1); color: #fca5a5; }
        .header-btn.profile:hover { background: rgba(255,255,255,0.1); }

        .layout-wrapper {
            max-width: 1050px;
            margin: 40px auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 30px;
            align-items: start;
        }

        @media (max-width: 850px) {
            .layout-wrapper {
                grid-template-columns: 1fr;
            }
            .sidebar {
                display: none;
            }
        }

        .welcome {
            background: rgba(34, 197, 94, 0.1);
            color: #4ade80;
            padding: 14px 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            border: 1px solid rgba(74, 222, 128, 0.2);
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideDown 0.4s ease;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

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

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        textarea {
            width: 100%;
            height: 100px;
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            padding: 16px;
            color: var(--text-main);
            font-size: 15px;
            resize: none;
            outline: none;
            margin-bottom: 12px;
            transition: all 0.3s;
        }

        textarea::placeholder {
            color: rgba(148, 163, 184, 0.5);
        }

        textarea:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }
        
        .post-form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .file-upload {
            color: var(--text-muted);
            font-size: 13px;
        }

        .btn-post {
            border: none;
            background: linear-gradient(135deg, var(--primary), #8b5cf6);
            color: white;
            padding: 10px 24px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 600;
            font-size: 14px;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
        }

        .btn-post:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(99, 102, 241, 0.4);
        }

        .post-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 15px;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #818cf8, #f472b6);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 16px;
            color: white;
        }

        .post-user {
            font-weight: 600;
            font-size: 16px;
        }
        
        .post-user a {
            color: var(--text-main);
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .post-user a:hover {
            color: #818cf8;
            text-decoration: underline;
        }

        .post-date {
            margin-left: auto;
            font-size: 12px;
            color: var(--text-muted);
        }

        .post-content {
            color: #cbd5e1;
            line-height: 1.6;
            font-size: 15px;
            margin-bottom: 20px;
            padding-left: 52px;
        }
        
        .post-image {
            width: 100%;
            border-radius: 12px;
            margin-top: 10px;
            border: 1px solid var(--glass-border);
        }

        .actions {
            display: flex;
            gap: 12px;
            padding-left: 52px;
        }

        .action-btn {
            background: rgba(255,255,255,0.05);
            border: 1px solid var(--glass-border);
            color: var(--text-muted);
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
        }

        .action-btn:hover {
            background: rgba(255,255,255,0.1);
            color: var(--text-main);
        }

        .action-btn.like.active {
            color: #ec4899;
            background: rgba(236, 72, 153, 0.1);
            border-color: rgba(236, 72, 153, 0.3);
        }
        
        .action-btn.like:hover {
            color: #ec4899;
            border-color: rgba(236, 72, 153, 0.3);
        }
        
        .action-btn.edit:hover {
            color: #818cf8;
            border-color: rgba(129, 140, 248, 0.3);
        }
        
        .action-btn.delete:hover {
            color: #f87171;
            border-color: rgba(248, 113, 113, 0.3);
        }

        /* Sidebar Styles */
        .sidebar-widget {
            background: rgba(15, 23, 42, 0.4);
            border-radius: 16px;
            padding: 20px;
            border: 1px solid var(--glass-border);
            margin-bottom: 20px;
            backdrop-filter: blur(10px);
        }

        .widget-title {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--text-main);
        }

        .trending-item {
            padding: 10px 0;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .trending-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .trending-category {
            font-size: 11px;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 3px;
        }

        .trending-topic {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 2px;
            cursor: pointer;
        }

        .trending-topic:hover {
            color: var(--primary);
        }

        .trending-posts {
            font-size: 12px;
            color: var(--text-muted);
        }

    </style>
</head>
<body>

<header>
    <a href="/feed" style="text-decoration: none;"><h1>Connecta</h1></a>

    <div class="header-links">
        <a class="header-btn profile" href="/perfil">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            Meu Perfil
        </a>
        <a class="header-btn logout" href="/logout">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
            Sair
        </a>
    </div>
</header>

<div class="layout-wrapper">
    <!-- COLUNA PRINCIPAL: FEED -->
    <main class="feed-column">
        <?php if(session()->getFlashdata('success')): ?>
            <div class="welcome">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        
        <?php if(session()->getFlashdata('error')): ?>
            <div class="welcome" style="background: rgba(239, 68, 68, 0.1); color: #f87171; border-color: rgba(248, 113, 113, 0.2);">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <div class="card">
            <form action="/postar" method="post" enctype="multipart/form-data">
                <textarea name="texto" placeholder="O que está acontecendo?" required></textarea>
                
                <div class="post-form-footer">
                    <div class="file-upload">
                        <label for="imagem" style="cursor: pointer; display: flex; align-items: center; gap: 5px;">
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Adicionar imagem
                        </label>
                        <input type="file" name="imagem" id="imagem" accept="image/*" style="display: none;">
                    </div>
                    <button type="submit" class="btn-post">Publicar</button>
                </div>
            </form>
        </div>

        <?php if(isset($posts) && count($posts) > 0): ?>
            <?php foreach($posts as $post): ?>
                <div class="card" id="post-<?= $post['id'] ?>">
                    <div class="post-header">
                        <div class="avatar">
                            <?= strtoupper(substr($post['nome'], 0, 1)) ?>
                        </div>
                        <div class="post-user">
                            <a href="/perfil/<?= $post['usuario_id'] ?>"><?= esc($post['nome']) ?></a>
                        </div>
                        <div class="post-date">
                            <?= !empty($post['created_at']) ? date('d/m/Y H:i', strtotime($post['created_at'])) : 'Agora' ?>
                        </div>
                    </div>
                    
                    <div class="post-content">
                        <?= nl2br(esc($post['texto'] ?? '')) ?>
                        
                        <?php if(!empty($post['imagem'])): ?>
                            <img src="/uploads/<?= esc($post['imagem']) ?>" alt="Postagem" class="post-image">
                        <?php endif; ?>
                    </div>

                    <div class="actions">
                        <button class="action-btn like <?= $post['curtiu'] ? 'active' : '' ?>" onclick="toggleLike(<?= $post['id'] ?>, this)">
                            <svg width="14" height="14" fill="<?= $post['curtiu'] ? 'currentColor' : 'none' ?>" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            <span class="like-count"><?= $post['likes'] ?></span> Curtidas
                        </button>

                        <?php if($post['usuario_id'] == session()->get('usuario_id')): ?>
                            <a href="/post/edit/<?= $post['id'] ?>" class="action-btn edit">
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                Editar
                            </a>
                            
                            <a href="/post/delete/<?= $post['id'] ?>" class="action-btn delete" onclick="return confirm('Tem certeza que deseja excluir esta postagem?');">
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                Excluir
                            </a>
                        <?php endif; ?>
                    </div>

                    <!-- Seção de Comentários -->
                    <div class="comments-section" style="margin-top: 20px; padding-top: 15px; border-top: 1px solid var(--glass-border);">
                        <h4 style="font-size: 14px; color: var(--text-muted); margin-bottom: 12px; font-weight: 500;">Comentários (<?= count($post['comentarios'] ?? []) ?>)</h4>
                        
                        <?php if(!empty($post['comentarios'])): ?>
                            <div class="comments-list" style="margin-bottom: 15px;">
                                <?php foreach($post['comentarios'] as $comentario): ?>
                                    <div class="comment-item" style="background: rgba(255,255,255,0.02); border-radius: 8px; padding: 10px 12px; margin-bottom: 8px; display: flex; justify-content: space-between;">
                                        <div>
                                            <div style="font-size: 13px; font-weight: 600; color: var(--text-main); margin-bottom: 4px;">
                                                <?= esc($comentario['nome']) ?>
                                            </div>
                                            <div style="font-size: 14px; color: #cbd5e1; line-height: 1.4;">
                                                <?= nl2br(esc($comentario['texto'])) ?>
                                            </div>
                                        </div>
                                    <div style="font-size: 11px; color: var(--text-muted); white-space: nowrap; display: flex; align-items: center; gap: 8px;">
                                        <?= !empty($comentario['created_at']) ? date('H:i', strtotime($comentario['created_at'])) : '' ?>
                                        <?php if($comentario['usuario_id'] == session()->get('usuario_id')): ?>
                                            <a href="/comentario/delete/<?= $comentario['id'] ?>" onclick="return confirm('Excluir comentário?');" style="color: #f87171; text-decoration: none;" title="Excluir">
                                                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <form action="/post/comentar/<?= $post['id'] ?>" method="post" style="display: flex; gap: 10px;">
                            <input type="text" name="texto" placeholder="Escreva um comentário..." required style="flex: 1; background: rgba(15, 23, 42, 0.6); border: 1px solid var(--glass-border); border-radius: 8px; padding: 10px 14px; color: var(--text-main); font-size: 14px; outline: none; transition: border-color 0.3s;">
                            <button type="submit" style="background: linear-gradient(135deg, var(--primary), #8b5cf6); color: white; border: none; border-radius: 8px; padding: 0 20px; font-weight: 600; cursor: pointer; transition: transform 0.2s;">Enviar</button>
                        </form>
                    </div>

                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="card" style="text-align: center; color: var(--text-muted); padding: 40px;">
                <svg width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="margin-bottom: 15px; opacity: 0.5;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H14"></path></svg>
                <p>Nenhuma publicação ainda. Seja o primeiro a postar!</p>
            </div>
        <?php endif; ?>
    </main>

    <!-- COLUNA LATERAL: SIDEBAR -->
    <aside class="sidebar">
        
        <div class="sidebar-widget">
            <div class="widget-title">Sugestões para seguir</div>
            
            <?php if(isset($sugestoes) && count($sugestoes) > 0): ?>
                <?php foreach($sugestoes as $sugestao): ?>
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 15px;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div class="avatar" style="width: 32px; height: 32px; font-size: 14px;">
                                <?= strtoupper(substr($sugestao['nome'], 0, 1)) ?>
                            </div>
                            <div style="font-size: 14px; font-weight: 600;">
                                <a href="/perfil/<?= $sugestao['id'] ?>" style="color: var(--text-main); text-decoration: none;"><?= esc($sugestao['nome']) ?></a>
                            </div>
                        </div>
                        <a href="/follow/<?= $sugestao['id'] ?>" style="background: rgba(255,255,255,0.1); border: 1px solid var(--glass-border); color: white; padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 600; text-decoration: none; transition: background 0.2s;">
                            Seguir
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div style="font-size: 13px; color: var(--text-muted); line-height: 1.5;">
                    Não há sugestões no momento.
                </div>
            <?php endif; ?>
        </div>

        <div class="sidebar-widget">
            <div class="widget-title">Assuntos do Momento</div>
            
            <div class="trending-item">
                <div class="trending-category">Tecnologia • Assunto do Momento</div>
                <div class="trending-topic">#InteligênciaArtificial</div>
                <div class="trending-posts">15.4K postagens</div>
            </div>
            
            <div class="trending-item">
                <div class="trending-category">Esportes • Ao vivo</div>
                <div class="trending-topic">Liga dos Campeões</div>
                <div class="trending-posts">120K postagens</div>
            </div>
            
            <div class="trending-item">
                <div class="trending-category">Entretenimento • Assunto do Momento</div>
                <div class="trending-topic">Novo Filme de Ficção</div>
                <div class="trending-posts">8.2K postagens</div>
            </div>
            
            <div class="trending-item">
                <div class="trending-category">Programação • Dica</div>
                <div class="trending-topic">#CodeIgniter4</div>
                <div class="trending-posts">3.1K postagens</div>
            </div>
        </div>

        <div style="font-size: 12px; color: rgba(148, 163, 184, 0.5); text-align: center; margin-top: 20px;">
            © 2026 Connecta.<br>Todos os direitos reservados.
        </div>

    </aside>

</div>

<script>
    async function toggleLike(postId, btn) {
        const isActive = btn.classList.contains('active');
        const url = isActive ? `/post/dislike/${postId}` : `/post/like/${postId}`;
        
        try {
            const response = await fetch(url);
            const data = await response.json();
            
            if(data.ok) {
                // Toggle state
                btn.classList.toggle('active');
                
                // Update icon fill
                const svg = btn.querySelector('svg');
                svg.setAttribute('fill', !isActive ? 'currentColor' : 'none');
                
                // Update count
                const countSpan = btn.querySelector('.like-count');
                let count = parseInt(countSpan.textContent);
                countSpan.textContent = !isActive ? count + 1 : count - 1;
            }
        } catch (error) {
            console.error('Erro ao curtir/descurtir:', error);
        }
    }
</script>

</body>
</html>
