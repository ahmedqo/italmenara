function Slider(els, opts = {}) {
    var position,
        action = 0;

    function Instance() {
        this.actions = {};
        this.wrap = typeof els.wrap === "string" ? document.querySelector(els.wrap) : els.wrap;
        this.list = this.wrap.querySelector("ul");
        this.wrap.style.touchAction = "none";
        this.wrap.style.overflow = "hidden";
        this.list.style.display = "flex";
        this.wrap.style.direction = "ltr";
        this.list.style.direction = "ltr";
        this.current = {
            value: 0,
        };

        this.change = (fn) => {
            this.actions.change = fn;
        };

        this.update = (opt = {}) => {
            const options = {
                ...opts,
                ...opt,
            };
            this.infinite = options.infinite || false;
            this.vert = options.vert || false;
            this.auto = options.auto || false;
            this.size = options.size || false;
            this.flip = options.flip || false;
            this.touch = options.touch || false;
            this.time = options.time || 5000;
            this.move = options.move || 1;
            this.cols = options.cols || 1;
            this.gap = options.gap || 0;

            if (this.infinite) {
                [...this.list.children].map((e) => e.isCloned && e.remove());

                const len = this.list.children.length;
                const firsts = [...this.list.children].reduce((a, e, i) => {
                    if (i < this.cols) {
                        const x = e.cloneNode(true);
                        x.setAttribute("x-clone", "");
                        a.push(x);
                    }
                    return a;
                }, []);
                const lasts = [...this.list.children].reduce((a, e, i) => {
                    if (i > len - this.cols - 1) {
                        const x = e.cloneNode(true);
                        x.setAttribute("x-clone", "");
                        a.push(x);
                    }
                    return a;
                }, []);

                if (firsts.length) {
                    for (let i = 0; i < this.cols; i++) {
                        const current = firsts[i];
                        this.list.insertAdjacentElement("beforeend", current);
                        current.isCloned = true;
                    }
                }

                if (lasts.length)
                    for (let i = this.cols; i > 0; i--) {
                        const current = lasts[i - 1];
                        this.list.insertAdjacentElement("afterbegin", current);
                        current.isCloned = true;
                    }
            }

            this.items = [...this.list.children];
            this.length = this.items.length;

            this.__opt = this.vert ? {
                size: "clientHeight",
                item: "height",
                scroll: "scrollTop",
                pos: "clientY",
            } : {
                size: "clientWidth",
                item: "width",
                scroll: "scrollLeft",
                pos: "clientX",
            };

            this.size ?
                (this.wrap.style[this.__opt.item] = this.size * this.cols + this.gap * (this.cols - 1) + "px") :
                (this.wrap.style[this.__opt.item] = "100%");

            this.list.style.width = "";
            this.list.style.flexDirection = "";
            this.list.style.width = "";
            this.list.style.height = "";

            this.vert ?
                (this.list.style.width = "100%") && (this.list.style.flexDirection = "column") :
                (this.list.style.width = "max-content") && (this.list.style.height = "100%");

            this.itemSize = this.wrap[this.__opt.size] / this.cols - (this.gap * (this.cols - 1)) / this.cols;
            this.scrollLength = this.itemSize + this.gap;
            this.list.style.gap = this.gap + "px";

            for (let i = 0; i < this.length; i++) {
                this.items[i].style[this.__opt.item] = this.itemSize + "px";
            }

            if (!this.__isLunched && this.current.value === 0) {
                this.current.value = this.cols * this.move;
                window.onresize = this.update;
                this.__isLunched = true;
            }

            this.wrap.style.scrollBehavior = "unset";
            this.wrap[this.__opt.scroll] = this.scrollLength * this.current.value;
            this.wrap.style.scrollBehavior = "smooth";

            this.scrollAuto();
            this.scrollTouch();
        };

        this.resize = (fn_true = () => {}, fn_false = () => {}, condistion = "(min-width: 1024px)") => {
            const fn = () => {
                if (window.matchMedia(condistion).matches) fn_true(this);
                else fn_false(this);
            };
            window.addEventListener("resize", fn);
            fn();
        };

        this.scroll = () => {
            this.wrap[this.__opt.scroll] = this.scrollLength * this.current.value;
            this.actions.change && this.actions.change(this);
        };

        this.scrollTo = (idx) => {
            this.current.value = idx;
            this.scroll();
        };

        this.scrollNext = () => {
            this.scrollAuto();
            if (this.current.value >= this.length - this.cols) {
                if (this.infinite) {
                    this.wrap.style.scrollBehavior = "unset";
                    this.current.value = this.cols;
                    this.scroll();
                    this.current.value += this.move;
                    this.wrap.style.scrollBehavior = "smooth";
                } else this.current.value = 0;
            } else this.current.value += this.move;
            this.scroll();
        };

        this.scrollPrev = () => {
            this.scrollAuto();
            if (this.current.value <= 0) {
                if (this.infinite) {
                    this.wrap.style.scrollBehavior = "unset";
                    this.current.value = this.length - this.cols - this.cols;
                    this.scroll();
                    this.current.value -= this.move;
                    this.wrap.style.scrollBehavior = "smooth";
                } else this.current.value = this.length - this.cols;
            } else this.current.value -= this.move;
            this.scroll();
        };

        this.scrollAuto = () => {
            if (this.auto) {
                const repeatOften = () => {
                    clearTimeout(this.__timer);
                    this.__timer = setTimeout(() => {
                        this.flip ? this.scrollPrev() : this.scrollNext();
                        requestAnimationFrame(repeatOften);
                    }, this.time);
                };
                requestAnimationFrame(repeatOften);
            } else {
                clearTimeout(this.__timer);
            }
        };

        this.scrollTouch = () => {
            if (this.touch) {
                var fn;
                this.wrap.onpointerdown = (e) => {
                    e.preventDefault();
                    if (action === 0) {
                        action = 1;
                        position = e[this.__opt.pos];
                    }

                    const handleMove = (e) => {
                        e.preventDefault();
                        fn = e[this.__opt.pos] >= position ? this.scrollPrev : this.scrollNext;
                        if (action === 1) {
                            action = 2;
                        }
                    };

                    const handleUp = (e) => {
                        e.preventDefault();
                        fn && fn();
                        if (action === 2) action = 0;
                        this.wrap.onpointermove = null;
                        this.wrap.onpointerup = null;
                    };

                    this.wrap.onpointermove = handleMove;
                    this.wrap.onpointerup = handleUp;
                };
            } else {
                this.wrap.onpointerdown = null;
            }
        };

        if (els.prev) {
            this.prev = typeof els.prev === "string" ? document.querySelector(els.prev) : els.prev;
            this.prev.onclick = this.scrollPrev;
        }

        if (els.next) {
            this.next = typeof els.next === "string" ? document.querySelector(els.next) : els.next;
            this.next.onclick = this.scrollNext;
        }

        this.update();
    }

    return new Instance();
}

