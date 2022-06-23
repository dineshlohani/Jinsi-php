<?php require_once("includes/initialize.php"); 
  $adesh_id = '';
  $id= $_GET['id'];
  if(!isset($_GET['id']))
  {
      die("दाखिला हेर्ने page बाट मात्र सच्याउनु होस् |");
  }
  else
  {
  $dr = Dakhilaprofile::find_by_id($id);
  $adesh_id= $dr->adesh_id;
  $dr_items = DakhilaItemDetails::find_by_dakhila_id($dr->id);
  }
  
  if(isset($_POST['submit']))
  {
     //echo "<pre>"; print_r($_POST); echo "</pre>"; exit;
     $dakhila_profile                   = Dakhilaprofile::find_by_id($_POST['update_id']);
     $dakhila_profile->date_nepali      = $_POST['date_nepali'];
     $dakhila_profile->date_english     = DateNepToEng($_POST['date_nepali']);
     if($dakhila_profile->save())
     {
         echo alertBox("सच्याउन सफल","dakhila_search.php");
     }
   
    
  }
 

?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>दाखिला रिर्पोट भर्नुहोस :: <?php echo SITE_SUBHEADING;?></title>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="">
            <div class="">
                <div class="maincontent">
                    <h2 class="headinguserprofile">दाखिला रिर्पोट सच्याउनु होस्  / <a href="dashboard_dakhila.php" class="btn">दाखिला रिर्पोटमा जानुहोस  </a> </h2>
                    
                    <div class="OurContentFull">
                    	<h2>दाखिला रिर्पोट भर्नुहोस</h2>
                        <div class="userprofiletable">
                        	<form method="POST" enctype="multipart/form-data">
                                   <div class="inputWrap">
                                    
                                      
                                       <div class="our_content">
                                                <fieldset>
                                              
                                             <b> खरिद आदेश नं: </b>
                                             <input class="fill_height myWidth72" type="text" name="adesh_id" placeholder="" required value="<?=$adesh_id?>" id="adesh_id_input" readonly="true" /><br><br>
                                            <b> मिति : </b><br>
                                            <input class="fill_height myWidth100" type="text" value="<?= $dr->date_nepali ?>" required name="date_nepali" id="nepaliDate3"/><br>
                                            <br>
                                          <input class="btn"  type="submit" name="submit" value="मिती सच्याउनु होस्">
                                            </fieldset>
                                            </div>
                                          </div>
                                    <br>
                                   
                                    <input type="hidden" name="update_id" value="<?= $id ?>">              
                                </form>
                        </div>
                  </div>
                </div><!-- main menu ends -->
            </div>
         </div>   
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

