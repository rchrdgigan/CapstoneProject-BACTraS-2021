//Download Qr
window.onload = function(){
    document.getElementById("downloadbtn")
    .addEventListener("click",()=>{
        const dqr = this.document.getElementById("downloadqr");
        var opt = {
            margin: 1,
            filename: 'myqr.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
        };
        html2pdf().from(dqr).set(opt).save();
    });
}