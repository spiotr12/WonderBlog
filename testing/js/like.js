document.getElementById("f2").onsubmit = function() {
    this.children[1].disabled = true;
    return false; // prevent form from actually posting (only for demo purposes)
}