<?php
  global $admin_prihlasen;
  global $clanky;
  global $uzivatele;
  global $twig;
  
  if($admin_prihlasen == true){
    $clanky_pole = $clanky->LoadAllClanky();
    $uzivatele_pole = $uzivatele->LoadAllUzivatele();
    $template = $twig->loadTemplate('administrace.htm');
    
    echo "<div class='container'>";
    echo "<h3>Èlánky<a class='mezera-left glyphicon glyphicon-plus glyphicon-small' href='index.php?pg=upravit&id=0&where=clanek'></a></h3>";
    echo "<table class='table table-hover'>";
    for($i = 0; $i < count($clanky_pole); $i++){
      $template_params = array(); 
      $template_params["id"] = $clanky_pole[$i]["idclanek"];      
      $template_params["prvni"] = $clanky_pole[$i]["nazev"];
      $template_params["where"] = "clanek"; 
      echo $template->render($template_params);
    }
    echo "</table>";
    echo "<h3>Uživatelé<a class='mezera-left glyphicon glyphicon-plus glyphicon-small' href='index.php?pg=registrace'></a></h3>";
    echo "<table class='table table-hover'>";
    for($i = 0; $i < count($uzivatele_pole); $i++){
      $template_params = array(); 
      $template_params["id"] = $uzivatele_pole[$i]["id"];      
      $template_params["prvni"] = $uzivatele_pole[$i]["login"];
      $template_params["druhy"] = $uzivatele_pole[$i]["heslo"];
      $template_params["where"] = "uzivatel";
      echo $template->render($template_params);
    }
    echo "</table>";
    echo "</div>";
  }else{
    include("stranka_nenalezena.inc.php");
  }
?>