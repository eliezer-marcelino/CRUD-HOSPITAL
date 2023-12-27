<?php
/*
    Criação da classe Paciente com o CRUD
*/
class PacienteDAO{
    
    public function create(Paciente $paciente) {
        try {
            $sql = "INSERT INTO paciente (nome,cpf,dataNascimento,situacao) VALUES (:nome,:cpf,:dataNascimento,:situacao)";

            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->bindValue(":nome", $paciente->getNome());
            $p_sql->bindValue(":cpf", $paciente->getCpf());
            $p_sql->bindValue(":dataNascimento", $paciente->getDataNascimento());
            $p_sql->bindValue(":situacao", $paciente->getSituacao());
            
            return $p_sql->execute();
        } catch (Exception $e) {
            print "Erro ao Inserir paciente <br>" . $e . '<br>';
        }
    }

    public function read() {
        try {
            $sql = "SELECT * FROM paciente order by nome asc";
            $result = Conexao::getConexao()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
            $f_lista = array();
            foreach ($lista as $l) {
                $f_lista[] = $this->listaPaciente($l);
            }
            return $f_lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }
     
    public function update(Paciente $paciente) {
        try {
            $sql = "UPDATE paciente set
                  nome=:nome,
                  cpf=:cpf,
                  dataNascimento=:dataNascimento,
                  situacao=:situacao            
                                                                       
                  WHERE idPaciente=:idPaciente";
            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->bindValue(":idPaciente", $paciente->getIdPaciente());
            $p_sql->bindValue(":nome", $paciente->getNome());
            $p_sql->bindValue(":cpf", $paciente->getCpf());
            $p_sql->bindValue(":dataNascimento", $paciente->getDataNascimento());
            $p_sql->bindValue(":situacao", $paciente->getSituacao());
            
            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br> $e <br>";
        }
    }

    public function delete(Paciente $paciente) {
        try {
            $sql = "DELETE FROM paciente WHERE idPaciente=:idPaciente";
            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->bindValue(":idPaciente", $paciente->getIdPaciente());
            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Excluir paciente<br> $e <br>";
        }
    }

    private function listaPaciente($row) {
        $paciente = new Paciente();
        $paciente->setIdPaciente($row['idPaciente']);
        $paciente->setNome($row['nome']);
        $paciente->setCpf($row['cpf']);
        $paciente->setDataNascimento($row['dataNascimento']);
        $paciente->setSituacao($row['situacao']);

        return $paciente;
    }
}

 ?>