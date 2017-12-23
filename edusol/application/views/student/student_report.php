<html>
<head>
    <title>Student Report</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"  media="all">
</head>
<body onload="window.print()">
    <table class="table table-bordered table-striped" style="font-size:8px;">
        <thead>
            <tr>
                <th>Gr.No</th>
                <th>Student Name</th>
                <th>Father Name</th>
                <th>Surname</th>
                <th>Religion</th>
                <th>DOB (Figure)</th>
                <th>DOB (Words)</th>
                <th>Place Of Birth</th>
                <th>Class Admitted</th>
                <th>Date of Admission</th>
                <th>Last School Attended</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1; foreach ($student as $key => $value) { ?>
            <?php 
            
            	  $this->db->select('class_name');
		  $this->db->where('class_id',$value['class_admited'])->where('is_delete',0);
		  $class_admitted_name=@$this->db->get('class')->result_array()[0]['class_name'];
            
             ?>

            <tr>
                <td><?php echo $value['grno']; ?></td>
                <td><?php echo $value['student_name']; ?></td>
                <td><?php echo $value['father_name']; ?></td>
                <td><?php echo $value['surname']; ?></td>
                <td><?php echo $value['religion']; ?></td>
                <td><?php if($value['dob']!='0000-00-00') echo date('d-m-Y',strtotime($value['dob']));else echo ""; ?></td>
                <td><?php echo $value['dob_words']; ?></td>
                <td><?php echo $value['pob']; ?></td>
                <td><?php echo $class_admitted_name; ?></td>
                <td><?php if($value['date_of_admission']!='0000-00-00') echo date('d-m-Y',strtotime($value['date_of_admission']));else echo ""; ?></td>
                <td><?php echo $value['previous_school']; ?></td>
            </tr>

            <?php } ?>       
        </tbody>
    </table>
</body>
</html>