alert("Hello");


$.ajax({
    url: "http://localhost:80/homepage/api/attendance/read.php",
    success: function (result) {

        var obj = JSON.stringify(result);


        $("#json").text(obj);
    }
});