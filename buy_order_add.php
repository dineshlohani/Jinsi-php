<?php require_once("includes/initialize.php"); 
	?>
  <?php
  
  
if(isset($_POST['submit']))
{
	$data = new Enlist();
	if($data->savePostData($_POST)){
        $session->message(" थप सफल");    
        redirect_to("settings_enlist_view.php");
        
        }
	
	
        
        
}

?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>सुची दर्ता थप्नुहोस :: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="">
            <div class="">
                <div class="maincontent">
                    <h2 class="headinguserprofile">सुची दर्ता हेर्नुहोस / <a href="settings_enlist_view.php">हेर्नुहोस</a> </h2>
                    <div class="OurContentLeft">
                   	  <?php include("menuincludes/settingsmenu.php"); ?>
                    </div>
                    <div class="OurContentRight">
                    	<h2>खरिद आदेश भर्नुहोस </h2>
                        <div class="userprofiletable">
                        	<form method="POST" enctype="multipart/form-data">
                                    	<table width="200" border="2">
                                                <tr>
                                                  <td rowspan="2">सामानको नाम</td>
                                                  <td rowspan="2">बजेट शिर्षक नं</td>
                                                  <td rowspan="2">स्पेशिफिकेशन</td>
                                                  <td rowspan="2">सामानको परिमाण</td>
                                                  <td rowspan="2">इकाई</td>
                                                  <td colspan="2">मूल्य</td>
                                                </tr>
                                                <tr>
                                                  <td>प्रति इकाइ दर रु</td>
                                                  <td>जम्मा रु</td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="item_id"/></td>
                                                  <td><input type="text" name="budget_title_no"/></td>
                                                  <td><input type="text" name="specification"/></td>
                                                  <td><input type="text" name="item_value"/></td>
                                                  <td><input type="text" name="item_unit"/></td>
                                                  <td><input type="text" name="item_per_unit_price"/></td>
                                                  <td><input type="text" name="item_total_price"/></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="submit" name="submit" value="सेभ गर्नुहोस"/>
                                                    </td>
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

