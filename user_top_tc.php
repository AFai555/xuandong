<?php
if ($_SESSION['userid']) {
$row_user=_get_one('member',$_SESSION['userid']);
$userMoney=$row_user['money'];
?>
<div class="tishibox">您账户[<?php echo $_SESSION['user_name']?>] 是普通会员  当前可用余额<em><?php echo $userMoney?></em>元  <a href="admin.php?act=cz" target="_parent">我要充值</a>  &nbsp; &nbsp; &nbsp; &nbsp;      <a href="admin.php?act=s7" target="_parent" class="icon_edit">查看最近的重要通知</a>   &nbsp; &nbsp; &nbsp; &nbsp;      <a href="admin.php?act=s8" target="_parent" class="icon_edit">查看管理员回复</a>         </div>
<?php }?>