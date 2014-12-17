        </li>
          </ul>  
        <?php
          global $page;
          global $id;
          $action = "index.php?pg=".$page."&action=logout_go&id=".$id;
          echo "<form class='navbar-form navbar-right paddingSmallRight' role='form' method='POST' action='$action'>";
        ?>
            <label>
            <?php
              global $session_key_app;
              echo $_SESSION[$session_key_app]["login"];      
            ?>
            </label>
            <button type="submit" class="btn" name="odhlasit">Odhlásit se</button>
          </form>