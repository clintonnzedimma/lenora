<div class="container-fluid no-gutters">
        <div class="row">
            <div class="col-lg-12 p-0">
                <div class="header_iner d-flex justify-content-between align-items-center">
                    <div class="sidebar_icon d-lg-none">
                        <i class="ti-menu"></i>
                    </div>
                    <div class="serach_field-area">
                            <div class="search_inner">
                                <form action="#">
                                    <div class="search_field">
                                        <input type="text" placeholder="Search here..." >
                                    </div>
                                    <button type="submit"> <img src="/assets/img/icon/icon_search.svg" alt=""> </button>
                                </form>
                            </div>
                        </div>
                    <div class="header_right d-flex justify-content-between align-items-center">
                        <div class="header_notification_warp d-flex align-items-center">
                            <!-- <li>
                                <a href="#"> <img src="/assets/img/icon/bell.svg" alt=""> </a>
                            </li>
                            <li>
                                <a href="#"> <img src="/assets/img/icon/msg.svg" alt=""> </a>
                            </li> -->
                        </div>
                        <div class="profile_info">

                            <h6><?php echo $authUser['full_name'] ?></h6>
                            <!-- <img src="/assets/img/client_img.png" alt="#"> -->

                            <div class="profile_info_iner">
                                <p>Welcome</p>
                                <h5><?php echo $authUser['full_name'] ?></h5>
                                <div class="profile_info_details">
                                    <a href="/logout">Log Out <i class="ti-shift-left"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>