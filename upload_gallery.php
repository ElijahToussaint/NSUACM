<?php
require('config.php');
?>
<?php
if(!isset($_SESSION['username'])){
  header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<!-- Standard Meta -->
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<!-- Site Properties -->
	<title>NSU ACM | Upload to Gallery</title>
	<!-- Frontend Framework CSS -->
	<?php
	require ('header.php');
	?>
</head>
<body>
	<!-- site navbar -->
	<?php
	require ('navbar.php');
	?>
	<!-- body -->
	<?php
	if(isset($_POST['submit'])){
		if($_POST['title'] == ''){
			$error = 'Title is required.';
		}
		elseif($_POST['file'] == ''){
			$error = 'File is required.';
		}
		else {
			$name = $_FILES['image']['name'];
			list($txt, $ext) = explode(".", $name);
			$image_name = time().".".$ext;
			$tmp = $_FILES['image']['tmp_name'];
			if(move_uploaded_file($tmp, 'assets/'.$image_name)){
				$sql = "INSERT INTO gallery (title, image) VALUES ('".$_POST['title']."', '".$image_name."')";
				$result = mysqli_query($mysqli,$sql) or die(mysqli_error());
				$success = 'Image uploaded successfully.';
				header('Location: gallery.php');
			}
			else {
				$error = 'There was a problem uploading the image.';
			}
		}
	}
	?>
	<div class="ui main text container">
		<?php
		if (isset($success))
		{
			echo '<div class="ui positive message"><p>'.$success.'</p></div>';
		}
		if (isset($error))
		{
			echo '<div class="ui negative message"><p>'.$error.'</p></div>';
		}
		?>
		<div class="ui breadcrumb">
			<a href="gallery.php" class="section">Gallery</a>
			<div class="divider"> / </div>
			<div class="active section">Upload to Gallery</div>
		</div>
		<div class="ui section divider"></div>
		<form class="ui form" action="" method="POST" enctype="multipart/form-data">
			<div class="field">
				<label>Title</label>
				<input type="text" name="title" class="form-control" required />
			</div>
			<div class="field">
				<label>Upload Image</label>
				<input type="text" id="txt" name="file" placeholder="Choose File" onclick ="javascript:document.getElementById('file').click();" required />
				<input type="file" id="file" style='display: none;' name="image" accept="image/*" onchange="ChangeText(this, 'txt');" />
			</div>
			<button type="submit" name="submit" class="ui black button">Upload</button>
		</form>
	</div>
	<!-- footer -->
	<?php
	require ('footer.php');
	?>
</body>
</html>
