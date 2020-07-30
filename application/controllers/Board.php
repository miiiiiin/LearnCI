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

        //페이지네이션 라이브러리 로딩
        $this->load->library('pagination');

        //페이지네이션 설정
        $config['base_url'] = 'LearnCI/board/lists/ci_board/page'; //paging address
        $config['total_rows'] = $this->board_m->get_list($this->uri->segment(3), 'count');//게시물 전체 개수
        $config['per_page'] = 5; //페이지당 게시물 수
        $config['uri_segment'] = 5; //페이지 번호가 위치한 세그먼트


        //페이지네이션 초기화
        $this->pagination->initialize($config);
        //페이징 링크 생성,view에서 사용할 변수에 할당
        $data['pagination'] = $this->pagination->create_links();

        $page = $this->uri->segment(5, 1);

        if ($page > 1) {
            $start = (($page/$config['per_page'])) * $config['per_page'];
        } else {
            $start = ($page - 1) * $config['per_page'];
        }

        $limit = $config['per_page'];


//        $data['list'] = $this->board_m->get_list($this->uri->segment(3));

        $data['list'] = $this->board_m->get_list($this->uri->segment(3), '', $start, $limit);
        $this->load->view('board/list_v', $data);

    }
}