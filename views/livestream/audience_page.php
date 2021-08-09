<html lang="en">
    <head>
		<title><?php echo $classroom['id'] ?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="/assets/agora/js/AgoraRTCSDK-3.1.1.js"></script>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
		<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="/assets/agora/css/style.css"/>
    </head>
    <body>
	<div class="container-fluid p-0">
				<div id="full-screen-video"></div>
				<div id="lower-ui-bar" class="row fixed-bottom mb-1">
					<div id="external-broadcasts-container" class="container col-flex">
					</div>
				</div>
			</div>
				<div id="watch-live-overlay">
					<div id="overlay-container">
							<div class="col-md text-center">
									<button id="watch-live-btn" type="button" class="btn btn-block btn-primary btn-xlg">
										<i id="watch-live-icon" class="fas fa-broadcast-tower"></i><span>Watch the Live Stream</span>
									</button>
								</div>
					</div>
			</div>
			</div>
    </body>
    <script>
    const CLASSROOM_ID = '<?php echo $classroom['id'] ?>';
    const AG_ID = '<?php echo $ag_id ?>';
    </script>
    <script src="/assets/agora/js/agora-audience-client.js"></script>
</html>