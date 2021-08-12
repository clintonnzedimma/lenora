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
    <link rel="stylesheet" href="/assets/vendors/datatable/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="/assets/vendors/datatable/css/responsive.dataTables.min.css" />
    <link rel="stylesheet" href="/assets/vendors/datatable/css/buttons.dataTables.min.css" />
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
    <link href="/assets/chatui/styles.css" rel="stylesheet" type="text/css" />
    <link href="/assets/chatui/image-uploader.css" rel="stylesheet" type="text/css" />
</head>
<body class="crm_body_bg">
    


<!-- main content part here -->
 
 <!-- sidebar  -->
 <!-- sidebar part here -->
<?php include 'includes/sidebar.php' ?>
<!-- sidebar part end -->
 <!--/ sidebar  -->

 <style> 

span.time_date {
    font-size:9px;
}
</style>



<section class="main_content dashboard_part">
        <!-- menu  -->
    <?php include "includes/header.php" ?>
    <!--/ menu  -->
    <div class="main_content_iner ">
        <div class="container-fluid plr_30  pt_30">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="single_element">

                    <h3>Class : <?php echo $classroom['keyCode'] ?> </h3>
                    <h4><b><?php echo $classroom['name'] ?></b></h4>
                    <div class="row">
                        <!-- vid stream -->
                        <div class="col-lg-7 col-sm-12">
                            <div id="stream_wrapper"  class="">
                                <iframe src="/live-stream/broadcast/<?php echo $classroom['id'] ?>" width="100%" height="600px"></iframe>
                            </div>
                        </div>



                        <!-- chat ui -->
                        <div class="col-lg-5">
                        
                        <chatui>
                <div class="container">
                <div class="row no-gutters">
                    <div class="col-md-4 border-right">

                </div>
                <div class="col-md-12">
                    <div class="settings-tray">
                        <div class="friend-drawer no-gutters friend-drawer--grey">
                        
                        <div class="text">
                        <!-- <h6>Agent</h6> -->
                        <p class="text-muted"><b><?php echo $classroom['name'] ?></b><br></p>
                        </div>
                        <span class="settings-tray--right">
                        <!-- <i class="material-icons">cached</i>
                        <i class="material-icons">message</i>
                        <i class="material-icons">menu</i> -->
                        </span>
                    </div>
                    </div>
                    <div class="chat-panel">

                        <div class="msg_history" id="msg_history">
                            <!-- Received Message -->
                            <!-- <div class="row no-gutters">
                                <div class="col-md-3">
                                <div class="chat-bubble chat-bubble--left">
                                    Hi dude!
                                </div>
                                </div>
                            </div> -->

                        <!-- Sent Message -->
                            <!-- <div class="row no-gutters">
                                <div class="col-md-3 offset-md-9">
                                <div class="chat-bubble chat-bubble--right">
                                    Hello dude!
                                </div>
                                </div>
                            </div> -->
                        </div>


                        <div class="row">
                            <div class="col-12">
                            <div class="chat-box-tray">
                                <!-- <i class="material-icons">sentiment_very_satisfied</i> -->
                                <button class="icon-btn" onclick="scrollToBottom(100)"><i class="fa fa-angle-down" style="font-size:15px"></i> </button>

                                <input  id="bm-msg" type="text" placeholder="Type your message here...">
                                <!-- <button class="icon-btn" onclick="openAttachmentModal()"><i class="material-icons">photo</i> </button> -->
                                
                                <button class="icon-btn" onclick="sendMessage()"><i class="material-icons">send</i></button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
             </div>

            </chatui>
                          
                        </div>
                    </div>


                    </div>
                </div>
                
            </div>
        </div>
    </div>

      <!-- attach image modal -->            
      <div class="modal" id="attachImgModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Send Picture</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <div class="container">			
	<div class="row">
		<div class="col-md-8">
            <h2></h2>

            <label style="font-size: 14px;">
                                <span style='color:navy;font-weight:bold'>Attachment Instructions :</span>
                            </label>
                            <ol>
                                <li>
                                    Allowed only files with extension (jpg, png, gif)
                                </li>
                                <li>
                                    Maximum number of allowed files 10 with 4 MB for each
                                </li>

                            </ol>
			<button class="imgbuts btn btn-success">Browse...</button>
			<form action="method" name="upload-file" class="main_form" id="form-upload-file" enctype="multipart/form-data">
				<div class="ui-block">
					<aside class="suggested-posts">
						<div class="suggested-posts-container"> 
							<div class="row" id="message_box"></div> 
						</div>	
					</aside>
				</div>
			</form>
			<button class="btn btn-primary btn-md-2 " id='post_send' onclick="save_muliple_image()"><i class="material-icons">send</i></button>
			<div class="progress">
				<div class="progress-bar" role="progressbar"  style="width:0%">
				  <span class="sr-only">0</span>
				</div>
			</div>
			<h2 class="success_msg">Photo has uploaded successfully!</h2>
		</div>
	</div> 
