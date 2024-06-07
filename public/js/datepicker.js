/*!
 * Datetimepicker fork of monim67
 * https://github.com/monim67/bootstrap-datetimepicker/
 */

/*! version : 4.17.47
 =========================================================
 bootstrap-datetimejs
 https://github.com/Eonasdan/bootstrap-datetimepicker
 Copyright (c) 2015 Jonathan Peterson
 =========================================================
 */
/*
 The MIT License (MIT)

 Copyright (c) 2015 Jonathan Peterson

 Permission is hereby granted, free of charge, to any person obtaining a copy
 of this software and associated documentation files (the "Software"), to deal
 in the Software without restriction, including without limitation the rights
 to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 copies of the Software, and to permit persons to whom the Software is
 furnished to do so, subject to the following conditions:

 The above copyright notice and this permission notice shall be included in
 all copies or substantial portions of the Software.

 THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 THE SOFTWARE.
 */
/*global define:false */
/*global exports:false */
/*global require:false */
/*global jQuery:false */
/*global moment:false */
!function (e) {
    "use strict";
    if ("function" == typeof define && define.amd) define(["jquery", "moment"], e); else if ("object" == typeof exports) module.exports = e(require("jquery"), require("moment")); else {
        if ("undefined" == typeof jQuery) throw"bootstrap-datetimepicker requires jQuery to be loaded first";
        if ("undefined" == typeof moment) throw"bootstrap-datetimepicker requires Moment.js to be loaded first";
        e(jQuery, moment)
    }
}(function (de, le) {
    "use strict";
    if (!le) throw new Error("bootstrap-datetimepicker requires Moment.js to be loaded first");
    var i = function (i, c) {
        var u, f, n, h, a, r, o, s, d, l = {}, p = !0, m = !1, y = !1, b = 0,
            t = [{clsName: "days", navFnc: "M", navStep: 1}, {
                clsName: "months",
                navFnc: "y",
                navStep: 1
            }, {clsName: "years", navFnc: "y", navStep: 10}, {clsName: "decades", navFnc: "y", navStep: 100}],
            w = ["days", "months", "years", "decades"], g = ["top", "bottom", "auto"], v = ["left", "right", "auto"],
            k = ["default", "top", "bottom"], D = {
                up: 38,
                38: "up",
                down: 40,
                40: "down",
                left: 37,
                37: "left",
                right: 39,
                39: "right",
                tab: 9,
                9: "tab",
                escape: 27,
                27: "escape",
                enter: 13,
                13: "enter",
                pageUp: 33,
                33: "pageUp",
                pageDown: 34,
                34: "pageDown",
                shift: 16,
                16: "shift",
                control: 17,
                17: "control",
                space: 32,
                32: "space",
                t: 84,
                84: "t",
                delete: 46,
                46: "delete"
            }, x = {}, C = "<td></td>", T = function (e) {
                return '<td colspan="3"><span class="bdpw-clock-digit center' + ("h" == e ? " cursor" : "") + '" title="Pick Hour" data-action="showHours" data-time-component="hours">10</span><span class="bdpw-timepicker-colon">:</span><span class="bdpw-clock-digit center' + ("m" == e ? " cursor" : "") + '" title="Pick Minute" data-action="showMinutes" data-time-component="minutes">30</span><span class="bdpw-timepicker-colon">:</span><span class="bdpw-clock-digit center' + ("s" == e ? " cursor" : "") + '" title="Pick Second" data-action="showSeconds" data-time-component="seconds">20</span><span class="bdpw-clock-digit center" title="Pick Second" data-action="togglePeriod" data-time-component="period">AM</span></td>'
            },
            M = '<td><a href="#" tabindex="-1" title="Increment Hour" data-action="incrementHours"><span class="bdpw-timepicker-btn ' + c.icons.up + '"></span></a></td>',
            S = '<td><a href="#" tabindex="-1" title="Decrement Hour" data-action="decrementHours"><span class="bdpw-timepicker-btn ' + c.icons.down + '"></span></a></td>',
            P = '<td><a href="#" tabindex="-1" title="Increment Minute" data-action="incrementMinutes"><span class="bdpw-timepicker-btn ' + c.icons.up + '"></span></a></td>',
            O = '<td><a href="#" tabindex="-1" title="Decrement Minute" data-action="decrementMinutes"><span class="bdpw-timepicker-btn ' + c.icons.down + '"></span></a></td>',
            E = '<td><a href="#" tabindex="-1" title="Increment Second" data-action="incrementSeconds"><span class="bdpw-timepicker-btn ' + c.icons.up + '"></span></a></td>',
            H = '<td><a href="#" tabindex="-1" title="Decrement Second" data-action="decrementSeconds"><span class="bdpw-timepicker-btn ' + c.icons.down + '"></span></a></td>',
            I = function (e, t) {
                if (h) {
                    var n = e.hour(), a = 12 == n ? 12 : n + 12;
                    return "<td>" + ('<span class="bdpw-clock-digit am-digit ' + (t || "") + (R(e, "h") ? "" : " disabled") + '" title="Select Hour" data-action="selectHour">' + n + "</span>") + (a = '<span class="bdpw-clock-digit pm-digit ' + (t || "") + (R(e.hour(a), "h") ? "" : " disabled") + '" title="Select Hour" data-action="selectHour">' + a + "</span>") + "</td>"
                }
                return '<td><span class="bdpw-clock-digit ' + (t || "") + (R(e, "h") ? "" : " disabled") + '" title="Select Hour" data-action="selectHour">' + e.format("h") + "</span></td>"
            }, Y = function (e, t) {
                return '<td><span class="bdpw-clock-digit ' + (t || "") + (R(e, "m") ? "" : " disabled") + '" title="Select Minute" data-action="selectMinute">' + e.minute() + "</span></td>"
            }, q = function (e, t) {
                return '<td><span class="bdpw-clock-digit ' + (t || "") + (R(e, "s") ? "" : " disabled") + '" title="Select Second" data-action="selectSecond">' + e.second() + "</span></td>"
            }, B = function () {
                return void 0 !== le.tz && void 0 !== c.timeZone && null !== c.timeZone && "" !== c.timeZone
            }, j = function (e) {
                var t;
                return t = null == e ? le() : le.isDate(e) || le.isMoment(e) ? le(e) : B() ? le.tz(e, r, c.useStrict, c.timeZone) : le(e, r, c.useStrict), B() && t.tz(c.timeZone), t
            }, A = function (e) {
                if ("string" != typeof e || 1 < e.length) throw new TypeError("isEnabled expects a single character string parameter");
                switch (e) {
                    case"y":
                        return -1 !== a.indexOf("Y");
                    case"M":
                        return -1 !== a.indexOf("M");
                    case"d":
                        return -1 !== a.toLowerCase().indexOf("d");
                    case"h":
                    case"H":
                        return -1 !== a.toLowerCase().indexOf("h");
                    case"m":
                        return -1 !== a.indexOf("m");
                    case"s":
                        return -1 !== a.indexOf("s");
                    default:
                        return !1
                }
            }, F = function () {
                return A("h") || A("m") || A("s")
            }, L = function () {
                return A("y") || A("M") || A("d")
            }, W = function () {
                var e, t, n, a, r = de("<div>").addClass("bootstrap-datetimepicker-widget dropdown-menu"),
                    i = de("<div>").addClass("datepicker").append((n = de("<thead>").append(de("<tr>").append(de("<th>").addClass("prev").attr("data-action", "previous").append(de("<span>").addClass(c.icons.previous))).append(de("<th>").addClass("picker-switch").attr("data-action", "pickerSwitch").attr("colspan", c.calendarWeeks ? "6" : "5")).append(de("<th>").addClass("next").attr("data-action", "next").append(de("<span>").addClass(c.icons.next)))), a = de("<tbody>").append(de("<tr>").append(de("<td>").attr("colspan", c.calendarWeeks ? "8" : "7"))), [de("<div>").addClass("datepicker-days").append(de("<table>").addClass("table-condensed").append(n).append(de("<tbody>"))), de("<div>").addClass("datepicker-months").append(de("<table>").addClass("table-condensed").append(n.clone()).append(a.clone())), de("<div>").addClass("datepicker-years").append(de("<table>").addClass("table-condensed").append(n.clone()).append(a.clone())), de("<div>").addClass("datepicker-decades").append(de("<table>").addClass("table-condensed").append(n.clone()).append(a.clone()))])),
                    o = de("<div>").addClass("timepicker").append((t = [], A("h") && t.push(de("<div>").addClass("timepicker-hours").append(de("<table>").append("<tbody>").addClass("table-condensed"))), A("m") && t.push(de("<div>").addClass("timepicker-minutes").append(de("<table>").append("<tbody>").addClass("table-condensed"))), A("s") && t.push(de("<div>").addClass("timepicker-seconds").append(de("<table>").append("<tbody>").addClass("table-condensed"))), t)),
                    s = de("<ul>").addClass("list-unstyled"),
                    d = de("<li>").addClass("picker-switch" + (c.collapse ? " accordion-toggle" : "")).append((e = [], c.showTodayButton && e.push(de("<td>").append(de("<a>").attr({
                        href: "#",
                        "data-action": "today",
                        title: c.tooltips.today
                    }).append(de("<span>").addClass(c.icons.today)))), !c.sideBySide && L() && F() && e.push(de("<td>").append(de("<a>").attr({
                        href: "#",
                        "data-action": "togglePicker",
                        title: c.tooltips.selectTime
                    }).append(de("<span>").addClass(c.icons.time)))), c.showClear && e.push(de("<td>").append(de("<a>").attr({
                        href: "#",
                        "data-action": "clear",
                        title: c.tooltips.clear
                    }).append(de("<span>").addClass(c.icons.clear)))), c.showClose && e.push(de("<td>").append(de("<a>").attr({
                        href: "#",
                        "data-action": "close",
                        title: c.tooltips.close
                    }).append(de("<span>").addClass(c.icons.close)))), de("<table>").addClass("table-condensed").append(de("<tbody>").append(de("<tr>").append(e)))));
                return c.inline && r.removeClass("dropdown-menu"), h && r.addClass("usetwentyfour"), A("s") && !h && r.addClass("wider"), c.sideBySide && L() && F() ? (r.addClass("timepicker-sbs"), "top" === c.toolbarPlacement && r.append(d), r.append(de("<div>").addClass("row").append(i.addClass("col-md-6")).append(o.addClass("col-md-6"))), "bottom" === c.toolbarPlacement && r.append(d), r) : ("top" === c.toolbarPlacement && s.append(d), L() && s.append(de("<li>").addClass(c.collapse && F() ? "collapse in show" : "").append(i)), "default" === c.toolbarPlacement && s.append(d), F() && s.append(de("<li>").addClass(c.collapse && L() ? "collapse" : "").append(o)), "bottom" === c.toolbarPlacement && s.append(d), s.find(".collapse").on("show.bs.collapse", function (e) {
                    de(e.target).addClass("in show")
                }).on("hidden.bs.collapse", function (e) {
                    de(e.target).removeClass("in show")
                }), r.append(s))
            }, z = function () {
                var e, t = (m || i).position(), n = (m || i).offset(), a = c.widgetPositioning.vertical,
                    r = c.widgetPositioning.horizontal;
                if (c.widgetParent) e = c.widgetParent.append(y); else if (i.is("input")) e = i.after(y).parent(); else {
                    if (c.inline) return void (e = i.append(y));
                    (e = i).children().first().after(y)
                }
                if ("auto" === a && (a = n.top + 1.5 * y.height() >= de(window).height() + de(window).scrollTop() && y.height() + i.outerHeight() < n.top ? "top" : "bottom"), "auto" === r && (r = e.width() < n.left + y.outerWidth() / 2 && n.left + y.outerWidth() > de(window).width() ? "right" : "left"), "top" === a ? y.addClass("top").removeClass("bottom") : y.addClass("bottom").removeClass("top"), "right" === r ? y.addClass("pull-right") : y.removeClass("pull-right"), "static" === e.css("position") && (e = e.parents().filter(function () {
                    return "static" !== de(this).css("position")
                }).first()), 0 === e.length) throw new Error("datetimepicker component should be placed within a non-static positioned container");
                y.css({
                    top: "top" === a ? "auto" : t.top + i.outerHeight(),
                    bottom: "top" === a ? e.outerHeight() - (e === i ? 0 : t.top) : "auto",
                    left: "left" === r ? e === i ? 0 : t.left : "auto",
                    right: "left" === r ? "auto" : e.outerWidth() - i.outerWidth() - (e === i ? 0 : t.left)
                })
            }, N = function (e) {
                "dp.change" === e.type && (e.date && e.date.isSame(e.oldDate) || !e.date && !e.oldDate) || i.trigger(e)
            }, V = function (e) {
                "y" === e && (e = "YYYY"), N({type: "dp.update", change: e, viewDate: f.clone()})
            }, Z = function (e) {
                y && (e && (o = Math.max(b, Math.min(3, o + e))), y.find(".datepicker > div").hide().filter(".datepicker-" + t[o].clsName).show())
            }, R = function (e, t) {
                if (!e.isValid()) return !1;
                if (c.disabledDates && "d" === t && (n = e, !0 === c.disabledDates[n.format("YYYY-MM-DD")])) return !1;
                var n, a, r, i;
                if (c.enabledDates && "d" === t && (a = e, !0 !== c.enabledDates[a.format("YYYY-MM-DD")])) return !1;
                if (c.minDate && e.isBefore(c.minDate, t)) return !1;
                if (c.maxDate && e.isAfter(c.maxDate, t)) return !1;
                if (c.daysOfWeekDisabled && "d" === t && -1 !== c.daysOfWeekDisabled.indexOf(e.day())) return !1;
                if (c.disabledHours && ("h" === t || "m" === t || "s" === t) && (r = e, !0 === c.disabledHours[r.format("H")])) return !1;
                if (c.enabledHours && ("h" === t || "m" === t || "s" === t) && (i = e, !0 !== c.enabledHours[i.format("H")])) return !1;
                if (c.disabledTimeIntervals && ("h" === t || "m" === t || "s" === t)) {
                    var o = !1;
                    if (de.each(c.disabledTimeIntervals, function () {
                        if (e.isBetween(this[0], this[1])) return !(o = !0)
                    }), o) return !1
                }
                return !0
            }, Q = function () {
                var e, t, n, a = y.find(".datepicker-days"), r = a.find("th"), i = [], o = [];
                if (L()) {
                    for (r.eq(0).find("span").attr("title", c.tooltips.prevMonth), r.eq(1).attr("title", c.tooltips.selectMonth), r.eq(2).find("span").attr("title", c.tooltips.nextMonth), a.find(".disabled").removeClass("disabled"), r.eq(1).text(f.format(c.dayViewHeaderFormat)), R(f.clone().subtract(1, "M"), "M") || r.eq(0).addClass("disabled"), R(f.clone().add(1, "M"), "M") || r.eq(2).addClass("disabled"), e = f.clone().startOf("M").startOf("w").startOf("d"), n = 0; n < 42; n++) 0 === e.weekday() && (t = de("<tr>"), c.calendarWeeks && t.append('<td class="cw">' + e.week() + "</td>"), i.push(t)), o = ["day"], e.isBefore(f, "M") && o.push("old"), e.isAfter(f, "M") && o.push("new"), e.isSame(u, "d") && !p && o.push("active"), R(e, "d") || o.push("disabled"), e.isSame(j(), "d") && o.push("today"), 0 !== e.day() && 6 !== e.day() || o.push("weekend"), N({
                        type: "dp.classify",
                        date: e,
                        classNames: o
                    }), t.append('<td data-action="selectDay" data-day="' + e.format("L") + '" class="' + o.join(" ") + '">' + e.date() + "</td>"), e.add(1, "d");
                    var s, d, l;
                    a.find("tbody").empty().append(i), s = y.find(".datepicker-months"), d = s.find("th"), l = s.find("tbody").find("span"), d.eq(0).find("span").attr("title", c.tooltips.prevYear), d.eq(1).attr("title", c.tooltips.selectYear), d.eq(2).find("span").attr("title", c.tooltips.nextYear), s.find(".disabled").removeClass("disabled"), R(f.clone().subtract(1, "y"), "y") || d.eq(0).addClass("disabled"), d.eq(1).text(f.year()), R(f.clone().add(1, "y"), "y") || d.eq(2).addClass("disabled"), l.removeClass("active"), u.isSame(f, "y") && !p && l.eq(u.month()).addClass("active"), l.each(function (e) {
                        R(f.clone().month(e), "M") || de(this).addClass("disabled")
                    }), function () {
                        var e = y.find(".datepicker-years"), t = e.find("th"), n = f.clone().subtract(5, "y"),
                            a = f.clone().add(6, "y"), r = "";
                        for (t.eq(0).find("span").attr("title", c.tooltips.prevDecade), t.eq(1).attr("title", c.tooltips.selectDecade), t.eq(2).find("span").attr("title", c.tooltips.nextDecade), e.find(".disabled").removeClass("disabled"), c.minDate && c.minDate.isAfter(n, "y") && t.eq(0).addClass("disabled"), t.eq(1).text(n.year() + "-" + a.year()), c.maxDate && c.maxDate.isBefore(a, "y") && t.eq(2).addClass("disabled"); !n.isAfter(a, "y");) r += '<span data-action="selectYear" class="year' + (n.isSame(u, "y") && !p ? " active" : "") + (R(n, "y") ? "" : " disabled") + '">' + n.year() + "</span>", n.add(1, "y");
                        e.find("td").html(r)
                    }(), function () {
                        var e, t = y.find(".datepicker-decades"), n = t.find("th"),
                            a = le({y: f.year() - f.year() % 100 - 1}), r = a.clone().add(100, "y"), i = a.clone(), o = !1,
                            s = !1, d = "";
                        for (n.eq(0).find("span").attr("title", c.tooltips.prevCentury), n.eq(2).find("span").attr("title", c.tooltips.nextCentury), t.find(".disabled").removeClass("disabled"), (a.isSame(le({y: 1900})) || c.minDate && c.minDate.isAfter(a, "y")) && n.eq(0).addClass("disabled"), n.eq(1).text(a.year() + "-" + r.year()), (a.isSame(le({y: 2e3})) || c.maxDate && c.maxDate.isBefore(r, "y")) && n.eq(2).addClass("disabled"); !a.isAfter(r, "y");) e = a.year() + 12, o = c.minDate && c.minDate.isAfter(a, "y") && c.minDate.year() <= e, s = c.maxDate && c.maxDate.isAfter(a, "y") && c.maxDate.year() <= e, d += '<span data-action="selectDecade" class="decade' + (u.isAfter(a) && u.year() <= e ? " active" : "") + (R(a, "y") || o || s ? "" : " disabled") + '" data-selection="' + (a.year() + 6) + '">' + (a.year() + 1) + " - " + (a.year() + 12) + "</span>", a.add(12, "y");
                        d += "<span></span><span></span><span></span>", t.find("td").html(d), n.eq(1).text(i.year() + 1 + "-" + a.year())
                    }()
                }
            }, e = function () {
                var e, t, n, a, r, i, o, s, d, l, c;
                h || (e = y.find(".timepicker [data-action=togglePeriod]"), t = u.clone().add(12 <= u.hours() ? -12 : 12, "h"), R(t, "h") ? e.removeClass("disabled") : e.addClass("disabled")), n = y.find(".timepicker-hours table>tbody"), a = f.clone(), r = "", r += "<tr>" + C + I(a.hour(11)) + I(a.hour(12), "top") + I(a.hour(1)) + C + "</tr>", r += "<tr>" + I(a.hour(10)) + C + M + C + I(a.hour(2)) + "</tr>", r += "<tr>" + I(a.hour(9), "left") + T("h") + I(a.hour(3), "right") + "</tr>", r += "<tr>" + I(a.hour(8)) + C + S + C + I(a.hour(4)) + "</tr>", r += "<tr>" + C + I(a.hour(7)) + I(a.hour(6), "bottom") + I(a.hour(5)) + C + "</tr>", n.empty().html(r), i = y.find(".timepicker-minutes table>tbody"), o = f.clone(), s = "", s += "<tr>" + C + Y(o.minute(55)) + Y(o.minute(0), "top") + Y(o.minute(5)) + C + "</tr>", s += "<tr>" + Y(o.minute(50)) + C + P + C + Y(o.minute(10)) + "</tr>", s += "<tr>" + Y(o.minute(45), "left") + T("m") + Y(o.minute(15), "right") + "</tr>", s += "<tr>" + Y(o.minute(40)) + C + O + C + Y(o.minute(20)) + "</tr>", s += "<tr>" + C + Y(o.minute(35)) + Y(o.minute(30), "bottom") + Y(o.minute(25)) + C + "</tr>", i.empty().html(s), d = y.find(".timepicker-seconds table>tbody"), l = f.clone(), c = "", c += "<tr>" + C + q(l.second(55)) + q(l.second(0), "top") + q(l.second(5)) + C + "</tr>", c += "<tr>" + q(l.second(50)) + C + E + C + q(l.second(10)) + "</tr>", c += "<tr>" + q(l.second(45), "left") + T("s") + q(l.second(15), "right") + "</tr>", c += "<tr>" + q(l.second(40)) + C + H + C + q(l.second(20)) + "</tr>", c += "<tr>" + C + q(l.second(35)) + q(l.second(30), "bottom") + q(l.second(25)) + C + "</tr>", d.empty().html(c);
                var p = y.find(".timepicker span[data-time-component]");
                p.filter("[data-time-component=hours]").text(u.format(h ? "HH" : "hh")), p.filter("[data-time-component=minutes]").text(u.format("mm")), p.filter("[data-time-component=seconds]").text(u.format("ss")), p.filter("[data-time-component=period]").text(u.format("A")), "PM" == u.format("A") ? y.find(".timepicker").addClass("pm-view") : y.find(".timepicker").removeClass("pm-view")
            }, U = function () {
                y && (Q(), e())
            }, G = function (e) {
                var t = p ? null : u;
                if (!e) return p = !0, n.val(""), i.data("date", ""), N({
                    type: "dp.change",
                    date: !1,
                    oldDate: t
                }), void U();
                if (e = e.clone().locale(c.locale), B() && e.tz(c.timeZone), 1 !== c.stepping) for (e.minutes(Math.round(e.minutes() / c.stepping) * c.stepping).seconds(0); c.minDate && e.isBefore(c.minDate);) e.add(c.stepping, "minutes");
                R(e) ? (f = (u = e).clone(), n.val(u.format(a)), i.data("date", u.format(a)), p = !1, U(), N({
                    type: "dp.change",
                    date: u.clone(),
                    oldDate: t
                })) : (c.keepInvalid ? N({
                    type: "dp.change",
                    date: e,
                    oldDate: t
                }) : n.val(p ? "" : u.format(a)), N({type: "dp.error", date: e, oldDate: t}))
            }, J = function () {
                var t = !1;
                return y ? (y.find(".collapse").each(function () {
                    var e = de(this).data("collapse");
                    return !e || !e.transitioning || !(t = !0)
                }), t || (m && m.hasClass("btn") && m.toggleClass("active"), y.hide(), de(window).off("resize", z), y.off("click", "[data-action]"), y.off("mousedown", !1), y.remove(), y = !1, N({
                    type: "dp.hide",
                    date: u.clone()
                }), n.blur(), f = u.clone()), l) : l
            }, K = function () {
                G(null)
            }, X = function (e) {
                return void 0 === c.parseInputDate ? (!le.isMoment(e) || e instanceof Date) && (e = j(e)) : e = c.parseInputDate(e), e
            }, $ = {
                next: function () {
                    var e = t[o].navFnc;
                    f.add(t[o].navStep, e), Q(), V(e)
                }, previous: function () {
                    var e = t[o].navFnc;
                    f.subtract(t[o].navStep, e), Q(), V(e)
                }, pickerSwitch: function () {
                    Z(1)
                }, selectMonth: function (e) {
                    var t = de(e.target).closest("tbody").find("span").index(de(e.target));
                    f.month(t), o === b ? (G(u.clone().year(f.year()).month(f.month())), c.inline || J()) : (Z(-1), Q()), V("M")
                }, selectYear: function (e) {
                    var t = parseInt(de(e.target).text(), 10) || 0;
                    f.year(t), o === b ? (G(u.clone().year(f.year())), c.inline || J()) : (Z(-1), Q()), V("YYYY")
                }, selectDecade: function (e) {
                    var t = parseInt(de(e.target).data("selection"), 10) || 0;
                    f.year(t), o === b ? (G(u.clone().year(f.year())), c.inline || J()) : (Z(-1), Q()), V("YYYY")
                }, selectDay: function (e) {
                    var t = f.clone();
                    de(e.target).is(".old") && t.subtract(1, "M"), de(e.target).is(".new") && t.add(1, "M"), G(t.date(parseInt(de(e.target).text(), 10))), F() || c.keepOpen || c.inline || J()
                }, incrementHours: function () {
                    var e = u.clone().add(1, "h");
                    R(e, "h") && G(e)
                }, incrementMinutes: function () {
                    var e = u.clone().add(c.stepping, "m");
                    R(e, "m") && G(e)
                }, incrementSeconds: function () {
                    var e = u.clone().add(1, "s");
                    R(e, "s") && G(e)
                }, decrementHours: function () {
                    var e = u.clone().subtract(1, "h");
                    R(e, "h") && G(e)
                }, decrementMinutes: function () {
                    var e = u.clone().subtract(c.stepping, "m");
                    R(e, "m") && G(e)
                }, decrementSeconds: function () {
                    var e = u.clone().subtract(1, "s");
                    R(e, "s") && G(e)
                }, togglePeriod: function () {
                    G(u.clone().add(12 <= u.hours() ? -12 : 12, "h"))
                }, togglePicker: function (e) {
                    var t, n = de(e.target), a = n.closest("ul"), r = a.find(".collapse.in"),
                        i = a.find(".collapse:not(.in)");
                    if (r && r.length) {
                        if ((t = r.data("collapse")) && t.transitioning) return;
                        r.collapse ? (r.collapse("hide"), i.collapse("show")) : (r.removeClass("in show"), i.addClass("in show")), n.is("span") ? n.toggleClass(c.icons.time + " " + c.icons.date) : n.find("span").toggleClass(c.icons.time + " " + c.icons.date)
                    }
                }, showPicker: function () {
                    y.find(".timepicker > div:not(.timepicker-picker)").hide(), y.find(".timepicker .timepicker-picker").show()
                }, showHours: function () {
                    y.find(".timepicker > div:not(.timepicker-hours)").hide(), y.find(".timepicker .timepicker-hours").show()
                }, showMinutes: function () {
                    y.find(".timepicker > div:not(.timepicker-minutes)").hide(), y.find(".timepicker .timepicker-minutes").show()
                }, showSeconds: function () {
                    y.find(".timepicker > div:not(.timepicker-seconds)").hide(), y.find(".timepicker .timepicker-seconds").show()
                }, selectHour: function (e) {
                    var t = parseInt(de(e.target).text(), 10);
                    h || (12 <= u.hours() ? 12 !== t && (t += 12) : 12 === t && (t = 0)), G(u.clone().hours(t)), $.showMinutes.call(l)
                }, selectMinute: function (e) {
                    G(u.clone().minutes(parseInt(de(e.target).text(), 10))), A("s") && $.showSeconds.call(l)
                }, selectSecond: function (e) {
                    G(u.clone().seconds(parseInt(de(e.target).text(), 10)))
                }, clear: K, today: function () {
                    var e = j();
                    R(e, "d") && G(e)
                }, close: J
            }, _ = function (e) {
                return de(e.currentTarget).is(".disabled") || $[de(e.currentTarget).data("action")].apply(l, arguments), !1
            }, ee = function () {
                var e;
                return n.prop("disabled") || !c.ignoreReadonly && n.prop("readonly") || y || (void 0 !== n.val() && 0 !== n.val().trim().length ? G(X(n.val().trim())) : p && c.useCurrent && (c.inline || n.is("input") && 0 === n.val().trim().length) && (e = j(), "string" == typeof c.useCurrent && (e = {
                    year: function (e) {
                        return e.month(0).date(1).hours(0).seconds(0).minutes(0)
                    }, month: function (e) {
                        return e.date(1).hours(0).seconds(0).minutes(0)
                    }, day: function (e) {
                        return e.hours(0).seconds(0).minutes(0)
                    }, hour: function (e) {
                        return e.seconds(0).minutes(0)
                    }, minute: function (e) {
                        return e.seconds(0)
                    }
                }[c.useCurrent](e)), G(e)), y = W(), function () {
                    var e = de("<tr>"), t = f.clone().startOf("w").startOf("d");
                    for (!0 === c.calendarWeeks && e.append(de("<th>").addClass("cw").text("#")); t.isBefore(f.clone().endOf("w"));) e.append(de("<th>").addClass("dow").text(t.format("dd"))), t.add(1, "d");
                    y.find(".datepicker-days thead").append(e)
                }(), function () {
                    for (var e = [], t = f.clone().startOf("y").startOf("d"); t.isSame(f, "y");) e.push(de("<span>").attr("data-action", "selectMonth").addClass("month").text(t.format("MMM"))), t.add(1, "M");
                    y.find(".datepicker-months td").empty().append(e)
                }(), y.find(".timepicker-minutes").hide(), y.find(".timepicker-seconds").hide(), U(), Z(), de(window).on("resize", z), y.on("click", "[data-action]", _), y.on("mousedown", !1), m && m.hasClass("btn") && m.toggleClass("active"), z(), y.show(), c.focusOnShow && !n.is(":focus") && n.focus(), N({type: "dp.show"})), l
            }, te = function () {
                return y ? J() : ee()
            }, ne = function (e) {
                var t, n, a, r, i = null, o = [], s = {}, d = e.which;
                for (t in x[d] = "p", x) x.hasOwnProperty(t) && "p" === x[t] && (o.push(t), parseInt(t, 10) !== d && (s[t] = !0));
                for (t in c.keyBinds) if (c.keyBinds.hasOwnProperty(t) && "function" == typeof c.keyBinds[t] && (a = t.split(" ")).length === o.length && D[d] === a[a.length - 1]) {
                    for (r = !0, n = a.length - 2; 0 <= n; n--) if (!(D[a[n]] in s)) {
                        r = !1;
                        break
                    }
                    if (r) {
                        i = c.keyBinds[t];
                        break
                    }
                }
                i && (i.call(l, y), e.stopPropagation(), e.preventDefault())
            }, ae = function (e) {
                x[e.which] = "r", e.stopPropagation(), e.preventDefault()
            }, re = function (e) {
                var t = de(e.target).val().trim(), n = t ? X(t) : null;
                return G(n), e.stopImmediatePropagation(), !1
            }, ie = function (e) {
                var t = {};
                return de.each(e, function () {
                    var e = X(this);
                    e.isValid() && (t[e.format("YYYY-MM-DD")] = !0)
                }), !!Object.keys(t).length && t
            }, oe = function (e) {
                var t = {};
                return de.each(e, function () {
                    t[this] = !0
                }), !!Object.keys(t).length && t
            }, se = function () {
                var e = c.format || "L LT";
                a = e.replace(/(\[[^\[]*\])|(\\)?(LTS|LT|LL?L?L?|l{1,4})/g, function (e) {
                    return (u.localeData().longDateFormat(e) || e).replace(/(\[[^\[]*\])|(\\)?(LTS|LT|LL?L?L?|l{1,4})/g, function (e) {
                        return u.localeData().longDateFormat(e) || e
                    })
                }), (r = c.extraFormats ? c.extraFormats.slice() : []).indexOf(e) < 0 && r.indexOf(a) < 0 && r.push(a), h = a.toLowerCase().indexOf("a") < 1 && a.replace(/\[.*?\]/g, "").indexOf("h") < 1, A("y") && (b = 2), A("M") && (b = 1), A("d") && (b = 0), o = Math.max(b, o), p || G(u)
            };
        if (l.destroy = function () {
            J(), n.off({
                change: re,
                blur: blur,
                keydown: ne,
                keyup: ae,
                focus: c.allowInputToggle ? J : ""
            }), i.is("input") ? n.off({focus: ee}) : m && (m.off("click", te), m.off("mousedown", !1)), i.removeData("DateTimePicker"), i.removeData("date")
        }, l.toggle = te, l.show = ee, l.hide = J, l.disable = function () {
            return J(), m && m.hasClass("btn") && m.addClass("disabled"), n.prop("disabled", !0), l
        }, l.enable = function () {
            return m && m.hasClass("btn") && m.removeClass("disabled"), n.prop("disabled", !1), l
        }, l.ignoreReadonly = function (e) {
            if (0 === arguments.length) return c.ignoreReadonly;
            if ("boolean" != typeof e) throw new TypeError("ignoreReadonly () expects a boolean parameter");
            return c.ignoreReadonly = e, l
        }, l.options = function (e) {
            if (0 === arguments.length) return de.extend(!0, {}, c);
            if (!(e instanceof Object)) throw new TypeError("options() options parameter should be an object");
            return de.extend(!0, c, e), de.each(c, function (e, t) {
                if (void 0 === l[e]) throw new TypeError("option " + e + " is not recognized!");
                l[e](t)
            }), l
        }, l.date = function (e) {
            if (0 === arguments.length) return p ? null : u.clone();
            if (!(null === e || "string" == typeof e || le.isMoment(e) || e instanceof Date)) throw new TypeError("date() parameter must be one of [null, string, moment or Date]");
            return G(null === e ? null : X(e)), l
        }, l.format = function (e) {
            if (0 === arguments.length) return c.format;
            if ("string" != typeof e && ("boolean" != typeof e || !1 !== e)) throw new TypeError("format() expects a string or boolean:false parameter " + e);
            return c.format = e, a && se(), l
        }, l.timeZone = function (e) {
            if (0 === arguments.length) return c.timeZone;
            if ("string" != typeof e) throw new TypeError("newZone() expects a string parameter");
            return c.timeZone = e, l
        }, l.dayViewHeaderFormat = function (e) {
            if (0 === arguments.length) return c.dayViewHeaderFormat;
            if ("string" != typeof e) throw new TypeError("dayViewHeaderFormat() expects a string parameter");
            return c.dayViewHeaderFormat = e, l
        }, l.extraFormats = function (e) {
            if (0 === arguments.length) return c.extraFormats;
            if (!1 !== e && !(e instanceof Array)) throw new TypeError("extraFormats() expects an array or false parameter");
            return c.extraFormats = e, r && se(), l
        }, l.disabledDates = function (e) {
            if (0 === arguments.length) return c.disabledDates ? de.extend({}, c.disabledDates) : c.disabledDates;
            if (!e) return c.disabledDates = !1, U(), l;
            if (!(e instanceof Array)) throw new TypeError("disabledDates() expects an array parameter");
            return c.disabledDates = ie(e), c.enabledDates = !1, U(), l
        }, l.enabledDates = function (e) {
            if (0 === arguments.length) return c.enabledDates ? de.extend({}, c.enabledDates) : c.enabledDates;
            if (!e) return c.enabledDates = !1, U(), l;
            if (!(e instanceof Array)) throw new TypeError("enabledDates() expects an array parameter");
            return c.enabledDates = ie(e), c.disabledDates = !1, U(), l
        }, l.daysOfWeekDisabled = function (e) {
            if (0 === arguments.length) return c.daysOfWeekDisabled.splice(0);
            if ("boolean" == typeof e && !e) return c.daysOfWeekDisabled = !1, U(), l;
            if (!(e instanceof Array)) throw new TypeError("daysOfWeekDisabled() expects an array parameter");
            if (c.daysOfWeekDisabled = e.reduce(function (e, t) {
                return 6 < (t = parseInt(t, 10)) || t < 0 || isNaN(t) || -1 === e.indexOf(t) && e.push(t), e
            }, []).sort(), c.useCurrent && !c.keepInvalid) {
                for (var t = 0; !R(u, "d");) {
                    if (u.add(1, "d"), 31 === t) throw"Tried 31 times to find a valid date";
                    t++
                }
                G(u)
            }
            return U(), l
        }, l.maxDate = function (e) {
            if (0 === arguments.length) return c.maxDate ? c.maxDate.clone() : c.maxDate;
            if ("boolean" == typeof e && !1 === e) return c.maxDate = !1, U(), l;
            "string" == typeof e && ("now" !== e && "moment" !== e || (e = j()));
            var t = X(e);
            if (!t.isValid()) throw new TypeError("maxDate() Could not parse date parameter: " + e);
            if (c.minDate && t.isBefore(c.minDate)) throw new TypeError("maxDate() date parameter is before options.minDate: " + t.format(a));
            return c.maxDate = t, c.useCurrent && !c.keepInvalid && u.isAfter(e) && G(c.maxDate), f.isAfter(t) && (f = t.clone().subtract(c.stepping, "m")), U(), l
        }, l.minDate = function (e) {
            if (0 === arguments.length) return c.minDate ? c.minDate.clone() : c.minDate;
            if ("boolean" == typeof e && !1 === e) return c.minDate = !1, U(), l;
            "string" == typeof e && ("now" !== e && "moment" !== e || (e = j()));
            var t = X(e);
            if (!t.isValid()) throw new TypeError("minDate() Could not parse date parameter: " + e);
            if (c.maxDate && t.isAfter(c.maxDate)) throw new TypeError("minDate() date parameter is after options.maxDate: " + t.format(a));
            return c.minDate = t, c.useCurrent && !c.keepInvalid && u.isBefore(e) && G(c.minDate), f.isBefore(t) && (f = t.clone().add(c.stepping, "m")), U(), l
        }, l.defaultDate = function (e) {
            if (0 === arguments.length) return c.defaultDate ? c.defaultDate.clone() : c.defaultDate;
            if (!e) return c.defaultDate = !1, l;
            "string" == typeof e && (e = "now" === e || "moment" === e ? j() : j(e));
            var t = X(e);
            if (!t.isValid()) throw new TypeError("defaultDate() Could not parse date parameter: " + e);
            if (!R(t)) throw new TypeError("defaultDate() date passed is invalid according to component setup validations");
            return c.defaultDate = t, (c.defaultDate && c.inline || "" === n.val().trim()) && G(c.defaultDate), l
        }, l.locale = function (e) {
            if (0 === arguments.length) return c.locale;
            if (!le.localeData(e)) throw new TypeError("locale() locale " + e + " is not loaded from moment locales!");
            return c.locale = e, u.locale(c.locale), f.locale(c.locale), a && se(), y && (J(), ee()), l
        }, l.stepping = function (e) {
            return 0 === arguments.length ? c.stepping : (e = parseInt(e, 10), (isNaN(e) || e < 1) && (e = 1), c.stepping = e, l)
        }, l.useCurrent = function (e) {
            var t = ["year", "month", "day", "hour", "minute"];
            if (0 === arguments.length) return c.useCurrent;
            if ("boolean" != typeof e && "string" != typeof e) throw new TypeError("useCurrent() expects a boolean or string parameter");
            if ("string" == typeof e && -1 === t.indexOf(e.toLowerCase())) throw new TypeError("useCurrent() expects a string parameter of " + t.join(", "));
            return c.useCurrent = e, l
        }, l.collapse = function (e) {
            if (0 === arguments.length) return c.collapse;
            if ("boolean" != typeof e) throw new TypeError("collapse() expects a boolean parameter");
            return c.collapse === e || (c.collapse = e, y && (J(), ee())), l
        }, l.icons = function (e) {
            if (0 === arguments.length) return de.extend({}, c.icons);
            if (!(e instanceof Object)) throw new TypeError("icons() expects parameter to be an Object");
            return de.extend(c.icons, e), y && (J(), ee()), l
        }, l.tooltips = function (e) {
            if (0 === arguments.length) return de.extend({}, c.tooltips);
            if (!(e instanceof Object)) throw new TypeError("tooltips() expects parameter to be an Object");
            return de.extend(c.tooltips, e), y && (J(), ee()), l
        }, l.useStrict = function (e) {
            if (0 === arguments.length) return c.useStrict;
            if ("boolean" != typeof e) throw new TypeError("useStrict() expects a boolean parameter");
            return c.useStrict = e, l
        }, l.sideBySide = function (e) {
            if (0 === arguments.length) return c.sideBySide;
            if ("boolean" != typeof e) throw new TypeError("sideBySide() expects a boolean parameter");
            return c.sideBySide = e, y && (J(), ee()), l
        }, l.viewMode = function (e) {
            if (0 === arguments.length) return c.viewMode;
            if ("string" != typeof e) throw new TypeError("viewMode() expects a string parameter");
            if (-1 === w.indexOf(e)) throw new TypeError("viewMode() parameter must be one of (" + w.join(", ") + ") value");
            return c.viewMode = e, o = Math.max(w.indexOf(e), b), Z(), l
        }, l.toolbarPlacement = function (e) {
            if (0 === arguments.length) return c.toolbarPlacement;
            if ("string" != typeof e) throw new TypeError("toolbarPlacement() expects a string parameter");
            if (-1 === k.indexOf(e)) throw new TypeError("toolbarPlacement() parameter must be one of (" + k.join(", ") + ") value");
            return c.toolbarPlacement = e, y && (J(), ee()), l
        }, l.widgetPositioning = function (e) {
            if (0 === arguments.length) return de.extend({}, c.widgetPositioning);
            if ("[object Object]" !== {}.toString.call(e)) throw new TypeError("widgetPositioning() expects an object variable");
            if (e.horizontal) {
                if ("string" != typeof e.horizontal) throw new TypeError("widgetPositioning() horizontal variable must be a string");
                if (e.horizontal = e.horizontal.toLowerCase(), -1 === v.indexOf(e.horizontal)) throw new TypeError("widgetPositioning() expects horizontal parameter to be one of (" + v.join(", ") + ")");
                c.widgetPositioning.horizontal = e.horizontal
            }
            if (e.vertical) {
                if ("string" != typeof e.vertical) throw new TypeError("widgetPositioning() vertical variable must be a string");
                if (e.vertical = e.vertical.toLowerCase(), -1 === g.indexOf(e.vertical)) throw new TypeError("widgetPositioning() expects vertical parameter to be one of (" + g.join(", ") + ")");
                c.widgetPositioning.vertical = e.vertical
            }
            return U(), l
        }, l.calendarWeeks = function (e) {
            if (0 === arguments.length) return c.calendarWeeks;
            if ("boolean" != typeof e) throw new TypeError("calendarWeeks() expects parameter to be a boolean value");
            return c.calendarWeeks = e, U(), l
        }, l.showTodayButton = function (e) {
            if (0 === arguments.length) return c.showTodayButton;
            if ("boolean" != typeof e) throw new TypeError("showTodayButton() expects a boolean parameter");
            return c.showTodayButton = e, y && (J(), ee()), l
        }, l.showClear = function (e) {
            if (0 === arguments.length) return c.showClear;
            if ("boolean" != typeof e) throw new TypeError("showClear() expects a boolean parameter");
            return c.showClear = e, y && (J(), ee()), l
        }, l.widgetParent = function (e) {
            if (0 === arguments.length) return c.widgetParent;
            if ("string" == typeof e && (e = de(e)), null !== e && "string" != typeof e && !(e instanceof de)) throw new TypeError("widgetParent() expects a string or a jQuery object parameter");
            return c.widgetParent = e, y && (J(), ee()), l
        }, l.keepOpen = function (e) {
            if (0 === arguments.length) return c.keepOpen;
            if ("boolean" != typeof e) throw new TypeError("keepOpen() expects a boolean parameter");
            return c.keepOpen = e, l
        }, l.focusOnShow = function (e) {
            if (0 === arguments.length) return c.focusOnShow;
            if ("boolean" != typeof e) throw new TypeError("focusOnShow() expects a boolean parameter");
            return c.focusOnShow = e, l
        }, l.inline = function (e) {
            if (0 === arguments.length) return c.inline;
            if ("boolean" != typeof e) throw new TypeError("inline() expects a boolean parameter");
            return c.inline = e, l
        }, l.clear = function () {
            return K(), l
        }, l.keyBinds = function (e) {
            return 0 === arguments.length ? c.keyBinds : (c.keyBinds = e, l)
        }, l.getMoment = function (e) {
            return j(e)
        }, l.debug = function (e) {
            if ("boolean" != typeof e) throw new TypeError("debug() expects a boolean parameter");
            return c.debug = e, l
        }, l.allowInputToggle = function (e) {
            if (0 === arguments.length) return c.allowInputToggle;
            if ("boolean" != typeof e) throw new TypeError("allowInputToggle() expects a boolean parameter");
            return c.allowInputToggle = e, l
        }, l.showClose = function (e) {
            if (0 === arguments.length) return c.showClose;
            if ("boolean" != typeof e) throw new TypeError("showClose() expects a boolean parameter");
            return c.showClose = e, l
        }, l.keepInvalid = function (e) {
            if (0 === arguments.length) return c.keepInvalid;
            if ("boolean" != typeof e) throw new TypeError("keepInvalid() expects a boolean parameter");
            return c.keepInvalid = e, l
        }, l.datepickerInput = function (e) {
            if (0 === arguments.length) return c.datepickerInput;
            if ("string" != typeof e) throw new TypeError("datepickerInput() expects a string parameter");
            return c.datepickerInput = e, l
        }, l.parseInputDate = function (e) {
            if (0 === arguments.length) return c.parseInputDate;
            if ("function" != typeof e) throw new TypeError("parseInputDate() sholud be as function");
            return c.parseInputDate = e, l
        }, l.disabledTimeIntervals = function (e) {
            if (0 === arguments.length) return c.disabledTimeIntervals ? de.extend({}, c.disabledTimeIntervals) : c.disabledTimeIntervals;
            if (!e) return c.disabledTimeIntervals = !1, U(), l;
            if (!(e instanceof Array)) throw new TypeError("disabledTimeIntervals() expects an array parameter");
            return c.disabledTimeIntervals = e, U(), l
        }, l.disabledHours = function (e) {
            if (0 === arguments.length) return c.disabledHours ? de.extend({}, c.disabledHours) : c.disabledHours;
            if (!e) return c.disabledHours = !1, U(), l;
            if (!(e instanceof Array)) throw new TypeError("disabledHours() expects an array parameter");
            if (c.disabledHours = oe(e), c.enabledHours = !1, c.useCurrent && !c.keepInvalid) {
                for (var t = 0; !R(u, "h");) {
                    if (u.add(1, "h"), 24 === t) throw"Tried 24 times to find a valid date";
                    t++
                }
                G(u)
            }
            return U(), l
        }, l.enabledHours = function (e) {
            if (0 === arguments.length) return c.enabledHours ? de.extend({}, c.enabledHours) : c.enabledHours;
            if (!e) return c.enabledHours = !1, U(), l;
            if (!(e instanceof Array)) throw new TypeError("enabledHours() expects an array parameter");
            if (c.enabledHours = oe(e), c.disabledHours = !1, c.useCurrent && !c.keepInvalid) {
                for (var t = 0; !R(u, "h");) {
                    if (u.add(1, "h"), 24 === t) throw"Tried 24 times to find a valid date";
                    t++
                }
                G(u)
            }
            return U(), l
        }, l.viewDate = function (e) {
            if (0 === arguments.length) return f.clone();
            if (!e) return f = u.clone(), l;
            if (!("string" == typeof e || le.isMoment(e) || e instanceof Date)) throw new TypeError("viewDate() parameter must be one of [string, moment or Date]");
            return f = X(e), V(), l
        }, i.is("input")) n = i; else if (0 === (n = i.find(c.datepickerInput)).length) n = i.find("input"); else if (!n.is("input")) throw new Error('CSS class "' + c.datepickerInput + '" cannot be applied to non input element');
        if (i.hasClass("input-group") && (m = 0 === i.find(".datepickerbutton").length ? i.find(".input-group-addon") : i.find(".datepickerbutton")), !c.inline && !n.is("input")) throw new Error("Could not initialize DateTimePicker without an input element");
        return u = j(), f = u.clone(), de.extend(!0, c, (d = {}, (s = i.is("input") || c.inline ? i.data() : i.find("input").data()).dateOptions && s.dateOptions instanceof Object && (d = de.extend(!0, d, s.dateOptions)), de.each(c, function (e) {
            var t = "date" + e.charAt(0).toUpperCase() + e.slice(1);
            void 0 !== s[t] && (d[e] = s[t])
        }), d)), l.options(c), se(), n.on({
            change: re,
            blur: c.debug ? "" : J,
            keydown: ne,
            keyup: ae,
            focus: c.allowInputToggle ? ee : ""
        }), i.is("input") ? n.on({focus: ee}) : m && (m.on("click", te), m.on("mousedown", !1)), n.prop("disabled") && l.disable(), n.is("input") && 0 !== n.val().trim().length ? G(X(n.val().trim())) : c.defaultDate && void 0 === n.attr("placeholder") && G(c.defaultDate), c.inline && ee(), l
    };
    return de.fn.datetimepicker = function (n) {
        n = n || {};
        var t, a = Array.prototype.slice.call(arguments, 1), r = !0;
        if ("object" == typeof n) return this.each(function () {
            var e, t = de(this);
            t.data("DateTimePicker") || (e = de.extend(!0, {}, de.fn.datetimepicker.defaults, n), t.data("DateTimePicker", i(t, e)))
        });
        if ("string" == typeof n) return this.each(function () {
            var e = de(this).data("DateTimePicker");
            if (!e) throw new Error('bootstrap-datetimepicker("' + n + '") method was called on an element that is not using DateTimePicker');
            t = e[n].apply(e, a), r = t === e
        }), r || -1 < de.inArray(n, ["destroy", "hide", "show", "toggle"]) ? this : t;
        throw new TypeError("Invalid arguments for DateTimePicker: " + n)
    }, de.fn.datetimepicker.defaults = {
        timeZone: "",
        format: !1,
        dayViewHeaderFormat: "MMMM YYYY",
        extraFormats: !1,
        stepping: 1,
        minDate: !1,
        maxDate: !1,
        useCurrent: !0,
        collapse: !0,
        locale: le.locale(),
        defaultDate: !1,
        disabledDates: !1,
        enabledDates: !1,
        icons: {
            time: "glyphicon glyphicon-time fa fa-clock-o",
            date: "glyphicon glyphicon-calendar fa fa-calendar",
            up: "glyphicon glyphicon-chevron-up fa fa-chevron-up",
            down: "glyphicon glyphicon-chevron-down fa fa-chevron-down",
            previous: "glyphicon glyphicon-chevron-left fa fa-chevron-left",
            next: "glyphicon glyphicon-chevron-right fa fa-chevron-right",
            today: "glyphicon glyphicon-screenshot fa fa-calendar-check-o",
            clear: "glyphicon glyphicon-trash fa fa-trash",
            close: "glyphicon glyphicon-remove fa fa-times"
        },
        tooltips: {
            today: "Go to today",
            clear: "Clear selection",
            close: "Close the picker",
            selectMonth: "Select Month",
            prevMonth: "Previous Month",
            nextMonth: "Next Month",
            selectYear: "Select Year",
            prevYear: "Previous Year",
            nextYear: "Next Year",
            selectDecade: "Select Decade",
            prevDecade: "Previous Decade",
            nextDecade: "Next Decade",
            prevCentury: "Previous Century",
            nextCentury: "Next Century",
            pickHour: "Pick Hour",
            incrementHour: "Increment Hour",
            decrementHour: "Decrement Hour",
            pickMinute: "Pick Minute",
            incrementMinute: "Increment Minute",
            decrementMinute: "Decrement Minute",
            pickSecond: "Pick Second",
            incrementSecond: "Increment Second",
            decrementSecond: "Decrement Second",
            togglePeriod: "Toggle Period",
            selectTime: "Select Time"
        },
        useStrict: !1,
        sideBySide: !1,
        daysOfWeekDisabled: !1,
        calendarWeeks: !1,
        viewMode: "days",
        toolbarPlacement: "default",
        showTodayButton: !1,
        showClear: !1,
        showClose: !1,
        widgetPositioning: {horizontal: "auto", vertical: "auto"},
        widgetParent: null,
        ignoreReadonly: !1,
        keepOpen: !1,
        focusOnShow: !0,
        inline: !1,
        keepInvalid: !1,
        datepickerInput: ".datepickerinput",
        keyBinds: {
            up: function (e) {
                if (e) {
                    var t = this.date() || this.getMoment();
                    e.find(".datepicker").is(":visible") ? this.date(t.clone().subtract(7, "d")) : this.date(t.clone().add(this.stepping(), "m"))
                }
            }, down: function (e) {
                if (e) {
                    var t = this.date() || this.getMoment();
                    e.find(".datepicker").is(":visible") ? this.date(t.clone().add(7, "d")) : this.date(t.clone().subtract(this.stepping(), "m"))
                } else this.show()
            }, "control up": function (e) {
                if (e) {
                    var t = this.date() || this.getMoment();
                    e.find(".datepicker").is(":visible") ? this.date(t.clone().subtract(1, "y")) : this.date(t.clone().add(1, "h"))
                }
            }, "control down": function (e) {
                if (e) {
                    var t = this.date() || this.getMoment();
                    e.find(".datepicker").is(":visible") ? this.date(t.clone().add(1, "y")) : this.date(t.clone().subtract(1, "h"))
                }
            }, left: function (e) {
                if (e) {
                    var t = this.date() || this.getMoment();
                    e.find(".datepicker").is(":visible") && this.date(t.clone().subtract(1, "d"))
                }
            }, right: function (e) {
                if (e) {
                    var t = this.date() || this.getMoment();
                    e.find(".datepicker").is(":visible") && this.date(t.clone().add(1, "d"))
                }
            }, pageUp: function (e) {
                if (e) {
                    var t = this.date() || this.getMoment();
                    e.find(".datepicker").is(":visible") && this.date(t.clone().subtract(1, "M"))
                }
            }, pageDown: function (e) {
                if (e) {
                    var t = this.date() || this.getMoment();
                    e.find(".datepicker").is(":visible") && this.date(t.clone().add(1, "M"))
                }
            }, enter: function () {
                this.hide()
            }, escape: function () {
                this.hide()
            }, "control space": function (e) {
                e && e.find(".timepicker").is(":visible") && e.find('.btn[data-action="togglePeriod"]').click()
            }, t: function () {
                this.date(this.getMoment())
            }, delete: function () {
                this.clear()
            }
        },
        debug: !1,
        allowInputToggle: !1,
        disabledTimeIntervals: !1,
        disabledHours: !1,
        enabledHours: !1,
        viewDate: !1
    }, de.fn.datetimepicker
});