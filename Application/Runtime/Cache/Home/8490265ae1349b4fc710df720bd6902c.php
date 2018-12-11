<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<h1>模板'常量'</h1>
<h2>/oa： ROOT表示当前网站地址</h2>
<h2>/oa/index.php： APP表示当前应用地址</h2>
<h2>/oa/index.php/Home/Test： URL和CONTROLLER相同</h2>
<h2>/oa/index.php/Home： MODULE表示域名开始到分组模块结束的路由</h2>
<h2>/oa/index.php/Home/Test：CONTROLLER表示域名开始到控制器结束的路由</h2>
<h2>/oa/index.php/Home/Test/test： ACTION表示域名开始到方法结束的路由</h2>
<h2>/oa/Public： PUBLIC表示站点根目录下Public目录的路由</h2>
<h2>/oa/index.php/home/test/test： SELF表示域名后开始直到路由最后（如果无参，则SELF和ACTION相同）</h2>
<h2>/oa/Public/Admin： 自定义模板常量</h2>
<h2>
<!-- 这是HTML中的注释（客户端） -->
这是ThinkPHP中的行注释（服务器端）：<br>
这是ThinkPHP中的块注释（服务器端）：<br>
<!-- 数组 -->
数组逗号形式:<?php echo ($arr["0"]); ?>-<?php echo ($arr["1"]); ?>-<?php echo ($arr["2"]); ?>-<?php echo ($arr["3"]); ?><br>
数组括号形式:<?php echo ($arr[0]); ?>-<?php echo ($arr[1]); ?>-<?php echo ($arr[2]); ?>-<?php echo ($arr[3]); ?><br>
VOLIST循环形式:
<?php if(is_array($arr)): $i = 0; $__LIST__ = $arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 3 );++$i; if(($mod) == "2"): echo ($vo); ?>-<?php endif; ?>
	<!-- <?php echo ($i); ?>.<?php echo ($vo); ?>- --><?php endforeach; endif; else: echo "" ;endif; ?>
<br>
FOREACH循环形式:
<?php if(is_array($arr)): foreach($arr as $key=>$for): echo ($for); ?>-<?php endforeach; endif; ?>
<br>
<!-- 对象属性 -->
对象冒号形式：<?php echo ($obj->name); ?>-<?php echo ($obj->id); ?><br>
对象箭头形式：<?php echo ($obj->name); ?>-<?php echo ($obj->id); ?><br>
<!-- ThinkPHP系统内置变量 -->
$Think.cookie.PHPSESSID: <?php echo (cookie('PHPSESSID')); ?><br>
$Think.config.DEFAULT_MODULE: <?php echo (C("DEFAULT_MODULE")); ?>
</h2>
<h1><?php echo (date('Y-m-d: H:i:s',$t)); ?></h1><hr>
<h1><?php echo (substr(strtoupper($s),0,5)); ?></h1><hr>
<h1><?php echo ((isset($si) && ($si !== ""))?($si):'这个家伙很懒......'); ?></h1>
<hr>
<h1>
	<!-- ThinkPHP的if语句中只有==、！=可以用，其它必须要用比较标签 -->
<?php if($val === 8): ?>/
	等于8
<?php else: ?>
	不等于8<?php endif; ?>
</h1>
</body>
</html>