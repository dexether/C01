$(function() {
    $(".loadingbar-demo").loadingbar({direction: "left", done: function(a) {
            $.each(a.items, function(a, b) {
                return $("<img/>").attr("src", b.media.m).prependTo($("#loading-frame")), 2 === a ? !1 : void 0
            })
        }})
}), $(function() {
    $(".loadingbar-demo-right").loadingbar({direction: "right", done: function(a) {
            $.each(a.items, function(a, b) {
                return $("<img/>").attr("src", b.media.m).prependTo($("#loading-frame")), 2 === a ? !1 : void 0
            })
        }})
}), $(function() {
    $(".loadingbar-demo-down").loadingbar({direction: "down", done: function(a) {
            $.each(a.items, function(a, b) {
                return $("<img/>").attr("src", b.media.m).prependTo($("#loading-frame")), 2 === a ? !1 : void 0
            })
        }})
}), $(function() {
    $(".loadingbar-demo-up").loadingbar({direction: "up", done: function(a) {
            $.each(a.items, function(a, b) {
                return $("<img/>").attr("src", b.media.m).prependTo($("#loading-frame")), 2 === a ? !1 : void 0
            })
        }})
});