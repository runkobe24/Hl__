﻿<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 乘客管理
 */
class passenger extends CI_Controller {
 
    // 算 年龄 时间戳
    public function age($birthday) {
        $age = strtotime($birthday);
        if ($age === false) {
              return false;
        }
        list($y1, $m1, $d1) = explode("-", date("Y-m-d", $age));
        $now = strtotime("now");
        list($y2, $m2, $d2) = explode("-", date("Y-m-d", $now));
        $age = $y2 - $y1;
        if ((int) ($m2 . $d2) < (int) ($m1 . $d1))
            $age -= 1;
        return $age;
    }

    public function select(){
		$callback = $this->input->get('callback');
        date_default_timezone_set("Asia/Shanghai");
        $zhengjianleixing = $this->config->item('证件类型');
        $yonghuid = $this->input->get('yonghuid');
        $sql = "select m.id as id, m.yonghuid as yonghuid,m.shifouertong as shifouertong, m.zhongwenming as zhongwenming,m.chushengriqi as chushengriqi, m.zhengjianleixing as zhengjianleixing, m.zhengjianhaoma as zhengjianhaoma, m.shoujihao as shoujihao, m.yingwenming as yingwenming, m.xingbie as xingbie, m.guoji as guoji, m.zhengjianyouxiaoqi as zhengjianyouxiaoqi, m.chushengdi as chushengdi, m.lianxidianhua as lianxidianhua, m.email as email from lvke as m where yonghuid = ?";
        $query = $this->db->query($sql ,array($yonghuid));
        $passenger = $query->result();
        if(!empty($passenger)){
            foreach ($passenger as $k => $row){
                foreach ($zhengjianleixing as $k1 => $v1) {
                    if ($row->zhengjianleixing == $k1) {
                        $passenger[$k]->zhengjianleixing = $zhengjianleixing[$k1];
                    }
                }
                   $row->type = $row->shifouertong;
				   $row->chushengriqi = date("Y-m-d",strtotime( $row->chushengriqi));
//                $age = $this->age($row->chushengriqi);

//                if ($age >= 12) {
//                    $row->type = 0;
//                } else {
//                    $row->type = 1;
//                }
                $row->chk = false;
                $row->isNew = false;
                $row->isDelte = false;
                $row->isEdit = false;
            }
            echo $callback . "(" . json_encode($data) . ")"
            die();
        }  else {
           echo $callback . "(false)";
        }

   }

    public function trainSelect(){
		$callback = $this->input->get('callback');
        date_default_timezone_set("Asia/Shanghai");
        $zhengjianleixing = $this->config->item('火车证件类型');
        $yonghuid = $this->input->get('yonghuid');
        $sql = "select m.id as id, m.yonghuid as yonghuid, m.user_name as user_name, m.ids_type as ids_type, m.user_ids as user_ids, m.ticket_type as ticket_type ,m.Audit as Audit from train_lvke as m where yonghuid = ?";
        $query = $this->db->query($sql ,array($yonghuid));
        $passenger = $query->result();

        if(!empty($passenger)){
            foreach ($passenger as $k => $row){
                foreach ($zhengjianleixing as $k1 => $v1) {
                    if ($row->ids_type == $k1) {
                        $passenger[$k]->ids_type = $zhengjianleixing[$k1];
                    }
                }
                $row->chk = false;
                $row->isNew = false;
            }
            echo $callback . "(" . json_encode($data) . ")";
            die();
        }  else {
            echo $callback . "(false)";
        }

   }

   /**
    * 火车-乘客增加与编辑
    */

    public function trainAdd (){
		    $callback = $this->input->get('callback');
            date_default_timezone_set("Asia/Shanghai");           
            $passenger = json_decode ( $this->input->get('passenger'));
            $id = $passenger->id;
            $yonghuid = $passenger->yonghuid;
            $user_name = $passenger->user_name;
            $ticket_type = $passenger->ticket_type;
            $ids_type = $passenger->ids_type;
            $user_ids = $passenger->user_ids;

            $data = new stdClass();
            $data->yonghuid = $yonghuid;
            $data->user_name = $user_name;
            $data->ticket_type = $ticket_type;
			$data->user_ids = $user_ids;
			
            $zhengjianleixing = $this->config->item('火车证件类型');
			$ids_type = array_search($ids_type, $zhengjianleixing);
			$data->ids_type = $ids_type;

			$ids_type = (string)$ids_type;

            //是否认认证
            $Audit = $this->VerifyUsers($user_name, $ids_type, $user_ids);
            $data->Audit = $Audit;
            if ($id > 0) {
                $this->db->where('id', $id);
                $this->db->update('train_lvke', $data);
               echo $callback . "(" . $this->db->affected_rows() . ")";
            } else {

                $str = $this->db->insert('train_lvke', $data);
                echo $callback . "(" . $this->db->affected_rows() . ")";
            }

   }


   /**
    * 12306 身份认证
    * 
    * @param name string 姓名
    * @param type string 证件类型
    * @param ids  string 证件号码
    * 
    * @return int
    */
    public function VerifyUsers($name, $type, $ids) {
        $callback = $this->input->get('callback');
        $this->load->library('yi19');

       $obj = new stdClass();
       $obj->ids_type = $type;
       $obj->user_ids = $ids;
       $obj->user_name = $name;
       $lst[] = $obj;

       $re = $this->yi19->VerifyUsers($lst);
       $res = json_decode($re);
       if ($res->return_code == '000') {
            return 1;
       } else {
            return 0;
       }
    }
    // function test(){
    //     $name ="高晓凯";
    //     $type ="41048219900520113X";
    //     $ids ="1";
    //    $resss =  $this->VerifyUsers($name, $type, $ids);
    //    $resss = json_decode($resss);
    //    var_dump($resss);
    //    echo $resss;
    // }

}
