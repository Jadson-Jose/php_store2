// app.js

function adicionar_carrinho(id_produto) {

    axios.default.withCredentials = true;
    axios.get('?a=adicionar_carrinho&id_produto=' + id_produto)
        .then(function (reponse) {

            console.log(reponse);

        });
}