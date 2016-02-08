<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {

    /**
    * 初始化控制器
    */
    public function _initialize() {
        $this->assign('system', D('System')->getSystem());
    }

    /**
    * 手机首页
    */
    public function index(){
        // 头信息
        $this->assign('header', ['headerFlag'=>false]);
        // 推荐店铺
        $this->assign('recommendShop', D('Shop')->getRecommendShop());
        $this->assign('shopCount', D('Shop')->count());
        // 推荐菜品
        $this->assign('recommendGoods', D('Goods')->getRecommendGoods());
        $this->assign('goodsCount', D('Goods')->count());
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
            $this->assign('shop', D('Shop')->getShopByGoodsId($id));
            //当前商品的3个评价
            $this->assign('comment', D('GoodsComment')->getGoodsCommentByGoodsId($id));
            $this->display('goods_detail');
        } else if ($shop_id != 0) {
            //--某个商家所有商品
            $this->assign('goods', D('Goods')->getGoodsByShopId($id));
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
            $this->assign('user', session('user'));
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
        //判断是否登录
        if (!D('user')->userIfLogin()) {
            $this->redirect('Index/user');
        }
        if (IS_POST) {
            //处理订单
            if (D('Order')->buy(I('post.'))){
                //购买成功
            } else {
                // 购买失败
            }
        }
        $this->assign('header', ['headerFlag'=>true, 'headerName'=>'购买']);
        $goods = D('goods')->getById($id);
        $this->assign('goods', $goods);
        $this->display('buy');
    }

    /**
    * 注销
    */
    public  function logout() {
        D('user')->userLogout();
        $this->redirect('Index/user');
    }

}