<?php
namespace Home\Model;
use Think\Model;
class ShopModel extends Model {
    /**
    * 获取推荐的店铺
    * @return array 推荐店铺
    */
    public function getRecommendShop() {
        $shop = $this->where(['recommend'=>1, 'state'=>1])->order('serial')->limit(3)->select();
        return $shop;
    }

    /**
    * 获取所有商家
    * @return array 所有商家
    */
    public function getAllShop() {
        $shop = $this->where(['state'=>1])->order('serial')->select();
        return $shop;
    }


    /**
    * 根据商品id获取当前商家信息
    * @param integer $goodsId商品id
    * @param array 商家信息
    */
    public function getShopByGoodsId($goodsId) {
        $shopId = D('Goods')->where(['id'=>$goodsId])->find()['shop_id'];
        $shop = $this->getById($shopId);
        return $shop;
    }
}