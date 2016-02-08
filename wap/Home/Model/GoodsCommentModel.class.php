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
}
