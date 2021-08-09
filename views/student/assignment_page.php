<!DOCTYPE html>
<html lang="zxx">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title><?php echo $assignment['keyCode'] ?> Assignment -  Student Dashboard</title>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <!-- <link rel="icon" href="/assets/img/favicon.png" type="image/png"> -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css" />
    <!-- themefy CSS -->
    <link rel="stylesheet" href="/assets/vendors/themefy_icon/themify-icons.css" />
    <!-- swiper slider CSS -->
    <link rel="stylesheet" href="/assets/vendors/swiper_slider//assets/css/swiper.min.css" />
    <!-- select2 CSS -->
    <link rel="stylesheet" href="/assets/vendors/select2//assets/css/select2.min.css" />
    <!-- select2 CSS -->
    <link rel="stylesheet" href="/assets/vendors/niceselect//assets/css/nice-select.css" />
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="/assets/vendors/owl_carousel//assets/css/owl.carousel.css" />
    <!-- gijgo css -->
    <link rel="stylesheet" href="/assets/vendors/gijgo/gijgo.min.css" />
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="/assets/vendors/font_awesome//assets/css/all.min.css" />
    <link rel="stylesheet" href="/assets/vendors/tagsinput/tagsinput.css" />
    <!-- datatable CSS -->
    <link rel="stylesheet" href="/assets/vendors/datatable//assets/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="/assets/vendors/datatable//assets/css/responsive.dataTables.min.css" />
    <link rel="stylesheet" href="/assets/vendors/datatable//assets/css/buttons.dataTables.min.css" />
    <!-- text editor css -->
    <link rel="stylesheet" href="/assets/vendors/text_editor/summernote-bs4.css" />
    <!-- morris css -->
    <link rel="stylesheet" href="/assets/vendors/morris/morris.css">
    <!-- metarial icon css -->
    <link rel="stylesheet" href="/assets/vendors/material_icon/material-icons.css" />

    <!-- menu css  -->
    <link rel="stylesheet" href="/assets/css/metisMenu.css">
    <!-- style CSS -->
    <link rel="stylesheet" href="/assets/css/style.css" />
    <link rel="stylesheet" href="/assets/css/colors/default.css" id="colorSkinCSS">

        <!-- summernote -->
        <link rel="stylesheet" type="text/css" href="/assets/vendors/summernote/summernote.css">
		<link rel="stylesheet" type="text/css" href="/assets/vendors/summernote/summernote-lite.css">
    <link rel="stylesheet" type="text/css" href="/assets/vendors/summernote/summernote-bs4.css">
    
</head>
<body class="crm_body_bg">
    


<!-- main content part here -->
 
 <!-- sidebar  -->
 <!-- sidebar part here -->
<?php include 'includes/sidebar.php' ?>
<!-- sidebar part end -->
 <!--/ sidebar  -->


<section class="main_content dashboard_part">
        <!-- menu  -->
    <?php include "includes/header.php" ?>
    <!--/ menu  -->
    <div class="main_content_iner ">
        <div class="container-fluid plr_30 body_white_bg pt_30">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="single_element">
                        <div class="quick_activity">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h3>Assignment</h3>
                                    <h4>Code: <?php echo $assignment['keyCode'] ?></h4>
                                    <h4>Title: <?php echo $assignment['title'] ?></h4>
                                    <h4>Date created: <?php echo date("h:ia d M Y", strtotime($assignment['createdAt'])) ?></h4>
                                    <br>
                                    <p><h4>Questions :</h4>
                                
                                        <h5 id="hwBody">
                                            <?php echo $assignment['body'] ?>
                                        </h5>
                                    </p>

                                </div>

                                <div class="col-lg-6">
                                <form method="POST">    
                                    <div class="form-group">
                                    <?php if($student_assignment['grade'] != NULL) {?>
                                            <p><h5 style="color:#ffaf47">GRADE : <?php echo $student_assignment['grade'] ?></h5>
                                        </p>
                                        <p><h6 style="color:#e12c64">REMARK : <?php echo $student_assignment['remark'] ?></h6>
                                        </p>
                                        <?php }?>
                                                    <b>Type Answer</b><br>
                                                    <textarea id="summernote" name="body"><?php
                                                     if(isset($_POST['body'])){
                                                        echo $_POST['body'];
                                                     }else {
                                                         echo $student_assignment['body'];
                                                     } ?>
                                                     </textarea>
                                    </div>
                                    <div> 
                    <?php  
                        if(!$studentHasSubmitted) {      
                    ?>
                                   
                                   
                                         <button class="btn_1 full_width text-center" type="submit" name="submit" value="draft">Save to Draft</button>
                                         <button class="btn_1 full_width text-center" type="submit" name="submit" value="final">Submit</button>
  

                <?php }?>
                                 <br>       
                        <small><?php 
                        if($studentHasAssignment) {
                                            echo "Last Updated: ".date("h:ia d/M/Y ", strtotime($student_assignment['updatedAt']));    
                        }?> </small>

                        <br> <br>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

