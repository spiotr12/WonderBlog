/**
 * Created by Piotrek on 2015-12-09.
 */

$(document).ready(function () {
    getUsers();
});

function getUsers() {
    var tbody = $("#usersTable").children("tbody");
    $.getJSON("../php/data_users.php", function (result) {
        $.each(result, function (i, user) {
            tbody.append("<tr>");
            $.each(user, function (j, userData) {
                tbody.append("<td>");
                tbody.append(userData);
                tbody.append("</td>");
            });
            tbody.append("</tr>");
        });
    });
}