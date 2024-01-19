// function searchbtn(){
// $(document).ready(function () {
//     alert("I am in Search");
//   $("#searchBtn").on("click", function () {
//     alert("I am inside Search");
//     var keyword = $("#searchInput").val();
//     var mode = $(this).data("mode");
//     alert(mode);
//     alert(keyword);
//     $.ajax({
//       type: "POST",
//       url: "../list.php",
//       data: { keyword: keyword, mode: mode },
//       success: function (response) {
//         alert("Success");
//         $("#main").load("#display");
//         // $("#display").html(response);
//       },
//       error: function (error) {
//         console.log(error);
//       },
//     });
//   });
// });
// }
$(document).ready(function () {
  $("#searchBtn").on("click", function () {
    //alert("I am in Search");
    var keyword = $("#searchInput").val();
    var dropDown = $("#date").val();
    let fromDate = $("#fromDate").val();
    let toDate = $("#toDate").val();
     alert(keyword);
     alert(fromDate);
     alert(toDate);
    var mode = $(this).data("mode");

     alert(mode);
    $.ajax({
      type: "POST",
      url: "/php/search.php",
      data: {
        keyword: keyword,
        mode: mode,
        fromDate: fromDate,
        toDate: toDate,
        dropDown:dropDown
      },
      success: function (response) {
        // alert("Success");
        $("#list").html(response);
      },
      error: function (error) {
        console.log(error);
      },
    });
  });
});
