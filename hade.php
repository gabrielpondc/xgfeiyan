<?php
DEFINE ('DB_USER','root');
DEFINE ('DB_PASSWORD','gjk19961226');
DEFINE ('DB_HOST','localhost');
DEFINE ('DB_NAME','virus');
$xgid=$_GET['id'];
$dbc=@mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) OR die('Could not to connect to Mysql:'.mysqli_connect_error());
mysqli_set_charset($dbc, 'utf8');
$sqlh="select dia,res,de from  jiangsu where loc='淮安'";
$resh=mysqli_query($dbc,$sqlh);
$resulth=mysqli_fetch_array($resh);
$sqla="select id,location,dia,res,de from  huaian where id=$xgid";
$resa=mysqli_query($dbc,$sqla);
$resulta=mysqli_fetch_array($resa);
$sqlb="select id,lo,content,title from  huai";
$resb=mysqli_query($dbc,$sqlb);
$resultb=mysqli_fetch_array($resb);
?>
<head>
    <meta name="viewport" content="width=device-width,target-densitydpi=high-dpi,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
  <meta charset="UTF-8">
  <title>疫情信息修改</title>
    <!--必要样式-->
<link href="bootstrap.min.css" rel="stylesheet">
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/echarts.min.js"></script>
    <script src="js/china.js"></script>
    <link rel="stylesheet" type="text/css" href="normalize.css">
    <link rel="stylesheet" type="text/css" href="component.css">
    <script type="text/javascript" src="js/world.js"></script>
    <link rel="stylesheet" href="//cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js">
    <script type="text/javascript" src="js/jquery-1.8.0.js"></script>
    <script type="text/javascript" src="./js/map/province/jiangsu.js"></script>
    <script src="js/echarts.js" charset="UTF-8"></script>
    <script src="js/jquery-1.8.0.js" type="text/javascript"></script>
</head>
<body>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">疫情信息修改</h3>
    </div>
    <div class="panel-body">
        <form  action="hade.php?id=<?php echo $xgid; ?>" method="POST" style="text-align: center" class="bs-example bs-example-form" role="form">
            <div id="login">
                <h2><?php echo $resulta['location']; ?></h2>
                <div class="input-group"><span class="input-group-addon">确诊</span><input name="d" type="text" value="<?php echo $resulta['dia']; ?>" class="form-control"></div><br/>
                <div class="input-group"><span class="input-group-addon">治愈</span><input name="c" type="text" value="<?php echo $resulta['res']; ?>" class="form-control"></div><br/>
                <div class="input-group"><span class="input-group-addon">死亡</span><input name="e" type="text" value="<?php echo $resulta['de']; ?>" class="form-control"></div><br/>
                <label><input type="submit" value="修改" class="btn btn-default"></label>
                <label><input type="reset" value="重置" class="btn btn-default"></label>
            </div>
        </form>
    </div>
</div>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $id=$_GET['id'];
    $dia = $_POST["d"];
    $cure = $_POST["c"];
    $de = $_POST["e"];
    $sqla="update huaian set dia='{$dia}', res='{$cure}', de='{$de}'where id={$id}";
    $resa=mysqli_query($dbc,$sqla);
    if($resa==1)
    {
        echo "<script>alert('编辑成功！')</script>";
        echo "<script>window.location.href='hare.php'</script>";
    }
    else
    {
        echo "<script>alert('编辑失败！');</script>";
    }
}
?>

</body>
</html>

