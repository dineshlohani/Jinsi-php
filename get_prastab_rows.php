<?php
require_once("includes/initialize.php");
$res = array();
$counter = $_POST['counter']+1;

 $html = '';
 $html .= '<tr class="remove_prastab_row">
                <td>प्रस्ताव नं '.convertedcit($counter).'</td>
                
                <td>
                    <textarea required rows="5" cols="75" name="description[]"></textarea>
                </td>
                <td>निर्णय नं '.convertedcit($counter).'</td>
                <td><textarea required rows="5" cols="75" name="decesion[]"></textarea></td>
         </tr>';
$res['html'] = $html;
echo json_encode($res); exit;