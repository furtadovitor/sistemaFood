<h1><?php echo $usuario->nome ?>, agora falta muito pouco!!</h1>

<p>Clique no link abaixo para ativação da conta.</p>

<p>
    <a href="<?php echo site_url('registrar/ativar/' . $usuario->token) ?>">Ativar conta</a>
</p>