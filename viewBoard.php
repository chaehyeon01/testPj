<?php
include $_SERVER["DOCUMENT_ROOT"]."/test/server_conn.php";

    $seq=$_GET["seq"];

    $select_list_contents="select
                                 mem_id,
                                 mem_name,
                                 board_subject,
                                 board_content
                           from boardlist
                           where seq=$seq";

    $list_contents=mysqli_query($mySqli,$select_list_contents);


    if($list_contents){
        
        
            $result_row=mysqli_fetch_array($list_contents);
        
            $id=$result_row['mem_id'];
            $name=$result_row['mem_name'];
            $subject=$result_row['board_subject'];
            $contents=$result_row['board_content'];


    }else {
        echo "erro";
    }

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$subject?></title>
</head>
<body>
    <div>
        <h1>제목 : <?=$subject?></h1>
        <p><?=$contents?></p>
    </div>
</body>
</html>