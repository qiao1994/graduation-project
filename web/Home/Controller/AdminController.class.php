<?php
namespace Home\Controller;
use Think\Controller;
class AdminController extends Controller {

    /**
    * 初始化控制器
    */
    public function _initialize() {
        // 系统信息
        $this->assign('system', D('System')->getSystem());
        // 判断登录情况
        if (ACTION_NAME != 'index') {
            if (!D('user')->userIfLogin('admin')) {
                $this->redirect('Admin/index');
                return false;
            }
        }
    }

    /**
    * 登录页面
    */
    public function index(){
        //--判断是否登录
        if (!D('user')->userIfLogin('admin')) {
            //--没有登录
            if (IS_POST) {
                //登录请求
                if (D('user')->userLogin(I('post.'), 'admin')) {
                    //登录成功
                    $this->redirect('Admin/index');
                } else {
                    //登录失败
                    $this->error('登录失败,请输入正确的账号和密码!');
                }
            }
            //--获取系统信息
            $system = D('System')->getSystem();
            $this->assign('header', ['title'=>$system['name'].'-后台登录']);
            $this->display('login');
        } else {
            //--显示主页
            $system = D('System')->getSystem();
            $this->assign('admin', session('admin'));
            $this->assign('header', ['title'=>$system['name'].'-后台管理','index'=>'active', 'bread1'=>'开始', 'bread2'=>'', 'url'=>'index', 'icon'=>'icon-home']);
            //--统计信息
            $this->assign('statisticsData', D('System')->getStatisticsData());
            $this->display('index');
        }
    }

    /**
    * 用户管理
    * @param intger $id 用户id
    * @param string $username 用户名
    * @param string $phone 电话
    * @param string $qq QQ号码
    */
    public function user($id = '', $username='', $phone='', $qq='') {
        // 头部信息
        $this->assign('header', ['title'=>'用户管理', 'user'=>'active', 'user_user'=>'active','bread1'=>'用户', 'bread2'=>'用户列表', 'url'=>'user', 'icon'=>'icon-user']);        
        //--处理查询
        if (($id != '') || ($username!='') || ($phone!='') || ($qq!='')) {
            $findData = ['id'=>$id, 'username'=>$username, 'phone'=>$phone, 'qq'=>$qq];
            $user['list'] = D('user')->getUserByFind($findData, 'user');
            $this->assign('findData', $findData);
            $this->assign('user', $user);
        } else {
            //--不需要处理查询
            $this->assign('user', D('user')->getUserList('user'));
        }
        $this->display('user');
    }
    
    /**
    * 商家用户
    * @param intger $id 用户id
    * @param string $username 用户名
    * @param string $phone 电话
    * @param string $qq QQ号码
    */
    public function seller($id = '', $username='', $phone='', $qq='') {
        // 头部信息
        $this->assign('header', ['title'=>'用户管理', 'user'=>'active', 'user_seller'=>'active', 'bread1'=>'用户', 'bread2'=>'商家用户', 'url'=>'seller', 'icon'=>'icon-user']);        
        //--处理查询
        if (($id != '') || ($username!='') || ($phone!='') || ($qq!='')) {
            $findData = ['id'=>$id, 'username'=>$username, 'phone'=>$phone, 'qq'=>$qq];
            $user['list'] = D('user')->getUserByFind($findData, 'seller');
            $this->assign('findData', $findData);
            $this->assign('user', $user);
        } else {
            //--不需要处理查询
            $this->assign('user', D('user')->getUserList('seller'));
        }
        $this->display('seller');
    }

    /**
    * ajax重置用户密码
    * @return boolean 是否重置成功
    */
    public function ajaxResetUserPassword() {
        if (IS_POST) {
            if (D('user')->resetPassword(I('post.id'))) {
                echo 0;
                return true;
            } else {
                echo 1;
                return false;
            }
        }
    }

    /**
    * ajax删除用户
    * @return boolean 删除是否成功
    */
    public function ajaxDeleteUser() {
        if (IS_POST) {
            if (D('user')->deleteUser(I('post.id'))) {
                echo 0;
                return true;
            } else {
                echo 1;
                return false;
            }
        }
    }

    /**
    * 商家列表
    * @param intger $userId 用户id
    * @param intger $id 商家id
    * @param string $name 用户姓名名
    * @param string $tel 电话
    * @param string $recommend 是否推荐
    */
    public function shop($userId='', $id = '', $name='', $tel='', $recommend='') {
        // 头部信息
        $this->assign('header', ['title'=>'商家管理', 'shop'=>'active', 'shop_shop'=>'active', 'bread1'=>'商家', 'bread2'=>'商家列表', 'url'=>'shop', 'icon'=>'icon-bank']);        
        if ($userId != '') {
            // --指定用户ID
            $shop['list'][0] = D('Shop')->getShopByUser($userId);
            $this->assign('shop', $shop);
        } else if (($id != '') || ($name!='') || ($tel!='') || ($recommend!='')) {
            //--处理查询
            $findData = ['id'=>$id, 'name'=>$name, 'tel'=>$tel, 'recommend'=>$recommend];
            $shop['list'] = D('shop')->getShopByFind($findData);
            $this->assign('findData', $findData);
            $this->assign('shop', $shop);
        } else {
            //不需要处理查询
            $this->assign('shop', D('shop')->getShopList());
        }
        $this->display('shop');
    }

