<?php
require_once('database.php');

function get_item_stock_for_kharcha($item_id, $category, $rate, $date)
{
  $sql_stock    = "select * from item_stock where item_id='".$item_id."' and category='".$category."' and rate='".$rate."' limit 1";
  $item_stock_result = ItemStock::find_by_sql($sql_stock);
  if(empty($item_stock_result[0]))
  {
    $stock_available = 0;
  }
  else
  {
    $stock_available = $item_stock_result[0]->stock;
  }
  return $stock_available;
}     
function get_jinsi_khata_id($item_id,$category)
{
    $stock_result = ItemStock::find_by_item_id_and_category($item_id, $category);
    if(!empty($stock_result))
    {
        $khata_id = $stock_result->khata_id;
    }
    else
    {
        $count = ItemStock::find_max_khata_id_by_category($category);
        $khata_id = $count + 1;
    }
    return $khata_id;
}

function getCode($id, $cate)
{
    if($cate == 1)
    {
        $temp = 407;
    }else if($cate == 2)
    {
        $temp = 408;
    }
    $code = 'H-'.$temp.$id;
    return $code;
    
}

function placeholder($data)
{
    $result="";
    $num =  explode(".",$data);
    $length = strlen($num[0]);
    if($length==1)
    {
        $result=$num[0];
    }
     if($length==2)
    {
        $result=$num[0];
    }
     if($length==3)
    {
        $result=$num[0];
    }
    if($length==4)
    {
        $result.=substr($num[0],0,1);
        $result.=",";
        $result.=substr($num[0],1,3);
        
    }
    if($length==5)
    {
       $result.=substr($num[0],0,2);
        $result.=",";
        $result.=substr($num[0],2,3);
         
    }
     if($length==6)
    {
       $result.=substr($num[0],0,1);
        $result.=",";
        $result.=substr($num[0],1,2);
        $result.=",";
        $result.=substr($num[0],3,3);
         
    }
      if($length==7)
    {
       $result.=substr($num[0],0,2);
        $result.=",";
      $result.=substr($num[0],2,2);
        $result.=",";
        $result.=substr($num[0],4,3);
    }
     if($length==8)
    {
        $result.=substr($num[0],0,1);
        $result.=",";
        $result.=substr($num[0],1,2);
        $result.=",";
        $result.=substr($num[0],3,2);
        $result.=",";
        $result.=substr($num[0],5,3);
    }
      if($length==9)
    {
        $result.=substr($num[0],0,2);
        $result.=",";
        $result.=substr($num[0],2,2);
        $result.=",";
        $result.=substr($num[0],4,2);
        $result.=",";
        $result.=substr($num[0],6,3);
        
    }
     if($length==10)
    {
        $result.=substr($num[0],0,1);
        $result.=",";
        $result.=substr($num[0],1,2);
        $result.=",";
        $result.=substr($num[0],3,2);
        $result.=",";
        $result.=substr($num[0],5,2);
        $result.=",";
        $result.=substr($num[0],7,3);
    }
    if(empty($num[1]))
    {
    	$number=$result;
    }
    else
    {
    	$number=$result.".".$num[1];
   }
    return $number;
}
function get_name_by_category($category_id,$item_id)
{
    if($category_id==1)
    {
        $data=  Spentitem::find_by_id($item_id);
        $name=$data->name;
    }
 else
    {
     $data=  Notspentitem::find_by_id($item_id);
      $name=$data->name;
    }
    return $name;
}

