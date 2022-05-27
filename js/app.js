$(document).ready(function() {
    function loadTable(page) {
        $.ajax({
            url: "ajax-load.php",
            type: "POST",
            data: {
                page_no: page
            },
            success: function(data) {
                $("#table-data").html(data);
                $("#search").val("");

            }
        });
    };

    function searchTable(search_term, page) {
        $.ajax({
            url: "ajax-live-search.php",
            type: "POST",
            data: {
                search: search_term,
                page_no: page
            },
            success: function(data) {
                $("#table-data").html(data);
            }
        });
        $(document).on("click", "#ajaxbtn", function() {
            $("#ajaxbtn").html("Loading...");
            var pid = $(this).data("id") + 1;
            searchTable(search_term, pid);
            console.log(pid);
        });
    }
    loadTable();

    $("#save-button").on("click", function(e) {
        e.preventDefault();
        var fname = $("#fname").val();
        var lname = $("#lname").val();
        if (fname == "" || lname == "") {
            $("#error-message").html("All fields are required").slideDown();
            $("#success-message").slideUp();
        } else {
            $.ajax({
                url: "ajax-insert.php",
                type: "POST",
                data: $("#addForm").serialize(),
                success: function(data) {
                    if (data == 1) {
                        loadTable();
                        $("#addForm").trigger("reset");
                        $("#success-message").html("Data inserted successfully!").slideDown();
                        $("#error-message").slideUp();
                    } else {

                        $("#error-message").html("Cant Save Record").slideDown();
                        $("#success-message").slideUp();
                    }

                }
            });
        }

    });
    $(document).on("click", ".delete-btn", function() {
        if (confirm("Do you really want to delete this record ?")) {
            var studentId = $(this).data("id");
            var row = this;
            $.ajax({
                url: "ajax-delete.php",
                type: "POST",
                data: {
                    id: studentId
                },
                success: function(data) {
                    if (data == 1) {
                        $(row).closest("tr").fadeOut();
                    } else {
                        $("#error-message").html("Can't Delete Record").slideDown();
                        $("#success-message").slideUp();
                    }
                }
            });
        }

    });
    $(document).on("click", ".edit-btn", function() {
        $("#modal").show();
        var studentId = $(this).data("eid");
        $.ajax({
            url: "load-update-form.php",
            type: "POST",
            data: {
                id: studentId
            },
            success: function(data) {
                $("#modal-form table").html(data)
            }
        });

    });
    $("#close-btn").on("click", function() {
        $("#modal").hide();
    })
    $(document).on("click", "#edit-submit", function() {
        var sId = $("#edit-id").val();
        var sfn = $("#edit-fname").val();
        var sln = $("#edit-lname").val();
        $.ajax({
            url: "ajax-update.php",
            type: "POST",
            data: {
                id: sId,
                fname: sfn,
                lname: sln
            },
            success: function(data) {
                $("#modal").hide();
                if (data == 1) {
                    loadTable();

                    $("#success-message").html("Data Updated successfully!").slideDown();
                    $("#error-message").slideUp();
                } else {

                    $("#error-message").html("Failed").slideDown();
                    $("#success-message").slideUp();
                }

            }
        });
    })
    $("#search").on("keyup", function() {
        var search_term = $(this).val();
        if (search_term == "") {
            $("#table-form").show();
            loadTable();
        } else {
            $("#table-form").hide();
            searchTable(search_term);
        }


    });
    $(document).on("click", "#pagination a", function(e) {
        e.preventDefault();
        var page_id = $(this).attr("id");
        loadTable(page_id);
    });


});