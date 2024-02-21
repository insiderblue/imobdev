<?php 

// Controle de rotas
if(!@$_SESSION["user_authenticated"]){
    $page = "login";
} else {
    $page = "painel";
}

// Chama controller singular
@include("app/controller/".$page.".php");

// Chama model
@include("app/model/".$page.".php");

// Chama views
@include("app/view/_template_top.php");
if(@$_SESSION["user_authenticated"]){ @include("app/view/navbar.php"); }  
@include("app/view/".$page.".php");
@include("app/view/_template_bottom.php");

