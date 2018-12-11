<?php 
//声明命名空间
namespace Admin\Model;
//引入父类模型
use Think\Model;
//声明模型并继承父类模型
class DeptModel extends Model {
	//开启批量验证
	// protected $patchValidate = true;
	//定义自动验证
	protected $_validate = array(
			//针对部门名称的规则，必填且不重复	
			array('name','require','部门不能为空'),
			array('name','','部门已存在',0,'unique'),
			//排序sort字段必须为数字
			// array('sort','num','排序必须为数字')
			array('sort','is_numeric','不是数字',0,'function'),
			array('remark','require','备注不能为空')
	);
	//定义字段映射
	protected $_map = array(
			'name_n'=>'name',
			'pid_p'=>'pid',
			'sort_s'=>'sort',
			'remark_r'=>'remark'
	);
}