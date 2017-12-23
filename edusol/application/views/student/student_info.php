        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Student Profile</h3>
              </div>
<?php $student_id=$this->uri->segment(3);?>
<?php
  foreach ($studentinfo as $value) {

      $grno=$value['grno'];
      $rollno=$value['roll_no'];
      $id=$value['id'];
      $name=$value['student_name'];
      $student_contact=$value['student_contact'];
      $father_contact=$value['father_contact'];
      $father_cnic=$value['father_cnic'];
      $f_name=empty($value['father_name'])? " " : $value['father_name'];
      $img=empty($value['img'])? " " : $value['img'];
      $surname=$value['surname'];
      $gender=$value['gender'];
      $g_name=$value['guardian_name'];
      $guardian_contact=$value['guardian_contact'];
      $guardian_cnic=$value['guardian_cnic'];
      $religion=$value['religion'];
      $m_t=$value['mother_tongue'];
      $dob=empty($value['dob'])? " " : $value['dob'];
      $dob_words=$value['dob_words'];
      $doa=empty($value['date_of_admission'])? " " : $value['date_of_admission'];
      $taluka=$value['taluka'];
      $father_occupation=$value['father_occupation'];
      $g_occupation=$value['guardian_occupation'];
      $income_family=$value['income_family'];
      $postal_address=$value['postal_address'];
      $father_contact=$value['father_contact'];
     
      $class=$value['class_name'];
      $section=$value['section_name'];
      $moi=$value['mark_identification'];
      $relation_with_guardian=$value['relation_with_guardian'];
      $class_admited=$value['class_admited'];
  }
  $this->db->select('class_name');
  $this->db->where('class_id',$class_admited)->where('is_delete',0);
  $class_admitted_name=@$this->db->get('class')->result_array()[0]['class_name'];
?>
              
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Student <small></small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          
                          <img class="img-responsive avatar-view" src="<?php echo base_url()."/". $img;?>" alt="" title="" width="100px" height="100px">
                        </div>
                      </div>
                      <h3><?php echo @$name;?></h3>
                      <h4><?php echo @$f_name;?></h4>
                      <ul class="list-unstyled user_data">
                        <li><i class="fa fa-map-marker fa-graduation-cap" style="font-size:14px;">Class: &nbsp;&nbsp;&nbsp; </i><?php echo @$class;?>
                        </li>

                        <li>
                          <i class="fa fa-briefcase fa-graduation-cap " style="font-size:14px;">Section:&nbsp;&nbsp;&nbsp;</i><?php echo @$section;?>
                        </li>

                        
                      </ul>

                      <a class="btn btn-success" href="<?php echo base_url();?>student/edit/<?php echo @$student_id;?>"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
                      <br />

 
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">

                      <div class="profile_title">
                        <div class="col-md-6">
                          <h2>Student Information</h2>
                        </div>
                        <div class="col-md-6">
                          <div id="reportrange" class="pull-right" style="margin-top: 5px; background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #E6E9ED">
                            Date of Admission
                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                            <span><?php echo @$doa;?></span> <b class="caret"></b>
                          </div>
                        </div>
                      </div>
                      <!-- start Student infomation -->
                      <div id="graph_bar" style="width:100%; height:280px;">
                        <table class="table table-striped table-bordered dt-responsive nowrap">
                                <tr><th>GR. No</th><td><?php echo @$grno;?></td></tr>
                                <tr><th>Roll No</th><td><?php echo @$rollno;?></td></tr>
                                <tr><th>Class Admitted</th><td><?php echo @$class_admitted_name;?></td></tr>
                                <tr><th>Student Contact</th><td><?php echo @$student_contact;?></td></tr>
                                <tr><th>Surname</th><td><?php echo @$surname;?></td></tr>
                                <tr><th>Gender</th><td><?php echo @$gender;?></td></tr>
                                <tr><th>Religion</th><td><?php echo @$religion;?></td></tr>
                                <tr><th>Mother Tongue</th><td><?php echo @$m_t;?></td></tr>
                                <tr><th>Mark of Identification</th><td><?php echo @$moi;?></td></tr>
                                <tr><th>Date of Birth</th><td><?php echo @$dob;?></td></tr>
                                <tr><th>Date of Birth in words</th><td><?php echo @$dob_words;?></td></tr>
                        </table>  
                         
                      </div>
                      <br/><br/><br/><br><br><br>
                      <!-- end Student Information -->

                      <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Father Information</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Guardian information</a>
                          </li>
                          <!-- <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Profile</a>
                          </li> -->
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                            <!-- start father information -->
                            <table class="table table-striped table-bordered dt-responsive nowrap">
                                <tr><th>Father Name</th><td><?php echo @$f_name;?></td></tr>
                                <tr><th>Father Contant</th><td><?php echo @$father_contact;?></td></tr>
                                <tr><th>Father CNIC</th><td><?php echo @$father_cnic?></td></tr>
                                <tr><th>Father Occupation</th><td><?php echo @$father_occupation;?></td></tr>
                            </table>
                            <!-- end father information activity -->

                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                            <!-- start user projects -->
                            <table class="table table-striped table-bordered dt-responsive nowrap">
                              
                              <tr><th>Name</th><td><?php echo @$g_name;?></td></tr>
                              <tr><th>CNIC</th><td><?php echo @$guardian_cnic; ?></td></tr>
                              <tr><th>Contact #</th><td><?php echo @$guardian_contact;?></td></tr>
                              <tr><th>Occupation</th><td><?php echo @$g_occupation;?></td></tr>
                              <tr><th>Relation with Guardian</th><td><?php echo @$relation_with_guardian;?></td></tr>
                            </table>
                            <!-- end user projects -->

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            EduSolutions
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Custom JS -->
    <script src="<?php echo base_url(); ?>assets/js/main.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>assets/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url(); ?>assets/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?php echo base_url(); ?>assets/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="<?php echo base_url(); ?>assets/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?php echo base_url(); ?>assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>assets/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="<?php echo base_url(); ?>assets/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="<?php echo base_url(); ?>assets/vendors/Flot/jquery.flot.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/Flot/jquery.flot.time.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="<?php echo base_url(); ?>assets/js/flot/jquery.flot.orderBars.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/flot/date.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/flot/jquery.flot.spline.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/flot/curvedLines.js"></script>
    <!-- jVectorMap -->
    <script src="<?php echo base_url(); ?>assets/js/maps/jquery-jvectormap-2.0.3.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url(); ?>assets/js/moment/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/datepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>assets/build/js/custom.min.js"></script>

    <!-- Datatables -->
    <script src="<?php echo base_url(); ?>assets/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/jszip/dist/jszip.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Datatables -->
    <script>
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($("#datatable-buttons").length) {
            $("#datatable-buttons").DataTable({
              dom: "Bfrtip",
              "bPaginate": false,
              buttons: [
                {
                  extend: "copy",
                  className: "btn-sm"
                },
                {
                  extend: "csv",
                  className: "btn-sm"
                },
                {
                  extend: "excel",
                  className: "btn-sm"
                },
                {
                  extend: "pdfHtml5",
                  className: "btn-sm"
                },
                {
                  extend: "print",
                  className: "btn-sm"
                },
              ],
              responsive: true
            });
          }
        };

        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
              handleDataTableButtons();
            }
          };
        }();

        TableManageButtons.init();
      });
    </script>
    <!-- /Datatables -->

  </body>
</html>