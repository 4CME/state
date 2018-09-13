<?php

/**
 * Arquivo de funções de uso geral da framework. Adeque-o às suas necessidades
 *
 * @author     Pablo Santiago Sánchez <phackwer@corephp.com.br>
 * @version    1.0
 * @package    WirePhrame
 * @subpackage Funções de uso geral
 */

/**
 * Função mágica do PHP utilizado para carregamento automático de Classes
 * sem a necessidade de vários includes.
 * @param string $class Nome da Classe a ser carregada
 */
spl_autoload_register(
    function ($class) {
        require_recursive(__DIR__, $class);
    }
);

/**
 * Função de apoio ao __autoload utilizado para carregamento automático de Classes
 * sem a necessidade de vários includes.
 * @param string $path Caminho a ser pesquisado para carregamento da classe
 * @param string $class Nome da Classe a ser carregada
 */
function require_recursive($path, $class)
{
    if ($path[strlen($path) - 1] != '/') {
        $path .= '/';
    }

    $contents = scandir($path);

    foreach ($contents as $content) {
        if ($content != '.' && $content != '..') {
            if (is_dir($path . $content)) {
                require_recursive($path . $content, $class);
            } else if ($content == $class . '.php') {
                require_once($path . $content);
            }
        }
    }
}
