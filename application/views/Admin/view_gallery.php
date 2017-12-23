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
 									<th>Event heading</th>
 									<th> description</th>
 									<th>Image</th>
 									<th>Action</th>
 								</tr>
 								 </thead>
                <tbody>
 								<?php foreach ($data as $key) {
 								 ?>
 								<tr>
 									<td>1</td>
 									<td><?php echo $key->image_name?></td>
 									<td><?php echo $key->description?></td>

 									<td style="width: 40px"><img src="<?php echo base_url().$key->image?>" style="width:40px"></td>
 									<td>
 									<a href="<?php echo base_url()?>Admin/view_image_byid/<?php echo $key->id;?>">
 									<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>  

 									<a href="<?php echo base_url()?>Admin/delet_gallery/<?php echo $key->id;?>">
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