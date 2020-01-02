<?php

function dataTable($id, $classe = null, $th, $td, $acao = null, $botoes = array()) {


$td = array(
    "foo" => "teste",
    "bar" => "testesdf",
    "asdf" => "fdsdf",
);

foreach ($td as $value){
    $dado = $dado.= "'$value'".",";
}

$dadoTratado = substr($dado, 0,-1);

echo $dadoTratado;    
    
?>

    <table class="display <?php echo $classe; ?>">
        <thead>
            <tr>
                <?php foreach ($th as $dadoTh): ?>
                    <th><?php echo $dadoTh; ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>

<?php } ?>

<script>

// Select all TRs in the floatTable having the class footerRaw
$(".display tr.footerRow").each(function(key, el) {
  // here you could define anything whatever you want
  var tdContent = 'Lorem ipsum dolor';
  
  var dados = [<?php echo $dadoTratado ?>];
  
   $.each(dados, function (index, value) {
        $(this).append('<td>' + value + ' #' + i + '</td>');
    });
});


</script>



