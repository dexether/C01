!function(a) {
    var b = {replaceURL: !1, target: "#loadingbar-frame", direction: "right", async: !0, complete: function() {
        }, cache: !0, error: function() {
        }, global: !0, headers: {}, statusCode: {}, success: function() {
        }, dataType: "html"};
    a.fx.step.textShadowBlur = function(b) {
        a(b.elem).prop("textShadowBlur", b.now).css({textShadow: "0 0 " + Math.floor(b.now) + "px black"})
    }, a.fn.loadingbar = function(c) {
        var d = a.extend({}, b, c), e = a(this), f = e.attr("href"), g = e.data("target") ? e.data("target") : d.target, h = e.data("type") ? e.data("type") : d.type, i = e.data("datatype") ? e.data("datatype") : d.dataType;
        return this.each(function() {
            e.click(function() {
                return a.ajax({type: h, url: f, async: d.async, complete: d.complete, cache: d.cache, error: d.error, global: d.global, headers: d.headers, statusCode: d.statusCode, success: d.success, dataType: i, beforeSend: function() {
                        if (0 === a("#loadingbar").length)
                            switch (a("body").append("<div id='loadingbar'></div>"), a("#loadingbar").addClass("waiting").append(a("<dt/><dd/>")), d.direction) {
                                case"right":
                                    a("#loadingbar").width(50 + 30 * Math.random() + "%");
                                    break;
                                case"left":
                                    a("#loadingbar").addClass("left").animate({right: 0, left: 100 - (50 + 30 * Math.random()) + "%"}, 200);
                                    break;
                                case"down":
                                    a("#loadingbar").addClass("down").animate({left: 0, height: 50 + 30 * Math.random() + "%"}, 200);
                                    break;
                                case"up":
                                    a("#loadingbar").addClass("up").animate({left: 0, top: 100 - (50 + 30 * Math.random()) + "%"}, 200)
                                }
                    }}).always(function() {
                    switch (d.direction) {
                        case"right":
                            a("#loadingbar").width("101%").delay(200).fadeOut(400, function() {
                                a(this).remove()
                            });
                            break;
                        case"left":
                            a("#loadingbar").css("left", "0").delay(200).fadeOut(400, function() {
                                a(this).remove()
                            });
                            break;
                        case"down":
                            a("#loadingbar").height("101%").delay(200).fadeOut(400, function() {
                                a(this).remove()
                            });
                            break;
                        case"up":
                            a("#loadingbar").css("top", "0").delay(200).fadeOut(400, function() {
                                a(this).remove()
                            })
                        }
                }).done(function(b) {
                    history.replaceState && 1 == d.replaceURL && history.pushState({}, document.title, f), d.done ? d.done(b, g) : a(g).html(b)
                }), !1
            })
        })
    }
}(window.jQuery);