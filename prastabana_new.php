<?php require_once("includes/initialize.php"); 
  
if(isset($_POST['submit']))
{
  for($i=0;$i<count($_POST['organization_id']);$i++)
  {
      $data=new Prastabanaadd();
      $data->kharid_id=$_POST['kharid_id'];
      $data->organization_id=$_POST['organization_id'][$i];
      $data->prastabana_entry_date=$_POST['prastabana_entry_date'][$i];
      $data->prastabana_entry_date_english=  DateNepToEng($_POST['prastabana_entry_date'][$i]);
      $data->prastabana_prakar_id=$_POST['prastabana_prakar_id'][$i];
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
                                    <span class="left_margin"> खरिद माग फाराम नं	:-  <input class="myWidth30" type="text" name="kharid_id" id="kharid_add_prastabana"></span>
                                    <br><br>
                                    <table class="table borderless myWidth100 col_3">
                                        <tr>
                                            <th> फर्मको नाम:</th>
                                            <th> प्रस्ताब दाखिला गर्नुपर्ने दिन	: </th>
                                            <th> प्रस्ताबको प्रकार	: </th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <select class="form-control" name="organization_id[]">
                                                       <option value="">छान्नुहोस</option>
                                                       <?php foreach($datas as $data):?>
                                                       <option value="<?php echo $data->id;?>"><?php echo $data->name;?></option>
                                                       <?php endforeach;?>
                                               </select>
                                            </td>
                                            <td>
                                                <input type="text" name="prastabana_entry_date[]" id="nepaliDate3" class="myWidth85"/>
                                            </td>
                                            <td>
                                                <select class="form-control"  name="prastabana_prakar_id[]">
                                                       <option value="">छान्नुहोस</option>
                                                       <?php foreach($prakar_result as $data):?>
                                                       <option value="<?php echo $data->id;?>"><?php echo $data->name;?></option>
                                                       <?php endforeach;?>
                                               </select>
                                            </td>
                                        </tr>
                                    </table>
                                    <table id="add_prastabana" class="table borderless col_3 myWidth100"> </table>
                                </fieldset>
                            </div>
                      
                            
                            
                                <table class="table borderless table-responsive myWidth100">
                                                <tr>
                                                    <td class="myCenter"><div class="add_more_prastabana btn "  >थप्नुहोस</div> </td>
                                                    <td class="myCenter"><div class="remove_more_prastabana btn ">हटाउनु होस</div> </td>
                                                    <td class="myCenter"><input type="submit" name="submit" value=" सेभ गर्नुहोस" class="btn"> </td>
                                                    
                                                    
                                                </tr>
                          </table>
                        </form>
                          
                            
                                          
                        </div>
                  </div>
                </div><!-- main menu ends -->
             
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

