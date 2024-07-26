var ElementHelpers = {
    displayOverlay: function (t) {
        $('<div class="form-overlay" style="text-align: center; padding-top: 180px; top: 0; bottom: 0; left: 0; right: 0; background-color: rgba(255,255,255,0.7) !important; position: fixed; z-index: 30000; overflow: hidden;">' +
            '<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">' +
            '<span class="sr-only"></span></div><br/><span style="font-size: 19px;">' + (t || "Loading...") + "</span></div>")
            .appendTo($("body"));
        $("body").addClass("hide-scroll-bar");
    },
    hideOverlay: function () {
        $("body").removeClass("hide-scroll-bar");
        $(document).find(".form-overlay").remove();
    },
    enableElement: function (t) {
        if ($.isArray(t)) {
            $.each(t, function (t, n) {
                n.removeAttr("disabled");
            });
        } else if (typeof t === "object") {
            t.removeAttr("disabled");
        }
    },
    disableElement: function (t) {
        if ($.isArray(t)) {
            $.each(t, function (t, n) {
                console.log(">> ", n);
                n.attr("disabled", true);
            });
        } else if (typeof t === "object") {
            t.attr("disabled", true);
        }
    },
    hideScrollbar: function () {
        $("body").css({ overflow: "hidden !important" });
    },
    displayScrollbar: function () {
        $("body").css({ overflow: "scroll !important" });
    },
    customToastr: function (t, n = "success") {
        toastr.options = {
            closeButton: false,
            debug: false,
            newestOnTop: false,
            progressBar: false,
            positionClass: "toast-top-center",
            preventDuplicates: false,
            onclick: null,
            showDuration: "700",
            hideDuration: "1000",
            timeOut: "3000",
            extendedTimeOut: "7000",
            showEasing: "swing",
            hideEasing: "linear",
            showMethod: "fadeIn",
            hideMethod: "fadeOut"
        };
        if (n === "success") {
            toastr.success(t);
        } else if (n === "info") {
            toastr.info(t);
        } else if (n === "error") {
            toastr.error(t);
        }
    }
};
