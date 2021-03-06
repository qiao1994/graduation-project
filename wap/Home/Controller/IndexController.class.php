<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {

    /**
    * 初始化控制器
    */
    public function _initialize() {
        //系统信息
        $this->assign('system', D('System')->getSystem());
        //--判断登录情况
        if ((ACTION_NAME == 'buy') || (ACTION_NAME == 'order')) {
            if (!D('user')->userIfLogin()) {
                echo '<script>alert("请先登录!");location.href="'.U('Index/User').'";</script>';
                return false;
            }
        }
    }

    /**
    * 手机首页
    */
    public function index(){
        // 头信息
        $this->assign('header', ['headerFlag'=>false]);
        // 推荐店铺
        $this->assign('recommendShop', D('Shop')->getRecommendShop());
        $this->assign('shopCount', D('Shop')->where(['state'=>1])->count());
        // 推荐菜品
        $this->assign('recommendGoods', D('Goods')->getRecommendGoods());
        $this->assign('goodsCount', D('Goods')->where(['state'=>1, 'sale_state'=>1])->count());
        // 展示首页
        $this->display('index');
    }

    /**
    * 商家
    * @param integer $id 商家id
    */
    public function shop($id = 0){
        if ($id == 0) {
            //--商家列表
            $this->assign('header', ['headerFlag'=>true, 'headerName'=>'商家列表']);
            $this->assign('shop', D('shop')->getAllShop());
            $this->display('shop');
        } else {
            //--某个商家详情
            $shop = D('shop')->getById($id);
            $this->assign('shop', $shop);
            $this->assign('header', ['headerFlag'=>true, 'headerName'=>$shop['name']]);
            //当前商家所有菜品
            $goods = D('goods')->getGoodsByShopId($shop['id']);
            $this->assign('goods', $goods);
            $this->display('shop_detail');
        }
    }

    /**
    * 商品
    * @param integer $id 商品id
    * @param integer $shop_id 商家id
    */
    public function goods($id = 0, $shopId = 0) {
        if ($id != 0) {
            //--某个商品详情
            $goods = D('goods')->getById($id);
            $this->assign('header', ['headerFlag'=>true, 'headerName'=>$goods['name']]);
            $this->assign('goods', $goods);
            //当前商品的商家信息
            $shop = D('Shop')->getShopByGoodsId($id);
            $this->assign('shop', D('Shop')->getShopByGoodsId($id));
            //当前商品的3个评价
            $this->assign('comment', D('GoodsComment')->getGoodsCommentByGoodsId($id));
            $this->display('goods_detail');
        } else if ($shopId != 0) {
            //--某个商家所有商品
            $shop = D('Shop')->getById($shopId);
            $this->assign('header', ['headerFlag'=>true, 'headerName'=>$shop['name']]);
            $this->assign('goods', D('Goods')->getGoodsByShopId($shopId));
            $this->display('goods');
        } else {
            //--全部商品
            $this->assign('header', ['headerFlag'=>true, 'headerName'=>'菜品列表']);
            $this->assign('goods', D('Goods')->getAllGoods($id));
            $this->display('goods');
        }
    }


    /**
    * 个人中心
    */
    public function user(){
        //--判断是否登录
        if (!D('user')->userIfLogin()) {
            //--未登录
            if (IS_POST) {
                //登录请求
                if (D('user')->userLogin(I('post.'))) {
                    //登录成功
                    $this->redirect('Index/user');
                } else {
                    //登录失败
                    echo '<script>alert("账号或密码错误!");location.reload();</script>';
                }
            } else {
                $this->assign('header', ['headerFlag'=>true, 'headerName'=>'登录']);
                $this->display('login');
            }
        } else {
            //--已登录
            $this->assign('header', ['headerFlag'=>true, 'headerName'=>'个人中心']);
            $user = D('user')->getById(session('user')['id']);
            $this->assign('user', $user);
            $this->display();
        }
    }

    /**
    * ajax验证用户名是否存在
    */
    public function ajaxIfUsernameExists() {
        if (IS_POST) {
            $ret = D('user')->getByUsername($_POST['username']);
            if (empty($ret)) {
                //--可以注册
                echo 1;
            } else {
                //--不可以注册
                echo 0;
            }
        }
    }

    /**
    * 注册
    */
    public function register() {
        if (IS_POST) {
            //--注册
            $ret = D('user')->userRegister(I('post.'));
            if ($ret['ret']) {
                //注册成功，跳转到user
                $this->redirect('Index/user');
            } else {
                echo '<script>alert("'.$ret['msg'].'");location.reload();</script>';
            }
        } else {
            $this->assign('header', ['headerFlag'=>true, 'headerName'=>'注册']);
            $this->display('register');
        }
    }


    /**
    * 购买
    * @param intger 菜品id
    */
    public function buy($id) {
        if (IS_POST) {
            //处理订单
            $orderBuyRet = D('Order')->buy(I('post.'));
            if ($orderBuyRet['ret']){
                //购买成功
                echo '<script>alert("购买成功！");location.href="'.U('Index/Order').'";</script>';
            } else {
                // 购买失败
                echo '<script>alert("'.$orderBuyRet['msg'].'");location.reload();</script>';
            }
        }
        $this->assign('header', ['headerFlag'=>true, 'headerName'=>'购买']);
        $goods = D('goods')->getById($id);
        $this->assign('goods', $goods);
        $this->display('buy');
    }

    /**
    * 订单
    * @param intger $id 订单号
    */
    public function order($id = 0) {
        if ($id == 0) {
            $this->assign('header', ['headerFlag'=>true, 'headerName'=>'我的订单']);
            //--获取当前用户订单
            $order = D('order')->getOrderListByUser();
            $this->assign('order', $order);
            $this->display('order');
        } else {
            $this->assign('header', ['headerFlag'=>true, 'headerName'=>'订单详情']);
            //--获取当前订单
            if (!$order = D('order')->getOrderById($id)) {
                echo '<script>alert("当前订单不存在!");history.back(-1)</script>';
            }
            $this->assign('order', $order);
            $this->display('order_detail');
        }

    }

    /**
    * 商品评价提交
    */
    public function goodsComment() {
        if (IS_POST) {
            $goodsCommentRet = D('GoodsComment')->goodsCommentCreate($_POST);
            if ($goodsCommentRet['ret']) {
                echo '<script>alert("评价成功！");location.href="'.U('Index/Order?id='.$_POST['order_id']).'";</script>';
            } else {
                echo '<script>alert("'.$orderBuyRet['msg'].'");location.href="'.U('Index/Order?id='.$_POST['order_id']).'";</script>';
            }
        }
    }

    /**
    * 购物车页面
    */
    public function cart() {

    }

    /**
    * 测试页面
    */ 
    public function test() {
        $this->display('test');
    }

    /**
    * 注销
    */
    public  function logout() {
        D('user')->userLogout();
        $this->redirect('Index/user');
    }

}