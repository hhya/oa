<?php 
//声明命名空间
namespace Admin\Model;
//引入父类模型
use Think\Model;
//声明类并继承父类
class KnowledgeModel extends Model {
	//数据操作方法
	public function operateData($post, $file, $method='add') {
		//判断文件是否上传
		if (!$file['error']) {
			//定义配置文件
			$cfg = array('rootPath'=>WORKING_PATH . UPLOAD_ROOT_PATH);
			//实例化文件上传类
			$upload = new \Think\Upload($cfg);
			//执行上传
			$info = $upload->uploadOne($file);
			// dump($info);
			if ($info) {
				//补充字段
				$post['picture'] = UPLOAD_ROOT_PATH . $info['savepath'] . $info['savename'];
				//制作缩略图
				$image = new \Think\Image(); //实例化图片处理类
				$image->open(WORKING_PATH . $post['picture']); //打开图片(传递图片路径)
				$image->thumb(100, 100); //生成缩略图，等比绽放
				$image->save(WORKING_PATH . UPLOAD_ROOT_PATH . $info['savepath'] . 'thumb_' .  $info['savename']); //保存缩略图(需传递完整图片路径：目录+文件名)
				$post['thumb'] = UPLOAD_ROOT_PATH . $info['savepath'] . 'thumb_' . $info['savename'];
			}
		}
		if ($method == 'add') {
			//添加时间
			$post['addtime'] = time();
			//返回添加数据
			return $this->add($post);
		} else if ($method == 'save') {
			//返回修改数据
			return $this->save($post);
		}
	}
}