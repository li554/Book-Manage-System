function add_book() {
    $.ajax({
        url: "jsp/add_book.jsp",
        type: "post",
        data: $(".manager-nav").serialize(),
        success: function(data) {
            alert(data);
            console.log(data);
            window.location.href="manager.html";
        }
    })
}