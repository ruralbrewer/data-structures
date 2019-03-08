
function drawrit() {
    let canvas = document.getElementById("graph");
    let ctx = canvas.getContext("2d");
    ctx.moveTo(0, 0);
    ctx.lineTo(200, 100);
    ctx.stroke();
}