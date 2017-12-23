<html>
	<head>
	 	<title>
		 	Date Sheet Preview
		</title>
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/css/bootstrap.min.css">
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12 text-center">
					<h1><?php echo $b_title; ?></h1>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12 text-center">
					<h3>Date Sheet For Class <?php echo @$data[0]['class_name']; ?></h3>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12 text-center">
					<table class="table table-bordered table-stripped">
						<thead>
							<tr>
								<th>#</th>
								<th>Subject</th>
								<th>Date</th>
								<th>Day</th>
								<th>TIME Start</th>
								<th>TIME End</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1; if(is_array($data)){ foreach($data as $k=>$v){ ?>
							<tr>
						
								<td><?php echo $i++; ?></td>
								<td><?php echo $v['subject_name']; ?></td>
								<td><?php echo date("d-m-Y",strtotime($v['date_exam'])); ?></td>
								<td><?php echo $v['day_exam']; ?></td>
								<td><?php echo date("h:i A",strtotime($v['start_time'])); ?></td>
								<td><?php echo date("h:i A",strtotime($v['end_time'])); ?></td>
							</tr>
							<?php } } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>