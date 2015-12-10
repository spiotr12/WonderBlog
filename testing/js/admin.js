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
            var row = "<tr>";
            //row += '<tr><a href="./author.php?id=' + user.id + '">' + user.fname + '</a></tr>';
            //row += '<tr><a href="./author.php?id=' + user.id  + '">' + user.lname + '</a></tr>';
            row += '<tr>' + user['fname'] + '</tr>';
            console.log(user['fname']);
            row += '<tr>' + user['lname'] + '</tr>';
            console.log(user['lname']);
            row += '<tr>' + user['privilege'] + '</tr>';
            console.log(user['privilege']);
            row += '<tr>' + user['verified'] + '</tr>';
            console.log(user['verified']);
            row += '</tr>';
            tbody.append(row);
        });
    });
}