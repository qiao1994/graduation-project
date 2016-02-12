<?php
namespace Home\Model;
use Think\Model;
use Think\Model\RelationModel;
class GoodsCommentModel extends Model {

    /**
    * 根据商品id获取评价
    * @param integer $goodsId 商品id
    * @return array 当前商品的评价
    */
    public function getGoodsCommentByGoodsId($goodsId) {
        $goodsComment = $this->where(['goods_id'=>$goodsId])->order('id desc')->select();
        return $goodsComment;
    }

    
    /**
    * 分页获取所有菜品评价
    * @return array 菜品评价
    */
    public function getGoodsCommentList() {
        $count = $this->count();// 查询满足要求的总记录数
        $page = new \Org\Util\AdminPage($count);// 实例化分页类 传入总记录数
        $show = $page->show();// 分页显示输出
        // 进行分页数据查询
        $list = $this->limit($page->firstRow.','.$page->listRows)->select();
        foreach ($list as $k => $v) {
            $shop = D('Shop')->getById($v['shop_id']);
            $list[$k]['shop_name'] = $shop['name'];
            $list[$k]['username'] = D('User')->getById($v['user_id'])['username'];
            $list[$k]['goods_name'] = D('Goods')->getById($v['goods_id'])['name'];
        }
        return $goodsComment=['list'=>$list, 'page'=>$show];
    }

    /**
    * 分页获取当前商家菜品评价
    * @return array 菜品评价
    */
    public function getGoodsCommentListBySeller($sellerId = 0) {
        if ($sellerId == 0) {
            $sellerId = session('seller')['id'];
        }
        $shopId = D('shop')->getShopByUser($sellerId)['id'];
        $count = $this->where(['shop_id'=>$shopId])->count();// 查询满足要求的总记录数
        $page = new \Org\Util\AdminPage($count);// 实例化分页类 传入总记录数
        $show = $page->show();// 分页显示输出
        // 进行分页数据查询
        $list = $this->where(['shop_id'=>$shopId])->limit($page->firstRow.','.$page->listRows)->order('id desc')->select();
        foreach ($list as $k => $v) {
            $shop = D('Shop')->getById($v['shop_id']);
            $list[$k]['shop_name'] = $shop['name'];
            $list[$k]['username'] = D('User')->getById($v['user_id'])['username'];
            $list[$k]['goods_name'] = D('Goods')->getById($v['goods_id'])['name'];
        }
        return $goodsComment=['list'=>$list, 'page'=>$show];
    }



    /**
    * 通过关键字查询菜品评价
    * @param array $data 需要查询的关键字
    */
    public function getGoodsCommentByFind($data) {
        //查找是哪个关键字需要查找
        foreach ($data as $key => $value) {
            if ($value != '') {
                $findKey = $key;
                $findWord = $value;
                break;
            }
        }
        $goodsComment = $this->where([$findKey=>$findWord, 'type'=>$type])->select();
        foreach ($goodsComment as $k => $v) {
            $shop = D('Shop')->getById($v['shop_id']);
            $goodsComment[$k]['shop_name'] = $shop['name'];
            $goodsComment[$k]['username'] = D('User')->getById($v['user_id'])['username'];
            $goodsComment[$k]['goods_name'] = D('Goods')->getById($v['goods_id'])['name'];
        }
        return $goodsComment;
    }

}
