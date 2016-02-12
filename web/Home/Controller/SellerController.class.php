<?php
namespace Home\Controller;
use Think\Controller;
class SellerController extends Controller {
    /**
    * 所有function之前过滤
    */
    public function _initialize() {
        // 系统信息
        $this->assign('system', D('System')->getSystem());
        // 判断登录情况
        if ((ACTION_NAME != 'index') && (ACTION_NAME != 'register')) {
            if (!D('user')->userIfLogin('seller')) {
                $this->redirect('Seller/index');
                return false;
            }
        }
    }

    /**
    * 登录页面
    */
    public function index(){
        //--判断是否登录
        if (!D('User')->userIfLogin('seller')) {
            //--没有登录
            if (IS_POST) {
                //登录请求
                if (D('User')->userLogin(I('post.'), 'seller')) {
                    //登录成功
                    $this->redirect('Seller/index');
                } else {
                    //登录失败
                    $this->error('登录失败,请输入正确的账号和密码!');
                }
            }
            //--获取系统信息，展示登录页面
            $system = D('System')->getSystem();
            $this->assign('header', ['title'=>$system['name'].'-商家管理登录']);
            $this->display('login');
        } else {
            //--已经登录
            //显示主页
            $system = D('System')->getSystem();
            $this->assign('system', $system);
            $this->assign('seller', session('seller'));
            //获取当前商家
            $this->assign('shop', D('Shop')->getShopByUser());
            $this->assign('header', ['title'=>$system['name'].'-商家管理','index'=>'active', 'bread1'=>'开始', 'bread2'=>'', 'url'=>'index', 'icon'=>'icon-home']);
            $this->display('index');
        }
    }

    /**
    * 商家注册
    */
    public function register() {
        if (IS_POST) {
            //--处理注册请求
            //注册用户信息
            $_POST['user']['type'] = 'seller';
            $userRegisterRet = D('User')->userRegister(I('post.user'));
            if ($userRegisterRet['ret']) {
                $_POST['shop']['user_id'] = $userRegisterRet['ret'];
                $shopRegisterRet = D('Shop')->shopRegister(I('post.shop'));
                if ($shopRegisterRet['ret']) {
                    $this->success('注册成功，自动登录!', U('Seller/index'));
                } else {
                    $this->error($shopRegisterRet['msg']);
                }
            } else {
                $this->error($userRegisterRet['msg']);
            }
        }
        $system = D('System')->getSystem();
        $this->assign('system', $system);
        $this->display('register');
    }

    /**
    * 店铺信息展示更新
    */
    public function shop() {
        //--处理更新信息
        if (IS_POST) {
            //--首页图片更新
            if (!empty($_FILES['img']['tmp_name'])) {
                $upload = new \Think\Upload();// 实例化上传类
                $upload->maxSize = 10485760 ;// 设置附件上传大小 10M
                $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                $upload->rootPath = './Public/web/images/shop/'; // 设置附件上传根目录
                $upload->savePath = ''; // 设置附件上传（子）目录
                $upload->saveName = D('shop')->getShopByUser()['id'];
                $upload->replace = true;
                $upload->autoSub = false;
                $info = $upload->upload();
                if(!$info) {// 上传错误提示错误信息
                    $this->error('图片:'.$upload->getError());
                }
                $_POST['img'] = $info['img']['savename'];
            }
            //--横幅图片
            if (!empty($_FILES['banner']['tmp_name'])) {
                $upload = new \Think\Upload();// 实例化上传类
                $upload->maxSize = 10485760 ;// 设置附件上传大小 10M
                $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                $upload->rootPath = './Public/web/images/shop_banner/'; // 设置附件上传根目录
                $upload->savePath = ''; // 设置附件上传（子）目录
                $upload->saveName = D('shop')->getShopByUser()['id'];
                $upload->replace = true;
                $upload->autoSub = false;
                $info = $upload->upload();
                if(!$info) {// 上传错误提示错误信息
                    $this->error('图片'.$upload->getError());
                }
                $_POST['banner'] = $info['banner']['savename'];
            }

            //--更新shop信息
            if (D('shop')->create($_POST)) {
                D('shop')->save();
            } else {
                $this->error('更新失败，'.D('shop')->getError());
            }
            $this->success('店铺信息更新成功!', U('Seller/shop'));
        }
        $this->assign('header', ['title'=>'店铺信息', 'shop'=>'active', 'shop_shop'=>'active','bread1'=>'店铺', 'bread2'=>'店铺信息', 'url'=>'shop', 'icon'=>'icon-bank']);        
        //--获取当前用户的店铺信息
        $this->assign('shop', D('Shop')->getShopByUser());
        $this->display('shop');
    }



