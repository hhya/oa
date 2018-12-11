<?php 
//声明命名空间
namespace Admin\Controller;
//引入父类
use Think\Controller;
//声明类并继承父类
class EmptyController extends Controller {
	//定义空操作
	public function _empty() {
		echo '您访问的控制器不存在！';
	}
}




