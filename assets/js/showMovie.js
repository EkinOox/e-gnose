function showMovie(str) {
    if (str == 0) {
        document.getElementById("txtMovie").innerHTML = "";
        return;
    } else {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtMovie").innerHTML = this.responseText;
            }
        };
    }
    xhttp.open("GET", "./controller/getMedia.php?m=" + str, true);
    xhttp.send();
}