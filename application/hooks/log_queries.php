<?php
// Name of Class as mentioned in $hook['post_controller]
function log_queries() {
    $CI =& get_instance();
    $times = $CI->db->query_times;
    foreach ($CI->db->queries as $key=>$query) {
        log_message('CUSTOM', "Query: ".$query." | ".$times[$key]);
    }
}
?>