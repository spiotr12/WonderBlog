/**
 * Created by Piotrek on 2015-12-09.
 */

$(document).ready(function () {
    $('#usersPanel').on('show.bs.collapse', function () {
        console.log("panel show");
        getUsers();
    });
    $('#usersPanel').on('hidden.bs.collapse', function () {
        console.log("panel hide");
        $(this).find("tbody").empty();
    });
    verifyUser();
});

function getUsers() {
    var tbody = $("#usersTable").find("tbody");
    //tbody.empty();
    $.getJSON("./php/data_users.php", function (result) {
        $.each(result, function (i, user) {
            //console.log(user);
            var row = "<tr>";
            row += '<td><a href="./author.php?id=' + user['id'] + '">' + user['fname'] + '</a></td>';
            row += '<td><a href="./author.php?id=' + user['id'] + '">' + user['lname'] + '</a></td>';
            row += '<td>' + user['privilege'] + '</td>';
            row += '<td>' + user['verified'] + ' <button class="btn-verify" type="button" value="' + user['id'] + '">Verify!</button></td>';
            row += '</tr>';
            tbody.append(row);
        });
    });
}

function verifyUser() {
    $(".btn-verify").click(function(){
        console.log("button clicked and id is ". $(this).val());
    });
}