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
    <title>Mirage México – Marca especializada en aires acondicionados y línea blanca.</title>
    <link data-rocket-prefetch href="https://www.googletagmanager.com" rel="dns-prefetch">
    <link data-rocket-prefetch href="https://connect.facebook.net" rel="dns-prefetch">
    <link data-rocket-prefetch href="https://fonts.googleapis.com" rel="dns-prefetch">
    <link data-rocket-prefetch href="https://code.ionicframework.com" rel="dns-prefetch">
    <link data-rocket-preload as="style"
        href="https://fonts.googleapis.com/css?family=Lora%3A400%2C400italic%2C700%2C700italic%7CPoppins%3A400%2C500%2C600%2C700&#038;display=swap"
        rel="preload">
    <link
        href="https://fonts.googleapis.com/css?family=Lora%3A400%2C400italic%2C700%2C700italic%7CPoppins%3A400%2C500%2C600%2C700&#038;display=swap"
        media="print" onload="this.media=&#039;all&#039;" rel="stylesheet">
    <noscript data-wpr-hosted-gf-parameters="">
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Lora%3A400%2C400italic%2C700%2C700italic%7CPoppins%3A400%2C500%2C600%2C700&#038;display=swap">
        </noscript>
    <link rel="preload" data-rocket-preload as="image"
        href="https://mirage.mx/wp-content/uploads/2023/07/followme_cover.webp" fetchpriority="high">
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
    <meta property="og:title" content="Mirage México – Marca especializada en aires acondicionados y línea blanca." />
    <meta property="og:type" content="website" />
    <meta property="og:description"
        content="La principal marca de aires acondicionados tipo minisplit, líder nacional en ventas." />
    <meta property="og:url" content="https://mirage.mx/" />
    <meta property="og:image" content="https://mirage.mx/wp-content/uploads/2023/05/mirage_icon.png" />
    <meta property="og:image:width" content="512" />
    <meta property="og:image:height" content="512" />
    <meta property="og:image:alt" content="Mirage México" />
    <style id="wp-img-auto-sizes-contain-inline-css">
        img:is([sizes=auto i], [sizes^="auto,"i]) {
            contain-intrinsic-size: 3000px 1500px
        }

        /*# sourceURL=wp-img-auto-sizes-contain-inline-css */
    </style>
    <link rel='stylesheet' id='digital-pro-css'
        href='https://mirage.mx/wp-content/themes/digital-pro/style.css?ver=1.1.3' media='all' />
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
        href='https://mirage.mx/wp-includes/css/dist/block-library/style.min.css?ver=fd0786a45cbc4281d58a506762eefc8f'
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
        /*!***************************************************************************************************************************************************************************************************************************************************************!*\
  !*** css ./node_modules/css-loader/dist/cjs.js??ruleSet[1].rules[4].use[1]!./node_modules/postcss-loader/dist/cjs.js??ruleSet[1].rules[4].use[2]!./node_modules/sass-loader/dist/cjs.js??ruleSet[1].rules[4].use[3]!./src/fooevents-event-listing/style.scss ***!
  \***************************************************************************************************************************************************************************************************************************************************************/
        /**
 * The following styles get applied both on the front of your site
 * and in the editor.
 *
 * Replace them with your own styles or remove the file completely.
 */
        .wp-block-woocommerce-events-fooevents-event-listing {
            border: 0;
        }

        /*# sourceMappingURL=style-index.css.map*/
        /*# sourceURL=https://mirage.mx/wp-content/plugins/fooevents/build/fooevents-event-listing/style-index.css */
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

        /*# sourceURL=https://mirage.mx/wp-content/plugins/safe-svg/dist/safe-svg-block-frontend.css */
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

        /*# sourceURL=https://mirage.mx/wp-content/plugins/simple-social-icons/build/style-index.css */
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
        href='https://mirage.mx/wp-includes/css/dashicons.min.css?ver=fd0786a45cbc4281d58a506762eefc8f' media='all' />
    <link rel='stylesheet' id='woocommerce-events-front-style-css'
        href='https://mirage.mx/wp-content/plugins/fooevents/css/events-frontend.css?ver=1.19.22' media='all' />
    <link rel='stylesheet' id='woocommerce-events-zoom-frontend-style-css'
        href='https://mirage.mx/wp-content/plugins/fooevents/css/events-zoom-frontend.css?ver=1.19.22' media='all' />
    <link rel='stylesheet' id='woocommerce-layout-css'
        href='https://mirage.mx/wp-content/plugins/woocommerce/assets/css/woocommerce-layout.css?ver=10.8.1'
        media='all' />
    <link rel='stylesheet' id='woocommerce-smallscreen-css'
        href='https://mirage.mx/wp-content/plugins/woocommerce/assets/css/woocommerce-smallscreen.css?ver=10.8.1'
        media='only screen and (max-width: 800px)' />
    <link rel='stylesheet' id='woocommerce-general-css'
        href='https://mirage.mx/wp-content/plugins/woocommerce/assets/css/woocommerce.css?ver=10.8.1' media='all' />
    <link rel='stylesheet' id='digital-woocommerce-styles-css'
        href='https://mirage.mx/wp-content/themes/digital-pro/lib/woocommerce/digital-woocommerce.css?ver=1.1.3'
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
        href='https://mirage.mx/wp-content/plugins/wp-store-locator/css/styles.min.css?ver=2.3.2' media='all' />
    <link rel='stylesheet' id='url-shortify-css'
        href='https://mirage.mx/wp-content/plugins/url-shortify-premium/lite/dist/styles/url-shortify.css?ver=2.4.1'
        media='all' />

    <link rel='stylesheet' id='ionicons-css'
        href='//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css?ver=1.1.3' media='all' />
    <link rel='stylesheet' id='simple-social-icons-font-css'
        href='https://mirage.mx/wp-content/plugins/simple-social-icons/css/style.css?ver=4.0.0' media='all' />
    <link rel='stylesheet' id='digital-front-styles-css'
        href='https://mirage.mx/wp-content/themes/digital-pro/style-front.css?ver=1.1.3' media='all' />
    <script id="jquery-core-js" src="https://mirage.mx/wp-includes/js/jquery/jquery.min.js?ver=3.7.1"></script>
    <script id="jquery-migrate-js" src="https://mirage.mx/wp-includes/js/jquery/jquery-migrate.min.js?ver=3.4.1">
    </script>
    <script id="file_uploads_nfpluginsettings-js-extra">
        var params = {
            "clearLogRestUrl": "https://mirage.mx/wp-json/nf-file-uploads/debug-log/delete-all",
            "clearLogButtonId": "file_uploads_clear_debug_logger",
            "downloadLogRestUrl": "https://mirage.mx/wp-json/nf-file-uploads/debug-log/get-all",
            "downloadLogButtonId": "file_uploads_download_debug_logger"
        };
        //# sourceURL=file_uploads_nfpluginsettings-js-extra
    </script>
    <script type="text/rocketlazyloadscript" id="file_uploads_nfpluginsettings-js"
        data-rocket-src="https://mirage.mx/wp-content/plugins/ninja-forms-uploads/assets/js/nfpluginsettings.js?ver=3.3.29"
        data-rocket-defer defer></script>
    <script data-wp-strategy="defer" defer id="wc-jquery-blockui-js"
        src="https://mirage.mx/wp-content/plugins/woocommerce/assets/js/jquery-blockui/jquery.blockUI.min.js?ver=2.7.0-wc.10.8.1">
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
    <script type="text/rocketlazyloadscript" data-wp-strategy="defer" defer id="wc-add-to-cart-js"
        data-rocket-src="https://mirage.mx/wp-content/plugins/woocommerce/assets/js/frontend/add-to-cart.min.js?ver=10.8.1">
    </script>
    <script type="text/rocketlazyloadscript" data-wp-strategy="defer" defer id="wc-js-cookie-js"
        data-rocket-src="https://mirage.mx/wp-content/plugins/woocommerce/assets/js/js-cookie/js.cookie.min.js?ver=2.1.4-wc.10.8.1">
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
    <script type="text/rocketlazyloadscript" data-wp-strategy="defer" defer id="woocommerce-js"
        data-rocket-src="https://mirage.mx/wp-content/plugins/woocommerce/assets/js/frontend/woocommerce.min.js?ver=10.8.1">
    </script>
    <script id="url-shortify-js-extra">
        var usParams = {
            "ajaxurl": "https://mirage.mx/wp-admin/admin-ajax.php"
        };
        //# sourceURL=url-shortify-js-extra
    </script>
    <script type="text/rocketlazyloadscript" id="url-shortify-js"
        data-rocket-src="https://mirage.mx/wp-content/plugins/url-shortify-premium/lite/dist/scripts/url-shortify.js?ver=2.4.1"
        data-rocket-defer defer></script>
    <link rel="https://api.w.org/" href="https://mirage.mx/wp-json/" />
    <link rel="alternate" title="JSON" type="application/json" href="https://mirage.mx/wp-json/wp/v2/pages/821" />
    <link rel="EditURI" type="application/rsd+xml" title="RSD" href="https://mirage.mx/xmlrpc.php?rsd" />
    <link rel="pingback" href="https://mirage.mx/xmlrpc.php" />
    <meta itemprop="name" content="Mirage México" />
    <meta itemprop="url" content="https://mirage.mx/" />
    <!-- Google tag (gtag.js) -->
    <script type="text/rocketlazyloadscript" async
        data-rocket-src="https://www.googletagmanager.com/gtag/js?id=G-1PL39TGXGK"></script>
    <script type="text/rocketlazyloadscript">
        window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-1PL39TGXGK');
