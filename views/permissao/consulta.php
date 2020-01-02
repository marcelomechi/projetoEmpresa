
<style>
    .tabs .indicator {
        background-color:#26a69a;
        /*Custom Color Of Indicator*/
    }

</style>
<div class="row">
    <div class="col s12">
        <ul class="tabs">
            <li class="tab col s3 disabled"><a href="#liberarAcesso">Acesso Perfil</a></li>
            <li class="tab col s3"><a href="#liberarAcessoIndividual" class="active">Acesso Individual</a></li>
            <!-- <li class="tab col s3"><a href="#">Liberar Usuário Convidado</a></li> -->
            <li class="tab col s3 disabled"><a href="#">Gerenciar Perfis</a></li>
            <li class="tab col s3 disabled"><a href="#">Gerenciar Usuários</a></li>
        </ul>
    </div>
</div>

<div>

</div>

<div class="row">
    <div class="col s12" id="tabelaAcessosConsultaIndividual">
        <table id="tabelaFeramentaConsultaIndividual" class="display centered responsive-table">
            <thead>
                <tr class="teal">
                    <th hidden>Id Modulo</th>
                    <th>CPF</th>
                    <th>Menu</th>
                    <th>Tipo</th>
                    <th>Acesso</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dados as $value): ?>
                    <tr>
                        <td><?php echo $value['CPF_INFORMADO']; ?></td>
                        <td><?php echo $value['NOME_MODULO'];?></td>
                    </tr>                       
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.tabs').tabs();
    });
</script>