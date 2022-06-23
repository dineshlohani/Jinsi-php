<?php
require_once("includes/initialize.php");
$workers = Workers::find_all();
$pads      = Pad::find_all();
$res = array();
$counter = $_POST['counter']+1;

 $html = '';
 $html .='<tr class="remove_ikai_row">';
 $html .='<td>'.convertedcit($counter).'</td>';
 $html .='<td>कर्मचारीको नाम</td>
        <td>
            <select required name="worker_id[]">
                <option value="">----</option>';
                foreach($workers as $worker):
                $html .='<option value="'.$worker->id.'">'.$worker->name.'</option>';
                 endforeach; 
           $html .=' </select>
        </td>
        <td>पद</td>
        <td>
            <select name="pad_id[]" required>
                <option value="">----</option>';
                foreach($pads as $pad):
                $html .='<option value="'.$pad->id.'">'.$pad->name.'</option>';
                endforeach;
           $html .=' </select>
        </td></tr>';
$res['html'] = $html;
echo json_encode($res); exit;