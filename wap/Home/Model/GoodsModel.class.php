<?php
namespace Home\Model;
use Think\Model;
class GoodsModel extends Model {
    /**
    * 获取推荐的商品
    * @return array 推荐商品
    */
    public function getRecommendGoods() {
        $goods = $this->where(['recommend'=>1, 'state'=>1])->order('serial')->limit(6)->select();
        return $goods;
    }

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
}