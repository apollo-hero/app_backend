<?php

class Search_model extends CI_Model {

    public function get_category_list($params) {
        $WHERE = " WHERE 1 ";
        $search_column = isset($params['search_column']) ? trim($params['search_column']) : '';
        $search_text = isset($params['search_text']) ? trim($params['search_text']) : '';
        if (isset($params['from_date']) && $params['from_date'] != "") {
            $WHERE .= " AND date_format(u.category_created_date,'%Y-%m-%d') >= '" . $params['from_date'] . "'";
        }
        if (isset($params['to_date']) && $params['to_date'] != "") {
            $WHERE .= " AND date_format(u.category_created_date,'%Y-%m-%d') <= '" . $params['to_date'] . "'";
        }
        if ($search_column != "" && $search_text != "") {
            $WHERE .= " AND (".$search_column." LIKE '%" . $search_text . "%')";
           
        } 
        else if ($search_text != "") {
            $WHERE .= " AND  (".$search_column." LIKE '%" . $search_text . "%')";
        }
        $limit_b = 0;
        $limit_e = $params['record_per_page'];
        $page = $params['page'];
        // count query                        
        $sql_count_query = " SELECT  count(*) as total_rows  FROM  " . TABLE_CATEGORY . " u  $WHERE ";
        $query = $this->db->query($sql_count_query);
        $count_result = $query->result_array();
        if (count($count_result) > 0) {
            $total_rows = $count_result[0]['total_rows'];
        } else {
            $total_rows = 0;
        }
        if (fmod($total_rows, $limit_e) == 0)
            $num_pages = floor($total_rows / $limit_e);
        else
            $num_pages = floor($total_rows / $limit_e) + 1;

        $limit_b = ($limit_e * ($page - 1));

        $sortcolumn = "u.category_id";
        $sortorder = "desc";

        if (isset($params['sort_by']) && $params['sort_by'] != "") {
            $sortcolumn = $params['sort_by'];
            $sortorder = isset($params['sort_order']) && $params['sort_order'] != "" ? $params['sort_order'] : 'ASC';
        }
        $order_by = "order by $sortcolumn $sortorder";
        $sql_list_query = "SELECT u.* FROM " .TABLE_CATEGORY. " u  $WHERE    $order_by LIMIT $limit_b,$limit_e";
        $query = $this->db->query($sql_list_query);
        $rows = $query->result_array();
        return array('records' => $rows, 'num_of_pages' => $num_pages, 'total_records' => $total_rows);
    }

    public function get_items_list($params) {
        $WHERE = " WHERE 1 ";
        $search_column = isset($params['search_column']) ? trim($params['search_column']) : '';
        $search_text = isset($params['search_text']) ? trim($params['search_text']) : '';
        if (isset($params['from_date']) && $params['from_date'] != "") {
            $WHERE .= " AND date_format(u.item_created_date,'%Y-%m-%d') >= '" . $params['from_date'] . "'";
        }
        if (isset($params['to_date']) && $params['to_date'] != "") {
            $WHERE .= " AND date_format(u.item_created_date,'%Y-%m-%d') <= '" . $params['to_date'] . "'";
        }
        if ($search_column != "" && $search_text != "") {
            $WHERE .= " AND (".$search_column." LIKE '%" . $search_text . "%')";
           
        } 
        else if ($search_text != "") {
            $WHERE .= " AND  (".$search_column." LIKE '%" . $search_text . "%')";
        }
        $limit_b = 0;
        $limit_e = $params['record_per_page'];
        $page = $params['page'];
        // count query                        
        $sql_count_query = " SELECT  count(*) as total_rows  FROM  " . TABLE_ITEM . " u  $WHERE ";
        $query = $this->db->query($sql_count_query);
        $count_result = $query->result_array();
        if (count($count_result) > 0) {
            $total_rows = $count_result[0]['total_rows'];
        } else {
            $total_rows = 0;
        }
        if (fmod($total_rows, $limit_e) == 0)
            $num_pages = floor($total_rows / $limit_e);
        else
            $num_pages = floor($total_rows / $limit_e) + 1;

        $limit_b = ($limit_e * ($page - 1));

        $sortcolumn = "u.category_id";
        $sortorder = "desc";

        if (isset($params['sort_by']) && $params['sort_by'] != "") {
            $sortcolumn = $params['sort_by'];
            $sortorder = isset($params['sort_order']) && $params['sort_order'] != "" ? $params['sort_order'] : 'ASC';
        }
        $order_by = "order by $sortcolumn $sortorder";
        $sql_list_query = "SELECT u.* FROM " .TABLE_ITEM. " u  $WHERE    $order_by LIMIT $limit_b,$limit_e";
        $query = $this->db->query($sql_list_query);
        $rows = $query->result_array();
        return array('records' => $rows, 'num_of_pages' => $num_pages, 'total_records' => $total_rows);
    }

