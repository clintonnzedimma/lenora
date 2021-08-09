
<!DOCTYPE html>
<html>
<head>
  <title>vid test</title>
</head>
<body>


<div id="remote-media-div">
  
</div>

<div id="local-media">
  
</div>

<script src="http://media.twiliocdn.com/sdk/js/video/releases/2.4.0/twilio-video.min.js"></script>

<script type="text/javascript">
//a7e24e7ed650aeb10955c1dd93f3dcb6
const Video = Twilio.Video;

Video.connect('<?php echo $tkn ?>', { 
  name:' <?php echo $room_name  ?>',   
  video: { width: 640 },
  audio: true
 }).then(room => {
  console.log('Connected to Room "%s"', room.name);

  room.participants.forEach(participantConnected);
  room.on('participantConnected', participantConnected);

  room.on('participantDisconnected', participantDisconnected);
  room.once('disconnected', error => room.participants.forEach(participantDisconnected));
});

function participantConnected(participant) {
  console.log('Participant "%s" connected', participant.identity);

  const div = document.createElement('div');
  div.id = participant.sid;
  div.innerText = participant.identity;

  participant.on('trackSubscribed', track => trackSubscribed(div, track));
  participant.on('trackUnsubscribed', trackUnsubscribed);

  participant.tracks.forEach(publication => {
    if (publication.isSubscribed) {
      trackSubscribed(div, publication.track);
    }
  });

  document.body.appendChild(div);
}

function participantDisconnected(participant) {
  console.log('Participant "%s" disconnected', participant.identity);
  document.getElementById(participant.sid).remove();
}

function trackSubscribed(div, track) {
  div.appendChild(track.attach());
}

function trackUnsubscribed(track) {
  track.detach().forEach(element => element.remove());
}
</script>
</body>
</html>