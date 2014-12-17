<?php
  global $uzivatel_prihlasen;
  global $admin_prihlasen;
  global $uzivatele;
  global $twig;
  global $prispevek;
  global $reakce;
  global $admin_prihlasen;
  if($uzivatel_prihlasen == true){
    include 'pridej_prispevek.inc.php';
  }      
?>

<div class="container text-justify">
  <div class="bs-docs-grid">
    <?php     
      $prispevky_pole = $prispevek->LoadAllPrispevky();
      $template_prispevky = $twig->loadTemplate('prispevek.htm');
      $reakce_pole = $reakce->LoadAllReakce();
      $template_reakce = $twig->loadTemplate('reakce.htm');
      
      for($i = count($prispevky_pole)-1; $i >= 0; $i--){
        $template_params = array();       
        $template_params["predmet"] = $prispevky_pole[$i]["nadpis"];
        $autor = $uzivatele->GetUzivatelByID($prispevky_pole[$i]["uzivatel_id"]);      
        $template_params["autor"] = $autor["login"];
        
        $converted_date = date_format(new DateTime($prispevky_pole[$i]["datum"]), 'd. M Y H:i');
        
        $template_params["datum"] = $converted_date; 
        $template_params["obsah"] = $prispevky_pole[$i]["obsah"];
        $template_params["id"] = $prispevky_pole[$i]["idprispevek"];
        $template_params["idSmazat"] = $prispevky_pole[$i]["idprispevek"];
        if($uzivatel_prihlasen == false){
          $template_params["reagovat"] = "hidden";    
        }
        if($admin_prihlasen == false){
          $template_params["smazat"] = "hidden";
        }
        echo $template_prispevky->render($template_params);
        for($j = 0; $j < count($reakce_pole); $j++){
          if($reakce_pole[$j]["prispevek_idprispevek"] == $prispevky_pole[$i]["idprispevek"]){
            $template_params_reakce = array();       
            $autor_reakce = $uzivatele->GetUzivatelByID($reakce_pole[$j]["uzivatel_id"]);    
            $template_params_reakce["autor"] = $autor_reakce["login"];
            
            $converted_date = date_format(new DateTime($reakce_pole[$j]["datum"]), 'd. M Y H:i');
            
            $template_params_reakce["datum"] = $converted_date; 
            $template_params_reakce["obsah"] = $reakce_pole[$j]["obsah"];
            $template_params_reakce["idSmazat"] = $reakce_pole[$j]["idreakce"];
            if($admin_prihlasen == false){
              $template_params_reakce["smazat"] = "hidden";
            }
            echo $template_reakce->render($template_params_reakce); 
          }
        }  
      } 
    ?>
  
  </div>
  
  
  
    <hr>
     <footer>
        <p>&copy; Company 2014</p>
      </footer>
 </div> <!-- /container -->