    public function get_user_list($params) {
        $WHERE = " WHERE 1 ";
        $search_column = isset($params['search_column']) ? trim($params['search_column']) : '';
        $search_text = isset($params['search_text']) ? trim($params['search_text']) : '';
        if (isset($params['from_date']) && $params['from_date'] != "") {
            $WHERE .= " AND date_format(u.user_created_date,'%Y-%m-%d') >= '" . $params['from_date'] . "'";
        }
        if (isset($params['to_date']) && $params['to_date'] != "") {
            $WHERE .= " AND date_format(u.user_created_date,'%Y-%m-%d') <= '" . $params['to_date'] . "'";
        }
        if ($search_column != "" && $search_text != "") {
            $WHERE .= " AND (".$search_column." LIKE '%" . $search_text . "%')";
           
        } 
        else if ($search_text != "") {
            $WHERE .= " AND  (".$search_column." LIKE '%" . $search_text . "%')";
        }
        $limit_b = 0;
        $limit_e = $params['record_per_page'];
        $page = $params['page'];
        // count query                        
        $sql_count_query = " SELECT  count(*) as total_rows  FROM  " . TABLE_GCM_USERS . " u  $WHERE ";
        $query = $this->db->query($sql_count_query);
        $count_result = $query->result_array();
        if (count($count_result) > 0) {
            $total_rows = $count_result[0]['total_rows'];
        } else {
            $total_rows = 0;
        }
        if (fmod($total_rows, $limit_e) == 0)
            $num_pages = floor($total_rows / $limit_e);
        else
            $num_pages = floor($total_rows / $limit_e) + 1;

        $limit_b = ($limit_e * ($page - 1));

        $sortcolumn = "u.gcm_user_id";
        $sortorder = "desc";

        if (isset($params['sort_by']) && $params['sort_by'] != "") {
            $sortcolumn = $params['sort_by'];
            $sortorder = isset($params['sort_order']) && $params['sort_order'] != "" ? $params['sort_order'] : 'ASC';
        }
        $order_by = "order by $sortcolumn $sortorder";
        $sql_list_query = "SELECT u.* FROM " .TABLE_GCM_USERS. " u  $WHERE    $order_by LIMIT $limit_b,$limit_e";
        $query = $this->db->query($sql_list_query);
        $rows = $query->result_array();
        return array('records' => $rows, 'num_of_pages' => $num_pages, 'total_records' => $total_rows);
    }

    public function get_session_list($params) {
        $WHERE = " WHERE 1 ";
        $search_column = isset($params['search_column']) ? trim($params['search_column']) : '';
        $search_text = isset($params['search_text']) ? trim($params['search_text']) : '';
        if (isset($params['from_date']) && $params['from_date'] != "") {
            $WHERE .= " AND date_format(u.timestamp,'%Y-%m-%d') >= '" . $params['from_date'] . "'";
        }
        if (isset($params['to_date']) && $params['to_date'] != "") {
            $WHERE .= " AND date_format(u.timestamp,'%Y-%m-%d') <= '" . $params['to_date'] . "'";
        }
        if ($search_column != "" && $search_text != "") {
            $WHERE .= " AND (".$search_column." LIKE '%" . $search_text . "%')";
           
        } 
        else if ($search_text != "") {
            $WHERE .= " AND  (".$search_column." LIKE '%" . $search_text . "%')";
        }
        $limit_b = 0;
        $limit_e = $params['record_per_page'];
        $page = $params['page'];
        // count query                        
        $sql_count_query = " SELECT  count(*) as total_rows  FROM  " . TABLE_SESSION . " u  $WHERE ";
        $query = $this->db->query($sql_count_query);
        $count_result = $query->result_array();
        if (count($count_result) > 0) {
            $total_rows = $count_result[0]['total_rows'];
        } else {
            $total_rows = 0;
        }
        if (fmod($total_rows, $limit_e) == 0)
            $num_pages = floor($total_rows / $limit_e);
        else
            $num_pages = floor($total_rows / $limit_e) + 1;

        $limit_b = ($limit_e * ($page - 1));

        $sortcolumn = "u.session_id";
        $sortorder = "desc";

        if (isset($params['sort_by']) && $params['sort_by'] != "") {
            $sortcolumn = $params['sort_by'];
            $sortorder = isset($params['sort_order']) && $params['sort_order'] != "" ? $params['sort_order'] : 'ASC';
        }
        $order_by = "order by $sortcolumn $sortorder";
        $sql_list_query = "SELECT u.* FROM " .TABLE_SESSION. " u  $WHERE    $order_by LIMIT $limit_b,$limit_e";
        $query = $this->db->query($sql_list_query);
        $rows = $query->result_array();
        return array('records' => $rows, 'num_of_pages' => $num_pages, 'total_records' => $total_rows);
    }
}
