<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<script src='js/jquery.js'></script>
<title></title>
<style>
td{
    text-align:center;
    font-size:12px;
    font-family:Arial, Helvetica, sans-serif;
    border:#1C7A80 1px solid;
    color:#152122;
    width:100px;
}
table,tr{
    border-style:none;
}
.title{
    background:#7DDCF0;
    color:#FFFFFF;
    font-weight:bold;
}
</style>
</head>
<body>
<script>
    $(document).ready(function(){
        $('#explode1').click(function(){
                window.location.href='exp.php';
        });
 
        $('#explode2').click(function(){
                window.location.href='explode_excel.php';
        });
    })
</script>
<table width="800" border="1">
  <tr>
    <td class='title'>Date</td>
    <td class='title' colspan="5" style='width:500px;text-align:center;'>CSAT Score</td>
    <td class='title'>Grand Total</td>
    <td class='title'>CSAT</td>
  </tr>
  <tr>
    <td>08/01/11</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0%</td>
  </tr>
  <tr>
    <td>08/01/11</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0%</td>
  </tr>
  <tr>
    <td>08/01/11</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0%</td>
  </tr>
</table>
<br />
<input type='button' id='explode1' value='Explode' style='margin-left:620px;background-color:#10899E;color:white;padding:3px;font-weight:bold;'>
<input type='button' id='explode2' value='Explode2' style='background-color:#10899E;color:white;padding:3px;font-weight:bold;margin-left:24px;'>
</body>
</html>