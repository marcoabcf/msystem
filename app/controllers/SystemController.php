<?php

include_once('Controller.php');
include_once(__DIR__ . '../../models/System.php');

class SystemController extends Controller {

    private $system;

    public function __construct() {
        parent::__construct();
        $this->system = new System;
    }

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

    public function alter()
    {

        $this->system->id($this->input->get('q'))
                        ->description($this->input->get('descricao'))
                        ->email($this->input->get('email'))
                        ->initial($this->input->get('sigla'))
                        ->url($this->input->get('url'))
                        ->status($this->input->get('status'));

        $result = $this->system->alter();

        if($result) {
            echo 'Operação realizada com sucesso.';
        } else {
            echo 'Falha ao tentar alterar sistema. Tente novamente.';
        }
    }

    public function getData($id)
    {

        $this->system->id($id);

        $result = $this->system->getData();
        return $result;

    }

    public function toList()
    {

        $result = $this->system->toList();
        return $result;

    }

    public function search()
    {
        if($this->input->get('all')) {
            $result = $this->system->toList();

        } else {

            $this->system->description('%'. str_replace(" ", "%", $this->input->get('descricao')) .'%')
                         ->email($this->input->get('email'))
                         ->initial('%'. $this->input->get('sigla') .'%')
                         ->apartir($this->input->get('apartir'))
                         ->pagina_atual($this->input->get('pagina_atual'));

            $result['tabela'] = $this->system->search();
            $result['paginacao'] = $this->system->pagination();
        }

        echo json_encode($result);
    }

    public function pagination()
    {
       $this->system->apartir(0)->pagina_atual(1);

        return $this->system->pagination();
    }
}
