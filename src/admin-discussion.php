<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin-discussions.css">
    <link rel="icon" type="image/png" href="Images/Learneasy_favicon.png">
    <title>Discussion</title>
</head>
<body>
    <?php
    session_start();
    include"conn.php";
    if(!is_null( $_SESSION['adm_username'])){
        include("admin-nav.php"); 
        $username =  $_SESSION['adm_username'];
        //Sql to find the stud_id
        $sql = "SELECT * FROM admin WHERE adm_username = '$username'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $id = $row['adm_id'];
    }

    $qid = $_GET['qid'];
    #echo $qid;
    $cid = $_GET['cid'];
    #echo $cid;
    //Get the info of the course
    $sql = "SELECT * FROM course WHERE cour_id = $cid";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $cour_name = $row['cour_name'];
    ?>
    <section class="discussion-section">
        <?php include("backBtn.php");?>
        <section class="ds-top">
            <p class="ds-main-title">Q&A: <?php echo $cour_name?></p>
            <?php
            //Get the info of the question
            $sql = "SELECT * FROM qna_question z, qna q, student s WHERE (q.qna_id = z.qna_id) AND (z.stud_id = s.stud_id) AND (q.cour_id = '$cid')";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            $post_date = strtotime($row['ques_post_date']);
            $convert_post_date = date('Y/m/d', $post_date);
            ?>
            <div class="ds-question">
                <img src="Images/<?php echo $row['stud_profile_picture']?>" alt="">
                <div class="ds-question-owner">
                    <div class="ds-owner">
                        <p class="ds-owner-username"><?php echo $row['stud_first_name'].' '.$row['stud_last_name'];?></p>
                        <p class="ds-owner-date"><?php echo $convert_post_date;?></p>
                    </div>
                    <p class="ds-question-text"><?php echo nl2br($row['ques_content']);?></p>
                </div>
            </div>
            <div class="ds-post-question">
                <form action="admin-discussion-post.php?qid=<?php echo $qid;?>&cid=<?php echo $cid?>" method="POST">
                    <input type="hidden" name="user-id" value="<?php echo $id?>">

                </form>
            </div>
        </section>
        <section class="ds-bottom">
            <?php
            //The number of reply of this question
            $sql = "SELECT COUNT(ans_id) AS max_reply FROM answer WHERE ques_id = '$qid'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            $max_reply = $row['max_reply'];
            if($max_reply == 0){
              $max_reply = 0;
            }
            ?>
            <p class="ds-total-reply"><?php echo $max_reply?> Answers</p>
            <?php
            //List out all the replies
            $sql = "SELECT * FROM answer a, teacher t WHERE (a.teac_id = t.teac_id) AND (a.ques_id = '$qid')";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
          
                while ($row = mysqli_fetch_array($result)){
                ?>
            <div class="ds-reply-template">
                
                <img src="Images/<?php echo $row['teac_profile_picture']?>" alt="">
                <div class="ds-reply-detail">
                    <div class="ds-reply-owner">
                        <p class="ds-reply-name"><?php echo $row['teac_first_name'].' '.$row['teac_last_name']?></p>
                        <p class="ds-reply-date"><?php echo $row['ans_date']?></p>
                    </div>
                    <p class="ds-reply-txt"><?php echo nl2br($row['ans_content'])?></p>
                </div>
            </div>
            <?php
                }
            }
            ?>
            <?php
            //List out all the replies
            $sql = "SELECT * FROM answer a, student s WHERE (a.stud_id = s.stud_id) AND (a.ques_id = '$qid')";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
          
                while ($row = mysqli_fetch_array($result)){
                ?>
            <div class="ds-reply-template">
                
                <img src="Images/<?php echo $row['stud_profile_picture']?>" alt="">
                <div class="ds-reply-detail">
                    <div class="ds-reply-owner">
                        <p class="ds-reply-name"><?php echo $row['stud_first_name'].' '.$row['stud_last_name']?></p>
                        <p class="ds-reply-date"><?php echo $row['ans_date']?></p>
                    </div>
                    <p class="ds-reply-txt"><?php echo nl2br($row['ans_content'])?></p>
                </div>
            </div>
            <?php
              }
            
            }
            ?>
        </section>
    </section>
</body>
</html>