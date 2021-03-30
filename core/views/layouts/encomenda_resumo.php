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


                <!-- Dados do cliente -->
                <h5 class="bg-dark text=white p-2">Dados do cliente</h5>

                <div class="row">
                    <div class="col">
                        <p>Nome: <strong><?= $cliente->nome_cliente ?></strong></p>
                        <p>Endereço: <strong><?= $cliente->endereco ?></strong></p>
                        <p>Cidade: <strong><?= $cliente->cidade ?></strong></p>
                    </div>

                    <div class="col">
                        <p>E-mail:
                        <p><strong><?= $cliente->email ?></strong></p>
                        </p>
                        <p>Telefone: <strong><?= $cliente->telefone ?></strong></p>
                    </div>
                </div>

                <div>
                    <input type="checkbox" name="check_endereco_alternativo" id="check_endereco_alternativo" onchange="usar_endereco_alternativo()" class="form-check-input">
                    <label class="form-check-label" for="check_endereco_alternativo">Defina um endereço alternativo</label>
                </div>

                <!-- endereço alternativo -->
                <div id="endereco-alternativo" style="display: none;">

                    <!-- endereço -->
                    <div class="mb-3">
                        <label class="form-label">Endereço:</label>
                        <input class="form-control" type="text" id="text_endereco_alternativo">
                    </div>

                    <!-- cidade -->
                    <div class="mb-3">
                        <label class="form-label">Cidade:</label>
                        <input class="form-control" type="text" id="text_cidade_alternativo">
                    </div>

                    <!-- e-mail -->
                    <div class="mb-3">
                        <label class="form-label">Email:</label>
                        <input class="form-control" type="email" id="text_email_alternativo">
                    </div>

                    <!-- telefone -->
                    <div class="mb-3">
                        <label class="form-label">Telefone:</label>
                        <input class="form-control" type="text" id="text_telefone_alternativo">
                    </div>

                </div>


                <div class="row my-5">
                    <div class="col">
                        <a href="?a=carrinho" class="btn btn-primary">Cancelar</a>
                    </div>

                    <div class="col text-end">
                        <a href="?a=escolher_metodo_pagamento" onclick="endereco_alternativo()" class="btn btn-primary">Escolher metodo de pagamento</a>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>