    /**
    * 菜品列表
    * @param intger $id 菜品id
    * @param string $name 菜品名称
    */
    public function goods($id = '', $name = '') {
        $this->assign('header', ['title'=>'菜品列表', 'goods'=>'active', 'goods_goods'=>'active','bread1'=>'菜品', 'bread2'=>'菜品列表', 'url'=>'goods', 'icon'=>'icon-shopping-cart']);
        if (($id != '') || ($name!='')) {
            //--处理查询
            $findData = ['id'=>$id, 'name'=>$name];
            $goods['list'] = D('Goods')->getGoodsByFind($findData);
            $this->assign('findData', $findData);
            $this->assign('goods', $goods);
        } else {
            //分页方式获取当前商家的菜品
            $goods = D('Goods')->getGoodsListByUserId(session('seller')['id']);
        }
        $this->assign('goods', $goods);
        $this->display('goods');        
    }

    /**
    * 新增菜品
    */ 
    public function goodsCreate() {
        $this->assign('header', ['title'=>'新增菜品', 'goods'=>'active', 'goods_create'=>'active','bread1'=>'菜品', 'bread2'=>'新增菜品', 'url'=>'goods', 'icon'=>'icon-shopping-cart']);        
        if (IS_POST) {
            //增加菜品信息
            $_POST['shop_id'] = D('shop')->getByUserId(session('seller')['id'])['id'];
            if (D('goods')->create($_POST)) {
                $goods_id = D('goods')->add();
                // --首页图片
                if (!empty($_FILES['img']['tmp_name'])) {
                    $upload = new \Think\Upload();// 实例化上传类
                    $upload->maxSize = 10485760 ;// 设置附件上传大小 10M
                    $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                    $upload->rootPath = './Public/web/images/goods/'; // 设置附件上传根目录
                    $upload->savePath = ''; // 设置附件上传（子）目录
                    $upload->saveName = $goods_id;
                    $upload->replace = true;
                    $upload->autoSub = false;
                    $info = $upload->upload();
                    if(!$info) {// 上传错误提示错误信息
                        $this->error('图片'.$upload->getError());
                    }
                    D('goods')->where(['id'=>$goods_id])->save(['img'=>$info['img']['savename']]);
                }
                // --首页图片
                if (!empty($_FILES['banner']['tmp_name'])) {
                    $upload = new \Think\Upload();// 实例化上传类
                    $upload->maxSize = 10485760 ;// 设置附件上传大小 10M
                    $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                    $upload->rootPath = './Public/web/images/goods_banner/'; // 设置附件上传根目录
                    $upload->savePath = ''; // 设置附件上传（子）目录
                    $upload->saveName = $goods_id;
                    $upload->replace = true;
                    $upload->autoSub = false;
                    $info = $upload->upload();
                    if(!$info) {// 上传错误提示错误信息
                        $this->error('图片'.$upload->getError());
                    }
                    D('goods')->where(['id'=>$goods_id])->save(['banner'=>$info['banner']['savename']]);
                }
            } else {
                $this->error('新增失败，'.D('shop')->getError());
            }
            $this->success('菜品新增成功!', U('Seller/goods'));
        }
        $this->display('goods_create');
    }

    /**
    * ajax删除菜品
    */
    public function ajaxDeleteGoods() {
        if (IS_POST) {
            if (D('goods')->delete(I('post.id'))) {
                echo 0;
                return true;
            } else {
                echo 1;
                return false;
            }
        }
    }

