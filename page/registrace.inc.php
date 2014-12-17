<div class="container">
  <form role="form" class="smallWidth centered" method="POST" action='index.php?pg=registrace&action=registrace_go'>
    <div class="form-group">
      <label for="exampleInputLogin">Uživatelské jméno</label>
      <input value="<?php global $login; echo $login;?>" type="text" class="form-control" name="login" placeholder="Uživatelské jméno">
    </div>
    <!--<div class="form-group">
      <label for="exampleInputEmail1">Emailová adresa</label>
      <input value="<?php global $email; echo $email;?>" type="email" class="form-control" name="email" placeholder="Emailová adresa">
    </div>-->
    <div class="form-group">
      <label for="exampleInputPassword1">Heslo</label>
      <input type="password" class="form-control" name="heslo" placeholder="Heslo"> 
    </div>
    <div class="form-group">
      <label for="exampleInputPassword2">Heslo pro potvrzeni</label>
      <input type="password" class="form-control" name="hesloPotvrzeni" placeholder="Heslo pro potvrzení">
    </div>
    <div class="form-group">
      <label for="exampleInputCaptcha">Pìt plus šest je:</label>
      <input type="text" class="form-control" name="captcha" placeholder="Pìt plus šest">
    </div>
    <button type="submit" class="btn btn-default pull-right">Registrace</button>
  </form>
</div>