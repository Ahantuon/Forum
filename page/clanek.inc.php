<?php 
  global $clanky;
  global $uzivatele;
  global $twig;
  global $id;
  
  $clanky_pole = $clanky->GetClanekByID($id);
  $template_clanky = $twig->loadTemplate('clanek.htm');     
  $template_params = array();
  
  $template_params["nazev"] = $clanky_pole["nazev"];  
  $template_params["obsah"] = $clanky_pole["obsah"];

  $converted_date = date_format(new DateTime($clanky_pole["datum"]), 'd. M Y H:i');
  
  $template_params["datum"] = $converted_date;
  $autor = $uzivatele->GetUzivatelByID($clanky_pole["uzivatel_id"]);      
  $template_params["autor"] = $autor["login"]; 
  
  echo $template_clanky->render($template_params);    
?>
     <hr>

        <?php
          global $uzivatel_prihlasen;
          global $admin_prihlasen;
          global $hodnoceni;
          if($uzivatel_prihlasen == true){
            $action = "index.php?pg=clanky&action=pridejhodnoceni_go&id=".$id;
            echo "<form class='form-horizontal' role='form' method='POST' action='$action'> 
              <div class='form-group'>
                <label for='inputPrispevek' class='col-sm-2 control-label'>Komentáø</label>
                <div class='col-sm-10'>
                  <textarea name='prispevek' class='form-control' rows='3' placeholder='Text'></textarea>
                </div>
              </div>
              <div class='form-group'>
                <div class='col-sm-offset-2 col-sm-10'>
                  <button type='submit' class='btn btn-default pull-right'>Odeslat</button>  
                </div>
              </div>
            </form>";
          }
          $hodnoceni_pole = $hodnoceni->LoadAllHodnoceni();
          $template_hodnoceni = $twig->loadTemplate('hodnoceni.htm');     
          for($i = count($hodnoceni_pole)-1; $i >= 0; $i--){
            if($hodnoceni_pole[$i]["clanek_idclanek"] == $id){
              $template_params = array();
              $autor_reakce = $uzivatele->GetUzivatelByID($hodnoceni_pole[$i]["uzivatel_id"]);    
              $template_params["autor"] = $autor_reakce["login"];
              $template_params["obsah"] = $hodnoceni_pole[$i]["obsah"];
              
              $converted_date = date_format(new DateTime($hodnoceni_pole[$i]["datum"]), 'd. M Y H:i');
              
              $template_params["datum"] = $converted_date; 
              $template_params["idSmazat"] = $hodnoceni_pole[$i]["idhodnoceni"];
              $template_params["id_clanek"] = $id;
              if($admin_prihlasen == false){
                $template_params["smazat"] = "hidden";
              }
              echo $template_hodnoceni->render($template_params); 
            } 
          }
        ?>
   
    <hr>
     <footer>
        <p>&copy; Company 2014</p>
      </footer>
 </div> <!-- /container -->