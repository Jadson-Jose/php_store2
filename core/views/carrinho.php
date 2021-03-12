<div class="container">
    <div class="row">
        <div class="col">
            <h3 class="my-4">Seu Carrinho</h3>
            <hr>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col">

            <?php if ($carrinho == null) : ?>
                <p class="text-center">Não exitem produtos no seu carrinho.</p>
                <div class="mt-4 text-center">
                    <a href="?a=loja" class="btn btn-primary">Ir para a loja</a>
                </div>

            <?php else : ?>

                <div style="margin-bottom: 80px;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Imagem</th>
                                <th>Produto</th>
                                <th class="text-center">Quantidade</th>
                                <th class="text-end">Valor total</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $index = 0;
                            $total_rows = count($carrinho);
                            ?>

                            <?php foreach ($carrinho as $produto) : ?>
                                <?php if ($index < $total_rows - 1) : ?>

                                    <!-- lista dos produtos -->
                                    <tr>
                                        <td><img src="assets/images/produtos/<?= $produto['imagem']; ?>" class="img-fluid" width="50px"></td>
                                        <td class="align-middle"><?= $produto['titulo'] ?></td>
                                        <td class="align-middle text-center"><?= $produto['quantidade'] ?></td>
                                        <td class="text-end align-middle"><?= 'R$' . number_format($produto['preco'], 2, ',', '.') ?></td>

                                        <td class="text-center align-middle">

                                            <a href="?a=remover_produto_carrinho&id_produto=<?= $produto['id_produto'] ?>" class="btn btn-danger btn-sm"><em class="fas fa-times"></em></a>

                                        </td>
                                    </tr>
                                <?php else : ?>

                                    <!-- total -->
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="text-end">
                                            <h5>Total:</h5>
                                        </td>
                                        <td class="text-end">
                                            <h5><?= 'R$' . number_format($produto, 2, ',', '.') ?></h5>
                                        </td>
                                        <td></td>
                                    </tr>
                                <?php endif; ?>
                                <?php $index++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <div class="row">

                        <div class="col">
                            <!-- <a href="?a=limpar_carrinho" class="btn btn-sm btn-primary">Limpar carrinho</a> -->
                            <button onclick="limpar_carrinho()" class="btn btn-sm btn-primary">Limpar carrinho</button>
                            <span class="ms-3" id="confirmar_limpar_carrinho" style="display: none;">Tem certeza ?
                                <button class="btn btn-sm btn-primary" onclick="limpar_carrinho_off()">Não</button>
                                <a href="?a=limpar_carrinho" class="btn btn-sm btn-primary">Sim</a>
                            </span>
                        </div>

                        <div class="col text-end">
                            <a href="?a=loja" class="btn btn-sm btn-primary">Continuar Compra</a>
                            <a href="?a=finalizar_encomenda" class="btn btn-sm btn-primary">Finalizar Compra</a>
                        </div>

                    </div>

                </div>


            <?php endif; ?>

        </div>
    </div>
</div>