<?php include('header.php');?>


<div class="container">
              <table style="width:900px;">
                
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Email</th>
                                    <th>Message</th>
									<th>Action</th>
								</tr>
                                    
								<?php foreach ($get_data as $key) { ?>
								<tr>
									<td><?php echo $key->id;?></td>
									<td><?php echo $key->name;?></td>
									<td><?php echo $key->email;?></td>
									<td><?php echo $key->message;?></td>
									 <td>
 									<a href="<?php echo base_url()?>Admin/delete_feedback/<?php echo $key->id;?>">
 									 <i class="fa fa-trash-o" aria-hidden="true"></i> </a> </td>
								</tr>
                                <?php } ?>
              </table>

        </div>



<?php include('side_bar.php');?>

<?php include('footer.php');?>