$(document).ready(function () {
  $("#allDeleteBtn").on("click", function () {
    var selectedIds = [];
    $('input[name="chk"]:checked').each(function () {
      selectedIds.push($(this).attr("id"));
    });
    if (selectedIds.length > 0) {
      if (confirm("Are you sure you want to delete ?")) {
        $.ajax({
          type: "POST",
          url: "./php/alldelete.php",
          data: { ids: selectedIds.join(","), mode: "AllDelete" },
          success: function (response) {
            alert("Success");
            // location.reload();
            $("#main").load("#display");
          },
          error: function (error) {
            console.log(error);
          },
        });
      } else {
        return false;
      }
    } else {
      alert("Please select at least one record to delete.");
    }
  });
});
