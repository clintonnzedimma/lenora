<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from demo.dashboardpack.com/finance-html/index_2.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 02 Aug 2021 12:12:02 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Create Class - Lecturer Dashboard</title>

    <!-- <link rel="icon" href="/assets/img/favicon.png" type="image/png"> -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css" />
    <!-- themefy CSS -->
    <link rel="stylesheet" href="/assets/vendors/themefy_icon/themify-icons.css" />
    <!-- swiper slider CSS -->
    <link rel="stylesheet" href="/assets/vendors/swiper_slider/assets/css/swiper.min.css" />
    <!-- select2 CSS -->
    <link rel="stylesheet" href="/assets/vendors/select2/assets/css/select2.min.css" />
    <!-- select2 CSS -->
    <link rel="stylesheet" href="/assets/vendors/niceselect/assets/css/nice-select.css" />
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="/assets/vendors/owl_carousel/assets/css/owl.carousel.css" />
    <!-- gijgo css -->
    <link rel="stylesheet" href="/assets/vendors/gijgo/gijgo.min.css" />
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="/assets/vendors/font_awesome/assets/css/all.min.css" />
    <link rel="stylesheet" href="/assets/vendors/tagsinput/tagsinput.css" />
    <!-- datatable CSS -->
    <link rel="stylesheet" href="/assets/vendors/datatable/assets/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="/assets/vendors/datatable/assets/css/responsive.dataTables.min.css" />
    <link rel="stylesheet" href="/assets/vendors/datatable/assets/css/buttons.dataTables.min.css" />
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
                                <div class="col-12">
                                <form method="POST">
                                            <h2>Start Class</h2>
                    
                                            <div class="form-group">
                                                <b>Name</b><br>
                                                <input type="text" name="name" class="form-control" placeholder="Title" value="<?php if(isset($_POST['name'])) echo $_POST['name']; ?>">
                                            </div>

                                            <div class="form-group">
                                                <b>Welcome Message</b><br>
                                                <input type="text" name="wlcm_msg" class="form-control" placeholder="Enter Message" value="<?php if(isset($_POST['wlcm_msg'])) echo $_POST['wlcm_msg']; ?>">
                                            </div>
                         

                                            <button class="btn_1 full_width text-center" type="submit" name="submit">Create</button>
  
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
<script src="/assets/js/swiper.min.js"></script>
<!-- nice select -->
<script src="/assets/vendors/niceselect/assets/js/jquery.nice-select.min.js"></script>
<!-- owl carousel -->
<script src="/assets/vendors/owl_carousel/assets/js/owl.carousel.min.js"></script>
<!-- gijgo css -->
<script src="/assets/vendors/gijgo/gijgo.min.js"></script>
<!-- responsive table -->
<script src="/assets/vendors/datatable/assets/js/jquery.dataTables.min.js"></script>
<script src="/assets/vendors/datatable/assets/js/dataTables.responsive.min.js"></script>
<script src="/assets/vendors/datatable/assets/js/dataTables.buttons.min.js"></script>
<script src="/assets/vendors/datatable/assets/js/buttons.flash.min.js"></script>
<script src="/assets/vendors/datatable/assets/js/jszip.min.js"></script>
<script src="/assets/vendors/datatable/assets/js/pdfmake.min.js"></script>
<script src="/assets/vendors/datatable/assets/js/vfs_fonts.js"></script>
<script src="/assets/vendors/datatable/assets/js/buttons.html5.min.js"></script>
<script src="/assets/vendors/datatable/assets/js/buttons.print.min.js"></script>

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

</body>

<!-- Mirrored from demo.dashboardpack.com/finance-html/index_2.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 02 Aug 2021 12:12:04 GMT -->
</html>