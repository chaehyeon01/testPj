<?php

$host='127.0.0.1';
$user='root';
$pwd='123456';
$dbName='testboard';
$mySqli=new mysqli($host,$user,$pwd,$dbName);

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <script src="./jq/jquery-3.5.1.min.js"></script>
    <title>테스트 게시판</title>
</head>
<body>
    <div id="wrap">
        <h1>게시판</h1>
        <table class="list" >
            <thead>
                <tr>
                    <th>번호</th>
                    <th>아이디</th>
                    <th>닉네임</th>
                    <th>제목</th>
                    <th>등록일자</th>
                    <th>업데이트일자</th>
                    <th>조회수</th>
                </tr>
            </thead>
            <tbody>
            <?php

                if($mySqli){

                    $success=true;

                    $query="select * from boardlist";
                    $result=mysqli_query($mySqli,$query);

                    if($query){
                        
                        $count=mysqli_num_rows($result);
                        
                        for($i=0;$i<$count;$i++){

                            mysqli_data_seek($result,$i);

                            $row=mysqli_fetch_array($result);

                            $seq=$row['seq'];
                            $mem_id=$row['mem_id'];
                            $mem_name=$row['mem_name'];
                            $board_subject=$row['board_subject'];
                            $reg_date=$row['reg_date'];
                            $upt_date=$row['upt_date'];
                            $view_count=$row['view_count'];

                            echo "<tr>
                                <td>$seq</td>
                                <td>$mem_id</td>
                                <td>$mem_name</td>
                                <td>$board_subject</td>
                                <td>$reg_date</td>
                                <td>$upt_date</td>
                                <td>$view_count</td>
                            </tr>";

                        }


                    } 


                }else {

                    $success=false;
                }
                ?>
            </tbody>
        </table>
    </div>
    <script>
        
        let isDb=<?=$success?>;
        
        console.log(isDb+"리스트 개수:"+<?=$count?>);

        $(function(){

            
        });
    
    </script>
</body>
</html>