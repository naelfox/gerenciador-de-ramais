<?php

class Ramais
{
    private $db;
    private $status_ramais = array();
    private $agentes = array();
    private $info_ramais = array();
    private const STATUS_DA_CHAMADA = array(
        '(Ring)' => 'chamando',
        '(In use)' => 'ocupado',
        '(Unavailable)' => 'indisponivel',
        '(paused)' => 'pausa',
        '(Not in use)' => 'disponivel',
    );


    public function __construct()
    {
        $this->db = new Database();
        $acoesDosAgentes = $this->obterAcoesDosAgentes(file('filas'));
        $this->definirStatusDosRamais($acoesDosAgentes);
        $this->definirNomesDosAgentes($acoesDosAgentes);
        $this->definirInformacoesDosRamais(file('ramais'));
    }

    public function definirStatusDosRamais(array $acoesDosAgentes): void
    {
        foreach ($acoesDosAgentes as $acao) {
            $status = $this->obterStatusDaChamada($acao);
            $ramal = $this->obterRamal($acao);
            $this->status_ramais[$ramal] = array('status' => self::STATUS_DA_CHAMADA[$status]);
        }
    }

    public function definirNomesDosAgentes(array $acoesDosAgentes): void
    {
        foreach ($acoesDosAgentes as $acao) {
            $arr = explode(' ', trim($acao));
            $agente = end($arr);
            $ramal = $this->obterRamal($acao);
            $this->agentes[$ramal] = array('agente' => $agente);
        }
    }

    public function obterAcoesDosAgentes(array $filasLog): array
    {
        $acoesDosAgentes = array_filter($filasLog, function ($linha) {
            return strstr($linha, 'SIP/');
        });
        return array_values($acoesDosAgentes);
    }

    public function obterRamal(string $acao): int
    {
        $arr = explode(' ', trim($acao));
        list($tech, $ramal) = explode('/', $arr[0]);
        return $ramal;
    }

    public function obterStatusDaChamada(string $acao): string
    {
        foreach (array_keys(self::STATUS_DA_CHAMADA) as $key) {
            if (strstr($acao, $key)) {
                return $key;
            }
        };
    }

    public function definirInformacoesDosRamais(array $dadosDeRamais): void
    {

        foreach ($dadosDeRamais as $ramal) {
            $ramalDados = $this->converterStringDoRamalParaArray($ramal);

            $index = $this->vericarIndiceDoStatus($ramalDados);

            if (!is_null($index) and $ramalDados[1] == '(Unspecified)' and $ramalDados[$index] == 'UNKNOWN') {

                // list($name, $username) = explode('/', $arr[0]);

                echo "UNKNOWN";
            } else if (!is_null($index) and $ramalDados[$index] == "OK") {

                echo "OK";
                // list($name, $username) = explode('/', $arr[0]);

            }
        }
    }

    public function vericarIndiceDoStatus(array $array)
    {
        $tipos_de_status = array(
            'UNKNOWN',
            'OK',
            'Unmonitored'
        );

        foreach ($tipos_de_status as $tipo) {
            $chave = array_search($tipo, $array);
            if(!empty($chave)){
                return $chave;  
            }else{
                return null;
            }
        }
    }

    public function converterStringDoRamalParaArray(string $linha): array
    {
        $arr = array_filter(explode(' ', $linha), 'strlen');

        return array_map('trim', array_values($arr));
    }

    public function inserirInformacoes(array $ramal): void
    {
        extract($ramal);
        $this->info_ramais[$name] = array(
            'name' => $name,
            'username' => $username,
            'host' => false,
            'dyn' => $this->status_ramais[$name]['status'],
            'nat' => $this->agentes[$username]['agente'],
            'acl' => $this->agentes[$username]['agente'],
            'port' => $this->agentes[$username]['agente'],
            'status' => $this->agentes[$username]['agente'],
            'status_no_grupo' => $this->agentes[$username]['agente'],
            'agente' => $this->agentes[$username]['agente'],
        );
    }

    public function obterDados()
    {
        return $this->info_ramais;
    }
}
