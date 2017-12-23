
 <?php include('header.php');?>
 
 <script src="<?php echo base_url();?>assets/js/jquery.js"></script>
 <script>
 $(document).ready(function() {

    $('form').submit(function () {
        if ($('#password').val() === "") {
            return false;
        }
    });

$("#confirmPassword").keyup(function(){
    var newPassword = $("#newPassword").val();
    var confirmPassword = $("#confirmPassword").val();

    if(newPassword !== confirmPassword) {
     $("#status").text("Password do not match");
    $("#submit").attr("disabled", "disabled");
    }else{
     $("#status").text("");
     $("#submit").removeAttr("disabled");;
    } 

}); 

window.setTimeout(function() {
$(".alert").fadeTo(500, 0).slideUp(500, function(){
    $(this).remove(); 
});
}, 3000);



});

</script>


 
 <div class="container">
 <div class="right_col">
<div class="row">
    <div class="col-lg-12">
<div class="x_panel">
                <div class="x_content">
<div class="row">
<div class="col-md-4 col-md-offset-3">
<?php if ($this->session->flashdata('msg')): ?>
<div class="alert alert-success">
<?php echo $this->session->flashdata('msg'); ?>
</div>
<?php endif ?>

<?php if ($this->session->flashdata('err-msg')): ?>
<div class="alert alert-danger">
<?php echo $this->session->flashdata('err-msg'); ?>
</div>
<?php endif ?>

<form action="<?php echo base_url();  ?>Admin/update_password" method="post">
<label for="">Password</label>
<input  type="password"  name="old_password" id="password" class="form-control"  placeholder="Password" />
<br>
<label for="">New Password</label>
<input type="password"  name="new_password" id="newPassword" class="form-control"  placeholder="New Password" required /><span id=""></span>
<br>
<label for="">Confirm Password</label>
<input type="password"  name="confirm_password" id="confirmPassword" class="form-control"  placeholder="Confirm Password" required />
<p id="status"></p>
<br>
<button name="submit" id="submit" class="btn btn-succes">Change</button>
</form>
</div><!-- col-md-4 col-md-offset-3 -->
</div> <!-- row -->

   </div><!-- x_content -->
        </div><!-- x_panel -->
     </div> <!-- col-lg-12 -->
</div>  <!-- /#row --> 
</div><!-- right_col -->
</div><!--container-->
<?php include('side_bar.php');?>

<?php include('footer.php');?>

