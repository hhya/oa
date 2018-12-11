<?php 
//声明命名空间
namespace Admin\Model;
//引入父类模型
use Think\Model;
//声明类并继承父类
class EmailModel extends Model {
	//数据操作方法
	public function operateData($post, $file, $method='add') {
		//判断是否上传文件
		if (!$file['error']) {
			//配置上传根目录
			$cfg = array('rootPath'=>WORKING_PATH . UPLOAD_ROOT_PATH);
			//实例化上传类
			$upload = new \Think\Upload($cfg);
			//执行上传
			$info = $upload->uploadOne($file);
			//判断
			if ($info) {
				//补全字段
				$post['file'] = UPLOAD_ROOT_PATH . $info['savepath'] . $info['savename'];
				$post['hasfile'] = '1';
				$post['filename'] = $info['name'];	
			}
		}
		//发送者id
		$post['from_id'] = session('id');
		//判断是新增还是修改
		if ($method == 'add') {
			//添加时间
			$post['addtime'] = time();
			//新增数据
			return $this->add($post);
		} else if ($method == 'save') {
			//修改数据
			return $this->save($post);
		}
	}
}