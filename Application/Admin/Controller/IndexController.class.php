<?php 
//声明命名空间
namespace Admin\Controller;
//引入父类
use Think\Controller;
//声明Index类并继承父类
class IndexController extends CommonController {
	//index方法，展示模板
	public function index() {
		$this->display();
	}
	//home方法，展示模板
	public function home() {
		$this->display();
	}
}







