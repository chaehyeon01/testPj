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

                    if(isset($_GET["page"])){
                        $page = $_GET["page"];
                    }else {
                        $page = 1;
                    }

                    $success=true;

                    $query="select * from boardlist order by seq desc";
                    $result=mysqli_query($mySqli,$query);

                    if($query){
                        
                        $count=mysqli_num_rows($result);

                        $scale=5; //몇개 보여줄건지...


                        //전체페이지 구하기
                        if ($count % $scale == 0 ){
                            $total_page = floor($count/$scale);
                        }else {
                            $total_page = floor($count/$scale)+1;
                        }

                        //페이지에 따른 게시판 리스트 불러오기

                        $pageSetNum= ($page - 1) * $scale;

                        $number = $count - $pageSetNum;
                        
                        for($i=$pageSetNum; $i< $pageSetNum+$scale && $i < $count ;$i++){

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
                                <td>$number</td>
                                <td>$mem_id</td>
                                <td>$mem_name</td>
                                <td>$board_subject</td>
                                <td>$reg_date</td>
                                <td>$upt_date</td>
                                <td>$view_count</td>
                            </tr>";

                            $number--;
                        }

                       

                    } 


                }else {

                    $success=false;
                }
                ?>
            </tbody>
        </table>
        <ul class="page">
            <?php
            
            //이전 글씨 찍기
            if($count >=2 && $page >=2) {
                $new_page = $page-1;
                echo "<li><a href='index.php?page=$new_page'>◀</a></li>";
            }else {
                echo "<li>&nbsp;</li>";
            }
            
            //게시판 페이지 숫자 찍기 
             for($i=1;$i<=$total_page; $i++){
                 if($page==$i) {
                     echo "<li style='background-color:#333; width:30px;
                     height:30px;color:#fff;  background-color:#333; '><b>$i</b></li>";
                 } else {
                     echo "<li style='width:30px;
                     height:30px;
                     background-color:#eee;
                     ' ><a href='index.php?page=$i'>$i</a></li>";
                 }
             }

             //다음 글씨 찍기
             if($count >=2 && $page != $total_page) {
                 $new_page= $page+1;
                 echo "<li  style='width:50px;'><a href='index.php?page=$new_page'>▶</a></li>";
             }else {
                 echo "<li>&nbsp;</li>";
             }

            
            ?>
        </ul>
    </div>
    <script>
        
        let isDb=<?=$success?>;
        
        console.log(isDb+"리스트 개수:"+<?=$count?>);

        $(function(){

            
        });
    
    </script>
</body>
</html>