<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Workforce Management</title>
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/cssFramework/css/style.css">
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/js/jquery-ui-1.12.1/jquery-ui.min.css">
        <link href="<?php echo BASE_URL; ?>/assets/css/fontA/css/fontawesome.css" rel="stylesheet">
        <link href="<?php echo BASE_URL; ?>/assets/css/fontA/css/brands.css" rel="stylesheet">
        <link href="<?php echo BASE_URL; ?>/assets/css/fontA/css/solid.css" rel="stylesheet">
        <?php if (preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false)) {
            ?>   
            <link rel="stylesheet" href="<?php echo BASE_URL; ?>views/login/assets/css/customIE.css">
            <?php
        } else {
            ?>
            <link rel="stylesheet" href="<?php echo BASE_URL; ?>views/login/assets/css/custom.css">  
            <?php
        }
        ?>    
        <link rel="icon" href="data:,">
        <?php
        $dir = 'views/login/assets/images/';
        $files1 = scandir($dir);

        /* $minVal = array_keys( $files1, min( $files1));
          $maxVal = array_keys( $files1, max( $files1)); */
        $arrBackground = $files1;

        $arquivos1 = array_shift($arrBackground);
        $arquivos2 = array_shift($arrBackground);
        $randomWallpaper = array_rand($arrBackground, 1);

        $wallpaper = BASE_URL . "views/login/assets/images/" . $arrBackground[$randomWallpaper];

        // print_r(rand($files1));
        // print_r($dados);
        // var_dump($arrBackground);
        ?>

        <style>
            html{
                background-image: url("<?php echo $wallpaper; ?>");
                background-repeat: no-repeat; 
                -moz-background-size: contain; 
                -webkit-background-size: contain; 
                background-size: contain;
                background-position: center center;
                background-size: cover;
            }

            @media only screen and (max-device-width: 900px) {
                html{
                    background-color: #ccc;
                    background-image: none;
                }

            }
        </style>


    </head>

    <body>
        <!--
        Vamos criar oa tela de login
        -->

        <div id="msgInternetExplorer" class="card teal darken-1 white-text">
            <div class="card-content">
                <span class="card-title">Aviso</span>
                <p>Navegador não suportado.</p>
            </div>
        </div>
        <div class="oculta grid centro">




            <div class="card-panel hoverables center-align">                 

                <div class="card-content card-size">          

                    <div class="grid grid-template-areas-4">      

                        <section id="cardUsuario" class="esquerda"> 
                            <div id="loadUsuario" class="input-field" hidden> 
                                <div class="progress">
                                    <div class="indeterminate"></div>
                                </div>
                            </div>  

                            <div class="input-field">
                                <img src="<?php echo BASE_URL; ?>assets/images/wfm.png" class="responsive-img foto">
                            </div>
                            <div class="input-field">   
                                <div class="card-title w100 flow-text center-align"><b>Workforce Management</b></div>
                            </div> 
                            <div class="input-field">
                                <input type="text" autocomplete="off" class="validate cpf" name="usuarioLogin" id="usuarioLogin"/>
                                <label for="usuarioLogin">Usuário</label>
                                <span id="loginHelper" class="helper-text" data-error="" data-success=""></span>
                            </div>                  
                            <div class="input-field">
                                <button id="proximo" class="btn waves-effect waves-light w100">Próximo</button>
                            </div> 
                            <div class="input-field left-align">
                                <a href="<?php echo BASE_URL;?>login/registro">Acesso Convidado</a>
                            </div>                                            
                        </section>            


                        <section id="cardSenha" class="esquerda" hidden> 
                            <div id="loadUsuario" class="input-field" hidden> 
                                <div class="progress">
                                    <div class="indeterminate"></div>
                                </div>
                            </div>           


                            <div class="card-title left-align">
                                <i id="voltar" class="fas fa-arrow-left"></i> 
                            </div>                                

                            <img id="imagemUser" src="<?php echo BASE_URL; ?>" class="circle responsive-img imgLogin">                                                         

                            <div class="card-title w100 flow-text">Olá, <span id="nomeUsuario"></span>!</div>
                            <div class="input-field col s12">              
                                <input type="password" class="validate" name="password" id="passwordLogin"/>
                                <label for="passwordLogin" data-error="Preencha corretamente o campo Senha" data-success="">Senha</label>
                                <span id="helperSenha" class="helper-text" data-error="" data-success=""></span>
                            </div>
                            <div class="left-align">
                                <label>
                                    <input type="checkbox" class="filled-in"/>
                                    <span>Mantenha-me conectado</span>
                                </label>                        
                            </div>
                            <div class="input-field left-align">
                                <a href="#" id="recuperaSenha">Não me lembro</a>
                            </div>
                            <div class="input-field">
                                <button class="btn waves-effect waves-light w100" id="logar">Entrar</button>
                            </div>
                        </section>


                        <section id="cardEsqueciSenha" class="esquerda" hidden> 
                            <div class="input-field" id="loadRecuperaAcesso" hidden>
                                <div class="progress">
                                    <div class="indeterminate"></div>
                                </div>
                            </div>
                            <div class="card-title w100 flow-text">Recuperação de Acesso</div>
                            <div class="input-field">
                                <!--<span>Vamos ajudá-lo a redefinir sua conta, primeiro digite seu CPF, caso tenha e-mail, digite também.</span>-->
                                <span>Vamos ajudá-lo a redefinir sua conta, primeiro digite seu CPF.</span>
                            </div>
                            <div class="input-field">              
                                <input type="text" class="validate cpf" name="cpfResetSenha" id="cpfResetSenha" />
                                <label for="cpfResetSenha" data-error="Preencha o campo corretamente" data-success="">CPF</label>
                                <span class="helper-text" data-error="preencha o campo senha" data-success=""></span> 
                            </div>
                            <!--<div class="input-field">              
                                <input type="email" class="validate" name="email" id="email" />
                                <label for="email" data-error="Preencha o campo corretamente" data-success="">E-mail</label>
                            </div>-->
                            <div class="input-field right-align">                              
                                <button id="cancelaEsqueciSenha" class="btn waves-effect waves-light red responsivo-w100">Cancelar</button>
                                <button id="proximoRedefinirSenha" class="btn waves-effect waves-light responsivo-w100">Próximo</button>
                            </div>                            
                        </section>



                        <section id="cardNovaSenha" class="esquerda" hidden>                     
                            <div class="input-field" id="loadEnviaDadosReset" hidden>
                                <div class="progress">
                                    <div class="indeterminate"></div>
                                </div>
                            </div>
                            <div class="card-title w100 flow-text">Recuperação de Acesso</div>
                            <div class="input-field">
                                <span>Defina sua nova senha de acesso, não utlize dados pessoais, como data de nascimento ou número de documento.</span>
                            </div>
                            <div class="input-field">              
                                <input type="password" class="validate" name="novaSenha" id="novaSenha" required />
                                <label for="novaSenha" data-error="Preencha o campo corretamente" data-success="">Digite sua nova senha</label>
                                <span class="helper-text" data-error="preencha o campo senha" data-success=""></span> 
                            </div>
                            <div class="input-field">              
                                <input type="password" class="validate" name="novaSenhaValidacao" id="novaSenhaValidacao" />
                                <label for="novaSenhaValidacao">Confirme sua nova senha</label>
                                <span class="helper-text" data-error="preencha o campo senha" data-success=""></span>                                
                            </div>
                            <div class="input-field">              
                                <input type="text" class="validate" name="token" id="tokenValidaNovaSenha" />
                                <label for="tokenValidaNovaSenha" data-error="Digite corretamente o código recebido" data-success="">Digite o token recebido</label>
                                <span class="helper-text" data-error="preencha o campo senha" data-success=""></span>     
                            </div>
                            <div class="input-field right-align">
                                <button  id="gravaAlteracaoSenha" class="btn waves-effect waves-light modal-trigger responsivo-w100">Gravar Alteração</button>
                            </div>
                        </section>

                    <!-- altera senha e cadastra Email -->
                        <section id="cardAlteraSenhaInicial" class="esquerda" hidden>                     
                            <div id="loadEnviaDadosAlteraSenhaInicial" hidden>
                                <div class="progress">
                                    <div class="indeterminate"></div>
                                </div>
                            </div>
                            <div class="card-title w100 flow-text">Cadastro de Senha</div>
                            <!--<div class="card-title w100 flow-text">Cadastramento de Senha</div>-->
                            <p class="center-align">Olá, <span id="nomeUsuarioAlteraSenhaInicial"></span>, identificamos que é seu primeiro acesso, por gentileza cadastre sua senha e seu e-mail.</p>
                            <div class="input-field">              
                                <input type="password" class="validate" name="senhaInicialCadastro" id="senhaInicialCadastro" required />
                                <label for="senhaInicialCadastro" data-error="Preencha o campo corretamente" data-success="">Cadastre sua senha</label>
                                <span class="helper-text" data-error="preencha o campo corretamente" data-success=""></span> 
                            </div>
                            <div class="input-field">              
                                <input type="password" class="validate" name="senhaInicialCadastroConfirma" id="senhaInicialCadastroConfirma" required />
                                <label for="senhaInicialCadastroConfirma" data-error="Preencha o campo corretamente" data-success="">Confirme sua senha</label>
                                <span class="helper-text" data-error="preencha o campo corretamente" data-success=""></span> 
                            </div>
                            <p class="left-align">
                                <label>
                                    <input type="checkbox" id="ckEmail" class="filled-in" />
                                    <span>Deseja Cadastrar Seu Email?</span>
                                </label>
                             </p>
                            <div class="input-field">              
                                <input disabled type="email" class="validate" name="emailCadastroInicial" id="emailCadastroInicial" />
                                <label for="emailCadastroInicial" data-error="Preencha o campo corretamente" data-success="">Digite seu e-mail</label>
                                <span class="helper-text" data-error="preencha o campo corretamente" data-success=""></span> 
                            </div>                            
                            <div class="input-field right-align">
                                <button  id="gravaCadastroInicial" class="btn waves-effect waves-light responsivo-w100">Gravar</button>
                            </div>
                        </section>
                    </div>

                </div>
            </div>
        </div>
          <!--  <div class="modal bottom-sheet" id="modalSenhaAlteradaSucesso">
                <div class="modal-content center-align">
                    <h4>Sua Solicitação foi concluída</h4>
                    <p>
                        Acesse sua conta com os novos dados
                    </p>
                </div>
                <div class="modal-footer right-align">
                    <button id="fechaModalSenha" class="btn modal-close modal-action red">Fechar</button>
                </div>
            </div>


            <div class="modal bottom-sheet" id="teste2">
                <div class="modal-content center-align">
                    <p>
                        Usuário não localizado, verifique suas informações.
                    </p>
                </div>
                <div class="modal-footer right-align">
                    <button id="fecha" class="btn modal-close modal-action red">Fechar</button>
                </div>
            </div>
        -->


            <div id="modalSessaoAberta" class="modal">
                <div class="modal-content">
                    <p>Identificamos que seu usuário destá logado em outra estação de trabalho, deseja encerrar a sessão aberta e prosseguir com o login?</p>
                </div>
                <div class="modal-footer">
                    <a href="<?php echo BASE_URL; ?>logout/sair" class="btn waves-effect">Sim</a>                  
                    <button id="fecha" class="btn waves-effect modal-close modal-action red">Não</button>
                </div>
            </div>


            <!-- o jquery vem sempre antes do materialize -->
            <script src="<?php echo BASE_URL; ?>assets/js/jquery-3.4.1.js"></script>
            <script src="<?php echo BASE_URL; ?>assets/css/cssFramework/js/jsPrincipal.js"></script>
            <script src="<?php echo BASE_URL; ?>assets/js/jquery-ui-1.12.1/jquery-ui.js"></script>
            <script src="<?php echo BASE_URL; ?>assets/css/fontA/js/brands.js"></script>
            <script src="<?php echo BASE_URL; ?>assets/css/fontA/js/solid.js"></script>
            <script src="<?php echo BASE_URL; ?>assets/css/fontA/js/fontawesome.js"></script>
            <script src="<?php echo BASE_URL; ?>views/login/assets/js/js.js"></script>
            <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/vendor/jQuery-Mask-Plugin-master/dist/jquery.mask.js"></script>

            <script>
                // valida campo somente numeros //
                function SomenteNumero(e) {
                    var tecla = (window.event) ? event.keyCode : e.which;
                    if ((tecla > 47 && tecla < 58))
                        return true;
                    else {
                        if (tecla == 8 || tecla == 0)
                            return true;
                        else
                            return false;
                    }
                }
            </script>

    </body>
</html>

<style>
    #toast-container {
        min-width: 10%;
        top: 50%;
        right: 50%;
        transform: translateX(50%) translateY(50%);
    }
</style>