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

    var e = document.getElementById("confirmar_limpar_carrinho");
    e.style.display = "inline";
}

// ============================================================================
function limpar_carrinho_off() {

    var e = document.getElementById("confirmar_limpar_carrinho");
    e.style.display = "none";
}

// ============================================================================
function usar_endereco_alternativo() {

    // mostrar ou esconder o espaço para o endereço alternativo.
    var e = document.getElementById('check_endereco_alternativo');
    if (e.checked == true) {

        // mostra o quadro para definir o enderço alternativo
        document.getElementById("endereco-alternativo").style.display = 'block';

    } else {

        // esconde o quadro para definir o enderço alternativo
        document.getElementById("endereco-alternativo").style.display = 'none';
    }
}

// ============================================================================
function endereco_alternativo() {

    axios({
        method: 'post',
        url: '?a=endereco_alternativo',
        data: {
            text_endereco: document.getElementById('text_endereco_alternativo').Value,
            text_cidade: document.getElementById('text_cidade_alternativo').Value,
            text_email: document.getElementById('text_email_alternativo').Value,
            text_telefone: document.getElementById('text_telefone_alternativo').Value,
        }
    });
}
