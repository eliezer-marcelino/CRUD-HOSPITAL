<?php
include_once "../conexao/Conexao.php";
include_once "../model/Paciente.php";
include_once "../dao/PacienteDAO.php";

//instancia as classes
$paciente = new Paciente();
$pacientedao = new PacienteDAO();

//pega todos os dados passado por POST
$d = filter_input_array(INPUT_POST);

//se a operação for gravar entra nessa condição
if(isset($_POST['cadastrar'])){

    $paciente->setNome($d['nome']);
    $paciente->setCpf($d['cpf']);
    $paciente->setDataNascimento($d['dataNascimento']);
    $paciente->setSituacao($d['situacao']);

    $pacientedao->create($paciente);

    header("Location: ../../");
} 
// se a requisição for editar
else if(isset($_POST['editar'])){

    $paciente->setNome($d['nome']);
    $paciente->setCpf($d['cpf']);
    $paciente->setDataNascimento($d['dataNascimento']);
    $paciente->setSituacao($d['situacao']);
    $paciente->setIdPaciente($d['idPaciente']);

    $pacientedao->update($paciente);

    header("Location: ../../");
}
// se a requisição for deletar
else if(isset($_GET['del'])){

    $paciente->setIdPaciente($_GET['del']);

    $pacientedao->delete($paciente);

    header("Location: ../../");
}else{
    header("Location: ../../");
}