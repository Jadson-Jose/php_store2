<?php

// abrir a sessão

use core\classes\Database;

session_start();

// carregar o config
require_once('../config.php');

// carrega todas as classes do projeto
require_once('../vendor/autoload.php');

// carrega o sistema de rotas
require_once('../core/rotas.php');
