$("form").on("submit", function(e) {
    if($(this).attr("action") == "#") {
        e.preventDefault();
    }
});