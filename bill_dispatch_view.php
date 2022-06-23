<?php require_once("includes/initialize.php"); 
if(!$session->is_logged_in())
{
	redirect_to("logout.php");
}
$user        = getUser();
$sql= "select * from bill_dispatch group by khata_id asc";
$dispatch = BillDispatch::find_by_sql($sql);
//print_r($dispatch);
$dispatch_result='';
?>
<?php
if(isset($_GET['enlist_id']))
{
    $sql= "select * from bill_dispatch where department_id={$_GET['enlist_id']} and khata_id={$_GET['number']} ";
    $dispatch_result = BillDispatch::find_by_sql($sql);
    $dispatch = '';
    
}
else
{
    $dispatch_result = "";
}
 

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
                    <h2 class="headinguserprofile">लेजेर मार्फत समान  हल्नुहोस | <a href="bill_control_dashboard.php" class="btn">पछि जानुहोस</a> </h2>
                    
                    <div class="OurContenFull">
                    	
                        <div class="userprofiletables">
                          <?php if(!empty($dispatch)): ?>
                            <table class="table table-bordered td1">
                                <tr>
                                    <th>रशिद खाता नं</th> 
                                    <th>रशिद वितरण गरिएको शाखा</th>
                                 
                                    <th>&nbsp;</th>
                                </tr>
                                <?php foreach ($dispatch as $data1): 
                                        $department= Department::find_by_id($data1->department_id);
                                    ?>
                                <tr>
                                    <td><?= convertedcit($data1->khata_id) ?></td>
                                    <td><?= $department->name ?></td>
                               
                                    <td> <a class="btn" href="bill_dispatch_view.php?enlist_id=<?= $data1->department_id ?>&number=<?= $data1->khata_id ?>">विवरण हेर्नुहोस </a></td>
                                </tr>
                               <?php endforeach; ?>
                            </table>
                            
                          <?php endif; ?>  
                            
                            
                            
             <?php if(!empty($dispatch_result)): ?>      
                            
                                         <table class="table table-bordered td1">
                                              <tr>
                                                  <th class="myWidth5 myCenter" >सि.नं</th>
                                                  <th class="myCenter">रशिदको किसिम</th>
                                                  <th class="myCenter">निकास भएको मिती</th>
                                                  <th class="myCenter">निकास भएको रशिद नं</th>
                                                  <th class="myCenter">निकास भएको रशिद संख्या</th>
                                                  <th class="myCenter">रशिद बुझिलिनेको नाम / थर </th>
                                                  <th class="myWidth10">ठेली संख्या</th>
                                                 
                                            </tr>
                                           
                                    <?php $i=1; foreach($dispatch_result as $data2):
                                              $dis_details= BillDispatchDetails::find_by_dispatch_id($data2->id);
                                              $rashid_type = Rashidtype::find_by_id($data2->description_id);
                                              foreach($dis_details as $data3):         
                                        ?>            
                                            <tr>
                                                <td class="myWidtd5 myCenter" ><?= convertedcit($i) ?></td>
                                                  <td class="myCenter"><?= $rashid_type->name ?></td>
                                                  <td class="myCenter"><?= convertedcit(DateEngToNep($data2->english_date)) ?></td>
                                                  <td class="myCenter"><?= convertedcit($data3->dispatched_rashid) ?></td>
                                                  <td class="myCenter"><?= convertedcit($data3->total) ?></td>
                                                  <td class="myWidtd10"><?= $data2->rashid_to ?></td>
                                                  <td class="myCenter"><?= convertedcit(1) ?></td>
                                            </tr>
                                    <?php $i++;
                                          endforeach;
                                          endforeach;
                                    ?>          
                                        </table>
                  <?php endif; ?>         
                                    
                               
                        </div>
                  </div>
                </div><!-- main menu ends -->
            </div>
         </div>   
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>