const Dictionary = {
    ar: {
        "Actions": "الإجراءات",
        "Id": "المعرف",
        "Email": "البريد الإلكتروني",
        "First Name": "الاسم الأول",
        "Last Name": "الاسم الأخير",
        "Gender": "الجنس",
        "Birth Date": "تاريخ الميلاد",
        "Phone": "الهاتف",
        "Address": "العنوان",
        "Total": "المجموع",
        "Name": "الاسم",
        "Description": "الوصف",
        "Details": "التفاصيل",
        "Brand": "العلامة التجارية",
        "Category": "التصنيف",
        "Sku": "رمز المخزون",
        "Price": "السعر",
        "Quantity": "الكمية",
        "Image": "الصورة",
        "Message": "الرسالة",
        "Products Count": "عدد المنتجات",
        "Note": "ملاحظة",
        "Charges": "الرسوم",
        "Reference": "المرجع",
        "Type": "النوع",
        "Added successfully": "تمت الإضافة بنجاح",
        "No Data Found": "لا توجد بيانات",
        "Requests": "الطلبات",
        "Quotations": "الاقتباسات",
        "Invoices": "الفواتير",
        "Views": "المشاهدات",

        "Not Available": "غير متوفر",
        "Available": "متوفر",
        "Status": "الحالة",
        "Unit": "وحدة",
        "Pieces": "قطع",
        "Boxes": "صناديق",
        "Cartons": "كراتين",
        "Dozens": "دزينة",
        "Packs": "حزم",
        "Sets": "مجموعات",
        "Pairs": "أزواج",
        "Bundles": "حزم",
        "Cases": "حالات",
        "Units": "وحدات",
        "Reams": "زوائد",
        "Rolls": "لفات",
        "Gallons": "غالون",
        "Liters": "لتر",
        "Kilograms": "كيلوغرام",
        "Pounds": "رطل",
        "Ounces": "أوقية",
        "Meters": "متر",
        "Yards": "ياردة",
        "Feet": "قدم",
        "Square Feet": "قدم مربع",
        "Square Meters": "متر مربع",
        "Cubic Meters": "متر مكعب",
        "Cubic Feet": "قدم مكعب",
        "Sheets": "أوراق"
    },
    fr: {
        "Actions": "Actions",
        "Id": "Id",
        "Email": "Email",
        "First Name": "Prénom",
        "Last Name": "Nom de famille",
        "Gender": "Genre",
        "Birth Date": "Date De Naissance",
        "Phone": "Téléphone",
        "Address": "Adresse",
        "Total": "Total",
        "Name": "Nom",
        "Description": "Description",
        "Details": "Détails",
        "Brand": "Marque",
        "Category": "Catégorie",
        "Sku": "Sku",
        "Price": "Prix",
        "Quantity": "Quantité",
        "Image": "Image",
        "Message": "Message",
        "Products Count": "Nombre De Produits",
        "Note": "Note",
        "Charges": "Frais",
        "Reference": "Référence",
        "Type": "Type",
        "Added successfully": "Ajouté avec succès",
        "No Data Found": "Aucune Donnée Trouvée",
        "Requests": "Demandes",
        "Quotations": "Devis",
        "Invoices": "Factures",
        "Views": "Vues",

        "Not Available": "Non Disponible",
        "Available": "Disponible",
        "Status": "Statut",
        "Unit": "Unité",
        "Pieces": "Pièces",
        "Boxes": "Boîtes",
        "Cartons": "Cartons",
        "Dozens": "Douzaines",
        "Packs": "Packs",
        "Sets": "Ensembles",
        "Pairs": "Paires",
        "Bundles": "Bundles",
        "Cases": "Cas",
        "Units": "Unités",
        "Reams": "Rames",
        "Rolls": "Rouleaux",
        "Gallons": "Gallons",
        "Liters": "Litres",
        "Kilograms": "Kilogrammes",
        "Pounds": "Livres",
        "Ounces": "Onces",
        "Meters": "Mètres",
        "Yards": "Yards",
        "Feet": "Pieds",
        "Square Feet": "Pieds Carrés",
        "Square Meters": "Mètres Carrés",
        "Cubic Meters": "Mètres Cubes",
        "Cubic Feet": "Pieds Cubes",
        "Sheets": "Feuilles"
    },
    it: {
        "Actions": "Azioni",
        "Id": "Id",
        "Email": "Email",
        "First Name": "Nome",
        "Last Name": "Cognome",
        "Gender": "Genere",
        "Birth Date": "Data Di Nascita",
        "Phone": "Telefono",
        "Address": "Indirizzo",
        "Total": "Totale",
        "Name": "Nome",
        "Description": "Descrizione",
        "Details": "Dettagli",
        "Brand": "Marca",
        "Category": "Categoria",
        "Sku": "Sku",
        "Price": "Prezzo",
        "Quantity": "Quantità",
        "Image": "Immagine",
        "Message": "Messaggio",
        "Products Count": "Numero Di Prodotti",
        "Note": "Nota",
        "Charges": "Spese",
        "Reference": "Riferimento",
        "Type": "Tipo",
        "Added successfully": "Aggiunto con successo",
        "No Data Found": "Nessun Dato Trovato",
        "Requests": "Richieste",
        "Quotations": "Preventivi",
        "Invoices": "Fatture",
        "Views": "Viste",

        "Not Available": "Non Disponibile",
        "Available": "Disponibile",
        "Status": "Stato",
        "Unit": "Unità",
        "Pieces": "Pezzi",
        "Boxes": "Scatole",
        "Cartons": "Cartoni",
        "Dozens": "Dozzine",
        "Packs": "Pacchi",
        "Sets": "Set",
        "Pairs": "Coppie",
        "Bundles": "Bundles",
        "Cases": "Casi",
        "Units": "Unità",
        "Reams": "Risme",
        "Rolls": "Rotoli",
        "Gallons": "Galloni",
        "Liters": "Litri",
        "Kilograms": "Chilogrammi",
        "Pounds": "Libbre",
        "Ounces": "Once",
        "Meters": "Metri",
        "Yards": "Iarde",
        "Feet": "Piedi",
        "Square Feet": "Piedi Quadrati",
        "Square Meters": "Metri Quadrati",
        "Cubic Meters": "Metri Cubi",
        "Cubic Feet": "Piedi Cubi",
        "Sheets": "Fogli"
    }
}

