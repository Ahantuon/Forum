<div class="container">
  <form role="form" class="smallWidth centered" method="POST" action='index.php?pg=registrace&action=registrace_go'>
    <div class="form-group">
      <label for="exampleInputLogin">U�ivatelsk� jm�no</label>
      <input value="<?php global $login; echo $login;?>" type="text" class="form-control" name="login" placeholder="U�ivatelsk� jm�no">
    </div>
    <!--<div class="form-group">
      <label for="exampleInputEmail1">Emailov� adresa</label>
      <input value="<?php global $email; echo $email;?>" type="email" class="form-control" name="email" placeholder="Emailov� adresa">
    </div>-->
    <div class="form-group">
      <label for="exampleInputPassword1">Heslo</label>
      <input type="password" class="form-control" name="heslo" placeholder="Heslo"> 
    </div>
    <div class="form-group">
      <label for="exampleInputPassword2">Heslo pro potvrzeni</label>
      <input type="password" class="form-control" name="hesloPotvrzeni" placeholder="Heslo pro potvrzen�">
    </div>
    <div class="form-group">
      <label for="exampleInputCaptcha">P�t plus �est je:</label>
      <input type="text" class="form-control" name="captcha" placeholder="P�t plus �est">
    </div>
    <button type="submit" class="btn btn-default pull-right">Registrace</button>
  </form>
</div>