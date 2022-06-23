<?php require_once("includes/initialize.php"); 
if(!$session->is_logged_in())
{
	redirect_to("logout.php");
}
$user        = getUser();
$rashid_type= Rashidtype::find_all();

 

 ?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>खरिद माग फारम </title>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="">
            <div class="">
                <div class="maincontent">
                    <h2 class="headinguserprofile"> रशिद्को किसिम मार्फत जिन्सी नियन्त्रण खाता हेर्नुहोस | <a href="bill_control_dashboard.php" class="btn">पछि जानुहोस</a> </h2>
                    
                    <div class="OurContenFull">
                    	
                        <div class="userprofiletables">
                    
                            <table class="table table-bordered td1">
                                <tr>
                                    <th>सि.नं</th> 
                                    <th>रशिदको किसिम</th>
                                    <th>रशिद नियन्त्रण खाता</th>
                                 
                                </tr>
                                <?php $i=1; foreach ($rashid_type as $data): 
                                    ?>
                                <tr>
                                    <td><?= convertedcit($i) ?></td>
                                    <td><?= $data->name ?></td>
                                    <td> <a class="btn" href="bill_control_view.php?id=<?= $data->id ?>">विवरण हेर्नुहोस </a></td>
                                </tr>
                               <?php $i++; endforeach; ?>
                            </table>
                            
                      
                            
                            
                            
         
                                    
                               
                        </div>
                  </div>
                </div><!-- main menu ends -->
            </div>
         </div>   
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>



