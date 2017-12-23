<?php include('header.php');?>

<style>
.error{
    color:green;
}
</style>

<div class="tabs" style="margin-left:50px">
					<div id="tab-1" class="tab">
						<article>
							<div class="text-section">
								<h1>Insert Events</h1>
       <?php if($error=$this->session->flashdata('msg'));?>
    <div class="row">
     <div class="col-lg-6">
        <div class="error"><?php echo $error; ?></div>
     </div><!--col-->
     </div><!--row-->
								<!--<p>This is a quick overview of some features</p>-->
							</div>
							</article>
							</div>

							<div style="width: 40%; height: auto;">
							<?php echo form_open_multipart('Admin/upload_gallery');?>
									<label>Event Heading</label>
								<input type="text" name="heading" style="width: 75%; height: 20px" required>
                                <br>
								<label> Discreption</label>
								<input type="text" name="dis"  style="width: 70%; height: 50px;" required>
                                <br>
								<input type="file" name="img" required>	
                                <br>
									<input type="submit" name="" value="upload">
							</form>

							 </div>
							</div>




<?php include('side_bar.php');?>
<?php include('footer.php');?>