<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        iframe {
            width: 52vw;
            height: 29.297vw;
        }
    </style>
</head>
<body>
<iframe id="course-content-iframe"
        src="https://www.youtube.com/embed/M7lc1UVf-VE?enablejsapi=1"
        frameborder="0"
        style="border: solid 4px #37474F"
        name="course-video"
></iframe>
<a href="https://www.youtube.com/embed/zR8XKQnxpxY?enablejsapi=1" target="course-video">
                        <p class="chapter-name">Introduction: Get into Adobe Illustrator</p>
                    </a>

<script type="text/javascript">
  var tag = document.createElement('script');
  tag.id = 'iframe-demo';
  tag.src = 'https://www.youtube.com/iframe_api';
  var firstScriptTag = document.getElementsByTagName('script')[0];
  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

  var player;
  function onYouTubeIframeAPIReady() {
    player = new YT.Player('course-content-iframe', {
        events: {
          'onReady': onPlayerReady,
          'onStateChange': onPlayerStateChange
        }
    });
  }
  function onPlayerReady(event) {
    document.getElementById('course-content-iframe').style.borderColor = '#FF6D00';
  }
  function changeProgressIcon(playerStatus) {
    var color;
    if (playerStatus == 0) {
      color = "#FFFF00"; // ended = yellow
      alert("Hello");
    }
    if (color) {
      document.getElementById('course-content-iframe').style.borderColor = color;
    }
  }
  function onPlayerStateChange(event) {
    changeProgressIcon(event.data);
  }
</script>
</body>
</html>