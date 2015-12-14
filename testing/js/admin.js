/**
 * Created by Piotrek on 2015-12-09.
 */

$(document).ready(function () {
    $('#usersPanel').on('show.bs.collapse', function () {
        getUsers();
    });
    $('#usersPanel').on('hidden.bs.collapse', function () {
        $(this).find("tbody").empty();
    });
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
            verifyUser();
        });
    });
}

function verifyUser() {
    $(".btn-verify").click(function(){
        var id = (this).val();
        var confirm = confirm("Are you sure to confirm user " + id);
        if(confirm){

        } else {
            alert("not confirmed");
        }
    });
}