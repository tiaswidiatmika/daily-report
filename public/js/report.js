window.onload = function() {
    let url = window.location;
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        text: url.href,
        width: 100,
        height: 100,
        colorDark : "#000000",
        colorLight : "#ffffff",
        correctLevel : QRCode.CorrectLevel.H
    });
}

function printDiv(e) {
    // save the original page content to a pivot called original contents,
    // set printContents by div element's id which will be printed
    var printContents = document.getElementById('main-report').innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();
    // set back body contents as it before printed
    document.body.innerHTML = originalContents;
    // button print doesn't work after been clicked once, even if user cancelled printing process'
    location.reload();
}

// document.getElementById("download-btn").addEventListener('click', printDiv);