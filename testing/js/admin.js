/**
 * Created by Piotrek on 2015-12-09.
 */

$(document).ready(function () {
    $('#usersPanel').on('show.bs.collapse', function () {
        console.log("panel show");
        getUsers();
    })
    $('#usersPanel').on('hidden.bs.collapse', function () {
        console.log("panel hide");
        $(this).find("tbody").empty();
    })
});

function getUsers() {
    var tbody = $("#usersTable").find("tbody");
    //tbody.empty();
    $.getJSON("./php/data_users.php", function (result) {
        $.each(result, function (i, user) {
            //console.log(user);
            tbody.append("<tr>");
            $.each(user, function (j, userData) {
                tbody.append("<td>");
                tbody.append(userData);
                tbody.append("</td>");
            });
            row += "</tr>";
            //console.log(row);
            tbody.append(row);
        });
    });
}