</script> <!-- Facebook Pixel Code -->
    <script type="text/rocketlazyloadscript">
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
            background: url(https://www.mirage.mx/wp-content/uploads/2017/03/cropped-logo-aires-mirage.png) no-repeat !important;
        }
    </style>
    <!-- Google Tag Manager -->
    <script type="text/rocketlazyloadscript">(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
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
    <link rel="icon" href="https://mirage.mx/wp-content/uploads/2017/03/cropped-ms-icon-310x310-32x32.png"
        sizes="32x32" />
    <link rel="icon" href="https://mirage.mx/wp-content/uploads/2017/03/cropped-ms-icon-310x310-192x192.png"
        sizes="192x192" />
    <link rel="apple-touch-icon"
        href="https://mirage.mx/wp-content/uploads/2017/03/cropped-ms-icon-310x310-180x180.png" />
    <meta name="msapplication-TileImage"
        content="https://mirage.mx/wp-content/uploads/2017/03/cropped-ms-icon-310x310-270x270.png" />
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

<body
    class="home wp-singular page-template-default page page-id-821 wp-theme-genesis wp-child-theme-digital-pro theme-genesis woocommerce-no-js custom-header header-image header-full-width full-width-content genesis-title-hidden genesis-breadcrumbs-hidden genesis-footer-widgets-visible elementor-default elementor-kit-23667 front-page front-page-loop"
    itemscope itemtype="https://schema.org/WebPage">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T74BMF8F" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div class="site-container">
        <ul class="genesis-skip-link">
            <li><a href="#genesis-content" class="screen-reader-shortcut"> Saltar al contenido principal</a></li>
            <li><a href="#genesis-footer-widgets" class="screen-reader-shortcut"> Saltar al pie de página</a></li>
        </ul>
        <header class="site-header" itemscope itemtype="https://schema.org/WPHeader">
            <div class="wrap">
                <div class="title-area">
                    <p class="site-title" itemprop="headline"><a href="https://mirage.mx/">Mirage México</a></p>
                    <p class="site-description" itemprop="description">Marca especializada en aires acondicionados y
                        línea blanca.</p>
                </div>
                <nav class="nav-primary" aria-label="Principal" itemscope
                    itemtype="https://schema.org/SiteNavigationElement" id="genesis-nav-primary">
                    <div class="wrap">
                        <ul id="menu-header-menu" class="menu genesis-nav-menu menu-primary js-superfish">
                            <li id="menu-item-976"
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-821 current_page_item menu-item-976">
                                <a href="https://mirage.mx/" aria-current="page" itemprop="url"><span
                                        itemprop="name">Inicio</span></a></li>
                            <li id="menu-item-20281"
                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-has-children menu-item-20281">
                                <a href="https://mirage.mx/catalogo/todo/" itemprop="url"><span
                                        itemprop="name">Productos</span></a>
                                <ul class="sub-menu">
                                    <li id="menu-item-20282"
                                        class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-has-children menu-item-20282">
                                        <a href="https://mirage.mx/catalogo/todo/aire-acondicionado/"
                                            itemprop="url"><span itemprop="name">Aire Acondicionado</span></a>
                                        <ul class="sub-menu">
                                            <li id="menu-item-20285"
                                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-has-children menu-item-20285">
                                                <a href="https://mirage.mx/catalogo/todo/aire-acondicionado/minisplit/"
                                                    itemprop="url"><span itemprop="name">Minisplit</span></a>
                                                <ul class="sub-menu">
                                                    <li id="menu-item-20286"
                                                        class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-20286">
                                                        <a href="https://mirage.mx/catalogo/todo/aire-acondicionado/minisplit/inverter/"
                                                            itemprop="url"><span itemprop="name">Inverter</span></a>
                                                    </li>
                                                    <li id="menu-item-20287"
                                                        class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-20287">
                                                        <a href="https://mirage.mx/catalogo/todo/aire-acondicionado/minisplit/on-off/"
                                                            itemprop="url"><span itemprop="name">On / Off</span></a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li id="menu-item-20284"
                                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-20284">
                                                <a href="https://mirage.mx/catalogo/todo/aire-acondicionado/de-ventana/"
                                                    itemprop="url"><span itemprop="name">De Ventana</span></a></li>
                                            <li id="menu-item-20299"
                                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-20299">
                                                <a href="https://mirage.mx/catalogo/todo/aire-acondicionado/portatiles/"
                                                    itemprop="url"><span itemprop="name">Portátiles</span></a></li>
                                            <li id="menu-item-23639"
                                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-has-children menu-item-23639">
                                                <a href="https://mirage.mx/catalogo/todo/aire-acondicionado/comercial/"
                                                    itemprop="url"><span itemprop="name">Comercial</span></a>
                                                <ul class="sub-menu">
                                                    <li id="menu-item-20289"
                                                        class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-20289">
                                                        <a href="https://mirage.mx/catalogo/todo/aire-acondicionado/comercial/rvi/"
                                                            itemprop="url"><span itemprop="name">RVI (VRF)</span></a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li id="menu-item-20283"
                                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-has-children menu-item-20283">
                                                <a href="https://mirage.mx/catalogo/todo/aire-acondicionado/comercial-ligero/"
                                                    itemprop="url"><span itemprop="name">Comercial Ligero</span></a>
                                                <ul class="sub-menu">
                                                    <li id="menu-item-23652"
                                                        class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-23652">
                                                        <a href="https://mirage.mx/catalogo/todo/aire-acondicionado/comercial-ligero/ci-magnum/"
                                                            itemprop="url"><span itemprop="name">Ci Magnum</span></a>
                                                    </li>
                                                    <li id="menu-item-20288"
                                                        class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-20288">
                                                        <a href="https://mirage.mx/catalogo/todo/aire-acondicionado/multisplit/"
                                                            itemprop="url"><span itemprop="name">Multisplit
                                                                XMI</span></a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li id="menu-item-20291"
                                        class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-has-children menu-item-20291">
                                        <a href="https://mirage.mx/catalogo/todo/linea-blanca/" itemprop="url"><span
                                                itemprop="name">Línea Blanca</span></a>
                                        <ul class="sub-menu">
                                            <li id="menu-item-20295"
                                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-20295">
                                                <a href="https://mirage.mx/catalogo/todo/linea-blanca/lavadoras-y-secadoras/"
                                                    itemprop="url"><span itemprop="name">Lavadoras y
                                                        secadoras</span></a></li>
                                            <li id="menu-item-20292"
                                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-20292">
                                                <a href="https://mirage.mx/catalogo/todo/linea-blanca/boilers/"
                                                    itemprop="url"><span itemprop="name">Calentadores de Agua</span></a>
                                            </li>
                                            <li id="menu-item-20297"
                                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-20297">
                                                <a href="https://mirage.mx/catalogo/todo/linea-blanca/parrillas/"
                                                    itemprop="url"><span itemprop="name">Parrillas</span></a></li>
                                            <li id="menu-item-20293"
                                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-20293">
                                                <a href="https://mirage.mx/catalogo/todo/linea-blanca/campanas/"
                                                    itemprop="url"><span itemprop="name">Campanas</span></a></li>
                                            <li id="menu-item-20298"
                                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-20298">
                                                <a href="https://mirage.mx/catalogo/todo/linea-blanca/purificadores-y-dispensadores-de-agua/"
                                                    itemprop="url"><span itemprop="name">Purificadores y
                                                        Dispensadores</span></a></li>
                                            <li id="menu-item-22876"
                                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-22876">
                                                <a href="https://mirage.mx/catalogo/todo/linea-blanca/frigobares/"
                                                    itemprop="url"><span itemprop="name">Frigobares</span></a></li>
                                            <li id="menu-item-22886"
                                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-22886">
                                                <a href="https://mirage.mx/catalogo/todo/linea-blanca/refrigeradores/"
                                                    itemprop="url"><span itemprop="name">Refrigeradores</span></a></li>
                                            <li id="menu-item-21763"
                                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-21763">
                                                <a href="https://mirage.mx/catalogo/todo/linea-blanca/congeladores/"
                                                    itemprop="url"><span itemprop="name">Congeladores</span></a></li>
                                            <li id="menu-item-23812"
                                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-23812">
                                                <a href="https://mirage.mx/catalogo/todo/linea-blanca/microondas/"
                                                    itemprop="url"><span itemprop="name">Microondas</span></a></li>
                                            <li id="menu-item-27470"
                                                class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-27470">
                                                <a href="https://mirage.mx/catalogo/todo/linea-blanca/purificadores-de-aire/"
                                                    itemprop="url"><span itemprop="name">Purificadores de
                                                        Aire</span></a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li id="menu-item-29630"
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-29630"><a
                                    href="https://mirage.mx/ubicaciones/" itemprop="url"><span
                                        itemprop="name">Ubicaciones</span></a></li>
                            <li id="menu-item-1273"
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1273"><a
                                    href="https://mirage.mx/soporte/" itemprop="url"><span
                                        itemprop="name">Soporte</span></a></li>
                            <li id="menu-item-1255"
                                class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-has-children menu-item-1255">
                                <a href="https://mirage.mx/comunicacion/sala/" itemprop="url"><span
                                        itemprop="name">Mirage</span></a>
                                <ul class="sub-menu">
                                    <li id="menu-item-21797"
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-21797">
                                        <a href="https://mirage.mx/corporativo/como-ser-distribuidor-mirage/"
                                            itemprop="url"><span itemprop="name">¿Cómo ser distribuidor?</span></a></li>
                                    <li id="menu-item-21796"
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-21796">
                                        <a href="https://mirage.mx/corporativo/como-ser-centro-de-servicio/"
                                            itemprop="url"><span itemprop="name">¿Como ser centro de
                                                servicio?</span></a></li>
                                    <li id="menu-item-23968"
                                        class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-23968">
                                        <a href="https://mirage.mx/comunicacion/blog/" itemprop="url"><span
                                                itemprop="name">Mirage Blog</span></a></li>
                                </ul>
                            </li>
                            <li id="menu-item-3471"
                                class="btn-tienda menu-item menu-item-type-custom menu-item-object-custom menu-item-3471">
                                <a target="_blank" href="https://www.tiendamirage.mx/" itemprop="url"><span
                                        itemprop="name">Tienda Mirage</span></a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <div data-elementor-type="container" data-elementor-id="23732" class="elementor elementor-23732"
            data-elementor-post-type="elementor_library">
            <div class="elementor-element elementor-element-1f324697 e-con-full e-flex e-con e-parent"
                data-id="1f324697" data-element_type="container" data-e-type="container">
                <div class="elementor-element elementor-element-4c8447be e-flex e-con-boxed e-con e-child"
                    data-id="4c8447be" data-element_type="container" data-e-type="container"
                    data-settings="{&quot;background_background&quot;:&quot;gradient&quot;}">
                    <div class="e-con-inner">
                        <div class="elementor-element elementor-element-3cc77086 e-con-full e-flex e-con e-child"
                            data-id="3cc77086" data-element_type="container" data-e-type="container">
                            <div class="elementor-element elementor-element-3dc87701 elementor-widget elementor-widget-spacer"
                                data-id="3dc87701" data-element_type="widget" data-e-type="widget"
                                data-widget_type="spacer.default">
                                <div class="elementor-widget-container">
                                    <div class="elementor-spacer">
                                        <div class="elementor-spacer-inner"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="elementor-element elementor-element-822efad elementor-headline--style-rotate elementor-widget elementor-widget-animated-headline"
                                data-id="822efad" data-element_type="widget" data-e-type="widget"
                                data-settings="{&quot;rotating_text&quot;:&quot;INVERTER\nMODERNA\nCONFIABLE&quot;,&quot;headline_style&quot;:&quot;rotate&quot;,&quot;animation_type&quot;:&quot;slide&quot;,&quot;loop&quot;:&quot;yes&quot;,&quot;rotate_iteration_delay&quot;:2500}"
                                data-widget_type="animated-headline.default">
                                <div class="elementor-widget-container">
                                    <h3 class="elementor-headline elementor-headline-animation-type-slide">
                                        <span
                                            class="elementor-headline-plain-text elementor-headline-text-wrapper">TECNOLOGÍA</span>
                                        <span
                                            class="elementor-headline-dynamic-wrapper elementor-headline-text-wrapper">
                                            <span
                                                class="elementor-headline-dynamic-text elementor-headline-text-active">
                                                INVERTER </span>
                                            <span class="elementor-headline-dynamic-text">
                                                MODERNA </span>
                                            <span class="elementor-headline-dynamic-text">
                                                CONFIABLE </span>
                                        </span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-a22619c e-flex e-con-boxed e-con e-child"
                            data-id="a22619c" data-element_type="container" data-e-type="container">
                            <div class="e-con-inner">
                                <div class="elementor-element elementor-element-7c2a0e47 elementor-widget elementor-widget-image"
                                    data-id="7c2a0e47" data-element_type="widget" data-e-type="widget"
                                    data-widget_type="image.default">
                                    <div class="elementor-widget-container">
                                        <img fetchpriority="high" width="1210" height="783"
                                            src="https://mirage.mx/wp-content/uploads/2023/07/mirage_magnum22.webp"
                                            class="attachment-full size-full wp-image-23692" alt=""
                                            srcset="https://mirage.mx/wp-content/uploads/2023/07/mirage_magnum22.webp 1210w, https://mirage.mx/wp-content/uploads/2023/07/mirage_magnum22-300x194.webp 300w, https://mirage.mx/wp-content/uploads/2023/07/mirage_magnum22-1024x663.webp 1024w, https://mirage.mx/wp-content/uploads/2023/07/mirage_magnum22-768x497.webp 768w, https://mirage.mx/wp-content/uploads/2023/07/mirage_magnum22-670x434.webp 670w"
                                            sizes="(max-width: 1210px) 100vw, 1210px" /> </div>
                                </div>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-3735e9f6 e-grid e-con-boxed e-con e-child"
                            data-id="3735e9f6" data-element_type="container" data-e-type="container"
                            data-settings="{&quot;motion_fx_motion_fx_scrolling&quot;:&quot;yes&quot;,&quot;motion_fx_translateY_effect&quot;:&quot;yes&quot;,&quot;motion_fx_translateY_speed&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:4,&quot;sizes&quot;:[]},&quot;motion_fx_translateY_affectedRange&quot;:{&quot;unit&quot;:&quot;%&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:{&quot;start&quot;:0,&quot;end&quot;:100}},&quot;motion_fx_devices&quot;:[&quot;desktop&quot;,&quot;tablet&quot;,&quot;mobile&quot;]}">
                            <div class="e-con-inner">
                                <div class="elementor-element elementor-element-5a5b1ae5 elementor-tablet-position-inline-end elementor-view-default elementor-position-block-start elementor-mobile-position-block-start elementor-widget elementor-widget-icon-box"
                                    data-id="5a5b1ae5" data-element_type="widget" data-e-type="widget"
                                    data-widget_type="icon-box.default">
                                    <div class="elementor-widget-container">
                                        <div class="elementor-icon-box-wrapper">

                                            <div class="elementor-icon-box-icon">
                                                <a href="https://mirage.mx/productos/todo/aire-acondicionado/minisplit/inverter/magnum-22-inverter/"
                                                    class="elementor-icon" tabindex="-1">
                                                    <i aria-hidden="true" class="fas fa-info-circle"></i> </a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-7de0e952 elementor-view-default elementor-position-block-start elementor-mobile-position-block-start elementor-widget elementor-widget-icon-box"
                                    data-id="7de0e952" data-element_type="widget" data-e-type="widget"
                                    data-widget_type="icon-box.default">
                                    <div class="elementor-widget-container">
                                        <div class="elementor-icon-box-wrapper">

                                            <div class="elementor-icon-box-icon">
                                                <a href="https://mirage.mx/ubicaciones/tiendas-oficiales/"
                                                    class="elementor-icon" tabindex="-1">
                                                    <i aria-hidden="true" class="fas fa-shopping-cart"></i> </a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-6aa951de elementor-widget elementor-widget-spacer"
                            data-id="6aa951de" data-element_type="widget" data-e-type="widget"
                            data-widget_type="spacer.default">
                            <div class="elementor-widget-container">
                                <div class="elementor-spacer">
                                    <div class="elementor-spacer-inner"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="elementor-element elementor-element-5fbfb193 e-flex e-con-boxed e-con e-child"
                    data-id="5fbfb193" data-element_type="container" data-e-type="container"
                    data-settings="{&quot;background_background&quot;:&quot;gradient&quot;}">
                    <div class="e-con-inner">
                        <div class="elementor-element elementor-element-1302c606 e-flex e-con-boxed e-con e-child"
                            data-id="1302c606" data-element_type="container" data-e-type="container"
                            data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                            <div class="e-con-inner">
                                <div class="elementor-element elementor-element-5fa3a384 elementor-widget elementor-widget-image"
                                    data-id="5fa3a384" data-element_type="widget" data-e-type="widget"
                                    data-settings="{&quot;sticky&quot;:&quot;bottom&quot;,&quot;sticky_on&quot;:[&quot;desktop&quot;,&quot;tablet&quot;,&quot;mobile&quot;],&quot;sticky_offset&quot;:0,&quot;sticky_effects_offset&quot;:0,&quot;sticky_anchor_link_offset&quot;:0}"
                                    data-widget_type="image.default">
                                    <div class="elementor-widget-container">
                                        <img fetchpriority="high"
                                            src="https://mirage.mx/wp-content/uploads/2023/07/followme_cover.webp"
                                            title="Mirage: Función Sígueme" alt="Mirage: Función Sígueme" /> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="elementor-element elementor-element-4c4de495 e-con-full e-flex e-con e-child"
                    data-id="4c4de495" data-element_type="container" data-e-type="container"
                    data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;background_motion_fx_motion_fx_scrolling&quot;:&quot;yes&quot;,&quot;background_motion_fx_scale_effect&quot;:&quot;yes&quot;,&quot;background_motion_fx_scale_direction&quot;:&quot;in-out&quot;,&quot;background_motion_fx_scale_speed&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:4,&quot;sizes&quot;:[]},&quot;background_motion_fx_scale_range&quot;:{&quot;unit&quot;:&quot;%&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:{&quot;start&quot;:20,&quot;end&quot;:80}},&quot;background_motion_fx_devices&quot;:[&quot;desktop&quot;,&quot;tablet&quot;,&quot;mobile&quot;]}">
                    <div class="elementor-element elementor-element-042eac0 elementor-widget elementor-widget-spacer"
                        data-id="042eac0" data-element_type="widget" data-e-type="widget"
                        data-widget_type="spacer.default">
                        <div class="elementor-widget-container">
                            <div class="elementor-spacer">
                                <div class="elementor-spacer-inner"></div>
                            </div>
                        </div>
                    </div>
                    <div class="elementor-element elementor-element-9e20854 elementor-widget elementor-widget-ucaddon_blox_play_button"
                        data-id="9e20854" data-element_type="widget" data-e-type="widget"
                        data-widget_type="ucaddon_blox_play_button.default">
                        <div class="elementor-widget-container">

                            <!-- start Video Play Button -->
                            <link id='font-awesome-css'
                                href='https://mirage.mx/wp-content/plugins/unlimited-elements-for-elementor-premium/assets_libraries/font-awesome6/fontawesome-all.min.css'
                                type='text/css' rel='stylesheet'>
                            <link id='font-awesome-4-shim-css'
                                href='https://mirage.mx/wp-content/plugins/unlimited-elements-for-elementor-premium/assets_libraries/font-awesome6/fontawesome-v4-shims.min.css'
                                type='text/css' rel='stylesheet'>
                            <link id='lity-css'
                                href='https://mirage.mx/wp-content/plugins/unlimited-elements-for-elementor-premium/assets_libraries/lity/lity.min.css'
                                type='text/css' rel='stylesheet'>

                            <style>
                                /* widget: Video Play Button */

                                #uc_blox_play_button_elementor_9e20854 {
                                    width: 100%;
                                }

                                .container_uc_blox_play_button_elementor_9e20854 {
                                    display: flex;
                                    justify-content: center;
                                }

                                #uc_blox_play_button_elementor_9e20854 a {
                                    display: inline-block;
                                    transition: 0.5s;
                                    text-decoration: none;
                                }

                                .ue_play_button {
                                    text-align: center;
                                }

                                #uc_blox_play_button_elementor_9e20854 a:hover {
                                    transform: scale(1.1, 1.1);
                                }

                                #uc_blox_play_button_elementor_9e20854 a span.video-button {
                                    display: inline-block;
                                    align-items: center;
                                    justify-content: center;
                                    flex-direction: column;
                                    display: flex;
                                    position: relative;
                                    transition: 0.3s;
                                    line-height: 1em;
                                }

                                .ue-play-bg {
                                    background-size: cover;
                                    background-position: center;
                                    background-repeat: none;
                                    max-width: 100%;
                                }

                                #uc_blox_play_button_elementor_9e20854 a span.video-button svg {
                                    height: 1em;
                                    width: 1em;
                                }

                                #uc_blox_play_button_elementor_9e20854 i {

                                    vertical-align: middle;
                                    transition: 0.3s;
                                }

                                #uc_blox_play_button_elementor_9e20854 a span:before {
                                    content: '';
                                    display: inline-block;
                                    position: absolute;
                                    top: -2px;
                                    left: -2px;
                                    bottom: -2px;
                                    right: -2px;
                                    border-radius: inherit;
                                    border: 1px solid #000000;
                                    -webkit-animation: btnIconRipple 2s cubic-bezier(0.23, 1, 0.32, 1) both infinite;
                                    animation: btnIconRipple 2s cubic-bezier(0.23, 1, 0.32, 1) both infinite;
                                    border-color: #000000;
                                }

                                @keyframes btnIconRipple {
                                    0% {
                                        border-width: 4px;
                                        transform: scale(1);
                                    }

                                    80% {
                                        border-width: 1px;
                                        transform: scale(1.35);
                                    }

                                    100% {
                                        opacity: 0;
                                    }
                                }












                                .button_uc_blox_play_button_elementor_9e20854 {
                                    animation: ue-video-popup-waggle 5s infinite;
                                }

                                @keyframes ue-video-popup-waggle {
                                    0% {
                                        transform: none;
                                    }

                                    10% {
                                        transform: rotateZ(-20deg) scale(1.2);
                                    }

                                    13% {
                                        transform: rotateZ(25deg) scale(1.2);
                                    }

                                    15% {
                                        transform: rotateZ(-15deg) scale(1.2);
                                    }

                                    17% {
                                        transform: rotateZ(15deg) scale(1.2);
                                    }

                                    20% {
                                        transform: rotateZ(-12deg) scale(1.2);
                                    }

                                    22% {
                                        transform: rotateZ(0) scale(1.2);
                                    }

                                    25%,
                                    100% {
                                        transform: rotateZ(0) scale(1);
                                    }
                                }
                            </style>

                            <div id="uc_blox_play_button_elementor_9e20854" class="ue_play_button"
                                data-path="self_hosted">
                                <a href="https://c5k4h6e2.rocketcdn.me/wp-content/uploads/2023/04/magnum22_720p@2mbps.mp4"
                                    class="button_uc_blox_play_button_elementor_9e20854" data-lity>
                                    <span class="video-button">
                                        <i class='fas fa-play'></i>
                                    </span>
                                </a>
                            </div>

                            <!-- end Video Play Button -->
                        </div>
                    </div>
                    <div class="elementor-element elementor-element-fae21c1 elementor-widget elementor-widget-spacer"
                        data-id="fae21c1" data-element_type="widget" data-e-type="widget"
                        data-widget_type="spacer.default">
                        <div class="elementor-widget-container">
                            <div class="elementor-spacer">
                                <div class="elementor-spacer-inner"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="elementor-element elementor-element-037944a e-flex e-con-boxed e-con e-child"
                    data-id="037944a" data-element_type="container" data-e-type="container"
                    data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                    <div class="e-con-inner">
                        <div class="elementor-element elementor-element-6b47a5d elementor-widget elementor-widget-spacer"
                            data-id="6b47a5d" data-element_type="widget" data-e-type="widget"
                            data-widget_type="spacer.default">
                            <div class="elementor-widget-container">
                                <div class="elementor-spacer">
                                    <div class="elementor-spacer-inner"></div>
                                </div>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-23962cf e-con-full e-flex e-con e-child"
                            data-id="23962cf" data-element_type="container" data-e-type="container">
                            <div class="elementor-element elementor-element-9b82e7c e-con-full e-grid e-con e-child"
                                data-id="9b82e7c" data-element_type="container" data-e-type="container">
                                <div class="elementor-element elementor-element-6382ffb elementor-widget elementor-widget-image"
                                    data-id="6382ffb" data-element_type="widget" data-e-type="widget"
                                    data-widget_type="image.default">
                                    <div class="elementor-widget-container">
                                        <a href="//mirage.mx/catalogo/todo/aire-acondicionado/minisplit/on-off/">
                                            <img width="563" height="679"
                                                src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20563%20679'%3E%3C/svg%3E"
                                                class="attachment-full size-full wp-image-23697" alt=""
                                                data-lazy-srcset="https://mirage.mx/wp-content/uploads/2023/07/equipos_convencionales_mirage.webp 563w, https://mirage.mx/wp-content/uploads/2023/07/equipos_convencionales_mirage-249x300.webp 249w"
                                                data-lazy-sizes="(max-width: 563px) 100vw, 563px"
                                                data-lazy-src="https://mirage.mx/wp-content/uploads/2023/07/equipos_convencionales_mirage.webp" /><noscript><img
                                                    width="563" height="679"
                                                    src="https://mirage.mx/wp-content/uploads/2023/07/equipos_convencionales_mirage.webp"
                                                    class="attachment-full size-full wp-image-23697" alt=""
                                                    srcset="https://mirage.mx/wp-content/uploads/2023/07/equipos_convencionales_mirage.webp 563w, https://mirage.mx/wp-content/uploads/2023/07/equipos_convencionales_mirage-249x300.webp 249w"
                                                    sizes="(max-width: 563px) 100vw, 563px" /></noscript> </a>
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-9f532ac elementor-widget elementor-widget-image"
                                    data-id="9f532ac" data-element_type="widget" data-e-type="widget"
                                    data-widget_type="image.default">
                                    <div class="elementor-widget-container">
                                        <a href="//mirage.mx/catalogo/todo/aire-acondicionado/comercial-ligero/">
                                            <img width="563" height="679"
                                                src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20563%20679'%3E%3C/svg%3E"
                                                class="attachment-full size-full wp-image-23698" alt=""
                                                data-lazy-srcset="https://mirage.mx/wp-content/uploads/2023/07/equipos_comercial_ligero_mirage.webp 563w, https://mirage.mx/wp-content/uploads/2023/07/equipos_comercial_ligero_mirage-249x300.webp 249w"
                                                data-lazy-sizes="(max-width: 563px) 100vw, 563px"
                                                data-lazy-src="https://mirage.mx/wp-content/uploads/2023/07/equipos_comercial_ligero_mirage.webp" /><noscript><img
                                                    loading="lazy" width="563" height="679"
                                                    src="https://mirage.mx/wp-content/uploads/2023/07/equipos_comercial_ligero_mirage.webp"
                                                    class="attachment-full size-full wp-image-23698" alt=""
                                                    srcset="https://mirage.mx/wp-content/uploads/2023/07/equipos_comercial_ligero_mirage.webp 563w, https://mirage.mx/wp-content/uploads/2023/07/equipos_comercial_ligero_mirage-249x300.webp 249w"
                                                    sizes="(max-width: 563px) 100vw, 563px" /></noscript> </a>
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-1f5ce5c elementor-widget elementor-widget-image"
                                    data-id="1f5ce5c" data-element_type="widget" data-e-type="widget"
                                    data-widget_type="image.default">
                                    <div class="elementor-widget-container">
                                        <a href="//mirage.mx/catalogo/todo/linea-blanca/">
                                            <img width="563" height="679"
                                                src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20563%20679'%3E%3C/svg%3E"
                                                class="attachment-full size-full wp-image-23699" alt=""
                                                data-lazy-srcset="https://mirage.mx/wp-content/uploads/2023/07/linea_blanca_mirage.webp 563w, https://mirage.mx/wp-content/uploads/2023/07/linea_blanca_mirage-249x300.webp 249w"
                                                data-lazy-sizes="(max-width: 563px) 100vw, 563px"
                                                data-lazy-src="https://mirage.mx/wp-content/uploads/2023/07/linea_blanca_mirage.webp" /><noscript><img
                                                    loading="lazy" width="563" height="679"
                                                    src="https://mirage.mx/wp-content/uploads/2023/07/linea_blanca_mirage.webp"
                                                    class="attachment-full size-full wp-image-23699" alt=""
                                                    srcset="https://mirage.mx/wp-content/uploads/2023/07/linea_blanca_mirage.webp 563w, https://mirage.mx/wp-content/uploads/2023/07/linea_blanca_mirage-249x300.webp 249w"
                                                    sizes="(max-width: 563px) 100vw, 563px" /></noscript> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="elementor-element elementor-element-f707f02 e-con-full e-flex e-con e-child"
                    data-id="f707f02" data-element_type="container" data-e-type="container"
                    data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                    <div class="elementor-element elementor-element-ab7ff4b elementor-widget elementor-widget-spacer"
                        data-id="ab7ff4b" data-element_type="widget" data-e-type="widget"
                        data-widget_type="spacer.default">
                        <div class="elementor-widget-container">
                            <div class="elementor-spacer">
                                <div class="elementor-spacer-inner"></div>
                            </div>
                        </div>
                    </div>
                    <div class="elementor-element elementor-element-5247561 e-con-full e-flex e-con e-child"
                        data-id="5247561" data-element_type="container" data-e-type="container">
                        <div class="elementor-element elementor-element-43b4861 e-grid e-con-boxed e-con e-child"
                            data-id="43b4861" data-element_type="container" data-e-type="container">
                            <div class="e-con-inner">
                                <div class="elementor-element elementor-element-d61b81e elementor-flip-box--effect-flip elementor-flip-box--direction-up elementor-widget elementor-widget-flip-box"
                                    data-id="d61b81e" data-element_type="widget" data-e-type="widget"
                                    data-widget_type="flip-box.default">
                                    <div class="elementor-widget-container">
                                        <div class="elementor-flip-box" tabindex="0">
                                            <div class="elementor-flip-box__layer elementor-flip-box__front">
                                                <div class="elementor-flip-box__layer__overlay">
                                                    <div class="elementor-flip-box__layer__inner">
                                                        <div class="elementor-icon-wrapper elementor-view-default">
                                                            <div class="elementor-icon">
                                                                <i aria-hidden="true" class="fas fa-tools"></i> </div>
                                                        </div>

                                                        <h3 class="elementor-flip-box__layer__title">
                                                            Sobre la instalación </h3>

                                                        <div class="elementor-flip-box__layer__description">
                                                            Si compró su equipo en una tienda departamental o de
                                                            autoservicio que incluía el servicio de instalación gratis
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="elementor-flip-box__layer elementor-flip-box__back">
                                                <div class="elementor-flip-box__layer__overlay">
                                                    <div class="elementor-flip-box__layer__inner">
                                                        <h3 class="elementor-flip-box__layer__title">
                                                            Programe su visita </h3>

                                                        <div class="elementor-flip-box__layer__description">
                                                            www.instalamirage.com </div>

                                                        <a class="elementor-flip-box__button elementor-button elementor-size-sm"
                                                            href="https://www.instalamirage.com">
                                                            Clic Aquí </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-a03f919 elementor-flip-box--effect-flip elementor-flip-box--direction-up elementor-widget elementor-widget-flip-box"
                                    data-id="a03f919" data-element_type="widget" data-e-type="widget"
                                    data-widget_type="flip-box.default">
                                    <div class="elementor-widget-container">
                                        <div class="elementor-flip-box" tabindex="0">
                                            <div class="elementor-flip-box__layer elementor-flip-box__front">
                                                <div class="elementor-flip-box__layer__overlay">
                                                    <div class="elementor-flip-box__layer__inner">
                                                        <div class="elementor-icon-wrapper elementor-view-default">
                                                            <div class="elementor-icon">
                                                                <i aria-hidden="true" class="fas fa-diagnoses"></i>
                                                            </div>
                                                        </div>

                                                        <h3 class="elementor-flip-box__layer__title">
                                                            Garantía y Soporte </h3>

                                                        <div class="elementor-flip-box__layer__description">
                                                            El departamento de garantías atiende las reclamaciones a
                                                            través de los centros de servicio de los distribuidores.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="elementor-flip-box__layer elementor-flip-box__back">
                                                <div class="elementor-flip-box__layer__overlay">
                                                    <div class="elementor-flip-box__layer__inner">
                                                        <h3 class="elementor-flip-box__layer__title">
                                                            Inicie una solicitud de servicio </h3>

                                                        <div class="elementor-flip-box__layer__description">
                                                            Por favor dé "clic" en el siguiente botón y complete el
                                                            formulario. </div>

                                                        <a class="elementor-flip-box__button elementor-button elementor-size-sm"
                                                            href="https://b2b.mirage.mx/defaultv1.aspx?_m_=POSTVENTAFP1&#038;d=SX1&#038;tt=3D7FC03E-EBF1-471D-9105-B337AA1BFC35">
                                                            Clic Aquí </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-72620e4 elementor-flip-box--effect-flip elementor-flip-box--direction-up elementor-widget elementor-widget-flip-box"
                                    data-id="72620e4" data-element_type="widget" data-e-type="widget"
                                    data-widget_type="flip-box.default">
                                    <div class="elementor-widget-container">
                                        <div class="elementor-flip-box" tabindex="0">
                                            <div class="elementor-flip-box__layer elementor-flip-box__front">
                                                <div class="elementor-flip-box__layer__overlay">
                                                    <div class="elementor-flip-box__layer__inner">
                                                        <div class="elementor-icon-wrapper elementor-view-default">
                                                            <div class="elementor-icon">
                                                                <i aria-hidden="true" class="fas fa-map-marked-alt"></i>
                                                            </div>
                                                        </div>

                                                        <h3 class="elementor-flip-box__layer__title">
                                                            ¿Dónde estamos? </h3>

                                                        <div class="elementor-flip-box__layer__description">
                                                            Contamos con varios almacenes de distribucion de fábrica,
                                                            tiendas oficiales, puntos de venta y centros de servicio.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="elementor-flip-box__layer elementor-flip-box__back">
                                                <div class="elementor-flip-box__layer__overlay">
                                                    <div class="elementor-flip-box__layer__inner">
                                                        <h3 class="elementor-flip-box__layer__title">
                                                            Localízenos </h3>

                                                        <div class="elementor-flip-box__layer__description">
                                                            Puede encontrar ayuda en nuestro directorio de ubicaciones
                                                            para <a href="//mirage.mx/ubicaciones/tiendas-oficiales/"
                                                                style="color:white;background-color:#000;padding:.5em;border-radius:.2em">Tiendas
                                                                Oficiales</a>, <a
                                                                href="//mirage.mx/ubicaciones/distribuidores/"
                                                                style="color:white;background-color:#000;padding:.5em;border-radius:.2em">Distribuidores
                                                                Mayoristas</a> y <a
                                                                href="//mirage.mx/ubicaciones/centros-de-servicio/"
                                                                style="color:white;background-color:#000;padding:.5em;border-radius:.2em">Centros
                                                                de Servicio</a>. </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="elementor-element elementor-element-c686b0f elementor-widget elementor-widget-spacer"
                        data-id="c686b0f" data-element_type="widget" data-e-type="widget"
                        data-widget_type="spacer.default">
                        <div class="elementor-widget-container">
                            <div class="elementor-spacer">
                                <div class="elementor-spacer-inner"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="elementor-element elementor-element-7903df13 e-con-full e-flex e-con e-child"
                    data-id="7903df13" data-element_type="container" data-e-type="container"
                    data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                    <div class="elementor-element elementor-element-8fba461 elementor-widget elementor-widget-shortcode"
                        data-id="8fba461" data-element_type="widget" data-e-type="widget"
                        data-widget_type="shortcode.default">
                        <div class="elementor-widget-container">
                            <div class="elementor-shortcode">
                                <div class="su-image-carousel  fpb-carousel su-image-carousel-columns-2 su-image-carousel-adaptive su-image-carousel-slides-style-minimal su-image-carousel-controls-style-light su-image-carousel-align-center"
                                    style="max-width:2560px"
                                    data-flickity-options='{"groupCells":true,"cellSelector":".su-image-carousel-item","adaptiveHeight":true,"cellAlign":"left","prevNextButtons":true,"pageDots":false,"autoPlay":15000,"imagesLoaded":true,"contain":false,"selectedAttraction":0.025000000000000001387778780781445675529539585113525390625,"friction":0.2800000000000000266453525910037569701671600341796875}'
                                    id="su_image_carousel_6a316b792df5d">
                                    <div class="su-image-carousel-item">
                                        <div class="su-image-carousel-item-content"><a
                                                href="https://especialistas.mirage.mx" target="_blank"
                                                rel="noopener noreferrer" data-caption=""><img width="1135" height="738"
                                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%201135%20738'%3E%3C/svg%3E"
                                                    class="" alt="" decoding="async"
                                                    data-lazy-srcset="https://mirage.mx/wp-content/uploads/2023/07/especialistas_mirage_web.webp 1135w, https://mirage.mx/wp-content/uploads/2023/07/especialistas_mirage_web-300x195.webp 300w, https://mirage.mx/wp-content/uploads/2023/07/especialistas_mirage_web-1024x666.webp 1024w, https://mirage.mx/wp-content/uploads/2023/07/especialistas_mirage_web-768x499.webp 768w, https://mirage.mx/wp-content/uploads/2023/07/especialistas_mirage_web-670x436.webp 670w"
                                                    data-lazy-sizes="(max-width: 1135px) 100vw, 1135px"
                                                    data-lazy-src="https://mirage.mx/wp-content/uploads/2023/07/especialistas_mirage_web.webp" /><noscript><img
                                                        loading="lazy" width="1135" height="738"
                                                        src="https://mirage.mx/wp-content/uploads/2023/07/especialistas_mirage_web.webp"
                                                        class="" alt="" decoding="async"
                                                        srcset="https://mirage.mx/wp-content/uploads/2023/07/especialistas_mirage_web.webp 1135w, https://mirage.mx/wp-content/uploads/2023/07/especialistas_mirage_web-300x195.webp 300w, https://mirage.mx/wp-content/uploads/2023/07/especialistas_mirage_web-1024x666.webp 1024w, https://mirage.mx/wp-content/uploads/2023/07/especialistas_mirage_web-768x499.webp 768w, https://mirage.mx/wp-content/uploads/2023/07/especialistas_mirage_web-670x436.webp 670w"
                                                        sizes="(max-width: 1135px) 100vw, 1135px" /></noscript></a>
                                        </div>
                                    </div>
                                    <div class="su-image-carousel-item">
                                        <div class="su-image-carousel-item-content"><a
                                                href="mailto:lizethg@airesmirage.com" target="_blank"
                                                rel="noopener noreferrer" data-caption=""><img width="1135" height="738"
                                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%201135%20738'%3E%3C/svg%3E"
                                                    class="" alt="" decoding="async"
                                                    data-lazy-srcset="https://mirage.mx/wp-content/uploads/2023/07/oportunidades_mirage.webp 1135w, https://mirage.mx/wp-content/uploads/2023/07/oportunidades_mirage-300x195.webp 300w, https://mirage.mx/wp-content/uploads/2023/07/oportunidades_mirage-1024x666.webp 1024w, https://mirage.mx/wp-content/uploads/2023/07/oportunidades_mirage-768x499.webp 768w, https://mirage.mx/wp-content/uploads/2023/07/oportunidades_mirage-670x436.webp 670w"
                                                    data-lazy-sizes="(max-width: 1135px) 100vw, 1135px"
                                                    data-lazy-src="https://mirage.mx/wp-content/uploads/2023/07/oportunidades_mirage.webp" /><noscript><img
                                                        loading="lazy" width="1135" height="738"
                                                        src="https://mirage.mx/wp-content/uploads/2023/07/oportunidades_mirage.webp"
                                                        class="" alt="" decoding="async"
                                                        srcset="https://mirage.mx/wp-content/uploads/2023/07/oportunidades_mirage.webp 1135w, https://mirage.mx/wp-content/uploads/2023/07/oportunidades_mirage-300x195.webp 300w, https://mirage.mx/wp-content/uploads/2023/07/oportunidades_mirage-1024x666.webp 1024w, https://mirage.mx/wp-content/uploads/2023/07/oportunidades_mirage-768x499.webp 768w, https://mirage.mx/wp-content/uploads/2023/07/oportunidades_mirage-670x436.webp 670w"
                                                        sizes="(max-width: 1135px) 100vw, 1135px" /></noscript></a>
                                        </div>
                                    </div>
                                </div>
                                <script type="text/rocketlazyloadscript" id="su_image_carousel_6a316b792df5d_script">
                                    if(window.SUImageCarousel){setTimeout(function() {window.SUImageCarousel.initGallery(document.getElementById("su_image_carousel_6a316b792df5d"))}, 0);}var su_image_carousel_6a316b792df5d_script=document.getElementById("su_image_carousel_6a316b792df5d_script");if(su_image_carousel_6a316b792df5d_script){su_image_carousel_6a316b792df5d_script.parentNode.removeChild(su_image_carousel_6a316b792df5d_script);}
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h2 class="screen-reader-text">Contenido Principal</h2>
        <div id="front-page-2" class="front-page-2">
            <div class="wrap">
                <div class="flexible-widgets widget-area fadeup-effect widget-full"></div>
            </div>
        </div>
        <div data-wpr-lazyrender="1" class="site-inner">
            <div class="content-sidebar-wrap">
                <main class="content" id="genesis-content"></main>
            </div>
        </div>
        <div class="footer-widgets" id="genesis-footer-widgets">
            <h2 class="genesis-sidebar-title screen-reader-text">Footer</h2>
            <div class="wrap">
                <div class="widget-area footer-widgets-1 footer-widget-area">
                    <section id="custom_html-2" class="widget_text widget widget_custom_html">
                        <div class="widget_text widget-wrap">
                            <div class="textwidget custom-html-widget">
                                <h4>Soporte</h4>

                                <ul>
                                    <li><a href="/corporativo/preguntas-frecuentes/">Preguntas Frecuentes</a></li>
                                    <li><a href="https://www.registratuequipo.com/">Registro de equipos</a></li>
                                    <li><a href="/ubicaciones/centros-de-servicio/">Centros de Servicio</a></li>
                                </ul>

                                <p>
                                    <div class="su-divider su-divider-style-default"
                                        style="margin:15px 0;border-width:3px;border-color:#ffffff"></div>
                                </p>

                                <h4>Aplicaciones M&oacute;viles</h4>

                                <ul>
                                    <li><a href="/apps/wifi-app/">App de Control WiFi</a></li>
                                    <li><a href="/apps/mirage-home/">Mirage Home</a></li>
                                    <li><a href="http://www.mirage.mx/apps/codigos-de-diagnostico/">C&oacute;digos de
                                            Diagn&oacute;stico</a></li>
                                </ul>

                                <p>
                                    <div class="su-divider su-divider-style-default"
                                        style="margin:15px 0;border-width:3px;border-color:#ffffff"></div>
                                </p>

                                <h4>Corporativo</h4>

                                <ul>
                                    <li><a href="http://www.mirage.mx/corporativo/semblanza-empresarial/">Semblanza
                                            Empresarial</a></li>
                                    <li><a href="http://www.mirage.mx/corporativo/certificaciones/">Certificaciones</a>
                                    </li>
                                    <li><a href="http://www.mirage.mx/corporativo/infraestructura-operativa/">Infraestructura
                                            Operativa</a></li>
                                    <li><a href="http://www.mirage.mx/corporativo/infraestructura-tecnologica/">Infraestructura
                                            Tecnol&oacute;gica</a></li>
                                    <li><a href="http://www.tiendamirage.mx">Tienda en linea</a></li>
                                </ul>

                                <p>
                                    <div class="su-divider su-divider-style-default"
                                        style="margin:15px 0;border-width:3px;border-color:#ffffff"><a href="#"
                                            style="color:#ffffff">Ir arriba</a></div>
                                </p>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="widget-area footer-widgets-2 footer-widget-area">
                    <section id="custom_html-7" class="widget_text widget widget_custom_html">
                        <div class="widget_text widget-wrap">
                            <h3 class="widgettitle widget-title">Mirage Electrodomésticos</h3>
                            <div class="textwidget custom-html-widget">
                                <p>Somos la principal marca mexicana de aires acondicionados tipo minisplit, líder
                                    nacional en ventas.</p>
                                <p>Ampliamos nuestra gama de productos introduciendo componentes de <a
                                        href="https://mirage.mx/catalogo/todo/linea-blanca/">linea blanca</a> que
                                    integran los mismos estándares de eficiencia en ahorro energético logrados con
                                    nuestros diseños exclusivos, los modelos de la linea <a
                                        href="https://mirage.mx/catalogo/todo/aire-acondicionado/minisplit/inverter/">Magnum.</a>
                                </p>
                                <div class="su-spacer" style="height:20px"></div>
                                <img src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%200%200'%3E%3C/svg%3E"
                                    alt="" class="wp-image-20305"
                                    data-lazy-src="https://mirage.mx/wp-content/uploads/2020/06/centro_logistico_mirage-1024x464.jpg" /><noscript><img
                                        src="https://mirage.mx/wp-content/uploads/2020/06/centro_logistico_mirage-1024x464.jpg"
                                        alt="" class="wp-image-20305" /></noscript>
                                <div class="su-spacer" style="height:20px"></div>
                                <div class="su-divider su-divider-style-default"
                                    style="margin:15px 0;border-width:3px;border-color:#ffffff"></div>
                                <h5>Magnum Inverter</h5>
                                <p>Nuestra ingeniería de producto incluye la retroalimentación de una amplia red
                                    nacional de centros de servicio que da voz a más de 2 millones de usuarios operando
                                    equipos Mirage cada año.</p>
                                <div class="su-divider su-divider-style-default"
                                    style="margin:15px 0;border-width:3px;border-color:#ffffff"></div>
                                <h5>La máxima eficiencia</h5>
                                <p>Cada nuevo modelo que Mirage lanza al mercado ofrece mejoras en modos de operación,
                                    materiales y tecnología que incrementan la eficiencia y el ahorro en consumo
                                    eléctrico.</p>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="widget-area footer-widgets-3 footer-widget-area">
                    <section id="custom_html-8" class="widget_text widget widget_custom_html">
                        <div class="widget_text widget-wrap">
                            <h3 class="widgettitle widget-title">Corporativo Nacional</h3>
                            <div class="textwidget custom-html-widget">
                                <p>Puebla #270 Sur, Col. Centro. Ciudad Obregón, Sonora, Mx. C.P. 85000 - Tel (644) 410
                                    9800</p>
                                <div class="su-divider su-divider-style-default"
                                    style="margin:15px 0;border-width:3px;border-color:#ffffff"></div>
                                <h5>CEDIF Guadalajara</h5>
                                <p>Carretera Guadalajara-Morelia No. 19200 Col. Buenavista, Tlajomulco de Zúñiga,
                                    Jalisco, CP 45640</p>
                                <div class="su-divider su-divider-style-default"
                                    style="margin:15px 0;border-width:3px;border-color:#ffffff"></div>
                                <h5>CEDIF Veracruz</h5>
                                <p>Calle Fidelidad Lote 2 Mz 1. Entre Ctra. Ver. – Xal. y C. Araucarias. Fraccionamiento
                                    Bruno Pagliai. Veracruz, Ver, Mx. C.P. 91697</p>
                                <div class="su-divider su-divider-style-default"
                                    style="margin:15px 0;border-width:3px;border-color:#ffffff"></div>
                                <h5>CEDIF Monterrey</h5>
                                <p>Carretera Miguel Alemán #800, Col. La Fe, San Nicolas de los Garza. Nuevo León, Mx.
                                    C.P. 66477 - Tel (818) 298 2310 </p>
                                <div class="su-divider su-divider-style-default"
                                    style="margin:15px 0;border-width:3px;border-color:#ffffff"></div>
                                <h5>CEDIF Merida</h5>
                                <p>Perif. de Mérida Lic. Manuel Berzunza 33, Ampliación, 97312 Mérida, Yuc.<br>Segunda
                                    Caseta, 4to Complejo. Bodegas: 72 a la 76.</p>
                                <div class="su-divider su-divider-style-default"
                                    style="margin:15px 0;border-width:3px;border-color:#ffffff"></div>
                                <h5>CEDIF Mexicali</h5>
                                <p>Calle Siderurgía 364 módulo A Edificio Terra Parque Industrial Vie Verte 3.0, Col.
                                    Colorado 2 CP.21383</p>
                                <div class="su-divider su-divider-style-default"
                                    style="margin:15px 0;border-width:3px;border-color:#ffffff"></div>
                                <h5>CEDIF Hermosillo</h5>
                                <p>Carr. a "la Colorada" Casi Esq. Calesa #218 Colonia Parque Industrial, 83299</p>
                                <div class="su-divider su-divider-style-default"
                                    style="margin:15px 0;border-width:3px;border-color:#ffffff"></div>
                                <h5>CEDIF Culiacán</h5>
                                <p>Blvd. Fuerza Aérea Mexicana 4995 Parque Industrial Aeropuerto Bodega 7, Col.
                                    Bachigualato. 80147</p>
                                <div class="su-divider su-divider-style-default"
                                    style="margin:15px 0;border-width:3px;border-color:#ffffff"></div>
                                <h5>CEDIF Queretaro</h5>
                                <p>Edificio K3 (módulos 5-10), Parque Industrial Kaizen IP, Carr. Estatal 100 No. Lote
                                    002 Manzana 028 No. 8820, Galeras, Mpio de Colon, Queretaro. 76295</p>
                                <div class="su-divider su-divider-style-default"
                                    style="margin:15px 0;border-width:3px;border-color:#ffffff"><a href="#"
                                        style="color:#ffffff">Ir arriba</a></div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <footer class="site-footer" itemscope itemtype="https://schema.org/WPFooter">
            <div class="wrap">
                <div class="pagebottominfo">
                    <p>&copy; Copyright 2021 <a href="http://www.mirage.mx/">Mirage México</a> &middot; Todos los
                        derechos reservados &middot; <a href="/avisos/aviso-de-privacidad/">Aviso de privacidad</a></p>
                </div>
                <p></p>
                <nav class="nav-secondary" aria-label="Secundario" itemscope
                    itemtype="https://schema.org/SiteNavigationElement">
                    <div class="wrap">
                        <ul id="menu-footer-menu" class="menu genesis-nav-menu menu-secondary js-superfish">
                            <li id="menu-item-16"
                                class="menu-item menu-item-type-custom menu-item-object-custom menu-item-16"><a
                                    href="https://b2b.mirage.mx/" itemprop="url"><span itemprop="name">Centro
                                        Digital</span></a></li>
                            <li id="menu-item-17"
                                class="menu-item menu-item-type-custom menu-item-object-custom menu-item-17"><a
                                    href="https://www.certificacionmirage.com/" itemprop="url"><span
                                        itemprop="name">Certificacion Mirage</span></a></li>
                            <li id="menu-item-14"
                                class="menu-item menu-item-type-custom menu-item-object-custom menu-item-14"><a
                                    target="_blank" href="https://www.facebook.com/miragemx" itemprop="url"><span
                                        itemprop="name">Facebook</span></a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </footer>
    </div>
    <script type="speculationrules">
        {"prefetch":[{"source":"document","where":{"and":[{"href_matches":"/*"},{"not":{"href_matches":["/wp-*.php","/wp-admin/*","/wp-content/uploads/*","/wp-content/*","/wp-content/plugins/*","/wp-content/themes/digital-pro/*","/wp-content/themes/genesis/*","/*\\?(.+)"]}},{"not":{"selector_matches":"a[rel~=\"nofollow\"]"}},{"not":{"selector_matches":".no-prefetch, .no-prefetch a"}}]},"eagerness":"conservative"}]}
