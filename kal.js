/*function kalkulal() {
    var s = parseInt(document.getElementById("vendeg").value); 
    var t = parseInt(document.getElementById("nap").value); 
    alert("A kalkulált szállásdíj: " + (1500 * s * t + 300 * s) + " Ft");
}*/

$(function () {
    $("#szamol").on("click", function (e) {
        try {
            var s = parseInt($("#vendeg").val());
        } catch (error) {
            alert(error.message);
        }

        try {
            var t = parseInt($("#nap").val());
        } catch (error) {
            alert(error.message);
        }
        alert("A kalkulált szállásdíj: " + (1500 * s * t + 300 * s) + " Ft");
    })
});