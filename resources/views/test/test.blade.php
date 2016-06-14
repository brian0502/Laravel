<!doctype html>
<html>
<head>
<style>
.press { width:162px; }
.error { color:#F00; }
</style>
<meta charset="utf-8">
<title>三角函數</title>
</head>

<body>

<?php

$scaleErr="";
settype($scale,"double"); //scale變成double型態

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  if (empty($_GET["scale"])) {
    $scaleErr = "忘了寫倍數了";
  }
  else {
        $scale=test_input($_GET["scale"]);
        if(isset($_GET["scale"])){
        $scale=$scale*pi();
        //倍數可以是小數或整數
        }
  }
}

function test_input($data) {
  //if(!is_string($data)) $data='scale';
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
print_r($_GET);
?>

<form method="get" action="test">
  請輸入倍數：<input type="text" name="scale" class="press">
  <span class="error">* <?php echo $scaleErr;?></span>
  <br><br><input type="submit" value="送出"><br>
</form>

<?php

if($scale!=0){
  echo "<br>";
  echo "sin(".$scale.")=".sin($scale)."<br>";
  echo "cos(".$scale.")=".cos($scale)."<br>";
  echo "tan(".$scale.")=".tan($scale)."<br>";
  echo "cot(".$scale.")=".(1/tan($scale))."<br>";
  echo "sec(".$scale.")=".(1/cos($scale))."<br>";
  echo "csc(".$scale.")=".(1/sin($scale))."<br>";
}
else {
  $scale=@($scale==0);
  $scale=floatval($scale);
  echo $scaleErr;
}
?>
</body>
</html>