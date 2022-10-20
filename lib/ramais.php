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

    public function definirInformacoesDosRamais(array $ramais): void
    {

        echo '<pre>';
        print_r($ramais);
        echo '</pre>';
        // $ramais = $this->db->consulta();
        // foreach ($ramais as $ramal) {
        //     if ($ramal['host'] == 'Unspecified' and $ramal['status'] == 'UNKNOWN') {
        //         $this->inserirInformacoes($ramal);
        //     } else if ($ramal['status'] == 'OK') {
        //         $this->inserirInformacoes($ramal);
        //     }
        // }
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
