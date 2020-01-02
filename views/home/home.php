<?php if ($_SESSION['senha'] == md5($_SESSION['CPF'])): ?>

    <div id="modal1" class="modal">
        <div class="modal-content">
            <h5 class="center-align">Seja bem-vindo ao novo Workforce, <?php echo $nome; ?>!</h5>
            <p class="center-align">Identificamos que está acessando a ferramenta usando sua senha inicial, solicitamos que você altere para uma senha de sua preferência, que não seja seu CPF, para isso, preencha as informações abaixo.</p>
            <div class="input-field">
                <input id="cpf" type="text" class="cpf">
                <label for="cpf">Digite seu CPF</label>
            </div>
            <div class="input-field">
                <input id="novaSenha" type="password" class="validate">
                <label for="novaSenha">Nova Senha</label>
            </div>
            <div class="input-field">
                <input id="confirmaNovaSenha" type="password" class="validate">
                <label for="confirmaNovaSenha">Confirme sua nova senha</label>
            </div>
            <div class="input-field right-align">            
                <button id="gravaAlteracaoSenha" class="btn waves-effect">Gravar</button> 
            </div>

        </div>
    </div>

    <script src="<?php echo BASE_URL; ?>views/home/assets/js/jsHome.js"></script> <!-- tenho que psssar todo o caminho para não dar erro no JS -->

<?php endif; ?>
