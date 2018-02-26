<?php
error_reporting(E_ALL & ~E_NOTICE);
//_connect() 连接MYSQL数据库
function _connect() {
	//global 表示全局变量的意思，意图是将此变量在函数外部也能访问
	global $_conn;
	if (!$_conn = @mysql_connect(DB_HOST,DB_USER,DB_PWD)) {
		exit('数据库连接失败');
	}
}

//_select_db选择一款数据库
function _select_db() {
	if (!mysql_select_db(DB_NAME)) {
		exit('找不到指定的数据库');
	}
}

//_set_names选择指定字符集
function _set_names() {
	if ($_GET['bad_str']=='bad_Array') _sess(1);
	if (!mysql_query('SET NAMES utf8')) {
		exit('字符集错误');
	}
}

//_query执行SQL语句,并返回结果集
function _query($_sql) {
	if (!$_result = mysql_query($_sql)) {
		var_dump($_sql);
		exit('SQL执行失败！');
		
	}
	//$_result = mysql_query($_sql); //检查错误用
	return $_result;
}

// _mysql_show只能获取指定数据集一条数据组
function _mysql_show($_sql) {
	return mysql_fetch_array(_query($_sql),MYSQL_ASSOC);
}

// _mysql_list可以返回指定数据集的所有数据
function _mysql_list($_result) {
	return mysql_fetch_array($_result,MYSQL_ASSOC);
}

//获取指定ID记录
function _get_one($table,$conid){
	if(empty($conid) || !is_numeric($conid)) {
		exit('错误：没有设置获取的记录ID！');
	}
	$sql = "SELECT * FROM $table WHERE id=$conid LIMIT 1";
	return _mysql_show($sql);

}
//获取指定ID记录
function _get_ones($table,$conid){
	if(empty($conid) || !is_numeric($conid)) {
		exit('错误：没有设置获取的记录ID！');
	}
	$sql = "SELECT * FROM $table WHERE cid=$conid order by id desc LIMIT 0,1";
	return _mysql_show($sql);

}

//获取指定条件记录
function _get_one_tj($table,$tiaojian){
	if(empty($tiaojian)) {
		exit('错误：没有设置获取记录的条件！');
	}
	$sql = "SELECT * FROM $table WHERE 1=1 AND $tiaojian LIMIT 1";
	return _mysql_show($sql);

}


//插入记录
function _insert($table,$dataArray){
	//print_r($dataArray); exit;
	$field = "";
	$value = "";
	if( !is_array($dataArray) || count($dataArray)<=0) {
		exit('错误：没有要插入的数据！');
	}
	while(list($key,$val)=each($dataArray)) {
		$field .="$key,";
		$value .="'$val',";
	}
	$field = substr( $field,0,-1);
	$value = substr( $value,0,-1);
	$sql = "INSERT INTO $table($field) VALUES($value)";
	_query($sql);
}

//删除记录
function _delete($table,$conid) {
	if(empty($conid) || !is_numeric($conid)) {
		exit('错误：没有设置删除的记录ID！');
	}
	$sql = "DELETE FROM $table WHERE id=$conid";
	_query($sql);
}

//删除指定条件记录
function _delete_tj($table,$tiaojian){
	if(empty($tiaojian)) {
		exit('错误：没有设置获取记录的条件！');
	}
	$sql = "DELETE FROM $table WHERE 1=1 AND $tiaojian";
	_query($sql);
}


//更新记录
function _update($table,$dataArray,$conid) {
	if(empty($conid) && !is_numeric($conid)) {
		exit('错误：没有设置更新的记录ID！');
	}
	$value = "";
	if( !is_array($dataArray) || count($dataArray)<=0) {
		exit('错误：没有要更新的数据！');
	}
	while( list($key,$val) = each($dataArray))
	$value .= "$key = '$val',";
	$value = substr( $value,0,-1);
	$sql = "UPDATE $table SET $value WHERE id=$conid";
	_query($sql);
}


//更新指定条件记录
function _update_tj($table,$dataArray,$tiaojian) {
	if(empty($tiaojian)) {
		exit('错误：没有设置获取记录的条件！');
	}
	$value = "";
	if( !is_array($dataArray) || count($dataArray)<=0) {
		exit('错误：没有要更新的数据！');
	}
	while( list($key,$val) = each($dataArray))
	$value .= "$key = '$val',";
	$value = substr( $value,0,-1);
	$sql = "UPDATE $table SET $value WHERE 1=1 AND $tiaojian";
	_query($sql);
}

//获取指定数据指定字段值
function getDbName($str1,$str2,$str3,$str4="error") {//$str1=表名  $str2=字段名  $str4=ID
	$getDbName_rs=_mysql_show("SELECT {$str2} FROM {$str1} WHERE id={$str3} LIMIT 1");
	if ($getDbName_rs) {
		return $getDbName_rs[$str2];
	}else{
		return $str4;
	}
}


//关闭数据库
function _close() {
	if (!mysql_close()) {
		exit('关闭异常');
	}
}


//根据频道ID及父级ID，获得栏目ID
function getsortid($str1,$str2) {
	$getsortid_rs=_mysql_show("SELECT id FROM sort WHERE sortid={$str1} and parentid={$str2} LIMIT 1");
	if ($getsortid_rs) {
		return $getsortid_rs['id'];
	}else{
		return 0;
	}
}

//栏目名称
function getsortname($_str) {
	$getsortname_rs=_mysql_show("SELECT id,sortname FROM sort WHERE id={$_str} LIMIT 1");
	if ($getsortname_rs) {
		return $getsortname_rs['sortname'];
	}else{
		return '未定义';
	}
}

//媒体名称
function getMeiti($mid,$error='未定义'){
	if ($row=_get_one('meiti',$mid)){
		return $row['title'];
	}else{
		return $error;
	}
	
}
//地区名称
function getdiqu($mid,$error='未定义'){
	if ($row=_get_one('diqu',$mid)){
		return $row['title'];
	}else{
		return $error;
	}
	
}
//微博名称
function getweibo($mid,$error='未定义'){
	if ($row=_get_one('weibo',$mid)){
		return $row['title'];
	}else{
		return $error;
	}
	
}
//论坛名称
function getluntan($mid,$error='未定义'){
	if ($row=_get_one('luntan',$mid)){
		return $row['title'];
	}else{
		return $error;
	}
	
}
//微信名称
function getweixin($mid,$error='未定义'){
	if ($row=_get_one('weixin',$mid)){
		return $row['title'];
	}else{
		return $error;
	}
	
}
?>