<?php include('header.php');?>


<div class="col-md-6">
          
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Quick Example</h3>
            </div>
       
            <?php echo form_open_multipart('Admin/edit_notice');?>
              <div class="box-body">
              <input type="hidden" name="u_id" value="<?php echo $get_data['id']; ?>">
                <div class="form-group">
                  <label for="exampleInputEmail1">Title</label>
                  <input type="text" name="heading" value="<?php echo $get_data['title']; ?>" class="form-control" id="exampleInputEmail1" placeholder="Image Heading" required>
                 
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1"> Description</label>
                  <input type="text" name="dis" class="form-control" id="exampleInputPassword1" placeholder=" Description" value="<?php echo $get_data['description']; ?>" required>
                 
                </div>
              
            
               
                
              </div>
        

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
            </form>
          </div>
          </div>

			<?php include('side_bar.php');?>

			<?php include('footer.php');?>