function downloadCertificateAsPDF() {
    const { jsPDF } = window.jspdf;

    html2canvas(document.querySelector("#certificate"), {
        scale: 3 // Increase the scale for better quality
    }).then(canvas => {
        const imgData = canvas.toDataURL("image/png");
        const pdf = new jsPDF({
            orientation: 'landscape',
            unit: 'px',
            format: [2160, 1000]
        });
        // Adjust the size to match the increased scale
        pdf.addImage(imgData, 'PNG', 0, 0, 2160, 1000);
        pdf.save("certificate.pdf");
    });
}


function downloadCertificateAsImage() {
    html2canvas(document.querySelector("#certificate"), {
        scale: 3 // Increase the scale for better quality
    }).then(canvas => {
        const imgData = canvas.toDataURL("image/jpeg", 3.0); // 1.0 is for highest quality
        const link = document.createElement('a');
        link.href = imgData;
        link.download = 'certificate.jpg';
        link.click();
    });
}
