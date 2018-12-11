<?php 

//声明命名空间
namespace Admin\Controller;
//引入父类
// use Think\Controller;
//创建新类并继承父类
class UserController extends CommonController {
	//职员列表
	// public function showList() {
	// 	//获取用户信息
	// 	$data = M('User')->select();
	// 	//分配到模板
	// 	$this->assign('data', $data);
	// 	$this->display();
	// }
	//职员列表（带分页）
	public function showList() {
		$model = M('User');
		//第一步：查询总记录娄
		$count = $model->count();
		//第二步：实例化分页类，传递参数
		$page = new \Think\Page($count, 3); //每页显示2个
		//第三步：定义提示文字（可选）
		$page->rollPage = 5;
		$page->lastSuffix = false;
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$page->setConfig('first', '首页');
		$page->setConfig('last', '尾页');
		//第四步：通过show方法输出分页页码链接
		$show = $page->show();
		//第五步：通过limit方法查询数据
		$data = $model->limit($page->firstRow, $page->listRows)->select();
		//第六步：分配数据
		$this->assign('count', $count);
		$this->assign('show', $show);
		$this->assign('data', $data);
		//第七步：展示模板
		$this->display();
	}
	//使用highcharts统计用户数量
	public function charts() {
		//查询部门用户信息
		$model = M();
		//原生sql
		// $sql = "select t2.name as deptname,count(*) as count from sp_user as t1 left join sp_dept as t2 on t1.dept_id=t2.id group by deptname";
		// $sql = "select t2.name as deptname,count(*) as count from sp_user as t1,sp_dept as t2 where t1.dept_id=t2.id group by deptname";
		// $data = $model->query($sql);
		$data = $model->field('t2.name as deptname,count(*) as count')->table('sp_user as t1,sp_dept as t2')->where('t1.dept_id=t2.id')->group('deptname')->select();
		//遍历数组。拼接数据
		foreach ($data as $value) {
			$str .= "['" . $value['deptname'] . "', " . $value['count'] . "],";
		}
		$data = '[' . rtrim($str, ',') . ']';
		$this->assign('data', $data);
		$this->display();
	}
	//职员添加
	public function add() {
		if (IS_POST) {
			//实例化模型
			$model = M('User');
			//创建数据对象
			$data = $model->create();
			//添加时间标识
			$data['addtime'] = time();
			//保存到数据表
			$result = $model->add($data);
			//判断
			if ($result) {
				$this->success('添加成功', U('showList'));
			} else {
				$this->error('添加失败');
			}
		} else {
			//获取部门信息
			$data = M('Dept')->field('id,name,pid')->select();
			//载入分级文件
			load('@/tree');
			//获取分级后数据
			$data = getTree($data);
			//展示在模板上
			$this->assign('data', $data);
			$this->display();
		}
	}
	//职员编辑
	public function edit() {
		//实例化模型
		$model = M('User');
		if (IS_POST) {
			//创建数据对象
			$post = $model->create();
			//更新数据
			$result = $model->save();
			//判断
			if ($result !== false) {
				$this->success('修改成功', U('showList'));
			} else {
				$this->error('修改失败');
			}
		} else {
			//接收id
			$id = I('get.id');
			//查找该用户数据
			$data = $model->find($id);
			//获取部门信息
			$info = M('Dept')->field('id,name,pid')->select();
			//载入分级文件
			load('@/tree');
			//获取分级后数据
			$info = getTree($info);
			//分配到模板
			$this->assign('data', $data);
			$this->assign('info', $info);
			$this->display();
		}
	}
	//职员删除
	public function del() {
		//删除用户
		$result = M('User')->delete(I('get.id'));
		//判断
		if ($result) {
			$this->success('删除成功', U('showList'));
		} else {
			$this->error('删除失败');
		}
	}
}
