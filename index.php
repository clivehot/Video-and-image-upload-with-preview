<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	 <script src='changeInputText.js'></script>
</head>
<body>
<script type="text/javascript">

	function previewVideo(event) {
		var videofileobj = {};
		videofileobj = event.target.files;
		//Place file into an array so we can manipulate it
		videofile = [];
        videofile.push(videofileobj[0]);
        var videoname = videofile[0].name;
        videoname = videoname.toLowerCase();
        //Split the file name when you come across a .
	    var split = videoname.split(".");
	    var ext = split.slice(-1)[0];
	    console.log(ext);
	    if ( ext == "mp4" ) {
             var previewvideo = "<video width='320' height='240'> <source src='"+URL.createObjectURL(videofile[0])+"' type='video/mp4' ></video>";
		     $("#video-preview").append(previewvideo);
		} else {
                  var previewvideo = "<p>Video must be in .mp4 format</p>";
                  $("#video-preview").append(previewvideo);
                  videofile = [];
                  console.log(videofile);
		}
        
	}

	function clearWarning() {
		$('#video-preview').html("");
	}

	function previewImage(event) {
		var imagefileobj = {};
		imagefileobj = event.target.files;
		//Place file into an array so we can manipulate it
		imagefile = [];
        imagefile.push(imagefileobj[0]);
        var imagename = imagefile[0].name;
        imagename = imagename.toLowerCase();
        //Split the name when you come across a .
        var split2 = imagename.split(".");
        var ext2 = split2.slice(-1)[0];
        if ( ext2 == "jpg" ) {
		     var previewimage = "<img src='"+URL.createObjectURL(imagefile[0])+"' />";
		     $("#image-preview").append(previewimage);
		}     
	}    

    $(document).ready(function(){
	   $('#input-label').inputFileText({
          text: 'Select Video File'
       });
    });

</script>

//create a folder called video for videos to be uploaded 
<?php
if (isset($_REQUEST['upload'])) {
    $name=$_FILES['uploadvideo']['name'];
    $tmp_name=$_FILES['uploadvideo']['tmp_name'];
    $target_path="video/";
    $target_path=$target_path.basename($name);
    move_uploaded_file($_FILES['uploadvideo']['tmp_name'],$target_path);
}
?>
<form enctype="multipart/form-data" method="post" action="">
<input name="MAX_FILE_SIZE" value="100000000000000"  type="hidden"/>
<input type="file" id="input-label" name="uploadvideo" onchange="clearWarning();previewVideo(event);previewImage(event)" />
<input type="submit" name="upload" value="SUBMIT" />
</form>

<div id="video-preview" ></div>
<div id="image-preview" ></div>

</body>
</html>