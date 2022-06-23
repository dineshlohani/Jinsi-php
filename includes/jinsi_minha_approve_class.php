<?php
// if it's going to need the database, then it's
// probably smart to require it before we start
require_once('database.php');

class Jinsiminhaapprove
{
	protected static $table_name = "jinsi_minha_approve";
	protected static $db_fields = array('id','jinsi_minha_id','item_id','category','rate','prev_stock','stock_entry_date','stock_id','reduce_stock','current_analysed_rate','reason','created_date','created_date_english');
	public $id;
        public $jinsi_minha_id;
        public $item_id;
        public $category;
        public $prev_stock;
        public $stock_entry_date;
	public $stock_id;
        public $rate;
        public $reduce_stock;
	public $current_analysed_rate;
        public $reason;
        public $created_date;
        public $created_date_englsih;
        
        // Common database method
        public static function find_by_jinsi_minha_id($id)
	{
		global $database;
		$result_array=self::find_by_sql("select * from ".self::$table_name. " where jinsi_minha_id={$id} ");
		return $result_array;
	}
         public static function find_by_jinsi_minha_ids($id)
	{
		global $database;
		$result_array=self::find_by_sql("select * from ".self::$table_name. " where jinsi_minha_id={$id} limit 1");
		return !empty($result_array)? array_shift($result_array) : false;
	}
         public static function get_max_jinsi_minha_id()
        {
            global $database;
            $sql = "select max(jinsi_minha_id) from ".self::$table_name. " ";
            $result_set = $database->query($sql);
            $row = $database->fetch_array($result_set);
            return array_shift($row);
        }
	public static function find_all()
	{
		global $database;
		return self::find_by_sql("select * from ".self::$table_name);
		 	
	}
	public function getName($string_id="")
		{
		
				 $topic_selected = self::find_by_id($string_id);
				 return $topic_names = $topic_selected->name;   
		}
	public function getObjectsEmptyProperties()
	{
		$obj = new self;
		return $obj;
	}
        public function getDates()
        {
           $dates = array();
           $sql = "select distinct maag_date_english from ".self::$table_name;
           $result_array = self::find_by_sql($sql);
           foreach($result_array as $date_array)
           {
               array_push($dates, $date_array->maag_date_english);
           }
           return $dates; 
        }
	public static function find_by_id($id=0)
	{
		global $database;
		$result_array=self::find_by_sql("select * from ".self::$table_name. " where id={$id} limit 1");
		return !empty($result_array)? array_shift($result_array) : false;
	}
        public static function find_by_user_id($user_id=0)
	{
		global $database;
		$result_array=self::find_by_sql("select * from ".self::$table_name. " where user_id={$user_id} limit 1");
		return !empty($result_array)? array_shift($result_array) : false;
	}
	
        public function getLink($pagination){
            $link=$page_no='';
            $html=$per_page='';
            $total_pages=$pagination->total_pages();
             if($pagination->total_count>$per_page){
                if($pagination->has_previous_page()){//check if it has previous page function used from class
                    $prev_link='<a href="'.$link.'?page_no='.$pagination->previous_page().'">prev</a>';
                 }
                    else{
                        $prev_link="";
                    }
                    //check if it has next page function used from class
                        if($pagination->has_next_page()){
                        $next_link='<a href="'.$link.'?page_no='.$pagination->next_page().'">next</a>';
                        }
                    else{
                        $next_link="";
                    }
                    $html .= $prev_link;
                for($i=1;$i<=$total_pages;$i++){
                    if($i==$pagination->current_page){
                        $html.="<span style='color:red; background:black; padding-top:1px; padding-right:5px; padding-buttom:1px; padding-left:5px;'>".$pagination->current_page."</span>";
                    }
                    else{
                        $html.='<span> <a href="'.$link.'?page_no='.$i.'">'.$i.'</span>';


                    }
            }
        $html.=$next_link;
            }            
      return $html;      
}

