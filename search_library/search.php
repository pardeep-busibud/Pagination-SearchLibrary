<?php 
class searching
{   
    public $input;
    public $connection6;
    public $date_filter=array();
    public function __construct($input,$connection6)
    {
        $this->input = $input;
        $this->connection6=$connection6;
    }
    public function get_query_and_data($query_data)
    {    
        $email='';
        $expert_and_company=[];
        $data=array();
        $input_new=$this->input;
        $get_ids=array();
        $query_array=array();
        $date_btn='';
        $this->date_filter['today']='';
        $this->date_filter['week_from']='';
        $this->date_filter['week_to']=''; 
        $this->date_filter['month_from']='';
        $this->date_filter['month_to']='';

        $pattern_date_btn="/\b(today|last_week|last_month)\b/";
        if(preg_match_all($pattern_date_btn, $input_new, $output) )
        {
            $date_btn=$output[0][0]; 
              
        }
        if ($date_btn!=='')
        {
            if($date_btn==='today')
            {
                $mydate=getdate(date("U"));
                $today=$mydate['year'].'-'.$mydate['mon'].'-'.$mydate['mday'];

                $this->date_filter['today']="".$today."";
            }
            if($date_btn==='last_week')
            {
                $date_from=date("Y-m-d", strtotime("last week monday"));

                $date_to=date("Y-m-d", strtotime("last week sunday"));

                $this->date_filter['week_from']="".$date_from."";
                $this->date_filter['week_to']="".$date_to."";

            }
            if ($date_btn==='last_month')
            {
                $date_from=date("Y-m-d", strtotime("first day of previous month"));
                $date_to= date("Y-m-d", strtotime("last day of previous month"));

                $this->date_filter['month_from']="".$date_from."";
                $this->date_filter['month_to']="".$date_to."";
            }
            
        }
        $input_new= preg_replace($pattern_date_btn, '', $input_new); 

        $pattern_email= "/\b[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}\b/";
        if(preg_match_all($pattern_email, $input_new, $output) )
        {
            $email=$input_new;
        }
        $input_new= preg_replace('/\b[\d]+\b/', '', $input_new);
        $data['string']=$expert_and_company;
        $data['email']=$email;

        foreach ($query_data as $value_q)
        {
            if(!empty($data['email']))
            {
                if ($value_q['type'] === 'email')
                {   
                    $query='SELECT '.$value_q['get_colms'].' FROM '.$value_q['table_name'].' WHERE '.$value_q['search_col_name'].'="'.$email.'"';
                    $query_array[] = $query;
                    $get_ids[] = $value_q['get_id'];
                }
            }
        }
           
        $data['sub_querys']=$query_array;
        $data['get_ids']=$get_ids;
        $string_query=implode(' UNION ', $query_array);
        $data['query']=$string_query;

        return $data;    
    }
    public function searching_data($ids_of_string)
    {
        $Final_date='';
        $string_ids=0;
        $append_where_data='';

        $new_input= preg_replace('/\d{4}[-\/\.]\d{2}[-\/\.]\d{2}|\d{2}[-\/\.]\d{2}[-\/\.]\d{4}|\d{2}[-\/\.]\d{2}/', '', $this->input);

        $pattern_hid_eid="/\b^\d+\b/";
        if (preg_match_all($pattern_hid_eid, $new_input, $matches_out)) 
        {   
            $string_ids=$matches_out[0][0];
            $string_ids=intval($string_ids);
        }
            
        $append_id=array();
        $append_string_id=array();
        foreach ($ids_of_string as $key => $value) 
        {   if($string_ids!==0)
            {
               $exp_value= explode(',', $value);
               if($value==='')
               {
                    $value_id="".$string_ids."";
                    $append_id[] = "table_name_" . $key . "." . $key . " IN (" . $value_id . ")";
               }
               
            }
            if($value!=='')
            {
               $append_string_id[] = "table_name_" . $key . "." . $key . " IN (" . $value . ")";
            }

        }

        if($Final_date!=0)
        {
           $append_string_id[] = "table_name_date.select_column LIKE '%" . $Final_date . "%'";

        }
        if($this->date_filter['today']!='')
        {

            $append_string_id[] = "table_name_date.select_column LIKE '%" . $this->date_filter['today'] . "%'";
        }
        if($this->date_filter['week_from']!='')
        {

            $append_string_id[] = "table_name_date.select_column BETWEEN '" . $this->date_filter['week_from'] . "' AND '" . $this->date_filter['week_to'] . "'";
        } 
        if($this->date_filter['month_from']!='')
        {
            $append_string_id[] = "table_name_date.select_column BETWEEN '" . $this->date_filter['month_from'] . "' AND '" . $this->date_filter['month_to'] . "'";
        }  

        if(!empty($append_id))
        {
        
            $append_where_data=implode(' OR ',$append_id);
            $append_where_data='('.$append_where_data.')';
        }
        if(!empty($append_string_id))
        {   
            if($append_where_data==='')
            {
                $append_where_data.=implode(' AND ',$append_string_id);
            }
            else
            {
                $append_where_data.=' AND '. implode(' AND ',$append_string_id);
            }
            
        } 
        return $append_where_data;
    }

    function get_ids($result,$string,$get_ids)
    {   
        for($i=0;$i<sizeof($get_ids);$i++)
        {   
           if(!isset($ids[$get_ids[$i]])) 
            {
                $ids[$get_ids[$i]] = array();
            }
            foreach($result as $key => $value)
            {
                if(isset($result[$key][$get_ids[$i]]))
                {   
                    $ids[$get_ids[$i]][$key][$get_ids[$i]]=$result[$key][$get_ids[$i]];
                    $ids[$get_ids[$i]][$key]['name']=$result[$key]['name'];
                }      
            } 

            $new_e_ids[$get_ids[$i]]=$this->string_ids($string,$ids[$get_ids[$i]],$type=$get_ids[$i]);
            
        }

        return $result;
         
    }
    function array_not_unique($raw_array) 
    {   
        $dupes = array();
        natcasesort($raw_array);
        reset($raw_array);
        $old_key   = NULL;
        $old_value = NULL;
        foreach ($raw_array as $key => $value) 
        {
            if ($value === NULL) { continue; }
            if (strcasecmp($old_value, $value) === 0) 
            {
                $dupes[$old_key] = $old_value;
                $dupes[$key]     = $value;
            }
            $old_value = $value;
            $old_key   = $key;
        }
        return $dupes;
    }

    function string_ids($expert_and_company,$string_ids,$type)
    {   
        $ids=array();
        foreach ($expert_and_company as $key => $value1)
        {   
            $value1=strtolower($value1);
            $pattern='('.$value1.')';
            foreach ($string_ids as $value)
            {  
               if(preg_match_all($pattern, strtolower($string_ids[$key]['name']), $output))
                {        
                    $ids[] = $string_ids[$key][$type];
                }
            }     
        }

        $common_stuff = $this->array_not_unique($ids);

        $unik_stuff=array_unique($common_stuff);

        $new_ids=[];
        if(!empty($common_stuff))
        {   
            foreach ($unik_stuff as $key => $value) 
            {
               $new_ids[] = $value;
            }
            
        }
        else
        {
            $new_ids=$ids;
        }

        $new_ids=implode(",",$new_ids);

        return $new_ids;
    }    
       
}
?>