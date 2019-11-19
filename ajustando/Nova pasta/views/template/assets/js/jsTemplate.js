$(document).ready(function(){
    $('.collapsible').collapsible();
    $('.tap-target').tapTarget('open');
    $('.tooltipped').tooltip();

    $(".sidenav").sidenav({
        onOpenStart: function(){
         // document.getElementById("main").style.marginLeft = "300px";
         //document.getElementById("main").style.transition = "0.1s";
         // document.getElementById("main2").style.marginLeft = "300px";
         // document.getElementById("main2").style.transition = "0.1s";
        },
        onCloseEnd: function(){
         // document.getElementById("main").style.marginLeft = "18px";
         // document.getElementById("main").style.transition = "0.1s";
         // document.getElementById("main2").style.marginLeft = "auto";
         // document.getElementById("main2").style.transition = "0.1s";      
        }
    });
    
    /*caso queira uma confirmação antes do usuario sair da pagina, dar f5 e tal...
     * $(window).bind("beforeunload", function() { 
            return "asdfasdfasdfas"; 
    });*/
  

    // tema escuro //
    
    const currentTheme = localStorage.getItem('theme');
        document.documentElement.setAttribute('data-theme', currentTheme);


});