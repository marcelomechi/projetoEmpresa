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
});