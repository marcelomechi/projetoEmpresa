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
            <?php
            $classe = new Permissao();
            $dadosConvidados = $classe->consultaConvidados();

            foreach ($dadosConvidados as $convidado):
                ?>
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

    <div id="modalNovoPerfil" class="modal">
        <div class="modal-content">
                

        </div>
        <div class = "modal-footer">
            <div class = "input-field col s12">
                <a class = "fechaModalNovoPerfil modal-close waves-effect waves-light btn-small red">Fechar</a>
                <a class = "gravaNovoPerfil waves-effect waves-light btn-small">Gravar</a>
            </div>
        </div>
    </div>

<?php endif; ?>