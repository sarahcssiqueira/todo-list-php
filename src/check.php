<?php

if(isset($_POST['id'])){
    require '../db/db_connect.php';

    $id = $_POST['id'];

    if(empty($id)){
       echo 'error';
    }else {
        $task = $conn->prepare("SELECT id, checked FROM task WHERE id=?");
        $task->execute([$id]);

        $task = $task->fetch();
        $uId = $task['id'];
        $checked = $task['checked'];

        $uChecked = $checked ? 0 : 1;

        $res = $conn->query("UPDATE task SET checked=$uChecked WHERE id=$uId");

        if($res){
            echo $checked;
        }else {
            echo "error";
        }
        $conn = null;
        exit();
    }
}else {
    header("Location: ../index.php?mess=error");
}