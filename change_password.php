<?php
include_once "conn.php";
include_once "header.php";



?><div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default" style="margin-top:25%">
                <div class="panel-heading ">
                
                </div>
                <div class="panel-body login">
            
            <?php
			if ( isset($errMSG) ) {
				
				?>
				<div class="form-group">
            	<div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
				 <?php echo $errMSG; ?>
                </div>
            	</div>
                <?php
			}
			?>
            
            <div class="form-group">
            	
               
            	<input type="password" name="newpwd" class="form-control" placeholder="New Password" maxlength="50"  />
             
                <span class="text-danger"><?php echo $nameError; ?></span>
            </div>
            
            <div class="form-group">
            
               <input type="password" name="rnewpwd" class="form-control" placeholder="Retype New Password" maxlength="40"/>
              
                <span class="text-danger"><?php echo $passError; ?></span>
            </div>
            
            <div class="form-group">
            	<button type="submit" class="btn btn-block btn-primary newbtn" name="btn-signup">Change Password</button>
            </div>
            
            
        
        </div>
   
    </form>
    </div>	

</div>
