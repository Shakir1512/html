$(document).ready(function () {
    $("#searchBtn").on("click", function () {
        var keyword = $("#searchInput").val();
        $.ajax({
            type: "POST",
            url: "./php/search.php",       
            data: { keyword: keyword },
            success: function (response) {
                alert("Success");
                $("#display").html(response);
            },
            error: function (error) {
                console.log(error);
            }
        });
    });
});