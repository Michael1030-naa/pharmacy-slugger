<?php
	include "config.php";
	
	if(isset($_GET['id']))
	{
		$id=$_GET['id'];
		$qry1="SELECT * FROM meds WHERE med_id='$id'";
		$result = $conn->query($qry1);
		$row = $result->fetch_row();
	}

	// Handle form submission and update before any HTML is sent
	if (isset($_POST['update'])) {
		$id = $_POST['medid'];
		$name = $_POST['medname'];
		$qty = $_POST['qty'];
		$cat = $_POST['cat'];
		$price = $_POST['sp'];
		$lcn = $_POST['loc'];
		 
		$sql = "UPDATE meds SET med_name='$name', med_qty='$qty', category='$cat', med_price='$price', location_rack='$lcn' WHERE med_id='$id'";
		if ($conn->query($sql)) {
			// Redirect to inventory view if update successful
			header("Location: inventory-view.php");
			exit(); // Always exit after a header redirect
		} else {
			$error_message = "Error! Unable to update.";
		}
	}
?>

<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="nav2.css">
<link rel="stylesheet" type="text/css" href="form4.css">
<title>Medicines</title>
</head>

<body>

	<div class="sidenav">
		<h2 style="font-family:Arial; color:white; text-align:center;"> PharmaHaven </h2>
		<!-- Sidebar Menu -->
		<a href="adminmainpage.php">Dashboard</a>
		<button class="dropdown-btn">Inventory
			<i class="down"></i>
		</button>
		<div class="dropdown-container">
			<a href="inventory-add.php">Add New Medicine</a>
			<a href="inventory-view.php">Manage Inventory</a>
		</div>
		<button class="dropdown-btn">Suppliers
			<i class="down"></i>
		</button>
		<div class="dropdown-container">
			<a href="supplier-add.php">Add New Supplier</a>
			<a href="supplier-view.php">Manage Suppliers</a>
		</div>
		<!-- Additional Sidebar Items -->
		<!-- ... -->
	</div>

	<div class="topnav">
		<a href="logout.php">Logout</a>
	</div>
	
	<center>
		<div class="head">
			<h2>UPDATE MEDICINE DETAILS</h2>
		</div>
	</center>

	<div class="one">
		<div class="row">
			<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
				<div class="column">
					<p>
						<label for="medid">Medicine ID:</label><br>
						<input type="number" name="medid" value="<?php echo $row[0]; ?>" readonly>
					</p>
					<p>
						<label for="medname">Medicine Name:</label><br>
						<input type="text" name="medname" value="<?php echo $row[1]; ?>">
					</p>
					<p>
						<label for="qty">Quantity:</label><br>
						<input type="number" name="qty" value="<?php echo $row[2]; ?>">
					</p>
					<p>
						<label for="cat">Category:</label><br>
						<input type="text" name="cat" value="<?php echo $row[3]; ?>">
					</p>
				</div>
				
				<div class="column">
					<p>
						<label for="sp">Price: </label><br>
						<input type="number" step="0.01" name="sp" value="<?php echo $row[4]; ?>">
					</p>
					<p>
						<label for="loc">Location:</label><br>
						<input type="text" name="loc" value="<?php echo $row[5]; ?>">
					</p>
				</div>
		
				<input type="submit" name="update" value="Update">
			</form>

			<?php
			if (isset($error_message)) {
				echo "<p style='font-size:8;color:red;'>$error_message</p>";
			}
			?>
		</div>
	</div>

</body>

<script>
	var dropdown = document.getElementsByClassName("dropdown-btn");
	for (var i = 0; i < dropdown.length; i++) {
		dropdown[i].addEventListener("click", function() {
			this.classList.toggle("active");
			var dropdownContent = this.nextElementSibling;
			if (dropdownContent.style.display === "block") {
				dropdownContent.style.display = "none";
			} else {
				dropdownContent.style.display = "block";
			}
		});
	}
</script>

</html>
