//Generate QR
var qrcode = new QRCode(document.getElementById('qrcode'),{
    width: 120,
    height: 120
});

//Methods of QR
function makeCode() {
    var ID = $("#id").text();
    qrcode.makeCode(ID);         
}
makeCode();

//Print QR
$("#btnprnt").click(function(event) {
    window.print();
});