function get_item_rate1($item_id,$category,$rate,$date)
        {
            global $database;
            $a=0;
            $ress = array();
            $message='';
            $current_fiscal_id= Fiscalyear::find_current_id();
            $date_range = getStartEndDates($current_fiscal_id,4);
            $start_date = $date_range[0];
            $total_stock=0;
            $total_stock1=0;
            $sql_stock    = "select * from item_stock where item_id='".$item_id."' and category='".$category."' and rate={$rate} limit 1 ";
           // echo $sql_stock;
            $item_stock_result = ItemStock::find_by_sql($sql_stock);
            if(empty($item_stock_result))
            {
                $a=1;
                $message = "स्टक मा सामान भेटिएन";
                
               // echo 'here';
            }
            else
            {
               $result_one_item    = array_shift($item_stock_result);
                      $previous_stock = $result_one_item->prev_stock;
                      return $previous_stock;
                    //  echo $previous_stock;
                        $sql_dakhila = "select sum(a.qty) as qty from dakhila_item_details as a left join dakhila_profile as b on a.dakhila_id = b.id where a.item_id='".$item_id."'"
                                     . " and a.category='".$category."' and a.rate={$rate} and b.bill_type=1"
                                     . " and b.date_english>='".$start_date."' and b.date_english<='".$date."' ";
                           //echo $sql_dakhila;exit;
                        $result_dakhila  = $database->query($sql_dakhila);
                        $row_dakhila = mysqli_fetch_object($result_dakhila);
                       //   print_r($row_dakhila);exit;
                                if(!empty($row_dakhila))
                                {
                                   $dakhila_stock = $row_dakhila->qty;
                                }
                              else 
                                {
                                   $dakhila_stock=0;
                                }
                                 $sql_dakhila1 = "select sum(a.qty) as qty from dakhila_item_details as a left join dakhila_profile as b on a.dakhila_id = b.id where a.item_id='".$item_id."'"
                                     . " and a.category='".$category."' and a.rate_vat={$rate} and b.bill_type=2"
                                     . " and b.date_english>='".$start_date."' and b.date_english<='".$date."' ";
                                    $result_dakhila1  = $database->query($sql_dakhila1);
                                    $row_dakhila1 = mysqli_fetch_object($result_dakhila1);
                                     if(!empty($row_dakhila1))
                                        {
                                           $dakhila_stock1 = $row_dakhila1->qty;
                                        }
                                      else 
                                        {
                                           $dakhila_stock1=0;
                                        }
                                        
                                 $sql_hastantaran ="select sum(stock) as total from item_stock_department where item_id='".$item_id."' and category='".$category."' and rate={$rate}  and stock_date_english>='".$start_date."' and stock_date_english<='".$date."' "; 
                                 $result_hastantaran= $database->query($sql_hastantaran);
                                  $row_hastantaran= mysqli_fetch_object($result_hastantaran);
                                      if(!empty($row_hastantaran))
                                      {
                                         $hastantaran_add = $row_hastantaran->total;
                                      }
                                    else 
                                      {
                                         $hastantaran_add=0;
                                      }
                                 
                                   $dakhila_stock = $dakhila_stock + $dakhila_stock1 + $hastantaran_add;  
                                  $sql_kharcha= "select sum(a.qty) as qty from kharcha_mag_faram_2 as a left join kharcha_mag_faram_1 as b on a.maag_id = b.id where a.item_id='".$item_id."'"
                                                    . " and a.category='".$category."' and a.rate={$rate} "
                                                    . " and b.maag_date_english>='".$start_date."' and b.maag_date_english<='".$date."'";
                                      $result_kharcha = $database->query($sql_kharcha);
                                      $row_kharcha= mysqli_fetch_object($result_kharcha);
                                      if(!empty($row_kharcha))
                                      {
                                         $kharcha_stock = $row_kharcha->qty;
                                      }
                                    else 
                                      {
                                         $kharcha_stock=0;
                                      }
                                   $sql_kharcha_hastantaran= "select sum(a.quantity) as qty from hastantaran_second as a left join hastantaran_one as b on a.hastantaran_id = b.id where a.item_id='".$item_id."'"
                                                    . " and a.category='".$category."' and a.rate={$rate} "
                                                    . " and b.hastantaran_date_english>='".$start_date."' and b.hastantaran_date_english<='".$date."'";
                                      $result_kharcha_hastantaran = $database->query($sql_kharcha_hastantaran);
                                      $row_kharcha_hastantaran= mysqli_fetch_object($result_kharcha_hastantaran);
                                      if(!empty($row_kharcha_hastantaran))
                                      {
                                         $kharcha_stock_hastantaran = $row_kharcha_hastantaran->qty;
                                      }
                                    else 
                                      {
                                         $kharcha_stock_hastantaran=0;
                                      }    
                                      
                                  $sql_nilam = "select sum(actual_reduced_stock) as total from  jinsi_lilam_final where item_id='".$item_id."' and category='".$category."' and rate={$rate} and created_date_english>='".$start_date."' and created_date_english<='".$date."'";
                                  $result_nilam = $database->query($sql_nilam);
                                      $row_nilam= mysqli_fetch_object($result_nilam);
                                      if(!empty($row_nilam))
                                      {
                                         $total_nilam = $row_nilam->total;
                                      }
                                    else 
                                      {
                                         $total_nilam=0;
                                      } 
                                    $sql_minha = "select sum(actual_reduced_stock) as total from  jinsi_minha_final where item_id='".$item_id."' and category='".$category."' and rate={$rate} and created_date_english>='".$start_date."' and created_date_english<='".$date."'";
                                 //echo $sql_minha;exit;
                                    $result_minha = $database->query($sql_minha);
                                      $row_minha= mysqli_fetch_object($result_minha);
                                     // print_r($row_minha);
                                      if(!empty($row_minha))
                                      {
                                         $total_minha = $row_minha->total;
                                      }
                                    else 
                                      {
                                         $total_minha=0;
                                      }    
                                    //  echo $total_minha;
                                      
                                $total_stock = $previous_stock + $dakhila_stock - $kharcha_stock - $kharcha_stock_hastantaran - $total_nilam-$total_minha;
                                $total_stock1= $dakhila_stock - $kharcha_stock -$kharcha_stock_hastantaran - $total_nilam-$total_minha;
                       
                      
             
            
            $ress[0]=$a;
            $ress[1]=$message;
            $ress[2]=$total_stock;
            $ress[4]=$kharcha_stock + $kharcha_stock_hastantaran + $total_nilam + $total_minha;
            $ress[5]=$dakhila_stock;
            $ress[6]= $total_stock1;
          return $ress;
          
          }
        }


