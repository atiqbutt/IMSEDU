<?php include('header.php');?>


<div class="col-md-6">
          
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Quick Example</h3>
            </div>
       
            <?php echo form_open_multipart('Admin/edit_slider');?>
              <div class="box-body">
              <input type="hidden" name="u_id" value="<?php echo $get_data['id']; ?>">
                <div class="form-group">
                  <label for="exampleInputEmail1">Image Name</label>
                  <input type="text" name="heading" value="<?php echo $get_data['image_name']; ?>" class="form-control" id="exampleInputEmail1" placeholder="Image Heading" required>
                 
                </div>
              
                <div class="form-group">
                  <label for="exampleInputPassword1">Image</label>
                  <input type="hidden" value="<?php echo $get_data['image']; ?>"  name="my_img">
                  <img width="30%" src="<?php echo base_url().$get_data['image']; ?>">
                 
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">File input</label>
                  <input type="file" name="img" value="" id="exampleInputFile">
                 

                 
                </div>
                
              </div>
        

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          </div>

			<?php include('side_bar.php');?>

			<?php include('footer.php');?>