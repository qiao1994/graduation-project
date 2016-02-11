<?php
namespace Home\Model;
use Think\Model;
class OrderModel extends Model {
    /**
    * 自动完成
    */
    protected $_auto = array(
        array('purchase_time', 'time', 1, 'function'),
        array('processing_time', 'time', 3, 'function'),
    );

    /**
    * 生成订单
    * @param array $data 购买数据
    */
    public function buy($data) {
        //--开始事务
        $model = new Model();
        $model->startTrans();

        $goods = D('goods')->getById($data['id']);
        date_default_timezone_set("Asia/Shanghai");
        //--判断用户是否有足够余额
        $amount = $data['number']*$goods['univalent'];
        $user = D('user')->getById(session('user')['id']);
        if ($user['balance'] < $amount) {
            return array(
                'ret'=>false,
                'msg'=>'余额不足',
            );
        }
        //--修改用户余额
        if (!D('user')->where(['id'=>$user['id']])->save(['balance'=>$user['balance']-$amount])) {
            $model->rollback();
        }
        //--创建订单
        $order->user_id = session('user')['id'];
        $order->goods_id = $goods['id'];
        $order->goods_name = $goods['name'];
        $order->univalent = $goods['univalent'];
        $order->number = $data['number'];
        $order->amount = $data['number']*$goods['univalent'];
        $order->remark = $data['remark'];
        if ($this->create($order)) {
            if (!$orderId = $this->add()) {
                $model->rollback();
                return array(
                    'ret'=>false,
                    'msg'=>$this->getError(),
                );
            }
        } else {
            return array(
                'ret'=>false,
                'msg'=>$this->getError(),
            );
        }
        //--创建资金变动
        $fundChange['user_id'] = $user['id'];
        $fundChange['associate_id'] = $orderId;
        $fundChange['time'] = time();
        $fundChange['type'] = '订单扣款';
        $fundChange['amount'] = $amount;
        $fundChange['before_change'] = $user['balance'];
        $fundChange['after_change'] = $user['balance']-$amount;
        if (D('FundChange')->create($fundChange)) {
            if (!D('FundChange')->add()) {
                $model->rollback();
                return array(
                    'ret'=>false,
                    'msg'=>D('FundChange')->getError(),
                );
            }
        } else {
            return array(
                'ret'=>false,
                'msg'=>D('FundChange')->getError(),
            );
        }
        $model->commit();
        return array(
            'ret'=>true,
            'msg'=>'购买成功',
        );
    }
}