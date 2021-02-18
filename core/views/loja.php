<!-- <?php $produto = $produtos[0]; ?> -->


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
            <?php foreach ($produtos as $produto) : ?>

                <div class="col-sm-4 col-6 p-1">

                    <div class="text-center p-3 box-produto card">

                        <img src="assets/images/produtos/<?= $produto->imagem ?>" class="img-fluid">
                        <h5><?= $produto->nome_produto ?></h5>
                        <h1><?= $produto->preco ?></h1>

                        <button>Adicionar ao carrinho</button>


                    </div>

                </div>

            <?php endforeach; ?>
        <?php endif; ?>


    </div>
</div>


<!-- [id_produto] => 1
    [categoria] => homem
    [nome_produto] => Tshirt Vermelho
    [descricao_produto] => ffkwfkwe~fkwe~´fke~ef~´eçwkf~weçkf
    [imagem] => tshirt_vermelha.png
    [preco] => 45.70
    [stock] => 100
    [visivel] => 1
    [created_at] => 2021-02-15 20:22:46
    [updated_at] => 2021-02-15 20:22:56
    [deleted_at] =>  -->