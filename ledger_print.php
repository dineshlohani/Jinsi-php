<?php require_once("includes/initialize.php"); 
if(!$session->is_logged_in())
{
	redirect_to("logout.php");
}
$user        = getUser();
$ledger= Ledger::find_all();
if(isset($_GET['enlist_id']) && isset($_GET['type']))
{
	$sql="select * from ledger";
        $sql.=" where enlist_id='".$_GET['enlist_id']."' and type='".$_GET['type']."'";
        $ledger= Ledger::find_by_sql($sql);
        if($_GET['type']==1)
                                               {
                                                   $dep = Department::find_by_id($_GET['enlist_id']);
                                                   $name1= $dep->name;
                                                   $description='ठेगाना: कानेपोखरी, मोरंग';
                                               }
                                               elseif($_GET['type']==2)
                                               {
                                                    $dep = Office::find_by_id($_GET['enlist_id']);
                                                    $name1= $dep->name;
                                                    $description='ठेगाना: कानेपोखरी, मोरंग';
                                               }
                                               elseif($_GET['type']==3)
                                               {
                                                    $dep = Workers::find_by_id($_GET['enlist_id']);
                                                    $name1= $dep->name;
                                                    $description='पद : '.$dep->post;
                                               }
                                                elseif($_GET['type']==4)
                                               {
                                                    $dep = Authorities::find_by_id($_GET['enlist_id']);
                                                    $name1= $dep->name;
                                                    $description='पद : '.$dep->post;
                                               }
                                               else 
                                               {
                                                   $name1="--";
                                               }
           $jinsi_khatapana_no = $_GET['number'];                                    
}
 
  $item_type = Itemtype::find_all();
  $deps = Department::find_all();
  $staff_result = Workers::find_all();
  $fiscals = FiscalYear::find_all();
  ?>
<?php include("menuincludes/header1.php"); ?>
<!-- js ends -->
<title>खरिद माग फारम </title>

<body>

    <div id="body_wrap_inner"> 
    	<div class="">
            <div class="">
                <div class="maincontent">
                   
                    <div class="OurContenFull">
                    	
                        <div class="userprofiletables">
                            	
                                          <div class="printPage">
                                            <div class="printlogo"><img src="images/emblem_nepal.png" alt="Logo"></div>
                                            <div class="mydate"></div>
        									<h1 class="margin1em letter_title_one"><?=SITE_NAME?></h1>
                                            <h5 class="margin1em letter_title_two"><?=SITE_LOCATION?></h5>
        									<h5 class="margin1em letter_title_three"><?=SITE_ADDRESS?></h5>
        									<div class="myspacer"></div>
        									<div class="subjectBold letter_subject"> सहायक जिन्सी खाताी </div>
        									
                                            <div class="font12"> <strong>सामान बुझिलिने :</strong> <?= $name1 ?> </div>
                                            <div class="font12"> <strong><?= $description ?></strong> </div>
                                            <div style="margin-top: -20px;" class="font12 myDate"> आर्थिक वर्ष : २०७६५/७६ </div>
                                            <div style="" class="font12 myDate"> <strong> खातापाना नं :</strong> <?= convertedcit($jinsi_khatapana_no) ?></div>
                                            
                                            
                                         <table class="table table-bordered myWidth100">
                                             
                                             <tr>
                                                <td class="myBold myCenter" colspan="9">सामानको विवरण</td>
                                                <td class="myBold myCenter" colspan="4">सामान फिर्ता </td>
                                                <td class="myBold myCenter" rowspan="2">कैफियत</td>
                                            </tr>
                                            <tr>
                                                  <td class="myBold  myCenter" >सि.नं</td>
                                                  <td class="myBold myCenter">जिन्सी खाता पाना नं</td>
                                                  <td class="myBold myCenter">जिन्सी संकेत नं</td>
                                                  <td class="myBold myCenter">सामान बुझेको मिति</td>
                                                  <td class="myBold ">सामानको नाम </td>
                                                  <td class="myBold myCenter">दर</td>
                                                  <td class="myBold myCenter">परिमाण</td>
                                                  <td class="myBold  myCenter" >ईकाई</td>
                                                  <!--<td class="myBold myCenter">सामान लिनेको नाम</td>-->
                                                  <td class="myBold myCenter">सामान वितरण गर्दाको अबस्था</td>
                                                  <td class="myBold myCenter">स्टोरमा सामान फिर्ताको अबस्था</td>
                                                  <td class="myBold ">परिमाण</td>
                                                  <td class="myBold myCenter">ईकाई</td>
                                                  <td class="myBold ">सामान फिर्ता मिति</td>
                                                
                                            </tr>
            <?php if(!empty($ledger)): ?>                                
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
                                                <td class=" myCenter" ><?= convertedcit($i) ?></td>
                                                  <td class="myCenter"><?= convertedcit($stock->khata_id) ?></td>
                                                  <td class="myCenter">खर्च नहुने</td>
                                                  <td class="myCenter"><?= convertedcit(DateEngToNep($data1->date)) ?></td>
                                                  <td class=""><?= $item->name?></td>
                                                  <td class="myCenter"><?= convertedcit($data->rate) ?></td>
                                                  <td class="myCenter"><?= convertedcit($data->qty) ?></td>
                                                  <td class=" myCenter" ><?= Unit::getName($item->unit_id) ?></td>
                                                  <!--<td class="myCenter"><?= $name ?></td>-->
                                                  <td class="myCenter"><?= $given_condition->name ?></td>
                                                  <td class="myCenter">
                                                      <?php foreach($return_result as $return):
                                                        if(!empty($return->item_condition_id)):   
                                                           $item_condition= Itemcondition::find_by_id($return->item_condition_id);
                                                        echo $item_condition->name.'<hr>';
                                                        endif;
                                                       endforeach; ?>
                                                      
                                                  </td>
                                                  <td class="myCenter">
                                                       <?php foreach($return_result as $return):
                                                        echo convertedcit($return->qty).'<hr>';
                                                       endforeach; ?>
                                                  </td>
                                                 
                                                  <td class="myCenter">
                                                      <?php foreach($return_result as $return):
                                                        echo Unit::getName($item->unit_id).'<hr>';
                                                       endforeach; ?>
                                                  </td>
                                                  <td class="">
                                                       <?php foreach($return_result as $return):
                                                          echo     convertedcit(DateEngToNep($return->return_date)).'<hr>';
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
                                    
                               
                        </div><br><br><br>
                        <div>
                            <table class="table myWidth100 borderless">
                                <tr>
                                    <td>  <div class="mySign"> फाँटवालाको दस्तखत: </dir></td>
                                    <td><div class="mySign"  style="margin-right:-107px"> सामान बुझिलिनेको दस्तखत: </div></td>
                                    <td style="text-align:right !important;" >  <div class="mySign"> कार्यालय प्रमुखको दस्तखत: </div></td>
                                </tr>
                            </table>
                        </div>
                        </div>
                  </div>
                  </div>
                </div><!-- main menu ends -->
            </div>
         </div>   
    </div><!-- top wrap ends -->
   


