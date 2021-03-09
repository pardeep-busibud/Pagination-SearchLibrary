<?php
class searching
{
    public $input;
    public $connection6;
    public $date_filter = array();
    public function __construct($input, $connection6)
    {
        $this->input = $input;
        $this->connection6 = $connection6;
    }
    public function get_query_and_data($query_data)
    {
        $email = '';
        $expert_and_company = array();
        $data = array();
        $input_new = $this->input;
        $string_query = '';
        $get_ids = array();
        $query_array = array();
        $date_btn = '';
        $this->date_filter['today'] = '';
        $this->date_filter['week_from'] = '';
        $this->date_filter['week_to'] = '';
        $this->date_filter['month_from'] = '';
        $this->date_filter['month_to'] = '';
        //var_dump($input_new);
        $pattern_date_btn = "/\b(today|last_week|last_month)\b/";
        if (preg_match_all($pattern_date_btn, $input_new, $output)) {
            $date_btn = $output[0][0];

        }
        if ($date_btn != '') {
            if ($date_btn == 'today') {
                $mydate = getdate(date("U"));
                $today = $mydate['year'] . '-' . $mydate['mon'] . '-' . $mydate['mday'];
                //var_dump($today);
                $this->date_filter['today'] = "" . $today . "";
                //echo "$mydate[year]-$mydate[mon]-$mydate[mday]";
            }
            if ($date_btn == 'last_week') {
                $date_from = date("Y-m-d", strtotime("last week monday"));
                //var_dump($date_from);

                //echo "<br><br>";
                $date_to = date("Y-m-d", strtotime("last week sunday"));
                //var_dump($date_to);
                $this->date_filter['week_from'] = "" . $date_from . "";
                $this->date_filter['week_to'] = "" . $date_to . "";

            }
            if ($date_btn == 'last_month') {
                $date_from = date("Y-m-d", strtotime("first day of previous month"));
                //var_dump($date_from);

                $date_to = date("Y-m-d", strtotime("last day of previous month"));
                //var_dump($date_to);
                $this->date_filter['month_from'] = "" . $date_from . "";
                $this->date_filter['month_to'] = "" . $date_to . "";
            }

        }
        $input_new = preg_replace($pattern_date_btn, '', $input_new);

        $pattern_email = "/\b[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}\b/";
        if (preg_match_all($pattern_email, $input_new, $output)) {
            $email = $output[0][0];
        }
        $input_new = preg_replace('/\b[\d]+\b/', '', $input_new);
        $input_new = preg_replace("/\b[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}\b/", '', $input_new);
        $pattern_string = "/\b[a-zA-Z_]+\b|\b\w*\d\w*\b/";
        if (preg_match_all($pattern_string, $input_new, $output)) {
            $name_ex_comp = $output[0];
            for ($i = 0; $i < sizeof($name_ex_comp); $i++) {
                array_push($expert_and_company, $name_ex_comp[$i]);
            }

        }
        $data['string'] = $expert_and_company;
        array_push($data['string'], $email);
        $data['email'] = $email;
        if ($data['string'][0] = '' and $data['email'] = '') {
            echo "string";
        }

        foreach ($query_data as $key => $value_q) {
            if (!empty($data['string'])) {
                if ($value_q['type'] == 'string') {
                    if (!empty($expert_and_company)) {
                        $attachment = array();
                        foreach ($expert_and_company as $key => $value) {
                            array_push($attachment, '' . $value_q['search_col_name'] . ' LIKE "%' . $value . '%"');
                        }
                        $append_string_in_sql = implode(' OR ', $attachment);
                        $query = 'SELECT ' . $value_q['get_colms'] . ' FROM ' . $value_q['table_name'] . ' WHERE ' . $append_string_in_sql . '';
                        array_push($query_array, $query);
                    }

                    array_push($get_ids, $value_q['get_id']);
                }
            }
            if (!empty($data['email'])) {
                if ($value_q['type'] == 'email') {
                    $query = 'SELECT ' . $value_q['get_colms'] . ' FROM ' . $value_q['table_name'] . ' WHERE ' . $value_q['search_col_name'] . '="' . $email . '"';
                    array_push($query_array, $query);
                    array_push($get_ids, $value_q['get_id']);
                }
            }

        }

        $data['sub_querys'] = $query_array;
        $data['get_ids'] = $get_ids;
        $string_query = implode(' UNION ', $query_array);
        $data['query'] = $string_query;
        return $data;
    }
    public function searching_data($ids_of_string)
    {

        $Date1 = '';
        $month = '';
        $year = '';
        $Final_date = '';
        $expert_and_company = array();
        $string_ids = 0;
        $append_call = '';
        $append_chat = '';
        $append_where_data = '';
        $pattern_date = "/\d{4}[-\/\.](\d{2}|\d{1})[-\/\.](\d{2}|\d{1})|(\d{2}|\d{1})[-\/\.](\d{2}|\d{1})[-\/\.]\d{4}|(\d{2}|\d{1})[-\/\.](\d{2}|\d{1})/";
        if (preg_match_all($pattern_date, $this->input, $matches_out)) {$date = $matches_out[0][0];
            //$new_date=split('[/.-]',$date);
            $new_date = preg_split('/[- :\/]/', $date);
            //var_dump($new_date);
            $length = strlen($date);
            if ($length <= 5) {
                $month = $new_date[0];
                $Date1 = $new_date[1];
                $year = '2019';
                if ($month > 12) {
                    $month = '';
                }
                if ($Date1 > 31) {
                    $Date1 = '';
                }

            } else {
                $year = $new_date[2];
                $month = $new_date[1];
                $Date1 = $new_date[0];
                if ($month > 12) {
                    $month = '';
                }
                if ($Date1 > 31) {
                    $Date1 = '';
                }
                if (strlen($new_date[0]) == 4) {
                    $year = $new_date[0];
                    $Date1 = $new_date[2];
                }

            }
            if ($Date1 == '' || $month == '') {
                echo json_encode("Invalid Date or month");
                die();
            } else {
                $Final_date = $year . "-" . $month . "-" . $Date1;

            }

        }

        $new_input = preg_replace('/\d{4}[-\/\.]\d{2}[-\/\.]\d{2}|\d{2}[-\/\.]\d{2}[-\/\.]\d{4}|\d{2}[-\/\.]\d{2}/', '', $this->input);
        //manu remove 08/06/20
        //$pattern_hid_eid="/\b[\d]+\b/";
        //manu remove 08/06/20
        //manu add 08/06/20
        $pattern_hid_eid = "/\b^\d+\b/";
        //manu added 08/06/20
        if (preg_match_all($pattern_hid_eid, $new_input, $matches_out)) {
            $string_ids = $matches_out[0][0];
            $string_ids = intval($string_ids);
        }

        $append_id = array();
        $append_string_id = array();
        foreach ($ids_of_string as $key => $value) {if ($string_ids != 0) {
            $exp_value = explode(',', $value);
            if ($value == '') {
                $value_id = "" . $string_ids . "";
                array_push($append_id, "table_name_" . $key . "." . $key . " IN (" . $value_id . ")");
            }

        }
            if ($value != '') {
                array_push($append_string_id, "table_name_" . $key . "." . $key . " IN (" . $value . ")");
            }
        }
        //if()
        if ($Final_date != 0) {
            array_push($append_string_id, "table_name_date.select_column LIKE '%" . $Final_date . "%'");

        }
        if ($this->date_filter['today'] != '') {

            array_push($append_string_id, "table_name_date.select_column LIKE '%" . $this->date_filter['today'] . "%'");
        }
        if ($this->date_filter['week_from'] != '') {

            array_push($append_string_id, "table_name_date.select_column BETWEEN '" . $this->date_filter['week_from'] . "' AND '" . $this->date_filter['week_to'] . "'");
        }
        if ($this->date_filter['month_from'] != '') {
            array_push($append_string_id, "table_name_date.select_column BETWEEN '" . $this->date_filter['month_from'] . "' AND '" . $this->date_filter['month_to'] . "'");
        }

        if (!empty($append_id)) {

            $append_where_data = implode(' OR ', $append_id);
            $append_where_data = '(' . $append_where_data . ')';
        }
        if (!empty($append_string_id)) {
            if ($append_where_data == '') {
                $append_where_data .= implode(' AND ', $append_string_id);
            } else {
                $append_where_data .= ' AND ' . implode(' AND ', $append_string_id);
            }

        }
        return $append_where_data;
    }

