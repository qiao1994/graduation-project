<?php
namespace Home\Model;
use Think\Model;
class GoodsModel extends Model {

    protected $_validate = array(
        array('name', 'require', '菜品名称必须填写'),
        array('univalent', 'require', '菜品单价必须填写'),
        array('introduction', 'require', '菜品简介必须填写'),
        array('shop_id', 'require', '菜品简介必须填写'),
    );

    /**
    * 获取指定商家的所有商品
    * @return array 商品
    */
    public function getGoodsByShopId($shopId) {
        $goods = $this->where(['shop_id'=>$shopId])->order('serial')->select();
        return $goods;
    }


    /**
    * 获取所有商品
    * @return array 所有商品
    */
    public function getAllGoods() {
        $goods = $this->order('serial')->select();
        return $goods;
    }

    /**
    * 分页获取所有菜品
    * @return array 菜品
    */
    public function getGoodsList() {
        $count = $this->count();// 查询满足要求的总记录数
        $page = new \Org\Util\AdminPage($count);// 实例化分页类 传入总记录数
        $show = $page->show();// 分页显示输出
        // 进行分页数据查询
        $list = $this->limit($page->firstRow.','.$page->listRows)->select();
        foreach ($list as $k => $v) {
            $shop = D('Shop')->getById($v['shop_id']);
            $list[$k]['shop_name'] = $shop['name'];
        }
        return $goods=['list'=>$list, 'page'=>$show];
    }

    /**
    * 通过关键字查询菜品
    * @param array $data 需要查询的关键字
    */
    public function getGoodsByFind($data) {
        //查找是哪个关键字需要查找
        foreach ($data as $key => $value) {
            if ($value != '') {
                $findKey = $key;
                $findWord = $value;
                break;
            }
        }
        return $goods = $this->where([$findKey=>$findWord])->select();
    }



    /**
    * 分页获取当前登录用户家的菜品
    * @return array 菜品
    */
    public function getGoodsListByUserId($id) {
        $shopId = D('shop')->getByUserId($id)['id'];
        $count = $this->where(['shop_id'=>$shopId])->count();// 查询满足要求的总记录数
        $page = new \Org\Util\AdminPage($count);// 实例化分页类 传入总记录数
        $show = $page->show();// 分页显示输出
        // 进行分页数据查询
        $list = $this->where(['shop_id'=>$shopId])->limit($page->firstRow.','.$page->listRows)->select();
        return $goods=['list'=>$list, 'page'=>$show];
    }



}