<div class="container">
<?php
  global $twig;
  global $admin_prihlasen;
  
  if($admin_prihlasen == true){
    $where = $_REQUEST["where"];
    $id = $_REQUEST["id"];
    
    if($where == "clanek"){
      if($id == 0){
        $template_clanky = $twig->loadTemplate('clanek_upravit.htm');  
        $template_params = array();     
        $template_params["akce"] = "pridejclanek_go";
        $template_params["udelej"] = "Pøidej";
        echo $template_clanky->render($template_params);
      }else{
        global $clanky;
        $clanek_pom = $clanky->GetClanekByID($id);
        
        $template_clanky = $twig->loadTemplate('clanek_upravit.htm');  
        $template_params = array();
        $template_params["akce"] = "upravit_go&where=clanek&id=".$id;
        $template_params["nazev"] = $clanek_pom["nazev"];
        $template_params["obsah"] = $clanek_pom["obsah"];
        $template_params["udelej"] = "Uložit";
        echo $template_clanky->render($template_params);
      }
    }else{
      global $uzivatele;
      $uzivatel_pom = $uzivatele->GetUzivatelByID($id);
      
      $template_uzivatel = $twig->loadTemplate('uzivatel_upravit.htm');  
      $template_params = array();
      $template_params["id"] = $id;
      $template_params["login"] = $uzivatel_pom["login"];
      $template_params["heslo"] = $uzivatel_pom["heslo"];
      echo $template_uzivatel->render($template_params);
    }
  }
?>     
      <br/>
      <hr>
      <footer>
        <p>&copy; Company 2014</p>
      </footer>
    </div> <!-- /container -->