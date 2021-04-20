<?php
    include('../extra/connection_h.php');
	include('../extra/meta.php');
    include('../extra/header_category.php');

    if(isset($_POST['insert_category'])) {
        $query = "insert into categories set c_name='" . $_POST['c_name'] . "', status = 'active'";
        mysqli_query($con, $query);
        header("location: get_category.php");
    }

?>

<div class="content">
    <div class="left-side"><h1></h1></div>
    <div class="middle"> 
        <h2> Add Categories </h2>
        <br>
    	<form method="post" action="">
    	<table>
    		<tr>
    			<td>Categories Name</td>
    			<td><input type="text" name="c_name" value=""></td>
    		</tr>
    		<tr>
    			<td> <input type="submit" name="insert_category" value="INSERT"></td>
    		</tr>
    	</table>
    </form>
    </div>
    <div class="right-side"><h1></h1></div>
</div>
        
<?php
    // include('../extra/footer.php');
?>
