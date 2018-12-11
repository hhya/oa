<?php 
//声明命名空间
namespace Admin\Controller;
//引入父类控制器
// use Think\Controller;
//声明类并继承父类控制器
class DeptController extends CommonController {
	public function instance() {
		// $obj = new \Admin\Model\DeptModel();//普通实例化
		// $obj = D();//不传参的D()方法，依靠Think\Model类，等同于M()方法
		// $obj = D('dept');//自定义模型的实例化，参数必须是数据库中存在的不带前缀的表名
		// $obj = M();等同于D()
		$obj = M('dept');
		dump($obj);	
	}
	public function tianjia() {
		$model = M('dept');
		// $data = array(
		// 	'name'   => '人事部',
		// 	'pid'    => 0,
		// 	'sort'   => 1,
		// 	'remark' => '这是人事部'	
		// );
		$data = array(
			array( 
				'name'   => '财务部',
				'pid'    => 0,
				'sort'   => 2,
				'remark' => '这是财务部',
			),
			array(
				'name'   => '行政部',
				'pid'    => 0,
				'sort'   => 3,
				'remark' => '这是行政部'
			),
			array(
				'name'   => '技术部',
				'pid'    => 0,
				'sort'   => 4,
				'remark' => '这是技术部'
			),
			array(
				'name'   => '市场部',
				'pid'    => 0,
				'sort'   => 5,
				'remark' => '这是市场部'
			)
		);
		// $res = $model->add($data);//$data必须是关联数组，执行结束表示主键id
		$res = $model->addAll($data);//$data外层必须是下标从0开始的索引数组，内层必须是与表字段对应的关联数组
		dump($res);
	}
	public function xiugai() {
		$model = M('dept');
		// $data = array(
		// 	'id'    => 5,
		// 	'name'  => 'market'
		// );
		$model->id = 5;
		$model->name = '市场部';
		// $res = $model->save($data);
		$res = $model->save();//AR模式操作
		dump($res);
	}
	public function chaxun() {
		$model = M('dept');
		// $res = $model->find(2);//返回一维数组
		$res = $model->select('2,3');//返回二维数组
		dump($res);
	}
	public function shanchu() {
		$model = M('dept');
		$res = $model->delete('1,2');
		dump($res);
	}
	public function add() {
		//判断请求类型
		if (IS_POST) {
			//处理表单提交
			// $post = I('post.');//方法一
			//创建数据对象
			$model = D('dept');
			$post = $model->create();//方法二包含自动验证机制
			//判断提交字段是否为空
			// if (empty($post[name]) || empty($post[sort]) || empty($post[remark])) {
			// 	$this->error('请填写完整');
			// }
			if (!$post) {
				// dump($model->getError());exit;
				$this->error($model->getError());exit;
			}
			//写入数据
			$result = D('dept')->add();
			if ($result) {
				$this->success('添加成功',U('showList'),3);
			} else {
				$this->error('添加失败');
			}
		} else {
			$data = D('dept')->where('pid=0')->select();//查询顶级部门
			$this->assign('data',$data);
			$this->display();	
		}			
	}
	//列表展示
	public function showList() {
		//实例化模型并查询数据
		$model = M('dept');
		$data = $model->order('sort')->select();
		//二次查询遍历
		foreach ($data as $key => $value) {
			//查询pid对应的部门信息
			if ($value['pid'] > 0) {
				//获取上级部门信息(用子部门的pid作为上级部门的id)
				$info = $model->find($value['pid']);
				//将上级部门名称赋给子部门
				$data[$key]['pname'] = $info['name'];
			}
		}
		//使用load方法载入无限分级文件
		load('@/tree');
		$data = getTree($data);
		//分配到模板
		$this->assign('data',$data);
		$this->display();
	}

	//列表编辑
	public function edit() {
		//实例化模型
		$model = M('Dept');
		if (IS_POST) {
			//创建post数据对象
			$post = $model->create();
			// dump($post);die;
			// $condition = $post['name'];
			// dump($condition);die;
			//保存数据
			// $result = $model->where("name = '$condition'")->save($post);
			$result = $model->save(); // save方法有效条件：包含更新条件where 或 数据对象本身包含主键字段(如id)
			//判断成功与否
			if ($result !== false) { //不全等于false,表示可以不修改提交
				$this->success('编辑成功', U('showList'));
			} else {
				$this->error('编辑失败');
			}
		} else {
			//接收id
			$id = I('get.id');
			//查询该部门信息
			$data = $model->find($id);
			//查询不包含本部门的其它全部部门信息
			$info = $model->where("id != $id")->select();
			//变量分配
			$this->assign('data', $data);
			$this->assign('info', $info);
			//展示模板
			$this->display();
		}
	}

	//列表删除
	public function del() {
		// //接收id
		// $id = I('get.id');
		// //实例化模型
		// $model = M('Dept');
		//执行删除
		$result = M('Dept')->delete(I('get.id'));
		//判断
		if ($result) {
			$this->success('删除成功');
		} else {
			$this->error('删除失败');
		}
	}
}