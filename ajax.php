<?php 

// 允许单个域名localhost访问
// header('Access-Control-Allow-Origin: http://localhost');

// 允许多个域名访问 
// 跨域访问的时候才会存在此字段
//获取要跨域访问的请求源
// $origin = isset($_SERVER['HTTP_ORIGIN'])? $_SERVER['HTTP_ORIGIN'] : '';  
//定义允许跨域访问的请求源  
// $allow_origin = array('http://localhost', 'http://shop.com');  
//如果请求源在允许列表中就设置允许访问  
// if (in_array($origin, $allow_origin)) {  
//     header('Access-Control-Allow-Origin:' . $origin);     
// }
//允许所有域名访问
header('Access-Control-Allow-Origin: *');
echo '<h1>这是oa.com上的响应</h1>';
foreach ($_SERVER as $key => $value) {
	echo '<li>',$key,'=>',$value,'</li><br>';
}


 ?>