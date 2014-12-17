      <a href="index.php?pg=registrace">Registrace</a></li>
          </ul>  
      <?php
        global $page;
        global $id;
        $action = "index.php?pg=".$page."&action=login_go&id=".$id;
        echo "<form class='navbar-form navbar-right paddingSmallRight' role='form' method='POST' action='$action'>";
      ?>
        <div class="form-group">
          <input type="text" name="login" placeholder="Jméno" class="form-control">
        </div>
        <div class="form-group">
          <input type="password" name="heslo" placeholder="Heslo" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Pøihlásit se</button>
      </form>  