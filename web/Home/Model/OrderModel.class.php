<?php
namespace Home\Model;
use Think\Model;
class OrderModel extends Model {

    /**
    * 分页获取当前登录用户家的订单
    * @param intger $id  shopid
    * @return array 菜品
    */
    public function getOrderListByShop($id = 0) {
        if ($id == 0) {
            $id = D('shop')->getByUserId(session('seller')['id']);
        }
        $count = $this->where(['shop_id'=>$shopId])->count();// 查询满足要求的总记录数
        $page = new \Org\Util\AdminPage($count);// 实例化分页类 传入总记录数
        $show = $page->show();// 分页显示输出
        // 进行分页数据查询
        $list = $this->where(['shop_id'=>$shopId])->order('purchase_time desc')->limit($page->firstRow.','.$page->listRows)->select();
        //--补充用户信息
        foreach ($list as $key => $value) {
            $list[$key]['user'] = D('user')->getById($value['user_id']);
        }
        return array(
            'list'=>$list, 
            'page'=>$show,
        );
    }

    /**
    * 通过关键字查询订单
    * @param array $data 需要查询的关键字
    */
    public function getOrderByFind($data) {
        //查找是哪个关键字需要查找
        foreach ($data as $key => $value) {
            if ($value != '') {
                $findKey = $key;
                $findWord = $value;
                break;
            }
        }
        return $order = $this->where([$findKey=>$findWord])->select();
    }



}