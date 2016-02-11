<?php
namespace Home\Model;
use Think\Model;
use Think\Model\RelationModel;
class GoodsCommentModel extends Model {
    /**
    * 自动完成
    */
    protected $_auto = array(
        array('time', 'time', 1, 'function'),
    );

    protected $_validate = array(
        array('user_id','require','请先登录!'),
        array('goods_id','require','商品信息获取失败!'),
        array('order_id','require','订单信息获取失败!'),
        array('shop_id','require','店铺信息获取失败!'),
        array('content','require','请输入评价内容!'),
    );


    /**
    * 根据商品id获取评价
    * @param integer $goodsId 商品id
    * @return array 当前商品的评价
    */
    public function getGoodsCommentByGoodsId($goodsId) {
        $goodsComment = $this->where(['goods_id'=>$goodsId])->order('id desc')->select();
        //--评论的用户名
        foreach ($goodsComment as $key => $value) {
            $goodsComment[$key]['username'] = $this->substr_cut(D('user')->getById($value['user_id'])['username']);
        }
        return $goodsComment;
    }
    /**
     * 外部引入函数，格式豁免
     * 只保留字符串首尾字符，隐藏中间用*代替（两个字符时只显示第一个）
     * @param string $user_name 姓名
     * @return string 格式化后的姓名
     */
    function substr_cut($user_name){
        $strlen     = mb_strlen($user_name, 'utf-8');
        $firstStr     = mb_substr($user_name, 0, 1, 'utf-8');
        $lastStr     = mb_substr($user_name, -1, 1, 'utf-8');
        return $strlen == 2 ? $firstStr . str_repeat('*', mb_strlen($user_name, 'utf-8') - 1) : $firstStr . str_repeat("*", $strlen - 2) . $lastStr;
    }

    /**
    * 评价商品
    * @param array $data 评价数据
    * @return array 结果数据
    */
    public function goodsCommentCreate($data) {
        if (!$this->ifComment($data['order_id'])) {
            return array(
                'ret'=>false,
                'msg'=>'当前不能评价本订单!',
            );
        }
        $data['user_id'] = session('user')['id'];
        $data['shop_id'] = D('Goods')->getById($data['goods_id'])['shop_id'];
        if ($this->create($data)) {
            $this->add();
            return array(
                'ret'=>true,
                'msg'=>'评价成功!',
            );
        } else {
            return array(
                'ret'=>false,
                'msg'=>$this->getError(),
            );
        }
    }

    /**
    * 能否评价
    * @param string $order_id
    * @param intger $user_id
    * @return boolean
    */
    public function ifComment($order_id, $user_id = 0) {
        if ($user_id == 0) {
            $user_id = session('user')['id'];
        }
        //--根据状态判定能否评价，后续补充

        $goodsComment = $this->where(['order_id'=>$order_id, 'user_id'=>$user_id])->find();
        if ($goodsComment) {
            return false;
        } else {
            return true;
        }

    }
}
