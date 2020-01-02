<?php if ($tipo == 1): ?>
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
            foreach ($menu as $value):
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
    <script>

        $(document).ready(function () {
            $('#tblMenus').DataTable({
                columnDefs: [
                    {
                        targets: [0, 1, 2]

                    }
                ],
                "order": [[0, "asc"]]

            });
            $('select').formSelect();

        });
    </script>
<?php elseif ($tipo == 2): ?>

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
            foreach ($ferramenta as $value):
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
    <script>
        $('#tblFerramenta').DataTable({
            columnDefs: [
                {
                    targets: [0, 1, 2]

                }
            ],
            "order": [[0, "asc"]]
        });
        $('select').formSelect();
    </script>

<?php elseif ($tipo == 3): ?>
    

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
            if (!empty($tabelaFerramentaInativa)):
                foreach ($tabelaFerramentaInativa as $value):
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
<?php endif; ?>
