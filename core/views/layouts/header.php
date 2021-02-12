<?php

use core\classes\Store;


?>

<div class="container-fluid navegacao">
    <div class="row">
        <div class="col-6 p-3">
            <a href="?a=inicio">
                <h3><?= APP_NAME ?></h3>
            </a>
        </div>
        <div class="col-6 text-end p-3">

            <a href="?a=inicio" class="nav-item">Início</a>
            <a href="?a=loja" class="nav-item">Loja</a>

            <!-- verifica se existe cliente na sessão -->
            <?php if (Store::clienteLogado()) : ?>

                <a href="?a=minha_conta" class="nav-item">
                    <?= $_SESSION['usuario'] ?>
                </a>
                <a href="?a=logout" class="nav-item"><em class="fas fa-sign-out-alt"></em></a>

            <?php else : ?>

                <a href="?a=login" class="nav-item">Login</a>
                <a href="?a=novo_cliente" class="nav-item">Criar conta</a>

            <?php endif; ?>

            <a href="?a=carrinho"><em class="fas fa-shopping-cart"></em></a>

            <span class="badge bg-warning"></span>
        </div>
    </div>
</div>