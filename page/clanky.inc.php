<?php
  global $clanky;
  global $twig;
  
  $clanky_pole = $clanky->LoadAllClanky();
  $template_clanky = $twig->loadTemplate('clanek_hlavni.htm');     
  $template_params = array();
  
  $template_params["nazev"] = $clanky_pole[count($clanky_pole)-1]["nazev"];  
  $template_params["popis"] = implode(' ', array_slice(explode(' ', $clanky_pole[count($clanky_pole)-1]["obsah"]), 0, 40));      
  $template_params["id"] = $clanky_pole[count($clanky_pole)-1]["idclanek"];     
?>
  <div class="jumbotron">
    <div class="container">  
      <?php  echo $template_clanky->render($template_params); ?>   
    </div> 
  </div>   
  <div class="container"> 
  <?php 
    $template_clanky = $twig->loadTemplate('clanek_ostatni.htm');       
    $template_params = array();
    
    for($i = 0 ; $i < count($clanky_pole)-1; $i++){
      if($i%2 == 0){
        echo "<div class='row'>";
      }  
      $template_params["nazev"] = $clanky_pole[count($clanky_pole)-2-$i]["nazev"];  
      $template_params["popis"] = implode(' ', array_slice(explode(' ', $clanky_pole[count($clanky_pole)-2-$i]["obsah"]), 0, 40));      
      $template_params["id"] = $clanky_pole[count($clanky_pole)-2-$i]["idclanek"]; 
      echo $template_clanky->render($template_params);
      if($i%2 == 1){
        echo "</div><hr>";
      }    
    }
    if(count($clanky_pole)%2 == 0){
      echo "</div><hr>";
    }   
  ?>  
      
      
      <footer>
        <p>&copy; Company 2014</p>
      </footer>
    </div> <!-- /container -->