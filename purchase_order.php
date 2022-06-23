<?php require_once("includes/initialize.php"); 
  
if(isset($_GET['submit']))
{
    $sql="select * from kharid_mag_faram_2 where maag_id='".$_GET['maag_id']."'";
    $results=  Kharid_mag_faram2::find_by_sql($sql);
    
//    print_r($result);exit;
}
$datas= Enlist::find_all();
?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>खरिद आदेश भर्नुहोस :: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="">
            <div class="">
                <div class="maincontent">
                    <h2 class="headinguserprofile">खरिद आदेश भर्नुहोस/ <a href="settings_enlist_view.php">हेर्नुहोस</a> </h2>
                    <div class="OurContentLeft">
                   	  <?php include("menuincludes/settingsmenu.php"); ?>
                    </div>
                    <div class="OurContentRight">
                    	<h2>खरिद आदेश भर्नुहोस</h2>
                        <div class="userprofiletable">
                            <form method="get">
                                <table class="table table-bordered table-responsive">
                                     <tr>
                                         <td>खरिद आदेश नं:</td>
                                         <td><input type="text" name="maag_id" id="maag_id" class="myWidth100input"/></td>
                                         <td><input type="submit" name="submit" value="खोज्नुहोस" class="btn"/></td>
                                     </tr>
                                </table>
                                
                            </form>
                             <?php if(isset($_GET['submit'])):
                                                ?>
                            <form method="post" enctype="multipart/form-data" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
                                   <table class="table table-bordered table-responsive">
                                     <tr>
                                      <td>खरिद आदेश नं. </td>
                                      <td><input type="text" name="kharid_aadesh_id" id="kharid_aadesh_id"/></td>
                                    </tr>
                                    <tr>  
                                        <td colspan="2" >मिति</td>
                                        <td class=""><input  type="text" name="purchase_date" value="<?=generateCurrDate();?>" id="nepaliDate9"/></td>
                                    </tr>
                                    <tr >
                                      <td colspan="2" >खरिद माग फाराम नं</td>
                                      <td colspan="2"><input type="text" name="maag_id" id="maag_id" value="<?php echo $_GET['maag_id'];?>"/></td>
                                      
                                    </tr>
                                   </table>
                                <table class="table table-bordered table-responsive">
                                        <tr >
                                          <td rowspan="3">सामानको नाम</td>
                                          <td rowspan="3">बजेट शिर्षक नं</td>
                                          <td rowspan="3">स्पेशिफिकेशन</td>
                                          <td rowspan="3">सामानको परिमाण</td>
                                          <td rowspan="3">इकाइ </td>
                                          <td colspan="2">मूल्य</td>
                                        </tr>
                                        <tr >
                                          <td  rowspan="2">प्रति इकाइ दर रु</td>
                                          <td  rowspan="2">जम्मा  रु</td>
                                        </tr>
                                        <tr >
                                          <td ></td>
                                        </tr>
                                           <?php foreach($results as $result):
                                               if($result->saman_prakar==1)
                                               {    
                                                   $data =  Spentitem::find_by_id($result->name);
                                               }
                                               else
                                               {
                                                   $data=Notspentitem::find_by_id($result->name);
                                               }
                                               
                                         
                                                   ?>
                                       
                                        <tr >
                                            <td ><input type="text" name="item_name" id="item_name" value="<?php echo $data->name;?>"/></td>
                                          <td><input type="text" name="budget_id" id="budget_id" value="<?php echo $data->budget_title_id;?>"/></td>
                                          <td><input type="text" name="specification" id="specification" value="<?php echo $data->specification;?>"/></td>
                                          <td ><input type="text" name="qty" class="qty" value="<?php echo $result->qty;?>"/></td>
                                          <td ><input type="text" name="unit" id="unit" value="<?php echo Unit::getName($data->unit_id);?>"/></td>
                                          <td ><input type="text" name="per_unit_price" class="per_unit_price"/></td>
                                          <td><input type="text" name="total" class="total"/></td>
                                        </tr>
                                        <?php endforeach;?>
                                        <tr >
                                          <td colspan="5" >फर्मको नाम</td>
                                          <td colspan="3">
                                              <select name="organization_id">
                                                  <option value="">छान्नुहोस</option>
                                                  <?php foreach($datas as $data):?>
                                                  <option value="<?php echo $data->id;?>"><?php echo $data->name;?></option>
                                                  <?php endforeach;?>
                                              </select>
                                          </td>
                                          
                                        </tr>
                                        <tr >
                                          <td colspan="5" >सामान दाखिला गर्नुपर्ने मिति</td>
                                          <td colspan="3" class="myButton1"><input  type="text" name="purchase_date" value="<?=generateCurrDate();?>" id="nepaliDate5"/></td>
                                          
                                        </tr>
                                  </table>
     </form>
                            <?php endif;?>
                                          
                        </div>
                  </div>
                </div><!-- main menu ends -->
            </div>
         </div>   
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

