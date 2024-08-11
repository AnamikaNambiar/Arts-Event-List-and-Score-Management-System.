function sorting() {
    var sortBy = document.getElementById("sortby").value;

    // Send an AJAX request to fetch the data
    $.ajax({
        url: "showresult.php",
        type: "POST",
        data: { sortby: sortBy },
        success: function(response) {
            // Parse the JSON response
            var data = JSON.parse(response);

            // Clear the table body
            var tableBody = document.getElementById("ans");
            tableBody.innerHTML = "";

            // Iterate over the data and create table rows
            for (var i = 0; i < data.length; i++) {
                var row = "<tr>" +
                    "<td>" + data[i].username + "</td>" +
                    "<td>" + data[i].sem + "</td>" +
                    "<td>" + data[i].dep + "</td>" +
                    "</tr>";
                tableBody.innerHTML += row;
            }
        }
    });
}
