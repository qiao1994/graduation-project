<?php
namespace Home\Model;
use Think\Model;
class SystemModel extends Model {
    /**
    * 滑动图数组
    */
    public $slider;

    /**
    * 自动完成
    */
    protected $_auto = array(
        array('slider_img','handleSilderImg', 3, 'callback'),
    );


    /**
    * 获取系统基本信息
    * @return $system array 系统信息
    */
    public function getSystem() {
        $system = $this->find();
        foreach (explode(';', $this->slider_img) as $slider) {
            $system['slider'][] = $slider;
        }
        unset($system['slider_img']);
        return $system;
    }

    /**
    * 处理滑动图
    */
    public function handleSilderImg() {
        $this->slider_img = implode(';', $this->slider);
    }
}