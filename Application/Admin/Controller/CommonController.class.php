<?php 
//声明命名空间 
namespace Admin\Controller;
//引入父类控制器
use Think\Controller;
//声明类并继承父类
class CommonController extends Controller {
	public function _initialize() {
		if (empty(session('id'))) {
			// $this->error('请先登录', U('Public/login'));
			$url = U('Public/login');	
			echo "<script type='text/javascript'>top.location.href='$url'</script>";
		}
		//RBAC部分
		$role_id = session('role_id'); //获取当前用户角色id
		$rbac_role_auths = C('RBAC_ROLE_AUTHS'); //获取全部用户组权限
		$currRoleAuth = $rbac_role_auths[$role_id]; //获取当前角色权限

		//获取当前路由的控制器名和方法名
		$controller = strtolower(CONTROLLER_NAME);
		$action = strtolower(ACTION_NAME);

		//判断组成的权限形式是否在权限数组中
		if ($role_id <> 1) {  //不是超级管理员时
			if (!in_array($controller . '/' . $action, $currRoleAuth) && !in_array($controller . '/*', $currRoleAuth)) {
				//用户没有权限
				$this->error('您没有权限', U('Index/home'));exit;
			}
		}
	}

	//空操作
	public function _empty() {
		echo '您访问的页面不存在！';
	}
	//登录控制
	// public function __construct() {
	// 	//构造父类
	// 	parent::__construct();
	// 	if (empty(session('id'))) {
	// 		// $this->error('请先登录', U('Public/login'));
	// 		$url = U('Public/login');	
	// 		echo "<script type='text/javascript'>top.location.href='$url'</script>";
	// 	}
	// 	//RBAC
	// 	dump(session('role_id'));die;
	// }
}


