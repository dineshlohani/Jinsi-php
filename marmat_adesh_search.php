<?php require_once("includes/initialize.php"); 
if(isset($_POST['submit']))
{
    redirect_to("marmat_adesh_print.php?adesh_no=".$_POST['adesh_no']);
   
}
if(isset($_POST['cancel']))
{
    redirect_to("marmat_adesh_search.php");
}
    $aadesh_result = Marmatadeshprofile::find_all();
    ?>   <?php include("menuincludes/header.php"); ?>

<title>मर्मत आदेश खोज्नुहोस :: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="">
            <div class="">
                <div class="maincontent">
                    <h2 class="headinguserprofile">मर्मत आदेश खोज्नुहोस <a href="dashboard_marmat_adesh.php" class="btn">पछी जानुहोस </a></h2>
                    
                    <div class="OurContentFull">
                    
                        <div class="userprofiletable">
                            <form method="post" >
                        	<table class="table search_table">
                                          <tr>
                                              <td> <b> मर्मत आदेश फारम खोज्नुहोस: </b> <input class="fill_height" type="text" required name="adesh_no" placeholder="आदेश नं हाल्नुहोस" />  <input name="submit" type="submit" value="खोज्नुहोस" class="btn search_btn"/>&nbsp;&nbsp;&nbsp;<input name="cancel" type="submit" value="रद्ध गर्नुहोस " class="btn search_btn"/></td>
                                          </tr>
                                </table>
                            </form>                          
                <?php if(!isset($_POST['submit'])){?>
                            <table class="table table-bordered tr1">
                                     <tr>
                                         <th>आदेश  नं </th>
                                         <th>निवेदकको नाम </th>
                                         <th> # </th>
<!--                                         <th>प्रिन्ट गर्नुहोस</th>-->
                                    </tr>
                                    <?php foreach($aadesh_result as $data):
                                        $name=get_name_by_type_and_enlist_id($data->type,$data->enlist_id)?>
                                    <tr>
                                        <td><?=convertedcit($data->adesh_no)?></td>
                                        <td><?=$name?></td>
                                        <td><div class=""><a class="btn" href="marmat_adesh_print.php?adesh_no=<?=$data->adesh_no?>"> पुरा विवरण हेर्नुहोस </a>&nbsp;&nbsp; <a href="marmat_adesh_edit.php?adesh_id=<?=$data->adesh_no?>" class="btn">सच्याउनुहोस</a></div></td>
                                    </tr
                                    <?php endforeach;?>
                            </table>  
        <?php } ?>
                           <?php if(isset($_POST['submit'])):?>
                             <table class="table table-bordered ">
                                     <tr>
                                         <th>आदेश  नं </th>
                                         <th>आदेश लिनेको नाम </th>
                                         <th>सामानको नाम </th>
                                         <th>प्रिन्ट गर्नुहोस</th>
                                    </tr>
                                   
                                    <tr>
                                        <td><?=convertedcit($result[0]->adesh_no)?></td>
                                        <td><?=$result[0]->name?></td>
                                        <td><?=$result[0]->material_name?></td> 
                                        <td><div class="myPrint"><a href="marmat_adesh_print.php?adesh_no=<?=$result[0]->adesh_no?>" target="_blank">प्रिन्ट गर्नुहोस</a></div></td>
                                    </tr>
                                   
                            </table>  
                               <?php endif;?>
										
										<div class="myspacer"></div>
									</div>
                                
                            </div><!-- print page ends -->
                                        
                                        
                                         
                                        
                                              
                                
                        </div>
                  </div>
                </div><!-- main menu ends -->
            </div>
         </div>   
    </div><!-- top wrap ends -->
  

