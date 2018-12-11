<?php
return array(
	//'配置项'=>'配置值'
	//自定义模板常量
	'TMPL_PARSE_STRING'=>array(
		'__ADMIN__'=>__ROOT__.'/Public/Admin',
	),
    //引入数据库配置项
	'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  '127.0.0.1', // 服务器地址
    'DB_NAME'               =>  'db_oa',     // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  '',          // 密码
    'DB_PORT'               =>  '3306',      // 端口
    'DB_PREFIX'             =>  'sp_',    	 // 数据库表前缀
    //显示跟踪信息
    'SHOW_PAGE_TRACE'       =>  TRUE,        // 默认为false
    //配置文件加载：位于（Application/Common/Common
    'LOAD_EXT_FILE'         =>  'getInfo,getServer',

    //RBAC权限管理
    //角色数组
    'RBAC_ROLES'            =>   array(
                                        1=>'超级管理组',
                                        2=>'中级管理组',
                                        3=>'普通管理组'
                                    ),
    //权限数组
    'RBAC_ROLE_AUTHS'       =>   array( //形式为 控制器/方法
                                        1=>'*/*', 
                                        2=>array('index/*','email/*','doc/*','knowledge/*'),
                                        3=>array('index/*','email/*','knowledge/*','doc/showlist')
                                    ),
);