<?php
/**
 * Description of Sessoes
 *
 * @author br03206
 */
class Sessao extends Usuario {
    
    public function __construct(){
        $_SESSION['cpf'] = $this ->getCpf();
        $_SESSION['pin'] = $this ->getPin();
        $_SESSION['token'] = $this ->getToken();        
        $_SESSION['apelido'] = $this ->getApelido();
        $_SESSION['ferramentasLiberadas'][] = $this ->getFerramentasLiberadas();
        $_SESSION['perfilFerramenta'] = $this ->getPerfilFerramenta();
        $_SESSION['foto_perfil'] = $this ->getCaminhoFoto();
        $_SESSION['foto_menu'] = $this ->getIdImagemFundo();
        $_SESSION['email'] = $this ->getEmail();
        $_SESSION['tema'] = $this ->getIdTemaPreferido();
        $_SESSION['senha'] = $this ->getSenha();
        $_SESSION['deslogueAutomatico'] = $this->getDeslogueAutomatico();        
    }
}


?>