<!-- footer part -->
<div class="footer_part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="footer_iner text-center">
                    <p>2021 © Lenora  Developed by <a href="#"> <i class="ti-heart"></i> </a><a href="#"> Clinton Nzedimma </a></p>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<!-- main content part end -->

<!-- footer  -->
<!-- jquery slim -->
<script src="/assets/js/jquery-3.4.1.min.js"></script>
<!-- popper js -->
<script src="/assets/js/popper.min.js"></script>
<!-- bootstarp js -->
<script src="/assets/js/bootstrap.min.js"></script>
<!-- sidebar menu  -->
<script src="/assets/js/metisMenu.js"></script>
<!-- waypoints js -->
<script src="/assets/vendors/count_up/jquery.waypoints.min.js"></script>
<!-- waypoints js -->
<script src="/assets/vendors/chartlist/Chart.min.js"></script>
<!-- counterup js -->
<script src="/assets/vendors/count_up/jquery.counterup.min.js"></script>
<!-- swiper slider js -->
<script src="/assets/vendors/swiper_slider//assets/js/swiper.min.js"></script>
<!-- nice select -->
<script src="/assets/vendors/niceselect//assets/js/jquery.nice-select.min.js"></script>
<!-- owl carousel -->
<script src="/assets/vendors/owl_carousel//assets/js/owl.carousel.min.js"></script>
<!-- gijgo css -->
<script src="/assets/vendors/gijgo/gijgo.min.js"></script>
<!-- responsive table -->
<script src="/assets/vendors/datatable//assets/js/jquery.dataTables.min.js"></script>
<script src="/assets/vendors/datatable//assets/js/dataTables.responsive.min.js"></script>
<script src="/assets/vendors/datatable//assets/js/dataTables.buttons.min.js"></script>
<script src="/assets/vendors/datatable//assets/js/buttons.flash.min.js"></script>
<script src="/assets/vendors/datatable//assets/js/jszip.min.js"></script>
<script src="/assets/vendors/datatable//assets/js/pdfmake.min.js"></script>
<script src="/assets/vendors/datatable//assets/js/vfs_fonts.js"></script>
<script src="/assets/vendors/datatable//assets/js/buttons.html5.min.js"></script>
<script src="/assets/vendors/datatable//assets/js/buttons.print.min.js"></script>

<script src="/assets/js/chart.min.js"></script>
<!-- progressbar js -->
<script src="/assets/vendors/progressbar/jquery.barfiller.js"></script>
<!-- tag input -->
<script src="/assets/vendors/tagsinput/tagsinput.js"></script>
<!-- text editor js -->
<script src="/assets/vendors/text_editor/summernote-bs4.js"></script>

<script src="/assets/vendors/apex_chart/apexcharts.js"></script>

<!-- custom js -->
<script src="/assets/js/custom.js"></script>

<!-- active_chart js -->
<script src="/assets/js/active_chart2.js"></script>
<script src="/assets/vendors/apex_chart/radial_active_min.js"></script>
<script src="/assets/vendors/apex_chart/stackbar2.js"></script>
<script src="/assets/vendors/apex_chart/area_chart.js"></script>
<!-- <script src="/assets/vendors/apex_chart/pie.js"></script> -->
<script src="/assets/vendors/apex_chart/bar_active_2.js"></script>
<script src="/assets/vendors/chart/assets/js/chartjs_active2.js"></script>
<script src="/assets/vendors/summernote/summernote.min.js"></script>
<script src="/assets/vendors/summernote/ext/addclass.js"></script>
<script> 
    window.onload = function() {
    	$('#summernote').summernote({
		        tabsize: 4,
                height: 400,
		        tooltip: true,
		        lang: 'en-GB',
		        dialogsFade: true,
		        toolbar: [
		            ['style', ['bold', 'italic', 'underline', 'clear']],
		            ['color', ['color']],
		            ['list', ['ul', 'ol']],
		            ['para', ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull']],
		            ['insert', ['link', 'picture']]
		        ]
		      });
		$("#submit").on("click", function () {
			var text =  $('#summernote').summernote('code');
			console.log(text);
		});
    };

</script>

</body>

<!-- Mirrored from demo.dashboardpack.com/finance-html/index_2.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 02 Aug 2021 12:12:04 GMT -->
</html>