var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var myObj = JSON.parse(this.responseText);
        var i;
        // for (i = 1; i <)
        console.log(myObj.name[795]);
    }
};
xmlhttp.open("GET", "./api/employers.json", true);
xmlhttp.send();