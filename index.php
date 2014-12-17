
    <?php
      require 'config/config.inc.php';

      require 'core/app.class.php';
      require 'core/db.class.php';
      require 'core/uzivatel.class.php';
      require 'core/clanek.class.php';
      require 'core/prispevek.class.php';
      require 'core/reakce.class.php';
      require 'core/hodnoceni.class.php';
      
      function phpWrapperFromFile($filename)
      {
        ob_start();
        if (file_exists($filename) && !is_dir($filename))
        {
          include($filename);
        }
        $obsah = ob_get_clean();
        return $obsah;
      }
      
      require_once 'twig/lib/Twig/Autoloader.php';
      Twig_Autoloader::register();        
      $loader = new Twig_Loader_Filesystem('sablony');                
      $twig = new Twig_Environment($loader);  
      $template = $twig->loadTemplate('sablona.htm'); 
      $template_params = array();

      $app = new app();
      $app->Connect();
      $db_connection = $app->GetConnection();
      $uzivatele = new uzivatel($db_connection);
      $clanky = new clanek($db_connection);
      $prispevek = new prispevek($db_connection);
      $reakce = new reakce($db_connection);
      $hodnoceni = new hodnoceni($db_connection);

      session_start();
      $session_key_app = "cms_user";
      $uzivatel_prihlasen;
      $admin_prihlasen = false;

      if (isset($_SESSION[$session_key_app])){
      }else{
        $_SESSION[$session_key_app] = array();
      }
      $action = @$_REQUEST["action"];
      
      if ($action == "login_go"){
        $login = $_POST["login"];
        $heslo = $_POST["heslo"];
        if ($login != "" && $heslo != ""){
          $uzivazel_pole = $uzivatele->GetUzivatelByLogin($login);
          if($uzivazel_pole["heslo"] == $heslo){
            $_SESSION[$session_key_app]["login"] = $login;
          }
        }else{
            // špatný login a heslo
        }
        header("Location: http://forumsparta.moxo.cz/index.php?pg=".$_REQUEST["pg"]."&id=".$_REQUEST["id"]);
      }

      if ($action == "logout_go"){
        $_SESSION[$session_key_app] = array();
        unset($_SESSION[$session_key_app]);
        header("Location: http://forumsparta.moxo.cz/index.php?pg=".$_REQUEST["pg"]."&id=".$_REQUEST["id"]);
      }
      // je uzivatel prihlaseny? Existuje klic login?
      if (isset($_SESSION[$session_key_app]["login"])){
        $uzivatel_prihlasen = true;
        if($_SESSION[$session_key_app]["login"] == "admin"){
          $admin_prihlasen = true;
        }
      }else
        $uzivatel_prihlasen = false;
      // neprihlasenemu uzivateli zobrazim prihlasovaci formular
      if ($uzivatel_prihlasen == false){
        $prihlaseni_filename = "page/prihlaseni.inc.php";
      }
      else{
        $prihlaseni_filename = "page/odhlaseni.inc.php";
      }
      if ($action == "upravit_go"){
        if($admin_prihlasen == true){
          $where = $_REQUEST["where"];
          $id = $_REQUEST["id"];
  
          if($where == "clanek"){
            $nazev = $_POST["nazev"];
            $obsah = $_POST["obsah"];

            if($nazev != "" || $obsah != ""){
              $clanky->UpdateClanek($nazev, $obsah, $id);
            }
          }elseif($where == "uzivatel"){
            $login = $_POST["login"];
            $heslo = $_POST["heslo"];

            if($login != "" || $heslo != ""){
              $uzivatele->UpdateUzivatel($login, $heslo, $id);
            }
          }
        }
        header("Location: http://forumsparta.moxo.cz/index.php?pg=administrace");
      }
      
      if ($action == "smazat_go"){
        if($admin_prihlasen == true){
          $where = $_REQUEST["where"];
          $id = $_REQUEST["id"];
          if($where == "uzivatel"){
              $uzivatele->DeleteUzivatelByID($id);
          }else if($where == "prispevek"){
              $prispevek->DeletePrispevekByID($id);
          }else if($where == "reakce"){
              $reakce->DeleteReakceByID($id);
          }else if($where == "clanek"){
              $clanky->DeleteClanekByID($id);
          }else if($where == "hodnoceni"){
              $hodnoceni->DeleteHodnoceniByID($id);
          }
        }
        if($where == "hodnoceni"){
          header("Location: http://forumsparta.moxo.cz/index.php?pg=".$_REQUEST["pg"]."&id=".$_REQUEST["id_clanek"]);
        }else{
          header("Location: http://forumsparta.moxo.cz/index.php?pg=".$_REQUEST["pg"]);
        }
      }
      
      if($action == "registrace_go"){
        $login = $_POST["login"];
        //$email = $_POST["email"];
        $heslo = $_POST["heslo"];
        $hesloPotvrzeni = $_POST["hesloPotvrzeni"];
        $captcha = $_POST["captcha"];
        
        if($login == "" || /*$email == "" ||*/ $heslo == "" || $hesloPotvrzeni == "" || $captcha == ""){
          echo "<h3 class='text-center'>Všechna pole musí být vyplnìná</h3>";
        }elseif($heslo != $hesloPotvrzeni){
          echo "<h3 class='text-center'>Hesla se neschodují</h3>";
        }elseif($captcha != 11){
          echo "<h3 class='text-center'>Pìt plus šest není ".$captcha."</h3>";
        }else{
          $uzivazel_pole = $uzivatele->LoadAllUzivatele();
          $pocet = count($uzivazel_pole);
          $nalezen = false;
          for($i = 0; $i < $pocet; $i++){
            if($uzivazel_pole[$i]["login"] == $login){
               $nalezen = true;
            }
          }
          if($nalezen == true){
            echo "<h3 class='text-center'>Uživatel s tímto jménem již existuje</h3>";
          }else{
            $uzivazel_insert["login"] = $login;
            $uzivazel_insert["heslo"] = $heslo;
            $uzivatele->InsertUzivatel($uzivazel_insert);
            $login = "";
            $email = "";
            echo "<h3 class='text-center'>Registrace úspìšnì probìhla</h3>";
          }
        }
        header("Location: http://forumsparta.moxo.cz/index.php?pg=".$_REQUEST["pg"]); 
      }
      if($action == "pridejclanek_go"){
        if($admin_prihlasen == true){
          $nazev = @$_POST["nazev"];
          $obsah = @$_POST["obsah"];

          if($nazev != "" || $obsah != "" || $autor != ""){
            $clanek_pom = array();
            $clanek_pom["nazev"] = $nazev;
            $clanek_pom["obsah"] = $obsah;
            $clanek_pom["datum"] = date('Y-m-d H:i:s');
            $uzivatel_pom = $uzivatele->GetUzivatelByLogin($_SESSION[$session_key_app]["login"]);
            $clanek_pom["uzivatel_id"] = $uzivatel_pom["id"];
            $clanky->InsertClanek($clanek_pom);  
          }
        }
        header("Location: http://forumsparta.moxo.cz/index.php?pg=administrace");
      }
      if($action == "pridejprispevek_go"){
        if($uzivatel_prihlasen == true){
          $id_reakce = @$_REQUEST["id"];
          if($id_reakce == ""){
            $id_reakce = 0;
          }
          if($id_reakce > 0){
            $predmet = $_POST["predmet"];
            $prispevek_get = $_POST["prispevek"];
            if($predmet == ""){
              echo "<h3 class='text-center'>Pøedmìt musí být vyplnìn</h3>";
            }elseif($prispevek_get == "" ){
              echo "<h3 class='text-center'>Pøíspevek musí být vyplnìn</h3>";
            }else{
              $reakce_insert["obsah"] = $prispevek_get;
              $reakce_insert["datum"] = date('Y-m-d H:i:s');
              $uzivatel_pom = $uzivatele->GetUzivatelByLogin($_SESSION[$session_key_app]["login"]);
              $reakce_insert["uzivatel_id"] = $uzivatel_pom["id"];
              $reakce_insert["prispevek_idprispevek"] = $id_reakce;
              
              $reakce->InsertReakci($reakce_insert);
              $predmet = "";
              $prispevek_get = "";
            }
          }else{
            $predmet = $_POST["predmet"];
            $prispevek_get = $_POST["prispevek"];
            if($predmet == ""){
              echo "<h3 class='text-center'>Pøedmìt musí být vyplnìn</h3>";
            }elseif($prispevek_get == "" ){
              echo "<h3 class='text-center'>Pøíspevek musí být vyplnìn</h3>";
            }else{
              $prispevek_insert["nadpis"] = $predmet;
              $prispevek_insert["obsah"] = $prispevek_get;
              $prispevek_insert["datum"] = date('Y-m-d H:i:s');
              $uzivatel_pom = $uzivatele->GetUzivatelByLogin($_SESSION[$session_key_app]["login"]);
              $prispevek_insert["uzivatel_id"] = $uzivatel_pom["id"];
              
              $prispevek->InsertPrispevek($prispevek_insert);
              $predmet = "";
              $prispevek_get = "";
            }    
          }
          header("Location: http://forumsparta.moxo.cz/index.php?pg=".$_REQUEST["pg"]);
        }
      }
      if($action == "pridejhodnoceni_go"){
        if($uzivatel_prihlasen == true){
          $hodnoceni_get = $_POST["prispevek"];
          $id_clanku = @$_REQUEST["id"];
          if($hodnoceni_get == "" ){
            echo "<h3 class='text-center'>Komentáø musí být vyplnìn</h3>";
          }else{
            $hodnoceni_insert["obsah"] = $hodnoceni_get;
            $hodnoceni_insert["datum"] = date('Y-m-d H:i:s');
            $uzivatel_pom = $uzivatele->GetUzivatelByLogin($_SESSION[$session_key_app]["login"]);
            $hodnoceni_insert["uzivatel_id"] = $uzivatel_pom["id"];
            $hodnoceni_insert["clanek_idclanek"] = $id_clanku;
            $hodnoceni->InsertHodnoceni($hodnoceni_insert);
          }
        }
        header("Location: http://forumsparta.moxo.cz/index.php?pg=".$_REQUEST["pg"]."&id=".$_REQUEST["id"]);
      }

      
      $page = @$_REQUEST["pg"];
      $id = @$_REQUEST["id"]; 
      if ($page == "")
        $page = "clanky";
      if ($id == "")
        $id = "0";
        // volba souboru
        $obsah_filename = "";
      if ($page == "clanky" && $id == 0){
        $obsah_filename = "page/clanky.inc.php";
        $template_params["clankyactive"] = "active";
      }else if ($page == "clanky" && $id != 0){
        $obsah_filename = "page/clanek.inc.php";
        $template_params["clankyactive"] = "active";
      }else if ($page == "diskuze"){
        $obsah_filename = "page/diskuze.inc.php";
        $template_params["diskuzeactive"] = "active";
      }else if ($page == "registrace"){
        $obsah_filename = "page/registrace.inc.php";
        $template_params["registraceactive"] = "active";
      }else if ($page == "administrace"){
        $obsah_filename = "page/administrace.inc.php";
        $template_params["administraceactive"] = "active";
      }else if ($page == "upravit"){
        $obsah_filename = "page/upravit.inc.php";
        $template_params["administraceactive"] = "active";
      }else
        $obsah_filename = "page/stranka_nenalezena.inc.php";
      if($admin_prihlasen == false){
        $template_params["administracehidden"] = "hidden";
      }

      $obsah = phpWrapperFromFile($obsah_filename);    
      $prihlaseni = phpWrapperFromFile($prihlaseni_filename); 

      $template_params["obsah"] = $obsah; 
      $template_params["prihlaseni"] = $prihlaseni; 
       
      echo $template->render($template_params);

    ?>
    
