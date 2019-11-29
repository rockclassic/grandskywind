<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="utf-8" />
<script src="http://static.gamecoupon.com/js/jquery-1.11.3.min.js"></script>
<style>
body { font-size:13px; }
div { line-height:25px; }
input { padding:3px;font-size:12px; }
.btn { border:0;width:150px;height:30px; }
.frm_item {  }
table { font-size:13px; }
table th { text-align:left;padding-right:15px; }
.item_form { border:2px solid red;padding:10px 20px;margin-bottom:10px; }
.cred { color:#FF0000; }
</style>
<body>
<h3><a href="/">Coinnoon DEMO</a></h3>
<h3>Coinnoon RPC</h3>
<?
foreach($link as $k => $v) {
?>
<h4><a href="<?=$k?>"><?=$v?></h4>
<?
}
?>
</body>
</html>