    /**
    * ajax删除店铺
    * @return boolean 删除是否成功
    */
    public function ajaxDeleteShop() {
        if (IS_POST) {
            if (D('Shop')->deleteShop(I('post.id'))) {
                echo 0;
                return true;
            } else {
                echo 1;
                return false;
            }
        }
    }

    /**
    * 商家信息更新
    * @param intger $id 商家id
    */
    public function shopUpdate($id = 0) {
        $this->assign('header', ['title'=>'商家管理', 'shop'=>'active', 'shop_shop'=>'active', 'bread1'=>'商家', 'bread2'=>'商家信息更新', 'url'=>'shop', 'icon'=>'icon-bank']);        
        //--处理更新信息
        if (IS_POST) {
            //如果首页图片更新了保存图片
            if (!empty($_FILES['img']['tmp_name'])) {
                $upload = new \Think\Upload();// 实例化上传类
                $upload->maxSize = 10485760 ;// 设置附件上传大小 10M
                $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                $upload->rootPath = './Public/web/images/shop/'; // 设置附件上传根目录
                $upload->savePath = ''; // 设置附件上传（子）目录
                $upload->saveName = $id;
                $upload->replace = true;
                $upload->autoSub = false;
                $info = $upload->upload();
                if(!$info) {// 上传错误提示错误信息
                    $this->error('首页图片'.$upload->getError());
                }
                $_POST['img'] = $info['img']['savename'];
            }
            //如果横幅图片更新了保存图片
            if (!empty($_FILES['banner']['tmp_name'])) {
                $upload = new \Think\Upload();// 实例化上传类
                $upload->maxSize = 10485760 ;// 设置附件上传大小 10M
                $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                $upload->rootPath = './Public/web/images/shop_banner/'; // 设置附件上传根目录
                $upload->savePath = ''; // 设置附件上传（子）目录
                $upload->saveName = $id;
                $upload->replace = true;
                $upload->autoSub = false;
                $info = $upload->upload();
                if(!$info) {// 上传错误提示错误信息
                    $this->error('横幅图片'.$upload->getError());
                }
                $_POST['banner'] = $info['banner']['savename'];
            }
            //更新shop信息
            if (D('shop')->create($_POST)) {
                D('shop')->save();
            } else {
                $this->error('更新失败，'.D('shop')->getError());
            }
            $this->success('店铺信息更新成功!');
        }
        //获取商家信息
        $this->assign('shop', D('shop')->getById($id));
        $this->display('shop_update');
    }


    /**
    * 菜品列表
    * @param intger $id 菜品id
    * @param string $name 菜品名称
    * @param string $tel 电话
    * @param string $recommend 是否推荐
    */
    public function goods($id = '', $name = '', $shop_id = '') {
        $this->assign('header', ['title'=>'菜品列表', 'goods'=>'active', 'goods_goods'=>'active','bread1'=>'菜品', 'bread2'=>'菜品列表', 'url'=>'goods', 'icon'=>'icon-shopping-cart']);
        if (($id != '') || ($name!='') || ($shop_id!='')) {
            //--处理查询
            $findData = ['id'=>$id, 'name'=>$name, 'shop_id'=>$shop_id];
            $goods['list'] = D('Goods')->getGoodsByFind($findData);
            $this->assign('findData', $findData);
            $this->assign('goods', $goods);
        } else {
            //--分页方式获取当前商家菜品
            $goods = D('Goods')->getGoodsList();
        }
        $this->assign('goods', $goods);
        $this->display('goods');        
    }

