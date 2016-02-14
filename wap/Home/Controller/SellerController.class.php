<?php
namespace Home\Controller;
use Think\Controller;
class SellerController extends Controller {

    /**
    * 初始化控制器
    */
    public function _initialize() {
        //系统信息
        $this->assign('system', D('System')->getSystem());
        //--判断登录情况
        if ((ACTION_NAME != 'index')) {
            if (!D('user')->userIfLogin('seller')) {
                echo '<script>alert("请先登录!");location.href="'.U('Seller/index').'";</script>';
                return false;
            }
        }
    }


    /**
    * 首页登录
    */
    public function index() {
        if (IS_POST) {
            if (D('user')->userLogin(I('post.'), 'seller')) {
                //登录成功
                $this->redirect('Seller/goods');
            } else {
                //登录失败
                echo '<script>alert("账号或密码错误!");location.reload();</script>';
            }
        }
        if (session('seller')) {
            //--已经登录
            $this->redirect('Seller/goods');
        } else {
            //--未登录，显示登录页面
            $this->assign('header', ['headerFlag'=>true, 'headerName'=>'商家登录']);
            $this->display('login');
        }
    }

    /**
    * 商品管理
    */
    public function goods() {
        $this->assign('header', ['headerFlag'=>true, 'headerName'=>'商品管理']);

        $shopId = D('Shop')->getByUserId(session('seller')['id'])['id'];
        $goods = D('Goods')->where(['shop_id'=>$shopId])->order('serial')->select();
        $this->assign('goods', $goods);
        $this->display('goods');
    }

    /**
    * ajax更改商品状态
    * @return boolean 更改是否成功
    */
    public function ajaxChangeGoodsState() {
        if (IS_POST) {
            if (D('Goods')->where(['id'=>I('post.id')])->save(['state'=>I('post.state')])) {
                echo 0;
                return true;
            } else {
                echo 1;
                return false;
            }
        }
    }

    /**
    * 订单处理
    */
    public function order() {
        $this->assign('header', ['headerFlag'=>true, 'headerName'=>'订单管理']);
        $shopId = D('Shop')->getByUserId(session('seller')['id'])['id'];
        $order = D('Order')->where(['shop_id'=>$shopId])->order('id desc')->select();
        foreach ($order as $key => $value) {
            $order[$key]['user'] = D('User')->getById($value['user_id']);
        }
        $this->assign('order', $order);
        $this->display('order');
    }

    /**
    * ajax更改订单状态
    * @return boolean 更改是否成功
    */
    public function ajaxChangeOrderState() {
        if (IS_POST) {
            if (D('Order')->where(['id'=>I('post.id')])->save(['state'=>I('post.state')])) {
                echo 0;
                return true;
            } else {
                echo 1;
                return false;
            }
        }
    }

}