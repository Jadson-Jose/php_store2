<div class="container">
    <div class="row my-5">
        <div class="col text-center">
            <h3 class="text-center">Encomenda conformada com sucesso</h3>
            <p>Muito obrigado pela sua encomenda.</p>

            <div class="my-5">
                <h4>Dados de pagamento</h4>
                <p>Conta bancária: 1234567890</p>
                <p>Código da encomenda: <strong><?= $codigo_encomenda ?></strong></p>
                <p>Total da encomenda: <strong><?= number_format('R$' . $total_encomenda, 2, ',', '.') ?></strong></p>
            </div>

            <p>
                Você vai receber um email com a confirmação e os dados de pagamento.
                <br>
                A sua encomenda só será processada após a confirmação do pagamento.
            </p>
            <p><small>Por favor verifique se o email aparece na sua conta ou se foi para a pasta do SPAM.</small></p>
            <div class="my-5"><a href="?a=inicio" class="btn btn-primary">Voltar</a></div>
        </div>
    </div>
</div>