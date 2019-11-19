<link rel="stylesheet" href="<?php echo BASE_URL; ?>views/modulo/assets/css/customModulo.css">
<div class="row">
    <div class="col s12">
        <ul class="tabs">
            <li class="tab col s2"><a href="#novoMenu">Novo menu</a></li>
            <li class="tab col s2"><a href="#novaFerramenta">Nova Ferramenta</a></li>
            <li class="tab col s2"><a href="#inativaMenu">Menus</a></li>
            <li class="tab col s2"><a href="#ativaInativaFerramenta">Ferramentas</a></li>
            <li class="tab col s2"><a href="#ordenacao">Ordenação</a></li>
            <li class="tab col s2"><a href="#ferramentaManutencao">Página de Manutenção</a></li>
        </ul>
    </div>
</div>
<div class="row">

    <div id="novoMenu" class="col s12">
        <div  class="col s12 m12 l6">        
            <div class="card">
                <div class="card-content">
                    <p class="center-align flow-text">Responsável por criar um Menu que irá agrupar novas ferramentas.</p> 


                    <div class="input-field">
                        <input id="nomeMenu" type="text" name="nomeMenu" class="validate" autocomplete="off" maxlength="96">
                        <label for="nomeMenu">Nome</label>
                        <span id="nomeMenuHelper" class="helper-text" data-error="" data-success=""></span>
                    </div>
                    <div class="input-field">
                        <input id="descricaoMenu" type="text" name="descricaoMenu" class="validate" autocomplete="off" maxlength="256">
                        <label for="descricaoMenu">Descrição</label>
                        <span id="descricaoMenuHelper" class="helper-text" data-error="" data-success=""></span>

                    </div>
                    <div class="input-field">
                        <p>
                            <label>
                                <input type="checkbox" class="ckMenu filled-in"/>
                                <span>Submenu</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-field selectSubmenu hide">
                        <select name="moduloReferencia" id="selectSubmenu">
                            <option value="" selected>Selecione</option> 
                            <?php
                            $classe = new Modulos();
                            $dados = $classe->carregaHeaderMenu();
                            foreach ($dados as $item):
                                ?>
                                <option value ="<?php echo $item['ID_MODULO']; ?>"><?php echo $item['NOME_MODULO']; ?></option>
                                <?php
                            endforeach;
                            ?>
                        </select>
                        <label>Selecione o Menu Principal</label>
                        <span id="selectMenuMenuHelper" class="helper-text" data-error="" data-success=""></span>
                    </div>
                    <div class="file-field input-field fileMenu">									  
                        <div class="btn waves-effect">
                            <span>Ícone</span>
                            <input name="envioFoto" type="file"><i class="fas fa-camera"></i>
                        </div>
                        <div class="file-path-wrapper">
                            <input id="menuImg" class="file-path validate" type="text" class="validade">
                            <span class="helper-text" data-error="" data-success=""></span>

                        </div>
                    </div>
                    <div class="input-field right-align">
                        <a id="gravarNovoMenu" class="waves-effect waves-light btn">Gravar</a>
                    </div>

                </div>
            </div>            
        </div>
        <div  class="col s12 m12 l6"> 
            <div class="card">
                <div class="card-content">
                    <p class="flow-text center-align">Preview</p>
                    <ul>
                        <label for="temaClaroMenu">Tema Claro</label>
                        <li id="temaClaroMenu">
                            <a class="collapsible-header valign-wrapper"><i class="material icons"><img id="imgMenu" src="" class="circle valign-wrapper"></i><span id="previewNomeMenu"></span><i class="material icons small right"><i class="fas fa-angle-down"></i></i></a>                          
                        </li>
                        <label for="temaEscuroMenu">Tema Escuro</label>
                        <li id="temaEscuroMenu" class="temaEscuro">
                            <a class="collapsible-header valign-wrapper"><i class="material icons"><img id="imgMenuEscuro" src="" class="circle valign-wrapper"></i><span id="previewNomeMenuEscuro"></span><i class="material icons small right"><i class="fas fa-angle-down corSetaTemaEscuro"></i></i></a>                          
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="novaFerramenta" class="col s12">
        <div class="col s12 m12 l6">
            <div class="card">
                <div class="card-content">
                    <p class="center-align flow-text">Responsável por criar uma nova ferramenta na aplicação.</p> 
                    <div class="input-field">
                        <input id="nomeFerramenta" type="text" name="nomeFerramenta" class="validate" autocomplete="off" maxlength="96">
                        <label for="nomeFerramenta">Nome</label>
                        <span id="helperNomeFerramenta" class="helper-text" data-error="" data-success=""></span>
                    </div>
                    <div class="input-field">
                        <input id="linkFerramenta" type="text" name="linkFerramenta" class="validate tooltipped" data-position="bottom" data-tooltip="Digite aqui o link que será exibido no navegador do usuário quando acessar a ferramenta, não utilize caracteres especiais." autocomplete="off" maxlength="512">
                        <label for="linkFerramenta">Link</label>
                        <span id="linkFerramentaHelper" class="helper-text" data-error="" data-success=""></span>
                    </div>
                    <div class="input-field">
                        <input id="descricaoFerramenta" type="text" name="descricaoFerramenta" class="validate" autocomplete="off" maxlength="256">
                        <label for="descricaoFerramenta">Descrição</label>
                        <span id="descricaoFerramentaHelper" class="helper-text" data-error="" data-success=""></span>
                    </div>
                    <div class="input-field" id="containerSelectFerramenta">
                        <select name="menuReferenciaFerramenta" id="menuReferenciaFerramenta" class="validate">
                            <option value="" selected>Selecione</option>                            
                            <option value="principal">Menu Principal</option> 
                            <optgroup label="Submenus">
                                <?php
                                $classe = new Modulos();
                                $dados = $classe->carregaHeaderMenu();
                                foreach ($dados as $item):
                                    ?>
                                    <option value ="<?php echo $item['ID_MODULO']; ?>"><?php echo $item['NOME_MODULO']; ?></option>
                                    <?php
                                endforeach;
                                ?>
                            </optgroup>
                        </select>
                        <label>Selecione o Menu</label>
                        <span id="menuReferenciaFerramentaHelper" class="helper-text red-text hide" data-error="" data-success="">Preencha este campo.</span>
                    </div>
                    <div class="input-field right-align">
                        <a id="gravaNovaFerramenta" class="waves-effect waves-light btn">Gravar</a>
                    </div>
                </div>
            </div> 
        </div>
        <div  class="col s12 m12 l6"> 
            <div class="card">
                <div class="card-content">
                    <p class="flow-text center-align">Preview</p>
                    <ul>
                        <label for="temaClaroFerramenta">Tema Claro</label>
                        <li id="temaClaroFerramenta">
                            <a class="collapsible-header valign-wrapper"><span id="previewNomeFerramenta"></span><i class="material icons small right"><i class="fas fa-angle-down"></i></i></a>                          
                        </li>
                        <label for="temaEscuroFerramenta">Tema Escuro</label>
                        <li id="temaEscuroFerramenta" class="temaEscuro">
                            <a class="collapsible-header valign-wrapper"><span id="previewNomeFerramentaEscuro"></span><i class="material icons small right"><i class="fas fa-angle-down corSetaTemaEscuro"></i></i></a>                          
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="inativaMenu" class="col s12 m12 l12">
        <div id="tabelaContainer">
            <p class="flow-text center-align">Ao inativar um menu do tipo Principal, todos os seus submenus serão inativados também, caso queira inativar um submenu em específico, atente-se ao tipo que deverá ser Submenu.</p>
            <table id="tblMenus" class="display">
                <thead>
                    <tr>
                        <th class="hide center-align">Id</th>
                        <th class="center-align">Nome Menu</th>
                        <th class="center-align">Tipo Menu</th>
                        <th class="center-align">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $classe = new Modulos();
                    $dados = $classe->consultaMenus();
                    foreach ($dados as $value):
                        ?>
                        <tr>
                            <td class="hide idMenu" class="center-align"><?php echo $value['ID_MODULO']; ?></td>
                            <td class="center-align"><?php echo $value['NOME_MODULO']; ?></td>
                            <td class="tipoMenu center-align"><?php echo $value['TIPO_MENU']; ?></td>
                            <?php if ($value['ATIVO'] == 1): ?>
                                <td class="center-align"><a class="inativaMenu waves-effect waves-light btn red">Inativar</a></td>
                            <?php else: ?>
                                <td class="center-align"><a class="ativaMenu waves-effect waves-light btn">Ativar</a></td>
                            <?php endif; ?>
                        </tr> 
                    <?php endforeach; ?>
                </tbody>
            </table> 
        </div>
    </div>
    <div id="ativaInativaFerramenta" class="col s12">
        <div id="tabelaContainerAtivaInativaFerramenta">
            <table id="tblFerramenta" class="display">
                <thead>
                    <tr>
                        <th class="hide center-align">Id</th>
                        <th class="center-align">Nome Ferramenta</th>
                        <th class="center-align">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $classe = new Modulos();
                    $dados = $classe->consultaFerramentas();
                    foreach ($dados as $value):
                        ?>
                        <tr>
                            <td class="hide idFerramenta" class="center-align"><?php echo $value['ID_MODULO']; ?></td>
                            <td class="center-align"><?php echo $value['NOME_MODULO']; ?></td>
                            <?php if ($value['ATIVO'] == 1): ?>
                                <td class="center-align"><a class="removeFerramenta waves-effect waves-light btn red">Inativar</a></td>
                            <?php else: ?>
                                <td class="center-align"><a class="ativaFerramenta waves-effect waves-light btn">Ativar</a></td>
                            <?php endif; ?>
                        </tr> 
                    <?php endforeach; ?>
                </tbody>
            </table> 
        </div>    
    </div>
    <div id="ordenacao" class="col s12">
        <form method="POST" action="modulo/ordenar">
            <div class="input-field" id="selectMenuOrdenacao">
                <select name="menuOrdenacao" id="idMenuOrdenacao" class="validate">                      
                    <option value="" selected>Menu Principal</option> 
                    <optgroup label="Submenus">
                        <?php
                        $classe = new Modulos();
                        $dados = $classe->carregaHeaderMenu();
                        foreach ($dados as $item):
                            ?>
                            <option value ="<?php echo $item['ID_MODULO']; ?>"><?php echo $item['NOME_MODULO']; ?></option>
                            <?php
                        endforeach;
                        ?>
                    </optgroup>
                </select>
                <label>Selecione o Menu</label>
                <span id="menuOrdenacaoHelper" class="helper-text red-text hide" data-error="" data-success="">Preencha este campo.</span>
            </div>
            <div class="input-field">
                <button class="waves-effect waves-light btn" type="submit">Visualizar</button>
            </div>
        </form>
    </div>
    <div id="ferramentaManutencao" class="col s12">
        <div class="input-field">
            <input id="dataPrevisaoRetorno" name="dataPrevisaoRetorno" type="text" class="datepicker">
            <label for="dataPrevisaoRetorno">Data de Retorno</label>
            <span id="dataPrevisaoRetornoHelper" class="helper-text" data-error="" data-success=""></span>
        </div>
        <div class="input-field">
            <input id="previsaoRetorno" type="text" class="timepicker" class="validate" name="nomeFerramenta">
            <label for="previsaoRetorno">Previsão de Retorno</label>
            <span id="previsaoRetornoNomeFerramentaHelper" class="helper-text" data-error="" data-success=""></span>
        </div>
        <div class="input-field">
            <input id="descricaoManutencao" type="text" name="descricaoManutenca" class="validate tooltipped" data-position="bottom" data-tooltip="Insira de forma resumida o motivo da manutenção, disponível na página de manutenção.">
            <label for="descricaoManutencao">Descrição</label>
            <span id="helperDescricaoManutencao" class="helper-text" data-error="" data-success=""></span>
        </div>
        <div class="input-field">
            <button class="waves-effect waves-light btn" id="inativaWfm">Gravar</button>
        </div>
        <div class="input-field">
            <table id="tblWfmInativa" class="centered">
                <thead>
                    <tr class="teal lighten-2">
                        <th class="hide center-align"></th>
                        <th class="center-align">Nome Ferramenta</th>
                        <th class="center-align">Status</th>
                        <th class="center-align">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $teste = new Modulos();
                    $tabelaa = $teste->carregaInativaWfm();

                    if (!empty($tabelaa)):
                        foreach ($tabelaa as $value):
                            ?>                   
                            <tr>
                                <td class="hide" class="idMenu"><?php echo $value['ID_MODULO']; ?></td>
                                <td><?php echo $value['NOME_MODULO'] ? 'Workforce' : ''; ?></td>
                                <td>Sistema inativo desde <?php
                                    $data = $value['CRIACAO'];
                                    $dataFormatada = date("d/m/Y", strtotime($data));
                                    echo $dataFormatada;
                                    ?></td>    
                                <td class="center-align"><a class="removeMensagem503 waves-effect waves-light btn red">Remover Mensagem</a></td>
                            </tr>
                        <?php endforeach; ?> 
                    <?php else: ?>
                    <td class="center-align" colspan="3">O sistema está ativo.</td>
                <?php endif; ?>
                </tbody>
            </table> 
        </div>
    </div>
</div>
<script src="<?php echo BASE_URL; ?>views/modulo/assets/js/jsModulo.js"></script>

