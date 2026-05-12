<?php
$nome = $usuario['nome'];
$userId = session()->get('id');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Perfil</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: #000;
    color: #fff;
}

.profile-header {
    padding: 30px;
    border-bottom: 1px solid #333;
}

.avatar {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: linear-gradient(135deg, #1d9bf0, #555);
}

.stats {
    display: flex;
    gap: 20px;
    margin-top: 10px;
}

.grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 5px;
    margin-top: 20px;
}

.post-box {
    background: #16181c;
    padding: 10px;
    border-radius: 10px;
}
</style>

</head>
<body>

<div class="container">

    <!-- HEADER PERFIL -->
    <div class="profile-header d-flex gap-4 align-items-center">

        <div class="avatar"></div>

        <div>
            <h3><?= esc($nome) ?></h3>

            <div class="stats">
                <div><strong><?= count($posts) ?></strong> posts</div>
                <div><strong><?= $seguidores ?></strong> seguidores</div>
                <div><strong><?= $seguindo ?></strong> seguindo</div>
            </div>

            <?php if ($userId != $usuario['id']): ?>
                <a href="<?= base_url('follow/' . $usuario['id']) ?>" class="btn btn-sm btn-light mt-2">
                    <?= $jaSegue ? 'Deixar de seguir' : 'Seguir' ?>
                </a>
            <?php endif; ?>
        </div>

    </div>

    <!-- BIO -->
    <div class="mt-3">
        <p class="text-muted">Bio do usuário aqui...</p>
    </div>

    <!-- GRID IG STYLE -->
    <div class="grid">
        <?php foreach ($posts as $post): ?>
            <div class="post-box">
                <?= esc($post['texto']) ?>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- LISTA TWITTER STYLE -->
    <div class="mt-5">
        <h5>Posts</h5>

        <?php foreach ($posts as $post): ?>
            <div class="border-bottom py-2">
                <?= esc($post['texto']) ?>
                <div class="text-muted small">
                    <?= date('d/m H:i', strtotime($post['created_at'])) ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>

</body>
</html>