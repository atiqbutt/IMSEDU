<?php include('header.php');?>

 					

 							<div class="box">
            <div class="box-header">
              <h3 class="box-title">Hover Data Table</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
 								<tr>
 									<th>#</th>
 									<th>Name</th>
 									
 									
 									<th>Image</th>
                                     <th>Designation</th>
 									<th>Action</th>
 								</tr>
 								 </thead>
                <tbody>
 								<?php foreach ($get_data as $key) {
 								 ?>
 								<tr>
 									<td>1</td>
 									<td><?php echo $key->name?></td>
 									
 								
 									<td style="width: 40px"><img src="<?php echo base_url().$key->image?>" style="width:40px"></td>
 									
 									  <td><?php echo $key->designation?></td>
                                       <td>
								 <a href="<?php echo base_url()?>Admin/view_teacher_byid/<?php echo $key->id;?>">
 									<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
 									<a href="<?php echo base_url()?>Admin/delete_teacher/<?php echo $key->id;?>">
 									 <i class="fa fa-trash-o" aria-hidden="true"></i> </a> </td>
 								</tr>
 								<?php }?>
 								  </tbody>
                <tfoot>
 							</tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
							
			<?php include('side_bar.php');?>

			<?php include('footer.php');?>
			