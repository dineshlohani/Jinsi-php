<?php require_once("includes/initialize.php"); 
			?>
<?php
	
	if(!$session->is_logged_in()){ redirect_to("logout.php");}
	if(isset($_POST['submit']))
	{
		
	}
	if(isset($_POST['submit']))
  {
  	$fiscal = new Fiscalyear();
  	$fiscal->year = $_POST['year'];
  	
  	if(isset($_POST['is_current']))
  	{
  		if($_POST['is_current']==1)
  		{
  			updateIsCurrent();
  			$fiscal->is_current = $_POST['is_current'];
  		}
  		else
  		{
  			$fiscal->is_current = 0;
  		}
  	}
  	$fiscal->save();
  	$session->message("Data Saved Successfully");
  	redirect_to('general.php');
  }

   $fiscals = Fiscalyear::find_all();
  

?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>आर्थिक वर्ष  :: Kanepokhari Gaupalika</title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="">
            <div class="">
                <div class="maincontent">
                    <h2 class="headinguserprofile">आर्थिक वर्ष :: Fiscal Year / Go back to <a href="settings.php">सेटिंग </a></h2>
                    <div class="OurContentLeft">
                   	  <?php include("menuincludes/settingsmenu.php"); ?>
                    </div>
                    <div class="OurContentRight">
                    	<h2>आर्थिक वर्ष  </h2>
                        <div class="userprofiletable">
                        	
                                    	<table class="table table-bordered">
                                          
                                         
                                          <tr>
                                          
                                           
                                              <th>आर्थिक वर्ष</th>
                                              <th>हाल चालु</th>
                                              
                                                 
                                          </tr>
                                        <?php foreach($fiscals as $fiscal): ?>
                                     		       
                                            <tr>
                                              
                                              
                                              
                                              <td><?=convertedcit($fiscal->year)?></td>
                                              <td><?php if($fiscal->is_current==1){echo "हो";}else{echo "होइन";} ?></td>
                                                                                            
                                            </tr>
                                        <?php endforeach; ?>
                                        </table>
                                        <div class="">
                                    <form method="post">
                                      <table class="table table-bordered">
                                         
                                          <tr>
                                            <td>आर्थिक वर्ष </td>
                                            <td><input type="text" name="year"  required></td>
                                          </tr>
                                          
                                          
                                          
                                            <tr>
                                            <td>हाल चालु</td>
                                            <td><input type="checkbox" name="is_current" value="1" required> हो </td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td><input type="submit" name="submit" value="सेभ गर्नुहोस" class="submithere"> </td>
                                          </tr>
                                        </table>

                                    </form>
                           </div>
                        </div>
                         

                        
                  </div>
                </div><!-- main menu ends -->
            </div>
         </div>   
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>