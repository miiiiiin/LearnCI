<?php
/**
 * Created by PhpStorm.
 * User: minsong-gyeong
 * Date: 2020-07-17
 * Time: 17:04
 */

class Board extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('board_m');
        $this->load->helper(array('url', 'date'));
    }

    //주소에서 메소드 생략되었을 때 실행되는 기본 메소드
    public function index() {
        $this->lists();
    }

    //헤더, 푸터 자동 추가
    //

    public function _remap($method) {
        //헤더
        $this->load->view('header_v');

        if (method_exists($this, $method)) {
            $this->{"{$method}"}();
        }

        //footer
        $this->load->view('footer_v');
    }

    //목록 불러오기

    public function lists() {
        $data['list'] = $this->board_m->get_list($this->uri->segment(3));
        $this->load->view('board/list_v', $data);
    }
}