    public function get_ids($result, $string, $get_ids)
    {
        for ($i = 0; $i < sizeof($get_ids); $i++) {
            if (!isset($ids[$get_ids[$i]])) {
                $ids[$get_ids[$i]] = array();
            }
            foreach ($result as $key => $value) {
                if (isset($result[$key][$get_ids[$i]])) {
                    $ids[$get_ids[$i]][$key][$get_ids[$i]] = $result[$key][$get_ids[$i]];
                    $ids[$get_ids[$i]][$key]['name'] = $result[$key]['name'];
                }
            }

            $new_e_ids[$get_ids[$i]] = $this->string_ids($string, $ids[$get_ids[$i]], $type = $get_ids[$i]);

        }

        return $new_e_ids;

    }
    public function array_not_unique($raw_array)
    {
        $dupes = array();
        natcasesort($raw_array);
        reset($raw_array);
        $old_key = null;
        $old_value = null;
        foreach ($raw_array as $key => $value) {
            if ($value === null) {continue;}
            if (strcasecmp($old_value, $value) === 0) {
                $dupes[$old_key] = $old_value;
                $dupes[$key] = $value;
            }
            $old_value = $value;
            $old_key = $key;
        }
        return $dupes;
    }

    public function string_ids($expert_and_company, $string_ids, $type)
    {
        $ids = array();
        foreach ($expert_and_company as $key => $value1) {
            $value1 = strtolower($value1);
            $pattern = '(' . $value1 . ')';
            foreach ($string_ids as $key => $value) {
                if (preg_match_all($pattern, strtolower($string_ids[$key]['name']), $output)) {
                    array_push($ids, $string_ids[$key][$type]);
                }
            }
        }

        $common_stuff = $this->array_not_unique($ids);

        $unik_stuff = array_unique($common_stuff);

        $new_ids = array();
        if (!empty($common_stuff)) {
            foreach ($unik_stuff as $key => $value) {
                array_push($new_ids, $value);
            }

        } else {
            $new_ids = $ids;
        }

        $new_ids = implode(",", $new_ids);

        return $new_ids;
    }

}
