<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
      //  ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
      //  ':name' => ['index/hello', ['method' => 'post']],
    ],
    'hello/[:name]' =>['index/index/hello',['method' => 'get', 'ext' => 'html']],
    // 定义闭包
   // 'hello/[:name]' => function ($name) {
   //     return 'Hello, 闭包' . $name . '!';
  //  }, 
    'today/[:year]/[:month]' =>['index/index/today',['method'=>'get'],['year'=>'\d{4}','month'=>'\d{2}']],
];