    /**
    * 更新菜品信息
    * @param intger $id 菜品id
    *
    */
    public function goodsUpdate($id) {
        $this->assign('header', ['title'=>'菜品更新', 'goods'=>'active', 'goods_goods'=>'active','bread1'=>'菜品', 'bread2'=>'菜品更新', 'url'=>'goods', 'icon'=>'icon-shopping-cart']);
        //处理更新信息
        if (IS_POST) {
            //如果首页图片更新了保存图片
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
                    $this->error('首页图片'.$upload->getError());
                }
                $_POST['img'] = $info['img']['savename'];
            }
            //如果横幅图片更新了保存图片
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
                    $this->error('横幅图片'.$upload->getError());
                }
                $_POST['banner'] = $info['banner']['savename'];
            }
            //更新goods信息
            if (D('goods')->create($_POST)) {
                D('goods')->save();
            } else {
                $this->error('更新失败，'.D('goods')->getError());
            }
            $this->success('菜品信息信息更新成功!', U('Admin/goods'));
        }
        $this->assign('goods', D('goods')->getById($id));
        $this->display('goods_update');
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
    * 菜品评价
    * @param intger 商品id    
    * @param intger 商家id    
    */
    public function goodsComment($goods_id = '', $shop_id = '') {
        $this->assign('header', ['title'=>'菜品评价', 'goods'=>'active', 'goods_comment'=>'active','bread1'=>'菜品', 'bread2'=>'菜品评价', 'url'=>'goods', 'icon'=>'icon-shopping-cart']);
        if (($goods_id != '') || ($shop_id!='')) {
            //--处理查询
            $findData = ['goods_id'=>$goods_id, 'shop_id'=>$shop_id];
            $goodsComment['list'] = D('GoodsComment')->getGoodsCommentByFind($findData);
            $this->assign('findData', $findData);
            $this->assign('goodsComment', $goodsComment);
        } else {
            //--分页方式获取当前商家菜品
            $goodsComment = D('GoodsComment')->getGoodsCommentList();
        }
        $this->assign('goodsComment', $goodsComment);
        $this->display('goods_comment');    
    }

    /**
    * ajax删除评价
    * @return boolean 删除是否成功
    */
    public function ajaxDeleteGoodsComment() {
        if (IS_POST) {
            if (D('GoodsComment')->delete(I('post.id'))) {
                echo 0;
                return true;
            } else {
                echo 1;
                return false;
            }
        }
    }

    /**
    * 订单列表
    * @param intger $id 订单号
    * @param string $goods_name 商品名称
    * @param intget $shop_id 商家编号
    */
    public function order($id = '', $goods_name = '', $shop_id = '') {
        $this->assign('header', ['title'=>'订单列表', 'order'=>'active', 'order_order'=>'active','bread1'=>'订单', 'bread2'=>'订单列表', 'url'=>'order', 'icon'=>'icon-bars']);
        if (($id != '') || ($goods_name!='') || ($shop_id!='')) {
            //--处理查询
            $findData = ['id'=>$id, 'goods_name'=>$goods_name, 'shop_id'=>$shop_id];
            $order['list'] = D('Order')->getOrderByFind($findData);
            $this->assign('findData', $findData);
        } else {
            //分页方式获取当前商家的订单
            $order = D('Order')->getOrderList();
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
            $this->success('处理成功！', U('Admin/order'));
        }
    }

    /**
    * ajax删除订单
    * @return boolean 删除是否成功
    */
    public function ajaxDeleteOrder() {
        if (IS_POST) {
            if (D('Order')->delete(I('post.id'))) {
                echo 0;
                return true;
            } else {
                echo 1;
                return false;
            }
        }
    }
    
    /**
    * 统计数据
    * @param string $startDate 开始日期
    * @param string $endDate 结束日期
    */
    public function statistics($startDate = '', $endDate = '', $goods_id = 0, $shop_id = 0) {
        $this->assign('header', ['title'=>'数据统计', 'statistics'=>'active', 'statistics_statistics'=>'active','bread1'=>'数据', 'bread2'=>'数据统计', 'url'=>'statistics', 'icon'=>'icon-table']);
        //--获取当前商家的所有菜品
        $goods = D('Goods')->select();
        $this->assign('goods', $goods);
        //--获取所有商家
        $shop = D('Shop')->order('serial')->select();
        $this->assign('shop', $shop);
        //--获取统计数据
        $statisticsData = D('Order')->getStatistics($startDate, $endDate, $goods_id, $shop_id);
        $this->assign('statisticsData', $statisticsData);
        $this->display('statistics');
    }

    /**
    * 系统设置
    */
    public function system() {
        if (IS_POST) {
            //处理图片上传
            for($i = 0; $i < 3; $i++) {
                if (!empty($_FILES['slider']['tmp_name'][$i])) {
                    $upload = new \Think\Upload();// 实例化上传类
                    $upload->maxSize = 10485760 ;// 设置附件上传大小 10M
                    $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                    $upload->rootPath = './Public/wap/img/Index/index/slider/'; // 设置附件上传根目录
                    $upload->savePath = ''; // 设置附件上传（子）目录
                    $upload->saveName = 'slider'.$i;
                    $upload->replace = true;
                    $upload->autoSub = false;
                    $info = $upload->upload();
                    if(!$info) {// 上传错误提示错误信息
                        $this->error('滑动图片'.$i.$upload->getError());
                    }
                    $_POST['slider'][$i] = $info[$i]['savename'];
                }
            }
            //更新system信息
            $system = D('System')->getById(1);
            $system['slider'] = explode(';', $system['slider_img']);
            for ($i=0; $i < 3; $i++) { 
                if (empty($_POST['slider'][$i])) {
                    $_POST['slider'][$i] = $system['slider'][$i];
                }
            }
            $_POST['slider_img'] = implode(';', $_POST['slider']);
            D('system')->create($_POST);
            D('system')->save();
            $this->success('更新成功!', U('Admin/System'));
        }
        $this->assign('header', ['title'=>'系统设置', 'system'=>'active', 'system_system'=>'active','bread1'=>'系统', 'bread2'=>'系统设置', 'url'=>'system', 'icon'=>'icon-cog']);
        $this->display('system');
    }

    /**
    * 注销
    */
    public  function logout() {
        D('user')->userLogout('admin');
        $this->redirect('Admin/index');
    }

}