    /**
    * 更新菜品信息
    * @param intger $id 菜品id
    *
    */
    public function goodsUpdate($id) {
        $this->assign('header', ['title'=>'菜品列表', 'goods'=>'active', 'goods_goods'=>'active','bread1'=>'菜品', 'bread2'=>'更新菜品', 'url'=>'goods', 'icon'=>'icon-shopping-cart']);
        //处理更新信息
        if (IS_POST) {
            //如果图片更新了保存图片
            if (!empty($_FILES['img']['tmp_name'])) {
                $upload = new \Think\Upload();// 实例化上传类
                $upload->maxSize = 10485760 ;// 设置附件上传大小 10M
                $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                $upload->rootPath = './Public/web/images/goods/'; // 设置附件上传根目录
                $upload->savePath = ''; // 设置附件上传（子）目录
                $upload->saveName = $_POST['id'];
                $upload->replace = true;
                $upload->autoSub = false;
                $info = $upload->upload();
                if(!$info) {// 上传错误提示错误信息
                    $this->error('图片'.$upload->getError());
                }
                $_POST['img'] = $info['img']['savename'];
            }
            if (!empty($_FILES['banner']['tmp_name'])) {
                $upload = new \Think\Upload();// 实例化上传类
                $upload->maxSize = 10485760 ;// 设置附件上传大小 10M
                $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                $upload->rootPath = './Public/web/images/goods_banner/'; // 设置附件上传根目录
                $upload->savePath = ''; // 设置附件上传（子）目录
                $upload->saveName = $_POST['id'];
                $upload->replace = true;
                $upload->autoSub = false;
                $info = $upload->upload();
                if(!$info) {// 上传错误提示错误信息
                    $this->error('图片'.$upload->getError());
                }
                $_POST['banner'] = $info['banner']['savename'];
            }

            //更新goods信息
            if (D('goods')->create($_POST)) {
                D('goods')->save();
            } else {
                $this->error('更新失败，'.D('goods')->getError());
            }
            $this->success('菜品信息信息更新成功!', U('Seller/goods'));
        }
        $this->assign('goods', D('goods')->getById($id));
        $this->display('goods_update');
    }

    /**
    * 订单列表
    * @param intger $id 订单号
    * @param string $goods_name 商品名称
    */
    public function order($id = '', $goods_name = '') {
        $this->assign('header', ['title'=>'订单列表', 'order'=>'active', 'order_order'=>'active','bread1'=>'订单', 'bread2'=>'订单列表', 'url'=>'order', 'icon'=>'icon-bars']);
        if (($id != '') || ($goods_name!='')) {
            //--处理查询
            $findData = ['id'=>$id, 'goods_name'=>$goods_name, 'shop_id'=>D('shop')->getShopByUser()['id']];
            $order['list'] = D('Order')->getOrderByFind($findData);
            $this->assign('findData', $findData);
        } else {
            //分页方式获取当前商家的订单
            $order = D('Order')->getOrderListByShop();
        }
        $this->assign('order', $order);
        $this->display('order');
    }

    /**
    * 处理订单
    */
    public function orderHandle() {
        if (IS_POST) {
            D('Order')->where(['id'=>I('post.id')])->data(['state'=>I('post.state'), 'processing_time'=>time()])->save();
            $this->success('处理成功！', U('Seller/order'));
        }
    }

    /**
    * 菜品评价
    * @param intger 商品id    
    */
    public function goodsComment($goods_id = '') {
        $this->assign('header', ['title'=>'菜品评价', 'goods'=>'active', 'goods_comment'=>'active','bread1'=>'菜品', 'bread2'=>'菜品评价', 'url'=>'goods', 'icon'=>'icon-shopping-cart']);
        $shop = D('Shop')->getShopByUser();
        if ($goods_id != '') {
            //--处理查询
            $findData = ['goods_id'=>$goods_id, 'shop_id'=>$shop['id']];
            $goodsComment['list'] = D('GoodsComment')->getGoodsCommentByFind($findData);
            $this->assign('findData', $findData);
            $this->assign('goodsComment', $goodsComment);
        } else {
            //--分页方式获取当前商家菜品评价
            $goodsComment = D('GoodsComment')->getGoodsCommentListBySeller();
        }
        $this->assign('goodsComment', $goodsComment);
        $this->display('goods_comment');    
    }

    /**
    * 统计数据
    * @param string $startDate 开始日期
    * @param string $endDate 结束日期
    */
    public function statistics($startDate = '', $endDate = '', $goods_id = 0) {
        $this->assign('header', ['title'=>'数据统计', 'statistics'=>'active', 'statistics_statistics'=>'active','bread1'=>'数据', 'bread2'=>'数据统计', 'url'=>'statistics', 'icon'=>'icon-table']);
        //--获取当前商家的所有菜品
        $shop = D('Shop')->getShopByUser();
        $goods = D('Goods')->getGoodsByShopId($shop['id']);
        $this->assign('goods', $goods);
        //--获取统计数据
        $statisticsData = D('Order')->getStatistics($startDate, $endDate, $goods_id, $shop['id']);
        $this->assign('statisticsData', $statisticsData);
        $this->display('statistics');
    }
    
    /**
    * 注销登录
    */ 
    public function logout() {
        D('user')->userLogout('seller');
        $this->success('注销成功！', U('Seller/index'));
    }

}