</div> 

                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
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
<script src="/assets/vendors/datatable/js/jquery.dataTables.min.js"></script>
<script src="/assets/vendors/datatable/js/dataTables.responsive.min.js"></script>
<script src="/assets/vendors/datatable/js/dataTables.buttons.min.js"></script>
<script src="/assets/vendors/datatable/js/buttons.flash.min.js"></script>
<script src="/assets/vendors/datatable/js/jszip.min.js"></script>
<script src="/assets/vendors/datatable/js/pdfmake.min.js"></script>
<script src="/assets/vendors/datatable/js/vfs_fonts.js"></script>
<script src="/assets/vendors/datatable/js/buttons.html5.min.js"></script>
<script src="/assets/vendors/datatable/js/buttons.print.min.js"></script>

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
 <!-- chat ui -->
 <script src="/assets/chatui/image-uploader.js"></script>
<script src="https:///media.twiliocdn.com/sdk/js/video/releases/2.4.0/twilio-video.min.js"></script>

</body>

<script>
        const $ = jQuery;

        $( '.friend-drawer--onhover' ).on( 'click',  function() {
        
        $( '.chat-bubble' ).hide('slow').show('slow');
        
        });
    </script>  


<script>




    function testForm() {
        let form = $('#__img_multi_form')[0]; 
        let formData = new FormData(form);
        console.log(formData.values());
        for (let value of formData.values()) {
          console.log(value); 
        }
    }

function padZero(your_number, length = 2) {
    var num = '' + your_number;
    while (num.length < length) {
        num = '0' + num;
    }
    return num;
}

function dateCtx(date){
    // var date = "2013-05-12 20:00:00",
    let values = date.split(/[^0-9]/),
    year = parseInt(values[0], 10),
    month = parseInt(values[1], 10) - 1, // Month is zero based, so subtract 1
    day = parseInt(values[2], 10),
    hours = parseInt(values[3], 10),
    minutes = parseInt(values[4], 10),
    seconds = parseInt(values[5], 10),
    formattedDate;

    formattedDate = new Date(year, month, day, hours, minutes, seconds);
    
    return formattedDate;
}

var beamData = {
    URL: '<?php echo $beamify_url ?>',
    start : 0,
    uKey : '<?=$uKey?>',
    rKey : '<?=$rKey?>',
    uniqueCache: [],
};

var beamProps = {
    time : {
        months : ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
    }
}


function loadAllMessages(){

$.post(
   `${beamData.URL}/all-messages/${beamData.rKey}`,
   {
       uKey: beamData.uKey
   },
   function(res) {
       console.log(res);
       res.data.forEach((message) => {

        let d = dateCtx(message.createdAt);

        let messageHasAttachment = (message.attachKey) ? 'bm-attach' : '';


            if(message.isSender){

                $("#msg_history").append(`
                        <div class="row no-gutters sender">
                            <div class="col-md-9 offset-md-9">
                            <div class="chat-bubble chat-bubble--right">
                                <p style='color:white'>${message.body}<p>

                               <small> <span class="time_date" style='color:#e3e7f9'> ${d.getHours()}:${padZero(d.getMinutes())} |  ${padZero(d.getDate())}  ${beamProps.time.months[d.getMonth()].slice(0,3)} </span></div> </small>
                            </div>
                            </div>
                        </div>
                       
                `)
            }else {
                $("#msg_history").append(`  
                    <div class="row no-gutters reciever">
                            <div class="col-md-9">
                            <div class="chat-bubble chat-bubble--left">
                            <small> ${message.monicker} </small>
                             <p style='color:#404237'> ${message.body} </p>
                             
                             <span class="time_date" style='color:#292929'> ${padZero(d.getHours())}:${padZero(d.getMinutes())} |  ${padZero(d.getDate())}  ${beamProps.time.months[d.getMonth()].slice(0,3)} </span></div>
                            </div>
                            </div>
                        </div>
                  


                `);         
            }
       });

       // scroll to bottom in 1s
       scrollToBottom(1000);
     
   }
);
}



