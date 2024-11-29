$(document).ready(function() {
    $("body").on("click", ".filter", FiltBook);
    // $("body").on("click", ".ratin", getRatingMod);

    // function getRatingMod() {
    //     $(".bookModal").modal("show");
    // }

    function FiltBook() {
        var bkfilt = "";
        $(".chkbk").each(function() {
            if ($(this).is(":checked")) {
                bkfilt += $(this).val() + " OR ";
            }
        });
        if (bkfilt != "") {
            $.post(
                "getbooks.php", {
                    category: bkfilt,
                    // from: from,
                    // to: to,
                    // categ: categ,
                    // size: size,
                    // colour: colour,
                    // type: type,
                    // subtype: subtype,
                    // sortby: sortby,
                },
                function(data) {
                    if (data != "") {
                        $(".single-products").html(data);
                    }
                }
            );
        }
    }

    var bkgrp = $(".bkgrp").val();
    if (bkgrp == "") {
        bkgrp = "";
    }
    let category = "";
    $.post(
        "getbooks.php", {
            category: category,
            bkgrp: bkgrp,
            // from: from,
            // to: to,
            // categ: categ,
            // size: size,
            // colour: colour,
            // type: type,
            // subtype: subtype,
            // sortby: sortby,
        },
        function(data) {
            if (data != "") {
                $(".single-products").html(data);
            }
        }
    );
});