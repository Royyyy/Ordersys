<?php
namespace app\index\controller;
use think\Controller;
use think\Url;
class Index extends Controller
{
    function __construct() 
    {
        parent::__construct();
      
    }
    public function index()
    {
        return view();
    }
  public function hello($name = "张山"){
        echo "llll".$name;
    }
}
