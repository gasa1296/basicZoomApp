<?php
require __DIR__ . '/config.php';
  
$loginUrl = "https://zoom.us/oauth/authorize?response_type=code&client_id=".CLIENT_ID."&redirect_uri=".REDIRECT_URI;

$createMeetingUrl =  "https://$_SERVER[HTTP_HOST]/zoomApi/createMeeting.php";

?><a href="<?php echo $loginUrl; ?>">Login with Zoom</a>
<a href="<?php echo $createMeetingUrl; ?>">create meeting</a>
