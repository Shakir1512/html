$(document).ready(function () {
  $(".delete-btn").on("click", function () {
    if (confirm("Are you sure you want to delete ?")) {
      var id = $(this).data("id");
      var mode = $(this).data("mode");
      $.ajax({
        type: "POST",
        url: "./php/delete.php",
        data: { id: id, mode: mode },
        success: function (response) {
          alert("Success");
          $("#main").load("#display");
        },
        error: function (error) {
          console.log(error);
        },
      });
    } else {
      return false;
    }
  });
});
