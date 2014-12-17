<div class="jumbotron">
  <div class="container">  
    <div id="collapseCategory" class="panel-collapse collapse in">
      <div class="panel-body">
        <?php
        global $page;
        global $id;
        global $predmet;
        global $prispevek_get;
        global $aktivni;
        $aktivni = "";
        $action = "index.php?pg=".$page."&action=pridejprispevek_go&id=".$id;
        echo "<form class='form-horizontal' role='form' method='POST' action='$action'>";
        
        if($id > 0){
          $predmet = "RE: ".$id;
          $aktivni = "readOnly";
        }
        ?>
          <div class="form-group">
            <label for="inputPredmet" class="col-sm-2 control-label">Pøedmìt</label>
              <div class="col-sm-10">
                <input name="predmet" value="<?php echo $predmet ?>" <?php echo $aktivni ?> type="text" class="form-control" id="inputPredmet" placeholder="Pøedmìt">
              </div>
            </div>
          <div class="form-group">
            <label for="inputPrispevek" class="col-sm-2 control-label">Pøíspìvek</label>
              <div class="col-sm-10">
                <textarea name="prispevek" value="<?php echo $prispevek_get ?>" class="form-control" rows="3" placeholder="Text"></textarea>
              </div>
            </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default pull-right">Odeslat</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <a data-toggle="collapse" class="accordion-toggle" data-parent="#accordion" href="#collapseCategory">
      <h4 class="panel-title black-center">
        <span class="glyphicon glyphicon-chevron-up mezera"></span><span class="glyphicon glyphicon-chevron-up mezera"></span><span class="glyphicon glyphicon-chevron-up"></span>
      </h4>
    </a>  
  </div>
</div>