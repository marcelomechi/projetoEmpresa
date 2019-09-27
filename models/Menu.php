<?php

class CarregaMenu extends Model
{
  public function menu(){
  
  $sql = "SELECT DISTINCT ID_MODULO, ";
  $sql.= "                TITULO_WEB, ";
  $sql.= "                ID_WEB_MODULO,";
  $sql.= "                CAMINHO_ICONE,";
  $sql.= "                CAMINHO_LINK, ";
  $sql.= "                ORDENACAO, ";
  $sql.= "                NOME_MODULO ";
  $sql.= "FROM TB_WFM_MODULO ";
  $sql.= "WHERE ATIVO = 1 ";
  $sql.= "AND (ID_MODULO IN ";
  $sql.= "       (SELECT ID_MODULO ";
  $sql.= "        FROM TB_WFM_MODULO_ACESSO_PERFIL ";
  $sql.= "        WHERE ID_PERFIL IN ";
  $sql.= "            (SELECT ID_PERFIL ";
  $sql.= "             FROM TB_WFM_USUARIO_PERFIL ";
  $sql.= "             WHERE CPF = :CPF ) ) ";
  $sql.= "     OR ID_MODULO IN ";
  $sql.= "       (SELECT ID_MODULO ";
  $sql.= "        FROM TB_WFM_MODULO_ACESSO_INDIVIDUAL ";
  $sql.= "        WHERE CPF = :CPF ";
  $sql.= "          AND LIBERADO = 1 )) ";
  $sql.= " AND ID_MODULO NOT IN ";
  $sql.= "  (SELECT ID_MODULO ";
  $sql.= "   FROM TB_WFM_MODULO_ACESSO_INDIVIDUAL ";
  $sql.= "   WHERE CPF = :CPF ";
  $sql.= "   AND BLOQUEADO = 1 )/* --PARA MENU PRINCIPAL-- */ ";
  $sql.= "   AND ID_MODULO_REFERENCIA IS NULL /* --PARA SUBMENU-- */ ";
  $sql.= "  /*AND ID_MODULO_REFERENCIA = VARIAVEL DO APP*/ ";
  $sql.= "  ORDER BY ORDENACAO; ";

  $sql = $this-> db -> prepare($sql);
  $sql -> bindValue(':CPF',$_SESSION['CPF']);
  $sql -> execute();

    if($sql -> rowCount() > 0){
          $sql = $sql -> fetchAll();

          foreach ($sql as $key => $value) {
            echo '<li>';
            echo '<a href='.BASE_URL.$value['CAMINHO_LINK'].' class="collapsible-header"><i class="material icons"><img class="circle responsive-img iconeTemplate" src="'.BASE_URL.$value['CAMINHO_ICONE'].'"></i>'.$value['NOME_MODULO'].'</a>';
            echo '</li>';
          }

    }else{
      return false;
    }
  
  }
}


?>