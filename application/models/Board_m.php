<?php
/**
 * Created by PhpStorm.
 * User: minsong-gyeong
 * Date: 2020-07-17
 * Time: 17:21
 */

class Board_m extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function get_list($table='ci_board', $type = '', $offset = '', $limit = '') {

        $limit_query = '';

        if ($limit != '' OR $offset != '') {
            //페이징이 있을 경우
            $limit_query = ' LIMIT ' .$offset.', '.$limit;

        }




        $sql = "SELECT * FROM ".$table." ORDER BY board_id DESC".$limit_query;
        $query = $this->db->query($sql);

        if ($type == 'count') {
            //전체 개시물 갯수 반환
            $result = $query->num_rows();
//            $this->db->count_all($table);
        } else {
            //게시물 리스트 반환
            $result = $query->result(); //객체배열
            //$result = $query->result_array(); //순수배열
        }

        return $result;
    }
}