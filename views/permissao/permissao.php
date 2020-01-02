
<style>
    .tabs .indicator {
        background-color:#26a69a;
        /*Custom Color Of Indicator*/
    }

</style>
<script src="<?php echo BASE_URL; ?>views/permissao/assets/js/jsPermissao.js"></script>
<div class="row">
    <div class="col s12">
        <ul class="tabs">
            <li class="tab col s4"><a href="#liberarAcesso">Acesso Perfil</a></li>
            <li class="tab col s4"><a href="#liberarAcessoIndividual">Acesso Individual</a></li>
            <!-- <li class="tab col s3"><a href="#">Liberar Usuário Convidado</a></li> -->
            <li class="tab col s4"><a href="#administraPerfis">Gerenciar Perfil</a></li>
        </ul>
    </div>
</div>
<div class="row">
    <div id="liberarAcesso" class="col s12">
        <div class="card">
            <div class="card-content">
                <table id="tabelaFeramenta" class="display centered responsive-table">
                    <thead>
                        <tr class="teal">
                            <th hidden>Id Modulo</th>
                            <th>Menu</th>
                            <th>Tipo</th>
                            <th>Acesso</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $classe = new Permissao();
                        $dados = $classe->carregaMenuLiberacao();

                        foreach ($dados as $menu):
                            ?>      

                            <tr>
                                <td class="idModulo" hidden><?php echo $menu['ID_MODULO']; ?></td>
                                <td><?php echo $menu['NOME_MODULO'] ?></td>
                                <td><?php echo $menu['TIPO']; ?></td>
                                <td> 
                                    <select id="<?php echo $menu['ID_MODULO']; ?>" class="selectMenuLiberacao" multiple>
                                        <?php
                                        $perfil = $classe->carregaPerfil($menu['ID_MODULO']);
                                        foreach ($perfil as $value):
                                            if ($value['POSSUI_ACESSO'] == 0):
                                                ?>                                      
                                                <option value="<?php echo $value['ID_PERFIL'] ?>"><?php echo $value['PERFIL']; ?></option>
                                            <?php else: ?>
                                                <option value="<?php echo $value['ID_PERFIL'] ?>" selected><?php echo $value['PERFIL']; ?></option>                                        
                                            <?php
                                            endif;
                                        endforeach;
                                        ?>
                                    </select>
                                </td>
                                <td><a class="gravaLiberacao waves-effect waves-light btn">Gravar</a></td>
                            </tr>    

                        <?php endforeach; ?> 
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="liberarAcessoIndividual" class="col s12">
        <div class="card">
            <div class="card-content">
                <p class="flow-text center-align">Você poderá inserir ou remover acessos inserindo o CPF, caso queira para mais de um usuário, basta separar por vírgula. Para consultar um acesso digite o CPF no campo abaixo.</p>
                <p class="flow-text center-align"><a href="">Clique aqui</a> para liberar acesso aos contratos.</p>
                <div class="input-field col s12 m6 l3 right">
                    <!--<form method="POST" action="/acesso/consulta">-->
                    <input id="cpfConsultaIndividual" type="text" name="cpfConsultaIndividual" placeholder="consultar acessos"  pattern="[\d,?!]*" class="validate" autocomplete="off">
                    <span class="helper-text" data-error="Preencha corretamente este campo." data-success="" ></span>
                    <button id="btnConsultaAcessoIndividualCpf" class="waves-effect waves-light btn right">Consultar</button>
                    <!-- </form>-->
                </div>


                <table id="tabelaFeramentaIndividual" class="display centered responsive-table">
                    <thead>
                        <tr>
                            <th hidden>Id Modulo</th>
                            <th>Menu</th>
                            <th>Tipo</th>
                            <th>CPF</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $classe = new Permissao();
                        $dadosAcessoIndividual = $classe->carregaMenuLiberacao();
                        foreach ($dadosAcessoIndividual as $menu):
                            ?>      

                            <tr>
                                <td class="idModuloIndividual" hidden><?php echo $menu['ID_MODULO']; ?></td>
                                <td><?php echo $menu['NOME_MODULO'] ?></td>
                                <td><?php echo $menu['TIPO']; ?></td>
                                <td> 
                                    <input type="text" id="<?php echo $menu['ID_MODULO']; ?>_individual" pattern="[\d,?!]*">
                                </td>
                                <td><a class="gravaLiberacaoIndividual waves-effect waves-light btn">Inserir</a> <a class="removeLiberacaoIndividual waves-effect waves-light btn red">Remover</a></td>
                            </tr>    
                        <?php endforeach; ?> 
                    </tbody>
                </table>
            </div>
        </div>       
    </div>
    <!- MODAL COM ACESSOS INDIVIDUAIS -->
    <div id="modalAcessoConsultaIndividual" class="modal">
        <div id="retornoConsultaIndividual" class="modal-content">               
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn red">Fechar</a>
        </div>
    </div>
    <div id="administraPerfis" class="col s12">
        <div class="card">
            <div class="card-content" id="dadosTabelaPerfil" onload="carregaTabelaPerfis()">
                <p class="flow-text center-align">Para criar um novo Perfil de Acesso <a class="modal-trigger" href="#modalNovoPerfil">clique aqui</a>.</p>
                <script>
                    $.ajax({
                        type: 'POST',
                        url: '/ajaxPermissao/caregaTabelaPerfil',
                        async: false,
                        success: function (r) {
                            $("#dadosTabelaPerfil").html(r);
                        }
                    });
                </script>
            </div>
        </div>
        <div id="modalNovoPerfil" class="modal">
            <div class="modal-content">
                <h4 class="center-align">Novo Perfil</h4> 
                <p class="center-align">Utilize de preferência, uma única palavra para para o nome do perfil, descreva de forma resumida o mesmo, referente ao nível de acesso do perfil o nível 1 está acima do nível 2 e assim por diante.</p>
                <div class="input-field col s12">
                    <input id="nomePerifl" type="text" class="validate" maxlength="92" data-error="Preencha corretamente este campo." data-success="" >
                     <span class="helper-text" data-error="Preencha corretamente este campo." data-success="" ></span>
                    <label for="nomePerifl">Perfil</label>
                </div>
                <div class="input-field col s12">
                    <textarea id="descricaoPerfil" class="materialize-textarea validate" maxlength="128" data-error="Preencha corretamente este campo." data-success="" ></textarea>
                     <span class="helper-text" data-error="Preencha corretamente este campo." data-success="" ></span>
                    <label for="descricaoPerfil">Descrição</label>
                </div>
                <div class="input-field col s12">
                    <input type="number" min="1" max="100" id="nivelAcesso" class="validate" data-error="Preencha corretamente este campo." data-success="" >
                     <span class="helper-text" data-error="Preencha corretamente este campo." data-success="" ></span>
                    <label for="nivelAcesso">Nível Acesso</label>                    
                </div>
                <div class="input-field col s12">
                    <p>
                        <label>
                            <input value="1" name="radioDeslogue" type="radio" checked class="validate" data-error="Preencha corretamente este campo." data-success=""  />
                            <span>Deslogar Automático</span>
                        </label>
                        <label>
                            <input value="0" name="radioDeslogue" type="radio" class="validate" data-error="Preencha corretamente este campo." data-success=""  />
                            <span>Não Deslogar</span>
                        </label>
                         <span class="helper-text" data-error="Preencha corretamente este campo." data-success="" ></span>
                    </p>
                </div>
            </div>
            <div class = "modal-footer">
                <div class = "input-field col s12">
                    <a class = "fechaModalNovoPerfil modal-close waves-effect waves-light btn red">Fechar</a>
                    <a class = "gravaNovoPerfil waves-effect waves-light btn">Gravar</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    


    $('#tabelaFeramenta').DataTable({

        columnDefs: [
            {
                targets: [0, 1, 2, 3]

            }
        ],
        "order": [1, "asc"]

    });

    $('#tabelaFeramentaIndividual').DataTable({

        columnDefs: [
            {
                targets: [0, 1]

            }
        ],
        "order": [1, "asc"]

    });

</script>