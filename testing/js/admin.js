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
            row += '<td<a href="./author.php?id=>' + user['id'] + '">' + user['fname'] + '</a></td>';
            console.log(user['fname']);
            row += '<td><a href="./author.php?id=' + user['id'] + '">' + user['lname'] + '</a></td>';
            console.log(user['lname']);
            row += '<td>' + user['privilege'] + '</td>';
            console.log(user['privilege']);
            row += '<td>' + user['verified'] + '</td>';
            console.log(user['verified']);
            row += '</tr>';
            tbody.append(row);
        });
    });
}