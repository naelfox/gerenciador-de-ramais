<?php

class Environment
{
    private static $diretorioEnv = __DIR__ . "/../.env";

    public static function carregar()
    {
        if (file_exists(self::$diretorioEnv)) {
            self::inserirVariaveis(file(self::$diretorioEnv));
            return true;
        }
        return false;
    }

    public static function inserirVariaveis($linhas)
    {
        foreach ($linhas as $linha) {
            $linhaAparada = trim($linha);
            if (!empty($linhaAparada)) {
                putenv($linhaAparada);
            }
        }
    }
}
