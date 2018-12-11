<?php 
//声明命名空间
namespace Admin\Controller;
//引入父类控制器
// use Think\Controller;
//声明类并继承父类
class EmailController extends CommonController {
	//发邮件
	public function send() {
		//判断是否提交了数据
		if (IS_POST) {
			//接收post数据
			$post = I('post.');
			//保存数据
			$result = D('Email')->operateData($post, $_FILES['file']);
			//判断结果
			if ($result) {
				$this->success('发送成功', U('sendBox'));
			} else {
				$this->error('发送失败');
			}
		} else {
			//获取收件人列表
			$data = M('User')->field('id, truename')->where('id <>' . session('id'))->select();
			//分配数据
			$this->assign('data', $data);
			$this->display();
		}
	}
	//发件箱
	public function sendBox() {
		//原生sql使用join法 select t1.*,t2.truename as truename from sp_email as t1 left join sp_user as t2 on t1.to_id=t2.id where t1.from_id='发送者id';
		// $data = M('Email')->field('t1.*,t2.truename as truename')->alias('t1')->join('left join sp_user as t2 on t1.to_id=t2.id')->where('t1.from_id=' . session('id'))->select();
		//原生sql使用两表法 select t1.*,t2.truename as truename from sp_email as t1,sp_user as t2 where t1.to_id=t2.id and t1.from_id=8;
		$data = M('Email')->field('t1.*,t2.truename as truename')->table('sp_email as t1,sp_user as t2')->where('t1.to_id=t2.id and t1.from_id=' . session('id'))->select();
		//分配模板
		$this->assign('data',$data);
		//展示模板
		$this->display();
	}
	//文件下载
	public function download() {
		//接收id
		$id = I('get.id');
		//查询
		$data = M('Email')->find($id);
		//下载
		$file = WORKING_PATH . $data['file']; //文件路径
		header('Content-type: application/octet-stream'); //以流方式发送给浏览器
		header('Content-Disposition: attachment; filename="' . basename($file) . '"'); //以附件形式发送给浏览器
		header('Content-length: ' . filesize($file)); //获取文件大小
		readfile($file); //输出文件
	}
	
	//收件箱
	public function recBox() {
		//查询数据
		//join原生SQL  select t1.*,t2.truename as truename from sp_email as t1 left join sp_user as t2 on t1.from_id=t2.id where t1.to_id='当前用户id'
		//table原生SQL select t1.*,t2.truename as truename from sp_email as t1,sp_user as t2 where t1.from_id=t2.id and t1.to_id='当前用户id'
		$data = M('Email')->field('t1.*,t2.truename as truename')->table('sp_email as t1,sp_user as t2')->where('t1.from_id=t2.id and t1.to_id=' . session('id'))->select();
		// dump($data);die;
		//分配数据
		$this->assign('data', $data);
		$this->display();
	}
	//获取内容
	public function getContent() {
		//接收id
		$id = I('get.id');
		//查询
		$data = M('Email')->where("id = $id and to_id = " . session('id'))->find();
		//修改读取状态
		if (!$data['isread']) {
			M('Email')->save(array('id'=>$id,'isread'=>'1'));
		}
		echo "<span style='color: violet; font-size:28px'>", $data['content'], "</span>";
	}
	//获取新邮件提示
	public function getCount() {
		if (IS_AJAX) {
			$count = M('Email')->where('isread = 0 and to_id = ' . session('id'))->count();
			echo $count;
		}
	}
}