function get_item_stock_details($item_id,$category)
{
     if($category==1)
    {
        $result=  Spentitem::find_by_id($item_id);
        $name=$result->name;
        $budget_title_id=$result->budget_title_id;
        $specification= $result->specification;
        $unit= Unit::getName($result->unit_id);
    }
    else
    {
        $result= Notspentitem::find_by_id($item_id);
        $name=$result->name;
        $budget_title_id=$result->budget_title_id;
        $specification= $result->specification;
        $unit= Unit::getName($result->unit_id);
    }
    $array=array("name"=>$name,"budget_title_id"=>$budget_title_id,"specification"=>$specification,"unit"=>$unit);
    return $array;
}
function getSiteTitle()
{
    return SITE_NAME.SITE_TYPE;
}
function generatePrintUrl()
 {
 	$new_url = explode("?",$_SERVER['REQUEST_URI']);
		$rep_url = explode(".php",$new_url[0]);
		$rep_first_url = $rep_url[0];
		$first_url = $rep_first_url."_print.php?";
		$print_url = $first_url.$new_url[1];
		return $print_url;
 }
 function getAllDatesByItemId($item_id,$category)
 {
    global $database;
    $department_hastantaran_dates = array();
    $stokes_dates = array();
    $maag_dates = array();
    $dakhila_dates = array();
    $hastantaran_dates= array();
    $jinsiminha_dates = array();
    $jinsililam_dates = array();
    
     $department_hastantaran_sql="select * from item_stock_department where item_id=$item_id and category=$category";
    $department_hastantaran_result = $database->query($department_hastantaran_sql);
   while ($department_row = mysqli_fetch_object($department_hastantaran_result))
    {
      
       array_push($department_hastantaran_dates, $department_row->stock_date_english);
    }

    $stock_sql= "select * from item_stock where item_id=$item_id and category=$category";
    $stock_result = $database->query($stock_sql);
  
    while ($row = mysqli_fetch_object($stock_result))
    {
       
       if(!empty($row->stock_date_english))
       {
            array_push($stokes_dates, $row->stock_date_english);
       }
      
    }
    $hastantaran_sql="select * from hastantaran_second where item_id=$item_id and category=$category";
    $hastantaran_result = $database->query($hastantaran_sql);
   while ($row = mysqli_fetch_object($hastantaran_result))
    {
       $hastantaran_date= Hastantaranone::find_by_id($row->hastantaran_id);
       array_push($hastantaran_dates, $hastantaran_date->hastantaran_date_english);
    }

     $jinsiminha_sql="select * from jinsi_minha_final where item_id=$item_id and category=$category";
     $jinsiminha_result = $database->query($jinsiminha_sql);
   while ($row = mysqli_fetch_object($jinsiminha_result))
    {
        array_push($jinsiminha_dates, $row->created_date_english);
    }

     $jinsililam_sql="select * from jinsi_lilam_final where item_id=$item_id and category=$category";
     $jinsililam_result = $database->query($jinsililam_sql);
   while ($row = mysqli_fetch_object($jinsililam_result))
    {
        array_push($jinsililam_dates, $row->created_date_english);
    }


    //if(isset($_GET['item_id']))
    //{
    $sql = "select distinct kharcha1.maag_date_english from kharcha_mag_faram_1 as kharcha1 left join"
            . " kharcha_mag_faram_2 as kharcha2 on kharcha1.id=kharcha2.maag_id where kharcha2.item_id=".$item_id." and kharcha2.category=".$category;
    $result = $database->query($sql);
    //$database->num_rows($result);
    //$mysqli = new mysqli_result($sql);
    while ($row = mysqli_fetch_object($result))
    {
        array_push($maag_dates, $row->maag_date_english);
    }
    $sql = "select distinct dakhila1.date_english from dakhila_profile as dakhila1 left join"
            . " dakhila_item_details as dakhila2 on dakhila1.id=dakhila2.dakhila_id where dakhila2.item_id=".$item_id." and dakhila2.category=".$category;
    $result = $database->query($sql);
    while ($row = mysqli_fetch_object($result))
    {
        array_push($dakhila_dates, $row->date_english);
    }
       $all_dates = array_merge($maag_dates,$dakhila_dates,$hastantaran_dates,$jinsiminha_dates,$jinsililam_dates,$stokes_dates,$department_hastantaran_dates);
       
       usort($all_dates, "date_sort");
//   echo "<pre>";print_r($all_dates);echo "</pre>";exit;
       return array_unique($all_dates);
 }
 function date_sort($a, $b) {
            return strtotime($a) - strtotime($b);
        }
