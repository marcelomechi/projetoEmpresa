<!DOCTYPE html>
<html>
    <head>
        <title>Página não existe</title>
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/cssFramework/css/style.css">
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>views/404/assets/css/custom404.css">
    </head>
    <body>
        <?php
            include('dadosManutencao.php');
            
            if(!empty($horaPrevisaoRetorno) && !empty($motivoManutencao)&& !empty($dataPrevisaoRetorno) && date("Y-m-d", strtotime($dataPrevisaoRetorno)) >= date("Y-m-d")):
        ?>
         <div class="box">
            <div class="row">
                <div class="col s12 textoGrande center-align">503</div>
            </div>
            <div class="row">
                <div class="col s12 center-align textoMedio white-text">Ferramenta em Manutenção</div>
            </div>
            <div class="row">
                <div class="col s12 center-align textoMedio white-text"><?php echo $motivoManutencao.' com previsão de retorno no dia '.$dataPrevisaoRetorno.' por volta das '.$horaPrevisaoRetorno; ?> </div>
            </div>
            <div class="row">
            </div> 
        </div>
        
        <?php else: ?>      
        
        <div class="box">
            <div class="row">
                <div class="col s12 textoGrande center-align texto">503</div>
            </div>
            <div class="row">
                <div class="col s12 center-align textoMedio white-text">Voltaremos em breve...</div>
            </div>
            <div class="row">
                <div class="col s12 center-align textoMedio white-text">Desculpe pela inconveniência, estamos fazendo alguma manutenção no momento, em breve estaremos online.</div>
            </div>
            <div class="row">
                 <div class="col s12 center-align textoMedio white-text">- Administrador de Sistemas.</div>
            </div> 
        </div>
        <?php endif; ?>
    </body>
</html>