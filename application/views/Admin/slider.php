

<?php include('header.php');?>
<div class="col-md-12">
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
										<th>Image Name</th>
									<th style="width: 50%">Image</th>
								
									<th>Action</th>
								</tr>
								 </thead>
                <tbody>
								<?php $i=1; foreach ($get_data as $key) {
							 ?>
								<tr>
									<td><?php echo $i?></td>

                  	<td><?php echo $key->image_name?></td>
									<td><img src="<?php echo base_url().$key->image?>" style="width:40%"></td>
									<td>
 									<a href="<?php echo base_url()?>Admin/view_slider_byid/<?php echo $key->id;?>">
 									<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

									<a href="<?php echo base_url()?>Admin/del_img_slider/<?php echo $key->id;?>"> 
									<i class="fa fa-trash-o" aria-hidden="true"></i></a>
									</td>
								</tr>
								<?php $i++; }?>
							  </tbody>
                <tfoot>
 							</tfoot>
              </table>
            </div>
         
          </div>
          </div>

							
								
								
			<?php include('side_bar.php');?>

			<?php include('footer.php');?>