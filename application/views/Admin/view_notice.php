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
 									<th>Title</th>
 									<th> description</th>
 									<th>Action</th>
 								</tr>
 								 </thead>
                <tbody>
 								<?php foreach ($data as $key) {
 								 ?>
 								<tr>
 									<td><?php echo $key->id?></td>
 									<td><?php echo $key->title?></td>
 									<td><?php echo $key->description?></td>
 									<td>
 									<a href="<?php echo base_url()?>Admin/view_notice_byid/<?php echo $key->id;?>">
 									<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>  

 									<a href="<?php echo base_url()?>Admin/delet_notice/<?php echo $key->id;?>">
 									 <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
										 </td>
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