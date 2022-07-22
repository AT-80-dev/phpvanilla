<!DOCTYPE html>
<html lang="en">
<head>
  <title>File Upload</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

        <div style="text-align: right;">
            <button class="btn btn-success show-modal">Add</button>
        </div>
        <br>
        <table class="upload-table">
            <thead>
                <tr>
                    <th>TITLE</th>
                    <th>THUMBNAIL</th>
                    <th>FILENAME</th>
                    <th>DATE</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody id="dv-catalog">
                <tr>
                    <td colspan="7">No data present</td>
                </tr>
            </tbody>
        </table>
    </div>


    <div id="modalFrm" class="modal">
        <form id="insert_form" action = "/php/create.php" method = "POST" enctype="multipart/form-data" class="dv-form">
            <input type="hidden" name="id" id="id">
            <div class="modal-content">
                <span class="close" style="float: right; padding:5px 10px;">&times;</span>
                <div class="modal-header">
                    Upload File
                </div>
                <hr>
                <div class="modal-body">
                    <div class="form-input">
                        <label for="title">Title <span><small class="text-danger d-none">required field*</small></span></label>
                        <input type="text" id="title" name="title" required>
                    </div>
                    <div class="form-file">
                    <label for="file_upload">File <span><small class="text-danger d-none">required field*</small></span></label>
                        <input type="file" id="file_upload" name="file_upload" required>
                    </div>

                </div>
                <hr>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-add">Save</button>
                    <button type="button" class="btn btn-danger cancel">Cancel</button>
                </div>
            </div>
        </form>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="index.js"></script>
</body>
</html>
