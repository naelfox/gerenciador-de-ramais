<?php

class Environment
{
    private static $diretorioEnv = __DIR__ . "/../.env";

    public static function carregarVariaveis()
    {
        if (file_exists(self::$diretorioEnv)) {
            self::inserirVariaveisDeAmbiente(file(self::$diretorioEnv));
            return true;
        }
        return false;
    }

    public static function inserirVariaveisDeAmbiente($linhas)
    {
        foreach ($linhas as $linha) {
            $linhaAparada = trim($linha);
            if (!empty($linhaAparada)) {
                putenv($linhaAparada);
            }
        }
    }
}
