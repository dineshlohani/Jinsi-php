<?php require_once("includes/initialize.php"); 
	?>
  <?php
  
  
if(isset($_POST['submit']))
{
	$data = new Orderform();
	if($data->savePostData($_POST)){
        $session->message("खरिद माग फाराम थप सफल");    
        redirect_to("order_form_view.php");
        
        }
	
	
        
        
}

?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>खरिद माग फाराम भर्नुहोस :: Kanepokhari Gaupalika</title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="">
            <div class="">
                <div class="maincontent">
                    <h2 class="headinguserprofile">खरिद माग फाराम हेर्नुहोस / <a href="order_form_view.php">हेर्नुहोस</a> </h2>
                    <div class="OurContentLeft">
                   	  <?php include("menuincludes/settingsmenu.php"); ?>
                    </div>
                    <div class="OurContentRight">
                    	<h2>खरिद माग फाराम भर्नुहोस </h2>
                        <div class="userprofiletable">
                        	<form method="POST" enctype="multipart/form-data">
                                    	<table class="table table-bordered">
                                        <tr>
                                            <td>खरिद माग फाराम नं: <input type="text" name="sn"> </td>
                                            <td>आर्थिक वर्ष: 
                                                <select>
                                                    <option>--छान्नुहोस--</option>
                                                    <?php foreach ($fiscal as $data): ?>
                                                    <option value="<?= $data->id  ?>"> ><?= $data->year;  ?></option> 
                                                    <?php endforeach; ?>
                                                </select>
                                            
                                            </td>
                                          </tr> 
                                           <tr>
                                            <td></td>
                                            <td><input type="text" id="topictype_name" name="sn" required></td>
                                          </tr> 
                                         <tr>
                                            <td>बजेट शिर्षकको नाम</td>
                                            <td><input type="text" id="topictype_name" name="name" required></td>
                                          </tr>
                                           <tr>
                                           
                                            <td>&nbsp;</td>
                                            <td><input type="submit" name="submit" value="सेभ गर्नुहोस" class="submithere"></td>
                                          </tr>
                                        </table>

                                    </form>
                                    

                        </div>
                  </div>
                </div><!-- main menu ends -->
            </div>
         </div>   
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

