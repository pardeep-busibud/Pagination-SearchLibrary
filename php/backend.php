<?php

require_once '../search_library/search.php';

require_once '../pagination1.0/prepared_query.php';

$application_obj = new ManageApp();

$connection_mock_chat = null;

$application_obj->Myconnection($connection_mock_chat, "localhost", "root", "kajal-task");
$table_heading_name = array('Name', 'Email', 'Phone Number', 'Gender');
$table_column_name = array('name', 'email', 'phoneNum', 'gender');
$where = 1;
if ($_POST['request'] == 'data') {
    global $connection_mock_chat;
    $buffer_range = json_decode($_POST['buffer_data']);
    $data_per_page = $_POST['data_per_page'];
    $input = $_POST['input_value'];
    $total_length = 0;
    $max_page = 0;
    $where = 1;
    $response_data = array();
    $total_data = $application_obj->total_data($connection_mock_chat, $buffer_range, $data_per_page, $where);
    $response_data['total_length'] = $total_data['total_length'];
    $response_data['total_data'] = $total_data['total_data'];
    $response_data['max_page'] = $total_data['max_page'];
    $response_data['table_heading_name'] = $table_heading_name;
    $response_data['table_column_name'] = $table_column_name;
    echo json_encode($response_data);
} elseif ($_POST['request'] == 'search') {
    global $connection_mock_chat;
    global $application_obj;
    $params = array();
    $buffer_range = json_decode($_POST['buffer_data']);
    $data_per_page = $_POST['data_per_page'];
    $input = $_POST['input_value'];
    $total_length = 0;
    $max_page = 0;
    $response_data = array();
    $obj = new searching($input, $connection_mock_chat);
    $keys = array('type', 'table_name', 'search_col_name', 'get_colms', 'get_id');
    $value = array(array('string', 'mock_test_tbl', 'name', 'null as name,id,null as email,null as phone,null as gender', 'id'),
        array('email', 'mock_test_tbl', 'email', 'null as name,id,null as email,null as phone,null as gender', 'id'));
    $query_data = array();

    foreach ($value as $key => $value1) {
        $query_details = array_combine($keys, $value1);
        array_push($query_data, $query_details);
    }
    $get_query_and_data = $obj->get_query_and_data($query_data);

    $result = array();

    if ($get_query_and_data['query'] != '') {
        $result = mysqli_prepared_query($connection_mock_chat, $get_query_and_data['query'], "", $params);
    }

    $get_ids = $obj->get_ids($result, $get_query_and_data['string'], $get_query_and_data['get_ids']);

    $where_data = $obj->searching_data($get_ids);

    $table_from = array("table_name_id", "table_name_email");
    $table1_to = array("mock_test_tbl", "mock_test_tbl");
    $tble1 = str_replace($table_from, $table1_to, $where_data);

    if ($tble1 == '') {
        $total_data = array();
        echo json_encode($total_data);
    } else {
        $where = $tble1;

        $total_data = $application_obj->total_data($connection_mock_chat, $buffer_range, $data_per_page, $where);
        $response_data['total_length'] = $total_data['total_length'];
        $response_data['total_data'] = $total_data['total_data'];
        $response_data['max_page'] = $total_data['max_page'];
        $response_data['table_heading_name'] = $table_heading_name;
        $response_data['table_column_name'] = $table_column_name;
        echo json_encode($response_data);
    }

}
class ManageApp
{

    public function MyConnection(&$connection, $host, $user, $db)
    {

        $host = 'localhost';

        $user = 'root';

        $password = '';

        $connection = mysqli_connect($host, $user, $password, $db);
        if (!$connection) {
            die("no connection found" . mysqli_error($connection));
        }

    }

    public function total_data($connection_mock_chat, $buffer_range, $data_per_page, $where)
    {
        $response_array = array();
        $max_page = 1;
        $test_length = 0;
        $response_array_data = array();
        foreach ($buffer_range as $key => $value) {
            $range = explode(',', $value);
            $page_from = (int) $range[0];
            $page_to = (int) $range[1];
            $data_from = $page_from * $data_per_page - $data_per_page;
            $data_to = $page_to - $page_from;
            $data_to = ($data_to * $data_per_page) + $data_per_page;
            $data = $this->get_data($connection_mock_chat, $data_from, $data_to, $data_per_page, $where);
            if (!empty($data)) {
                $max_page = $data[0]['max_page'];
                $from = 0;
                $to = 9;
                if ((int) $max_page < 5) {
                    $page_to = (int) $max_page;
                }
                if ($page_from > (int) $max_page) {
                    $page_from = (int) $max_page;
                }
                if ($page_to > (int) $max_page) {
                    $page_to = (int) $max_page;
                }
                $test_length = $data[0]['total_length'];
                $flage = $data_per_page;
                for ($i = $page_from; $i <= $page_to; $i++) {
                    if ($i * $data_per_page > $test_length) {
                        $to1 = $page_to * $data_per_page - $test_length;
                        $to = $to - $to1;
                    }
                    if ($flage > $test_length) {
                        $to = $test_length - 1;
                    }
                    $per_page_array = array();
                    for ($j = $from; $j <= $to; $j++) {
                        array_push($per_page_array, $data[$j]);

                    }
                    $response_array[$i] = $per_page_array;
                    $from = $from + $data_per_page;
                    $to = $to + $data_per_page;
                    $flage = $flage + $data_per_page;
                }

            }
            $response_array_data['total_length'] = $test_length;
            $response_array_data['max_page'] = $max_page;
            $response_array_data['total_data'] = $response_array;
        }
        return $response_array_data;
    }

    public function get_data($connection_mock_chat, $data_from, $data_to, $data_per_page, $where)
    {
        $response = array();
        $params = array();
        $max_page = '';
        $query = "SELECT COUNT(*)as total_row FROM mock_test_tbl WHERE " . $where;
        $total_row = mysqli_prepared_query($connection_mock_chat, $query, "", $params);
        $total_length = $total_row[0]['total_row'];
        $max_page = ceil($total_length / $data_per_page);

        $query = "SELECT * FROM mock_test_tbl WHERE " . $where . "  LIMIT ?,?";

        $params = array($data_from, $data_to);

        $extra_slots_entry = mysqli_prepared_query($connection_mock_chat, $query, "ii", $params);
        if ($extra_slots_entry) {
            foreach ($extra_slots_entry as $val) {
                $res_here = $val;
                $res_here['max_page'] = $max_page;
                $res_here['total_length'] = $total_length;
                $Name = $val['Name'];
                $Email = $val['Email'];
                $phoneNum = $val['Phone'];
                $Gender = $val['Gender'];
                $res_here['name'] = $Name;
                $res_here['email'] = $Email;
                $res_here['phoneNum'] = $phoneNum;
                $res_here['gender'] = $Gender;
                $response[] = $res_here;
            }
        }
        return $response;
    }

}
