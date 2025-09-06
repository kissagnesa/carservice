$(".car").on("click", function(w)
    {
        w.preventDefault();
        let carid=$(this).data("id");
        let row=($("#logs-"+carid));
        if (row.is(":visible")) {row.hide(); return;}
        $.get("get_logs.php", {id:carid}, function(data){
            row.show().find("td").html(data);
        });
    });
