/**
 * Created by Piotrek on 2015-12-09.
 */

$(document).ready(function () {
    //$('#myCollapsible').on('hidden.bs.collapse', function () {
    //    // do something…
    //})
    $("#usersTitle").click(function () {
        console.log("click");
        getUsers();
    });
});

function getUsers() {
    var tbody = $("#usersTable").find("tbody");
    //tbody.erase();
    $.getJSON("./php/data_users.php", function (result) {
        $.each(result, function (i, user) {
            //console.log(user);
            var row = "<tr>";
            $.each(user, function (j, userData) {
                row += "<td>";
                row += userData;
                row += "</td>";
            });
            row += "</tr>";
            //console.log(row);
            tbody.append(row);
        });
    });
}