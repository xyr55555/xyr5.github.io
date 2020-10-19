<!DOCTYPE html>
<html lang="en">
<?php
date_default_timezone_set('PRC');
$time=date('Y-m-d h:i:s', time());
include("./config.php");
//include("./post.php");
 session_start();
 $conn =mysqli_connect($host,$user,$psw,$db,$port);
// if(array_key_exists('username',$_SESSION)){
//     header('location:./post.php');
//     exit();
// }
//echo '<script>alert("留言内容过长")</script>';
//echo '<script>alert("登入成功");</script>';
if(array_key_exists('liuyan',$_POST)){
   if(strlen($_POST['liuyan'])>200){
       echo '<script>alert("留言内容过长")</script>';
   }
   $content=$_POST['liuyan'];
   $id=$_SESSION["username"];
   $sql="insert into message values(NULL,'".$content."','".$time."','".$id."');";
   $result=mysqli_query($conn,$sql);
   var_dump($result);
   if($result){
       echo"留言成功";
   }else{
       echo "留言失败！".mysqli_error($conn)."";
   }
}

$page=1;
if(array_key_exists('page',$_GET)){
    if($_GET['page']>0){
        $page=$_GET['page'];
    }
}

$sql='select count(*) from message';
$result=mysqli_query($conn,$sql);
$rs=mysqli_fetch_all($result);
$count=$rs[0][0];
$maxpage=ceil($count/5);
if($page>$maxpage){
    $page=$maxpage;
}
$fpage=($page-1)*5;
$sql='select * from message order by msg_date desc limit '.$fpage.',5;';
$result=mysqli_query($conn,$sql);
$rows=mysqli_fetch_all($result);
mysqli_close($conn);
?>
<head>
    <meta charset="UTF-8">
    <meta name="referrer" content="no-referrer">
    <title>commit</title>
    <style>
        body {
            background: transparent url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+PHN2ZyB3aWR0aD0iNTA0cHgiIGhlaWdodD0iNDMxcHgiIHZpZXdCb3g9IjAgMCA1MDQgNDMxIiB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbG5zOnNrZXRjaD0iaHR0cDovL3d3dy5ib2hlbWlhbmNvZGluZy5jb20vc2tldGNoL25zIj4gICAgICAgIDx0aXRsZT5icmVhay1tb2RhbC1zY3JlZW48L3RpdGxlPiAgICA8ZGVzYz5DcmVhdGVkIHdpdGggU2tldGNoLjwvZGVzYz4gICAgPGRlZnM+PC9kZWZzPiAgICA8ZyBpZD0iUGFnZS0xIiBzdHJva2U9Im5vbmUiIHN0cm9rZS13aWR0aD0iMSIgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIiBza2V0Y2g6dHlwZT0iTVNQYWdlIj4gICAgICAgIDxwYXRoIGQ9Ik0xNDksMTIxLjYxNzk3NiBMMTYzLjAyMzA5NywxMjEuNjE3OTc2IEwxNjMuMDIzMDk3LDEzNi42MDk5MjggTDE3Ny4yNDY5ODQsMTM2LjYwOTkyOCBMMTc3LjI0Njk4NCwxNTEuMDIzNDciIGlkPSJQYXRoLTEwIiBzdHJva2U9IiNGQjNENkEiIHN0cm9rZS13aWR0aD0iMiIgc2tldGNoOnR5cGU9Ik1TU2hhcGVHcm91cCI+PC9wYXRoPiAgICAgICAgPHBhdGggZD0iTTI5NS43OTc3MTIsMjUzIEwzMDEuODU1NDg3LDI1MyBMMzAxLjg1NTQ4NywyNTkuNDc2MzA2IEwzMDgsMjU5LjQ3NjMwNiBMMzA4LDI2NS43MDI3NDciIGlkPSJQYXRoLTE2IiBzdHJva2U9IiM5QzUwODkiIHN0cm9rZS13aWR0aD0iMiIgc2tldGNoOnR5cGU9Ik1TU2hhcGVHcm91cCIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMzAxLjg5ODg1NiwgMjU5LjM1MTM3Mykgcm90YXRlKC0xODAuMDAwMDAwKSB0cmFuc2xhdGUoLTMwMS44OTg4NTYsIC0yNTkuMzUxMzczKSAiPjwvcGF0aD4gICAgICAgIDxwYXRoIGQ9Ik03My41NTU1NDA0LDIwNi4xNzE4NzUgTDY3Ljg0ODUwOTIsMTk2LjUgTDc5LjQ4NTIyNzksMTk2IEw3My41NTU1NDA0LDIwNi4xNzE4NzUgWiIgaWQ9IlBhdGgtMTEiIHN0cm9rZT0iIzlENTg4RCIgc3Ryb2tlLXdpZHRoPSIyIiBza2V0Y2g6dHlwZT0iTVNTaGFwZUdyb3VwIj48L3BhdGg+ICAgICAgICA8cGF0aCBkPSJNNzMuNTU1NTQwNCwyMDYuMTcxODc1IEw2Ny44NDg1MDkyLDE5Ni41IEw3OS40ODUyMjc5LDE5NiBMNzMuNTU1NTQwNCwyMDYuMTcxODc1IFoiIGlkPSJQYXRoLTIxIiBzdHJva2U9IiM5RDU4OEQiIHN0cm9rZS13aWR0aD0iMiIgc2tldGNoOnR5cGU9Ik1TU2hhcGVHcm91cCI+PC9wYXRoPiAgICAgICAgPHBhdGggZD0iTTE4OS43MDcwMzEsMzg5LjE3MTg3NSBMMTg0LDM3OS41IEwxOTUuNjM2NzE5LDM3OSBMMTg5LjcwNzAzMSwzODkuMTcxODc1IFoiIGlkPSJQYXRoLTIyIiBzdHJva2U9IiM5RDU4OEQiIHN0cm9rZS13aWR0aD0iMiIgc2tldGNoOnR5cGU9Ik1TU2hhcGVHcm91cCIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMTg5LjgxODM1OSwgMzg0LjA4NTkzOCkgcm90YXRlKDk2LjAwMDAwMCkgdHJhbnNsYXRlKC0xODkuODE4MzU5LCAtMzg0LjA4NTkzOCkgIj48L3BhdGg+ICAgICAgICA8cGF0aCBkPSJNMzk5LjA3MDMxMiwzMDkuNSBMMzkzLjM2MzI4MSwyOTkuODI4MTI1IEw0MDUsMjk5LjMyODEyNSBMMzk5LjA3MDMxMiwzMDkuNSBaIiBpZD0iUGF0aC0yMCIgc3Ryb2tlPSIjQjhFOTg2IiBzdHJva2Utd2lkdGg9IjIiIHNrZXRjaDp0eXBlPSJNU1NoYXBlR3JvdXAiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDM5OS4xODE2NDEsIDMwNC40MTQwNjIpIHJvdGF0ZSgtMTgwLjAwMDAwMCkgdHJhbnNsYXRlKC0zOTkuMTgxNjQxLCAtMzA0LjQxNDA2MikgIj48L3BhdGg+ICAgICAgICA8Y2lyY2xlIGlkPSJPdmFsLTEiIHN0cm9rZT0iIzUxQ0FEOCIgc3Ryb2tlLXdpZHRoPSIyIiBza2V0Y2g6dHlwZT0iTVNTaGFwZUdyb3VwIiBjeD0iMTY1LjQ3MjQ0NyIgY3k9IjIyOS4yOTcyNTMiIHI9IjciPjwvY2lyY2xlPiAgICAgICAgPGNpcmNsZSBpZD0iT3ZhbC04IiBzdHJva2U9IiM5RDU4OEQiIHN0cm9rZS13aWR0aD0iMiIgc2tldGNoOnR5cGU9Ik1TU2hhcGVHcm91cCIgY3g9IjQ2NS40NzI0NDciIGN5PSIxMzYuMzIwNzIzIiByPSI1LjMzOTYzODUiPjwvY2lyY2xlPiAgICAgICAgPGNpcmNsZSBpZD0iT3ZhbC0zIiBzdHJva2U9IiM1MUNBRDciIHN0cm9rZS13aWR0aD0iMiIgc2tldGNoOnR5cGU9Ik1TU2hhcGVHcm91cCIgY3g9IjI2MC41IiBjeT0iMzEuNSIgcj0iNy41Ij48L2NpcmNsZT4gICAgICAgIDxnIGlkPSJHcm91cCIgc2tldGNoOnR5cGU9Ik1TTGF5ZXJHcm91cCIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMjQ0LjAwMDAwMCwgMTUzLjAwMDAwMCkiIHN0cm9rZT0iI0ZGRTIxNyIgc3Ryb2tlLXdpZHRoPSIyIj4gICAgICAgICAgICA8cGF0aCBkPSJNMTUuOTA5MDU2LDEwLjY1NjI4MjIgTDE1LjkwOTA1NiwwLjkwMzU0MDM1NSIgaWQ9IlBhdGgtMTIiIHNrZXRjaDp0eXBlPSJNU1NoYXBlR3JvdXAiPjwvcGF0aD4gICAgICAgICAgICA8cGF0aCBkPSJNMTUuOTA5MDU2LDIxLjA3ODE1NzIgTDE1LjkwOTA1NiwyOS43NzI1NzU2IiBpZD0iUGF0aC0xMyIgc2tldGNoOnR5cGU9Ik1TU2hhcGVHcm91cCI+PC9wYXRoPiAgICAgICAgICAgIDxwYXRoIGQ9Ik0yMC4zOTM0MzEsMTYuMDIzNDY5NyBMMzAsMTYuMDIzNDY5NyIgaWQ9IlBhdGgtMTQiIHNrZXRjaDp0eXBlPSJNU1NoYXBlR3JvdXAiPjwvcGF0aD4gICAgICAgICAgICA8cGF0aCBkPSJNOS41OTI2NDk3OSwxNi4wMjM0Njk3IEwwLjEzMTg1MjQwNywxNi4wMjM0Njk3IiBpZD0iUGF0aC0xNSIgc2tldGNoOnR5cGU9Ik1TU2hhcGVHcm91cCI+PC9wYXRoPiAgICAgICAgPC9nPiAgICAgICAgPHBhdGggZD0iTTIwNCwyODUgQzIwNCwyODguODY1OTkzIDIwNy4xMzQwMDcsMjkyIDIxMSwyOTIgQzIxNC44NjU5OTMsMjkyIDIxOCwyODguODY1OTkzIDIxOCwyODUiIGlkPSJPdmFsLTIiIHN0cm9rZT0iI0ZCM0Q2QSIgc3Ryb2tlLXdpZHRoPSIyIiBza2V0Y2g6dHlwZT0iTVNTaGFwZUdyb3VwIj48L3BhdGg+ICAgICAgICA8cGF0aCBkPSJNNTEsMTAxLjUgQzUxLDk3LjYzNDAwNjggNDcuODY1OTkzMiw5NC41IDQ0LDk0LjUgQzQwLjEzNDAwNjgsOTQuNSAzNyw5Ny42MzQwMDY4IDM3LDEwMS41IiBpZD0iT3ZhbC05IiBzdHJva2U9IiNGQjNENkEiIHN0cm9rZS13aWR0aD0iMiIgc2tldGNoOnR5cGU9Ik1TU2hhcGVHcm91cCI+PC9wYXRoPiAgICAgICAgPGcgaWQ9IndhdmUiIHNrZXRjaDp0eXBlPSJNU0xheWVyR3JvdXAiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDMxOC4wMDAwMDAsIDk0LjAwMDAwMCkiIHN0cm9rZT0iI0I4RTk4NiIgc3Ryb2tlLXdpZHRoPSIyIj4gICAgICAgICAgICA8cGF0aCBkPSJNMCw0IEMwLDYuNzYxNDIzNzUgMi4wMTQ3MTg2Myw5IDQuNSw5IEM2Ljk4NTI4MTM3LDkgOSw2Ljc2MTQyMzc1IDksNCIgaWQ9Ik92YWwtNCIgc2tldGNoOnR5cGU9Ik1TU2hhcGVHcm91cCI+PC9wYXRoPiAgICAgICAgICAgIDxwYXRoIGQ9Ik0xOCw0IEMxOCw2Ljc2MTQyMzc1IDIwLjAxNDcxODYsOSAyMi41LDkgQzI0Ljk4NTI4MTQsOSAyNyw2Ljc2MTQyMzc1IDI3LDQiIGlkPSJPdmFsLTYiIHNrZXRjaDp0eXBlPSJNU1NoYXBlR3JvdXAiPjwvcGF0aD4gICAgICAgICAgICA8cGF0aCBkPSJNMTgsNSBDMTgsMi4yMzg1NzYyNSAxNS45ODUyODE0LDEuMDc4NTAyMzdlLTE1IDEzLjUsNC40NDA4OTIxZS0xNiBDMTEuMDE0NzE4Niw0LjQ0MDg5MjFlLTE2IDksMi4yMzg1NzYyNSA5LDUiIGlkPSJPdmFsLTUiIHNrZXRjaDp0eXBlPSJNU1NoYXBlR3JvdXAiPjwvcGF0aD4gICAgICAgICAgICA8cGF0aCBkPSJNMzYsNSBDMzYsMi4yMzg1NzYyNSAzMy45ODUyODE0LDEuMDc4NTAyMzdlLTE1IDMxLjUsNC40NDA4OTIxZS0xNiBDMjkuMDE0NzE4Niw0LjQ0MDg5MjFlLTE2IDI3LDIuMjM4NTc2MjUgMjcsNSIgaWQ9Ik92YWwtNyIgc2tldGNoOnR5cGU9Ik1TU2hhcGVHcm91cCI+PC9wYXRoPiAgICAgICAgPC9nPiAgICAgICAgPGcgaWQ9IndhdmUtMiIgc2tldGNoOnR5cGU9Ik1TTGF5ZXJHcm91cCIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMTA0LjAwMDAwMCwgMzA5LjUwMDAwMCkgcm90YXRlKC0zMzAuMDAwMDAwKSB0cmFuc2xhdGUoLTEwNC4wMDAwMDAsIC0zMDkuNTAwMDAwKSB0cmFuc2xhdGUoODYuMDAwMDAwLCAzMDUuMDAwMDAwKSIgc3Ryb2tlPSIjQjhFOTg2IiBzdHJva2Utd2lkdGg9IjIiPiAgICAgICAgICAgIDxwYXRoIGQ9Ik0wLDQgQzAsNi43NjE0MjM3NSAyLjAxNDcxODYzLDkgNC41LDkgQzYuOTg1MjgxMzcsOSA5LDYuNzYxNDIzNzUgOSw0IiBpZD0iT3ZhbC00IiBza2V0Y2g6dHlwZT0iTVNTaGFwZUdyb3VwIj48L3BhdGg+ICAgICAgICAgICAgPHBhdGggZD0iTTE4LDQgQzE4LDYuNzYxNDIzNzUgMjAuMDE0NzE4Niw5IDIyLjUsOSBDMjQuOTg1MjgxNCw5IDI3LDYuNzYxNDIzNzUgMjcsNCIgaWQ9Ik92YWwtNiIgc2tldGNoOnR5cGU9Ik1TU2hhcGVHcm91cCI+PC9wYXRoPiAgICAgICAgICAgIDxwYXRoIGQ9Ik0xOCw1IEMxOCwyLjIzODU3NjI1IDE1Ljk4NTI4MTQsMS4wNzg1MDIzN2UtMTUgMTMuNSw0LjQ0MDg5MjFlLTE2IEMxMS4wMTQ3MTg2LDQuNDQwODkyMWUtMTYgOSwyLjIzODU3NjI1IDksNSIgaWQ9Ik92YWwtNSIgc2tldGNoOnR5cGU9Ik1TU2hhcGVHcm91cCI+PC9wYXRoPiAgICAgICAgICAgIDxwYXRoIGQ9Ik0zNiw1IEMzNiwyLjIzODU3NjI1IDMzLjk4NTI4MTQsMS4wNzg1MDIzN2UtMTUgMzEuNSw0LjQ0MDg5MjFlLTE2IEMyOS4wMTQ3MTg2LDQuNDQwODkyMWUtMTYgMjcsMi4yMzg1NzYyNSAyNyw1IiBpZD0iT3ZhbC03IiBza2V0Y2g6dHlwZT0iTVNTaGFwZUdyb3VwIj48L3BhdGg+ICAgICAgICA8L2c+ICAgICAgICA8ZyBpZD0iUGF0aC0xNy0rLVBhdGgtMTgtKy1QYXRoLTE5IiBza2V0Y2g6dHlwZT0iTVNMYXllckdyb3VwIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSg2LjAwMDAwMCwgMjY4LjAwMDAwMCkiIHN0cm9rZT0iI0ZGRjM5MCIgc3Ryb2tlLXdpZHRoPSIyIj4gICAgICAgICAgICA8cGF0aCBkPSJNMi43MTY3OTY4OCwxNC45NDcyNjU2IEw2LjczNzc5Mjk3LDcuNjkxNDA2MjUgTDExLjQwMzgwODYsMTQuODYzMjgxMiIgaWQ9IlBhdGgtMTciIHNrZXRjaDp0eXBlPSJNU1NoYXBlR3JvdXAiPjwvcGF0aD4gICAgICAgICAgICA8cGF0aCBkPSJNMTMuNDQ2Nzc3Myw2LjI5Njg3NSBMNi42MTI3OTI5Nyw3LjIyMzYzMjgxIEwwLjIwNjA1NDY4OCw2LjUwNTg1OTM4IiBpZD0iUGF0aC0xOCIgc2tldGNoOnR5cGU9Ik1TU2hhcGVHcm91cCI+PC9wYXRoPiAgICAgICAgICAgIDxwYXRoIGQ9Ik03LjEwMDA5NzY2LDAuNDE3OTY4NzUgTDYuODUwMDk3NjYsNy41OTg2MzI4MSIgaWQ9IlBhdGgtMTkiIHNrZXRjaDp0eXBlPSJNU1NoYXBlR3JvdXAiPjwvcGF0aD4gICAgICAgIDwvZz4gICAgICAgIDxnIGlkPSJQYXRoLTE3LSstUGF0aC0xOC0rLVBhdGgtMjAiIHNrZXRjaDp0eXBlPSJNU0xheWVyR3JvdXAiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDQyMy4wMDAwMDAsIDIwOC4wMDAwMDApIiBzdHJva2U9IiM1MUNBRDciIHN0cm9rZS13aWR0aD0iMiI+ICAgICAgICAgICAgPHBhdGggZD0iTTIuNzE2Nzk2ODgsMTQuOTQ3MjY1NiBMNi43Mzc3OTI5Nyw3LjY5MTQwNjI1IEwxMS40MDM4MDg2LDE0Ljg2MzI4MTIiIGlkPSJQYXRoLTE3IiBza2V0Y2g6dHlwZT0iTVNTaGFwZUdyb3VwIj48L3BhdGg+ICAgICAgICAgICAgPHBhdGggZD0iTTEzLjQ0Njc3NzMsNi4yOTY4NzUgTDYuNjEyNzkyOTcsNy4yMjM2MzI4MSBMMC4yMDYwNTQ2ODgsNi41MDU4NTkzOCIgaWQ9IlBhdGgtMTgiIHNrZXRjaDp0eXBlPSJNU1NoYXBlR3JvdXAiPjwvcGF0aD4gICAgICAgICAgICA8cGF0aCBkPSJNNy4xMDAwOTc2NiwwLjQxNzk2ODc1IEw2Ljg1MDA5NzY2LDcuNTk4NjMyODEiIGlkPSJQYXRoLTE5IiBza2V0Y2g6dHlwZT0iTVNTaGFwZUdyb3VwIj48L3BhdGg+ICAgICAgICA8L2c+ICAgICAgICA8ZyBpZD0iR3JvdXAiIHNrZXRjaDp0eXBlPSJNU0xheWVyR3JvdXAiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDg2LjAwMDAwMCwgMzUuMDAwMDAwKSIgc3Ryb2tlPSIjODUyQzZFIiBzdHJva2Utd2lkdGg9IjIiPiAgICAgICAgICAgIDxwYXRoIGQ9Ik0zLjc5NjM4NjcyLDAuNjgzNTkzNzUgTDYuMjI4NzY3NzIsMy4xMTU5NzQ3NSBMOC42NTg5NDY3NiwwLjY4NTc5NTcwMiBNMy43OTYzODY3MiwwLjY4MzU5Mzc1IEw2LjIyODc2NzcyLDMuMTE1OTc0NzUgTDguNjU4OTQ2NzYsMC42ODU3OTU3MDIiIGlkPSJQYXRoLTI5IiBza2V0Y2g6dHlwZT0iTVNTaGFwZUdyb3VwIj48L3BhdGg+ICAgICAgICAgICAgPHBhdGggZD0iTTguNjU4OTQ2NzYsMTIuNzYzNDQ1MyBMNi4yMjY1NjU3NywxMC4zMzEwNjQzIEwzLjc5NjM4NjcyLDEyLjc2MTI0MzMgTTguNjU4OTQ2NzYsMTIuNzYzNDQ1MyBMNi4yMjY1NjU3NywxMC4zMzEwNjQzIEwzLjc5NjM4NjcyLDEyLjc2MTI0MzMiIGlkPSJQYXRoLTMyIiBza2V0Y2g6dHlwZT0iTVNTaGFwZUdyb3VwIj48L3BhdGg+ICAgICAgICAgICAgPHBhdGggZD0iTTAuNTgwMTk2MjE5LDkuMzMxMDY0MjcgTDMuMDEyNTc3MjIsNi44OTg2ODMyNyBMMC41ODIzOTgxNzIsNC40Njg1MDQyMyBNMC41ODAxOTYyMTksOS4zMzEwNjQyNyBMMy4wMTI1NzcyMiw2Ljg5ODY4MzI3IEwwLjU4MjM5ODE3Miw0LjQ2ODUwNDIzIiBpZD0iUGF0aC0zMSIgc2tldGNoOnR5cGU9Ik1TU2hhcGVHcm91cCI+PC9wYXRoPiAgICAgICAgICAgIDxwYXRoIGQ9Ik0xMi40NDM4NTcyLDQuNDY4NTA0MjMgTDEwLjAxMTQ3NjIsNi45MDA4ODUyMyBMMTIuNDQxNjU1Myw5LjMzMTA2NDI3IE0xMi40NDM4NTcyLDQuNDY4NTA0MjMgTDEwLjAxMTQ3NjIsNi45MDA4ODUyMyBMMTIuNDQxNjU1Myw5LjMzMTA2NDI3IiBpZD0iUGF0aC0zMCIgc2tldGNoOnR5cGU9Ik1TU2hhcGVHcm91cCI+PC9wYXRoPiAgICAgICAgPC9nPiAgICAgICAgPHJlY3QgaWQ9IlJlY3RhbmdsZS0zIiBzdHJva2U9IiNGQjNFNjciIHN0cm9rZS13aWR0aD0iMiIgc2tldGNoOnR5cGU9Ik1TU2hhcGVHcm91cCIgeD0iMzU3LjUiIHk9IjE3Ni41IiB3aWR0aD0iMTUiIGhlaWdodD0iMTUiPjwvcmVjdD4gICAgICAgIDxnIGlkPSJHcm91cCIgc2tldGNoOnR5cGU9Ik1TTGF5ZXJHcm91cCIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMzk3LjAwMDAwMCwgMzkuMDAwMDAwKSIgc3Ryb2tlPSIjRkMzRjZCIiBzdHJva2Utd2lkdGg9IjIiPiAgICAgICAgICAgIDxwYXRoIGQ9Ik00LjA1NzEyODkxLDcuNTk3MTY3OTcgTDAuMDA3ODEyNSw0LjQ0Njc3NzM0IiBpZD0iUGF0aC0zMyIgc2tldGNoOnR5cGU9Ik1TU2hhcGVHcm91cCI+PC9wYXRoPiAgICAgICAgICAgIDxwYXRoIGQ9Ik0xMC40NjE5MTQxLDEyLjUxMDc0MjIgTDEzLjY3Mjg1MTYsMTUuMjMwNDY4OCIgaWQ9IlBhdGgtMzQiIHNrZXRjaDp0eXBlPSJNU1NoYXBlR3JvdXAiPjwvcGF0aD4gICAgICAgICAgICA8cGF0aCBkPSJNNi4xOTA0Mjk2OSw1LjUzNzEwOTM4IEw2LjA5NzY1NjI1LDAuNjg2MDM1MTU2IiBpZD0iUGF0aC0zNSIgc2tldGNoOnR5cGU9Ik1TU2hhcGVHcm91cCI+PC9wYXRoPiAgICAgICAgICAgIDxwYXRoIGQ9Ik05LjQyNTI5Mjk3LDYuNTM3MTA5MzggTDEyLjY3Mjg1MTYsMi42NjQ1NTA3OCIgaWQ9IlBhdGgtMzYiIHNrZXRjaDp0eXBlPSJNU1NoYXBlR3JvdXAiPjwvcGF0aD4gICAgICAgICAgICA8cGF0aCBkPSJNMTEuNDc3MDUwOCw4Ljk4NTM1MTU2IEwxNS43OTU4OTg0LDguOTUyNjM2NzIiIGlkPSJQYXRoLTM3IiBza2V0Y2g6dHlwZT0iTVNTaGFwZUdyb3VwIj48L3BhdGg+ICAgICAgICA8L2c+ICAgICAgICA8cGF0aCBkPSJNMzE1LDM1Mi44MjQyMTkgTDMyMS4yMTY0NywzNTkuMDQwNjg4IEwzMjcuMTcyNzg4LDM1My4wODQzNyIgaWQ9IlBhdGgtNDciIHN0cm9rZT0iIzlENTg4RCIgc3Ryb2tlLXdpZHRoPSIyIiBza2V0Y2g6dHlwZT0iTVNTaGFwZUdyb3VwIj48L3BhdGg+ICAgICAgICA8ZyBpZD0iUGF0aC00OC0rLVBhdGgtNDkiIHNrZXRjaDp0eXBlPSJNU0xheWVyR3JvdXAiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDQzNy4wMDAwMDAsIDM2MS4wMDAwMDApIiBzdHJva2U9IiNGQjNENkEiIHN0cm9rZS13aWR0aD0iMiI+ICAgICAgICAgICAgPHBhdGggZD0iTTAuMTA3NDIxODc1LDE0Ljc2NzU3ODEgTDE0Ljg0MDAwMTEsMC4wNzQ2NzA1MDA5IiBpZD0iUGF0aC00OCIgc2tldGNoOnR5cGU9Ik1TU2hhcGVHcm91cCI+PC9wYXRoPiAgICAgICAgICAgIDxwYXRoIGQ9Ik01LjEwNzQyMTg4LDE4Ljc2NzU3ODEgTDE5LjUyODU2OTIsNC40MTIwMjMyNSIgaWQ9IlBhdGgtNDkiIHNrZXRjaDp0eXBlPSJNU1NoYXBlR3JvdXAiPjwvcGF0aD4gICAgICAgIDwvZz4gICAgICAgIDxnIGlkPSJQYXRoLTUwLSstUGF0aC01MSIgc2tldGNoOnR5cGU9Ik1TTGF5ZXJHcm91cCIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMjYuMDAwMDAwLCAzNzEuMDAwMDAwKSIgc3Ryb2tlPSIjNTFDQUQ3IiBzdHJva2Utd2lkdGg9IjIiPiAgICAgICAgICAgIDxwYXRoIGQ9Ik03LjIyMDAxMDkxLDAuNTczNzE5MjI0IEw3LjIyMDAxMDkxLDEzLjI3NjQ2NiIgaWQ9IlBhdGgtNTAiIHNrZXRjaDp0eXBlPSJNU1NoYXBlR3JvdXAiPjwvcGF0aD4gICAgICAgICAgICA8cGF0aCBkPSJNMC41MjYzNzA2MjYsNi45NTI5ODc5OCBMMTIuNzI4NjU4Myw2Ljk1Mjk4Nzk4IiBpZD0iUGF0aC01MSIgc2tldGNoOnR5cGU9Ik1TU2hhcGVHcm91cCI+PC9wYXRoPiAgICAgICAgPC9nPiAgICA8L2c+PC9zdmc+) repeat left top;
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            width: 100%;
            height: 100%;
        }

        .container>div {
            width: 40%;
            background-color: rgba(220, 220, 220, 0.81);
            border-radius: 5px;
            position: relative;
            height: 100%;
        }

        .commit-box h2 {
            text-align: center;
            margin-top: 30px
        }

        .commit-item {
            width: 80%;
            margin: 3% 10% 2%;
            background-color: white;
            min-height: 570px;
            border-radius: 5px;
            padding: 10px 0px;
        }

        .commit-item img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 1px solid gainsboro
        }

        .commit-item>div {
            margin: 10px;
            border-bottom: 1px solid gainsboro;
        }

        .commit-item>div:nth-child(5) {
            border-bottom: none
        }

        .commit-item>div>div:last-child {
            font-size: 14px;
            text-align: right;
            margin: 4px 0;
        }

        .photo {
            display: flex;
            align-items: center;
        }

        .photo span {
            padding-left: 2%
        }

        .user-commit {
            padding: 5px;
            font-size: 14px;
        }

        .reply-box {
            width: 80%;
            margin: 5% 10%;
            background-color: white;
            border-radius: 5px;
            padding: 10px 0;
        }

        .reply-box textarea {
            width: 90%;
            min-height: 150px;
            margin: 5%;
            border-radius: 5px;
            border: gainsboro 1px solid;
            padding: 5px;
            box-sizing: border-box;
        }

        .reply-box textarea:focus {
            outline: none
        }

        .sub-btn {
            width: 90%;
            margin: 0 5%;
            text-align: right;
        }

        .sub-btn button {
            padding: 10px 20px;
            border: none;
            background-color: #0abef1;
            color: white;
            border-radius: 3px;
            cursor: pointer;
        }

        .page {
            text-align: center
        }

        .page span {
            padding: 1px;
            cursor: pointer;
            margin: 2px;
            text-decoration: underline;
            color: gray;
        }

        .page span:first-child {
            color: black;
        }

        .user-commit span {
            cursor: pointer
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="commit-box">
            <h2>二向箔安全留言板</h2>
            <div class="commit-item">
            <?php
            foreach($rows as $row){
                $html='<div><div class="photo"><img src="http://att3.citysbs.com/200x200/hangzhou/2020/04/15/11/dd6719bd4287d9efd49434c43563a032_v2_.jpg" alt="img"><span>'.$row[3].'</span></div><div class="user-commit"><span style="word-break:break-word" log="">'.$row[1].'</span></div><div>'.$row[2].'</div></div>';
                echo $html;
            }
                
?>
            </div>
            <div class="page">
                <a href="./msg.php?page=<?php echo $page>1?$page-1:1 ?>">上一页</a>
                <a href="./msg.php?page=<?php echo $page<$maxpage?$page+1:$maxpage ?>">下一页</a>
                <a href="./out.php">退出登录</a>
            </div>
            <div class="reply-box">
                <form action="./msg.php" method="POST">
                    <textarea name="liuyan" id="" cols="30" rows="10" placeholder="请输入留言内容"></textarea>
                    <div class="sub-btn">
                        <input type="submit" value="留言" />
                    </div>
                </form>
            </div>

        </div>
    </div>
    <script src="https://cdnjs.cloud/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
    </script>
</body>

</html>