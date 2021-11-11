<!DOCTYPE html>
<html lang="en">
<head>
  	<title>Record Log</title>
  	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  	<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  	<script src="https://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  	<style>.asteriskField{color: red;}</style>
	 <script>
		$( function() {
			$( "#datepicker" ).datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd" });
			$( "#datepicker" ).datepicker( "setDate", "0" );
			$( "#datepicker1" ).datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd" });
			$( "#datepicker1" ).datepicker( "setDate", "0" );
		} );
	 </script>
  	
</head>

<body>
<?php
	include_once("db_connection_asterisk.php");	
?>
	<div class="container-fluid">
		<div class="col-sm-offset-0 col-sm-12">
		  	<div class="panel panel-primary">
			    <div class="panel-heading text-center">
			    	<b><i style="font-size: 18px;">Date wise Record Log</i></b>
			    </div>
			    <div class="panel-body">
			    	<div class="row">
				    	<div class="col-sm-12">
					    	<center>
								<form class="form-inline" method="post" action="">
									<div class="form-group">
									  <label class="control-label requiredField" for="date">
										Start Date
										<span class="asteriskField">
										  *
										</span>
									  </label>
									  <div class="input-group">
										<input class="form-control" id="datepicker" name="start_date" placeholder="YYYY-MM-DD" type="text" required="" autocomplete="off" />
									  </div>
								  	</div>
								  	<div class="form-group">
									  <label class="control-label requiredField" for="date">
										End Date
										<span class="asteriskField">
										  *
										</span>
									  </label>
									  <div class="input-group">
										<input class="form-control" id="datepicker1" name="end_date" placeholder="YYYY-MM-DD" type="text" required="" autocomplete="off" />
									  </div>
								  	</div>

					              	<div class="form-group">
					                	<button class="btn btn-primary " name="submit" type="submit">View</button>
					              	</div>
								</form>
							</center>
						</div>
					</div>

					<div class="row">
				    	<div class="col-sm-12">
							<?php
          						if(isset($_POST["submit"]))
          						{
          							$startDate = $_POST['start_date'];
          							$startDateTime = $startDate . ' 00:00:00';
          							$endDate = $_POST['end_date'];
          							$endDateTime = $endDate . ' 23:59:59';
            						echo "<h4 style='margin-bottom: 0px;'><center><span class='img-thumbnail bg-primary'>Start Date: <b>".$_POST['start_date']."</b>; End Date: <b>".$_POST['end_date']."</b></span></center></h4>";

									//$sql = "SELECT recording_id, user, start_time, location, filename, length_in_sec FROM `recording_log` WHERE  start_time BETWEEN '$startDateTime' AND '$endDateTime' ORDER BY recording_id DESC ";
									$sql = "SELECT recording_id, user, start_time, location, filename, length_in_sec FROM `recording_log` WHERE  start_time BETWEEN '$startDateTime' AND '$endDateTime' ";
									$result = mysqli_query($connAsterisk, $sql);
        					?>
        				</div>
					</div>

			        <div class="row">
			          	<div class="col-sm-12">
			          		<div class="table-responsive">
					            <table class="table table-striped table-bordered table-hover" id="example">
					              	<thead>
					                	<tr class="success">
					                  		<th>SL</th>
					                  		<th>ID</th>
					                  		<th>Agent</th>
					                  		<th>Number</th>
					                  		<th>Date</th>
					                  		<th>Length</th>
					                  		<th>Listen & Download</th>
					                 		
					                	</tr>
					              	</thead>
					              	<tbody>
					              		<?php
					              			$i = 0;
					              			if (mysqli_num_rows($result) > 0) {
    
    											while($row = mysqli_fetch_assoc($result)) {
    												$filename = $row["filename"];
    												$arr = explode("_", $filename);
       									?>
			       		 							<tr>
							                          	<td><?php echo ++$i; ?></td>
							                          	<td><?php echo $row["recording_id"]; ?></td>
							                          	<td class="text-capitalize"><?php echo $row["user"]; ?></td>
							                          	<?php
							                          		if (isset($arr[2])) {
							                          	?>
							                          		<td><?php echo $arr[2]; ?></td>
							                          	<?php
							                          		} else {
							                          	?>
							                          		<td></td>
							                          	<?php
							                          		}
							                          	?>
							                          	
							                          	<td><?php echo $row["start_time"]; ?></td>
							                          	<td><?php echo  gmdate("H:i:s", $row["length_in_sec"]); ?></td>
							                          	<td>
							                          		<audio controls>
			  													<source src='<?php echo "/audio/".$row["filename"]."-all.mp3"; ?>' type="audio/ogg">
			  													<source src='<?php echo "/audio/".$row["filename"]."-all.mp3"; ?>' type="audio/mpeg">
															</audio>
							                          	</td>
							                        </tr>

       									<?php
   												}
											} else {
    											echo "<h4><center><span class='img-thumbnail bg-danger'>There is no data in between <b>".$_POST['start_date']."</b> & <b>".$_POST['end_date']."</b></span></center></h4>";
											}
											mysqli_close($connAsterisk);
					              		?> 
					              	</tbody>
					            </table>
			        		</div>
			          	</div>
			        </div>
			        <?php
			    		}
			        ?>
			    </div>
		  	</div>	
	  	</div>				  
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
		    $('#example').DataTable();
		} );
	</script>
</body>
</html>
