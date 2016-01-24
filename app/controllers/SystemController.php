<?php

include_once('Controller.php');
include_once(__DIR__ . '../../models/System.php');

class SystemController extends Controller {

    private $system;

    public function __construct() {
        parent::__construct();
        $this->system = new System;
    }

    // Chama função que executa inclusão de um novo sistema
    public function newer()
    {
        $this->system->description($this->input->get('descricao'))
                        ->email($this->input->get('email'))
                        ->initial($this->input->get('sigla'))
                        ->url($this->input->get('url'));

        $result = $this->system->newer();

        if($result) {
            echo 'Operação realizada com sucesso.';
        } else {
            echo 'Falha ao tentar incluir sistema. Tente novamente.';
        }
    }

    // Chama função que executa alteração de dados do sistema
    public function alter()
    {
        $this->system->id($this->input->get('q'))
                        ->description($this->input->get('descricao'))
                        ->email($this->input->get('email'))
                        ->initial($this->input->get('sigla'))
                        ->url($this->input->get('url'))
                        ->status($this->input->get('status'))
                        ->justification($this->input->get('justification'));

        $result = $this->system->alter();

        if($result) {
            echo 'Operação realizada com sucesso.';
        } else {
            echo 'Falha ao tentar alterar sistema. Tente novamente.';
        }
    }

    // Chama função que executa e retorna pesquisa por ID
    public function getData($id)
    {
        $this->system->id($id);

        $result = $this->system->getData();
        return $result;
    }

    // Chama função que executa e retorna pesquisa
    public function search()
    {
        $this->system->description('%'. str_replace(" ", "%", $this->input->get('descricao')) .'%')
                     ->email('%'. $this->input->get('email') .'%')
                     ->initial('%'. $this->input->get('sigla') .'%')
                     ->pagina_atual($this->input->get('pagina_atual'));

        if($this->input->get('apartir')) {
            $this->system->apartir($this->input->get('apartir'));
        }

        $result['tabela'] = $this->system->search();
        $result['paginacao'] = $this->system->pagination();

        echo json_encode($result);
    }

    // Chama função que gera e retorna a paginação
    private function pagination()
    {
        $this->system->apartir(0)
                     ->pagina_atual(1);

        return $this->system->pagination();
    }
}
