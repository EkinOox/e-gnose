// La fonction require permet de charger des modules
require = function (r, e, n) {
    // La fonction t est utilisée pour charger un module
    function t(n, o) {
        // La fonction i est utilisée pour résoudre les dépendances du module
        function i(r) {
            return t(i.resolve(r))
        }

        // La fonction f est utilisée pour récupérer le nom du module à partir de son index
        function f(e) {
            return r[n][1][e] || e
        }

        // Si le module n'est pas déjà chargé, on le charge
        if (!e[n]) {
            // Si le module n'est pas trouvé, une erreur est renvoyée
            if (!r[n]) {
                var c = "function" == typeof require && require;
                if (!o && c) return c(n, !0);
                if (u) return u(n, !0);
                var l = new Error("Cannot find module '" + n + "'");
                throw l.code = "MODULE_NOT_FOUND", l
            }
            // On résout les dépendances du module et on l'exporte
            i.resolve = f;
            var a = e[n] = new t.Module;
            r[n][0].call(a.exports, i, a, a.exports)
        }
        return e[n].exports
    }

    // La fonction o est utilisée pour créer un nouveau module
    function o() {
        this.bundle = t, this.exports = {}
    }

    // La variable u est utilisée pour récupérer la fonction require globale si elle existe
    var u = "function" == typeof require && require;
    // On charge les modules spécifiés dans le tableau n
    t.Module = o, t.modules = r, t.cache = e, t.parent = u;
    for (var i = 0; i < n.length; i++) t(n[i]);
    return t
}({
    3: [function (require, module, exports) {
        "use strict";
        // Une classe nommée t est définie
        var t = function () {
            // La fonction t est utilisée pour définir les propriétés de la classe
            function t(t, i) {
                for (var e = 0; e < i.length; e++) {
                    var s = i[e];
                    s.enumerable = s.enumerable || !1, s.configurable = !0, "value" in s && (s.writable = !0), Object.defineProperty(t, s.key, s)
                }
            }

            return function (i, e, s) {
                return e && t(i.prototype, e), s && t(i, s), i
            }
        }();

        // La fonction i est utilisée pour convertir une variable en tableau
        function i(t) {
            if (Array.isArray(t)) {
                for (var i = 0, e = Array(t.length); i < t.length; i++) e[i] = t[i];
                return e
            }
            return Array.from(t)
        }

        // La fonction e est utilisée pour vérifier que l'objet est une instance de la classe
        function e(t, i) {
            if (!(t instanceof i)) throw new TypeError("Cannot call a class as a function")
        }

// La classe s est définie
        var s = function () {
            function i(t) {
                e(this, i); // On vérifie que l'objet est une instance de la classe
                // On ajoute des événements d'écoute à l'élément container
                t.container.addEventListener("dragstart", function (t) {
                    return t.preventDefault()
                }), t.container.addEventListener("mousedown", this.startDrag.bind(this)), t.container.addEventListener("touchstart", this.startDrag.bind(this)), window.addEventListener("mousemove", this.drag.bind(this)), window.addEventListener("touchmove", this.drag.bind(this)), window.addEventListener("touchend", this.endDrag.bind(this)), window.addEventListener("mouseup", this.endDrag.bind(this)), window.addEventListener("touchcancel", this.endDrag.bind(this)), this.carousel = t
            }

            return t(i, [{
                key: "startDrag", value: function (t) {
                    if (t.touches) {
                        if (t.touches.length > 1) return; // Si plusieurs touches sont détectées, on arrête
                        t = t.touches[0]
                    }
                    // On définit l'origine du mouvement et la largeur de l'élément container
                    this.origin = {
                        x: t.screenX,
                        y: t.screenY
                    }, this.width = this.carousel.containerWidth, this.carousel.disableTransition()
                }
            }, {
                key: "drag", value: function (t) {
                    if (this.origin) {
                        var i = t.touches ? t.touches[0] : t,
                            e = {x: i.screenX - this.origin.x, y: i.screenY - this.origin.y};
                        t.touches && Math.abs(e.x) > Math.abs(e.y) && (t.preventDefault(), t.stopPropagation()); // Si le mouvement est principalement horizontal, on empêche le défilement de la page
                        var s = -100 * this.carousel.currentItem / this.carousel.items.length;
                        this.lastTranslate = e, this.carousel.translate(s + 100 * e.x / this.width) // On effectue la translation de l'élément container
                    }
                }
            }, {
                key: "endDrag", value: function (t) {
                    this.origin && this.lastTranslate && (this.carousel.enableTransition(), Math.abs(this.lastTranslate.x / this.carousel.carouselWidth) > .2 ? this.lastTranslate.x < 0 ? this.carousel.next() : this.carousel.prev() : this.carousel.gotoItem(this.carousel.currentItem)), this.origin = null
                }
            }]), i
        }(), n = function () {
            function n(t) {
                var o = this, r = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {};
                if (e(this, n), this.element = t, this.options = Object.assign({}, {
                    slidesToScroll: 1,
                    slidesVisible: 1,
                    loop: !1,
                    pagination: !1,
                    navigation: !0,
                    infinite: !1
                }, r), this.options.loop && this.options.infinite) throw new Error("Un carousel ne peut être à la fois en boucle et en infinie");
                var a = [].slice.call(t.children);
                this.isMobile = !1, this.currentItem = 0, this.moveCallbacks = [], this.offset = 0, this.root = this.createDivWithClass("carousel"), this.container = this.createDivWithClass("carousel__container"), this.root.setAttribute("tabindex", "0"), this.root.appendChild(this.container), this.element.appendChild(this.root), this.items = a.map(function (t) {
                    var i = o.createDivWithClass("carousel__item");
                    return i.appendChild(t), i
                }), this.options.infinite && (this.offset = this.options.slidesVisible + this.options.slidesToScroll, this.offset > a.length && console.error("Vous n'avez pas assez d'élément dans le carousel", t), this.items = [].concat(i(this.items.slice(this.items.length - this.offset).map(function (t) {
                    return t.cloneNode(!0)
                })), i(this.items), i(this.items.slice(0, this.offset).map(function (t) {
                    return t.cloneNode(!0)
                }))), this.gotoItem(this.offset, !1)), this.items.forEach(function (t) {
                    return o.container.appendChild(t)
                }), this.setStyle(), this.options.navigation && this.createNavigation(), this.options.pagination && this.createPagination(), this.moveCallbacks.forEach(function (t) {
                    return t(o.currentItem)
                }), this.onWindowResize(), window.addEventListener("resize", this.onWindowResize.bind(this)), this.root.addEventListener("keyup", function (t) {
                    "ArrowRight" === t.key || "Right" === t.key ? o.next() : "ArrowLeft" !== t.key && "Left" !== t.key || o.prev()
                }), this.options.infinite && this.container.addEventListener("transitionend", this.resetInfinite.bind(this)), new s(this)
            }

            return t(n, [{
                key: "setStyle", value: function () {
                    var t = this, i = this.items.length / this.slidesVisible;
                    this.container.style.width = 100 * i + "%", this.items.forEach(function (e) {
                        return e.style.width = 100 / t.slidesVisible / i + "%"
                    })
                }
            }, {
                key: "createNavigation", value: function () {
                    var t = this, i = this.createDivWithClass("carousel__next"),
                        e = this.createDivWithClass("carousel__prev");
                    this.root.appendChild(i), this.root.appendChild(e), i.addEventListener("click", this.next.bind(this)), e.addEventListener("click", this.prev.bind(this)), !0 !== this.options.loop && this.onMove(function (s) {
                        0 === s ? e.classList.add("carousel__prev--hidden") : e.classList.remove("carousel__prev--hidden"), void 0 === t.items[t.currentItem + t.slidesVisible] ? i.classList.add("carousel__next--hidden") : i.classList.remove("carousel__next--hidden")
                    })
                }
            }, {
                key: "translate", value: function (t) {
                    this.container.style.transform = "translate3d(" + t + "%, 0, 0)"
                }
            }, {
                key: "next", value: function () {
                    this.gotoItem(this.currentItem + this.slidesToScroll)
                }
            }, {
                key: "prev", value: function () {
                    this.gotoItem(this.currentItem - this.slidesToScroll)
                }
            }, {
                key: "gotoItem", value: function (t) {
                    var i = !(arguments.length > 1 && void 0 !== arguments[1]) || arguments[1];
                    if (t < 0) {
                        if (!this.options.loop) return;
                        t = this.items.length - this.slidesVisible
                    } else if (t >= this.items.length || void 0 === this.items[this.currentItem + this.slidesVisible] && t > this.currentItem) {
                        if (!this.options.loop) return;
                        t = 0
                    }
                    var e = -100 * t / this.items.length;
                    !1 === i && this.disableTransition(), this.translate(e), this.container.offsetHeight, !1 === i && this.enableTransition(), this.currentItem = t, this.moveCallbacks.forEach(function (i) {
                        return i(t)
                    })
                }
            }, {
                key: "resetInfinite", value: function () {
                    this.currentItem <= this.options.slidesToScroll ? this.gotoItem(this.currentItem + (this.items.length - 2 * this.offset), !1) : this.currentItem >= this.items.length - this.offset && this.gotoItem(this.currentItem - (this.items.length - 2 * this.offset), !1)
                }
            }, {
                key: "onMove", value: function (t) {
                    this.moveCallbacks.push(t)
                }
            }, {
                key: "onWindowResize", value: function () {
                    var t = this, i = window.innerWidth < 800;
                    i !== this.isMobile && (this.isMobile = i, this.setStyle(), this.moveCallbacks.forEach(function (i) {
                        return i(t.currentItem)
                    }))
                }
            }, {
                key: "createDivWithClass", value: function (t) {
                    var i = document.createElement("div");
                    return i.setAttribute("class", t), i
                }
            }, {
                key: "disableTransition", value: function () {
                    this.container.style.transition = "none"
                }
            }, {
                key: "enableTransition", value: function () {
                    this.container.style.transition = ""
                }
            }, {
                key: "slidesToScroll", get: function () {
                    return this.isMobile ? 1 : this.options.slidesToScroll
                }
            }, {
                key: "slidesVisible", get: function () {
                    return this.isMobile ? 1 : this.options.slidesVisible
                }
            }, {
                key: "containerWidth", get: function () {
                    return this.container.offsetWidth
                }
            }, {
                key: "carouselWidth", get: function () {
                    return this.root.offsetWidth
                }
            }]), n
        }(), o = function () {
            for (let i = 0; i < 10; i++) {
                new n(document.querySelector(`#carousel${i}`), {
                    slidesVisible: 3,
                    slidesToScroll: 2,
                    infinite: true,
                    pagination: false
                })
            }
        };
        "loading" !== document.readyState && o(), document.addEventListener("DOMContentLoaded", o);
    }, {}]
}, {}, [3])