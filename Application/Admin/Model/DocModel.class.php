<?php
//声明命名空间
namespace Admin\Model;
//引入父类
use Think\Model;
//声明类并继承父类
class DocModel extends Model {
	//数据添加方法
	public function saveData($post, $file) { //post接收的数据，上传的单个文件
		//判断是否上传文件
		if (!$file['error']) {
			//定义配置项
			$cfg = array(
				'rootPath'  =>  WORKING_PATH . UPLOAD_ROOT_PATH //配置根路径
			);
			//实例化文件上传类
			$upload = new \Think\Upload($cfg);
			//执行上传
			$info = $upload->uploadOne($file);
			//判断文件上传
			if ($info) {
				//添加post字段进数据表
				$post['filepath'] = UPLOAD_ROOT_PATH . $info['savepath'] . $info['savename'];
				$post['filename'] = $info['name'];
				$post['hasfile'] = 1;
			}
		}
		//添加上传时间
		$post['addtime'] = time();
		//添加数据
		return $this->add($post);
	}
	//数据修改方法
	public function updateData($post, $file) {
		dump($post);
		//判断是否上传文件
		if (!$file['error']) {
			//定义配置项
			$cfg = array('rootPath' => WORKING_PATH . UPLOAD_ROOT_PATH);
			//实例化上传类
			$upload = new \Think\Upload($cfg);
			//执行上传
			$info = $upload->uploadOne($file);
			if ($info) {
				//补全post数据
				$post['filepath'] = UPLOAD_ROOT_PATH . $info['savepath'] . $info['savename'];
				$post['filename'] = $info['name'];
				$post['hasfile'] = 1;
			}
		}
		return $this->save($post);
	}
	//数据添加和修改方法（二合一）
	public function alterData($post, $file, $method='add') {
		//判断文件是否上传
		if (!$file['error']) {
			//定义配置文件的保存根路径
			$cfg = array('rootPath'=>WORKING_PATH . UPLOAD_ROOT_PATH);
			//实例化文件上传类
			$upload = new \Think\Upload($cfg);
			//执行上传
			$info = $upload->uploadOne($file);
			//判断
			if ($info) {
				//补全post信息
				$post['filepath'] = UPLOAD_ROOT_PATH . $info['savepath'] . $info['savename'];
				$post['filename'] = $info['name'];
				$post['hasfile'] = 1;
			}
		}
		//判断是添加还是修改
		if ($method == 'add') {
			//添加时间
			$post['addtime'] = time();
			//添加数据
			return $this->add($post);
		} else if ($method == 'save') {
			//修改数据
			return $this->save($post);
		}
		
	}
}