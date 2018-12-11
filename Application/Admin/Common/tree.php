<?php

#递归方法实现无限级分类
function getTree($list, $pid=0, $level=0) {
	static $tree = array();
	foreach ($list as $row) {
		if ($row['pid'] == $pid) {
			$row['level'] = $level;
			$tree[] = $row;
			getTree($list, $row['id'], $level + 1);
		}
	}
	return $tree;
}

$arr = array
(
    0 => Array
        (
            'id' => 1,
            'name' => '人事部',
            'pid' => 2,
        ),

    1 => Array
        (
            'id' => 2,
            'name' => '财务部',
            'pid' => 0,
        ),

    2 => Array
        (
            'id' => 3,
            'name' => '行政部',
            'pid' => 1,
        ),

    3 => Array
        (
            'id' => 4,
            'name' => '技术部',
            'pid' => 0,
        ),

    4 => Array
        (
            'id' => 5,
            'name' => '市场部',
            'pid' => 0,
        ),

    5 => Array
        (
            'id' => 6,
            'name' => '公关部',
            'pid' => 5,
        ),

    6 => Array
        (
            'id' => 7,
            'name' => '后勤部',
            'pid' => 0,
        ),

    7 => Array
        (
            'id' => 8,
            'name' => '审计部',
            'pid' => 3,
        )

);
// // print_r(getTree($arr));


// function getLevel($list, $pid = 0, $level = 0) {
// 	static $tree = array();
// 	foreach ($list as $key => $value) {
// 		if ($value['pid'] == $pid) {
// 			$value['level'] = $level;
// 			$tree[] = $value;
// 			getLevel($list, $value['id'], $level + 1);
// 		}
// 	}
// 	return $tree;
// }

// print_r(getLevel($arr));

function get($list, $pid = 0, $level = 0) {
	static $tree = array();
	foreach ($list as $value) {
		if ($value['pid'] == $pid) {
			$value['level'] = $level;
			$tree[] = $value;
			get($list, $value['id'], $level + 1);
		}
	}
	return $tree;
}
// print_r(get($arr));