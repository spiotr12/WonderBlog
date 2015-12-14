/**
 * Created by Piotrek on 2015-12-09.
 */

/**
 * Verify the user. This is an admin tool to verify users that still wait for verification
 * @param e should be the DOM element which used onclick to activate this funciton
 */
function verifyUser(e) {
    var adminId = $("#admId").text(); // get admin ID
    var thisButton = $(e); // convert to jQuery object
    var id = thisButton.val(); // id of the user to verify
    var conf = confirm("Are you sure to confirm user " + id); // ask admin to confirm their choice
    thisButton.removeClass('btn-success');
    thisButton.addClass('btn-warning');
    thisButton.text("...processing...");
    if (conf) {
        // send id of the user to be verified.
        $.post("./php/verify_user.php", {adminId: adminId, userToVerifyId: id}, function (data) {
            alert(data);
        }).done(function(){
            thisButton.remove();
        });
    } else {
        alert("not confirmed");
        thisButton.addClass('btn-success');
        thisButton.removeClass('btn-warning');
        thisButton.text("Verify!");
    }
}

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
            row += '<td><button class="btn-success btn-verify" id="' + user['id'] + '" type="button" onclick="verifyUser(this)" value="' + user['id'] + '">Verify!</button></td>';
            row += '</tr>';
            tbody.append(row);
        });
    });
}
