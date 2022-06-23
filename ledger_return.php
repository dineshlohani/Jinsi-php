<?php require_once("includes/initialize.php"); 
 error_reporting(1);
if(!$session->is_logged_in())
{
	redirect_to("logout.php");
}

$user        = getUser();

if(isset($_GET['submit']))
{
    $sql="select * from ledger";
    $sql.=" where enlist_id='".$_GET['enlist_id']."' and type='".$_GET['type']."'";
    $ledger= Ledger::find_by_sql($sql);
    $item_condition = Itemcondition::find_all();

}


if(isset($_POST['submit']))
{
   
    foreach($_POST['return_amt'] as $key=>$datas)
    {
       
        $data= array_shift($datas);
        $a=0;

        if(!empty($data))
        {
            $ledger_details = Ledgerdetails::find_by_id($key);
            $ledger_profile = Ledger::find_by_id($ledger_details->ledger_id);
    
        if(($ledger_details->qty-$ledger_details->return_qty) >= $data)
            {
          
              $ledger_details->return_qty= $ledger_details->return_qty + $data;
              if($ledger_details->save())
              {
                  $ledger_history                    = new Ledgerreturnhistory();
                  $ledger_history->enlist_id         = $ledger_profile->enlist_id;
                  $ledger_history->type              = $ledger_profile->type;
                  $ledger_history->ledger_id         = $ledger_profile->id;
                  $ledger_history->qty               = $data;
                  $ledger_history->rate              = $ledger_details->rate;
                  $ledger_history->return_date       = DateNepToEng($_POST['miti']);
                  $ledger_history->item_id           = $ledger_details->item_id;
                  $ledger_history->category          = $ledger_details->category;
                  $ledger_history->item_condition_id = $_POST['item_condition_id'][$key];
                  if($ledger_history->save())
                  {
                      $a=1;
                  }
              }
            }
        }
    }
        if($a==1)
        {
          echo alertBox("थप सफल ","ledger_return.php");  
        } 
        
}
 
  $item_type = Itemtype::find_all();
  $deps = Department::find_all();
  $staff_result = Workers::find_all();
  $fiscals = FiscalYear::find_all();
  ?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>लेजेर मार्फत समान फिर्ता गर्नुहोस </title>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="">
            <div class="">
                <div class="maincontent">
                    <h2 class="headinguserprofile">लेजेर मार्फत समान फिर्ता गर्नुहोस | <a href="dashboard_ledger.php" class="btn">पछि जानुहोस</a> </h2>
                    
                    <div class="OurContenFull">
                    	
                        <div class="userprofiletables">
                        	<form method="get" enctype="multipart/form-data">
                                       
                                        <table class="table table-bordered td1">
                                            <tr>
                                                 <td colspan="11">
                                                    <div class="inputWrap">
                                                         <div class="our_content">
                                                            <fieldset> 
                                                                <legend>समान लग्ने छान्नुहोस् </legend>
                                                                <input type="hidden" name="type" value="" id="check_type">
                                                                 <div class="titleInput"><b> सामान लिने  :</b></div>
                                                                <select name="to" class="check_to form-control" required>
                                                                    <option value="">छान्नुहोस्</option>
                                                                    <option value="1">शाखा</option>
                                                                    <option value="2">कार्यालय</option>
                                                                    <option value="3">कर्मचारी</option>
                                                                    <option value="4">पदाधिकारी</option>
                                                                </select>
                                                               
                                                                 <div class="myspacer20">
                                                                     
                                                                 </div>
                                                                 <div style="text-align: center;"colspan="2" id="show_to">

                                                                  </div>
                                                               
                                                    <br><br><input class="btn" type="submit" name="submit" value="खोज्नुहोस">
                                               
                                                            </fieldset>
                                                         </div> 
                                                    </div>
                                               </td>
                                            </tr>
                                          
                                               
                                            
                                        </table>    
                                </form>  
                           <form method="post" >
                             <table class="table table-bordered td1">
                                 <br><div class="titleInput"><b>सामान फिर्ता गरिएको मिती  :</b></div>
                                       <tr>
                                             <td colspan="2">
                                            <input class="form-control" type="text" name="miti" id="nepaliDate3" value="<?= generateCurrDate() ?>" required /> 
                                          </td>
                                          <td colspan="8">
                                              &nbsp;
                                          </td>
                                        
                                       </tr>            
                                            <tr>
                                                  <th class="myWidth5 myCenter" >क्र.स.</th>
                                                  <th class="myWidth10">सामानको  नाम </th>
                                                  <th class="myCenter">जिन्सी खाता पाना नं</th>
                                                  <th class="myCenter">जिन्सी संकेत नं</th>
                                                  <th class="myWidth10">दर</th>
                                                  <th class="myCenter">परिमाण</th>
                                                  <th class="myCenter">वितरण गरेको मिती</th>
                                                  <th class="myWidth10">सामानको अवस्था</th>
                                                  <th class="myCenter">&nbsp;</th>
                                                  <th class="myCenter">फिर्ता परिमाण</th>
                                                  
                                            </tr>
                                           
                                            
                               <?php 
                               if(!empty($ledger)):
                                   $i=1;foreach($ledger as $data1): 
                                      $ledger_details = Ledgerdetails::get_item_details($data1->id); 
                                   $count= count($ledger);
                                   if($count>1)
                                   {
                                       $j=$j;
                                   }
                                   else
                                   {
                                     $j=1;   
                                   }
                                    foreach($ledger_details as $data):  
                                        $items= Notspentitem::find_by_id($data->item_id);
                                        $stock_item= ItemStock::find_by_sql("select * from item_stock where item_id=".$data->item_id." and category=2 and rate={$data->rate} limit 1");
                                        $a = array_shift($stock_item);
                                        $check = $data->qty-$data->return_qty;
                                        if($check!=0): 
                                   ?>             
                                             
                                                <tr>
                                                      <td><?= convertedcit($i) ?></td>
                                                      <td>
                                                          <?= $items->name ?>
                                                      </td>
                                                      <td>
                                                          <?= convertedcit($a->khata_id) ?>
                                                      </td>
                                                      <td>
                                                          खर्च नहुने   
                                                      </td>
                                                       <td>
                                                          <?= convertedcit($data->rate) ?>
                                                      </td>
                                                      <td>
                                                          <?= convertedcit($data->qty-$data->return_qty) ?>
                                                      </td>
                                                      <td>
                                                          <?= convertedcit(DateEngToNep($data1->date)) ?>
                                                      </td>
                                                      <td>
                                                          <select name="item_condition_id[<?= $data->id ?>]" >
                                                              <option value="">छान्नुहोस्</option>
                                                              <?php foreach ($item_condition as $condition): ?>
                                                              <option value="<?= $condition->id ?>"><?= $condition->name ?></option>
                                                              <?php endforeach;  ?>
                                                          </select>
                                                      </td>
                                                      <td>
                                                          <input  type="checkbox" value="<?= $data->id ?>" id="returnchk_<?=$j?>" name="return_check[]">
                                                      </td>
                                                      <td>
                                                          <input  style="display: none;" class="form-control" type="text" id="returnamt_<?=$j?>" name="return_amt[<?= $data->id ?>][<?= $j ?>]">
                                                      </td>
                                                </tr>
                             <?php  
                             endif;
                                 $j++; $i++; endforeach;
                                endforeach;
                                 
                                endif;
                              ?>                   
                               </table>
                                    
                                    <input type="hidden"  value="kharid" id="forurl" />  
                                    <input class="btn" type="submit" value="सेभ गर्नुहोस" name="submit">     
                         </form>
                        </div>
                  </div>
                </div><!-- main menu ends -->
            </div>
         </div>   
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>



