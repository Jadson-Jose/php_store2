# php_store2

 Loja online em php puro

 Continuação do projeto, pois o primeiro não estava funcionando muito bem a ligação com o banco de dados.

 1- Criação do projeto com funções básicas e instalação do composer dentro do projeto.
 2- Conexão com o banco de dados e criação de um banco de dados com HeidSQL, testes com esse mesmo banco de dados.
 3- Caregamento do sistema de rotas dentro do index.
 5- Criação do sistema de rotas dentro do arquivo rotas.php, foi feito a começo da coleção das rotas que vão fazer parte do roteamento do projeto, foi definida a ação que vão ser padrão no sistema de rotas, verificação da existência de ação de query string, verificação da existencia de rotas e o começo do tratamento da mesma.
 6- Começo dos testes de criação das classes Main cotendo os métodos inicio e loja, e Loja contendo o método carrinho, no arquivo index e  foi implemantado o carregamento das rotas.php.
 7- Criação do método de layout, com a estrutura, foi criado o html_header, o html_footer, e a pagina inicial sem qualquer, adicão de css nas páginas foi criada até o momento para testes de funcionamento do sitema de roteamento.

 Foi modificado e criada a rotas para clientes e carrinho dentro do controlador.
 
 Dentro do arquivo Main foi criada todo o layout de estrutura da loja, também foi adicionada as funções novo_cliente, carrinho.

Foi apeanas feito a título de teste a rota para carroinho da loja.

Foi criada tabém a estrutara da div da loja com colunas linhas e containers.

Dentro do header foi feito o bloco de código que verifica se exite cliente dentro da sessão, ou seja, se há algum cliente logado na sessão. DEntro do arquivo html_header foi apenas adionado uma taga title.
 Foi criado tabém dois seletores em CSS o nav-item e o nav-item:hover.

Criação da função estática da hash e criada também a hash.

Foi feito a instalação através do composer o phpmailer. 

Criação e inplementação do arquivo Clientes.php, como o seu name space referindo-se ao core com Database, criação da função para verificar se o email existe, não foi feito testes como o envio e recebimento  de emails, e em com links para confirmar o recebimento do email, neste mesma função foram passados algumas query strings. 