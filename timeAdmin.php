<?php
require_once 'connect.php';
require_once 'functions.php';
$pageTitle = "User Time Administration";
include 'header.php';

if (isLoggedIn() && isAdministrator()) {
	
} else {
	echo "Access prohibited. Please make sure that you are an administrator before trying to view this page. You will now be redirected.";
	header('refresh:5,url=index.php');
	die();
}?>
<h2>User Time Administration</h2>
<hr><br>
<form method="POST" id="timeAdminEntries">
 		<label>Select User: </label>
	 		<select name="user_id" d="selectUser">
	 		<?php
	 		$query = "SELECT id,firstname,lastname FROM users";
			if ($result = mysqli_query($connect,$query)) {
				while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
					echo "<option name=\"id\" value='".$row['id']."'>".$row['firstname']." ".$row['lastname']."</option>";
				}
			} else {
				echo "Error retrieving user list";
			}
	 		?>
	 		</select><br><br>
		
			<label>Pay Period: </label>
	 		<select name="payPeriodDate" id="payPeriodDate" required>
	 		<option value='2001-06-12'>All Entries</option>
	 		<?php
	 		$period = getCurrentPayPeriod();
			foreach ($period as $dt) {
				echo "<option value='".$dt->format("Y-m-d")."'";
				if ($dt->format("Y-m-d") == getCurrentPayPeriodStartDate()) {
					echo " selected>".$dt->format("Y-m-d")." (Current)";
				} else {
					echo ">".$dt->format("Y-m-d")." (Past)";
				}
	  			echo "</option>";
				}
	 		?>
	 		</select><br><br>
	 		<input type="submit" value="Search" />
	 </form>
	 <hr>
		<div id="timeEntries">
		<table>
		<tr>
		    	<th>In Time</th>
		    	<th>Out Time</th>
		    	<th>Total Hours</th>
		    	<th>Actions</th>
		    	<th>Comments</th>
		</tr>
		</table>
		</div>
<?php
	include 'footer.php';
?>