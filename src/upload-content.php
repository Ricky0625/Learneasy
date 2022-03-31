<?php
session_start();
include("conn.php");

$cour_name = $_GET['cn'];
$tid = $_GET['tid'];

//Get the id of the course
$sql = "SELECT * FROM course WHERE cour_name = '$cour_name' AND teac_id = '$tid'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$cid = $row['cour_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="create-course.css">
    <link rel="icon" href="Images/LE_Favicon.png">
    <script src="https://kit.fontawesome.com/8e94eefdff.js" crossorigin="anonymous"></script>
    <title>Upload Content</title>
</head>
<body>
    <?php include("teacher-nav.php")?>
    <section class="cc-create-course">
        <?php include("backBtn.php")?>
        <?php
        //echo the course detail
        $sql = "SELECT * FROM course WHERE cour_id = '$cid'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        ?>
        <div class="ed-navigate">
            <button onclick="location.href='edit-course.php?cour_id=<?php echo $cid?>'">Course Detail</button>
            <button onclick="location.href='upload-content.php?cn=<?php echo $cour_name?>&tid=<?php echo $tid?>&cid=<?php echo $cid?>'">Upload Content</button>
            <button onclick="location.href='upload-resources.php?cid=<?php echo $cid?>&tid=<?php echo $tid?>'">Upload Resource</button>
            <button onclick="location.href='createquiz.php?cid=<?php echo $cid?>&cn=<?php echo $cour_name?>&tid=<?php echo $tid?>'">Create Quiz</button>
        </div>
        <p class="cc-main-title">Upload Content</p>
        <form action="contentupload.php" method="POST" enctype="multipart/form-data" id="form1">
            <input type="hidden" name="cid" value="<?php echo $cid?>">
            <input type="hidden" name="tid" value="<?php echo $tid?>">
            <input type="hidden" name="cn" value="<?php echo $cour_name?>">
            <div class="cc-flex cc-div">
                <div class="cc-cour-name">
                    <p class="cc-label">Chapter Title:</p>
                    <input type="text" name="cont-title" id="cc-in-cour-name" autocomplete="off" required>
                </div>
            </div>
            <div class="cc-cour-cover cc-div" style="display: flex; justify-content: space-between;">
                <input type="file" id="real-cover" hidden="hidden" accept=".mp4, m4a, .m4p, .m4b, m4r, m4v" name="cont-file" required="required">
                <div class="flex-row upload-file">
                    <button type="button" id="custom-cover-btn">Choose File</button>
                    <span id="custom-cover-span">No file chosen, yet.</span>
                </div>
                <input type="submit" class="cc-create" value="OK" name="upload-content-btn" required></input>
            </div>
        </form>

    </section>
    <section class="cc-cont-list-all">
        <div class="cc-content-list">
            <p class="cc-sub-title">Content List</p>
            <hr class="cc-hr">
            <?php
            $sql = "SELECT * FROM content WHERE cour_id = '$cid' ORDER BY cont_sequence ASC";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) > 0){
                $modal_index = 0;
                while ($row = mysqli_fetch_array($result)){
            ?>
            <div class="cc-content-detail">
                <p class="cc-content-lbl cc-sequence"><?php echo $row['cont_sequence']?></p>
                <p class="cc-content-lbl cc-cont-name"><?php echo $row['cont_title']?></p>
                <p class="cc-content-lbl cc-cont-file"><?php echo $row['cont_video_file']?></p>
                <button type="button" class="cc-edit" id="editcourse" data-modal="editmodal-<?php echo $modal_index;?>">Edit</button>
                <button type="button" class="cc-edit" id="delete-content" style="margin-left: 30px; background-color: #F2617B;" onclick="location.href='delete-content?cont_id=<?php echo $row['cont_id']?>&cn=<?php echo $cour_name;?>&tid=<?php echo $tid;?>&cid=<?php echo $cid?>'">Delete</button>
            </div>
                <!-- The Modal -->
                <div id="editmodal-<?php echo $modal_index;?>" class="modal">
                    <!-- Modal content -->
                    <div class="modal-content">
                        <form action="contentupload.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="ed-cont-id" value="<?php echo $row['cont_id']?>">
                            <input type="hidden" name="tid" value="<?php echo $tid?>">
                            <input type="hidden" name="cn" value="<?php echo $cour_name?>">
                            <div class="ed-modal-top">
                                <div style="display: flex; align-items:center">
                                  <span class="close" data-modal="editmodal-<?php echo $modal_index;?>"><i class="fas fa-times"></i></span>
                                  <p class="ed-modal-title">Edit Content</p>
                                </div>
                                <button type="submit" value="Save" class="edit-save-changes" name="ed-save">Save</button>
                            </div>
                            <div class="ed-form">
                              <div class="ed-flex" style="margin-bottom: 30px;">
                                  <div>
                                    <p class="cc-label">Chapter Title:</p>
                                    <input type="text" name="ed-cont-title" id="ed-cont-title" value="<?php echo $row['cont_title']?>" required>
                                  </div>
                                  <div style="margin-right: 40px;">
                                    <p class="cc-label">Sequence:</p>
                                    <input type="num" name="ed-cont-sequence" id="ed-cont-sequence" value="<?php echo $row['cont_sequence']?>">
                                  </div>
                              </div>
                              <p class="cc-label">Content preview:</p>
                              <iframe id="ed-content-iframe" src="<?php echo $row['cont_video_file'];?>" allowfullscreen style="margin-bottom: 30px;"></iframe>
                              <p class="cc-label">Replace Content:</p>
                              <input type="file" accept=".mp4, m4a, .m4p, .m4b, m4r, m4v" name="ed-cont-file">
                              <!--<div class="flex-row upload-file">
                                  <button type="button" id="custom-cover-btn">Choose File</button>
                                  <span id="custom-cover-span">No file chosen, yet.</span>
                              </div>-->
                            </div>
                        </form>
                    </div>
                </div>
        
            <hr class="cc-hr">
            <?php
                $modal_index++;
              }
            }else{
            ?>
            <div class="tab-empty-state">
              <img src="Images/tab-empty-state.png" alt="">
              <p>Nothing here...</p>
            </div>
            <?php
            }
            ?>
        </div>
        <div class="cc-button cc-div">
            <button type="button" class="cc-cancel" onclick="location.href='mycourse.php'">Cancel</button>
            <a href="upload-resources.php?cid=<?php echo $cid?>&tid=<?php echo $tid?>" class="cc-create" style="width: 110px; text-decoration:none;">Next</a>
        </div>
    </section>
    
    <!--Javascript to turn normal button to a upload file button-->
    <script type="text/javascript">
        const realFileBtn = document.getElementById("real-cover");
        const customBtn = document.getElementById("custom-cover-btn");
        const customTxt = document.getElementById("custom-cover-span");

        customBtn.addEventListener("click", function(){
            realFileBtn.click();
        });

        realFileBtn.addEventListener("change", function(){
            if (realFileBtn.value) {
                customTxt.innerHTML = realFileBtn.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
            } else{
                customTxt.innerHTML = "No file chosen, yet."
            }
        });
    </script>

        <script>
        // Get the button that opens the modal
        var btn = document.getElementsByClassName("cc-edit");
        
        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close");
        
        for (var i = 0; i < btn.length; i++) {
            var thisBtn = btn[i];
            thisBtn.addEventListener("click", function(){
                var modal = document.getElementById(this.dataset.modal);
                modal.style.display = "block";
            }, false);
        }

        for (var i = 0; i < span.length; i++) {
            var thisSpan = span[i];
            thisSpan.addEventListener("click", function(){
                var modal = document.getElementById(this.dataset.modal);
                modal.style.display = "none";
            }, false);
        }
        </script>
</body>
</html>