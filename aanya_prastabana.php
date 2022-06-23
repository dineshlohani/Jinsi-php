<?php require_once("includes/initialize.php"); 
  
if(isset($_POST['submit']))
{
  $datas = new Aanyaprastabana();
  $datas->anya_prastabana_id=$_POST['anya_prastabana_id'];
  $datas->anya_prastabana_entry_date=$_POST['anya_prastabana_entry_date'];
  $datas->prastabana_prakar_id = $_POST['prastabana_prakar_id'];
  $datas->miti = $_POST['miti'];
  $datas->miti_english = DateNepToEng($_POST['miti']);
  if($datas->save())
  {
        for($i=0;$i<count($_POST['organization_id']);$i++)
            {
                $data=new Aanyaorganization();
                $data->aanya_prastabana_id=$_POST['anya_prastabana_id'];
                $data->organization_id=$_POST['organization_id'][$i];
                $data->save();
            }
        for($i=0;$i<count($_POST['anya_prastabana_reason']);$i++)
            {
                $dataa=new Aanyareason();
                $dataa->aanya_prastabana_id=$_POST['anya_prastabana_id'];
                $dataa->aanya_prastabana_reason=$_POST['anya_prastabana_reason'][$i];
                $dataa->save();
            }    
  }
  
  
      echo alertBox("थप सफल","aanya_prastabana_print.php?anya_prastabana_id=".$_POST['anya_prastabana_id']);
}
$datas= Enlist::find_all();
$prakar_result=  Prastabanaprakaradd::find_all();
$aanya_result = Aanyaprastabana::get_max_anya_prastabana_id();
$aanya_prastabana_id= $aanya_result + 1;
//$prakar_result=  Prastabanaprakaradd::find_all();
?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title> अन्य प्रस्ताब माग फाराम भर्नुहोस</title>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	
                <div class="maincontent">
                    <h2 class="headinguserprofile">अन्य प्रस्ताब माग फाराम भर्नुहोस | <a href="aanya_prastabana_dashboard.php" class="btn">पछि जानुहोस </a> </h2>
                    <div class="OurContentFull">
                    	<h2> अन्य प्रस्ताब माग फाराम भर्नुहोस		</h2>
                        <div class="userprofiletables">
                            
                            <form method="post">
                          <table class="table borderless table-responsive myWidth100">
                              <tr>
                                  <th class="myWidth50">प्रस्ताबना माग फाराम नं	:</th>
                                  <td colspan="2"><input class="form-control fill_height" type="text" name="anya_prastabana_id" value="<?=$aanya_prastabana_id?>"></td>
                             
                              </tr>
                               <tr>
                                   <th class="myWidth50">प्रस्ताबको प्रकार	:</th>
                                   <td>
                                        <select class="form-control fill_height" name="prastabana_prakar_id">
                                           <option value="">छान्नुहोस</option>
                                           <?php foreach($prakar_result as $data):?>
                                           <option value="<?php echo $data->id;?>"><?php echo $data->name;?></option>
                                           <?php endforeach;?>
                                   </select>
                                </td>
                              </tr>
                              <tr>
                                   <th class="myWidth50">प्रस्ताब पेस गरेको मिती :</th>
                                   <td><input class="form-control fill_height" type="text" name="miti" id="nepaliDate3" /></td>
                              </tr>
                              <tr>
                                   <th class="myWidth50">प्रस्ताब पेस गर्नुपर्ने दिन	:</th>
                                   <td><input class="form-control fill_height" type="text" name="anya_prastabana_entry_date" /></td>
                              </tr>
                            <tr>
                            	
                                <th class="myWidth50">फर्मको नाम:</th>
                                <td><select class="form-control fill_height" name="organization_id[]">
                                           <option value="">छान्नुहोस</option>
                                           <?php foreach($datas as $data):?>
                                           <option value="<?php echo $data->id;?>"><?php echo $data->name;?></option>
                                           <?php endforeach;?>
                                   </select> </td>
                            </tr>  
                             <tbody class="borderless" id="add_aanya_organization">

                             </tbody>
                             <tr>
                               <td> &nbsp; </td>
                                <td><div class="add_more_aanya_organization btn "  >थप्नुहोस</div> 
                                <div class="remove_more_aanya_organization btn ">हटाउनु होस</div></td>
                              </tr>
                              <tr>
                                   <th class="myWidth50">प्रस्तावको ब्यवोरा</th>
                                   <td> <textarea class="form-control" id="editor10" name="anya_prastabana_reason[]"></textarea>  </td>
                              </tr>
                             
                                <tbody id="aanya_prastabana_reason"> </tbody>
                                 <tr>
                                <td> &nbsp; </td>
                                <td>
<!--                                    <div class="add_more_aanya_reason btn "  >थप्नुहोस</div> 
                                    <div class="remove_more_aanya_reason btn ">हटाउनु होस</div>-->
                                </td>
                              </tr>
                               
                             
                          </table>
                               <table class="table borderless table-responsive myWidth100">
                                                <tr>
                                                    
                                                    <td class="myCenter"><input type="submit" name="submit" value=" सेभ गर्नुहोस" class="btn"> </td>
                                                    
                                                    
                                                </tr>
                          </table>
                        </form>
                          
                            
                                          
                        </div>
                  </div>
                </div><!-- main menu ends -->
             
    </div><!-- top wrap ends -->
    <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                 CKEDITOR.replace( 'editor10');
 </script>
    <?php include("menuincludes/footer.php"); ?>

