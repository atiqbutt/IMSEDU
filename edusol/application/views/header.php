<?php  
$branch_data = @$this->db->select("*")->where("id",$this->user_model->getBranch())->where("is_delete",0)->get("branch")->result_array()[0];
$branch_name = $branch_data['name'];
$branch_title = empty($branch_data['name'])?"EduSolutions":$branch_data['name'];
$branch_logo = $branch_data['b_logo'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/images/favicon.ico">
    <title><?php echo $branch_title; ?> | Panel</title>

   

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url(); ?>assets/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url(); ?>assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- jVectorMap -->
    <link href="<?php echo base_url(); ?>assets/css/maps/jquery-jvectormap-2.0.3.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet"/>

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url(); ?>assets/build/css/custom.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/jquery-customselect.css" rel="stylesheet">
<!--  -->
<!--Import Google Icon Font-->
    <link href='http://fonts.googleapis.com/css?family=Lato&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>

    <!--Import Multi Step Indicator css-->
    <link href="<?php echo base_url();?>assets/formwizard/css/gsi-step-indicator.min.css" rel="stylesheet" />

    <!--Import  Step Form Wizard css-->
    <link href="<?php echo base_url();?>assets/formwizard/css/tsf-step-form-wizard.min.css" rel="stylesheet" />
    <!--Import  demo css-->
    <link href="<?php echo base_url();?>assets/formwizard/css/demo.min.css" rel="stylesheet" />

    <link href="<?php echo base_url();?>assets/formwizard/plugin/parsley/css/parsley.min.css" rel="stylesheet" />

    <!--Font Awesome-->
    <link rel="stylesheet" href="../../maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../../maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/multi_select/jquery.multiselect.css">
    <!-- Jquery -->
    <script src="<?php echo base_url(); ?>assets/vendors/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/multi_select/jquery.multiselect.js"></script>
    
    <!-- math sign links -->

<script src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>assets/ckeditor/plugins/ckeditor_wiris/integration/WIRISplugins.js?viewer=image"></script>
<script src="<?php echo base_url(); ?>assets/ckeditor/samples/js/ck_init.js"></script>
    
    <style>
#cke_editor {
  display:none !important;
}
</style>


    <script>
    var jq = jQuery.noConflict();
     jq(document).ready(function(){
            $(document).ajaxStart(function() {
                jq('#ajaxload').show();
            });
            $(document).ajaxStop(function() {
                 jq('#ajaxload').hide();
                 setTimeout(function() {
                   com.wiris.js.JsPluginViewer.parseElement($('body')[0]);
                 }, 1001);
            });
      });

</script>

    /*<script>
    var jq = jQuery.noConflict();
     jq(document).ready(function(){
            $(document).ajaxStart(function() {
                jq('#ajaxload').show();
            });
            $(document).ajaxStop(function() {
                 jq('#ajaxload').hide();
            });
      });
    </script>*/
<!--  -->
  </head>

  <body class="nav-md" id="main_frame">
    <div id="editor" class="hidden" ></div>
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo base_url(); ?>home" class="site_title">
                <?php if($this->user_model->is_super()){ ?>
                <img style="width:50px;" src="<?php echo base_url(); ?>images/school.png" /> 
                <span>Super</span>
                <?php }else{ ?>
                <img style="width:50px;" src="<?php echo base_url().$branch_logo; ?>" />
                <span><?php echo $this->user_model->limitText($branch_name,15,false); ?></span>
                <?php } ?>
              </a>
            </div>

            <div class="clearfix"></div>

            <br />
