<?php require_once("includes/initialize.php"); 
  error_reporting(0);
if(isset($_POST['submit']))
{
    // print_r($_POST);exit;
  for($i=0;$i<count($_POST['organization_id']);$i++)
  {
      $data=new Prastabanaadd();
      $data->kharid_id=$_POST['kharid_id'];
      $data->organization_id=$_POST['organization_id'][$i];
      $data->prastabana_entry_date= $_POST['prastabana_entry_date'];
      $data->prastabana_entry_date_english=DateNepToEng($_POST['prastabana_entry_date_english']);
      $data->prastabana_prakar_id=$_POST['prastabana_prakar_id'];
      $data->save();
      
  }
     echo alertBox("थप सफल","prastabana_print.php?kharid_id=".$_POST['kharid_id']);
}

$datas= Enlist::find_all();
$prakar_result=  Prastabanaprakaradd::find_all();
?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title> प्रस्ताब माग फाराम भर्नुहोस</title>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	
                <div class="maincontent">
                    <h2 class="headinguserprofile"> प्रस्ताब माग फाराम भर्नुहोस | <a href="index.php" class="btn">पछि जानुहोस </a> </h2>
                    <div class="OurContentFull">
                    	<h2> प्रस्ताब माग फाराम भर्नुहोस		</h2>
                        <div class="userprofiletable">
                            
                            <form method="post">
                            <div class="our_content">
                                <fieldset>
                                    <legend><b> प्रस्ताब माग फाराम </b></legend>
                                    <table class="table borderless" style="width: 50%;">
                                        <tr>
                                            <th> खरिद माग फाराम नं	:- </th>
                                            <th>  <?=convertedcit($data->kharid_id);?></th>
                                        </tr>
                                        <tr>
                                            <th> प्रस्ताब दाखिला गर्नुपर्ने दिन	:-  </th>
                                            <th> <input style="width:100%" class="fill_height form-control" type="text" name="prastabana_entry_date" id="prastabana_entry_date"> </th>
                                        </tr>
                                         <tr>
                                            <th> मिती :-  </th>
                                            <th> <input style="width:100%" class="fill_height form-control" id="nepaliDate10" type="text" name="prastabana_entry_date_english" id="prastabana_entry_date"> </th>
                                        </tr>
                                        <tr>
                                            <th>  प्रस्ताबको प्रकार	:-  </th>
                                            <th> <select class="fill_height form-control"  name="prastabana_prakar_id" required>
                                                       <option value="">छान्नुहोस</option>
                                                       <?php foreach($prakar_result as $data):?>
                                                       <option value="<?php echo $data->id;?>"><?php echo $data->name;?></option>
                                                       <?php endforeach;?>
                                               </select></th>
                                        </tr>
                                        <tr>
                                            <th>  फर्मको नाम: </th>
                                            <th> <select class="form-control" name="organization_id[]" required>
                                                       <option value="">छान्नुहोस</option>
                                                       <?php foreach($datas as $data):?>
                                                       <option value="<?php echo $data->id;?>"><?php echo $data->name;?></option>
                                                       <?php endforeach;?>
                                               </select></th>
                                        </tr>
                                        <tr>
                                            <th> </th>
                                            <th id="add_prastabana" > </th>
                                        </tr>
                        
                                    </table>
                                    <br>
                                 
                                    <br><br>
                                 
                                    <!--<table id="add_prastabana" class="table borderless col_3 myWidth100"> </table>-->
                                    
                                     <table class="table borderless table-responsive myWidth100">
                                                <tr>
                                                    <td class="myCenter"><div class="add_more_prastabana btn "  >थप्नुहोस</div> </td>
                                                    <td class="myCenter"><div class="remove_more_prastabana btn ">हटाउनु होस</div> </td>
                                                    <td class="myCenter"><input type="submit" name="submit" value=" सेभ गर्नुहोस" class="btn"> </td>
                                                    
                                                    
                                                </tr>
                          </table>
                                </fieldset>
                            </div>
                      
                            
                            
                               
                        </form>
                          
                            
                                          
                        </div>
                  </div>
                </div><!-- main menu ends -->
             
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

