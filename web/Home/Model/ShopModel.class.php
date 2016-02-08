<?php
namespace Home\Model;
use Think\Model;
class ShopModel extends Model {

    protected $_validate = array(
        array('name', 'require', '店铺名称必须填写'),
        array('address', 'require', '店铺地址必须填写'),
        array('tel', 'require', '店铺电话必须填写'),
        array('introduction', 'require', '店铺简介必须填写'),
    );

    /**
    * 注册
    * @param array $data 注册信息
    */
    public function shopRegister($data) {
        $ret = $this->create($data);
        if ($ret) {
            $id = $this->add();
            return array(
                'ret'=>$id,
                'msg'=>$this->getError(),
            );
        } else {
            return array(
                'ret'=>false,
                'msg'=>$this->getError(),
            );
        }
    }

    /**
    * 获取推荐的店铺
    * @return array 推荐店铺
    */
    public function getRecommendShop() {
        $shop = $this->where(['recommend'=>1])->order('serial')->limit(3)->select();
        return $shop;
    }

    /**
    * 获取所有商家
    * @return array 所有商家
    */
    public function getAllShop() {
        $shop = $this->order('serial')->select();
        return $shop;
    }
    /**
    * 获取分页的商家列表
    * @return array 店铺列表
    */
    public function getShopList() {
        $count = $this->count();// 查询满足要求的总记录数
        $page = new \Org\Util\AdminPage($count);// 实例化分页类 传入总记录数
        $show = $page->show();// 分页显示输出
        // 进行分页数据查询
        $list = $this->limit($page->firstRow.','.$page->listRows)->select();
        foreach ($list as $key => $value) {
            $list[$key]['user'] = D('user')->getById($value['user_id']);
        }
        return $shop=['list'=>$list, 'page'=>$show];
    }
    /**
    * 通过关键字查询商家
    * @param array $data 需要查询的关键字
    */
    public function getShopByFind($data) {
        //查找是哪个关键字需要查找
        foreach ($data as $key => $value) {
            if ($value != '') {
                $findKey = $key;
                $findWord = $value;
                break;
            }
        }
        $shop = $this->where([$findKey=>$findWord, 'type'=>$type])->select();
        foreach ($shop as $key => $value) {
            $shop[$key]['user'] = D('user')->getById($value['user_id']);
        }
        return $shop;
    }

    /**
    * 删除店铺
    * @param intger $id 店铺id
    */
    public function deleteShop($id) {
        if (!$this->delete($id)) {
            return false;
        }
        return true;
    }

    /**
    * 根据seller获取某个商家的详细信息,如果没指定seller，默认为当前登录用户
    * @param intget $userId 用户id
    * @return array 当前店铺详情
    */
    public function getShopByUser($userId = 0) {
        if ($userId != 0) {
            $shop = $this->where(['user_id'=>$userId])->find();
            $shop['user'] = D('user')->getById($userId);
        } else {
            $shop = $this->where(['user_id'=>session('seller')['id']])->find();
            $shop['user'] = D('user')->getById($userId);
        }
        return $shop;
    }

    /**
    * 获取某个商家的详细信息
    * @param integer $id
    * @return array 当前店铺详情
    */
    public function getShopById($id) {
        $shop = $this->where(['id'=>$id])->find();
        return $shop;
    }

    /**
    * 根据商品id获取当前商家信息
    * @param integer $goodsId商品id
    * @param array 商家新
    */
    public function getShopByGoodsId($goodsId) {
        $shopId = M('goods')->where(['goods_id'=>$goodsId])->find()['shop_id'];
        $shop = $this->getShopById($shopId);
        return $shop;
    }

}