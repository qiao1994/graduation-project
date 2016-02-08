<?php
namespace Home\Model;
use Think\Model;
class OrderModel extends Model {
    protected $_auto = array(
        array('purchase_time', 'time', 1, 'function'),
        array('processing_time', 'time', 3, 'function'),
    );

    /**
    * 生产订单
    *
    */
    public function buy($data) {
        $goods = D('goods')->getById($data['id']);
        date_default_timezone_set("Asia/Shanghai");
        //判断用户是否有足够余额
        $amount = $data['number']*$goods['univalent'];
        $user = D('user')->getById(session('user')['id']);
        if ($user['balance'] < $amount) {
            echo '余额不足';
            return false;
        }
        //修改余额
        D('user')->where(['id'=>$user['id']])->save(['balance'=>$user['balance']-$amount]);
        //创建订单
        $order->user_id = session('user')['id'];
        $order->goods_id = $goods['id'];
        $order->goods_name = $goods['name'];
        $order->univalent = $goods['univalent'];
        $order->number = $data['number'];
        $order->amount = $data['number']*$goods['univalent'];
        $order->remark = $data['remark'];
        $this->create($order);
        $orderId = $this->add();
        //创建资金变动
        $fundChange['user_id'] = $user['id'];
        $fundChange['associate_id'] = $orderId;
        $fundChange['time'] = time();
        $fundChange['type'] = '订单扣款';
        $fundChange['amount'] = $amount;
        $fundChange['before_change'] = $user['balance'];
        $fundChange['after_change'] = $user['balance']-$amount;
        D('FundChange')->create($fundChange);
        D('FundChange')->add();
    }
}