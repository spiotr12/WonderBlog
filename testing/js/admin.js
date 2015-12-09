/**
 * Created by Piotrek on 2015-12-09.
 */

$(document).ready(function () {
    getUsers();
});

function getUsers() {
    $.getJSON("../php/data_users.php", function (result) {
        $.each(result, function (i, field) {
            $("#testDiv").append(field + " ");
        });
    });
}