<?php require_once("includes/initialize.php"); 
//    $prastabana_result= Aanyaprastabana::find_by_anya_prastabana_id($_GET['anya_prastabana_id']);
    $org_ids = Aanyaorganization::find_all_org_id($_GET['anya_prastabana_id']);
//    print_r($org_ids);exit;
?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>अन्य प्रस्ताब फाराम पेश गर्ने बारे </title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	
                <div class="maincontent">
                    <h2 class="headinguserprofile">अन्य प्रस्ताब फाराम पेश गर्ने बारे  |  <a href="aanya_prastabana_dashboard.php" class="btn">पछि जानुहोस </a></h2>
                    <div class="OurContentFull">
                    	<h2> अन्य प्रस्ताब फाराम पेश गर्ने बारे </h2>
                        <div class="userprofiletable">
                            
                                        
                                         <table class="table table-bordered myWidth100">
                                             <tr>
                                                 <th>फर्मको नाम: </th>
                                                 <th>फर्मको ठेगाना : </th>
                                                 <th>प्रिन्ट गर्नुहोस</th>
                                             </tr>
                                        <?php foreach($org_ids as $org_id): ?>
                                         <?php $organization =  Enlist::find_by_id($org_id); ?>
                                         
                                         
                                             <tr>
                                                 <td><?=$organization->name?> </td>
                                                 <td><?=$organization->address?></td>
                                                 <td><a href="aanya_prastabana_print_final.php?anya_prastabana_id=<?=$_GET['anya_prastabana_id']?>&org_id=<?=$org_id?>" target="_blank">प्रिन्ट गर्नुहोस </a></td>
                                             </tr>
                                         <?php endforeach; exit;?>
                                        
                                         </table>
                                         
                                    
</div> 
										


                       								

</div>
				</div>
                                         
                                        
                                
                            </div><!-- print page ends -->
                                        
                                        
                                         
                                        
                                              
                                
                        </div>
                  </div>
                </div><!-- main menu ends -->
           
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>


