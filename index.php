<?php
include("db.php");
?>
<html>
<head>
	<title></title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script>
	function downloadCSV(csv,filename){
		var csvFile;
		var downloadLink;
		csvFile= new Blob([csv],{type:"text/csv"});
		downloadLink=document.createElement("a");
		downloadLink.download=filename;
		downloadLink.href=window.URL.createObjectURL(csvFile);
		downloadLink.style.display= "none";
		document.body.appendChild(downloadLink);
		downloadLink.click();
	}

	function exportTableToCSV(filename){
		var csv= [];
		var rows=document.querySelectorAll("table tr");
		for(var i= 0; i< rows.length; i++){
			var row=[],cols=rows[i].querySelectorAll("td, th");
			for(var j=0; j< cols.length; j++)
				row.push(cols[j].innerText);
			csv.push(row.join(","));
		}
		downloadCSV(csv.join("\n"), filename);
	}
	</script>
</head>
<body>
<?php include("menu.php"); ?>
<div class="container">
<h1>All Deal Record || <button onClick="exportTableToCSV('Deal.csv')" class="btn btn-success">Export</button></h1>
 	<table class="table table-bordered">
 		<tr>
 			<td>Date</td>
 			<td>Sr.Name</td>
 			<td>BD Name</td>
 			<td>Client Name</td>
 			<td>Number</td>
 			<td>Amount</td>
			<td>Recive</td>
 			<td>Notes</td>
 			<!-- <td>Update</td> -->
 		</tr>
   
      <?php
 		$qry=mysqli_query($con,"SELECT * FROM `deal` ORDER BY dat,su_sr DESC");
 		while($row=mysqli_fetch_array($qry))
 		{
 			extract($row);
 		?>
 		<tr>
 			<td><?php echo $dat; ?></td>
 			<td><?php echo $su_sr; ?></td>
 			<td><?php echo $b_name; ?></td>
 			<td><?php echo $c_name; ?></td>
 			<td><?php echo $c_number; ?></td>
 			<td><?php echo $pay; ?></td>
			<td><?php echo $recive; ?></td>
 			<td style="width: 200px;"><?php echo $notes; ?></td>
 			<!-- <td><a href="deal_update.php?id=<?php echo $id; ?>" class="btn btn-secondary">Update</a></td> -->
 		</tr>
 		<?php
 		}
 		?>
      <!-- <table>
      	<tr><td>
<button onClick="exportTableToCSV('Deal.csv')" class="btn btn-success">Export</button></td></tr>
</table> -->
</body>
</html>
