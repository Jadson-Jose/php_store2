<div class="container espaco-fundo">

    <!-- titulo da página -->
    <div class="row">
        <div class="col-12 text-center my-4">
            <a href="?a=loja&c=todos" class="btn btn-primary">Todos</a>

            <?php foreach ($categorias as $categoria) : ?>
                <a href="?a=loja&c=<?= $categoria ?>" class="btn btn-primary">
                    <?= ucfirst(preg_replace("/\_/", " ", $categoria)) ?>
                </a>
            <?php endforeach; ?>

        </div>
    </div>

    <!-- produtos -->
    <div class="row">

        <?php if (count($produtos) == 0) : ?>
            <div class="text-center my-5">
                <h3>Não existem produtos disponíveis.</h3>
            </div>
        <?php else : ?>

            <!-- ciclo de apresentação dos produtos -->
            <?php foreach ($produtos as $produto) : ?>

                <div class="col-sm-4 col-6 p-1">

                    <div class="text-center p-3 box-produto card">

                        <img src="assets/images/produtos/<?= $produto->imagem ?>" class="img-fluid">
                        <h5><?= $produto->nome_produto ?></h5>
                        <h1><?= 'R$' . preg_replace("/\./", ",", $produto->preco) ?></h1>

                        <div>

                            <?php if ($produto->stock > 0) : ?>
                                <button class="btn btn-info btn-sm " onclick="adicionar_carrinho(<?= $produto->id_produto ?>)"><em class="fas fa-shopping-cart me-2">Adicionar ao carrinho</em></button>
                            <?php else : ?>
                                <button class="btn btn-danger btn-sm "><em class="fas fa-shopping-cart me-2"> Produto indisponível</em></button>
                            <?php endif; ?>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>
        <?php endif; ?>


    </div>
</div>