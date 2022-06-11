let scanner = new Instascan.Scanner({ video: document.getElementById('preview')});
scanner.addListener('scan', function (i) {
  // passing parameter value of QR ID to qrstr
  var qrstr = ""+i;
    $("#qrstr").val(qrstr);
    if(i.length > 0){
        window.location.href = "tracinglog.php?qrid="+i;
    }
});

// Camera On
Instascan.Camera.getCameras().then(function (cameras) {
  if (cameras.length > 0) {
    // Cameras 0 is equal sa frontcamera
    // Cameras 1 is equal sa rearcamera
    scanner.start(cameras[0]);
  } else {
    console.error('No cameras found.');
  }
}).catch(function (e) {
  console.error(e);
});