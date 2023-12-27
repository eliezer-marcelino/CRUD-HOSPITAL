<?php

class Paciente{
    
    private $idPaciente;
    private $nome;
    private $cpf;
    private $dataNascimento;
    private $situacao;
    
    function getIdPaciente() {
        return $this->idPaciente;
    }

    function getNome() {
        // echo $this->nome;exit;
        return $this->nome;
    }

    function getCpf() {
        return $this->cpf;
    }

    function getDataNascimento() {
        return $this->dataNascimento;
    }

    function getSituacao() {
        return $this->situacao;
    }


    function setIdPaciente($idPaciente) {
        $this->idPaciente = $idPaciente;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    function setDataNascimento($dataNascimento) {
        $this->dataNascimento = $dataNascimento;
    }

    function setSituacao($situacao) {
        $this->situacao = $situacao;
    }
}