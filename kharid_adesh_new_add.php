<?php require_once("includes/initialize.php"); 
if(!$session->is_logged_in()){ redirect_to("logout.php");}
global $database;
//echo $databse;
error_reporting(0);
$sql_maag    = "SELECT GROUP_CONCAT(maag_id) FROM kharid_adesh_profile";
//print_r($sql_maag);
$result_maag = mysqli_fetch_object($sql_maag);
//print_r($result_maag);
$datass = mysqli_fetch_object($result_maag);
//print_r($datass);
//exit;
$ids = array_pop($datass);
//print_r($ids);
$ids = array_unique(explode(",",$ids));
if(!empty($datass))
{
    $sql = "select * from kharid_mag_faram_1  where id not in (".implode(",",$ids).")";
}
else
{
    $sql="select * from kharid_mag_faram_1";
}
    $result = $database->query($sql);
    //print_r($result);

  if(isset($_GET['submit']) || isset($_GET['maag_id']))
    {
        $maag_id            = (int) $_GET['maag_id'];
        $kharid_maag_result = Kharid_mag_faram1::find_by_id($maag_id);
        if(empty($kharid_maag_result))
        {
            echo alertBox("निम्न खरिद माग फाराम नं भेटीएन  ...","kharid_adesh_new_add.php");
        }
        $kharid_adesh_result= KharidAdeshProfile::find_by_maag_id($maag_id);
        //print_r($kharid_adesh_result);
        $tippani_results = Jinsitippani::find_by_kharid_ids($maag_id);
     
        if(!empty($kharid_adesh_result) && empty($tippani_results))
        {
          echo alertBox("निम्न खरिद माग फाराम नं को खरिद आदेश भरि सकेको छ ...","kharid_adesh_new_add.php");
        }
        
        $tippani_result = Jinsitippani::find_by_kharid_ids($maag_id);
        if(empty($tippani_result))
        {
            $link="kharid_aadesh_add.php?maag_id=".$maag_id;
            redirect_to($link);
        }
     
        $tippani_amount_result = get_jinsi_tippani_minimum_rate_org($_GET['maag_id']);

    }
$final_tippani_result = get_distinct_org_id_and_kharid_id_for_kharid_adesh_view();
//print_r($final_tippani_result);
$enlist_orgs = Enlist::find_all();

?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>खरिद आदेश भर्नुहोस :: <?php echo SITE_SUBHEADING;?></title>


<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="">
            <div class="">
                <div class="maincontent">
                    <h2 class="headinguserprofile">खरिद आदेश भर्नुहोस / <a href="dashboard_kharid.php" class="btn">खरिद आदेशमा जानु होस् </a> </h2>
                    
                    <div class="OurContentFull">
                    	<h2>खरिद आदेश भर्नुहोस</h2>
                        <div class="userprofiletable">
                            
                            <form method="get" enctype="multipart/form-data" >
                                <table  class="table borderless table-responsive search_table">
                                    <tr>
                                      <td>खरिद माग फाराम नं 
                                           <input class="fill_height" type="text" name="maag_id" id="maag_id_input" /><input type="submit" name="submit" value="खोज्नुहोस"  class="btn search_btn"/></td>
                                      
                                      
                                    </tr>
                                   </table>
                            </form>
                            <?php if(!isset($_GET['submit']) && !isset($_GET['maag_id'])):?>
                            <table class="table table-bordered myWidth100 myLeft">
                                <tr>
                                    <th>खरिद आदेश नभरेका खरिद माग फारम नं</th>
                                    <th>खरिद माग गरेको मिति</th>
                                    <th> खरिद आदेश </th>
                                </tr>
                               <?php while($data_result = mysqli_fetch_assoc($result)): ?> 
                                <tr>
                                    <td><?= convertedcit($data_result['id']) ?></td>
                                    <td><?= convertedcit($data_result['maag_date']) ?></td>
                                    <td> <form><input type="" name="maag_id" value="<?= $data_result['id']?>" /><input type="submit" name="submit" value="खरिद आदेश भर्नुहोस्" class="btn btn-primary" /></form> </td>
                                </tr>
                               <?php endwhile; ?> 
                                <?php foreach($final_tippani_result as $data):
                                    $a = Kharid_mag_faram1::find_by_id($data);?>
                                <tr>
                                    <td><?= convertedcit($data) ?></td>
                                    <td><?= convertedcit($a->maag_date) ?></td>
                                    <td> <a href="kharid_aadesh_add.php?maag_id=<?= $data?>"> खरिद आदेश भर्नुहोस्  </a> </td>
                                </tr>
                                <?php endforeach;?>
                            </table>
                            <?php endif;?>
                               
                                  
                                          
                        </div>
                  </div>
                </div><!-- main menu ends -->
            </div>
         </div>   
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

