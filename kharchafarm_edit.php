<?php require_once("includes/initialize.php"); 
if(!$session->is_logged_in())
{
	redirect_to("logout.php");
}
 
  	
if(isset($_POST['submit']))
{
//echo "<pre>"; print_r($_POST); echo "</pre>"; exit;
    
	$data=Kharcha_mag_faram1::find_by_id($_GET['maag_id']);
         $data->maag_date 		= $_POST['maag_date'];
        $data->maag_date_english 	=  DateNepToEng($_POST['maag_date']);
	$data->save();
      echo alertBox("सच्याउन सफल","kharchafarm_search.php");
            
}
  $item_type = Itemtype::find_all();
  $deps = Department::find_all();
  $fiscals = FiscalYear::find_all();
  $result =  Kharcha_mag_faram1::find_by_id($_GET['maag_id']);
  ?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>खर्च माग फारम :: <?php echo SITE_SUBHEADING;?></title>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="">
            <div class="">
                <div class="maincontent">
                    <h2 class="headinguserprofile">खर्च माग फारम </h2>
                   
                    <div class="OurContentFull">
                        <h2>नया खर्च माग फारम सच्याउनुहोस <a href="kharchafarm_search.php" class="btn">पछि जानुहोस</a> </h2>
                        <?php echo $message; ?>
                        <div class="userprofiletables">
                        	<form method="POST" enctype="multipart/form-data">
                                       <div class="our_content inputWrap">
                                           <fieldset>
                                               <legend> खर्च माग फारम नं : <?php echo $_GET['maag_id']; ?>  </legend>
                                               
                                                

                                                    <div class="titleInput"><b> मिति : </b> </div>
                                                    <input class="date_check fill_height myWidth100"  type="text" name="maag_date" value="<?=$result->maag_date?>" id="nepaliDate5"  />
                                               
                                           </fieldset>
                                       </div>
                                     
                                        <table class="table borderless table-responsive">
                                                <tr>
<!--                                                    <td class="myCenter"><div class="add_more btn ">थप्नुहोस</div> </td>
                                                    <td class="myCenter"> <div class="remove_more btn">हटाउनुहोस</div></td>-->
                                                    <td class="myCenter"><input type="submit" name="submit" class="submithere btn" value="सेभ गर्नुहोस"/></td>
                                                </tr>
                                           </table>
                                              <input type="hidden"  value="kharcha" id="forurl" />
                                </form>
                        </div>
                  </div>
                </div><!-- main menu ends -->
            </div>
         </div>   
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

