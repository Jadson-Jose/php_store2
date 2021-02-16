<?php $produto = $produtos[0]; ?>


<div class="container-fluid">

    <!-- titulo da página -->
    <div class="row">
        <div class="col-12">
            <h3>LOJA ONLINE</h3>
        </div>
    </div>

    <!-- produtos -->
    <div class="row">
        <div class="col-12">
            <div class="text-center p-3">
                <?= $produto->nome_produto ?>
            </div>
        </div>
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