<?php
/**
 * Created by PhpStorm.
 * User: chok
 * Date: 2017/12/6
 * Time: 11:25
 */
function show($status, $message='' , $data=[]) {
    return [
        'status' => intval($status),
        'message' => $message,
        'data' => $data,
    ];
}