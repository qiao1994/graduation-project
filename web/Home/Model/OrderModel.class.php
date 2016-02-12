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
            $id = D('shop')->getByUserId(session('seller')['id'])['id'];
        }
        $count = $this->where(['shop_id'=>$id])->count();// 查询满足要求的总记录数
        $page = new \Org\Util\AdminPage($count);// 实例化分页类 传入总记录数
        $show = $page->show();// 分页显示输出
        // 进行分页数据查询
        $list = $this->where(['shop_id'=>$id])->order('purchase_time desc')->limit($page->firstRow.','.$page->listRows)->select();
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
    * 分页获取订单
    * @param intger $id  shopid
    * @return array 菜品
    */
    public function getOrderList() {
        $count = $this->count();// 查询满足要求的总记录数
        $page = new \Org\Util\AdminPage($count);// 实例化分页类 传入总记录数
        $show = $page->show();// 分页显示输出
        // 进行分页数据查询
        $list = $this->order('purchase_time desc')->limit($page->firstRow.','.$page->listRows)->select();
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

    /**
    * 统计订单
    * @param string $startDate
    * @param string $endDate
    * @param intger $goodsId
    * @param intger $shopId
    * @return array $statisticsData
    */
    public function getStatistics($startDate = '', $endDate ='', $goodsId = 0, $shopId = 0) {
        //--初始化日期参数
        if ($startDate == '') {
            $startDate = date('Y-m-d');
        }
        if ($endDate == '') {
            $endDate = date('Y-m-d', strtotime("+1 day"));
        }
        //--获取统计信息
        $statisticsData['startDate'] = $startDate;
        $statisticsData['endDate'] = $endDate;
        $statisticsData['goodsId'] = $goodsId;
        $statisticsData['shopId'] = $shopId;
        $startDate = strtotime($startDate);
        $endDate = strtotime($endDate);
        $map['purchase_time'] = ['gt', $startDate];
        $map_1['purchase_time'] = ['lt', $entDate];
        $where = 'purchase_time > '.$startDate.' AND purchase_time < '.$endDate;
        if ($goodsId != 0) {
            //--统计指定菜品订单信息
            $goods = D('Goods')->getById($goodsId);
            $statisticsData['goodsName'] = $goods['name'];
            $statisticsData['orderNumber'] = D('order')->where($where)->where(['goods_id'=>$goodsId])->count();
            $statisticsData['orderAmount'] = D('order')->where($where)->where(['goods_id'=>$goodsId])->sum('binary amount');
        } else if ($shopId != 0) {
            //--统计当前店铺的所有订单
            $shop = D('Shop')->getById($shopId);
            $statisticsData['goodsName'] = $shop['name'].'的所有菜品';
            $statisticsData['orderNumber'] = D('order')->where($where)->where(['shop_id'=>$shopId])->count();
            $statisticsData['orderAmount'] = D('order')->where($where)->where(['shop_id'=>$shopId])->sum('binary amount');
        } else {
            //--统计所有店铺订单信息
            $statisticsData['goodsName'] = '所有店铺的所有菜品';
            $statisticsData['orderNumber'] = D('order')->where($where)->count();
            $statisticsData['orderAmount'] = D('order')->where($where)->sum('binary amount');
        }
        return $statisticsData;
    }


}