function getItemInstance($category)
{
    if($category==1)
    {
        $instance = new Spentitem;
    }
    else
    {
        $instance = new Notspentitem;
    }
    return $instance;
}
function addItemStock($item_id,$category,$stock_amount,$rate,$specification="")
{
    $item_stock = ItemStock::find_stock($item_id,$category,$rate);
    if(empty($item_stock))
    {
        $stock = new ItemStock;
        $stock->item_id = $item_id;
        $stock->category = $category;
        $stock->rate= $rate;
        $stock->stock= $stock_amount;
        $stock->specification = $specification;
        $stock->khata_id = get_jinsi_khata_id($item_id,$category);
        $stock->save();
    }
    else 
    {
        $item_stock->stock = $item_stock->stock + $stock_amount;
        $item_stock->save();
    }
}

function addItemStock_hastantaran($item_id,$category,$stock_amount,$rate)
{
    $item_stock = ItemStock::find_stock($item_id,$category,$rate);
    if(empty($item_stock))
    {
        $stock = new ItemStock;
        $stock->item_id = $item_id;
        $stock->category = $category;
        $stock->rate= $rate;
        $stock->stock= $stock_amount;
        $stock->khata_id = get_jinsi_khata_id($item_id,$category);
        $stock->is_hastantaran = 1;
        $stock->save();
    }
    else 
    {
        $item_stock->stock = $item_stock->stock + $stock_amount;
        $item_stock->save();
    }
}

function deductItemStock($item_id,$category,$stock_amount,$rate)
{
    $item_stock = ItemStock::find_stock($item_id,$category,$rate);
    /*if(empty($item_stock))
    {
        $stock = new ItemStock;
        $stock->item_id = $item_id;
        $stock->category = $category;
        $stock->rate= $rate;
        $stock->stock= $stock_amount;
        $stock->save();
    }*/
    
        $item_stock->stock = $item_stock->stock - $stock_amount;
        $item_stock->save();
    
}
 function folder_exist($folder)
{
    // Get canonicalized absolute pathname
    $path = realpath($folder);

    // If it exist, check if it's a directory
    return ($path !== false AND is_dir($path)) ? $path : false;
}
function dir_is_empty($dir) {
  if(folder_exist($dir))
  {
  
  $handle = opendir($dir);
  while (false !== ($entry = readdir($handle))) {
    if ($entry != "." && $entry != "..") {
      return FALSE;
    }
  }
  return TRUE;
 }
}
function getUserType()
{
	if(isset($_SESSION[KEYMODE]))
		{
			return $_SESSION[KEYMODE];	
		}
		else
		{
			return false;
		}
}

function getUser()
{
	if(isset($_SESSION[KEYID]))
		{
			$user = User::find_by_id($_SESSION[KEYID]);
			return $user;	
		}
		else
		{
			return false;
		}
}
function updateIsCurrent()
{
	$fiscals = Fiscalyear::find_all();
	foreach($fiscals as $fiscal)
	{
		$fiscal->is_current = 0;
		$fiscal->save();
	}
}

function getUserMode()
{
	$user = User::find_by_id($_SESSION['auth_id']);
	return $user->mode;
}

function generateCurrDate(){
	$cal = new Nepali_Calendar();
	$nepdate = $cal->eng_to_nep(date("Y", time()), date("m", time()), date("d", time()));
     $curr_date = $nepdate['year'].'-'.$nepdate['month'].'-'.$nepdate['date'];
     return $curr_date;
}
function DateNepToEng($nep_date)
{
	$cal = new Nepali_Calendar();
	$nep_date = explode("-",$nep_date);
	
	$eng_date = $cal->nep_to_eng($nep_date[0],$nep_date[1],$nep_date[2]);
	return $eng_date["year"]."-".$eng_date["month"]."-".$eng_date["date"];
	
}
function DateEngToNep($eng_date)
{
  if(empty($eng_date)){return "";}
  	$cal = new Nepali_Calendar();
	$eng_date = explode("-",$eng_date);
	
	$nep_date = $cal->eng_to_nep($eng_date[0],$eng_date[1],$eng_date[2]);
	return $nep_date["year"]."-".$nep_date["month"]."-".$nep_date["date"];
	
}
function alertBox($alert_msg, $redirect_link)
{
    $alert = '<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>';
    $alert .= '<script type="text/javascript">alert("'.$alert_msg.'");';
    if(!empty($redirect_link)):
    $alert .='window.location="'.$redirect_link.'";';
    endif; 
    $alert .='</script>;';
    return $alert;
}

