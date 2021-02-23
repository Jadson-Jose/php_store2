// app.js

// ============================================================================
function adicionar_carrinho(id_produto) {

    // adiciona produto ao carrinho
    axios.default.withCredentials = true;
    axios.get('?a=adicionar_carrinho&id_produto=' + id_produto)
        .then(function (response) {

            var total_produtos = response.data;
            document.getElementById('carrinho').innerText = total_produtos;

        });
}

// ============================================================================
function limpar_carrinho() {

    // limpa todo o carrinho
    axios.default.withCredentials = true;
    axios.get('?a=limpar_carrinho')
        .then(function (response) {
            document.getElementById('carrinho').innerText = 0;

        });
}