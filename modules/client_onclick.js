$(function(){
    $(".client").on("click", function(e){
        e.preventDefault();
        let cid = $(this).data("id");
        let row = $("#cars-"+cid);
        if(row.is(":visible")) { row.hide(); return; }
        $.get("get_cars.php",{id:cid}, function(data){
            row.show().find("td").html(data);
        });
    });

    $("#search_form").on("submit", function(e){
        e.preventDefault();
        $.post("search.php", $(this).serialize(), function(resp){
            $("#search_result").html(resp);
        });
    });
});
