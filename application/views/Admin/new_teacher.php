<?php include('header.php');?>
<style>
.error{
    color:green;
}
</style>

<div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
           <div class="box-header with-border">
              <h3 class="box-title">Upload Teacher Data</h3>
              			
       <?php if($error=$this->session->flashdata('msg'));?>
    <div class="row">
     <div class="col-lg-6">
        <div class="error"><?php echo $error; ?></div>
     </div><!--col-->
     </div><!--row-->

            </div>
 
  <?php echo form_open_multipart('Admin/new_teacher');?>
  <div class="box-body">
                <div class="form-group">
                 <label for="exampleInputEmail1">Teacher Name</label>
									<input type="text" class="form-control" name="name" required>
									</div>
                                     <div class="form-group">
                  <label for="exampleInputPassword1">Image</label>
									<input type="file" name="img">
									</div>
									 <div class="form-group">
                  <label for="exampleInputPassword1">Teacher Designation</label>
									<input type="text" name="dis" class="form-control" required>
									</div>
									

								
								</div>
								<div class="box-footer">
								<input type="submit" name="" class="btn btn-primary" value="Submit">	
								</div>
							</form>
							
							</div>
							</div>


			<?php include('side_bar.php');?>
	<?php include('footer.php');?>