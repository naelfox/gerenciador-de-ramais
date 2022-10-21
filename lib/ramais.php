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

            if (!empty($index) and $ramalDados[1] == '(Unspecified)' and $ramalDados[$index] == 'UNKNOWN') {
                $this->inserirInformacoes($ramalDados, false);
            } else if (!empty($index) and $ramalDados[$index] == "OK") {
                $this->inserirInformacoes($ramalDados, true);
            }
        }
    }

    public function inserirInformacoes(array $ramalDados, bool $online): void
    {
        list($name,$username) = explode('/',$ramalDados[0]); 
        $this->info_ramais[$name] = array(
            'name' => $name,
            'username' => $username,
            'host' => $ramalDados[1],
            'online' => $online ? 'online' : 'offline',
            'status_no_grupo' => $this->status_ramais[$username]['status'],
            'agente' => $this->agentes[$username]['agente'],
        );
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
            }
        }
    }

    public function converterStringDoRamalParaArray(string $linha): array
    {
        $arr = array_filter(explode(' ', $linha), 'strlen');

        return array_map('trim', array_values($arr));
    }

    public function obterDados()
    {
        echo '<pre>';
        print_r($this->info_ramais);
        echo '</pre>';
        return $this->info_ramais;
    }
}
