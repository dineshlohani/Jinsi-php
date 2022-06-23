<?php require_once("includes/initialize.php"); 
if(!$session->is_logged_in())
{
	redirect_to("logout.php");
}
$user        = getUser();
$id= $_GET['id'];
$a=0;
$ledger_details  = Bhadadetailstaken::find_by_id($id);
$ledger= Bhada::find_by_id($ledger_details->bhada_id);
$sql_return    = "select * from bhada_return_history_taken where item_id ={$ledger_details->item_id} and category={$ledger_details->category} and rate={$ledger_details->item_rate} and bhada_id={$ledger_details->bhada_id}";
$return_result = Bhadareturnhistorytaken::find_by_sql($sql_return);
$item= Notspentitem::find_by_id($ledger_details->item_id);
if(isset($_GET['enlist_id']) && isset($_GET['type']))
{
	                              
}
 
  $item_type = Itemtype::find_all();
  $deps = Department::find_all();
  $staff_result = Workers::find_all();
  $fiscals = FiscalYear::find_all();
  $current_id = Fiscalyear::find_current_id();
  $fiscal_current= Fiscalyear::find_by_id($current_id);
  ?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>खरिद माग फारम </title>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="">
            <div class="">
                <div class="maincontent">
                    <h2 class="headinguserprofile">भाडामा लिईएको समान फिर्ता हटाउनुहोस्  | <a href="index.php" class="btn">पछि जानुहोस</a> </h2>
                    
                    <div class="OurContenFull">
                    	
                        <div class="userprofiletables">
                                	
                                        <div class="printPage">
                                            <table class="table table-hover table-bordered">
                                                <tr>
                                                    <th colspan="4" class="mycenter">सामानको नाम: <?= $item->name ?></th>
                                                </tr>
                                            <tr>
                                                  <td class="myBold myCenter">स्टोरमा सामान फिर्ताको अबस्था</td>
                                                  <td class="myBold ">परिमाण</td>
                                                  <td class="myBold ">सामान फिर्ता मिति</td>
                                                  <td class="myBold mycenter">हटाउनु</td>
                                                
                                            </tr>
                                   <?php foreach($return_result as $return): 
                                        $item_condition= Itemcondition::find_by_id($return->item_condition_id);
                                       ?>
                                             <tr>
                                               <td class=" myCenter"><?= $item_condition->name ?></td>
                                                <td class="myCenter"><?= $return->qty ?></td>
                                                <td class="myCenter"><?= convertedcit(DateEngToNep($return->return_date)) ?></td>
                                                <td class="mycenter"><a class="btn" href="bhada_return_delete_taken.php?id=<?= $return->id ?>&detail_id=<?= $ledger_details->id ?>">हटाउनुहोस् </a></td>
                                                
                                            </tr>
                                    <?php endforeach; ?>  
                                        </table>
                    
                                    
                        </div> 
                        <br><br><br>
                        <div>
                           
                        </div>
                        </div>
                  </div>
                </div><!-- main menu ends -->
            </div>
         </div>   
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>


