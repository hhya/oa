<?php
//声明命名空间
namespace Admin\Controller;
//引入父类控制器
use Think\Controller;
//声明类并继承父类
// class PublicController extends Controller {
class PublicController extends Controller {
	//登陆方法
	public function login() {
		$this->display();
	}
	//captcha验证码方法
	public function captcha() {
		//配置
		$cfg = array(
			'fontSize'  =>  12,              // 验证码字体大小(px)
	        'useCurve'  =>  false,            // 是否画混淆曲线
	        'useNoise'  =>  false,            // 是否添加杂点	
	        'imageH'    =>  39,               // 验证码图片高度
	        'imageW'    =>  85,               // 验证码图片宽度
	        'length'    =>  4,               // 验证码位数
	        'fontttf'   =>  '4.ttf',         // 验证码字体，不设置随机获取
		);
		//实例化
		$verify = new \Think\Verify($cfg);
		//输出验证码
		$verify->entry();
	}
	//checkLogin检验方法
	public function checkLogin() {
		//接收数据
		$post = I('post.');
		//检验数据
		$verify = new \Think\Verify();//实例化验证码类
		$res = $verify->check($post['captcha']);//获取校验验证码结果
		if ($res) {
			//如果验证码正确，继续校验用户名和密码
			unset($post['captcha']);//释放验证码元素
			//查询数据
			$data = M('user')->where($post)->find();
			if ($data) { 
				//用户密码存在，则将用户信息持久化保存到session中，并跳转到后台首页
				session('id', $data['id']);
				session('username', $data['username']);
				session('role_id', $data['role_id']); //角色id
				$this->success('登陆成功', U('Index/index'));	
			} else { //用户名或密码错误
				$this->error('用户名或密码错误');
			}
		} else {
			$this->error('验证码错误');
		}

	}
	//退出
	public function logout() {
		//清除session
		session(null);
		$this->success('退出成功', U('login'));
	}
}
