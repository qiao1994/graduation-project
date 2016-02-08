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
    * 登录
    * @param array post数据
    * @return boolean 登录是否成功
    */
    public function userLogin($data) {
        $user = $this->where(['username'=>$data['username'], 'password'=>md5(sha1($data['password']))])->find();
        if (!$user) {
            return false;
        }
        session('user', $user);            
        return true;
    }

    /**
    * 用户是否登录
    * @return boolean 当前是否有用户登录
    */
    public function userIfLogin() {
        if (!session('user')) {
            return false;
        }
        $user = session('user');
        if ($this->where(['username'=>$user['username'], 'password'=>$user['password']])->find()) {
            return true;
        }
        return false;
    }

    /**
    * 注销登录
    */
    public function userLogout($data) {
        session('user', null);            
        return true;
    }


    /**
    * 注册
    * @param array $data 注册信息
    */
    public function userRegister($data) {
        if ($this->create($data)) {
            $ret = $this->add();
        } else {
            return array(
                'ret'=>false,
                'msg'=>$this->getError(),
            );
        }
        $user = $this->where(['id'=>$ret])->find();
        session('user', $user);  
        return array(
            'ret'=>true,
            'msg'=>$this->getError(),
        );
    }
}