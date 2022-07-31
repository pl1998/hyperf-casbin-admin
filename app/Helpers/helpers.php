<?php
declare (strict_types=1);
/**
 * Created By PhpStorm.
 * User : Latent
 * Date : 2022/7/22
 * Time : 23:58
 **/

if (!function_exists('get_tree')) {
    /**
     * @param $list
     * @param string $pk
     * @param string $pid
     * @param string $child
     * @param int $root
     * @return array
     */
    function get_tree($list, $pk = 'id', $pid = 'p_id', $child = 'children', $root = 0)
    {
        $tree = [];
        foreach ($list as $key => $val) {
            if ($val[$pid] == $root) {
                //获取当前$pid所有子类
                unset($list[$key]);
                if (!empty($list)) {
                    $child = get_tree($list, $pk, $pid, $child, $val[$pk]);
                    if (!empty($child)) {
                        $val['children'] = $child;
                    }
                }
                $tree[] = $val;
            }
        }
        return $tree;
    }
}


