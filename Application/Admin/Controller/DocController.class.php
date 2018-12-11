<?php
//声明命名空间
namespace Admin\Controller;
//引入父类控制器
// use Think\Controller;
//声明类并继承父类
class DocController extends CommonController {
	//公文列表
	public function showList() {
		//查询数据
		$data = M('Doc')->select();
		//分配至模板
		$this->assign('data', $data);
		//展示模板
		$this->display();	
	}
	//公文添加
	public function add() {
		if (IS_POST) {
			//创建数据对象
			//$data = $model->create();
			$post = I('post.');	
			//添加时间字段
			//$post['addtime'] = time();
			//实例化模型
			$model = D('Doc');
			//保存数据
			// $result = $model->saveData($post, $_FILES['file']);
			$result = $model->alterData($post, $_FILES['file']);
			//判断
			if ($result) {
				$this->success('添加成功', U('showList'));
			} else {
				$this->error('添加失败');
			}
		} else {
			//展示模板
			$this->display();
		}
		
	}
	//附件下载
	public function upload() {
		//接收id
		$id = I('get.id');
		//查询该条数据
		$data = M('Doc')->find($id);
		//执行下载
		$file = WORKING_PATH . $data['filepath'];//如"D:/Uploads/photo.jpg";
		header("Content-type: application/octet-stream");
		header('Content-Disposition: attachment; filename="' . basename($file) . '"');
		header("Content-Length: ". filesize($file));
		readfile($file);
	}
	//内容展示
	public function showContent() {
		//获取id
		$id = I('get.id');
		//查询该条数据
		$data = M('Doc')->find($id);
		//显示内容
		echo htmlspecialchars_decode($data['content']);	
	}
	//公文编辑
	public function edit() {
		if (IS_POST) {
			//接收数据
			$post = I('post.');
			//调用updateData方法修改数据
			// $result = D('Doc')->updateData($post, $_FILES['file']);
			$result = D('Doc')->alterData($post, $_FILES['file'], 'save');
			//判断
			if ($result) {
				$this->success('修改成功', U('showList'));
			} else {
				$this->error('修改失败');
			}
		} else {
			//接收id
			$id = I('get.id');
			//查询该条数据
			$data = D('Doc')->find($id);
			//分配数据
			$this->assign('data', $data);
			//展示模板
			$this->display();
		}
	}
}