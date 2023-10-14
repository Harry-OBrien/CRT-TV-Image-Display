<!DOCTYPE html>
<html>
<head>
<!-- Favicons -->
<link href="assets/img/crt-television-purple.png" rel="icon">
<link href="assets/img/crt-television-purple.png" rel="apple-touch-icon">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- I'm a C++ developer, don't @ me. -->

<style>
body, html {
  height: 100%;
  margin: 0;
}

.bg {
  background-image: url("<?php echo '/assets/img/display-image.png?t=' . time()?>");
  
  height: 100%; 

  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}

form {
  display: none;
}

</style>
</head>
<body>
<div class="bg"></div>
<form id="imgRefreshForm">
  <input type="text" name="knownImgHash" id="knownImgHash" value="<?php echo hash_file('sha256','assets/img/display-image.png'); ?>">
</form>
</body>
<script>
var intervalId = window.setInterval(async function(){

  const form = document.getElementById('imgRefreshForm');
  const formattedFormData = new FormData(form);
  postData(formattedFormData);
}, 1000);

async function postData(formattedFormData){
    const response = await fetch('forms/checkUpdate.php', {
        method: 'POST',
        body: formattedFormData
    });
    const data = await response.json();

    if (data.hasOwnProperty("error")) {
      console.warn(data.error);
      return;
    }

    if (data.do_refresh) {
      location.reload();
    }
}

</script>
</html>