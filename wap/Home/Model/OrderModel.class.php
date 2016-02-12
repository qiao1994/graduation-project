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
    * @return array $ret 结果状态
    */
    public function buy($data) {
        //--开始事务
        $model = new Model();
        $model->startTrans();
        //--判断用户是否有足够余额
        $goods = D('goods')->getById($data['id']);
        date_default_timezone_set("Asia/Shanghai");
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
        $order->shop_id = D('Goods')->getById($goods['id'])['shop_id'];
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

    /**
    * 获取当前用户订单
    * @return array $order 订单数据
    */
    public function getOrderListByUser() {
        $count = $this->where(['user_id'=>session('user')['id']])->order('id desc')->count();// 查询满足要求的总记录数
        $page = new \Org\Util\WapPage($count);// 实例化分页类 传入总记录数
        $show = $page->show();// 分页显示输出
        // 进行分页数据查询
        $list = $this->where(['user_id'=>session('user')['id']])->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
        return array(
            'list'=>$list, 
            'page'=>$show,
        );
    }


    /**
    * 获取指定订单
    * @param intger $id
    */
    public function getOrderById($id) {
        $order = $this->getById($id);
        if (!$order) {
            return false;
        }
        //补充商家信息
        $order['shop'] = D('shop')->getShopByGoodsId($order['goods_id']);
        //补充评价信息
        $order['if_comment'] = D('GoodsComment')->ifComment($order['id']);
        return $order;
    }

}