<!-- <?php $produto = $produtos[0]; ?> -->


<div class="container espaco-fundo">

    <!-- titulo da página -->
    <div class="row">
        <div class="col-12 text-center my-4">
            <a href="?a=loja&c=todos" class="btn btn-primary">Todos</a>
            <a href="?a=loja&c=homem" class="btn btn-primary">Homem</a>
            <a href="?a=loja&c=mulher" class="btn btn-primary">Mulher</a>
        </div>
    </div>

    <!-- produtos -->
    <div class="row">

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