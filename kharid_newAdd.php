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
                    <h2 class="headinguserprofile">खरिद आदेश भर्नुहोस / <a href="dashboard_kharid.php">खरिद आदेशमा जानु होस् </a> </h2>
                   
                    <div class="OurContentFull">
                    	<h2>खरिद आदेश भर्नुहोस</h2>
                        <div class="userprofiletable">
                            
                            
                                   <table class="table table-bordered table-responsive">
                                     <tr>
                                      <td>खरिद आदेश नं. </td>
                                      <td><input type="text" name="kharid_aadesh_id" id="kharid_aadesh_id"/></td>
                                      <td >मिति</td>
                                        <td class="myButton1"><input  type="text" name="purchase_date" value="<?=generateCurrDate();?>" id="nepaliDate9"/></td>
                                    </tr>
                                    
                                    <tr >
                                      <td colspan="2" >खरिद माग फाराम नं</td>
                                      <td colspan="2"><input type="text" name="maag_id" id="maag_id" value="<?php echo $_GET['maag_id'];?>"/></td>
                                      
                                    </tr>
                                   </table>
                                   <table class="table table-bordered">
                                   	    <tr>
                                        	<th rowspan="2">क्र.स.</th>
                                            <th rowspan="2" >सामानको नाम</th>
                                            <th rowspan="2" >बजेट शिर्षक नं</th>
                                            <th rowspan="2" >स्पेशिफिकेशन</th>
                                            <th rowspan="2" >सामानको परिमाण</th>
                                            <th rowspan="2" >इकाई</th>
                                            <th colspan="2">मूल्य</th>
                                        </tr>
                                   	    <tr>
                                   	      <th >प्रति इकाइ दर रु</th>
                                          <th >जम्मा रु</th>
                           	         </tr>
                                   	    <tr>
                                   	      <th>&nbsp;</th>
                                   	      <th ></th>
                                   	      <th ></th>
                                   	      <th ></th>
                                   	      <th ></th>
                                   	      <th ></th>
                                   	      <th ></th>
                                   	      <th ></th>
                           	         </tr>
                                   </table>
                                   <table class="table table-borderless">
                                   	<tr>
                                    	<td>फर्मको नाम : 
                                    	  <select name="organization_id2">
                                            <option value="">छान्नुहोस</option>
                                            <?php foreach($datas as $data):?>
                                            <option value="<?php echo $data->id;?>"><?php echo $data->name;?></option>
                                            <?php endforeach;?>
                                          </select></td>
                                        <td class="myButton1">सामान दाखिला गर्नुपर्ने मिति : <input  type="text" name="nepaliDate" value="<?=generateCurrDate();?>" id="nepaliDate"/>
                                        </td>
                                    </tr>
                                   </table>
                                   <table class="table table-bordered table-responsive">
                                                <tr>
                                                    <td class="myCenter"><div class="add_more btn ">सेभ गर्नुहोस</div> </td>
                                                    <td class="myCenter"> <div class="remove_more btn">प्रिन्ट गर्नुहोस</div></td>
                                                    
                                                </tr>
                                           </table>
                                   
                          
                            
                                          
                        </div>
                  </div>
                </div><!-- main menu ends -->
            </div>
         </div>   
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

