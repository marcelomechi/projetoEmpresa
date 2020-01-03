<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if ($tipo == 1):
    ?>
    <h4>Acessos:</h4>
    <table id="tabelaAcessosConsultaIndividual" class="display centered responsive-table">
        <thead>
            <tr class="teal">
                <th hidden>Id Modulo</th>
                <th>CPF</th>
                <th>Menu</th>
                <th>Tipo</th>
                <th>Status Liberação</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($acessosIndividuais) && !empty($acessosIndividuais)): ?>
                <?php foreach ($acessosIndividuais as $value): ?>
                    <tr>
                        <td hidden><?php echo $value['ID_MODULO']; ?></td>
                        <td><?php echo $value['CPF_INFORMADO']; ?></td>
                        <td><?php echo $value['NOME_MODULO']; ?></td>
                        <td><?php echo $value['TIPO_LINK']; ?></td>
                        <td><?php echo $value['LIBERACAO_DESC']; ?></td>
                    </tr>                       
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <script>

        $(document).ready(function () {
            $('select').formSelect();
            $('#tabelaAcessosConsultaIndividual').DataTable({

                columnDefs: [
                    {
                        targets: [0, 1, 2, 3]

                    }
                ],
                "order": [1, "asc"]

            });
        });

    </script>

<?php elseif ($tipo == 2): ?>
    <p class="flow-text center-align">Para criar um novo Perfil de Acesso <a class="modal-trigger" href="#modalNovoPerfil">clique aqui</a>.</p>
    <table id="tabelaPerfis" class="display centered responsive-table">
        <thead>
            <tr>
                <th hidden>Id Perfil</th>
                <th>Perfil</th>
                <th>Descrição</th>
                <th>Nível Grupo Perfil</th>
                <th>Deslogue Automático</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($tabelaPerfil)):
                foreach ($tabelaPerfil as $value):
                    ?>
                    <tr>
                        <td class="idPerfil" hidden><?php echo $value['ID_PERFIL'] ?></td>
                        <td><?php echo $value['PERFIL'] ?></td>
                        <td><?php echo $value['DESCRICAO'] ?></td>
                        <td><?php echo $value['NIVEL_GRUPO_PERFIL'] ?></td>
                        <td><?php echo $value['DESLOGUE'] ?></td>
                        <td>
                            <?php if ($value['ATIVO'] == 1): ?>
                                <a class="inativaPerfil waves-effect waves-light btn-small red">Inativar</a>
                            <?php else: ?>
                                <a class="ativaPerfil waves-effect waves-light btn-small">Ativar</a>
                            <?php endif; ?> 
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <script>

        $(document).ready(function () {
            $('select').formSelect();
        });

        $('#tabelaPerfis').DataTable({

            columnDefs: [
                {
                    targets: [0, 1, 2, 3]

                }
            ],
            "order": [1, "asc"]
        });
    </script>

<?php elseif ($tipo == 3): ?>


    <table id="tabelaConvidados" class="display centered responsive-table">
        <thead>
            <tr>
                <th>CPF</th>
                <th>Nome</th>
                <th>Contrato</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
           
            <?php foreach ($tabelaConvidados as $convidado): ?>
                <tr>
                    <td class="cpfConvidado"><?php echo $convidado['CPF'] ?></td>
                    <td><?php echo $convidado['NOME'] ?></td>
                    <td>CONTRATO</td>
                    <td><a class="visualizaDadosConvidado waves-effect waves-light light-blue accent-4 btn-small">Visualizar</a> <a class="liberaAcessoConvidado waves-effect waves-light btn-small">Liberar</a> <a class="bloqueiaAcessoConvidado waves-effect waves-light btn-small red">Negar</a></td>
                </tr>
            <?php endforeach; ?> 
        </tbody>
    </table>

    <script>

        $('#tabelaConvidados').DataTable({

            columnDefs: [
                {
                    targets: [0, 1, 2, 3]

                }
            ],
            "order": [1, "asc"]
        });
    </script>
<?php elseif ($tipo == 4): ?>
    <div class="input-field">
        <input id="nomeConvidadoDetalhe" readonly type="text" value="<?php echo $dadosConvidado['NOME']; ?>">
        <label for="nomeConvidadoDetalhe">Nome</label>        
    </div>
    <div class="input-field">
        <input id="cpfConvidadoDetalhe" readonly type="text" class="cpf" value="<?php echo $dadosConvidado['CPF']; ?>">
        <label for="cpfConvidadoDetalhe">CPF</label>        
    </div>
    <div class="input-field">
        <input id="funcaoConvidadoDetalhe" readonly type="text" value="<?php echo $dadosConvidado['FUNCAO']; ?>">
        <label for="funcaoConvidadoDetalhe">Cargo</label>        
    </div>
    <div class="input-field">
        <input id="cepConvidadoDetalhe" readonly type="text" class="cep" value="<?php echo str_pad($dadosConvidado['CEP'], 8, '0', STR_PAD_LEFT); ?>">
        <label for="cepConvidadoDetalhe">CEP</label>        
    </div>
    <div class="input-field">
        <input id="ruaConvidadoDetalhe" readonly type="text" value="<?php echo $dadosConvidado['RUA']; ?>">
        <label for="ruaConvidadoDetalhe">Rua</label>        
    </div>
    <div class="input-field">
        <input id="numeroConvidadoDetalhe" readonly type="text" value="<?php echo $dadosConvidado['NUMERO']; ?>">
        <label for="numeroConvidadoDetalhe">Número</label>        
    </div>
    <div class="input-field">
        <input id="bairroConvidadoDetalhe" readonly type="text" value="<?php echo $dadosConvidado['BAIRRO']; ?>">
        <label for="bairroConvidadoDetalhe">Bairro</label>        
    </div>
    <div class="input-field">
        <input id="cidadeConvidadoDetalhe" readonly type="text" value="<?php echo $dadosConvidado['CIDADE']; ?>">
        <label for="cidadeConvidadoDetalhe">Cidade</label>        
    </div>
    <div class="input-field">
        <input id="sexoConvidadoDetalhe" readonly type="text" value="<?php echo $dadosConvidado['SEXO']; ?>">
        <label for="sexoConvidadoDetalhe">Sexo</label>        
    </div>
    <div class="input-field">
        <textarea id="descricaoSolicitacao" name="descricaoSolicitacao" class="materialize-textarea" readonly><?php echo $dadosConvidado['DESCRICAO_LIBERACAO']; ?></textarea>
        <label for="descricaoSolicitacao">Observações</label>
    </div>
    <script>
        $(document).ready(function () {
            $('.cep').mask('00000-000');
            $('.cpf').mask('000.000.000-00', {reverse: true});
            M.textareaAutoResize($('#descricaoSolicitacao'));
        });
    </script>
<?php endif; ?>