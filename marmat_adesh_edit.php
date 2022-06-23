<?php require_once("includes/initialize.php"); 
 Marmatadesh::resetAutoIncrement();
 $adesh_id = $_GET['adesh_id'];
 $profile = Marmatadeshprofile::find_by_id($adesh_id);
 $details = Marmatadesh::find_by_adesh_id($adesh_id);
if(isset($_POST['submit']))
{
    $adesh_result = Marmatadesh::find_by_adesh_id($_POST['adesh_no']);
    foreach($adesh_result as $a)
    {
        $a->delete();
    }
    $result =  Marmatadeshprofile::find_by_id($_POST['adesh_no']);
    $result->type = $_POST['type'];
    $result->enlist_id = $_POST['enlist_id'];
    $result->order_date = $_POST['order_date'];
    $result->order_date_english = DateNepToEng($_POST['order_date']);
    $result->save();
    for($i=0;$i<count($_POST['item_id']); $i++)
    {
         $data= new Marmatadesh();
        $data->adesh_no             = $adesh_id;
        $data->item_id              = $_POST['item_id'][$i];
        $data->item_type_id         = $_POST['item_type_id'][$i];
        $data->category             = $_POST['category'][$i];
        $data->quantity             = $_POST['quantity'][$i];
        $data->marmat_details       = $_POST['marmat_details'][$i];
        $data->amount               = $_POST['amount'][$i];
        $data->final_amount         = $_POST['final_amount'][$i];
        $data->remarks              = $_POST['remarks'][$i];
        $data->save();
    }
  echo alertBox("सच्याउन सफल. ","marmat_adesh_search.php");
}


$unit_result = Unit::find_all();
$department= Department::find_all();
$workers   = Workers::find_all();
$authorities_result = Authorities::find_all();
$office = Office::find_all();
$item_type = Itemtype::find_all();
?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>मर्मत आदेश  भर्नुहोस</title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="">
            <div class="">
                <div class="maincontent">
                    <h2 class="headinguserprofile">मर्मत आदेश भर्नुहोस | <a href="dashboard_marmat_adesh.php" class="btn">पछि जानुहोस </a> </h2>
                    <div class="OurContentFull">
                    	<h2>मर्मत आदेश </h2>
                        <div class="userprofiletable">
                            
                            <form method="post">
                                <div class="inputWrap">
                                 <div class="our_content">
                                                            <fieldset> 
                                                                <legend>मर्मत आदेश  </legend>
                                                                <div class="titleInput"><b> आदेश नं:</b></div>
                                                                <input type="text" name="adesh_no" value="<?php echo $profile->adesh_no;?>" readonly="true">
                                                                <!--<input type="hidden" name="type" value="" id="check_type">-->
                                                                 <div class="titleInput" style="margin-top:5px;"><b>निवेदक:</b></div>
                                                                <select name="type" class="check_to form-control">
                                                                    <option value="">छान्नुहोस्</option>
                                                                    <option value="1" <?php if($profile->type==1){ echo 'selected="selected"';}?>>बिभाग</option>
                                                                    <option value="2" <?php if($profile->type==2){ echo 'selected="selected"';}?>>कार्यालय</option>
                                                                    <option value="3" <?php if($profile->type==3){ echo 'selected="selected"';}?>>कर्मचारी</option>
                                                                     <option value="4" <?php if($profile->type==4){ echo 'selected="selected"';}?>>पदाधिकारी</option>
                                                                </select>
                                                                 <input type="hidden" name="enlist_id" value="<?=$profile->enlist_id?>"/>
                                                                 <div class="myspacer20"> </div>
                                                                 <div style="text-align: center;"colspan="2" id="show_to">

                                                             </div>
                                                                 <br><div class="titleInput"><b> मिती  :</b></div>
                                                                 <input class="form-control" type="text" name="order_date" id="nepaliDate3" required value="<?=$profile->order_date?>"/>
                                                            </fieldset>
                                                         </div> 
                                                    </div>
                                                    
                                                    <br>
                                                         
                          <table class="table table-bordered table-responsive myWidth100">
                           <tr>
                                <th>सि नं </th>
                               <th>सामानको किसिम</th>
                                <th>सामानको प्रकार</th>
                                <th>सामानको  नाम </th>
                                <th>इकाइ</th>
                                <th>परिमाण</th>
                                <th> मर्मत विवरण </th>
                                <th> अनुमानित लागत रु </th>
                                <th> कैफियत   </th>
                            </tr>
                            <?php $i=1; foreach($details as $detail):
                                if($detail->category==1)
                                {
                                    $item_result = Spentitem::find_all();
                                    $unit_result = Spentitem::find_by_id($detail->item_id);
                                    $unit_name = Unit::getName($unit_result->unit_id);
                                }
                                else
                                {
                                    $item_result = Notspentitem::find_all();
                                    $unit_result = Notspentitem::find_by_id($detail->item_id);
                                    $unit_name = Unit::getName($unit_result->unit_id);
                                }
                                ?>
                            <tr <?php if($i!=1){ ?> class="remove_marmat_detail"<?php } ?> >
                            	<td><?=$i?></td>
                                 <td >
                                    <select id="item_type_id-1" name="item_type_id[]">
                                        <option value="">छान्नुहोस</option>
                                        <?php foreach($item_type as $data):?>

                                         <option value="<?php echo $data->id;?>" <?php if($detail->item_type_id==$data->id){ echo 'selected="selected"';}?>><?php echo $data->name;?></option>
                                         <?php endforeach;?>
                                    </select>
                                </td>
                                <td >
                                    <select id="category-1" name="category[]">
                                       <option value="1"  <?php if($detail->category==1){ echo 'selected="selected"';}?>>खर्च हुने </option>
                                       <option value="2" <?php if($detail->category==1){ echo 'selected="selected"';}?>>खर्च नहुने </option>
                                   </select>
                                </td>
                                <td>
                                    <select name="item_id[]" id="item_name-1" class="item_name">
                                        <option value="">------</option>
                                        <?php foreach($item_result as $data):?>
                                        <option value="<?=$data->id?>" <?php if($detail->item_id==$data->id){ echo 'selected="selected"';}?>><?=$data->name?></option>
                                        <?php endforeach;?>
                                    </select>
                                </td>
                                <td id="unit_machinary_1"><?=$unit_name?></td>
                                <td><input type="text" name="quantity[]" value="<?=$detail->quantity?>"/></td>
                                 <td><textarea name="marmat_details[]"><?=$detail->marmat_details?></textarea></td>
                                <td><input type="text" name="amount[]" value="<?=$detail->amount?>"/></td>
                               <td><textarea name="remarks[]"><?=$detail->remarks?></textarea></td>
                            </tr>
                            <?php $i++; endforeach;?>
                            <tbody id="adesh_add">
                                
                            </tbody>
                            <table class="table table-bordered table-responsive myWidth100">
                                   <tr>
                                        <td class="myCenter"><div class="add_more_marmat btn ">थप्नुहोस</div> </td>
                                        <td class="myCenter"> <div class="remove_more_marmat btn">हटाउनुहोस</div></td>
                                        <td class="myCenter"><input type="submit" name="submit" class="btn" value="सेभ गर्नुहोस"/></td>
                                    </tr>
                        </table>
                            </form>
                                          
                        </div>
                  </div>
                </div><!-- main menu ends -->
            </div>
         </div>   
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

