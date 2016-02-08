<?php
namespace Home\Model;
use Think\Model;
class UserModel extends Model {

    protected $_validate = array(
        array('username','','用户名已经存在！',0,'unique',1), 
        array('repassword','password','确认密码不正确',0,'confirm'),
        array('username','require','请输入用户名!'),
        array('password','require','请输入密码!'),
        array('phone','require','请输入电话!'),
        array('qq','require','请输入QQ号码!'),
    );

    protected $_auto = array(
        array('password','sha1',3,'function'),
        array('password','md5',3,'function'),
    );

    /**
    * 用户登录
    * @param array $data post数据
    * @return boolean 登录是否成功
    */
    public function userLogin($data, $type) {
        $user = $this->where(['username'=>$data['username'], 'password'=>md5(sha1($data['password'])), 'type'=>$type])->find();
        if (!$user) {
            return false;
        }
        session($type, $user);            
        return true;
    }


    /**
    * 用户是否登录
    * @return boolean 当前是否有用户登录
    */
    public function userIfLogin($type) {
        if (!session($type)) {
            return false;
        }
        $user = session($type);
        if ($this->where(['username'=>$user['username'], 'password'=>$user['password'], 'type'=>$type])->find()) {
            return true;
        }
        return false;
    }


    /**
    * 获取分页的用户列表
    * @param string $type 用户类型
    */
    public function getUserList($type = 'user') {
        $count = $this->where(['type'=>$type])->count();// 查询满足要求的总记录数
        $page = new \Org\Util\AdminPage($count);// 实例化分页类 传入总记录数
        $show = $page->show();// 分页显示输出
        // 进行分页数据查询
        $list = $this->where(['type'=>$type])->limit($page->firstRow.','.$page->listRows)->select();
        return $user=['list'=>$list, 'page'=>$show];
    }

    /**
    * 通过关键字查询用户
    * @param array $data 需要查询的关键字
    * @param string $type 需要查询的用户类型
    */
    public function getUserByFind($data, $type = 'user') {
        //--查找是哪个关键字需要查找
        foreach ($data as $key => $value) {
            if ($value != '') {
                $findKey = $key;
                $findWord = $value;
                break;
            }
        }
        return $user = $this->where([$findKey=>$findWord, 'type'=>$type])->select();
    }

    /**
    * 重置密码
    * @param intger 用户id
    */
    public function resetPassword($id) {
        $user = $this->where(['id'=>$id])->find();
        $this->where(['id'=>$id])->data(['password'=>md5(sha1($user['username']))])->save();
        return true;
    }

    /**
    * 删除用户
    * @param intger 用户id
    */
    public function deleteUser($id) {
        return $this->where(['id'=>$id])->delete();
    }


    /**
    * 用户注销登录
    */
    public function userLogout($type = 'user') {
        session($type, null);            
        return true;
    }

    /**
    * 注册
    * @param array $data 注册信息
    */
    public function userRegister($data) {
        //用户类型
        if ($this->create($data)) {
            $id = $this->add();
            $user = D('user')->getById($id);
            session($data['type'], $user);
            return array(
                'ret'=>$id, //新增用户ID
                'msg'=>$this->getError(),
            );
        } else {
            return array(
                'ret'=>false,
                'msg'=>$this->getError(),
            );
        }

    }
}