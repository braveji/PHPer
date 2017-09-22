<?php

function changedToUnderlineKey(&$arr){
    if(! is_array($arr) || empty($arr)){
        return $arr;
    }

    foreach ($arr as $k => &$v){
        $kk = str_replace("-", "_", $k);
        changedToUnderlineKey($v);
        if($kk != $k ){
            unset($arr[$k]);
            $arr[$kk]=$v;
        }
    }
    return $arr;
}


$arr= array(
    "31234-241"=> 909009,
    "2342-3242"=>array(
        "weqr-"=>1,
        "1234"=> 90,
        "as-ew"=> array(
            "24-234" => 90,
        )
    ),
);

var_dump(changedToUnderline($arr));