function loadNewMessages(){

    let messageHasAttachment = false;

    $.post(
       `${beamData.URL}/new-messages/${beamData.rKey}`,
       {
           uKey: beamData.uKey
       },
       function(res) {
            console.log(res);
            let message = res.data;
            let storeData = JSON.parse(localStorage.getItem("beamStore"));
            let d = dateCtx(message.createdAt);
            let messageHasAttachment = (message.attachKey) ? 'bm-attach' : '';

            if(!storeData.<?=$rKey?>.uniqueCache.includes(message.id) ){
                storeData.<?=$rKey?>.uniqueCache.push(message.id);
                console.log(storeData);
                localStorage.setItem("beamStore", JSON.stringify(storeData));
                
                if(message.isSender){

                    $("#msg_history").append(`
                            <div class="row no-gutters sender">
                                <div class="col-md-9 offset-md-9">
                                
                                <div class="chat-bubble chat-bubble--right">
                                    <p style='color:white'>${message.body}<p>

                                <small> <span class="time_date" style='color:#e3e7f9'> ${d.getHours()}:${d.getMinutes()} |  ${d.getDate()}  ${beamProps.time.months[d.getMonth()].slice(0,3)} </span></div> </small>
                                </div>
                                </div>
                            </div>
                      
                    `)
            }else {
                $("#msg_history").append(`  
                    <div class="row no-gutters reciever">
                            <div class="col-md-9">
                            <div class="chat-bubble chat-bubble--left">
                            <small> ${message.monicker} </small>
                             <p style='color:#404237'> ${message.body} </p>
                             
                             <span class="time_date" style='color:#292929'> ${padZero(d.getHours())}:${padZero(d.getMinutes())} |  ${padZero(d.getDate())}  ${beamProps.time.months[d.getMonth()].slice(0,3)} </span></div>
                            </div>
                            </div>
                        </div>
                        <br>
                        

                `); 

                  // ring new msg
                  playSound('newMsgAudio');           
             }

             scrollToBottom(100);
            }
        
       });
}


function initStoreCache(){
    $.post(
       `${beamData.URL}/new-messages/${beamData.rKey}`,
       {
           uKey: beamData.uKey
       },
       function(res) {
           console.log(res);
            let message = res.data;


             // store lastest message in cache   
            localStorage.setItem("beamStore", JSON.stringify(
                    {
                        <?=$rKey?> : {
                            uniqueCache : [message.id]
                        }
                    }
            ));   

       }
   );
}



function sendMessage(){
    let msg = $("#bm-msg").val();

    $.post(
       `${beamData.URL}/send-message`,
       {
           uKey: beamData.uKey,
           rKey : beamData.rKey,
           message: msg,
           monicker: "<?php echo $authUser['full_name'] ?>"
       },
       function(res) { 
            console.log(res);
            if(res.status == true) {
                loadNewMessages();
                $("#bm-msg").val('');
            }   
        }
    );
}

function scrollToBottom(time = 1000) {
    $("#msg_history").stop().animate({ scrollTop: ($('#msg_history')[0].scrollHeight * 10)}, time);
}

function playSound(audioId, play = true) {
    let myAudio = document.getElementById(audioId);
    let isPlaying = false;
    
    function togglePlay() {
      isPlaying ? myAudio.pause() : myAudio.play();
    };
    
    myAudio.onplaying = function() {
      isPlaying = true;
    };
    myAudio.onpause = function() {
      isPlaying = false;
    } 
    
    if(play == true) togglePlay();
}


function sendImage(){
    console.log(AttachmentArray);

    let formData = {
       files : JSON.stringify(AttachmentArray),
       uKey : beamData.uKey,
       rKey : beamData.rKey,
       beamURL : '',
       monicker: "<?php echo $authUser['full_name'] ?>"
    }

    $.ajax({
        url : `${beamData.URL}/send-image`,
        type:"POST",
        data : formData,    
        success : (res)=>{
            console.log(res);
            if(res.status == true) {
                loadNewMessages();
            }
        }
    }); 
}


function openAttachmentModal() {
    $("#attachImgModal").modal("show");
}



  




</script>



<!-- new multi upload -->	

<script>
  var xp = 0;
