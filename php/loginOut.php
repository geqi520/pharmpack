<?php
session_start();
unset($_SESSION['admin']);
session_destroy();
echo "<script>";
echo "alert('退出成功');";
echo "window.location.href='../index.html';";
echo "</script>";