<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 联系人管理
 */
class yonghu extends CI_Controller {

    // 以用户id查询
    function find() {
        date_default_timezone_set("Asia/Shanghai");
        $id = $this->input->get('yonghuid');
        $query = $this->db->get_where('yonghu', array('id' => $id));
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                //echo json_encode($row);
                $callback = $this->input->get('callback');
                echo $callback."('".json_encode($row)."')";
            }
        } else {
            echo 'false';
        }
    }

    function update() {
        date_default_timezone_set("Asia/Shanghai");
        $yonghu = json_decode($this->input->get('yonghu'));
        $data = new stdClass();
        $data->xingming = $yonghu->xingming;
        $data->shoujihaoma = $yonghu->shoujihaoma;
        $id = $yonghu->id;
        $this->db->update('yonghu', $data, array('id' => $id));
        //echo $this->db->affected_rows();
        $callback = $this->input->get('callback');
        echo $callback."('".$this->db->affected_rows()."')";
    }
    // 发短信
    function duanxin() {
        date_default_timezone_set("Asia/Shanghai");
        $this->load->library('code');
        $code = rand() % 100000;
        $name = $this->input->get('name');
        $tel = $this->input->get('tel');
        $this->load->library('myalidayu');
        $result = $this->myalidayu->YanZhengMa($code, $name, $tel);
        if ($result == true) {
            $this->load->library('session');
            $this->session->set_userdata('yanzheng', $code);
            //echo 'true';
            $callback = $this->input->get('callback');
            //echo $callback."('".'true'."')";
            echo $callback."('true')";
            die();
        } else {
            echo 'false';
        }
    }
    // 验证短信
    function yanzheng() {
        $this->load->library('session');
        date_default_timezone_set("Asia/Shanghai");
        $code1 = $this->session->userdata('yanzheng');
        $code2 = $this->input->get('code');
        if ($code1 == $code2) {
            $this->session->unset_userdata('yanzheng');
            //echo 'true';
            $callback = $this->input->get('callback');
            //echo $callback."('".'true'."')";
            echo $callback."('true')";
        } else {
            echo 'false';
        }
    }

    //三方注册
    function sanfangzhuce() {
        $yonghu = json_decode($this->input->get('yonghu'));
        $sf = $this->input->get('sf');
        
        $zhucelaiyuan = $this->config->item('注册来源');
        $sf = array_search($sf, $zhucelaiyuan);
        
        // 判断是否存在      
        $name = $yonghu->xingming;
        $tel = $yonghu->shoujihaoma;
        $sql ="select m.id as id, m.xingming as xingming, m.shoujihaoma as shoujihaoma from yonghu as m where xingming = ? and shoujihaoma = ? and zhucelaiyuan = ?";
        $re = $this->db->query($sql, array($name, $tel, $sf));
        $res = $re->row();
        if (!empty($res)) {
            echo json_encode($res);
            die();
        }
        $data = new stdClass();
        $data->xingming = $yonghu->xingming;
        $data->shoujihaoma = $yonghu->shoujihaoma;
        $data->zhanghu = $yonghu->shoujihaoma;
        $data->mima = $yonghu->shoujihaoma;
        $data->zhuceriqi = date("Y-m-d H:i:s", time());
        $data->zhucelaiyuan = $sf;
        $this->db->insert('yonghu', $data);
        $id = $this->db->insert_id();
        var_dump($id);
        if ($id > 0) {
            $sql ="select m.id as id, m.xingming as xingming, m.shoujihaoma as shoujihaoma from yonghu as m where id = ?";
            $re = $this->db->query($sql, array($id));
            $rel = $re->row();
            if (!empty($rel)) {
                //echo json_encode($rel);
                $callback = $this->input->get('callback');
                echo $callback."('".json_encode($rel)."')";
                return;
            }
        } else {
            echo 'false';
        }
    }

}