var input_btn = 0;
var dts = [];
$(document).on("click", ".imgbuts", function (e) {
  input_btn++;
  $("#form-upload-file").append(
    "<input type='file' style='display:none;' name='upload_files[]' id='filenumber" +
      input_btn +
      "' class='img_file upload_files' accept='.gif,.jpg,.jpeg,.png,' multiple/>"
  );
  $("#filenumber" + input_btn).click();
});

$(document).on("change", ".upload_files", function (e){
  files = e.target.files;
  filesLength = files.length;
  for (var i = 0; i < filesLength; i++) {
	  xp++; 
    var f = files[i];
    var res_ext = files[i].name.split(".");
    var img_or_video = res_ext[res_ext.length - 1];
    var fileReader = new FileReader();
    fileReader.name = f.name;
      fileReader.onload = function (e) {
        var file = e.target;
        $("#message_box").append(
          "<article class='suggested-posts-article remove_artical" +
            xp +
            "' data-file='" +
            file.name +
            "'><div class='posts_article background_v" +
            xp +
            "' style='background-image: url(" +
            e.target.result +
            ")'></div><div class='p_run_div'><span class='pp_run progress_run" +
            xp +
            "' style='opacity: 1;'></span></div><p class='fa_p p_for_fa" +
            xp +
            "'><span class='cancel_mutile_image btnxc cancel_fa" +
            xp +
            "' deltsid='"+0+"'>&#10006;</span><span class='btnxc btnxc_r' >&#10004;</span></p></article>"
        );
      };
      fileReader.readAsDataURL(f);
  }
  
});

function resetImageUpload () {
    $("#post_send").prop("disabled", false);
}

function save_muliple_image() { 
suggested = $(".suggested-posts-article").length;
  if (suggested > 0) {
   // $(".cancel_mutile_image").prop("disabled", true);
    $("#post_send").prop("disabled", true);
    var formData = new FormData(document.getElementById("form-upload-file"));
    formData.append("dts", dts); 
    formData.append("uKey", beamData.uKey);
    formData.append("rKey", beamData.rKey);
    var xhr = new window.XMLHttpRequest();
    $.ajax({
      url: `${beamData.URL}/send-image`,
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function (res) { 
        $(".main-content").find(".message-loading-overlay2").remove();
        console.log(res);
        if(res.status == true) {
            resetImageUpload();
        }
      },
      error: function (e) {
        $("#preview_file_div ul").html(
          "<li class='text-danger'>Something wrong! Please try again.</li>"
        );
      },
      xhr: function (e) {
        xhr.upload.addEventListener(
          "progress",
          function (e) {
            console.log(e);
            if (e.lengthComputable) {
              var percentComplete = ((e.loaded || e.position) * 100) / e.total;
              if(percentComplete==100){
              $(".progress-bar").width(percentComplete + "%").html('99' + "%");
              }else{ $(".progress-bar").width(percentComplete + "%").html(percentComplete.round(0) + "%"); }
            }
          },
          false
        );
        xhr.addEventListener("load", function (e) {
          $('.progress-bar').css("background","#5cb85c").html('100' + "%");
		 // $(".btnxc_r").show();
          $(".success_msg").show();
          
          setTimeout (function(){
            $(".success_msg").hide();
            $(".progress-bar").width(0 + "%").html(0 + "%");
          }, 3000)
		  //$(".cancel_mutile_image").remove();
        });
        return xhr;
      },
    });
  } else {
    $(".messaf").show();
  }
}
var rty=0;
$(document).on("click", ".cancel_mutile_image", function (e) {
  $('.cancel_mutile_image').each(function(){ 
	  chk_id = $(this).attr('deltsid');
	  if(chk_id==0){ rty++; $(this).attr('deltsid',rty); }
  });
  deltsid = $(this).attr('deltsid');
  dts.push(deltsid);
  $(this).parents(".suggested-posts-article").remove();
});


</script>

<script> 


 window.onload = function(){
    loadAllMessages();

    initStoreCache();

    scrollToBottom(100);
    
    // create invisible
   let beamEl = document.createElement("beamify");
    document.body.appendChild(beamEl);
    
    beamEl.innerHTML = `
       <audio id="newMsgAudio" src="/assets/chatui/sounds/new-msg.mp3" preload="auto">
      </audio>
      
         <audio id="sendMsgAudio" src="/assets/chatui/sounds/sent-msg.mp3" preload="auto">
      </audio>
    `; 

 };
 
 setInterval(loadNewMessages, 3000);

</script>
</html>