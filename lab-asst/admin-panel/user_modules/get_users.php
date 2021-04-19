<?php
    include('../extra/connection_h.php');
    //ini_set('display_errors', 1);

	$query = "SELECT * FROM foodItems";
    $result = mysqli_query($con, $query);
    
    if(isset($_REQUEST['del'])) {
        $query = "delete from foodItems where f_id = '" . $_REQUEST['del'] . "'";
        mysqli_query($con, $query);
        header("location: get_users.php");
    }

	include('../extra/meta.php');
    include('../extra/header_user.php');
?>

<div class="content">
    <div class="left-side"></div>
	<div class="middle"> 
        <h2> All Food Items </h2>
        <br>
    	<table>
    		<tr>
    			<td> <b> Food ID  </b> </td>
                <td> <b> Photo        </b> </td>
    			<td> <b> Name         </b> </td>
				<td> <b> Category   </b> </td>
                <td> <b> Action       </b> </td>
    		</tr>
    		<?php while($fetch = mysqli_fetch_object($result)) { ?>
    		<tr>
    			<td> <?php echo $fetch->f_id; ?> </td>
                <td> 
                    <img 
                    src="user_images/<?php echo $fetch->f_image_name; ?>" 
                    width=50 
                    height=50>
                </td>
    			<td> <?php echo $fetch->f_name; ?> </td>
				<?php 
					$query1 = "select c_name from categories where c_id = '" . $fetch->c_id . "'";
					$result1 = mysqli_query($con, $query1);
					$fetch1 = mysqli_fetch_object($result1);
				?>
				<td> <?php echo $fetch1->c_name; ?> </td>
                <td>
					<a 
					href="edit_user.php?id=<?php echo $fetch->f_id; ?>">
						Edit
					</a>
				</td>
                <td><a href="get_users.php?del=<?php echo $fetch->f_id; ?>">Delete</a></td>
    		</tr>
    		<?php } ?>
    	</table>
    </div>
    <div class="right-side"></div>
</div>
        
<?php
    // include('../extra/footer.php');
?>