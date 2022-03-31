<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <!-- The Modal -->
  <div id="editmodal-<?php echo $modal_index;?>" class="modal">
            <!-- Modal content -->
            <form action="contentupload.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="ed-cont-id" value="<?php echo $row['cont_id']?>">
                <div class="modal-content">
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
                          <input type="text" name="ed-cont-title" id="ed-cont-title" value="<?php echo $row['cont_title']?>">
                        </div>
                        <div style="margin-right: 40px;">
                          <p class="cc-label">Sequence:</p>
                          <input type="num" name="ed-cont-sequence" id="ed-cont-sequence" value="<?php echo $row['cont_sequence']?>">
                        </div>
                    </div>
                    <p class="cc-label">Content preview:</p>
                    <iframe id="ed-content-iframe" src="<?php echo $row['cont_video_file'];?>" allowfullscreen style="margin-bottom: 30px;"></iframe>
                    <p class="cc-label">Replace Content:</p>
                    <input type="file" id="real-cover" hidden="hidden" accept=".mp4, m4a, .m4p, .m4b, m4r, m4v" name="ed-cont-file" required="required">
                    <div class="flex-row upload-file">
                        <button type="button" id="custom-cover-btn">Choose File</button>
                        <span id="custom-cover-span">No file chosen, yet.</span>
                    </div>
                  </div>
                </div>
                <input type="submit">
            </form>
</body>
</html>