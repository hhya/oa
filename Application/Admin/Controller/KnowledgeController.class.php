<?php
//声明命名空间
namespace Admin\Controller;
//引入父类
// use Think\Controller;
//声明类并继承父类
class KnowledgeController extends CommonController {
	//知识添加
	public function add() {
		if (IS_POST) {
			//接收数据
			$post = I('post.');
			//添加数据
			$result = D('Knowledge')->operateData($post, $_FILES['thumb']);
			if ($result) {
				$this->success('添加成功', U('showList'));
			} else {
				$this->error('添加失败');
			}
		} else {
			$this->display();
		}
	}
	//知识列表
	public function showList() {
		//查询数据
		$data = M('Knowledge')->select();
		//分配数据
		$this->assign('data', $data);
		//展示模板
		$this->display();
	}
	//文件下载
	public function download() {
		//接收id
		$id = I('get.id');
		//查询
		$data = M('Knowledge')->find($id);
		//下载
		//获取文件路径
		$file = WORKING_PATH . $data['picture']; 
		//以流方式发送给浏览器
		header("Content-type: application/octet-stream"); 
		//以附件形式发送给浏览器(弹出下载对话框)
		header('Content-Disposition: attachment; filename="' . basename($file) . '"'); 
		//获取文件大小
		header("Content-length: " . filesize($file));
		//输出文件
		readfile($file);
	}
}