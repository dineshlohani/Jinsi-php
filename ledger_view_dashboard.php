<?php require_once("includes/initialize.php"); 
if(!$session->is_logged_in())
{
	redirect_to("logout.php");
}
$user        = getUser();
$sql= "select * from ledger group by khata_id asc";
$ledger = Ledger::find_by_sql($sql);
?>









<?php
if(isset($_POST['submit']))
{
	$sql="select * from ledger";
      if(!empty($_POST['miti']) && empty($_POST['enlist_id']))
      {
        $sql.=" where date='".DateNepToEng($_POST['miti'])."'";
      }
      elseif(empty($_POST['miti']) && !empty($_POST['enlist_id']))
      {
         $sql.=" where enlist_id='".$_POST['enlist_id']."' and type='".$_POST['type']."'";
      }
      elseif(!empty($_POST['miti']) && !empty($_POST['enlist_id']))
      {
        $sql.=" where date='".DateNepToEng($_POST['miti'])."' and enlist_id='".$_POST['enlist_id']."' and type='".$_POST['type']."'";
      }
      else 
      {
        $sql.="";    
      }
      $ledger1= Ledger::find_by_sql($sql);
}
 
  $item_type = Itemtype::find_all();
  $deps = Department::find_all();
  $staff_result = Workers::find_all();
  $fiscals = FiscalYear::find_all();
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
                    <h2 class="headinguserprofile">लेजेर मार्फत समान  हल्नुहोस | <a href="dashboard_ledger.php" class="btn">पछि जानुहोस</a> </h2>
                    
                    <div class="OurContenFull">
                    	
                        <div class="userprofiletables">
                          <?php if(!empty($ledger)): ?>
                            <table class="table table-bordered td1">
                                <tr>
                                    <th>सहायक जिन्सी खाता नं</th> 
                                    <th>सामान बुझिलिने</th>
                                    <th>&nbsp;</th>
                                </tr>
                                <?php foreach ($ledger as $data1): 
                                    if($data1->type==1)
                                               {
                                                   $dep = Department::find_by_id($data1->enlist_id);
                                                   $name= $dep->name;
                                               }
                                               elseif($data1->type==2)
                                               {
                                                    $dep = Office::find_by_id($data1->enlist_id);
                                                   $name= $dep->name;
                                               }
                                               elseif($data1->type==3)
                                               {
                                                    $dep = Workers::find_by_id($data1->enlist_id);
                                                   $name= $dep->name;
                                               }
                                               elseif($data1->type==4)
                                               {
                                                    $dep = Authorities::find_by_id($data1->enlist_id);
                                                   $name= $dep->name;
                                               }
                                               else
                                               {
                                                 $name="--";
                                               }
                                    ?>
                                <tr>
                                    <td><?= convertedcit($data1->khata_id) ?></td>
                                    <td><?= $name ?></td>
                                    <td> <a class="btn" href="ledger_view.php?enlist_id=<?= $data1->enlist_id ?>&type=<?= $data1->type ?>&number=<?= $data1->khata_id ?>">विवरण हेर्नुहोस </a></td>
                                </tr>
                               <?php endforeach; ?>
                            </table>
                            
                          <?php endif; ?>  
                            
                            
                            
             <?php if(!empty($ledger1)): ?>      
                            
                                         <table class="table table-bordered td1">
                                             <tr>
                                                <th class="myCenter" colspan="10">सामानको विवरण</th>
                                                <th class="myCenter" colspan="4">सामान फिर्ता </th>
                                                <th class="myCenter" rowspan="2">कैफियत</th>
                                            </tr>
                                            <tr>
                                                  <th class="myWidth5 myCenter" >सि.नं</th>
                                                  <th class="myCenter">जिन्सी खाता पाना नं</th>
                                                  <th class="myCenter">जिन्सी संकेत नं</th>
                                                  <th class="myCenter">सामान बुझेको मिति</th>
                                                  <th class="myWidth10">सामानको नाम </th>
                                                  <th class="myCenter">दर</th>
                                                  <th class="myCenter">परिमाण</th>
                                                  <th class="myWidth5 myCenter" >ईकाई</th>
                                                  <th class="myCenter">सामान लिनेको नाम</th>
                                                  <th class="myCenter">सामान वितरण गर्दाको अबस्था</th>
                                                  <th class="myCenter">स्टोरमा सामान फिर्ताको अबस्था</th>
                                                  <th class="myWidth10">परिमाण</th>
                                                  <th class="myCenter">ईकाई</th>
                                                  <th class="myWidth10">सामान फिर्ता मिति</th>
                                                
                                            </tr>
                                           
                                    <?php $i=1; foreach($ledger as $data1):
                                        
                                               if($data1->type==1)
                                               {
                                                   $dep = Department::find_by_id($data1->enlist_id);
                                                   $name= $dep->name;
                                               }
                                               elseif($data1->type==2)
                                               {
                                                    $dep = Office::find_by_id($data1->enlist_id);
                                                   $name= $dep->name;
                                               }
                                               elseif($data1->type==3)
                                               {
                                                    $dep = Workers::find_by_id($data1->enlist_id);
                                                   $name= $dep->name;
                                               }
                                               elseif($data1->type==4)
                                               {
                                                    $dep = Authorities::find_by_id($data1->enlist_id);
                                                   $name= $dep->name;
                                               }
                                               else 
                                               {
                                                   $name="--";
                                               }
                                            $ledger_details = Ledgerdetails::get_item_details($data1->id);
                                          foreach($ledger_details as $data):
                                          $given_condition = Itemcondition::find_by_id($data->given_condition_id);
                                          $stock = ItemStock::find_by_item_id_and_category($data->item_id,2);
                                          $item = Notspentitem::find_by_id($data->item_id);
                                          $sql_return    = "select * from ledger_return_history where item_id ={$data->item_id} and category={$data->category} and rate={$data->rate} and ledger_id={$data1->id}";
                                          $return_result = Ledgerreturnhistory::find_by_sql($sql_return);
                                        ?>            
                                            <tr>
                                                <td class="myWidtd5 myCenter" ><?= convertedcit($i) ?></td>
                                                  <td class="myCenter"><?= convertedcit($stock->khata_id) ?></td>
                                                  <td class="myCenter">खर्च नहुने</td>
                                                  <td class="myCenter"><?= convertedcit(DateEngToNep($data1->date)) ?></td>
                                                  <td class="myWidtd10"><?= $item->name?></td>
                                                  <td class="myCenter"><?= convertedcit($data->rate) ?></td>
                                                  <td class="myCenter"><?= convertedcit($data->qty) ?></td>
                                                  <td class="myWidtd5 myCenter" ><?= Unit::getName($item->unit_id) ?></td>
                                                  <td class="myCenter"><?= $name ?></td>
                                                  <td class="myCenter"><?= $given_condition->name ?></td>
                                                  <td class="myCenter">
                                                      <?php foreach($return_result as $return):
                                                        if(!empty($return->item_condition_id)):   
                                                           $item_condition= Itemcondition::find_by_id($return->item_condition_id);
                                                        echo $item_condition->name.'<br>';
                                                        endif;
                                                       endforeach; ?>
                                                      
                                                  </td>
                                                  <td class="myCenter">
                                                       <?php foreach($return_result as $return):
                                                        echo convertedcit($return->qty).'<br>';
                                                       endforeach; ?>
                                                  </td>
                                                 
                                                  <td class="myCenter">
                                                      <?php foreach($return_result as $return):
                                                        echo Unit::getName($item->unit_id).'<br>';
                                                       endforeach; ?>
                                                  </td>
                                                  <td class="myWidtd10">
                                                       <?php foreach($return_result as $return):
                                                          echo     convertedcit(DateEngToNep($return->return_date)).'<br>';
                                                       endforeach; ?>
                                                      
                                                  </td>
                                                  <td class="myCenter">
                                                      
                                                  </td>
                                                 
                                                 
                                                  
                                            </tr>
                                    <?php $i++;
                                          endforeach;
                                          endforeach; ?>           
                                        </table>
                  <?php endif; ?>         
                                    
                               
                        </div>
                  </div>
                </div><!-- main menu ends -->
            </div>
         </div>   
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>


