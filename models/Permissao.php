<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Permissao
 *
 * @author br03206
 * 
 * responsável pela administração de permissões de usuários nos módulos do sistema
 * 
 */
class Permissao extends Model {

    public function carregaMenuLiberacao() {
        $sql = "SELECT ID_MODULO, NOME_MODULO, DESCRICAO, CASE WHEN MD.CAMINHO_LINK IS NULL THEN 'MENU' ELSE 'FERRAMENTA' END TIPO FROM TB_WFM_MODULO MD  ";
        $sql .= "WHERE MD.ID_MODULO > 0 ";
        $sql = $this->db->prepare($sql);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $sql = $sql->fetchAll();
            return $sql;
        } else {
            return false;
        }
    }

    public function carregaPerfil($idModulo) {
        $sql = "SELECT PFAC.ID_PERFIL, PFAC.PERFIL, CASE WHEN ACPF.ID_MODULO IS NULL THEN 0 ELSE 1 END POSSUI_ACESSO FROM TB_WFM_PERFIL_ACESSO PFAC LEFT JOIN TB_WFM_MODULO_ACESSO_PERFIL ACPF ON ACPF.ID_PERFIL = PFAC.ID_PERFIL AND ACPF.ID_MODULO = :idModulo ";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':idModulo', $idModulo);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return $sql;
        } else {
            return false;
        }
    }

    // grava alterações de permissão perfil

    public function gravaAlteracoes($idModulo, $perfilLiberacao) {

        if ($perfilLiberacao[0] == 'vazio') {
            $this->queryAcessosVazio($idModulo);
            return true;
        } else {
            $id = implode(',', array_filter($perfilLiberacao));

            /**
             * O bind Value não funciona quando passamos valores como 1,2,3,4 caso eu mande essa sequencia ele vai considerar somente o primeiro valor então em clausulas in de consultas passar direto a variavel
             */
            $consultaInsert = "SELECT PFAC.ID_PERFIL
                               ,PFAC.PERFIL
                               ,CASE WHEN ID_MODULO IS NULL THEN 0 ELSE 1 END ACESSO
                         FROM TB_WFM_PERFIL_ACESSO PFAC
                         LEFT JOIN TB_WFM_MODULO_ACESSO_PERFIL ACPF ON ACPF.ID_PERFIL = PFAC.ID_PERFIL AND ACPF.ID_MODULO = :idModulo
                         WHERE PFAC.ID_PERFIL IN ($id) ";
            $consultaInsert = $this->db->prepare($consultaInsert);
            $consultaInsert->bindValue(':idModulo', $idModulo);
            $consultaInsert->execute();
            $consultaInsert = $consultaInsert->fetchAll();


            $consultaDelete = "SELECT PFAC.ID_PERFIL
                               ,PFAC.PERFIL
                               ,CASE WHEN ID_MODULO IS NULL THEN 0 ELSE 1 END ACESSO
                         FROM TB_WFM_PERFIL_ACESSO PFAC
                         LEFT JOIN TB_WFM_MODULO_ACESSO_PERFIL ACPF ON ACPF.ID_PERFIL = PFAC.ID_PERFIL AND ACPF.ID_MODULO = :idModulo
                         WHERE PFAC.ID_PERFIL NOT IN ($id)";
            $consultaDelete = $this->db->prepare($consultaDelete);
            $consultaDelete->bindValue(':idModulo', $idModulo);
            // $consulta->bindValue(':idPerfil', $id);
            $consultaDelete->execute();

            $consultaDelete = $consultaDelete->fetchAll();


            foreach ($consultaInsert as $key => $value) {
                if ($value['ACESSO'] == 0) {
                    $insert = "INSERT INTO LG_WFM_MODULO_ACESSO_PERFIL VALUES (:idModulo, :idPerfil, 1, now(), :responsavel); INSERT INTO TB_WFM_MODULO_ACESSO_PERFIL VALUES(:idModulo,:idPerfil); ";
                    $insert = $this->db->prepare($insert);
                    $insert->bindValue(':idModulo', $idModulo);
                    $insert->bindValue(':idPerfil', $value['ID_PERFIL']);
                    $insert->bindValue(':responsavel', $_SESSION['PIN']);
                    $insert->execute();
                }
            }

            /* consulta delete */

            foreach ($consultaDelete as $key => $value) {
                if ($value['ACESSO'] == 1) {
                    // $delete = "INSERT INTO LG_WFM_MODULO_ACESSO_PERFIL VALUES (:idModulo, :idPerfil, 0, now(), :responsavel);  ";
                    $delete = "INSERT INTO LG_WFM_MODULO_ACESSO_PERFIL VALUES (:idModulo, :idPerfil, 0, now(), :responsavel); DELETE FROM TB_WFM_MODULO_ACESSO_PERFIL WHERE ID_MODULO = :idModulo AND ID_PERFIL = :idPerfil;  ";
                    $delete = $this->db->prepare($delete);
                    $delete->bindValue(':idModulo', $idModulo);
                    $delete->bindValue(':idPerfil', $value['ID_PERFIL']);
                    $delete->bindValue(':responsavel', $_SESSION['PIN']);
                    $delete->execute();
                }
            }

            return true;
        }
    }

    public function removeAcessoPerfil($idModulo, $perfil) {

        foreach ($perfil as $value) {

            $consulta = "SELECT * FROM TB_WFM_MODULO_ACESSO_PERFIL WHERE ID_MODULO = :idModulo AND ID_PERFIL  :idPerfil ";
            $consulta = $this->db->prepare($consulta);
            $consulta->bindValue(':idModulo', $idModulo);
            $consulta->bindValue(':idPerfil', $value);
            $consulta->execute();
            if (!empty($consulta->rowCount())) {
                $sql = "DELETE FROM TB_WFM_MODULO_ACESSO_PERFIL WHERE ID_MODULO = :idModulo AND ID_PERFIL = :idPerfil";
                $sql = $this->db->prepare($sql);
                $sql->bindValue(':idModulo', $idModulo);
                $sql->bindValue(':idPerfil', $value);
                $sql->execute();
                return true;
            } else {
                return false;
            }
        }
    }

    public function gravaAcessoIndividual($cpf, $idModulo) {
        $array = explode(',', $cpf);

        $deleta = "DELETE AI FROM TB_WFM_MODULO_ACESSO_INDIVIDUAL AI JOIN TB_WFM_USUARIO AS U ON AI.PIN = U.PIN WHERE U.CPF in ($cpf) AND ID_MODULO = $idModulo ";
        $deleta = $this->db->prepare($deleta);
        $deleta->execute();

        foreach ($array as $value) {

            $consultaPin = "SELECT PIN FROM TB_WFM_USUARIO WHERE CPF = '$value' ";
            $consultaPin = $this->db->prepare($consultaPin);
            $consultaPin->execute();
            $consultaPin = $consultaPin->fetch();

            $insert = "INSERT INTO TB_WFM_MODULO_ACESSO_INDIVIDUAL VALUES (:pin, :modulo, 1,0)";
            $insert = $this->db->prepare($insert);
            $insert->bindValue(':pin', $consultaPin['PIN']);
            $insert->bindValue(':modulo', $idModulo);
            $insert->execute();

            $insertLog = "INSERT INTO LG_WFM_MODULO_ACESSO_INDIVIDUAL VALUES(:pin, :modulo, 1, 0, now(), :sessionPin) ";
            $insertLog = $this->db->prepare($insertLog);
            $insertLog->bindValue(':pin', $consultaPin['PIN']);
            $insertLog->bindValue(':modulo', $idModulo);
            $insertLog->bindValue(':sessionPin', $_SESSION['PIN']);
            $insertLog->execute();
        }

        return true;
    }

    public function removeAcessoIndividual($cpf, $idModulo) {
        $array = explode(',', $cpf);

        foreach ($array as $value) {
            $consultaPin = "SELECT PIN FROM TB_WFM_USUARIO WHERE CPF = '$value' ";
            $consultaPin = $this->db->prepare($consultaPin);
            $consultaPin->execute();
            $consultaPin = $consultaPin->fetch();

            $deletaAcesso = "UPDATE TB_WFM_MODULO_ACESSO_INDIVIDUAL SET LIBERADO = 0, BLOQUEADO = 1 WHERE ID_MODULO = :modulo AND PIN = :pin ";
            $deletaAcesso = $this->db->prepare($deletaAcesso);
            $deletaAcesso->bindValue(':pin', $consultaPin['PIN']);
            $deletaAcesso->bindValue(':modulo', $idModulo);
            $deletaAcesso->execute();

            $insertLog = "INSERT INTO LG_WFM_MODULO_ACESSO_INDIVIDUAL VALUES(:pin, :modulo, 0, 1, now(), :sessionPin) ";
            $insertLog = $this->db->prepare($insertLog);
            $insertLog->bindValue(':pin', $consultaPin['PIN']);
            $insertLog->bindValue(':modulo', $idModulo);
            $insertLog->bindValue(':sessionPin', $_SESSION['PIN']);
            $insertLog->execute();
        }

        return true;
    }

    public function consultaAcessoIndividual($cpf) {
        $consultaCpf = "SELECT * FROM TB_CAD_COLABORADOR WHERE CPF = :cpf ";
        $consultaCpf = $this->db->prepare($consultaCpf);
        $consultaCpf->bindValue(':cpf', $cpf);
        $consultaCpf->execute();
        if ($consultaCpf->rowCount() > 0) {
            $sql = "CALL PR_CONSULTA_ACESSO_USUARIO ('$cpf');";
            $sql = $this->db->prepare($sql);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $sql = $sql->fetchAll();
                return $sql;
            } else {
                return false;
            }
        }else{
            return false;
        }
    }
    
    public function consultaPerfil(){
        $sql = "SELECT *, CASE WHEN DESLOGUE_AUTOMATICO = 1 THEN 'DESLOGA' ELSE 'NÃO DESLOGA' END DESLOGUE FROM TB_WFM_PERFIL_ACESSO ";
        $sql = $this -> db -> prepare($sql);
        $sql -> execute();
        if($sql -> rowCount() > 0 ){
            return $sql;
        }else{
            return false;
        }
    }

    /* public function tabelaFerramentas() {
      $sql = "SELECT PFAC.PERFIL, CASE WHEN ACPF.ID_MODULO IS NULL THEN 0 ELSE 1 END POSSUI_ACESSO FROM TB_WFM_PERFIL_ACESSO PFAC LEFT JOIN TB_WFM_MODULO_ACESSO_PERFIL ACPF ON ACPF.ID_PERFIL = PFAC.ID_PERFIL AND ACPF.ID_MODULO = :idModulo ";
      $sql = $this->db->prepare($sql);
      $sql->bindValue(':nomeModulo', $this->getNomeMenu());
      $sql->execute();

      if ($sql->rowCount() > 0) {
      $classe = new Helpers();
      $retorno = $classe->dataTable($sql);

      return $retorno;
      } else {
      return false;
      }
      } */
    
    
    public function inativaPerfil($idPerfil){
        $sql = "UPDATE TB_WFM_PERFIL_ACESSO SET ATIVO = 0 WHERE ID_PERFIL = :idPerfil ";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':idPerfil', $idPerfil);
        $sql->execute();
            if($sql -> rowCount() > 0 ){
                $log = "INSERT INTO LG_WFM_PERFIL_ACESSO VALUES (:idPerfil, now(), :pin, 0)";
                $log = $this -> db -> prepare($log);
                $log ->bindValue(':idPerfil', $idPerfil);
                $log ->bindValue(':pin', $_SESSION['PIN']);
                $log->execute();
                    if($sql -> rowCount() > 0 ){
                        return true;
                    }else{
                        return false;
                    }
            }else{
                return false;
            }
        
    }
    
    
    public function ativaPerfil($idPerfil){
        $sql = "UPDATE TB_WFM_PERFIL_ACESSO SET ATIVO = 1 WHERE ID_PERFIL = :idPerfil ";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':idPerfil', $idPerfil);
        $sql->execute();
            if($sql -> rowCount() > 0 ){
                $log = "INSERT INTO LG_WFM_PERFIL_ACESSO VALUES (:idPerfil, now(), :pin, 1)";
                $log = $this -> db -> prepare($log);
                $log ->bindValue(':idPerfil', $idPerfil);
                $log ->bindValue(':pin', $_SESSION['PIN']);
                $log->execute();
                    if($sql -> rowCount() > 0 ){
                        return true;
                    }else{
                        return false;
                    }
            }else{
                return false;
            }
        
    }
    
    public function cadastraNovoPerfil($nomePerfil,$descricaoPerfil,$nivelAcesso,$deslogue){
        
        $sql = "INSERT INTO TB_WFM_PERFIL_ACESSO (PERFIL, DESCRICAO, NIVEL_GRUPO_PERFIL, DESLOGUE_AUTOMATICO, CRIACAO, RESPONSAVEL, ATIVO) VALUES (:perfil, :descricao, :nivelAcesso, :deslogue, now(), :pin, 1) ";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':perfil', $nomePerfil);
        $sql->bindValue(':descricao', $descricaoPerfil);
        $sql->bindValue(':nivelAcesso', $nivelAcesso);
        $sql->bindValue(':deslogue', $deslogue);
        $sql->bindValue(':pin', $_SESSION['PIN']);
        $sql->execute();
       
        if($sql -> rowCount() > 0){
                return true;
            }else{
                return false;
            }
        
    }

    private function queryAcessosVazio($idModulo) {
        /**
         * O bind Value não funciona quando passamos valores como 1,2,3,4 caso eu mande essa sequencia ele vai considerar somente o primeiro valor então em clausulas in de consultas passar direto a variavel
         */
        $consultaDelete = "SELECT PFAC.ID_PERFIL
                               ,PFAC.PERFIL
                               ,CASE WHEN ID_MODULO IS NULL THEN 0 ELSE 1 END ACESSO
                         FROM TB_WFM_PERFIL_ACESSO PFAC
                         LEFT JOIN TB_WFM_MODULO_ACESSO_PERFIL ACPF ON ACPF.ID_PERFIL = PFAC.ID_PERFIL AND ACPF.ID_MODULO = :idModulo ";
        $consultaDelete = $this->db->prepare($consultaDelete);
        $consultaDelete->bindValue(':idModulo', $idModulo);
        $consultaDelete->execute();

        $consultaDelete = $consultaDelete->fetchAll();

        /* consulta delete */

        foreach ($consultaDelete as $key => $value) {
            if ($value['ACESSO'] == 1) {

                $delete = "INSERT INTO LG_WFM_MODULO_ACESSO_PERFIL VALUES (:idModulo, :idPerfil, 0, now(), :responsavel); DELETE FROM TB_WFM_MODULO_ACESSO_PERFIL WHERE ID_MODULO = :idModulo AND ID_PERFIL = :idPerfil;";
                $delete = $this->db->prepare($delete);
                $delete->bindValue(':idModulo', $idModulo);
                $delete->bindValue(':idPerfil', $value['ID_PERFIL']);
                $delete->bindValue(':responsavel', $_SESSION['PIN']);
                $delete->execute();
            }
        }
    }

    private function queryAcessos($idModulo, $perfis) {
        /**
         * O bind Value não funciona quando passamos valores como 1,2,3,4 caso eu mande essa sequencia ele vai considerar somente o primeiro valor então em clausulas in de consultas passar direto a variavel
         */
        $id = implode(',', array_filter($perfis));

        $consultaInsert = "SELECT       PFAC.ID_PERFIL
                               ,PFAC.PERFIL
                               ,CASE WHEN ID_MODULO IS NULL THEN 0 ELSE 1 END ACESSO
                         FROM TB_WFM_PERFIL_ACESSO PFAC
                         LEFT JOIN TB_WFM_MODULO_ACESSO_PERFIL ACPF ON ACPF.ID_PERFIL = PFAC.ID_PERFIL AND ACPF.ID_MODULO = :idModulo
                         WHERE PFAC.ID_PERFIL IN ($id) ";
        $consultaInsert = $this->db->prepare($consultaInsert);
        $consultaInsert->bindValue(':idModulo', $idModulo);
        $consultaInsert->execute();

        $consultaInsert = $consultaInsert->fetchAll();

        $consultaDelete = "SELECT PFAC.ID_PERFIL
                                , PFAC.PERFIL
                                , CASE WHEN ID_MODULO IS NULL THEN 0 ELSE 1 END ACESSO
                          FROM TB_WFM_PERFIL_ACESSO PFAC
                          LEFT JOIN TB_WFM_MODULO_ACESSO_PERFIL ACPF ON ACPF.ID_PERFIL = PFAC.ID_PERFIL AND ACPF.ID_MODULO = :idModulo
                          WHERE PFAC.ID_PERFIL IN ($id) ";
        $consultaDelete = $this->db->prepare($consultaDelete);
        $consultaDelete->bindValue(':idModulo', $idModulo);
        $consultaDelete->execute();
        $consultaDelete = $consultaDelete->fetchAll();



        foreach ($consultaInsert as $key => $value) {
            if ($value['ACESSO'] == 0) {
                $insert = "INSERT INTO LG_WFM_MODULO_ACESSO_PERFIL VALUES (:idModulo, :idPerfil, 1, now(), :responsavel); INSERT INTO TB_WFM_MODULO_ACESSO_PERFIL VALUES(:idModulo, :idPerfil);";
                $insert = $this->db->prepare($insert);
                $insert->bindValue(':idModulo', $idModulo);
                $insert->bindValue(':idPerfil', $value['ID_PERFIL']);
                $insert->bindValue(':responsavel', $_SESSION['PIN']);
                $insert->execute();
            }
        }

        /* consulta delete */

        foreach ($consultaDelete as $key => $value) {
            if ($value['ACESSO'] == 1) {

                $delete = "INSERT INTO LG_WFM_MODULO_ACESSO_PERFIL VALUES (:idModulo, :idPerfil, 0, now(), :responsavel); DELETE FROM TB_WFM_MODULO_ACESSO_PERFIL WHERE ID_MODULO = :idModulo AND ID_PERFIL = :idPerfil;";
                $delete = $this->db->prepare($delete);
                $delete->bindValue(':idModulo', $idModulo);
                $delete->bindValue(':idPerfil', $value['ID_PERFIL']);
                $delete->bindValue(':responsavel', $_SESSION['PIN']);
                $delete->execute();
            }
        }
    }

}
