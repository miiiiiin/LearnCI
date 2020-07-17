<?php
/**
 * Created by PhpStorm.
 * User: minsong-gyeong
 * Date: 2020-07-17
 * Time: 17:21
 */

class board_m extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function get_list($table='ci_board') {
        $sql = "SELECT * FROM ".$table." ORDER BY board_id DESC";
        $query = $this->db->query($sql);
        $result = $query->result(); //객체배열
        //$result = $query->result_array(); //순수배열

        return $result;
    }
}