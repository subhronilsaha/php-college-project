<?php
    include('../extra/connection_h.php');
	include('../extra/meta.php');
    include('../extra/header_item.php');

	//echo exec('whoami');

    ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

 	//echo "hello";

	// CHECK FOR ADD USER BUTTON CLICK
    if(isset($_POST['insert'])) {
    	
    	// FILE UPLOAD
    	$fileName = $_FILES['file']['name'];
		$target_dir = "item_images/";
		
		//echo $fileName . " " . $target_dir;

		if($fileName != '') {
			
			$target_file = $target_dir.basename($_FILES['file']['name']);
			
			// Extension
			$extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
			
			// Valid file extensions
			$extensionsArr = array("jpg", "jpeg", "png", "gif", "webp");

			//echo $fileName;

			if(in_array($extension, $extensionsArr)) {
				
				// Convert to base64
				$image_base64 = base64_encode(file_get_contents($_FILES['file']['tmp_name']));
				$image = "data::image/" . $extension . ";base64," . $image_base64;

				//echo $image . " " . $image_base64;
				$val = explode('.', $_FILES['file']['name']);
				$upload_ext = end($val);
				$ran = md5(time().rand());
				$file = $ran . '.' . $upload_ext;

				// Store image to upload folder
				if(move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {

					// echo "inserting record";
					// echo $_POST['name'];
					// echo $_POST['categories'];
					// echo $image; 
					// echo $fileName;
					// Insert record
					$query = "insert into items set 
								name='" . $_POST['name'] .
							"', price='" . $_POST['price'] .
                            "', qty='" . $_POST['qty'] .
							"', c_id='" . $_POST['categories'] . 
							"', image='" . $image . 
							"', image_name='" . $fileName . 
							"'";
					// echo $query;
        			mysqli_query($con, $query);

        			// echo "inserted";
				} else {

				}
			}
		} 
		else {

			// Insert record
			//echo "No file name";

			$query = "insert into items set name='" . $_POST['name'] . "', price='" . $_POST['price'] . "', qty='" . $_POST['qty'] . "', c_id='" . $_POST['categories'] . "', image='', image_name='' ";
			mysqli_query($con, $query);
		}

		header("location: get_item.php");
	}

	// FETCH COURSE DATA
	$query = "select * from categories where status='active'";
	$result = mysqli_query($con, $query);

?>

<div class="content">
    <div class="left-side"><h1></h1></div>
    <div class="middle"> 
    	<h2> Add a New Item </h2>
        <br>
    	<form method="post" action="" enctype="multipart/form-data">
    	<table>
    		<tr>
    			<td>Name</td>
    			<td><input type="text" name="name" value=""></td>
    		</tr>
			<tr>
    			<td>Price</td>
    			<td><input type="text" name="price" value=""></td>
    		</tr>
			<tr>
    			<td>Quantity</td>
    			<td><input type="text" name="qty" value=""></td>
    		</tr>
			<tr>
    			<td>Select Category</td>
    			<td>
					<select name="categories" id="categories">
						<?php 
						while($fetch = mysqli_fetch_object($result)) { 
						?>
							<option value="<?php echo $fetch->c_id; ?>">
								<?php echo $fetch->c_name; ?>
							</option>
						<?php 
						}
						?>
					</select>
				</td>
    		</tr>
			<tr>
    			<td>Picture</td>
    			<td><input type="file" name="file" id="file"></td>
    		</tr>
    		<tr>
    			<td> 
    				<input type="submit" name="insert" value="INSERT">
    			</td>
    		</tr>
    	</table>
    </form>
    </div>
    <div class="right-side"></div>
</div>
        
<?php
    // include('../extra/footer.php');
?>
