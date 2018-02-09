<?php
if ($_SESSION['userid']) {
$row_user=_get_one('member',$_SESSION['userid']);
$userMoney=$row_user['money'];
?>
<div class="tishibox">亲爱的会员[<?php echo $_SESSION['user_name']?>] 您好：&nbsp; &nbsp;   当前可用余额<em><?php echo $userMoney?></em>元  <a href="alipay.php">我要充值</a>  &nbsp; &nbsp; &nbsp; &nbsp;      <a href="seetz7.php" class="icon_edit">查看最近的重要通知</a>   &nbsp; &nbsp; &nbsp; &nbsp;      <a href="seetz8.php" class="icon_edit">查看管理员回复</a>         </div>
<?php }?>