function toggle(trigger, target) {
    const _trigger = document.querySelector(trigger),
        _target = document.querySelector(target);
    if (_trigger && _target)
        _trigger.addEventListener("click", (e) => {
            _target.toggle();
        });
}

const Locale = document.documentElement.lang;

OS.$Load(function() {
    const overlay = document.querySelector("#overlay");
    overlay && overlay.remove();
    document.body.removeAttribute("close");

    toggle("#trigger", "os-sidebar");
    toggle("#search-trigger", "#search-modal");
    toggle("#search-mobile-trigger", "#search-modal");

    document.querySelectorAll(".nav-colors svg").forEach((svg, i) => {
        if (i < 12) svg.style.color = "var(--color-" + i + ")";
    });

    document.querySelectorAll(".sys-colors svg").forEach((svg, i) => {
        if (i < 10) svg.style.color = "var(--color-sys-" + i + ")";
    });

    const tabs = document.querySelectorAll("[tab]");

    tabs.forEach(tab => {
        const btn = tab.querySelector("button");
        btn.addEventListener("click", e => {
            tabs.forEach(_tab => {
                if (_tab !== tab) _tab.removeAttribute("expand");
            });
            tab[tab.hasAttribute("expand") ? "removeAttribute" : "setAttribute"]("expand", "");
        });
    });
});

