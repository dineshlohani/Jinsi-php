<?php require_once("includes/initialize.php"); 
if(!$session->is_logged_in()){redirect_to('logout.php');}
$current_fiscal= Fiscalyear::find_current_id();
$land_owner = Landownerdetails::find_all();
?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>घरजग्गा अभिलेख खाता भर्नुहोस</title>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="">
            <div class="">
                <div class="maincontent">
                    <h2 class="headinguserprofile">घरजग्गा अभिलेख खाता हेर्नुहोस | <a href="dashboard_gharjagga.php" class="btn">पछि जानुहोस </a> </h2>
                    <div class="OurContentFull">
                    	<h2>घरजग्गा अभिलेख खाता भर्नुहोस</h2>
                        <div class="userprofiletable">
                            
                          
                         <table  class="table table-bordered table-hover table-responsive">
                             <tr>
                                 <th class="mycenter">सि.न.</th>
                                 <th class="mycenter">जग्गाधनीको नाम</th>
                                 <th class="mycenter">ठेगाना</th>
                                 <th class="mycenter">&nbsp;</th>
                                 
                             </tr>
                             <?php $i=1; foreach($land_owner as $data): ?>
                             <tr>
                                  <td class="mycenter"><?= convertedcit($i) ?></td>
                                 <td class="mycenter"><?= $data->name ?></td>
                                 <td class="mycenter"><?= $data->address ?></td>
                                 <td class="mycenter"><a class="btn" href="gharjagga_details_view.php?id=<?= $data->id ?>">विवरण हेर्नुहोस</a> <a class="btn" onclick="return confirm('के तपाई निश्चित हुनुन्छ ?');" href="gharjagga_delete.php?id=<?= $data->id ?>">हटाउनु होस्</a></td>
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