	public  function savePostData($post)
	{
		foreach(self::$db_fields as $db_field)
		{
			if($db_field=="id")
			{
				continue;
			}
			if(property_exists($this, $db_field))
			{
				$this->$db_field= $post[$db_field];
			}
		}

		return $this->save();
	}
	public static function find_by_sql($sql="")
	{
		global $database;
		$result_set=$database->query($sql);
		$object_array = array();
		while ($row = $database->fetch_array($result_set))
		{
			$object_array[]= self::instantiate($row);
		}
		return $object_array;
	}
         public function set_page_query($page_no,$per_page,$link){
            global $pagination;
            $html='';
            $total_count=self::count_all();
            $pagination->set_pagination($page_no, $per_page, $total_count);
            $sql = "select * from ".self::$table_name." limit ".$pagination->per_page. " offset ".$pagination->offset();
             $result = self::find_by_sql($sql);
             $html=self::getLink($pagination);  
             $output=array();
             array_push($output, $html);
             array_push($output, $result);
            return $output;
        }
	public static function count_all()
	{
		global $database;
		$sql = "select count(*) from ".self::$table_name;
		$result_set = $database->query($sql);
		$row = $database->fetch_array($result_set);
		return array_shift($row);
	}
	public function resetAutoIncrement()
	{
		global $database;
		$max_count = self::count_all();
		$new_auto_val = $max_count++;
		$sql = 'ALTER TABLE '.self::$table_name.' AUTO_INCREMENT ='.$new_auto_val;
		$result = $database->query($sql);
	}
	public function getNextAutoIncrementValue()
	{
		global $database;
		self::resetAutoIncrement();
		$max_count = self::count_all();
		return $max_count+1;
		
	}
	private static function instantiate($record)
	{
		 // could check that $record exists and is an array
		 // simple, long form approach
		 $object= new self;
		/* $object->id			= $record['id'];
		 $object->username		= $record['username'];
		 $object->password 		= $record['password'];
		 $object->first_name 	= $record['first_name'];
		 $object->last_name 	= $record['last_name'];*/
		 
		 
		 // more dynamic, short-form approach:
		foreach($record as $attribute=>$value)
		{
			if ($object->has_attribute($attribute))
			{
				$object->$attribute=$value;
			}
		}
		return $object;
	}
	
	private function has_attribute($attribute)
	{
		// get_object_vars returns an associative array with all attributes
		// (incl. private ones!) as the keys and their current values as the value
		$object_vars = get_object_vars($this);
		// we don't care about the value, we just want to know if the key exists
		// will return true or false
		return array_key_exists($attribute, $object_vars);
	}
	protected function attributes()
	{
		// return an array of attribute keys and their values
		$attributes = array();
		foreach(self::$db_fields as $field)
		{
			if(property_exists($this, $field))
			{
				$attributes[$field] = $this->$field;
			}
		}
		return $attributes;
	}
	protected function sanitized_attributes()
	{
		global $database;
		$clean_attributes = array();
		// sanitize the values before submitting
		// note: does not alter the actual value of each attribute
		foreach($this->attributes() as $key => $value)
		{
			$clean_attributes[$key] = $database->escape_value($value);
		}
		return $clean_attributes;
	}
	public function save()
	{
		// a new record won't have an id yet
		return isset($this->id) ? $this->update() : $this->create();
	}
	public function create()
	{
		global $database;
		// dont forget sql syntax and good habits
		// insert into table ('key', 'key') values ('value', 'value')
		// single quotes around all values
		// escape all values to prevent sql injection
		$attributes = $this->sanitized_attributes();
		$sql = "insert into ". self::$table_name ."(";
		$sql .= join(",", array_keys($attributes));
		$sql .=") values ('";
		$sql .= join("', '", array_values($attributes));
		$sql .= "')";
                if ($database->query($sql))
		{
			$this->id = $database->insert_id();
			return $this->id;
		}
		else 
		{
			return false;
		}
	}
	
	public function update()
	{
		global $database;
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		foreach ($attributes as $key => $value)
		{
			$attribute_pairs[] = "{$key}='{$value}'";
		}
		$sql = "update ".self::$table_name." set ";
		$sql .= join(", ", $attribute_pairs);
		$sql .= "where id=".$database->escape_value($this->id);
		$database->query($sql);
		return ($database->affected_rows() ==1)? true : false;
	}
	
	public function delete()
	{
		global $database;
		// delete from table where condition limit 1
		$sql = "delete from " .self::$table_name ;
		$sql .= " where id=".$database->escape_value($this->id);
		$sql .= " limit 1";
		$database->query($sql);
		return ($database->affected_rows() == 1) ? true : false;
	}	
       
}

?>