function localize(str) {
    const locale = Locale;
    return (Dictionary[locale] && Dictionary[locale][str]) || str;
}

function imagelize(url) {
    return [window.location.origin, "storage/IMAGES", url].join("/");
}

async function getData(url, createLinks) {
    const req = await fetch(url);
    const res = await req.json();
    return res.data;
}

function store(data, clear = false) {
    const object = JSON.parse(localStorage.getItem("italmenara-stored-items") || "[]");
    if (data) {
        const product = object.find(e => e.product === data.product);
        if (product) product.quantity = product.quantity + data.quantity;
        else object.push(data);
        localStorage.setItem("italmenara-stored-items", JSON.stringify(object));
    }
    if (clear) localStorage.setItem("italmenara-stored-items", JSON.stringify(data));
    return object;
}

function HomeInitializer({
    ImageCount,
    ProductCount
}) {
    if (ImageCount) {
        Slider({
            wrap: "#slide",
        }, {
            flip: Locale === "ar",
            auto: true,
            time: 5000,
            touch: true,
            infinite: true,
        }).resize(($) => {
            $.update({});
        }, ($) => {
            $.update({});
        });
    }

    if (ProductCount) {
        const products = document.querySelector("#products").parentElement;
        Slider({
            wrap: "#products",
        }, {
            flip: Locale === "ar",
            time: 5000,
        }).resize(($) => {
            const size = (products.clientWidth - (32 * 3)) / 4;
            $.update({
                gap: 32,
                ...(ProductCount < 4 ? { infinite: false, touch: false, auto: false, cols: ProductCount, size: size } : { infinite: true, touch: true, auto: true, cols: 4, size: false })
            })
        }, ($) => {
            const size = (products.clientWidth - 16) / 2;
            $.update({
                gap: 16,
                ...(ProductCount < 2 ? { infinite: false, touch: false, auto: false, cols: ProductCount, size: size } : { infinite: true, touch: true, auto: true, cols: 2, size: false })
            })
        });
    }
}