</script>
    <!-- Load Facebook SDK for JavaScript -->
    <div data-wpr-lazyrender="1" id="fb-root"></div>
    <script type="text/rocketlazyloadscript">(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = 'https://connect.facebook.net/es_LA/sdk/xfbml.customerchat.js#xfbml=1&version=v2.12&autoLogAppEvents=1';
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
    <!-- Your customer chat code -->
    <div class="fb-customerchat" attribution=install_email page_id="135782736455828"
        logged_in_greeting="¡Hola! ¿En qué te podemos ayudar?" logged_out_greeting="¡Hola! ¿En qué te podemos ayudar?">
    </div>
    <script type="text/rocketlazyloadscript">
        (function($){
  $(window).on('elementor/frontend/init', function() {

    function ensureDownloadButton($lightbox){
      let $btn = $lightbox.find('.elementor-download-wrap a.elementor-download-btn');
      if ($btn.length) return $btn;

      let $block = $(`
        <div class="elementor-download-wrap">
          <a class="elementor-download-btn"
             href="#"
             data-elementor-open-lightbox="no"
             rel="noopener noreferrer">
             Descargar
          </a>
        </div>
      `);

      let $content = $lightbox.find('.elementor-lightbox-content');
      ($content.length ? $content : $lightbox).append($block);

      return $block.find('a');
    }

    function setHref($btn, url){
      if (!url) return;
      // Guardamos la URL en un atributo propio
      $btn.attr('data-dl-url', url);
    }

    // --- CLICK DEL BOTÓN DE DESCARGA ---
    $(document).on('click', '.elementor-download-btn', function(e){
      e.preventDefault();
      e.stopPropagation();

      let url = $(this).attr('data-dl-url');
      if (!url) return;

      // Fuerza descarga creando un <a download> temporal
      let a = document.createElement('a');
      a.href = url;
      a.setAttribute('download', ''); // descarga con nombre original
      document.body.appendChild(a);
      a.click();
      a.remove();
    });

    // --- CUANDO SE ABRE EL LIGHTBOX ---
    $(document).on('click', '[data-elementor-open-lightbox="yes"], .elementor-lightbox-item', function(){
      let $trigger = $(this);

      // Buscamos el widget padre (Imagen, Galería o Media Carousel)
      let $widget = $trigger.closest(
        '.elementor-widget-image, .elementor-widget-gallery, .elementor-widget-media-carousel'
      );

      let customUrl = $widget.attr('data-download-url') || null;

      setTimeout(function(){
        let $lightbox  = $('.elementor-lightbox');
        let $img       = $lightbox.find('.elementor-lightbox-image');
        let defaultUrl = $img.attr('src');

        let $btn = ensureDownloadButton($lightbox);
        setHref($btn, customUrl || defaultUrl);

        // Observa cambios en la imagen del lightbox (desde flechas)
        if (!$lightbox.data('dlObserver')) {
          let obs = new MutationObserver(function(){
            let currentSrc = $lightbox.find('.elementor-lightbox-image').attr('src');
            setHref($btn, currentSrc);
          });

          let imgEl = $img.get(0);
          if (imgEl) {
            obs.observe(imgEl, { attributes: true, attributeFilter: ['src'] });
            $lightbox.data('dlObserver', obs);
          }
        }
      }, 50);
    });

  });
})(jQuery);
</script>
    <style type="text/css" media="screen"></style>
    <script type="text/rocketlazyloadscript">
        const lazyloadRunObserver = () => {
					const lazyloadBackgrounds = document.querySelectorAll( `.e-con.e-parent:not(.e-lazyloaded)` );
					const lazyloadBackgroundObserver = new IntersectionObserver( ( entries ) => {
						entries.forEach( ( entry ) => {
							if ( entry.isIntersecting ) {
								let lazyloadBackground = entry.target;
								if( lazyloadBackground ) {
									lazyloadBackground.classList.add( 'e-lazyloaded' );
								}
								lazyloadBackgroundObserver.unobserve( entry.target );
							}
						});
					}, { rootMargin: '200px 0px 200px 0px' } );
					lazyloadBackgrounds.forEach( ( lazyloadBackground ) => {
						lazyloadBackgroundObserver.observe( lazyloadBackground );
					} );
				};
				const events = [
					'DOMContentLoaded',
					'elementor/lazyload/observe',
				];
				events.forEach( ( event ) => {
					document.addEventListener( event, lazyloadRunObserver );
				} );
			</script>
    <script type="text/rocketlazyloadscript" data-rocket-type='text/javascript'>
        (function () {
			var c = document.body.className;
			c = c.replace(/woocommerce-no-js/, 'woocommerce-js');
			document.body.className = c;
		})();
	</script>
    <link rel='stylesheet' id='wc-blocks-style-css'
        href='https://mirage.mx/wp-content/plugins/woocommerce/assets/client/blocks/wc-blocks.css?ver=wc-10.8.1'
        media='all' />
    <link rel='stylesheet' id='elementor-frontend-css'
        href='https://mirage.mx/wp-content/plugins/elementor/assets/css/frontend.min.css?ver=4.1.3' media='all' />
    <link rel='stylesheet' id='elementor-post-23732-css'
        href='https://mirage.mx/wp-content/uploads/elementor/css/post-23732.css?ver=1781623673' media='all' />
    <link rel='stylesheet' id='widget-spacer-css'
        href='https://mirage.mx/wp-content/plugins/elementor/assets/css/widget-spacer.min.css?ver=4.1.3' media='all' />
    <link rel='stylesheet' id='widget-animated-headline-css'
        href='https://mirage.mx/wp-content/plugins/elementor-pro/assets/css/widget-animated-headline.min.css?ver=4.1.1'
        media='all' />
    <link rel='stylesheet' id='widget-image-css'
        href='https://mirage.mx/wp-content/plugins/elementor/assets/css/widget-image.min.css?ver=4.1.3' media='all' />
    <link rel='stylesheet' id='widget-icon-box-css'
        href='https://mirage.mx/wp-content/plugins/elementor/assets/css/widget-icon-box.min.css?ver=4.1.3'
        media='all' />
    <link rel='stylesheet' id='e-motion-fx-css'
        href='https://mirage.mx/wp-content/plugins/elementor-pro/assets/css/modules/motion-fx.min.css?ver=4.1.1'
        media='all' />
    <link rel='stylesheet' id='e-sticky-css'
        href='https://mirage.mx/wp-content/plugins/elementor-pro/assets/css/modules/sticky.min.css?ver=4.1.1'
        media='all' />
    <link rel='stylesheet' id='widget-flip-box-css'
        href='https://mirage.mx/wp-content/plugins/elementor-pro/assets/css/widget-flip-box.min.css?ver=4.1.1'
        media='all' />
    <link rel='stylesheet' id='flickity-css'
        href='https://mirage.mx/wp-content/plugins/shortcodes-ultimate/vendor/flickity/flickity.css?ver=2.2.1'
        media='all' />
    <link rel='stylesheet' id='su-shortcodes-css'
        href='https://mirage.mx/wp-content/plugins/shortcodes-ultimate/includes/css/shortcodes.css?ver=7.8.2'
        media='all' />
    <link rel='stylesheet' id='elementor-icons-css'
        href='https://mirage.mx/wp-content/plugins/elementor/assets/lib/eicons/css/elementor-icons.min.css?ver=5.49.0'
        media='all' />
    <link rel='stylesheet' id='elementor-post-23667-css'
        href='https://mirage.mx/wp-content/uploads/elementor/css/post-23667.css?ver=1781623671' media='all' />
    <link rel='stylesheet' id='elementor-gf-local-roboto-css'
        href='https://mirage.mx/wp-content/uploads/elementor/google-fonts/css/roboto.css?ver=1742323354' media='all' />
    <link rel='stylesheet' id='elementor-gf-local-robotoslab-css'
        href='https://mirage.mx/wp-content/uploads/elementor/google-fonts/css/robotoslab.css?ver=1742323365'
        media='all' />
    <link rel='stylesheet' id='elementor-icons-shared-0-css'
        href='https://mirage.mx/wp-content/plugins/elementor/assets/lib/font-awesome/css/fontawesome.min.css?ver=5.15.3'
        media='all' />
    <link rel='stylesheet' id='elementor-icons-fa-solid-css'
        href='https://mirage.mx/wp-content/plugins/elementor/assets/lib/font-awesome/css/solid.min.css?ver=5.15.3'
        media='all' />
    <script id="woocommerce-events-front-script-js-extra">
        var frontObj = {
            "copyFromPurchaser": "autocopy"
        };
        //# sourceURL=woocommerce-events-front-script-js-extra
    </script>
    <script type="text/rocketlazyloadscript" id="woocommerce-events-front-script-js"
        data-rocket-src="https://mirage.mx/wp-content/plugins/fooevents/js/events-frontend.js?ver=1.0.0"
        data-rocket-defer defer></script>
    <script type="text/rocketlazyloadscript" id="rocket-browser-checker-js-after">
        "use strict";var _createClass=function(){function defineProperties(target,props){for(var i=0;i<props.length;i++){var descriptor=props[i];descriptor.enumerable=descriptor.enumerable||!1,descriptor.configurable=!0,"value"in descriptor&&(descriptor.writable=!0),Object.defineProperty(target,descriptor.key,descriptor)}}return function(Constructor,protoProps,staticProps){return protoProps&&defineProperties(Constructor.prototype,protoProps),staticProps&&defineProperties(Constructor,staticProps),Constructor}}();function _classCallCheck(instance,Constructor){if(!(instance instanceof Constructor))throw new TypeError("Cannot call a class as a function")}var RocketBrowserCompatibilityChecker=function(){function RocketBrowserCompatibilityChecker(options){_classCallCheck(this,RocketBrowserCompatibilityChecker),this.passiveSupported=!1,this._checkPassiveOption(this),this.options=!!this.passiveSupported&&options}return _createClass(RocketBrowserCompatibilityChecker,[{key:"_checkPassiveOption",value:function(self){try{var options={get passive(){return!(self.passiveSupported=!0)}};window.addEventListener("test",null,options),window.removeEventListener("test",null,options)}catch(err){self.passiveSupported=!1}}},{key:"initRequestIdleCallback",value:function(){!1 in window&&(window.requestIdleCallback=function(cb){var start=Date.now();return setTimeout(function(){cb({didTimeout:!1,timeRemaining:function(){return Math.max(0,50-(Date.now()-start))}})},1)}),!1 in window&&(window.cancelIdleCallback=function(id){return clearTimeout(id)})}},{key:"isDataSaverModeOn",value:function(){return"connection"in navigator&&!0===navigator.connection.saveData}},{key:"supportsLinkPrefetch",value:function(){var elem=document.createElement("link");return elem.relList&&elem.relList.supports&&elem.relList.supports("prefetch")&&window.IntersectionObserver&&"isIntersecting"in IntersectionObserverEntry.prototype}},{key:"isSlowConnection",value:function(){return"connection"in navigator&&"effectiveType"in navigator.connection&&("2g"===navigator.connection.effectiveType||"slow-2g"===navigator.connection.effectiveType)}}]),RocketBrowserCompatibilityChecker}();
//# sourceURL=rocket-browser-checker-js-after
</script>
    <script id="rocket-preload-links-js-extra">
        var RocketPreloadLinksConfig = {
            "excludeUris": "/wpstream/live/|/(?:.+/)?feed(?:/(?:.+/?)?)?$|/(?:.+/)?embed/|/reservar/??(.*)|/confirmar/?|/mi-cuenta/??(.*)|/(index.php/)?(.*)wp-json(/.*|$)|/refer/|/go/|/recommend/|/recommends/",
            "usesTrailingSlash": "1",
            "imageExt": "jpg|jpeg|gif|png|tiff|bmp|webp|avif|pdf|doc|docx|xls|xlsx|php",
            "fileExt": "jpg|jpeg|gif|png|tiff|bmp|webp|avif|pdf|doc|docx|xls|xlsx|php|html|htm",
            "siteUrl": "https://mirage.mx",
            "onHoverDelay": "100",
            "rateThrottle": "3"
        };
        //# sourceURL=rocket-preload-links-js-extra
    </script>
    <script type="text/rocketlazyloadscript" id="rocket-preload-links-js-after">
        (function() {
"use strict";var r="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},e=function(){function i(e,t){for(var n=0;n<t.length;n++){var i=t[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(e,i.key,i)}}return function(e,t,n){return t&&i(e.prototype,t),n&&i(e,n),e}}();function i(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}var t=function(){function n(e,t){i(this,n),this.browser=e,this.config=t,this.options=this.browser.options,this.prefetched=new Set,this.eventTime=null,this.threshold=1111,this.numOnHover=0}return e(n,[{key:"init",value:function(){!this.browser.supportsLinkPrefetch()||this.browser.isDataSaverModeOn()||this.browser.isSlowConnection()||(this.regex={excludeUris:RegExp(this.config.excludeUris,"i"),images:RegExp(".("+this.config.imageExt+")$","i"),fileExt:RegExp(".("+this.config.fileExt+")$","i")},this._initListeners(this))}},{key:"_initListeners",value:function(e){-1<this.config.onHoverDelay&&document.addEventListener("mouseover",e.listener.bind(e),e.listenerOptions),document.addEventListener("mousedown",e.listener.bind(e),e.listenerOptions),document.addEventListener("touchstart",e.listener.bind(e),e.listenerOptions)}},{key:"listener",value:function(e){var t=e.target.closest("a"),n=this._prepareUrl(t);if(null!==n)switch(e.type){case"mousedown":case"touchstart":this._addPrefetchLink(n);break;case"mouseover":this._earlyPrefetch(t,n,"mouseout")}}},{key:"_earlyPrefetch",value:function(t,e,n){var i=this,r=setTimeout(function(){if(r=null,0===i.numOnHover)setTimeout(function(){return i.numOnHover=0},1e3);else if(i.numOnHover>i.config.rateThrottle)return;i.numOnHover++,i._addPrefetchLink(e)},this.config.onHoverDelay);t.addEventListener(n,function e(){t.removeEventListener(n,e,{passive:!0}),null!==r&&(clearTimeout(r),r=null)},{passive:!0})}},{key:"_addPrefetchLink",value:function(i){return this.prefetched.add(i.href),new Promise(function(e,t){var n=document.createElement("link");n.rel="prefetch",n.href=i.href,n.onload=e,n.onerror=t,document.head.appendChild(n)}).catch(function(){})}},{key:"_prepareUrl",value:function(e){if(null===e||"object"!==(void 0===e?"undefined":r(e))||!1 in e||-1===["http:","https:"].indexOf(e.protocol))return null;var t=e.href.substring(0,this.config.siteUrl.length),n=this._getPathname(e.href,t),i={original:e.href,protocol:e.protocol,origin:t,pathname:n,href:t+n};return this._isLinkOk(i)?i:null}},{key:"_getPathname",value:function(e,t){var n=t?e.substring(this.config.siteUrl.length):e;return n.startsWith("/")||(n="/"+n),this._shouldAddTrailingSlash(n)?n+"/":n}},{key:"_shouldAddTrailingSlash",value:function(e){return this.config.usesTrailingSlash&&!e.endsWith("/")&&!this.regex.fileExt.test(e)}},{key:"_isLinkOk",value:function(e){return null!==e&&"object"===(void 0===e?"undefined":r(e))&&(!this.prefetched.has(e.href)&&e.origin===this.config.siteUrl&&-1===e.href.indexOf("?")&&-1===e.href.indexOf("#")&&!this.regex.excludeUris.test(e.href)&&!this.regex.images.test(e.href))}}],[{key:"run",value:function(){"undefined"!=typeof RocketPreloadLinksConfig&&new n(new RocketBrowserCompatibilityChecker({capture:!0,passive:!0}),RocketPreloadLinksConfig).init()}}]),n}();t.run();
}());

//# sourceURL=rocket-preload-links-js-after
</script>
    <script type="text/rocketlazyloadscript" id="hoverIntent-js"
        data-rocket-src="https://mirage.mx/wp-includes/js/hoverIntent.min.js?ver=1.10.2" data-rocket-defer defer>
    </script>
    <script type="text/rocketlazyloadscript" id="superfish-js"
        data-rocket-src="https://mirage.mx/wp-content/themes/genesis/lib/js/menu/superfish.min.js?ver=1.7.10"
        data-rocket-defer defer></script>
    <script type="text/rocketlazyloadscript" id="superfish-args-js"
        data-rocket-src="https://mirage.mx/wp-content/themes/genesis/lib/js/menu/superfish.args.min.js?ver=3.6.2"
        data-rocket-defer defer></script>
    <script type="text/rocketlazyloadscript" id="skip-links-js"
        data-rocket-src="https://mirage.mx/wp-content/themes/genesis/lib/js/skip-links.min.js?ver=3.6.2"
        data-rocket-defer defer></script>
    <script type="text/rocketlazyloadscript" id="digital-global-scripts-js"
        data-rocket-src="https://mirage.mx/wp-content/themes/digital-pro/js/global.js?ver=1.1.3" data-rocket-defer
        defer></script>
    <script id="digital-responsive-menu-js-extra">
        var genesis_responsive_menu = {
            "mainMenu": "Men\u00fa",
            "menuIconClass": "ionicons-before ion-ios-drag",
            "subMenu": "Submen\u00fa",
            "subMenuIconClass": "ionicons-before ion-ios-arrow-down",
            "menuClasses": {
                "others": [".nav-primary"]
            }
        };
        //# sourceURL=digital-responsive-menu-js-extra
    </script>
    <script type="text/rocketlazyloadscript" id="digital-responsive-menu-js"
        data-rocket-src="https://mirage.mx/wp-content/themes/digital-pro/js/responsive-menus.min.js?ver=1.1.3"
        data-rocket-defer defer></script>
    <script type="text/rocketlazyloadscript" id="sourcebuster-js-js"
        data-rocket-src="https://mirage.mx/wp-content/plugins/woocommerce/assets/js/sourcebuster/sourcebuster.min.js?ver=10.8.1"
        data-rocket-defer defer></script>
    <script id="wc-order-attribution-js-extra">
        var wc_order_attribution = {
            "params": {
                "lifetime": 1.0000000000000000818030539140313095458623138256371021270751953125e-5,
                "session": 30,
                "base64": false,
                "ajaxurl": "https://mirage.mx/wp-admin/admin-ajax.php",
                "prefix": "wc_order_attribution_",
                "allowTracking": true
            },
            "fields": {
                "source_type": "current.typ",
                "referrer": "current_add.rf",
                "utm_campaign": "current.cmp",
                "utm_source": "current.src",
                "utm_medium": "current.mdm",
                "utm_content": "current.cnt",
                "utm_id": "current.id",
                "utm_term": "current.trm",
                "utm_source_platform": "current.plt",
                "utm_creative_format": "current.fmt",
                "utm_marketing_tactic": "current.tct",
                "session_entry": "current_add.ep",
                "session_start_time": "current_add.fd",
                "session_pages": "session.pgs",
                "session_count": "udata.vst",
                "user_agent": "udata.uag"
            }
        };
        //# sourceURL=wc-order-attribution-js-extra
    </script>
    <script type="text/rocketlazyloadscript" id="wc-order-attribution-js"
        data-rocket-src="https://mirage.mx/wp-content/plugins/woocommerce/assets/js/frontend/order-attribution.min.js?ver=10.8.1"
        data-rocket-defer defer></script>
    <script type="text/rocketlazyloadscript" id="digital-front-script-js"
        data-rocket-src="https://mirage.mx/wp-content/themes/digital-pro/js/front-page.js?ver=1.1.3" data-rocket-defer
        defer></script>
    <script type="text/rocketlazyloadscript" id="elementor-webpack-runtime-js"
        data-rocket-src="https://mirage.mx/wp-content/plugins/elementor/assets/js/webpack.runtime.min.js?ver=4.1.3"
        data-rocket-defer defer></script>
    <script type="text/rocketlazyloadscript" id="elementor-frontend-modules-js"
        data-rocket-src="https://mirage.mx/wp-content/plugins/elementor/assets/js/frontend-modules.min.js?ver=4.1.3"
        data-rocket-defer defer></script>
    <script id="jquery-ui-core-js" src="https://mirage.mx/wp-includes/js/jquery/ui/core.min.js?ver=1.13.3"
        data-rocket-defer defer></script>
    <script type="text/rocketlazyloadscript" id="elementor-frontend-js-before">
        var elementorFrontendConfig = {"environmentMode":{"edit":false,"wpPreview":false,"isScriptDebug":false},"i18n":{"shareOnFacebook":"Compartir en Facebook","shareOnTwitter":"Compartir en Twitter","pinIt":"Fijarlo","download":"Descargar","downloadImage":"Descargar imagen","fullscreen":"Pantalla completa","zoom":"Zoom","share":"Compartir","playVideo":"Reproducir video","previous":"Previo","next":"Siguiente","close":"Cerrar","a11yCarouselPrevSlideMessage":"Diapositiva anterior","a11yCarouselNextSlideMessage":"Diapositiva siguiente","a11yCarouselFirstSlideMessage":"Esta es la primera diapositiva","a11yCarouselLastSlideMessage":"Esta es la \u00faltima diapositiva","a11yCarouselPaginationBulletMessage":"Ir a la diapositiva"},"is_rtl":false,"breakpoints":{"xs":0,"sm":480,"md":768,"lg":1025,"xl":1440,"xxl":1600},"responsive":{"breakpoints":{"mobile":{"label":"M\u00f3vil en Retrato","value":767,"default_value":767,"direction":"max","is_enabled":true},"mobile_extra":{"label":"M\u00f3vil horizontal","value":880,"default_value":880,"direction":"max","is_enabled":false},"tablet":{"label":"Tableta vertical","value":1024,"default_value":1024,"direction":"max","is_enabled":true},"tablet_extra":{"label":"Tableta horizontal","value":1200,"default_value":1200,"direction":"max","is_enabled":false},"laptop":{"label":"Laptop","value":1366,"default_value":1366,"direction":"max","is_enabled":false},"widescreen":{"label":"Pantalla grande","value":2400,"default_value":2400,"direction":"min","is_enabled":false}},"hasCustomBreakpoints":false},"version":"4.1.3","is_static":false,"experimentalFeatures":{"additional_custom_breakpoints":true,"container":true,"theme_builder_v2":true,"nested-elements":true,"global_classes_should_enforce_capabilities":true,"e_variables":true,"e_opt_in_v4_page":true,"e_components":true,"e_interactions":true,"e_widget_creation":true,"import-export-customization":true,"e_pro_atomic_form":true,"e_pro_variables":true,"e_pro_interactions":true},"urls":{"assets":"https:\/\/mirage.mx\/wp-content\/plugins\/elementor\/assets\/","ajaxurl":"https:\/\/mirage.mx\/wp-admin\/admin-ajax.php","uploadUrl":"https:\/\/mirage.mx\/wp-content\/uploads"},"nonces":{"floatingButtonsClickTracking":"92eca0c79b","atomicFormsSendForm":"b8b95d9195"},"swiperClass":"swiper","settings":{"page":[],"editorPreferences":[]},"kit":{"active_breakpoints":["viewport_mobile","viewport_tablet"],"global_image_lightbox":"yes","lightbox_enable_counter":"yes","lightbox_enable_fullscreen":"yes","lightbox_enable_zoom":"yes","lightbox_enable_share":"yes","lightbox_title_src":"title","lightbox_description_src":"description","woocommerce_notices_elements":[]},"post":{"id":821,"title":"Mirage%20M%C3%A9xico%20%E2%80%93%20Marca%20especializada%20en%20aires%20acondicionados%20y%20l%C3%ADnea%20blanca.","excerpt":"","featuredImage":"https:\/\/mirage.mx\/wp-content\/uploads\/2023\/05\/mirage_icon.png"}};
//# sourceURL=elementor-frontend-js-before
</script>
    <script type="text/rocketlazyloadscript" id="elementor-frontend-js"
        data-rocket-src="https://mirage.mx/wp-content/plugins/elementor/assets/js/frontend.min.js?ver=4.1.3"
        data-rocket-defer defer></script>
    <script id="e-sticky-js"
        src="https://mirage.mx/wp-content/plugins/elementor-pro/assets/lib/sticky/jquery.sticky.min.js?ver=4.1.1"
        data-rocket-defer defer></script>
    <script type="text/rocketlazyloadscript" id="lity-js"
        data-rocket-src="https://mirage.mx/wp-content/plugins/unlimited-elements-for-elementor-premium/assets_libraries/lity/lity.min.js?ver=2.0.10"
        data-rocket-defer defer></script>
    <script type="text/rocketlazyloadscript" id="flickity-js"
        data-rocket-src="https://mirage.mx/wp-content/plugins/shortcodes-ultimate/vendor/flickity/flickity.js?ver=2.2.1"
        data-rocket-defer defer></script>
    <script id="su-shortcodes-js-extra">
        var SUShortcodesL10n = {
            "noPreview": "Este shortocde no funciona con la vista previa. Por favor ins\u00e9rtalo en el editor de texto y visual\u00edzalo despu\u00e9s.",
            "magnificPopup": {
                "close": "Cerrar (Esc)",
                "loading": "Cargando...",
                "prev": "Anterior (flecha izquierda)",
                "next": "Siguiente (flecha derecha)",
                "counter": "%curr% de %total%",
                "error": "Failed to load content. \u003Ca href=\"%url%\" target=\"_blank\"\u003E\u003Cu\u003EOpen link\u003C/u\u003E\u003C/a\u003E"
            }
        };
        //# sourceURL=su-shortcodes-js-extra
    </script>
    <script type="text/rocketlazyloadscript" id="su-shortcodes-js"
        data-rocket-src="https://mirage.mx/wp-content/plugins/shortcodes-ultimate/includes/js/shortcodes/index.js?ver=7.8.2"
        data-rocket-defer defer></script>
    <script type="text/rocketlazyloadscript" id="elementor-pro-webpack-runtime-js"
        data-rocket-src="https://mirage.mx/wp-content/plugins/elementor-pro/assets/js/webpack-pro.runtime.min.js?ver=4.1.1"
        data-rocket-defer defer></script>
    <script type="text/rocketlazyloadscript" id="wp-hooks-js"
        data-rocket-src="https://mirage.mx/wp-includes/js/dist/hooks.min.js?ver=7496969728ca0f95732d"></script>
    <script type="text/rocketlazyloadscript" id="wp-i18n-js"
        data-rocket-src="https://mirage.mx/wp-includes/js/dist/i18n.min.js?ver=781d11515ad3d91786ec"></script>
    <script type="text/rocketlazyloadscript" id="wp-i18n-js-after">
        wp.i18n.setLocaleData( { 'text direction\u0004ltr': [ 'ltr' ] } );
//# sourceURL=wp-i18n-js-after
</script>
    <script type="text/rocketlazyloadscript" id="elementor-pro-frontend-js-before">
        var ElementorProFrontendConfig = {"ajaxurl":"https:\/\/mirage.mx\/wp-admin\/admin-ajax.php","nonce":"c8dc4b157e","urls":{"assets":"https:\/\/mirage.mx\/wp-content\/plugins\/elementor-pro\/assets\/","rest":"https:\/\/mirage.mx\/wp-json\/"},"settings":{"lazy_load_background_images":true},"popup":{"hasPopUps":true},"shareButtonsNetworks":{"facebook":{"title":"Facebook","has_counter":true},"twitter":{"title":"Twitter"},"linkedin":{"title":"LinkedIn","has_counter":true},"pinterest":{"title":"Pinterest","has_counter":true},"reddit":{"title":"Reddit","has_counter":true},"vk":{"title":"VK","has_counter":true},"odnoklassniki":{"title":"OK","has_counter":true},"tumblr":{"title":"Tumblr"},"digg":{"title":"Digg"},"skype":{"title":"Skype"},"stumbleupon":{"title":"StumbleUpon","has_counter":true},"mix":{"title":"Mix"},"telegram":{"title":"Telegram"},"pocket":{"title":"Pocket","has_counter":true},"xing":{"title":"XING","has_counter":true},"whatsapp":{"title":"WhatsApp"},"email":{"title":"Email"},"print":{"title":"Print"},"x-twitter":{"title":"X"},"threads":{"title":"Threads"}},"woocommerce":{"menu_cart":{"cart_page_url":"https:\/\/mirage.mx\/confirmar\/","checkout_page_url":"https:\/\/mirage.mx\/reservar\/","fragments_nonce":"857c55e0e8"}},"facebook_sdk":{"lang":"es_MX","app_id":""},"lottie":{"defaultAnimationUrl":"https:\/\/mirage.mx\/wp-content\/plugins\/elementor-pro\/modules\/lottie\/assets\/animations\/default.json"}};
//# sourceURL=elementor-pro-frontend-js-before
</script>
    <script type="text/rocketlazyloadscript" id="elementor-pro-frontend-js"
        data-rocket-src="https://mirage.mx/wp-content/plugins/elementor-pro/assets/js/frontend.min.js?ver=4.1.1"
        data-rocket-defer defer></script>
    <script type="text/rocketlazyloadscript" id="pro-elements-handlers-js"
        data-rocket-src="https://mirage.mx/wp-content/plugins/elementor-pro/assets/js/elements-handlers.min.js?ver=4.1.1"
        data-rocket-defer defer></script>

    <!--   Unlimited Elements 2.0.10 Scripts -->
    <script type="text/rocketlazyloadscript" data-rocket-type='text/javascript' id='unlimited-elements-scripts'>

        /* Video Play Button scripts: */

jQuery(document).ready(function(){

var objVideoButton = jQuery("#uc_blox_play_button_elementor_9e20854");

//fix for ios devices
jQuery(document).on('click.lity', function(){

   var objIframeContainer = jQuery(".lity-iframe-container");
   var objIframe = objIframeContainer.find("iframe");

   setTimeout(function(){

      var isVideoSelfHosted = objVideoButton.data("path");

      if(isVideoSelfHosted != "self_hosted")
      return(false);

      var objVideo = objIframe.contents().find("video");

      if(!objVideo.length)
      return(false);

      if(objVideo.hasClass("mac") || objVideo.hasClass("video") || objVideo.hasClass("audio")){

        objVideo.removeClass("mac");
        objVideo.removeClass("video");
        objVideo.removeClass("audio");

      }

   },400);

});

});
</script>
    <style>
        .unlimited-elements-background-overlay {
            position: absolute;
            top: 0px;
            left: 0px;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        .unlimited-elements-background-overlay.uc-bg-front {
            z-index: 999;
        }
    </style>

    <script type="text/rocketlazyloadscript" data-rocket-type='text/javascript'>

        jQuery(document).ready(function(){

				function ucBackgroundOverlayPutStart(){

					var objBG = jQuery(".unlimited-elements-background-overlay").not(".uc-bg-attached");

					if(objBG.length == 0)
						return(false);

					objBG.each(function(index, bgElement){

						var objBgElement = jQuery(bgElement);

						var targetID = objBgElement.data("forid");

						var location = objBgElement.data("location");

						switch(location){
							case "body":
							case "body_front":
								var objTarget = jQuery("body");
							break;
							case "layout":
							case "layout_front":
								var objLayout = jQuery("*[data-id=\""+targetID+"\"]");
								var objTarget = objLayout.parents(".elementor");
								if(objTarget.length > 1)
									objTarget = jQuery(objTarget[0]);
							break;
							default:
								var objTarget = jQuery("*[data-id=\""+targetID+"\"]");
							break;
						}


						if(objTarget.length == 0)
							return(true);

						var objVideoContainer = objTarget.children(".elementor-background-video-container");

						if(objVideoContainer.length == 1)
							objBgElement.detach().insertAfter(objVideoContainer).show();
						else
							objBgElement.detach().prependTo(objTarget).show();


						var objTemplate = objBgElement.children("template");

						if(objTemplate.length){

					        var clonedContent = objTemplate[0].content.cloneNode(true);

					    	var objScripts = jQuery(clonedContent).find("script");
					    	if(objScripts.length)
					    		objScripts.attr("type","text/javascript");

					        objBgElement.append(clonedContent);

							objTemplate.remove();
						}

						objBgElement.trigger("bg_attached");
						objBgElement.addClass("uc-bg-attached");

					});
				}

				ucBackgroundOverlayPutStart();

				jQuery( document ).on( 'elementor/popup/show', ucBackgroundOverlayPutStart);
				jQuery( "body" ).on( 'uc_dom_updated', ucBackgroundOverlayPutStart);

			});


		</script>
    <script>
        window.lazyLoadOptions = [{
            elements_selector: "img[data-lazy-src],.rocket-lazyload",
            data_src: "lazy-src",
            data_srcset: "lazy-srcset",
            data_sizes: "lazy-sizes",
            class_loading: "lazyloading",
            class_loaded: "lazyloaded",
            threshold: 300,
            callback_loaded: function(element) {
                if (element.tagName === "IFRAME" && element.dataset.rocketLazyload == "fitvidscompatible") {
                    if (element.classList.contains("lazyloaded")) {
                        if (typeof window.jQuery != "undefined") {
                            if (jQuery.fn.fitVids) {
                                jQuery(element).parent().fitVids()
                            }
                        }
                    }
                }
            }
        }, {
            elements_selector: ".rocket-lazyload",
            data_src: "lazy-src",
            data_srcset: "lazy-srcset",
            data_sizes: "lazy-sizes",
            class_loading: "lazyloading",
            class_loaded: "lazyloaded",
            threshold: 300,
        }];
        window.addEventListener('LazyLoad::Initialized', function(e) {
            var lazyLoadInstance = e.detail.instance;
            if (window.MutationObserver) {
                var observer = new MutationObserver(function(mutations) {
                    var image_count = 0;
                    var iframe_count = 0;
                    var rocketlazy_count = 0;
                    mutations.forEach(function(mutation) {
                        for (var i = 0; i < mutation.addedNodes.length; i++) {
                            if (typeof mutation.addedNodes[i].getElementsByTagName !==
                                'function') {
                                continue
                            }
                            if (typeof mutation.addedNodes[i].getElementsByClassName !==
                                'function') {
                                continue
                            }
                            images = mutation.addedNodes[i].getElementsByTagName('img');
                            is_image = mutation.addedNodes[i].tagName == "IMG";
                            iframes = mutation.addedNodes[i].getElementsByTagName('iframe');
                            is_iframe = mutation.addedNodes[i].tagName == "IFRAME";
                            rocket_lazy = mutation.addedNodes[i].getElementsByClassName(
                                'rocket-lazyload');
                            image_count += images.length;
                            iframe_count += iframes.length;
                            rocketlazy_count += rocket_lazy.length;
                            if (is_image) {
                                image_count += 1
                            }
                            if (is_iframe) {
                                iframe_count += 1
                            }
                        }
                    });
                    if (image_count > 0 || iframe_count > 0 || rocketlazy_count > 0) {
                        lazyLoadInstance.update()
                    }
                });
                var b = document.getElementsByTagName("body")[0];
                var config = {
                    childList: !0,
                    subtree: !0
                };
                observer.observe(b, config)
            }
        }, !1)
    </script>
    <script data-no-minify="1" async
        src="https://mirage.mx/wp-content/plugins/wp-rocket/assets/js/lazyload/17.8.3/lazyload.min.js"></script>
    <script>
        (() => {
            class RocketElementorPreload {
                constructor() {
                    this.deviceMode = document.createElement("span"), this.deviceMode.id =
                        "elementor-device-mode-wpr", this.deviceMode.setAttribute("class",
                            "elementor-screen-only"), document.body.appendChild(this.deviceMode)
                }
                t() {
                    let t = getComputedStyle(this.deviceMode, ":after").content.replace(/"/g, "");
                    this.animationSettingKeys = this.i(t), document.querySelectorAll(
                        ".elementor-invisible[data-settings]").forEach(t => {
                        const e = t.getBoundingClientRect();
                        if (e.bottom >= 0 && e.top <= window.innerHeight) try {
                            this.o(t)
                        } catch (t) {}
                    })
                }
                o(t) {
                    const e = JSON.parse(t.dataset.settings),
                        i = e.m || e.animation_delay || 0,
                        n = e[this.animationSettingKeys.find(t => e[t])];
                    if ("none" === n) return void t.classList.remove("elementor-invisible");
                    t.classList.remove(n), this.currentAnimation && t.classList.remove(this.currentAnimation),
                        this.currentAnimation = n;
                    let o = setTimeout(() => {
                        t.classList.remove("elementor-invisible"), t.classList.add("animated", n), this
                            .l(t, e)
                    }, i);
                    window.addEventListener("rocket-startLoading", function() {
                        clearTimeout(o)
                    })
                }
                i(t = "mobile") {
                    const e = [""];
                    switch (t) {
                        case "mobile":
                            e.unshift("_mobile");
                        case "tablet":
                            e.unshift("_tablet");
                        case "desktop":
                            e.unshift("_desktop")
                    }
                    const i = [];
                    return ["animation", "_animation"].forEach(t => {
                        e.forEach(e => {
                            i.push(t + e)
                        })
                    }), i
                }
                l(t, e) {
                    this.i().forEach(t => delete e[t]), t.dataset.settings = JSON.stringify(e)
                }
                static run() {
                    const t = new RocketElementorPreload;
                    requestAnimationFrame(t.t.bind(t))
                }
            }
            document.addEventListener("DOMContentLoaded", RocketElementorPreload.run)
        })();
    </script>
</body>

</html>
<!--
Performance optimized by Redis Object Cache. Learn more: https://wprediscache.com

Retrieved 5383 objects (755 KB) from Redis using PhpRedis (v6.2.0).
-->

<!-- This website is like a Rocket, isn't it? Performance optimized by WP Rocket. Learn more: https://wp-rocket.me - Debug: cached@1781623673 -->