function convert_date($date){

    $date = explode("-",$date);
    $final_date = '';
    $i=1;
    $count = count($date);
    foreach($date as $datestring)
    {
        if($i==$count){
            $final_date.= convertedNOs($datestring);    
        }
        else{
        $final_date.= convertedNOs($datestring)."/";
        }
        $i++;
    }
    return $final_date;

}
	function convertNos($nos)
{
    $n = '';
  switch($nos){
    case "०": $n = 0; break;
    case "१": $n = 1; break;
    case "२": $n= 2; break;
    case "३": $n = 3; break;
    case "४": $n = 4; break;
    case "५": $n = 5; break;
    case "६": $n = 6; break;
    case "७": $n = 7; break;
    case "८": $n = 8; break;
    case "९": $n = 9; break;
    case "0": $n = "०"; break;
    case "1": $n = "१"; break;
    case "2": $n = "२"; break;
    case "3": $n = "३"; break;
    case "4": $n = "४"; break;
    case "5": $n = "५"; break;
    case "6": $n = "६"; break;
    case "7": $n = "७"; break;
    case "8": $n = "८"; break;
    case "9": $n = "९"; break;
   }
   return $n;
}

 function convertedcit($string)
    {
        	$string = str_split($string);
        	$out = '';
        	foreach($string as $str)
        	{
        		if(is_numeric($str))
        		{
        			$out .= convertNos($str);	
        		}
        		else
        		{
        			$out .=$str;
        		}
        	}
        	return $out;

    }
    function convertedNos($num)
    {
        $str_num = preg_split('//u', ("". $num), -1); // not explode('', ("". $num))

            // For each item in your exploded string, retrieve the Nepali equivalent or vice versa.
            $out = '';
            $out_arr = array_map('convertNos', $str_num);
            $out = implode('', $out_arr);
            return $out;

    }
	function strip_zeros_from_date($marked_string)
	{
		// first remove the marked zeros
		$no_zeros=str_replace('*0','',$marked_string);
		// then remove any remaining marks
		$cleaned_string=str_replace('*','',$no_zeros);
		return $cleaned_string;
	}
	function strip_zeros_from_month($marked_string)
	{
		// first remove the marked zeros
		$new_string = '';
		$str_len = strlen($marked_string);
		for($i=0; $i<$str_len; $i++)
		{
			if($i==0 && $marked_string[$i]==0)
			{
				$marked_string[$i]='';
			}
			$new_string = $new_string.$marked_string[$i];
		}
		return $new_string;
	}
	function redirect_to($location=NULL)
	{
		if ($location != NULL)
		{
			?>
			 <script>window.location="<?php echo $location; ?>";</script>
			<?php	
		}
	}
	function output_message($message="")
	{
		if (!empty($message))
		{
			return"<p class=\"message\">{$message}</p>";
		}
		else 
		{
			return "";
		}
	}
	/*function __autoload($class_name)
	{
		$class_name = strtolower($class_name);
		$path = "../includes/{$class_name}.php";
		if (file_exists($path))
		{
			require_once($path);
		}
		else
		{
			die("The file {$class_name}.php could not be found.");
		}
	}
	*/	
	function log_action($action, $message="")
	{
		$logfile = SITE_ROOT.DS.'logs'.DS.'log.txt';
		$new = file_exists($logfile) ? false: true ;
		if ($handle = fopen($logfile, 'a'))//append
		{
			$timestamp = strftime("%Y-%m-%d %H:%M:%S" , time());
			$content = "{$timestamp} | {$action} | {$message}\n";
			fwrite($handle, $content);
			fclose($handle);
			if ($new)
			{
				chmod($logfile, 0755);
			}
			else
			{
				echo "could not open the log file for writing";
			}
		}
	}
	
	function datetime_to_text($datetime="")
	{
		$unixdatetime = strtotime($datetime);
		return strftime("%B %d, %Y at %I:%M %p", $unixdatetime);
	}
	function datetime_to_text_nosec($datetime="")
	{
		$unixdatetime = strtotime($datetime);
		return strftime("%B %d, %Y", $unixdatetime);
	}
	function randname($filename)
	{
		$name = explode(".", $filename);
		$ext_index_count = count($name)-1;
		$extension = $name[$ext_index_count];
		$firstname = time()*rand();
		$filename = $firstname.'.'.$extension;
		return $filename;
	}
	function mailto($to, $subject, $body, $link='')
	{
		//$to = $username;
		$body = "Your Registration has been processed. Please click the link below to activate your account with Uptown Cars: \r\n";
		$body.= $link;
		$headers = 'From: http://uniwebdesignusa.com/uptown';
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		$mail = mail($to, $subject, $body, $headers);
		return $mail;
	}
	
	function getStartEndDates($fiscal_id,$month)
{
        $month_range = new Nepali_Calendar();
        $month_get = $month;
        $fiscal_get = Fiscalyear::find_by_id($fiscal_id);
        $fiscal_array = explode(".", $fiscal_get->year);

   
        
    if($month_get==1||$month_get==2||$month_get==3)
    {
      $start_date_nepali = "2".$fiscal_array[1]."-".$month_get."-"."01";
      $year_get = intval($fiscal_array[1]);

      $month_get_strip = intval($month_get);
      $end_day = $month_range->month_date_range[$year_get][$month_get_strip];
      //$end_day = $month_range->month_date_range[strip_zeros_from_month($fiscal_array[1])] ;
      
      $end_date_nepali = "2".$fiscal_array[1]."-".$month_get."-".$end_day;
      $sel_year = "2".$fiscal_array[1];
    }
    else
    {
      //DateNepToEng(
      $start_date_nepali = $fiscal_array[0]."-".$month_get."-"."01";
      $year_get = intval($fiscal_array[0]);
      $year_get = substr($year_get,2,2);
      $month_get_strip = intval($month_get);
      $end_day = $month_range->month_date_range[$year_get][$month_get_strip];
      //$end_day = $month_range->month_date_range[strip_zeros_from_month($fiscal_array[1])] ;
      
      $end_date_nepali = $fiscal_array[0]."-".$month_get."-".$end_day;  
      $sel_year = $fiscal_array[0];
    }
      
    //echo $start_date_nepali." ".$end_date_nepali; exit;
     $start_date = DateNepToEng($start_date_nepali);
    $end_date  = DateNepToEng($end_date_nepali);
   $start_end_array = array($start_date,$end_date,$sel_year);
   return $start_end_array;
}
	
	
	function find_max_kharcha_or_dakhila_date()
 {
   global $database;
   $a=0;  
   $sql="select MAX(maag_date_english) as max_date from kharcha_mag_faram_1 limit 1";
   $result= $database->query($sql);
   $row= mysqli_fetch_object($result);
   $last_date = $row->max_date;
    return $last_date;
 }
        
        
        
        
        
        
        
 function get_item_rate($item_id,$category,$rate,$date)
        {
            global $database;
            $date = DateNepToEng($date);
            $a=0;
            $ress = array();
            $message='';
            $current_fiscal_id= Fiscalyear::find_current_id();
            $date_range = getStartEndDates($current_fiscal_id,4);
            $start_date = $date_range[0];
            $total_stock=0;
            $sql_stock    = "select * from item_stock where item_id='".$item_id."' and category='".$category."' and rate='".$rate."' limit 1";
            $item_stock_result = ItemStock::find_by_sql($sql_stock);
            if(empty($item_stock_result))
            {
                $a=1;
                $message = "स्टक मा सामान भेटिएन";
                
                
            }
            else
            {
                      $result_one_item    = array_shift($item_stock_result);
                      $previous_stock = $result_one_item->prev_stock;
                    //  echo $previous_stock;
                        $sql_dakhila = "select sum(a.qty) as qty from dakhila_item_details as a left join dakhila_profile as b on a.dakhila_id = b.id where a.item_id='".$item_id."'"
                                     . " and a.category='".$category."' and a.rate={$rate} and b.bill_type=1"
                                     . " and b.date_english>='".$start_date."' and b.date_english<='".$date."' ";
                           //echo $sql_dakhila;exit;
                        $result_dakhila  = $database->query($sql_dakhila);
                        $row_dakhila = mysqli_fetch_object($result_dakhila);
                       //   print_r($row_dakhila);exit;
                                if(!empty($row_dakhila))
                                {
                                   $dakhila_stock = $row_dakhila->qty;
                                }
                              else 
                                {
                                   $dakhila_stock=0;
                                }
                                 $sql_dakhila1 = "select sum(a.qty) as qty from dakhila_item_details as a left join dakhila_profile as b on a.dakhila_id = b.id where a.item_id='".$item_id."'"
                                     . " and a.category='".$category."' and a.rate_vat={$rate} and b.bill_type=2"
                                     . " and b.date_english>='".$start_date."' and b.date_english<='".$date."' ";
                                    $result_dakhila1  = $database->query($sql_dakhila1);
                                    $row_dakhila1 = mysqli_fetch_object($result_dakhila1);
                                     if(!empty($row_dakhila1))
                                        {
                                           $dakhila_stock1 = $row_dakhila1->qty;
                                        }
                                      else 
                                        {
                                           $dakhila_stock1=0;
                                        }
                                        
                                 $sql_hastantaran ="select sum(stock) as total from item_stock_department where item_id='".$item_id."' and category='".$category."' and rate={$rate}  and stock_date_english>='".$start_date."' and stock_date_english<='".$date."' "; 
                                 $result_hastantaran= $database->query($sql_hastantaran);
                                  $row_hastantaran= mysqli_fetch_object($result_hastantaran);
                                      if(!empty($row_hastantaran))
                                      {
                                         $hastantaran_add = $row_hastantaran->total;
                                      }
                                    else 
                                      {
                                         $hastantaran_add=0;
                                      }
                                 
                                   $dakhila_stock = $dakhila_stock + $dakhila_stock1 + $hastantaran_add;  
                                  $sql_kharcha= "select sum(a.qty) as qty from kharcha_mag_faram_2 as a left join kharcha_mag_faram_1 as b on a.maag_id = b.id where a.item_id='".$item_id."'"
                                                    . " and a.category='".$category."' and a.rate={$rate} "
                                                    . " and b.maag_date_english>='".$start_date."' and b.maag_date_english<='".$date."'";
                                      $result_kharcha = $database->query($sql_kharcha);
                                      $row_kharcha= mysqli_fetch_object($result_kharcha);
                                      if(!empty($row_kharcha))
                                      {
                                         $kharcha_stock = $row_kharcha->qty;
                                      }
                                    else 
                                      {
                                         $kharcha_stock=0;
                                      }
                                   $sql_kharcha_hastantaran= "select sum(a.quantity) as qty from hastantaran_second as a left join hastantaran_one as b on a.hastantaran_id = b.id where a.item_id='".$item_id."'"
                                                    . " and a.category='".$category."' and a.rate={$rate} "
                                                    . " and b.hastantaran_date_english>='".$start_date."' and b.hastantaran_date_english<='".$date."'";
                                      $result_kharcha_hastantaran = $database->query($sql_kharcha_hastantaran);
                                      $row_kharcha_hastantaran= mysqli_fetch_object($result_kharcha_hastantaran);
                                      if(!empty($row_kharcha_hastantaran))
                                      {
                                         $kharcha_stock_hastantaran = $row_kharcha_hastantaran->qty;
                                      }
                                    else 
                                      {
                                         $kharcha_stock_hastantaran=0;
                                      }    
                                      
                                  $sql_nilam = "select sum(actual_reduced_stock) as total from  jinsi_lilam_final where item_id='".$item_id."' and category='".$category."' and rate={$rate} and created_date_english>='".$start_date."' and created_date_english<='".$date."'";
                                  $result_nilam = $database->query($sql_nilam);
                                      $row_nilam= mysqli_fetch_object($result_nilam);
                                      if(!empty($row_nilam))
                                      {
                                         $total_nilam = $row_nilam->total;
                                      }
                                    else 
                                      {
                                         $total_nilam=0;
                                      } 
                                    $sql_minha = "select sum(actual_reduced_stock) as total from  jinsi_minha_final where item_id='".$item_id."' and category='".$category."' and rate={$rate} and created_date_english>='".$start_date."' and created_date_english<='".$date."'";
                                 //echo $sql_minha;exit;
                                    $result_minha = $database->query($sql_minha);
                                      $row_minha= mysqli_fetch_object($result_minha);
                                     // print_r($row_minha);
                                      if(!empty($row_minha))
                                      {
                                         $total_minha = $row_minha->total;
                                      }
                                    else 
                                      {
                                         $total_minha=0;
                                      }    
                                    //  echo $total_minha;
                                      
                                $total_stock = $previous_stock+$dakhila_stock-$kharcha_stock-$kharcha_stock_hastantaran-$total_nilam-$total_minha;
                               
             
            $ress[0]=$a;
            $ress[1]=$message;
            $ress[2]=$total_stock;
            $ress[4]=$sql_kharcha;
          return $ress;
          
          }
        }

	
	
      function check_item($item_id,$category,$stock,$rate,$date)
        {
            global $database;
            $a=0;
            $ress = array();
            $message='';
            $current_fiscal_id= Fiscalyear::find_current_id();
            $date_range = getStartEndDates($current_fiscal_id,4);
            $start_date = $date_range[0];
            $sql_stock    = "select * from item_stock where item_id='".$item_id."' and category='".$category."' and rate='".$rate."'";
            $item_stock_result = ItemStock::find_by_sql($sql_stock);
            if(empty($item_stock_result))
            {
                $a=1;
                $message = "स्टक मा सामान भेटिएन";
                
                
            }
            if(!empty ($item_stock_result))
            {
               $result_one_item = array_shift($item_stock_result);
             //  print_r($result_one_item);exit;
               
               if($result_one_item->stock < $stock)
               {
                   $a=1;
                   $message = "स्टक मा यो समान यो परिमाणमा उपलब्ध छैन | ";
                   
               }
               else
                {
                        $sql_kharcha= "select a.maag_date_english as date from kharcha_mag_faram_1 as a left join kharcha_mag_faram_2 as b on b.maag_id = a.id where b.item_id='".$item_id."'"
                                . " and b.category='".$category."' and b.rate={$rate}"
                                . " and a.maag_date_english>='".$start_date."' order by a.maag_date_english desc limit 1 ";
                        $result_kharcha  = $database->query($sql_kharcha);
                        $row_kharcha = mysqli_fetch_object($result_kharcha);
                        if(empty($row_kharcha->date))
                        {
                            $a=0;
                            $message="";
                        }
                        else 
                        {
                            $last_kharch_date = $row_kharcha->date;
                           // echo $last_kharch_date;exit;
                            if(strtotime($date) < strtotime($last_kharch_date))
                            {
                                $a=1;
                               // echo "here";exit;
                                $sql_kharcha_second= "select *  from kharcha_mag_faram_2 as a left join kharcha_mag_faram_1 as b on a.maag_id = b.id where a.item_id='".$item_id."'"
                                                    . " and a.category='".$category."' and a.rate={$rate}"
                                                    . " and b.maag_date_english>='".$date."'";
                                 $result_kharcha_second  = $database->query($sql_kharcha_second);
                                 $message.="यो मितीमा खर्च गर्न मिलेन \n"
                                         . " हलिएको मिती भन्दा पछि खर्च भएको विवरण \n";
                                 while($row_kharcha_second = mysqli_fetch_object($result_kharcha_second))
                                 {
                                      //print_r($row_kharcha_second);exit;
                                     $message.="मिती: ".convertedcit($row_kharcha_second->maag_date)." परिणाम: ".convertedcit($row_kharcha_second->qty)."खर्च माग फारम न:".convertedcit($row_kharcha_second->maag_id)." \n";
                                 }
                            }
                            else
                            {
                               $sql_dakhila = "select sum(a.qty) as qty from dakhila_item_details as a left join dakhila_profile as b on a.dakhila_id = b.id where a.item_id='".$item_id."'"
                                     . " and a.category='".$category."' and a.rate={$rate} and b.bill_type=1"
                                     . " and b.date_english>='".$start_date."' and b.date_english<='".$last_kharch_date."' ";
                           //echo $sql_dakhila;exit;
                        $result_dakhila  = $database->query($sql_dakhila);
                        $row_dakhila = mysqli_fetch_object($result_dakhila);
                       //   print_r($row_dakhila);exit;
                                if(!empty($row_dakhila))
                                {
                                   $dakhila_stock = $row_dakhila->qty;
                                }
                              else 
                                {
                                   $dakhila_stock=0;
                                }
                                 $sql_dakhila1 = "select sum(a.qty) as qty from dakhila_item_details as a left join dakhila_profile as b on a.dakhila_id = b.id where a.item_id='".$item_id."'"
                                     . " and a.category='".$category."' and a.rate_vat={$rate} and b.bill_type=2"
                                     . " and b.date_english>='".$start_date."' and b.date_english<='".$last_kharch_date."' ";
                                    //echo $sql_dakhila;exit;
                                    $result_dakhila1  = $database->query($sql_dakhila1);
                                    $row_dakhila1 = mysqli_fetch_object($result_dakhila1);
                                     if(!empty($row_dakhila1))
                                        {
                                           $dakhila_stock1 = $row_dakhila1->qty;
                                        }
                                      else 
                                        {
                                           $dakhila_stock1=0;
                                        }
                                   $dakhila_stock = $dakhila_stock + $dakhila_stock1;  
                                  // echo $dakhila_stock;exit;   
                             
                                       $sql_kharcha= "select sum(a.qty) as qty from kharcha_mag_faram_2 as a left join kharcha_mag_faram_1 as b on a.maag_id = b.id where a.item_id='".$item_id."'"
                                                    . " and a.category='".$category."' and a.rate={$rate} "
                                                    . " and b.maag_date_english>='".$start_date."' and b.maag_date_english<='".$last_kharch_date."'";
                                        //echo $sql_kharcha;exit;
                                      $result_kharcha = $database->query($sql_kharcha);
                                        //print_r($result_kharcha);exit;
                                      $row_kharcha= mysqli_fetch_object($result_kharcha);
                                     //print_r($row_kharcha_second);exit;
                                      if(!empty($row_kharcha))
                                      {
                                         $kharcha_stock = $row_kharcha->qty;
                                      // echo $kharcha_stock;exit;
                                      }
                                    else 
                                      {
                                         $kharcha_stock=0;
                                        // $row_dakhila= new Dakhilaprofile();
                                        // $a=0;
                                        //print_r($row_dakhila);exit;
                                      }
                                      
                                $total_stock = $dakhila_stock-$kharcha_stock;
                                if($total_stock < $stock)
                                {
                                    $a=1;
                                    $message="यो मिती मा यो सामान यो परिणाम मा खर्च गर्न मिल्दैन";
                                }
                                else
                                {
                                   $a=0;
                                }
                            }
                        }
               }
            
            $ress[0]=$a;
            $ress[1]=$message;
          return $ress;
          
          }
        }	

?>