async function RequestInitializer({ Search, Target, Main, Clear }) {
    if (Clear) store([], true);
    const array = store();

    async function createRow(data) {
        const item = array.find(e => e.product === data.product);
        const _dd = await getData(Search + '?product=' + data.product);
        if (!_dd) {
            const newArray = store().filter(e => e.product !== data.product);
            store(newArray, true);
            return null;
        }
        const object = {
            quantity: data.quantity || 1,
            product: data.product,
            ...(_dd)
        }
        const json = JSON.stringify(item);

        const row = (new DOMParser).parseFromString(`
            <li class="flex flex-wrap gap-2 items-center">
                <input type="hidden" name="items[]" value="${json}" />
                <button type="button" name="delete-button"
                    class="block p-2 rounded-x-thin text-red-400 outline-none !bg-opacity-10 hover:bg-x-black focus:bg-x-black focus-within:bg-x-black">
                    <svg class="block w-5 h-5 pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960">
                        <path
                            d="M253-99q-36.462 0-64.231-26.775Q161-152.55 161-190v-552h-11q-18.75 0-31.375-12.86Q106-767.719 106-787.36 106-807 118.613-820q12.612-13 31.387-13h182q0-20 13.125-33.5T378-880h204q19.625 0 33.312 13.75Q629-852.5 629-833h179.921q20.279 0 33.179 13.375 12.9 13.376 12.9 32.116 0 20.141-12.9 32.825Q829.2-742 809-742h-11v552q0 37.45-27.069 64.225Q743.863-99 706-99H253Zm104-205q0 14.1 11.051 25.05 11.051 10.95 25.3 10.95t25.949-10.95Q431-289.9 431-304v-324q0-14.525-11.843-26.262Q407.313-666 392.632-666q-14.257 0-24.944 11.738Q357-642.525 357-628v324Zm173 0q0 14.1 11.551 25.05 11.551 10.95 25.8 10.95t25.949-10.95Q605-289.9 605-304v-324q0-14.525-11.545-26.262Q581.91-666 566.93-666q-14.555 0-25.742 11.738Q530-642.525 530-628v324Z" />
                    </svg>
                </button>
                <a href="${object.url}">
                    <img src="${imagelize(object.src)}" alt="${object.name} image"
                    class="block w-24 lg:w-28 aspect-square rounded-x-thin object-cover object-center shadow-x-core bg-x-acent" />
                </a>
                <div class="flex-[1] flex flex-col gap-2 ms-2">
                    <h2 class="text-x-black text-base lg:text-xl font-x-huge text-start truncate-x-core">
                        ${object.name}
                    </h2>
                    <os-counter class="w-28 counter" value="${object.quantity}" min="1"></os-counter>
                </div>
            </li>
        `, "text/html").querySelector("li");
        row.Input = row.querySelector("input");
        row.Delete = row.querySelector("button");
        row.Counter = row.querySelector("os-counter");

        row.Delete.addEventListener("click", e => {
            const newArray = store().filter(e => e.product !== data.product);
            store(newArray, true);
            row.remove();
            window.dispatchEvent(new CustomEvent("request:delete", {
                detail: object,
            }));
        });

        row.Counter.addEventListener("change", () => {
            item.quantity = row.Counter.value;
            row.Input.value = JSON.stringify(item);
            store(array, true);
        });
        return row;
    }

    const rows = [];
    for (const item of array) {
        const row = await createRow(item);
        row && rows.push(row);
    }

    Target.innerHTML = "";
    rows.forEach(row => {
        Target.insertAdjacentElement("afterbegin", row);
    });

    function show() {
        if (!store().length) {
            Main.innerHTML = `<div class="w-full text-center">
                <h2 class="w-full text-x-black font-x-huge text-xl lg:text-2xl my-6">${localize("No Data Found")}</h2>
            </div>`;
        }
    }

    window.addEventListener("request:delete", show);
    show();
}

function ShowCase() {
    Slider({
        wrap: "#slide",
        prev: "#prev",
        next: "#next"
    }, {
        flip: Locale === "ar",
        auto: true,
        time: 5000,
        touch: true,
        infinite: true,
    }).resize(($) => {
        $.update({});
    }, ($) => {
        $.update({});
    });

    document.querySelector("#item").addEventListener("submit", e => {
        e.preventDefault();
        const object = Object.fromEntries(new FormData(e.target).entries());
        object.product = +object.product;
        object.quantity = +object.quantity;
        store(object);
        OS.$Toaster.Toast(localize("Added successfully"), "success")
    });
}