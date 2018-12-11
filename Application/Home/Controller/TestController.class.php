<?php
namespace Home\Controller;
use Think\Controller;
class TestController extends Controller {
	public function test() {
		$this->display();
	}
	public function test1() {
		$this->success('跳转成功',U('Index/index'),6);
	}
	public function test2() {
		$this->error('跳转失败',U('test1'),6);
	}
	public function test3() {//变量分配（对象）
		$obj = new Study();
		$obj->name = '超文本预处理';
		$obj->id = 100;
		$time = time();
		$str = 'abCdEfghikLMN';
		// $sign = '呵呵';
		// $sign = $sign ?:'懒懒懒......';
		$val = '8';
		$arr = array('西游记','三国演义','水浒传','红楼梦');
		$this->assign('arr',$arr);
		$this->assign('val',$val);
		$this->assign('t', $time);
		$this->assign('s', $str);
		$this->assign('si',$sign);
		$this->assign('obj',$obj);
		$this->display('test');
	}
	public function test4() {
		$model = M('dept');
		// echo M('dept')->getLastSql();
		echo $model->_sql(),'<br>',$model->fetchsql(true)->select();
		dump($model);
	}
	//G()记录和统计时间
	public function test5() {
		G('begin');
		for ($i=0; $i < 100000; $i++) { 
			echo $i;
		}
		G('end');
		echo '<hr>',G('begin','end',6),'s';
	}
	public function test6() {
		$model = M('dept');
		$model->limit(1);
		$data = $model->select();
		dump($data);
	}
	public function test7() {
		$model = M('dept');
		$model->group('name');
		$model->field('name,count(*) as count');
		$data = $model->select();
		dump($data);
	}
	public function test8() {
		$model = M('dept');
		// $data = $model->count();
		// $data = $model->max('id');
		// $data = $model->min('id');
		// $data = $model->avg('id');
		$data = $model->sum('id');
		dump($data);
	}
	//session
	public function test9() {
		//设置
		session('Fname','L');
		session('Lname','sa');
		session('age',1);
		dump($_SESSION);
		//读取单个
		$value = session('Fname');
		dump($value);
		//清空单个
		session('Fname',null);
		dump($_SESSION);
		//清空全部
		// session(null);
		// dump($_SESSION);
		//读取全部
		dump(session());
		//判断某个SESSION是否存在
		dump(session('?age'));
	}
	//cookie
	public function test10() {
		//设置
		cookie('name1','Lsa');
		cookie('name2','Xdh',10);
		cookie('name3',array('L','yx'));
		//读取单个cookie值
		$values = cookie('name2');
		dump($values);
		//cookie值设为null
		// cookie('namex',null);
		// cookie(null);
		cookie();
	}
	//文件的加载
	//1、函数库形式加载文件
	public function test11() {
		getTime();
	}
	//2、通过配置项动态加载(LOAD_EXT_FILE在应用级别配置文件中定义Application/Common/config.php)
	public function test12() {
		getInfo();
	}
	public function test13() {
		dump(getServer());
	}
	//3、通过LOAD手动加载文件(文件必须位于分组级别的函数目录中，如Application/Home/Common)
	public function test14() {
		LOAD('@/hello');
		echo sayHello('Kitty');
	}

	//常规验证码
	public function test15() {
		//配置
		$cfg = array(
			'fontSize'  =>  25,              // 验证码字体大小(px)
	        'useCurve'  =>  false,           // 是否画混淆曲线
	        'useNoise'  =>  false,           // 是否添加杂点	
	        'imageH'    =>  0,               // 验证码图片高度
	        'imageW'    =>  0,               // 验证码图片宽度
	        'length'    =>  4,               // 验证码位数
	        'fontttf'   =>  '4.ttf',         // 验证码字体，不设置随机获取
	    );
		//实例化验证码类
		$verify = new \Think\Verify($cfg);
		//输出验证码
		$verify->entry();
	}
	//中文验证码
	public function test16() {
		//配置
		$cfg = array(
	        'useZh'     =>  true,            // 使用中文验证码 
			'fontSize'  =>  26,              // 验证码字体大小(px)
	        'useCurve'  =>  false,           // 是否画混淆曲线
	        'useNoise'  =>  true,            // 是否添加杂点	
	        'imageH'    =>  0,               // 验证码图片高度
	        'imageW'    =>  0,               // 验证码图片宽度
	        'length'    =>  4,               // 验证码位数
	        'fontttf'   =>  '',              // 验证码字体，不设置随机获取
	    );
		//实例化
		$verify = new \Think\Verify($cfg);
		$verify->entry();
	}
	//实例化不带前缀的特殊表
	public function test17() {
		$model = D('Userphp');
		dump($model);
	}
			//原生sql法
		// $sql = "select t1.*,t2.name as deptname from sp_user as t1,sp_dept as t2 where t1.dept_id=t2.id";
		// $result = $model->query($sql);
		//table法
	//多表联查(table)
	public function test18() {
		//实例化模型
		$model = M();
		$result = $model->field('t1.*, t2.name as deptname')->table('sp_user as t1, sp_dept as t2')->where('t1.dept_id = t2.id')->select();
		dump($result);
	}
	//多表联查(join)
	public function test19() {
		//实例化模型
		$model = M('User');
		$result = $model->field('t1.*, t2.name as deptname')->alias('t1')->join('left join sp_dept as t2 on t1.dept_id = t2.id')->select();
		dump($result);
	}
	public function test69() {
		//原生
		// $sql = 'select t1.*,t2.name as pname from sp_dept as t1 left join sp_dept as t2 on t1.pid=t2.id';
		// $result = M()->query($sql);
		// dump($result);
		//join法
		$model = M('Dept');
		$result = $model->field('t1.*, t2.name as pname')->alias('t1')->join('left join sp_dept as t2 on t1.pid=t2.id')->select();
		dump($result);
	}
	//获取ip
	public function test20() {
		echo get_client_ip(), '<br>';
		$ip = gethostbyname('www.baidu.com');
		echo ip2long($ip), '<br>', long2ip(ip2long($ip));
	}
	//数组编码转换
	public function array_iconv($in_charset, $out_charset, $arr) {
		// return eval('return ' . iconv($in_charset, $out_charset, var_export($arr, true)) . ';');
		return iconv($in_charset, $out_charset, var_export($arr, true));
	}
	// 'return ' . iconv($in_charset, $out_charset, var_export($arr, true)) . ';'	
	//获取ip物理地址
	public function test21() {
		//实例化IpLocation类
		$ip = new \Org\Net\IpLocation('qqwry.dat');
		$ss = I('get.ip');
		//获取物理地址
		$data = $ip->getlocation($ss);
		// $data = iconv('gbk','utf-8',serialize($data)); 
		//调用数组编码转换函数
		$data = $this->array_iconv('gbk', 'utf-8', $data);
		dump($data);
	}
	//测试var_export方法
	public function test22() {
		$a = array('hello', 'world', array('hello', 'world'));
		$rs = var_export($a, true);
		echo $rs;
	}
	public function getArea() {
		//实例化IpLocation类
		$ipObj = new \Org\Net\IpLocation('qqwry.dat');
		//地址栏传ip
		$ip = I('get.ip');
		//获取物理地址
		$result = $ipObj->getlocation($ip);
		$result = $this->array_iconv('gbk', 'utf-8', $result);
		//输出
		dump($result);
	}
}