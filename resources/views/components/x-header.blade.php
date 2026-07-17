<!DOCTYPE html>
<html lang="es">

<head itemscope itemtype="https://schema.org/WebSite">
    <meta charset="UTF-8" />
    <script>
        if (navigator.userAgent.match(/MSIE|Internet Explorer/i) || navigator.userAgent.match(
            /Trident\/7\..*?rv:11/i)) {
            var href = document.location.href;
            if (!href.match(/[?&]nowprocket/)) {
                if (href.indexOf("?") == -1) {
                    if (href.indexOf("#") == -1) {
                        document.location.href = href + "?nowprocket=1"
                    } else {
                        document.location.href = href.replace("#", "?nowprocket=1#")
                    }
                } else {
                    if (href.indexOf("#") == -1) {
                        document.location.href = href + "&nowprocket=1"
                    } else {
                        document.location.href = href.replace("#", "&nowprocket=1#")
                    }
                }
            }
        }
    </script>
    <script>
        (() => {
            class RocketLazyLoadScripts {
                constructor() {
                    this.v = "2.0.5", this.userEvents = ["keydown", "keyup", "mousedown", "mouseup",
                        "mousemove", "mouseover", "mouseout", "touchmove", "touchstart", "touchend",
                        "touchcancel", "wheel", "click", "dblclick", "input"
                    ], this.attributeEvents = ["onblur", "onclick", "oncontextmenu", "ondblclick",
                        "onfocus", "onmousedown", "onmouseenter", "onmouseleave", "onmousemove",
                        "onmouseout", "onmouseover", "onmouseup", "onmousewheel", "onscroll", "onsubmit"
                    ]
                }
                async t() {
                    this.i(), this.o(), /iP(ad|hone)/.test(navigator.userAgent) && this.h(), this.u(), this.l(
                            this), this.m(), this.k(this), this.p(this), this._(), await Promise.all([this.R(),
                            this.L()
                        ]), this.lastBreath = Date.now(), this.S(this), this.P(), this.D(), this.O(), this.M(),
                        await this.C(this.delayedScripts.normal), await this.C(this.delayedScripts.defer),
                        await this.C(this.delayedScripts.async), await this.T(), await this.F(), await this.j(),
                        await this.A(), window.dispatchEvent(new Event("rocket-allScriptsLoaded")), this
                        .everythingLoaded = !0, this.lastTouchEnd && await new Promise(t => setTimeout(t, 500 -
                            Date.now() + this.lastTouchEnd)), this.I(), this.H(), this.U(), this.W()
                }
                i() {
                    this.CSPIssue = sessionStorage.getItem("rocketCSPIssue"), document.addEventListener(
                        "securitypolicyviolation", t => {
                            this.CSPIssue || "script-src-elem" !== t.violatedDirective || "data" !== t
                                .blockedURI || (this.CSPIssue = !0, sessionStorage.setItem("rocketCSPIssue",
                                    !0))
                        }, {
                            isRocket: !0
                        })
                }
                o() {
                    window.addEventListener("pageshow", t => {
                        this.persisted = t.persisted, this.realWindowLoadedFired = !0
                    }, {
                        isRocket: !0
                    }), window.addEventListener("pagehide", () => {
                        this.onFirstUserAction = null
                    }, {
                        isRocket: !0
                    })
                }
                h() {
                    let t;

                    function e(e) {
                        t = e
                    }
                    window.addEventListener("touchstart", e, {
                        isRocket: !0
                    }), window.addEventListener("touchend", function i(o) {
                        o.changedTouches[0] && t.changedTouches[0] && Math.abs(o.changedTouches[0]
                                .pageX - t.changedTouches[0].pageX) < 10 && Math.abs(o.changedTouches[0]
                                .pageY - t.changedTouches[0].pageY) < 10 && o.timeStamp - t.timeStamp <
                            200 && (window.removeEventListener("touchstart", e, {
                                isRocket: !0
                            }), window.removeEventListener("touchend", i, {
                                isRocket: !0
                            }), "INPUT" === o.target.tagName && "text" === o.target.type || (o
                                .target.dispatchEvent(new TouchEvent("touchend", {
                                    target: o.target,
                                    bubbles: !0
                                })), o.target.dispatchEvent(new MouseEvent("mouseover", {
                                    target: o.target,
                                    bubbles: !0
                                })), o.target.dispatchEvent(new PointerEvent("click", {
                                    target: o.target,
                                    bubbles: !0,
                                    cancelable: !0,
                                    detail: 1,
                                    clientX: o.changedTouches[0].clientX,
                                    clientY: o.changedTouches[0].clientY
                                })), event.preventDefault()))
                    }, {
                        isRocket: !0
                    })
                }
                q(t) {
                    this.userActionTriggered || ("mousemove" !== t.type || this.firstMousemoveIgnored ?
                            "keyup" === t.type || "mouseover" === t.type || "mouseout" === t.type || (this
                                .userActionTriggered = !0, this.onFirstUserAction && this.onFirstUserAction()) :
                            this.firstMousemoveIgnored = !0), "click" === t.type && t.preventDefault(), t
                        .stopPropagation(), t.stopImmediatePropagation(), "touchstart" === this.lastEvent &&
                        "touchend" === t.type && (this.lastTouchEnd = Date.now()), "click" === t.type && (this
                            .lastTouchEnd = 0), this.lastEvent = t.type, t.composedPath && t.composedPath()[0]
                        .getRootNode() instanceof ShadowRoot && (t.rocketTarget = t.composedPath()[0]), this
                        .savedUserEvents.push(t)
                }
                u() {
                    this.savedUserEvents = [], this.userEventHandler = this.q.bind(this), this.userEvents
                        .forEach(t => window.addEventListener(t, this.userEventHandler, {
                            passive: !1,
                            isRocket: !0
                        })), document.addEventListener("visibilitychange", this.userEventHandler, {
                            isRocket: !0
                        })
                }
                U() {
                    this.userEvents.forEach(t => window.removeEventListener(t, this.userEventHandler, {
                        passive: !1,
                        isRocket: !0
                    })), document.removeEventListener("visibilitychange", this.userEventHandler, {
                        isRocket: !0
                    }), this.savedUserEvents.forEach(t => {
                        (t.rocketTarget || t.target).dispatchEvent(new window[t.constructor.name](t
                            .type, t))
                    })
                }
                m() {
                    const t = "return false",
                        e = Array.from(this.attributeEvents, t => "data-rocket-" + t),
                        i = "[" + this.attributeEvents.join("],[") + "]",
                        o = "[data-rocket-" + this.attributeEvents.join("],[data-rocket-") + "]",
                        s = (e, i, o) => {
                            o && o !== t && (e.setAttribute("data-rocket-" + i, o), e["rocket" + i] =
                                new Function("event", o), e.setAttribute(i, t))
                        };
                    new MutationObserver(t => {
                        for (const n of t) "attributes" === n.type && (n.attributeName.startsWith(
                                    "data-rocket-") || this.everythingLoaded ? n.attributeName
                                .startsWith("data-rocket-") && this.everythingLoaded && this.N(n.target,
                                    n.attributeName.substring(12)) : s(n.target, n.attributeName, n
                                    .target.getAttribute(n.attributeName))), "childList" === n.type && n
                            .addedNodes.forEach(t => {
                                if (t.nodeType === Node.ELEMENT_NODE)
                                    if (this.everythingLoaded)
                                        for (const i of [t, ...t.querySelectorAll(o)])
                                            for (const t of i.getAttributeNames()) e.includes(t) &&
                                                this.N(i, t.substring(12));
                                    else
                                        for (const e of [t, ...t.querySelectorAll(i)])
                                            for (const t of e.getAttributeNames()) this
                                                .attributeEvents.includes(t) && s(e, t, e
                                                    .getAttribute(t))
                            })
                    }).observe(document, {
                        subtree: !0,
                        childList: !0,
                        attributeFilter: [...this.attributeEvents, ...e]
                    })
                }
                I() {
                    this.attributeEvents.forEach(t => {
                        document.querySelectorAll("[data-rocket-" + t + "]").forEach(e => {
                            this.N(e, t)
                        })
                    })
                }
                N(t, e) {
                    const i = t.getAttribute("data-rocket-" + e);
                    i && (t.setAttribute(e, i), t.removeAttribute("data-rocket-" + e))
                }
                k(t) {
                    Object.defineProperty(HTMLElement.prototype, "onclick", {
                        get() {
                            return this.rocketonclick || null
                        },
                        set(e) {
                            this.rocketonclick = e, this.setAttribute(t.everythingLoaded ?
                                "onclick" : "data-rocket-onclick", "this.rocketonclick(event)")
                        }
                    })
                }
                S(t) {
                    function e(e, i) {
                        let o = e[i];
                        e[i] = null, Object.defineProperty(e, i, {
                            get: () => o,
                            set(s) {
                                t.everythingLoaded ? o = s : e["rocket" + i] = o = s
                            }
                        })
                    }
                    e(document, "onreadystatechange"), e(window, "onload"), e(window, "onpageshow");
                    try {
                        Object.defineProperty(document, "readyState", {
                            get: () => t.rocketReadyState,
                            set(e) {
                                t.rocketReadyState = e
                            },
                            configurable: !0
                        }), document.readyState = "loading"
                    } catch (t) {
                        console.log("WPRocket DJE readyState conflict, bypassing")
                    }
                }
                l(t) {
                    this.originalAddEventListener = EventTarget.prototype.addEventListener, this
                        .originalRemoveEventListener = EventTarget.prototype.removeEventListener, this
                        .savedEventListeners = [], EventTarget.prototype.addEventListener = function(e, i, o) {
                            o && o.isRocket || !t.B(e, this) && !t.userEvents.includes(e) || t.B(e, this) && !t
                                .userActionTriggered || e.startsWith("rocket-") || t.everythingLoaded ? t
                                .originalAddEventListener.call(this, e, i, o) : (t.savedEventListeners.push({
                                        target: this,
                                        remove: !1,
                                        type: e,
                                        func: i,
                                        options: o
                                    }), "mouseenter" !== e && "mouseleave" !== e || t.originalAddEventListener
                                    .call(this, e, t.savedUserEvents.push, o))
                        }, EventTarget.prototype.removeEventListener = function(e, i, o) {
                            o && o.isRocket || !t.B(e, this) && !t.userEvents.includes(e) || t.B(e, this) && !t
                                .userActionTriggered || e.startsWith("rocket-") || t.everythingLoaded ? t
                                .originalRemoveEventListener.call(this, e, i, o) : t.savedEventListeners.push({
                                    target: this,
                                    remove: !0,
                                    type: e,
                                    func: i,
                                    options: o
                                })
                        }
                }
                J(t, e) {
                    this.savedEventListeners = this.savedEventListeners.filter(i => {
                        let o = i.type,
                            s = i.target || window;
                        return e !== o || t !== s || (this.B(o, s) && (i.type = "rocket-" + o), this.$(
                            i), !1)
                    })
                }
                H() {
                    EventTarget.prototype.addEventListener = this.originalAddEventListener, EventTarget
                        .prototype.removeEventListener = this.originalRemoveEventListener, this
                        .savedEventListeners.forEach(t => this.$(t))
                }
                $(t) {
                    t.remove ? this.originalRemoveEventListener.call(t.target, t.type, t.func, t.options) : this
                        .originalAddEventListener.call(t.target, t.type, t.func, t.options)
                }
                p(t) {
                    let e;

                    function i(e) {
                        return t.everythingLoaded ? e : e.split(" ").map(t => "load" === t || t.startsWith(
                            "load.") ? "rocket-jquery-load" : t).join(" ")
                    }

                    function o(o) {
                        function s(e) {
                            const s = o.fn[e];
                            o.fn[e] = o.fn.init.prototype[e] = function() {
                                return this[0] === window && t.userActionTriggered && ("string" ==
                                    typeof arguments[0] || arguments[0] instanceof String ? arguments[
                                    0] = i(arguments[0]) : "object" == typeof arguments[0] && Object
                                    .keys(arguments[0]).forEach(t => {
                                        const e = arguments[0][t];
                                        delete arguments[0][t], arguments[0][i(t)] = e
                                    })), s.apply(this, arguments), this
                            }
                        }
                        if (o && o.fn && !t.allJQueries.includes(o)) {
                            const e = {
                                DOMContentLoaded: [],
                                "rocket-DOMContentLoaded": []
                            };
                            for (const t in e) document.addEventListener(t, () => {
                                e[t].forEach(t => t())
                            }, {
                                isRocket: !0
                            });
                            o.fn.ready = o.fn.init.prototype.ready = function(i) {
                                function s() {
                                    parseInt(o.fn.jquery) > 2 ? setTimeout(() => i.bind(document)(o)) : i
                                        .bind(document)(o)
                                }
                                return "function" == typeof i && (t.realDomReadyFired ? !t
                                        .userActionTriggered || t.fauxDomReadyFired ? s() : e[
                                            "rocket-DOMContentLoaded"].push(s) : e.DOMContentLoaded.push(s)
                                        ), this
                            }, s("on"), s("one"), s("off"), t.allJQueries.push(o)
                        }
                        e = o
                    }
                    t.allJQueries = [], o(window.jQuery), Object.defineProperty(window, "jQuery", {
                        get: () => e,
                        set(t) {
                            o(t)
                        }
                    })
                }
                P() {
                    const t = new Map;
                    document.write = document.writeln = function(e) {
                        const i = document.currentScript,
                            o = document.createRange(),
                            s = i.parentElement;
                        let n = t.get(i);
                        void 0 === n && (n = i.nextSibling, t.set(i, n));
                        const c = document.createDocumentFragment();
                        o.setStart(c, 0), c.appendChild(o.createContextualFragment(e)), s.insertBefore(c, n)
                    }
                }
                async R() {
                    return new Promise(t => {
                        this.userActionTriggered ? t() : this.onFirstUserAction = t
                    })
                }
                async L() {
                    return new Promise(t => {
                        document.addEventListener("DOMContentLoaded", () => {
                            this.realDomReadyFired = !0, t()
                        }, {
                            isRocket: !0
                        })
                    })
                }
                async j() {
                    return this.realWindowLoadedFired ? Promise.resolve() : new Promise(t => {
                        window.addEventListener("load", t, {
                            isRocket: !0
                        })
                    })
                }
                M() {
                    this.pendingScripts = [];
                    this.scriptsMutationObserver = new MutationObserver(t => {
                        for (const e of t) e.addedNodes.forEach(t => {
                            "SCRIPT" !== t.tagName || !t.src || t.noModule || t.isWPRocket ||
                                this.pendingScripts.push({
                                    script: t,
                                    promise: new Promise(e => {
                                        const i = () => {
                                            const i = this.pendingScripts
                                                .findIndex(e => e.script === t);
                                            i >= 0 && this.pendingScripts
                                                .splice(i, 1), e()
                                        };
                                        t.addEventListener("load", i, {
                                            isRocket: !0
                                        }), t.addEventListener("error", i, {
                                            isRocket: !0
                                        }), setTimeout(i, 1e3)
                                    })
                                })
                        })
                    }), this.scriptsMutationObserver.observe(document, {
                        childList: !0,
                        subtree: !0
                    })
                }
                async F() {
                    await this.X(), this.pendingScripts.length ? (await this.pendingScripts[0].promise,
                        await this.F()) : this.scriptsMutationObserver.disconnect()
                }
                D() {
                    this.delayedScripts = {
                        normal: [],
                        async: [],
                        defer: []
                    }, document.querySelectorAll("script[type$=rocketlazyloadscript]").forEach(t => {
                        t.hasAttribute("data-rocket-src") ? t.hasAttribute("async") && !1 !== t.async ?
                            this.delayedScripts.async.push(t) : t.hasAttribute("defer") && !1 !== t
                            .defer || "module" === t.getAttribute("data-rocket-type") ? this
                            .delayedScripts.defer.push(t) : this.delayedScripts.normal.push(t) : this
                            .delayedScripts.normal.push(t)
                    })
                }
                async _() {
                    await this.L();
                    let t = [];
                    document.querySelectorAll("script[type$=rocketlazyloadscript][data-rocket-src]").forEach(
                        e => {
                            let i = e.getAttribute("data-rocket-src");
                            if (i && !i.startsWith("data:")) {
                                i.startsWith("//") && (i = location.protocol + i);
                                try {
                                    const o = new URL(i).origin;
                                    o !== location.origin && t.push({
                                        src: o,
                                        crossOrigin: e.crossOrigin || "module" === e.getAttribute(
                                            "data-rocket-type")
                                    })
                                } catch (t) {}
                            }
                        }), t = [...new Map(t.map(t => [JSON.stringify(t), t])).values()], this.Y(t,
                        "preconnect")
                }
                async G(t) {
                    if (await this.K(), !0 !== t.noModule || !("noModule" in HTMLScriptElement.prototype))
                        return new Promise(e => {
                            let i;

                            function o() {
                                (i || t).setAttribute("data-rocket-status", "executed"), e()
                            }
                            try {
                                if (navigator.userAgent.includes("Firefox/") || "" === navigator
                                    .vendor || this.CSPIssue) i = document.createElement("script"), [...
                                        t.attributes
                                    ].forEach(t => {
                                        let e = t.nodeName;
                                        "type" !== e && ("data-rocket-type" === e && (e = "type"),
                                            "data-rocket-src" === e && (e = "src"), i
                                            .setAttribute(e, t.nodeValue))
                                    }), t.text && (i.text = t.text), t.nonce && (i.nonce = t.nonce), i
                                    .hasAttribute("src") ? (i.addEventListener("load", o, {
                                        isRocket: !0
                                    }), i.addEventListener("error", () => {
                                        i.setAttribute("data-rocket-status", "failed-network"),
                                            e()
                                    }, {
                                        isRocket: !0
                                    }), setTimeout(() => {
                                        i.isConnected || e()
                                    }, 1)) : (i.text = t.text, o()), i.isWPRocket = !0, t.parentNode
                                    .replaceChild(i, t);
                                else {
                                    const i = t.getAttribute("data-rocket-type"),
                                        s = t.getAttribute("data-rocket-src");
                                    i ? (t.type = i, t.removeAttribute("data-rocket-type")) : t
                                        .removeAttribute("type"), t.addEventListener("load", o, {
                                            isRocket: !0
                                        }), t.addEventListener("error", i => {
                                            this.CSPIssue && i.target.src.startsWith("data:") ? (
                                                console.log("WPRocket: CSP fallback activated"),
                                                t.removeAttribute("src"), this.G(t).then(e)) : (
                                                t.setAttribute("data-rocket-status",
                                                    "failed-network"), e())
                                        }, {
                                            isRocket: !0
                                        }), s ? (t.fetchPriority = "high", t.removeAttribute(
                                            "data-rocket-src"), t.src = s) : t.src =
                                        "data:text/javascript;base64," + window.btoa(unescape(
                                            encodeURIComponent(t.text)))
                                }
                            } catch (i) {
                                t.setAttribute("data-rocket-status", "failed-transform"), e()
                            }
                        });
                    t.setAttribute("data-rocket-status", "skipped")
                }
                async C(t) {
                    const e = t.shift();
                    return e ? (e.isConnected && await this.G(e), this.C(t)) : Promise.resolve()
                }
                O() {
                    this.Y([...this.delayedScripts.normal, ...this.delayedScripts.defer, ...this.delayedScripts
                        .async
                    ], "preload")
                }
                Y(t, e) {
                    this.trash = this.trash || [];
                    let i = !0;
                    var o = document.createDocumentFragment();
                    t.forEach(t => {
                        const s = t.getAttribute && t.getAttribute("data-rocket-src") || t.src;
                        if (s && !s.startsWith("data:")) {
                            const n = document.createElement("link");
                            n.href = s, n.rel = e, "preconnect" !== e && (n.as = "script", n
                                    .fetchPriority = i ? "high" : "low"), t.getAttribute && "module" ===
                                t.getAttribute("data-rocket-type") && (n.crossOrigin = !0), t
                                .crossOrigin && (n.crossOrigin = t.crossOrigin), t.integrity && (n
                                    .integrity = t.integrity), t.nonce && (n.nonce = t.nonce), o
                                .appendChild(n), this.trash.push(n), i = !1
                        }
                    }), document.head.appendChild(o)
                }
                W() {
                    this.trash.forEach(t => t.remove())
                }
                async T() {
                    try {
                        document.readyState = "interactive"
                    } catch (t) {}
                    this.fauxDomReadyFired = !0;
                    try {
                        await this.K(), this.J(document, "readystatechange"), document.dispatchEvent(new Event(
                                "rocket-readystatechange")), await this.K(), document
                            .rocketonreadystatechange && document.rocketonreadystatechange(), await this.K(),
                            this.J(document, "DOMContentLoaded"), document.dispatchEvent(new Event(
                                "rocket-DOMContentLoaded")), await this.K(), this.J(window, "DOMContentLoaded"),
                            window.dispatchEvent(new Event("rocket-DOMContentLoaded"))
                    } catch (t) {
                        console.error(t)
                    }
                }
                async A() {
                    try {
                        document.readyState = "complete"
                    } catch (t) {}
                    try {
                        await this.K(), this.J(document, "readystatechange"), document.dispatchEvent(new Event(
                                "rocket-readystatechange")), await this.K(), document
                            .rocketonreadystatechange && document.rocketonreadystatechange(), await this.K(),
                            this.J(window, "load"), window.dispatchEvent(new Event("rocket-load")), await this
                            .K(), window.rocketonload && window.rocketonload(), await this.K(), this.allJQueries
                            .forEach(t => t(window).trigger("rocket-jquery-load")), await this.K(), this.J(
                                window, "pageshow");
                        const t = new Event("rocket-pageshow");
                        t.persisted = this.persisted, window.dispatchEvent(t), await this.K(), window
                            .rocketonpageshow && window.rocketonpageshow({
                                persisted: this.persisted
                            })
                    } catch (t) {
                        console.error(t)
                    }
                }
                async K() {
                    Date.now() - this.lastBreath > 45 && (await this.X(), this.lastBreath = Date.now())
                }
                async X() {
                    return document.hidden ? new Promise(t => setTimeout(t)) : new Promise(t =>
                        requestAnimationFrame(t))
                }
                B(t, e = window) {
                    return e === document && "readystatechange" === t || (e === document &&
                        "DOMContentLoaded" === t || (e === window && "DOMContentLoaded" === t || (e ===
                            window && "load" === t || e === window && "pageshow" === t)))
                }
                static run() {
                    (new RocketLazyLoadScripts).t()
                }
            }
            RocketLazyLoadScripts.run()
        })();
    </script>

    <meta name="description"
        content="La principal marca de aires acondicionados tipo minisplit, líder nacional en ventas." />
    <meta name="keywords"
        content="aire, mini, split, minisplit, acondicionado, clima, electrodomésticos, línea blanca" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="facebook-domain-verification" content="9dfaem37c4fri9ytm7a8ilkyh20wpc" />
    <title>{{config('app.name') }} – Marca especializada en aires acondicionados y línea blanca.</title>
    <link href="https://fonts.googleapis.com/css?family=Lora%3A400%2C400italic%2C700%2C700italic%7CPoppins%3A400%2C500%2C600%2C700&#038;display=swap" rel="stylesheet">
    <link rel="preload" data-rocket-preload as="image"
        href="{{ asset('wp-content/uploads/2023/07/followme_cover.webp') }}" fetchpriority="high">
    <meta name='robots' content='max-image-preview:large' />
    <link rel='dns-prefetch' href='//fonts.googleapis.com' />
    <link rel='dns-prefetch' href='//code.ionicframework.com' />
    <link href='https://fonts.gstatic.com' crossorigin rel='preconnect' />
    <link rel="alternate" title="oEmbed (JSON)" type="application/json+oembed"
        href="https://mirage.mx/wp-json/oembed/1.0/embed?url=https%3A%2F%2Fmirage.mx%2F" />
    <link rel="alternate" title="oEmbed (XML)" type="text/xml+oembed"
        href="https://mirage.mx/wp-json/oembed/1.0/embed?url=https%3A%2F%2Fmirage.mx%2F&#038;format=xml" />
    <link rel="canonical" href="https://mirage.mx/" />
    <!-- Genesis Open Graph -->
    <meta property="og:title" content="{{config('app.name') }} – Marca especializada en aires acondicionados y línea blanca." />
    <meta property="og:type" content="website" />
    <meta property="og:description"
        content="La principal marca de aires acondicionados tipo minisplit, líder nacional en ventas." />
    <meta property="og:url" content="https://mirage.mx/" />
    <meta property="og:image" content="{{ asset('wp-content/uploads/2023/05/mirage_icon.png') }}" />
    <meta property="og:image:width" content="512" />
    <meta property="og:image:height" content="512" />
    <meta property="og:image:alt" content="{{config('app.name') }}" />
    <style id="wp-img-auto-sizes-contain-inline-css">
        img:is([sizes=auto i], [sizes^="auto," i]) {
            contain-intrinsic-size: 3000px 1500px
        }

        /*# sourceURL=wp-img-auto-sizes-contain-inline-css */
    </style>
    <link rel='stylesheet' id='digital-pro-css'
        href='{{ asset("wp-content/themes/digital-pro/style.css") }}?ver=1.1.3' media='all' />
    <style id="digital-pro-inline-css">
        a:focus,
        a:hover,
        .home.front-page .widget a:focus,
        .home.front-page .widget a:hover,
        .pagination a:focus,
        .pagination a:hover {
            border-color: #a00000;
        }

        a:focus,
        a:hover,
        button:hover,
        button:focus,
        .content .entry-title a:hover,
        .content .entry-title a:focus,
        .footer-widgets a:focus,
        .footer-widgets a:hover,
        .front-page .front-page-3 a:focus,
        .front-page .front-page-3 a:hover,
        .front-page .front-page-2 ul.checkmark li:before,
        .genesis-nav-menu .current-menu-item>a,
        .genesis-nav-menu a:focus,
        .genesis-nav-menu a:hover,
        .genesis-responsive-menu .genesis-nav-menu a:focus,
        .genesis-responsive-menu .genesis-nav-menu a:hover,
        .menu-toggle:focus,
        .menu-toggle:hover,
        .sub-menu-toggle:focus,
        .sub-menu-toggle:hover,
        .site-footer a:focus,
        .site-footer a:hover {
            color: #a00000;
        }


        button,
        input[type="button"],
        input[type="reset"],
        input[type="submit"],
        .archive-pagination li a:focus,
        .archive-pagination li a:hover,
        .archive-pagination .active a,
        .button,
        .entry-content a.button,
        .footer-widgets-1,
        .textwidget a.button {
            background-color: #a00000;
            border-color: #a00000;
            color: #ffffff;
        }

        .footer-widgets-1 a,
        .footer-widgets-1 p,
        .footer-widgets-1 .widget-title {
            color: #ffffff;
        }

        /*# sourceURL=digital-pro-inline-css */
    </style>
    <link rel='stylesheet' id='wp-block-library-css'
        href='/wp-includes/css/dist/block-library/style.min.css?ver=fd0786a45cbc4281d58a506762eefc8f'
        media='all' />
    <style id="classic-theme-styles-inline-css">
        /*! This file is auto-generated */
        .wp-block-button__link {
            color: #fff;
            background-color: #32373c;
            border-radius: 9999px;
            box-shadow: none;
            text-decoration: none;
            padding: calc(.667em + 2px) calc(1.333em + 2px);
            font-size: 1.125em
        }

        .wp-block-file__button {
            background: #32373c;
            color: #fff;
            text-decoration: none
        }

        /*# sourceURL=/wp-includes/css/classic-themes.min.css */
    </style>
    <style id="woocommerce-events-fooevents-event-listing-style-inline-css">
        .wp-block-woocommerce-events-fooevents-event-listing {
            border: 0;
        }
    </style>
    <style id="safe-svg-svg-icon-style-inline-css">
        .safe-svg-cover {
            text-align: center
        }

        .safe-svg-cover .safe-svg-inside {
            display: inline-block;
            max-width: 100%
        }

        .safe-svg-cover svg {
            fill: currentColor;
            height: 100%;
            max-height: 100%;
            max-width: 100%;
            width: 100%
        }
    </style>
    <style id="simple-social-icons-block-styles-inline-css">
        :where(.wp-block-social-links.is-style-logos-only) .wp-social-link-imdb {
            background-color: #f5c518;
            color: #000
        }

        :where(.wp-block-social-links:not(.is-style-logos-only)) .wp-social-link-imdb {
            background-color: #f5c518;
            color: #000
        }

        :where(.wp-block-social-links.is-style-logos-only) .wp-social-link-kofi {
            color: #72a5f2
        }

        :where(.wp-block-social-links:not(.is-style-logos-only)) .wp-social-link-kofi {
            background-color: #72a5f2;
            color: #fff
        }

        :where(.wp-block-social-links.is-style-logos-only) .wp-social-link-letterboxd {
            color: #202830
        }

        :where(.wp-block-social-links:not(.is-style-logos-only)) .wp-social-link-letterboxd {
            background-color: #3b45fd;
            color: #fff
        }

        :where(.wp-block-social-links.is-style-logos-only) .wp-social-link-signal {
            color: #3b45fd
        }

        :where(.wp-block-social-links:not(.is-style-logos-only)) .wp-social-link-signal {
            background-color: #3b45fd;
            color: #fff
        }

        :where(.wp-block-social-links.is-style-logos-only) .wp-social-link-youtube-music {
            color: red
        }

        :where(.wp-block-social-links:not(.is-style-logos-only)) .wp-social-link-youtube-music {
            background-color: red;
            color: #fff
        }

        :where(.wp-block-social-links.is-style-logos-only) .wp-social-link-diaspora {
            color: #000
        }

        :where(.wp-block-social-links:not(.is-style-logos-only)) .wp-social-link-diaspora {
            background-color: #3e4142;
            color: #fff
        }

        :where(.wp-block-social-links.is-style-logos-only) .wp-social-link-bloglovin {
            color: #000
        }

        :where(.wp-block-social-links:not(.is-style-logos-only)) .wp-social-link-bloglovin {
            background-color: #000;
            color: #fff
        }

        :where(.wp-block-social-links.is-style-logos-only) .wp-social-link-phone {
            color: #000
        }

        :where(.wp-block-social-links:not(.is-style-logos-only)) .wp-social-link-phone {
            background-color: #000;
            color: #fff
        }

        :where(.wp-block-social-links.is-style-logos-only) .wp-social-link-substack {
            color: #ff6719
        }

        :where(.wp-block-social-links:not(.is-style-logos-only)) .wp-social-link-substack {
            background-color: #ff6719;
            color: #fff
        }

        :where(.wp-block-social-links.is-style-logos-only) .wp-social-link-tripadvisor {
            color: #34e0a1
        }

        :where(.wp-block-social-links:not(.is-style-logos-only)) .wp-social-link-tripadvisor {
            background-color: #34e0a1;
            color: #fff
        }

        :where(.wp-block-social-links.is-style-logos-only) .wp-social-link-xing {
            color: #026466
        }

        :where(.wp-block-social-links:not(.is-style-logos-only)) .wp-social-link-xing {
            background-color: #026466;
            color: #fff
        }

        :where(.wp-block-social-links.is-style-logos-only) .wp-social-link-pixelfed {
            color: #000
        }

        :where(.wp-block-social-links:not(.is-style-logos-only)) .wp-social-link-pixelfed {
            background-color: #000;
            color: #fff
        }

        :where(.wp-block-social-links.is-style-logos-only) .wp-social-link-matrix {
            color: #000
        }

        :where(.wp-block-social-links:not(.is-style-logos-only)) .wp-social-link-matrix {
            background-color: #000;
            color: #fff
        }

        :where(.wp-block-social-links.is-style-logos-only) .wp-social-link-protonmail {
            color: #6d4aff
        }

        :where(.wp-block-social-links:not(.is-style-logos-only)) .wp-social-link-protonmail {
            background-color: #6d4aff;
            color: #fff
        }

        :where(.wp-block-social-links.is-style-logos-only) .wp-social-link-paypal {
            color: #003087
        }

        :where(.wp-block-social-links:not(.is-style-logos-only)) .wp-social-link-paypal {
            background-color: #003087;
            color: #fff
        }

        :where(.wp-block-social-links.is-style-logos-only) .wp-social-link-antennapod {
            color: #20a5ff
        }

        :where(.wp-block-social-links:not(.is-style-logos-only)) .wp-social-link-antennapod {
            background-color: #20a5ff;
            color: #fff
        }

        :where(.wp-block-social-links:not(.is-style-logos-only)) .wp-social-link-caldotcom {
            background-color: #000;
            color: #fff
        }

        :where(.wp-block-social-links.is-style-logos-only) .wp-social-link-fedora {
            color: #294172
        }

        :where(.wp-block-social-links:not(.is-style-logos-only)) .wp-social-link-fedora {
            background-color: #294172;
            color: #fff
        }

        :where(.wp-block-social-links.is-style-logos-only) .wp-social-link-googlephotos {
            color: #4285f4
        }

        :where(.wp-block-social-links:not(.is-style-logos-only)) .wp-social-link-googlephotos {
            background-color: #4285f4;
            color: #fff
        }

        :where(.wp-block-social-links.is-style-logos-only) .wp-social-link-googlescholar {
            color: #4285f4
        }

        :where(.wp-block-social-links:not(.is-style-logos-only)) .wp-social-link-googlescholar {
            background-color: #4285f4;
            color: #fff
        }

        :where(.wp-block-social-links.is-style-logos-only) .wp-social-link-mendeley {
            color: #9d1626
        }

        :where(.wp-block-social-links:not(.is-style-logos-only)) .wp-social-link-mendeley {
            background-color: #9d1626;
            color: #fff
        }

        :where(.wp-block-social-links.is-style-logos-only) .wp-social-link-notion {
            color: #000
        }

        :where(.wp-block-social-links:not(.is-style-logos-only)) .wp-social-link-notion {
            background-color: #000;
            color: #fff
        }

        :where(.wp-block-social-links.is-style-logos-only) .wp-social-link-overcast {
            color: #fc7e0f
        }

        :where(.wp-block-social-links:not(.is-style-logos-only)) .wp-social-link-overcast {
            background-color: #fc7e0f;
            color: #fff
        }

        :where(.wp-block-social-links.is-style-logos-only) .wp-social-link-pexels {
            color: #05a081
        }

        :where(.wp-block-social-links:not(.is-style-logos-only)) .wp-social-link-pexels {
            background-color: #05a081;
            color: #fff
        }

        :where(.wp-block-social-links.is-style-logos-only) .wp-social-link-pocketcasts {
            color: #f43e37
        }

        :where(.wp-block-social-links:not(.is-style-logos-only)) .wp-social-link-pocketcasts {
            background-color: #f43e37;
            color: #fff
        }

        :where(.wp-block-social-links.is-style-logos-only) .wp-social-link-strava {
            color: #fc4c02
        }

        :where(.wp-block-social-links:not(.is-style-logos-only)) .wp-social-link-strava {
            background-color: #fc4c02;
            color: #fff
        }

        :where(.wp-block-social-links.is-style-logos-only) .wp-social-link-wechat {
            color: #09b83e
        }

        :where(.wp-block-social-links:not(.is-style-logos-only)) .wp-social-link-wechat {
            background-color: #09b83e;
            color: #fff
        }

        :where(.wp-block-social-links.is-style-logos-only) .wp-social-link-zulip {
            color: #54a7ff
        }

        :where(.wp-block-social-links:not(.is-style-logos-only)) .wp-social-link-zulip {
            background-color: #000;
            color: #fff
        }

        :where(.wp-block-social-links.is-style-logos-only) .wp-social-link-podcastaddict {
            color: #f3842c
        }

        :where(.wp-block-social-links:not(.is-style-logos-only)) .wp-social-link-podcastaddict {
            background-color: #f3842c;
            color: #fff
        }

        :where(.wp-block-social-links.is-style-logos-only) .wp-social-link-applepodcasts {
            color: #8e32c6
        }

        :where(.wp-block-social-links:not(.is-style-logos-only)) .wp-social-link-applepodcasts {
            background-color: #8e32c6;
            color: #fff
        }

        :where(.wp-block-social-links.is-style-logos-only) .wp-social-link-ivoox {
            color: #f45f31
        }

        :where(.wp-block-social-links:not(.is-style-logos-only)) .wp-social-link-ivoox {
            background-color: #f45f31;
            color: #fff
        }

        /*# sourceURL={{ asset('vendor/mirage-assets/wp-content/plugins/simple-social-icons/build/style-index.css') }} */
    </style>
    <style id="global-styles-inline-css">
        :root {
            --wp--preset--aspect-ratio--square: 1;
            --wp--preset--aspect-ratio--4-3: 4/3;
            --wp--preset--aspect-ratio--3-4: 3/4;
            --wp--preset--aspect-ratio--3-2: 3/2;
            --wp--preset--aspect-ratio--2-3: 2/3;
            --wp--preset--aspect-ratio--16-9: 16/9;
            --wp--preset--aspect-ratio--9-16: 9/16;
            --wp--preset--color--black: #000000;
            --wp--preset--color--cyan-bluish-gray: #abb8c3;
            --wp--preset--color--white: #ffffff;
            --wp--preset--color--pale-pink: #f78da7;
            --wp--preset--color--vivid-red: #cf2e2e;
            --wp--preset--color--luminous-vivid-orange: #ff6900;
            --wp--preset--color--luminous-vivid-amber: #fcb900;
            --wp--preset--color--light-green-cyan: #7bdcb5;
            --wp--preset--color--vivid-green-cyan: #00d084;
            --wp--preset--color--pale-cyan-blue: #8ed1fc;
            --wp--preset--color--vivid-cyan-blue: #0693e3;
            --wp--preset--color--vivid-purple: #9b51e0;
            --wp--preset--gradient--vivid-cyan-blue-to-vivid-purple: linear-gradient(135deg, rgb(6, 147, 227) 0%, rgb(155, 81, 224) 100%);
            --wp--preset--gradient--light-green-cyan-to-vivid-green-cyan: linear-gradient(135deg, rgb(122, 220, 180) 0%, rgb(0, 208, 130) 100%);
            --wp--preset--gradient--luminous-vivid-amber-to-luminous-vivid-orange: linear-gradient(135deg, rgb(252, 185, 0) 0%, rgb(255, 105, 0) 100%);
            --wp--preset--gradient--luminous-vivid-orange-to-vivid-red: linear-gradient(135deg, rgb(255, 105, 0) 0%, rgb(207, 46, 46) 100%);
            --wp--preset--gradient--very-light-gray-to-cyan-bluish-gray: linear-gradient(135deg, rgb(238, 238, 238) 0%, rgb(169, 184, 195) 100%);
            --wp--preset--gradient--cool-to-warm-spectrum: linear-gradient(135deg, rgb(74, 234, 220) 0%, rgb(151, 120, 209) 20%, rgb(207, 42, 186) 40%, rgb(238, 44, 130) 60%, rgb(251, 105, 98) 80%, rgb(254, 248, 76) 100%);
            --wp--preset--gradient--blush-light-purple: linear-gradient(135deg, rgb(255, 206, 236) 0%, rgb(152, 150, 240) 100%);
            --wp--preset--gradient--blush-bordeaux: linear-gradient(135deg, rgb(254, 205, 165) 0%, rgb(254, 45, 45) 50%, rgb(107, 0, 62) 100%);
            --wp--preset--gradient--luminous-dusk: linear-gradient(135deg, rgb(255, 203, 112) 0%, rgb(199, 81, 192) 50%, rgb(65, 88, 208) 100%);
            --wp--preset--gradient--pale-ocean: linear-gradient(135deg, rgb(255, 245, 203) 0%, rgb(182, 227, 212) 50%, rgb(51, 167, 181) 100%);
            --wp--preset--gradient--electric-grass: linear-gradient(135deg, rgb(202, 248, 128) 0%, rgb(113, 206, 126) 100%);
            --wp--preset--gradient--midnight: linear-gradient(135deg, rgb(2, 3, 129) 0%, rgb(40, 116, 252) 100%);
            --wp--preset--font-size--small: 13px;
            --wp--preset--font-size--medium: 20px;
            --wp--preset--font-size--large: 36px;
            --wp--preset--font-size--x-large: 42px;
            --wp--preset--spacing--20: 0.44rem;
            --wp--preset--spacing--30: 0.67rem;
            --wp--preset--spacing--40: 1rem;
            --wp--preset--spacing--50: 1.5rem;
            --wp--preset--spacing--60: 2.25rem;
            --wp--preset--spacing--70: 3.38rem;
            --wp--preset--spacing--80: 5.06rem;
            --wp--preset--shadow--natural: 6px 6px 9px rgba(0, 0, 0, 0.2);
            --wp--preset--shadow--deep: 12px 12px 50px rgba(0, 0, 0, 0.4);
            --wp--preset--shadow--sharp: 6px 6px 0px rgba(0, 0, 0, 0.2);
            --wp--preset--shadow--outlined: 6px 6px 0px -3px rgb(255, 255, 255), 6px 6px rgb(0, 0, 0);
            --wp--preset--shadow--crisp: 6px 6px 0px rgb(0, 0, 0);
        }

        :where(body) {
            margin: 0;
        }

        :where(.is-layout-flex) {
            gap: 0.5em;
        }

        :where(.is-layout-grid) {
            gap: 0.5em;
        }

        body .is-layout-flex {
            display: flex;
        }

        .is-layout-flex {
            flex-wrap: wrap;
            align-items: center;
        }

        .is-layout-flex> :is(*, div) {
            margin: 0;
        }

        body .is-layout-grid {
            display: grid;
        }

        .is-layout-grid> :is(*, div) {
            margin: 0;
        }

        body {
            padding-top: 0px;
            padding-right: 0px;
            padding-bottom: 0px;
            padding-left: 0px;
        }

        :root :where(.wp-element-button, .wp-block-button__link) {
            background-color: #32373c;
            border-width: 0;
            color: #fff;
            font-family: inherit;
            font-size: inherit;
            font-style: inherit;
            font-weight: inherit;
            letter-spacing: inherit;
            line-height: inherit;
            padding-top: calc(0.667em + 2px);
            padding-right: calc(1.333em + 2px);
            padding-bottom: calc(0.667em + 2px);
            padding-left: calc(1.333em + 2px);
            text-decoration: none;
            text-transform: inherit;
        }

        .has-black-color {
            color: var(--wp--preset--color--black) !important;
        }

        .has-cyan-bluish-gray-color {
            color: var(--wp--preset--color--cyan-bluish-gray) !important;
        }

        .has-white-color {
            color: var(--wp--preset--color--white) !important;
        }

        .has-pale-pink-color {
            color: var(--wp--preset--color--pale-pink) !important;
        }

        .has-vivid-red-color {
            color: var(--wp--preset--color--vivid-red) !important;
        }

        .has-luminous-vivid-orange-color {
            color: var(--wp--preset--color--luminous-vivid-orange) !important;
        }

        .has-luminous-vivid-amber-color {
            color: var(--wp--preset--color--luminous-vivid-amber) !important;
        }

        .has-light-green-cyan-color {
            color: var(--wp--preset--color--light-green-cyan) !important;
        }

        .has-vivid-green-cyan-color {
            color: var(--wp--preset--color--vivid-green-cyan) !important;
        }

        .has-pale-cyan-blue-color {
            color: var(--wp--preset--color--pale-cyan-blue) !important;
        }

        .has-vivid-cyan-blue-color {
            color: var(--wp--preset--color--vivid-cyan-blue) !important;
        }

        .has-vivid-purple-color {
            color: var(--wp--preset--color--vivid-purple) !important;
        }

        .has-black-background-color {
            background-color: var(--wp--preset--color--black) !important;
        }

        .has-cyan-bluish-gray-background-color {
            background-color: var(--wp--preset--color--cyan-bluish-gray) !important;
        }

        .has-white-background-color {
            background-color: var(--wp--preset--color--white) !important;
        }

        .has-pale-pink-background-color {
            background-color: var(--wp--preset--color--pale-pink) !important;
        }

        .has-vivid-red-background-color {
            background-color: var(--wp--preset--color--vivid-red) !important;
        }

        .has-luminous-vivid-orange-background-color {
            background-color: var(--wp--preset--color--luminous-vivid-orange) !important;
        }

        .has-luminous-vivid-amber-background-color {
            background-color: var(--wp--preset--color--luminous-vivid-amber) !important;
        }

        .has-light-green-cyan-background-color {
            background-color: var(--wp--preset--color--light-green-cyan) !important;
        }

        .has-vivid-green-cyan-background-color {
            background-color: var(--wp--preset--color--vivid-green-cyan) !important;
        }

        .has-pale-cyan-blue-background-color {
            background-color: var(--wp--preset--color--pale-cyan-blue) !important;
        }

        .has-vivid-cyan-blue-background-color {
            background-color: var(--wp--preset--color--vivid-cyan-blue) !important;
        }

        .has-vivid-purple-background-color {
            background-color: var(--wp--preset--color--vivid-purple) !important;
        }

        .has-black-border-color {
            border-color: var(--wp--preset--color--black) !important;
        }

        .has-cyan-bluish-gray-border-color {
            border-color: var(--wp--preset--color--cyan-bluish-gray) !important;
        }

        .has-white-border-color {
            border-color: var(--wp--preset--color--white) !important;
        }

        .has-pale-pink-border-color {
            border-color: var(--wp--preset--color--pale-pink) !important;
        }

        .has-vivid-red-border-color {
            border-color: var(--wp--preset--color--vivid-red) !important;
        }

        .has-luminous-vivid-orange-border-color {
            border-color: var(--wp--preset--color--luminous-vivid-orange) !important;
        }

        .has-luminous-vivid-amber-border-color {
            border-color: var(--wp--preset--color--luminous-vivid-amber) !important;
        }

        .has-light-green-cyan-border-color {
            border-color: var(--wp--preset--color--light-green-cyan) !important;
        }

        .has-vivid-green-cyan-border-color {
            border-color: var(--wp--preset--color--vivid-green-cyan) !important;
        }

        .has-pale-cyan-blue-border-color {
            border-color: var(--wp--preset--color--pale-cyan-blue) !important;
        }

        .has-vivid-cyan-blue-border-color {
            border-color: var(--wp--preset--color--vivid-cyan-blue) !important;
        }

        .has-vivid-purple-border-color {
            border-color: var(--wp--preset--color--vivid-purple) !important;
        }

        .has-vivid-cyan-blue-to-vivid-purple-gradient-background {
            background: var(--wp--preset--gradient--vivid-cyan-blue-to-vivid-purple) !important;
        }

        .has-light-green-cyan-to-vivid-green-cyan-gradient-background {
            background: var(--wp--preset--gradient--light-green-cyan-to-vivid-green-cyan) !important;
        }

        .has-luminous-vivid-amber-to-luminous-vivid-orange-gradient-background {
            background: var(--wp--preset--gradient--luminous-vivid-amber-to-luminous-vivid-orange) !important;
        }

        .has-luminous-vivid-orange-to-vivid-red-gradient-background {
            background: var(--wp--preset--gradient--luminous-vivid-orange-to-vivid-red) !important;
        }

        .has-very-light-gray-to-cyan-bluish-gray-gradient-background {
            background: var(--wp--preset--gradient--very-light-gray-to-cyan-bluish-gray) !important;
        }

        .has-cool-to-warm-spectrum-gradient-background {
            background: var(--wp--preset--gradient--cool-to-warm-spectrum) !important;
        }

        .has-blush-light-purple-gradient-background {
            background: var(--wp--preset--gradient--blush-light-purple) !important;
        }

        .has-blush-bordeaux-gradient-background {
            background: var(--wp--preset--gradient--blush-bordeaux) !important;
        }

        .has-luminous-dusk-gradient-background {
            background: var(--wp--preset--gradient--luminous-dusk) !important;
        }

        .has-pale-ocean-gradient-background {
            background: var(--wp--preset--gradient--pale-ocean) !important;
        }

        .has-electric-grass-gradient-background {
            background: var(--wp--preset--gradient--electric-grass) !important;
        }

        .has-midnight-gradient-background {
            background: var(--wp--preset--gradient--midnight) !important;
        }

        .has-small-font-size {
            font-size: var(--wp--preset--font-size--small) !important;
        }

        .has-medium-font-size {
            font-size: var(--wp--preset--font-size--medium) !important;
        }

        .has-large-font-size {
            font-size: var(--wp--preset--font-size--large) !important;
        }

        .has-x-large-font-size {
            font-size: var(--wp--preset--font-size--x-large) !important;
        }

        :root :where(.wp-block-icon svg) {
            width: 24px;
        }

        :where(.wp-block-post-template.is-layout-flex) {
            gap: 1.25em;
        }

        :where(.wp-block-post-template.is-layout-grid) {
            gap: 1.25em;
        }

        :where(.wp-block-term-template.is-layout-flex) {
            gap: 1.25em;
        }

        :where(.wp-block-term-template.is-layout-grid) {
            gap: 1.25em;
        }

        :where(.wp-block-columns.is-layout-flex) {
            gap: 2em;
        }

        :where(.wp-block-columns.is-layout-grid) {
            gap: 2em;
        }

        :root :where(.wp-block-pullquote) {
            font-size: 1.5em;
            line-height: 1.6;
        }

        /*# sourceURL=global-styles-inline-css */
    </style>
    <link rel='stylesheet' id='dashicons-css'
        href='{{ asset("wp-includes/css/dashicons.min.css") }}?ver=fd0786a45cbc4281d58a506762eefc8f' media='all' />
    <link rel='stylesheet' id='woocommerce-events-front-style-css'
        href='{{ asset("wp-content/plugins/fooevents/css/events-frontend.css") }}?ver=1.19.22' media='all' />
    <link rel='stylesheet' id='woocommerce-events-zoom-frontend-style-css'
        href='{{ asset("wp-content/plugins/fooevents/css/events-zoom-frontend.css") }}?ver=1.19.22' media='all' />
    <link rel='stylesheet' id='woocommerce-layout-css'
        href='{{ asset("wp-content/plugins/woocommerce/assets/css/woocommerce-layout.css") }}?ver=10.8.1'
        media='all' />
    <link rel='stylesheet' id='woocommerce-smallscreen-css'
        href='{{ asset("wp-content/plugins/woocommerce/assets/css/woocommerce-smallscreen.css") }}?ver=10.8.1'
        media='only screen and (max-width: 800px)' />
    <link rel='stylesheet' id='woocommerce-general-css'
        href='{{ asset("wp-content/plugins/woocommerce/assets/css/woocommerce.css") }}?ver=10.8.1' media='all' />
    <link rel='stylesheet' id='digital-woocommerce-styles-css'
        href='{{ asset("wp-content/themes/digital-pro/lib/woocommerce/digital-woocommerce.css") }}?ver=1.1.3'
        media='screen' />
    <style id="digital-woocommerce-styles-inline-css">
        .woocommerce a.button,
        .woocommerce a.button.alt,
        .woocommerce button.button,
        .woocommerce button.button.alt,
        .woocommerce input.button,
        .woocommerce input.button.alt,
        .woocommerce input.button[type="submit"],
        .woocommerce span.onsale,
        .woocommerce #respond input#submit,
        .woocommerce #respond input#submit.alt,
        .woocommerce.widget_price_filter .ui-slider .ui-slider-handle,
        .woocommerce.widget_price_filter .ui-slider .ui-slider-range {
            background-color: #a00000;
        }

        .woocommerce-MyAccount-navigation ul li.is-active>a {
            border-bottom-color: #a00000;
            color: #a00000;
        }


        /*# sourceURL=digital-woocommerce-styles-inline-css */
    </style>
    <style id="woocommerce-inline-inline-css">
        .woocommerce form .form-row .required {
            visibility: visible;
        }

        /*# sourceURL=woocommerce-inline-inline-css */
    </style>
    <link rel='stylesheet' id='wpsl-styles-css'
        href='{{ asset("wp-content/plugins/wp-store-locator/css/styles.min.css") }}?ver=2.3.2' media='all' />
    <link rel='stylesheet' id='url-shortify-css'
        href='{{ asset("wp-content/plugins/url-shortify-premium/lite/dist/styles/url-shortify.css") }}?ver=2.4.1'
        media='all' />

    <link rel='stylesheet' id='ionicons-css'
        href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css?ver=1.1.3' media='all' />
    <link rel='stylesheet' id='simple-social-icons-font-css'
        href='{{ asset("wp-content/plugins/simple-social-icons/css/style.css") }}?ver=4.0.0' media='all' />
    <link rel='stylesheet' id='digital-front-styles-css'
        href='{{ asset("wp-content/themes/digital-pro/style-front.css") }}?ver=1.1.3' media='all' />
    <script id="jquery-core-js" src="{{ asset('wp-includes/js/jquery/jquery.min.js') }}?ver=3.7.1"></script>
    <script id="jquery-migrate-js" src="{{ asset('wp-includes/js/jquery/jquery-migrate.min.js') }}?ver=3.4.1"></script>
    <script id="file_uploads_nfpluginsettings-js-extra">
        var params = {
            "clearLogRestUrl": "https://mirage.mx/wp-json/nf-file-uploads/debug-log/delete-all",
            "clearLogButtonId": "file_uploads_clear_debug_logger",
            "downloadLogRestUrl": "https://mirage.mx/wp-json/nf-file-uploads/debug-log/get-all",
            "downloadLogButtonId": "file_uploads_download_debug_logger"
        };
        //# sourceURL=file_uploads_nfpluginsettings-js-extra
    </script>
    <script type="text/javascript" id="file_uploads_nfpluginsettings-js"
        src="{{ asset('vendor/mirage-assets/wp-content/plugins/ninja-forms-uploads/assets/js/nfpluginsettings.js') }}"
         defer></script>
    <script data-wp-strategy="defer" defer id="wc-jquery-blockui-js"
        src="{{ asset('vendor/mirage-assets/wp-content/plugins/woocommerce/assets/js/jquery-blockui/jquery.blockUI.min.js') }}">
    </script>
    <script id="wc-add-to-cart-js-extra">
        var wc_add_to_cart_params = {
            "ajax_url": "/wp-admin/admin-ajax.php",
            "wc_ajax_url": "/?wc-ajax=%%endpoint%%",
            "i18n_view_cart": "Revisar",
            "cart_url": "https://mirage.mx/reservar/",
            "is_cart": "",
            "cart_redirect_after_add": "yes"
        };
        //# sourceURL=wc-add-to-cart-js-extra
    </script>
    <script type="text/javascript" data-wp-strategy="defer" defer id="wc-add-to-cart-js"
        src="{{ asset('vendor/mirage-assets/wp-content/plugins/woocommerce/assets/js/frontend/add-to-cart.min.js') }}">
    </script>
    <script type="text/javascript" data-wp-strategy="defer" defer id="wc-js-cookie-js"
        src="{{ asset('vendor/mirage-assets/wp-content/plugins/woocommerce/assets/js/js-cookie/js.cookie.min.js') }}">
    </script>
    <script id="woocommerce-js-extra">
        var woocommerce_params = {
            "ajax_url": "/wp-admin/admin-ajax.php",
            "wc_ajax_url": "/?wc-ajax=%%endpoint%%",
            "i18n_password_show": "Show password",
            "i18n_password_hide": "Hide password"
        };
        //# sourceURL=woocommerce-js-extra
    </script>
    <script type="text/javascript" data-wp-strategy="defer" defer id="woocommerce-js"
        src="{{ asset('vendor/mirage-assets/wp-content/plugins/woocommerce/assets/js/frontend/woocommerce.min.js') }}">
    </script>
    <script id="url-shortify-js-extra">
        var usParams = {
            "ajaxurl": "https://mirage.mx/wp-admin/admin-ajax.php"
        };
        //# sourceURL=url-shortify-js-extra
    </script>
    <script type="text/javascript" id="url-shortify-js"
        src="{{ asset('vendor/mirage-assets/wp-content/plugins/url-shortify-premium/lite/dist/scripts/url-shortify.js') }}"
         defer></script>
    <link rel="https://api.w.org/" href="https://mirage.mx/wp-json/" />
    <link rel="alternate" title="JSON" type="application/json" href="https://mirage.mx/wp-json/wp/v2/pages/821" />
    <link rel="EditURI" type="application/rsd+xml" title="RSD" href="https://mirage.mx/xmlrpc.php?rsd" />
    <link rel="pingback" href="https://mirage.mx/xmlrpc.php" />
    <meta itemprop="name" content="{{config('app.name') }}" />
    <meta itemprop="url" content="https://mirage.mx/" />
    <!-- Google tag (gtag.js) -->
    <script type="text/javascript" async
        src="https://www.googletagmanager.com/gtag/js?id=G-1PL39TGXGK"></script>
    <script type="text/javascript">
        window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-1PL39TGXGK');
