<div class="container">
    <div class="row">
        <div class="col">
            <h3 class="my-4">Seu Carrinho - Resumo</h3>
            <hr>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col">

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
                                    <td class="align-middle"><?= $produto['titulo'] ?></td>
                                    <td class="align-middle text-center"><?= $produto['quantidade'] ?></td>
                                    <td class="text-end align-middle"><?= 'R$' . number_format($produto['preco'], 2, ',', '.') ?></td>

                                </tr>
                            <?php else : ?>

                                <!-- total -->
                                <tr>
                                    <td></td>
                                    <td class="text-end">
                                        <h4>Total:</h4>
                                    </td>
                                    <td class="text-end">
                                        <h4><?= 'R$' . number_format($produto, 2, ',', '.') ?></h4>
                                    </td>
                                    <td></td>
                                </tr>
                            <?php endif; ?>
                            <?php $index++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>


                <div>

                    dados do cliente

                    <?php
                    print_r($cliente);
                    ?>
                </div>










                <div class="row">

                    <div class="col">
                        cancelar
                    </div>

                    <div class="col text-end">
                        escolher o método de pagamento
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>