<!DOCTYPE html>
<html>
<head>
	<title>Ajax Form Data With Image</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<!-- Status message -->
<div class="statusMsg"></div>

<div class="d-flex justify-content-center"><h4>Ajax Form Data (Upload Multiple Files)</h4></div>
<!-- File upload form -->
<div class="col-lg-12 d-flex justify-content-center mt-5">
    <form id="fupForm" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name"  />
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email"  />
        </div>
        <div class="form-group">
            <label for="file">Files</label>
            <input type="file" class="form-control" id="file" name="files[]" multiple />
        </div>
        <input type="submit" name="submit" class="btn btn-success submitBtn" value="SUBMIT"/>
    </form>
</div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="bootstrap.bundle.min.js"></script>
  <script src="jquery.slim.min.js"></script>


  <script>
$(document).ready(function(){
    // Submit form data via Ajax
    $("#fupForm").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'insert.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $('.submitBtn').attr("disabled","disabled");
                $('#fupForm').css("opacity",".5");
            },
            success: function(response){
                $('.statusMsg').html('');
                if(response.status == 1){
                    $('#fupForm')[0].reset();
                    $('.statusMsg').html('<p class="alert alert-success">'+response.message+'</p>');
                }else{
                    $('.statusMsg').html('<p class="alert alert-danger">'+response.message+'</p>');
                }
                $('#fupForm').css("opacity","");
                $(".submitBtn").removeAttr("disabled");
            }
        });
    });
	
    // File type validation
    var match = ['application/pdf', 'application/msword', 'application/vnd.ms-office', 'image/jpeg', 'image/png', 'image/jpg'];
    $("#file").change(function() {
        for(i=0;i<this.files.length;i++){
            var file = this.files[i];
            var fileType = file.type;
			
            if(!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3]) || (fileType == match[4]) || (fileType == match[5]))){
                //alert('Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.');
                $('.statusMsg').html('Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.');
                $('.statusMsg').css("background-color","pink");
                $('.statusMsg').css("color","red");
                $("#file").val('');
                return false;
            }
        }
    });
});
</script>

</body>
</html>