</script> <!-- Facebook Pixel Code -->
    <script type="text/javascript">
        !function(f,b,e,v,n,t,s)
	{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	n.queue=[];t=b.createElement(e);t.async=!0;
	t.src=v;s=b.getElementsByTagName(e)[0];
	s.parentNode.insertBefore(t,s)}(window,document,'script',
	'https://connect.facebook.net/en_US/fbevents.js');
	fbq('init', '212979485921717');
	fbq('track', 'PageView');
	</script>
    <noscript>
        <img height="1" width="1" src="https://www.facebook.com/tr?id=212979485921717&ev=PageView
	&noscript=1" />
    </noscript>
    <!-- End Facebook Pixel Code -->
    <style type="text/css">
        .site-title a {
            background: url({{ asset('wp-content/uploads/2017/03/cropped-logo-aires-mirage.png') }}) no-repeat !important;
        }
    </style>
    <!-- Google Tag Manager -->
    <script type="text/javascript">(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-T74BMF8F');</script>
    <!-- End Google Tag Manager --> <noscript>
        <style>
            .woocommerce-product-gallery {
                opacity: 1 !important;
            }
        </style>
    </noscript>
    <meta name="generator"
        content="Elementor 4.1.3; features: additional_custom_breakpoints; settings: css_print_method-external, google_font-enabled, font_display-swap">
    <style>
        .e-con.e-parent:nth-of-type(n+4):not(.e-lazyloaded):not(.e-no-lazyload),
        .e-con.e-parent:nth-of-type(n+4):not(.e-lazyloaded):not(.e-no-lazyload) * {
            background-image: none !important;
        }

        @media screen and (max-height: 1024px) {

            .e-con.e-parent:nth-of-type(n+3):not(.e-lazyloaded):not(.e-no-lazyload),
            .e-con.e-parent:nth-of-type(n+3):not(.e-lazyloaded):not(.e-no-lazyload) * {
                background-image: none !important;
            }
        }

        @media screen and (max-height: 640px) {

            .e-con.e-parent:nth-of-type(n+2):not(.e-lazyloaded):not(.e-no-lazyload),
            .e-con.e-parent:nth-of-type(n+2):not(.e-lazyloaded):not(.e-no-lazyload) * {
                background-image: none !important;
            }
        }
    </style>
    <link rel="icon" href="{{ asset('wp-content/uploads/2017/03/cropped-ms-icon-310x310-32x32.png') }}"
        sizes="32x32" />
    <link rel="icon" href="{{ asset('wp-content/uploads/2017/03/cropped-ms-icon-310x310-192x192.png') }}"
        sizes="192x192" />
    <link rel="apple-touch-icon"
        href="{{ asset('wp-content/uploads/2017/03/cropped-ms-icon-310x310-180x180.png') }}" />
    <meta name="msapplication-TileImage"
        content="{{ asset('wp-content/uploads/2017/03/cropped-ms-icon-310x310-270x270.png') }}" />
    <style>
        .shorten_url {
            padding: 10px 10px 10px 10px;
            border: 1px solid #AAAAAA;
            background-color: #EEEEEE;
        }
    </style>
    <style id="wp-custom-css">
        /*
Puedes añadir tu propio CSS aquí.

Haz clic en el icono de ayuda de arriba para averiguar más.
*/
        .woocommerce ul.products li.product .button {
            visibility: hidden;
        }

        .woocommerce div.product .woocommerce-tabs ul.tabs {
            display: none;
        }

        .callout-button {
            color: #ffffff;
            display: inline-block;
            outline: none;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            font: 14px/100% Arial, Helvetica, sans-serif;
            padding: .1em;
            text-shadow: 0 1px 1px rgba(0, 0, 0, .3);
            -webkit-border-radius: .2em;
            -moz-border-radius: .2em;
            border-radius: .2em;
            -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, .2);
            -moz-box-shadow: 0 1px 2px rgba(0, 0, 0, .2);
            box-shadow: 0 1px 2px rgba(0, 0, 0, .2);
        }

        .callout-button:hover {
            text-decoration: none;
            color: #ffffff;
        }

        .callout-button a {
            text-decoration: none;
            color: #ffffff;
        }

        .callout-button a:hover {
            text-decoration: none;
            color: #ffffff !important;
        }

        .callout-button:active {
            color: #ffffff;
            position: relative;
            top: 1px;
        }

        #contenedor-cadenas a,
        #contenedor-cadenas a:hover {
            border: none;
        }

        #lineup-cadenas {
            width: 60%;
            margin-left: auto;
            margin-right: auto;
            border: 1px solid #232525;
        }

        #lineup-cadenas th {
            border: 1px solid #232525;
            background-color: #232525;
            color: #FFFFFF;
            padding: 1.5em;
        }

        #lineup-cadenas tr:first-child td {
            padding: 1.5em;
            text-align: center;
            background-color: #a00000;
            color: #FFFFFF;
        }

        #lineup-cadenas td {
            border: 1px solid #232525;
            padding: .5em;
        }

        #lineup-cadenas tr:hover {
            background-color: #f5f5f5;
        }

        .cover_tienda img {
            width: 100%;
        }

        @media (-webkit-min-device-pixel-ratio: 2),
        (min-resolution: 192dpi) {
            .cover_tienda img {
                width: 5120px;
            }
        }

        .mirage-tiendas {
            max-width: 580px;
            margin: 0 auto;
        }

        .mirage-tiendas figcaption {
            font-size: .7em;
            text-align: center;
        }

        .mirage-tiendas h1 {
            color: #a00000;
        }

        .product_meta .posted_in {
            display: block;
            margin-bottom: .5em;
        }

        /* Tablas de especificaciones */
        .specs-table {
            width: 100%;
        }

        .specs-table th {
            border-bottom: 1px solid #ccc;
            padding: 1em;
            background-color: #eee;
        }

        .specs-table>tbody>tr:nth-of-type(1) {
            border-top: 1px solid #ccc;
        }

        .specs-table>tbody>tr>td:nth-of-type(1) {
            padding-right: .5em;
            text-align: right;
            border-right: 1px solid #ccc;
        }

        .specs-table>tbody>tr>td:nth-of-type(2) {
            text-align: center;
            border-right: 1px solid #ccc;
            font-size: 1rem;
            font-weight: bold;
            padding: .5em;
        }

        .specs-table>tbody>tr>td:nth-of-type(3) {
            text-align: center;
        }

        .specs-table td {
            border-bottom: 1px solid #ccc;

        }

        @media only screen and (max-width: 600px) {
            .specs-table {
                font-size: .8em;
                width: 100%;
            }

            .specs-table>tbody>tr>td:nth-of-type(2) {
                font-size: .9em;
            }
        }

        /* Smartphones (portrait and landscape) ----------- */
        @media only screen and (min-device-width : 320px) and (max-device-width : 480px) {

            /* Styles */
            .specs-firstrow {
                font-size: 1em;
            }

            .specs-firstrow th {
                padding-bottom: 2em;
            }

            .wc-tab h2 {
                font-size: 1.2em;
            }

            .su-row {
                margin-bottom: 0 !important;
            }

            .specs-table td {
                font-size: 1rem !important;
            }
        }

        @media only screen and (max-width: 767px) {
            .wc-tab .su-row .su-column+.su-column {
                margin: 0 !important;
            }

            .su-row {
                margin-bottom: 0 !important;
            }

            .specs-table td {
                font-size: 1rem !important;
            }
        }

        /* Tablas de especificaciones */

        /* Justificar texto */
        .justifica {
            text-align: justify;
            text-justify: inter-word;
        }

        /* List style type */
        .lowabc ol li {
            list-style-type: lower-alpha !important;
        }

        /* Documentacion WC Extension */
        .woocommerce-product-documents-title {
            font-size: 2rem !important;
            margin-bottom: 0.5em !important;
        }

        .woocommerce-product-documents {
            margin-bottom: 0.5em !important;
        }

        .wp-block-separator {
            border: none;
        }

        .single-product .product_meta {
            margin-top: 2em;
        }

        a,
        a:focus,
        a:hover {
            border-bottom: 0;
            text-decoration: none;
        }

        .footer-widgets {
            border-top: none;
        }

        .site-header .wrap {
            max-width: 1024px;
            margin: 0 auto;
        }

        /* FooEvents Mods */
        /* Pagina de Reservación: page-id-24805 */
        .page-id-24805 .woocommerce-checkout-review-order-table {
            display: none;
        }

        .page-id-24805 #order_review_heading {
            display: none;
        }

        .page-id-24805 .woocommerce-checkout-payment {
            background-color: transparent !important;
        }

        .page-id-24805 .woocommerce-order-details {
            display: none;
        }

        .page-id-24805 .woocommerce-order-overview__total {
            display: none;
        }

        .page-id-24805 .email {
            border-right: none !important;
        }

        /* Pagina de Confirmación: page-id-24809 */
        .page-id-24809 .cart_totals h2 {
            display: none;
        }

        .page-id-24809 .cart_totals table {
            display: none;
        }

        .page-id-24809 .shop_table .product-price {
            display: none;
        }

        .page-id-24809 .shop_table .product-quantity {
            display: none;
        }

        .page-id-24809 .shop_table .product-subtotal {
            display: none;
        }

        /* Email obfuscation */
        div.email-privacidad>span:nth-child(2) {
            display: none;
        }

        .btn-tienda {
            border-radius: 0.5em;
            background-color: gold;
        }

        .nf-response-msg {
            padding: 2em 0;
        }

        /* Botones de descarga en ligthbox */
        .elementor-lightbox .elementor-download-wrap {
            text-align: center;
            margin-top: 16px;
            padding-top: 12px;
            border-top: 1px solid rgba(255, 255, 255, .2);
        }

        .elementor-lightbox .elementor-download-btn {
            display: inline-block;
            font-family: Roboto;
            font-size: 18px;
            line-height: 1.2;
            background: #ffffff;
            color: #000000;
            padding: 10px 16px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 600;
        }

        .elementor-lightbox .elementor-download-btn:hover {
            opacity: .85;
        }

        .elementor-download-wrap {
            position: absolute;
            bottom: 5rem;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
        }

        .elementor-slideshow__footer {
            display: none;
        }
    </style>
    <noscript>
        <style id="rocket-lazyload-nojs-css">
            .rll-youtube-player,
            [data-lazy-src] {
                display: none !important;
            }
        </style>
    </noscript>
    <style id="rocket-lazyrender-inline-css">
        [data-wpr-lazyrender] {
            content-visibility: auto;
        }
    </style>
    <meta name="generator" content="WP Rocket 3.21.3"
        data-wpr-features="wpr_delay_js wpr_defer_js wpr_lazyload_images wpr_preconnect_external_domains wpr_automatic_lazy_rendering wpr_oci wpr_preload_links wpr_desktop" />
</head>
