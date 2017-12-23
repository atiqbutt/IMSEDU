<?php include('header.php');?>

<style>
.error{
    color:green;
}
</style>



<div class="col-md-6">
<div class="box box-primary"  style="padding:10px ">
            <div class="box-header with-border">
              <h3 class="box-title">Slider</h3>
              <?php if($error=$this->session->flashdata('msg'));?>
    <div class="row">
     <div class="col-lg-6">
        <div class="error"><?php echo $error; ?></div>
     </div><!--col-->
     </div><!--row-->
            </div>
  <?php echo form_open_multipart('admin/upload_slider');?>
										  <div class="form-group">
            						<label for="exampleInputEmail1">Image Heading</label>
									<input type="text" name="name" class="form-control" required>
									</div>
									<input type="file" name="img" value="" required>
									
								<br>
								<input type="submit" name="" value="upload" class="btn btn-primary">	

							</form>
							</div>
							</div>










<?php include('side_bar.php');?>

<?php include('footer.php');?>