!function() {
    var a = function(a, b) {
        "use strict";
        a.extend(!0, b.defaults, {dom: "<'row'<'col-xs-6'l><'col-xs-6'f>r>t<'row'<'col-xs-6'i><'col-xs-6'p>>", renderer: "bootstrap"}), a.extend(b.ext.classes, {sWrapper: "dataTables_wrapper form-inline dt-bootstrap", sFilterInput: "form-control input-sm", sLengthSelect: "form-control input-sm"}), b.ext.renderer.pageButton.bootstrap = function(c, d, e, f, g, h) {
            var i, j, k = new b.Api(c), l = c.oClasses, m = c.oLanguage.oPaginate, n = function(b, d) {
                var f, o, p, q, r = function(a) {
                    a.preventDefault(), "ellipsis" !== a.data.action && k.page(a.data.action).draw(!1)
                };
                for (f = 0, o = d.length; o > f; f++)
                    if (q = d[f], a.isArray(q))
                        n(b, q);
                    else {
                        switch (i = "", j = "", q) {
                            case"ellipsis":
                                i = "&hellip;", j = "disabled";
                                break;
                            case"first":
                                i = m.sFirst, j = q + (g > 0 ? "" : " disabled");
                                break;
                            case"previous":
                                i = m.sPrevious, j = q + (g > 0 ? "" : " disabled");
                                break;
                            case"next":
                                i = m.sNext, j = q + (h - 1 > g ? "" : " disabled");
                                break;
                            case"last":
                                i = m.sLast, j = q + (h - 1 > g ? "" : " disabled");
                                break;
                            default:
                                i = q + 1, j = g === q ? "active" : ""
                        }
                        i && (p = a("<li>", {"class": l.sPageButton + " " + j, "aria-controls": c.sTableId, tabindex: c.iTabIndex, id: 0 === e && "string" == typeof q ? c.sTableId + "_" + q : null}).append(a("<a>", {href: "#"}).html(i)).appendTo(b), c.oApi._fnBindAction(p, {action: q}, r))
                    }
            };
            n(a(d).empty().html('<ul class="pagination"/>').children("ul"), f)
        }, b.TableTools && (a.extend(!0, b.TableTools.classes, {container: "DTTT btn-group", buttons: {normal: "btn btn-default", disabled: "disabled"}, collection: {container: "DTTT_dropdown dropdown-menu", buttons: {normal: "", disabled: "disabled"}}, print: {info: "DTTT_print_info modal"}, select: {row: "active"}}), a.extend(!0, b.TableTools.DEFAULTS.oTags, {collection: {container: "ul", button: "li", liner: "a"}}))
    };
    "function" == typeof define && define.amd ? define(["jquery", "datatables"], a) : "object" == typeof exports ? a(require("jquery"), require("datatables")) : jQuery && a(jQuery, jQuery.fn.dataTable)
}(window, document);