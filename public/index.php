<?php

// abrir a sessão

use core\classes\Database;

session_start();

// carrega todas as classes do projeto
require_once('../vendor/autoload.php');

// carrega o sistema de rotas
require_once('../core/rotas.php');
