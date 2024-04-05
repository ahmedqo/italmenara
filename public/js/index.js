function toggle(trigger, target) {
    const _trigger = document.querySelector(trigger),
        _target = document.querySelector(target);
    if (_trigger && _target)
        _trigger.addEventListener("click", (e) => {
            _target.toggle();
        });
}

OS.$Load(function() {
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
});

(function() {
    const Style = `
        :host {
            gap: 1px;
            display: flex;
            margin: 0 auto;
            flex-wrap: wrap;
            overflow: hidden;
            width: max-content;
            border-radius: .25rem;
        }

        [part="btns"] {
            display: flex;
            border: unset;
            outline: unset;
            background: unset;
            align-items: center;
            padding: .25rem .5rem;
            border-radius: .20rem;
            text-decoration: unset;
            justify-content: center;
            color: {{ @theme.colors("OS-WHITE") }};
        }

        [part="btns"]:hover,
        [part="btns"]:focus,
        [part="btns"]:focus-within {
            cursor: pointer;
            color: {{ @theme.colors("OS-BLACK") }};
        }

        [part="svgs"] {
            width: 1rem;
            height: 1rem;
            display: block;
            pointer-events: none;
        }

        ($ if @props.scene $)
            [part="btns"][title="scene"] {
                background: {{ @theme.colors("GRAY", 400) }};
            }

            [part="btns"][title="scene"]:hover,
            [part="btns"][title="scene"]:focus,
            [part="btns"][title="scene"]:focus-within {
                background: {{ @theme.colors("GRAY", 400, 60) }};
            }
        ($ endif $)

        ($ if @props.print $)
            [part="btns"][title="print"] {
                background: {{ @theme.colors("GREEN", 400) }};
            }

            [part="btns"][title="print"]:hover,
            [part="btns"][title="print"]:focus,
            [part="btns"][title="print"]:focus-within {
                background: {{ @theme.colors("GREEN", 400, 60) }};
            }
        ($ endif $)

        ($ if @props.patch $)
            [part="btns"][title="patch"] {
                background: {{ @theme.colors("YELLOW", 400) }};
            }

            [part="btns"][title="patch"]:hover,
            [part="btns"][title="patch"]:focus,
            [part="btns"][title="patch"]:focus-within {
                background: {{ @theme.colors("YELLOW", 400, 60) }};
            }
        ($ endif $)

        ($ if @truty(@props.clear, [""]) && @truty(@props.csrf, [""]) $)
            [part="btns"][title="clear"] {
                background: {{ @theme.colors("RED", 400) }};
            }

            [part="btns"][title="clear"]:hover,
            [part="btns"][title="clear"]:focus,
            [part="btns"][title="clear"]:focus-within {
                background: {{ @theme.colors("RED", 400, 60) }};
            }
        ($ endif $)
    `;

    const Template = `
        ($ if @props.scene $)
            <a title="scene" href="{{ @props.scene.replace('XXX', @props.target) }}" part="btns">
                <svg part="svgs" fill="currentcolor" viewBox="0 -960 960 960">
                    <path
                        d="M99-272q-19.325 0-32.662-13.337Q53-298.675 53-318v-319q0-20.3 13.338-33.15Q79.675-683 99-683h73q18.9 0 31.95 12.85T217-637v319q0 19.325-13.05 32.663Q190.9-272 172-272H99Zm224 96q-20.3 0-33.15-13.05Q277-202.1 277-221v-513q0-19.325 12.85-32.662Q302.7-780 323-780h314q20.3 0 33.15 13.338Q683-753.325 683-734v513q0 18.9-12.85 31.95T637-176H323Zm465-96q-18.9 0-31.95-13.337Q743-298.675 743-318v-319q0-20.3 13.05-33.15Q769.1-683 788-683h73q19.325 0 33.162 12.85Q908-657.3 908-637v319q0 19.325-13.838 32.663Q880.325-272 861-272h-73Z" />
                </svg>
            </a>
        ($ endif $)
        
        ($ if @props.print $)
            <a title="print" href="{{ @props.print.replace('XXX', @props.target) }}" part="btns">
                <svg part="svgs" fill="currentcolor" viewBox="0 -960 960 960">
                    <path
                        d="M741-701H220v-160h521v160Zm-17 236q18 0 29.5-10.812Q765-486.625 765-504.5q0-17.5-11.375-29.5T724.5-546q-18.5 0-29.5 12.062-11 12.063-11 28.938 0 18 11 29t29 11Zm-75 292v-139H311v139h338Zm92 86H220v-193H60v-264q0-53.65 36.417-91.325Q132.833-673 186-673h588q54.25 0 90.625 37.675T901-544v264H741v193Z" />
                </svg>
            </a>
        ($ endif $)

        ($ if @props.patch $)
            <a title="patch" href="{{ @props.patch.replace('XXX', @props.target) }}" part="btns">
                <svg part="svgs" fill="currentcolor" viewBox="0 -960 960 960">
                    <path
                        d="M170-103q-32 7-53-14.5T103-170l39-188 216 216-188 39Zm235-78L181-405l435-435q27-27 64.5-27t63.5 27l96 96q27 26 27 63.5T840-616L405-181Z" />
                </svg>
            </a>
        ($ endif $)
        
        ($ if @truty(@props.clear, [""]) && @truty(@props.csrf, [""]) $)
            <form action="{{ @props.clear.replace('XXX', @props.target) }}" method="POST">
                <input type="hidden" name="_token" value="{{ @props.csrf }}" autocomplete="off" />
                <input type="hidden" name="_method" value="delete" />
                <button type="submit" title="clear" part="btns">
                    <svg part="svgs" fill="currentcolor" viewBox="0 -960 960 960">
                        <path
                            d="M253-99q-36.462 0-64.231-26.775Q161-152.55 161-190v-552h-11q-18.75 0-31.375-12.86Q106-767.719 106-787.36 106-807 118.613-820q12.612-13 31.387-13h182q0-20 13.125-33.5T378-880h204q19.625 0 33.312 13.75Q629-852.5 629-833h179.921q20.279 0 33.179 13.375 12.9 13.376 12.9 32.116 0 20.141-12.9 32.825Q829.2-742 809-742h-11v552q0 37.45-27.069 64.225Q743.863-99 706-99H253Zm104-205q0 14.1 11.051 25.05 11.051 10.95 25.3 10.95t25.949-10.95Q431-289.9 431-304v-324q0-14.525-11.843-26.262Q407.313-666 392.632-666q-14.257 0-24.944 11.738Q357-642.525 357-628v324Zm173 0q0 14.1 11.551 25.05 11.551 10.95 25.8 10.95t25.949-10.95Q605-289.9 605-304v-324q0-14.525-11.545-26.262Q581.91-666 566.93-666q-14.555 0-25.742 11.738Q530-642.525 530-628v324Z" />
                    </svg>
                </button>
            </form>
        ($ endif $)
    `

    OS.$Component({
        tag: "action-tools",
        tpl: Template,
        css: [Style]
    })({
        props: {
            "csrf": null,
            "scene": null,
            "print": null,
            "patch": null,
            "clear": null,
            "target": null
        },
        setup: {
            mounted() {
                if (this.hasAttribute("csrf")) {
                    this.props.csrf = this.getAttribute("csrf");
                    this.removeAttribute("csrf");
                }

                if (this.hasAttribute("target")) {
                    this.props.target = this.getAttribute("target");
                    this.removeAttribute("target");
                }

                if (this.hasAttribute("scene")) {
                    this.props.scene = this.getAttribute("scene");
                    this.removeAttribute("scene");
                }

                if (this.hasAttribute("print")) {
                    this.props.print = this.getAttribute("print");
                    this.removeAttribute("print");
                }

                if (this.hasAttribute("patch")) {
                    this.props.patch = this.getAttribute("patch");
                    this.removeAttribute("patch");
                }

                if (this.hasAttribute("clear")) {
                    this.props.clear = this.getAttribute("clear");
                    this.removeAttribute("clear");
                }
            }
        }
    }).define();
})();

const Locale = document.documentElement.lang;

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

const Types = {
    visitors: ({ Currency }) => [{
        name: "id",
        text: localize("Id"),
        width: 20,
        headRender: () => `<center>${localize("Id")}</center>`,
        headPdfRender: function() {
            return this.headRender();
        },
        bodyRender: (row) =>
            `<span style="font-weight: 500; text-align: center; display: block;">#${row.id}</span>`,
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "image",
        text: localize('Image'),
        width: 20,
        headRender: () => `<center>${localize('Image')}</center>`,
        headPdfRender: function() {
            return this.headRender();
        },
        bodyRender: (row) => `<img part="image" src="${imagelize(row.storage)}" />`,
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: (row) => imagelize(row.storage)
    }, {
        name: "sku",
        text: localize('Sku'),
        width: 100,
        headRender: () => `<center>${localize('Sku')}</center>`,
        headPdfRender: function() {
            return this.headRender();
        },
        bodyRender: (row) => `<center>${row.sku}</center>`,
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "name",
        text: localize('Name'),
        bodyRender: (row) => capitalize(row.name),
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "price",
        text: localize('Price') + ` (${Currency})`,
        width: 20,
        headRender: () => `<center>${localize('Price')} (${Currency})</center>`,
        headPdfRender: function() {
            return this.headRender();
        },
        bodyRender: (row) =>
            `<center>${monitize(row.price)}</center>`,
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: (row) => monitize(row.price),
    }, {
        name: "views",
        text: localize('Views'),
        width: 20,
        headRender: () => `<center>${localize('Views')}</center>`,
        headPdfRender: function() {
            return this.headRender();
        },
        bodyRender: (row) => `<center>${row.views}</center>`,
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
    }],
    sellers: ({ Currency }) => [{
        name: "id",
        text: localize("Id"),
        width: 20,
        headRender: () => `<center>${localize("Id")}</center>`,
        headPdfRender: function() {
            return this.headRender();
        },
        bodyRender: (row) =>
            `<span style="font-weight: 500; text-align: center; display: block;">#${row.id}</span>`,
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "image",
        text: localize('Image'),
        width: 20,
        headRender: () => `<center>${localize('Image')}</center>`,
        headPdfRender: function() {
            return this.headRender();
        },
        bodyRender: (row) => `<img part="image" src="${imagelize(row.storage)}" />`,
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: (row) => imagelize(row.storage)
    }, {
        name: "sku",
        text: localize('Sku'),
        width: 100,
        headRender: () => `<center>${localize('Sku')}</center>`,
        headPdfRender: function() {
            return this.headRender();
        },
        bodyRender: (row) => `<center>${row.sku}</center>`,
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "name",
        text: localize('Name'),
        bodyRender: (row) => capitalize(row.name),
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "price",
        text: localize('Price') + ` (${Currency})`,
        width: 20,
        headRender: () => `<center>${localize('Price')} (${Currency})</center>`,
        headPdfRender: function() {
            return this.headRender();
        },
        bodyRender: (row) =>
            `<center>${monitize(row.price)}</center>`,
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: (row) => monitize(row.price),
    }, {
        name: "total",
        text: localize('Total'),
        width: 20,
        headRender: () => `<center>${localize('Total')}</center>`,
        headPdfRender: function() {
            return this.headRender();
        },
        bodyRender: (row) => `<center>${row.total}</center>`,
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
    }],
    users: ({
        Csrf,
        Patch,
        Clear
    }) => [{
        name: "id",
        text: localize("Id"),
        width: 20,
        headRender: () => `<center>${localize("Id")}</center>`,
        headPdfRender: function() {
            return this.headRender();
        },
        bodyRender: (row) =>
            `<span style="font-weight: 500; text-align: center; display: block;">#${row.id}</span>`,
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "first_name",
        text: localize("First Name"),
        bodyRender: (row) => capitalize(row.first_name),
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "last_name",
        text: localize("Last Name"),
        bodyRender: (row) => capitalize(row.last_name),
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "gender",
        text: localize("Gender"),
        visible: false,
        bodyRender: (row) => row.gender ? capitalize(row.gender) : "__",
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        visible: false,
        name: "birth_date",
        text: localize("Birth Date"),
        bodyRender: (row) => row.birth_date ? row.birth_date : "__",
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "email",
        text: localize("Email")
    }, {
        name: "phone",
        text: localize("Phone")
    }, {
        name: "address",
        text: localize("Address"),
        visible: false,
        bodyRender: (row) => row.address ? capitalize(row.address) : "__",
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "action",
        text: localize("Actions"),
        width: 20,
        headRender: () => `<center>${localize("Actions")}</center>`,
        headPdfRender: function() {
            return this.headRender();
        },
        bodyRender: (row) => {
            return `
                <action-tools 
                    target="${row.id}" 
                    csrf="${Csrf}"
                    patch="${Patch}"
                    clear="${Clear}"
                />
            `;
        },
        bodyPdfRender: () => "",
        bodyCsvRender: () => "",
    }],
    brands: ({
        Csrf,
        Patch,
        Clear
    }) => [{
        name: "id",
        text: localize("Id"),
        width: 20,
        headRender: () => `<center>${localize("Id")}</center>`,
        headPdfRender: function() {
            return this.headRender();
        },
        bodyRender: (row) =>
            `<span style="font-weight: 500; text-align: center; display: block;">#${row.id}</span>`,
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "image",
        text: localize('Image'),
        width: 20,
        headRender: () => `<center>${localize('Image')}</center>`,
        headPdfRender: function() {
            return this.headRender();
        },
        bodyRender: (row) => `<img part="image" src="${imagelize(row.image.storage)}" />`,
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return imagelize(row.image.storage);
        },
    }, {
        name: "name_en",
        text: localize('Name') + " (en)",
        visible: Locale === "en",
        bodyRender: (row) => capitalize(row.name_en),
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "name_it",
        text: localize('Name') + " (it)",
        visible: Locale === "it",
        bodyRender: (row) => capitalize(row.name_it),
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "name_fr",
        text: localize('Name') + " (fr)",
        visible: Locale === "fr",
        bodyRender: (row) => capitalize(row.name_fr),
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "name_ar",
        text: localize('Name') + " (ar)",
        visible: Locale === "ar",
        bodyRender: (row) => capitalize(row.name_ar),
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "description_en",
        text: localize('Description') + " (en)",
        visible: false,
        bodyRender: (row) => row.description_en ? capitalize(row.description_en) : "__",
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "description_it",
        text: localize('Description') + " (it)",
        visible: false,
        bodyRender: (row) => row.description_it ? capitalize(row.description_it) : "__",
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "description_fr",
        text: localize('Description') + " (fr)",
        visible: false,
        bodyRender: (row) => row.description_fr ? capitalize(row.description_fr) : "__",
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "description_ar",
        text: localize('Description') + " (ar)",
        visible: false,
        bodyRender: (row) => row.description_ar ? capitalize(row.description_ar) : "__",
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "action",
        text: localize("Actions"),
        width: 20,
        headRender: () => `<center>${localize("Actions")}</center>`,
        headPdfRender: function() {
            return this.headRender();
        },
        bodyRender: (row) => {
            return `
                <action-tools 
                    target="${row.id}" 
                    csrf="${Csrf}"
                    patch="${Patch}"
                    clear="${Clear}"
                />
            `;
        },
        bodyPdfRender: () => "",
        bodyCsvRender: () => "",
    }],
    categories: ({
        Csrf,
        Patch,
        Clear
    }) => [{
        name: "id",
        text: localize("Id"),
        width: 20,
        headRender: () => `<center>${localize("Id")}</center>`,
        headPdfRender: function() {
            return this.headRender();
        },
        bodyRender: (row) =>
            `<span style="font-weight: 500; text-align: center; display: block;">#${row.id}</span>`,
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "image",
        text: localize('Image'),
        width: 20,
        headRender: () => `<center>${localize('Image')}</center>`,
        headPdfRender: function() {
            return this.headRender();
        },
        bodyRender: (row) => `<img part="image" src="${imagelize(row.image.storage)}" />`,
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return imagelize(row.image.storage);
        },
    }, {
        name: "name_en",
        text: localize('Name') + " (en)",
        visible: Locale === "en",
        bodyRender: (row) => capitalize(row.name_en),
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "name_it",
        text: localize('Name') + " (it)",
        visible: Locale === "it",
        bodyRender: (row) => capitalize(row.name_it),
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "name_fr",
        text: localize('Name') + " (fr)",
        visible: Locale === "fr",
        bodyRender: (row) => capitalize(row.name_fr),
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "name_ar",
        text: localize('Name') + " (ar)",
        visible: Locale === "ar",
        bodyRender: (row) => capitalize(row.name_ar),
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "description_en",
        text: localize('Description') + " (en)",
        visible: false,
        bodyRender: (row) => row.description_en ? capitalize(row.description_en) : "__",
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "description_it",
        text: localize('Description') + " (it)",
        visible: false,
        bodyRender: (row) => row.description_it ? capitalize(row.description_it) : "__",
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "description_fr",
        text: localize('Description') + " (fr)",
        visible: false,
        bodyRender: (row) => row.description_fr ? capitalize(row.description_fr) : "__",
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "description_ar",
        text: localize('Description') + " (ar)",
        visible: false,
        bodyRender: (row) => row.description_ar ? capitalize(row.description_ar) : "__",
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "action",
        text: localize("Actions"),
        width: 20,
        headRender: () => `<center>${localize("Actions")}</center>`,
        headPdfRender: function() {
            return this.headRender();
        },
        bodyRender: (row) => {
            return `
                <action-tools 
                    target="${row.id}" 
                    csrf="${Csrf}"
                    patch="${Patch}"
                    clear="${Clear}"
                />
            `;
        },
        bodyPdfRender: () => "",
        bodyCsvRender: () => "",
    }],
    products: ({
        Currency,
        Csrf,
        Patch,
        Clear
    }) => [{
        name: "id",
        text: localize("Id"),
        width: 20,
        headRender: () => `<center>${localize("Id")}</center>`,
        headPdfRender: function() {
            return this.headRender();
        },
        bodyRender: (row) =>
            `<span style="font-weight: 500; text-align: center; display: block;">#${row.id}</span>`,
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "image",
        text: localize('Image'),
        width: 20,
        headRender: () => `<center>${localize('Image')}</center>`,
        headPdfRender: function() {
            return this.headRender();
        },
        bodyRender: (row) => `<img part="image" src="${imagelize(row.images[0].storage)}" />`,
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return imagelize(row.images[0].storage);
        },
    }, {
        name: "name_en",
        text: localize('Name') + " (en)",
        visible: Locale === "en",
        bodyRender: (row) => capitalize(row.name_en),
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "name_it",
        text: localize('Name') + " (it)",
        visible: Locale === "it",
        bodyRender: (row) => capitalize(row.name_it),
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "name_fr",
        text: localize('Name') + " (fr)",
        visible: Locale === "fr",
        bodyRender: (row) => capitalize(row.name_fr),
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "name_ar",
        text: localize('Name') + " (ar)",
        visible: Locale === "ar",
        bodyRender: (row) => capitalize(row.name_ar),
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "sku",
        text: localize('Sku'),
        headRender: () => `<center>${localize('Sku')}</center>`,
        headPdfRender: function() {
            return this.headRender();
        },
        bodyRender: (row) => `<center>${row.sku}</center>`,
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        width: 100,
    }, {
        name: "unit",
        text: localize('Unit'),
        width: 100,
        bodyRender: (row) => localize(capitalize(row.unit)),
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "brand",
        text: localize('Brand'),
        width: 20,
        bodyRender: (row) => capitalize(row.brand["name_" + Locale]),
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "category",
        text: localize('Category'),
        width: 20,
        bodyRender: (row) => capitalize(row.category["name_" + Locale]),
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "price",
        text: localize('Price') + ` (${Currency})`,
        width: 20,
        headRender: () => `<center>${localize('Price')} (${Currency})</center>`,
        headPdfRender: function() {
            return this.headRender();
        },
        bodyRender: (row) =>
            `<center>${monitize(row.price)}</center>`,
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "status",
        text: localize('Status'),
        headRender: () => `<center>${localize('Status')}</center>`,
        headPdfRender: function() {
            return this.headRender();
        },
        bodyRender: (row) => `<center>${localize(capitalize(row.status))}</center>`,
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: (row) => localize(capitalize(row.status)),
        width: 100,
    }, {
        name: "details_en",
        text: localize('Details') + " (en)",
        visible: false,
        bodyRender: (row) => row.details_en ? capitalize(row.details_en) : "__",
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "details_it",
        text: localize('Details') + " (it)",
        visible: false,
        bodyRender: (row) => row.details_it ? capitalize(row.details_it) : "__",
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "details_fr",
        text: localize('Details') + " (fr)",
        visible: false,
        bodyRender: (row) => row.details_fr ? capitalize(row.details_fr) : "__",
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "details_ar",
        text: localize('Details') + " (ar)",
        visible: false,
        bodyRender: (row) => row.details_ar ? capitalize(row.details_ar) : "__",
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "action",
        text: localize("Actions"),
        width: 20,
        headRender: () => `<center>${localize("Actions")}</center>`,
        headPdfRender: function() {
            return this.headRender();
        },
        bodyRender: (row) => {
            return `
                <action-tools 
                    target="${row.id}" 
                    csrf="${Csrf}"
                    patch="${Patch}"
                    clear="${Clear}"
                />
            `;
        },
        bodyPdfRender: () => "",
        bodyCsvRender: () => "",
    }],
    quotations: ({
        Currency,
        Csrf,
        Scene,
        Print,
        Patch,
        Clear
    }) => [{
        name: "id",
        text: localize("Id"),
        width: 20,
        headRender: () => `<center>${localize("Id")}</center>`,
        headPdfRender: function() {
            return this.headRender();
        },
        bodyRender: (row) =>
            `<span style="font-weight: 500; text-align: center; display: block;">#${row.id}</span>`,
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "reference",
        text: localize('Reference'),
        width: 20,
        headRender: () => `<center>${localize('Reference')}</center>`,
        headPdfRender: function() {
            return this.headRender();
        },
        bodyRender: (row) =>
            `<span style="text-align: center; display: block;">#${row.reference}</span>`,
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "name",
        text: localize('Name'),
        bodyRender: (row) => camelize(row.name),
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "email",
        text: localize('Email'),
        visible: false,
    }, {
        name: "phone",
        text: localize('Phone'),
        visible: false,
    }, {
        name: "count",
        text: localize('Products Count'),
        width: 160,
        headRender: () => `<center>${localize('Products Count')}</center>`,
        headPdfRender: function() {
            return this.headRender();
        },
        bodyRender: (row) =>
            `<center>${row.items.length} (${row.items.reduce((a, e) => a + e.quantity, 0)})</center>`,
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return `${row.items.length} (${row.items.reduce((a, e) => a + e.quantity, 0)})`;
        },
    }, {
        name: "total",
        text: localize('Total') + ` (${Currency})`,
        width: 20,
        headRender: () => `<center>${localize('Total')} (${Currency})</center>`,
        headPdfRender: function() {
            return this.headRender();
        },
        bodyRender: (row) =>
            `<center>${monitize(row.total)}</center>`,
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "charges",
        text: localize('Charges') + ` (${Currency})`,
        width: 20,
        headRender: () => `<center>${localize('Charges')} (${Currency})</center>`,
        headPdfRender: function() {
            return this.headRender();
        },
        bodyRender: (row) =>
            `<center>${monitize(row.total * (row.charges / 100))}</center>`,
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "note_en",
        text: localize('Note') + " (en)",
        visible: false,
        bodyRender: (row) => row.note_en ? capitalize(row.note_en) : "__",
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "note_it",
        text: localize('Note') + " (it)",
        visible: false,
        bodyRender: (row) => row.note_it ? capitalize(row.note_it) : "__",
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "note_fr",
        text: localize('Note') + " (fr)",
        visible: false,
        bodyRender: (row) => row.note_fr ? capitalize(row.note_fr) : "__",
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "note_ar",
        text: localize('Note') + " (ar)",
        visible: false,
        bodyRender: (row) => row.note_ar ? capitalize(row.note_ar) : "__",
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "action",
        text: localize("Actions"),
        width: 20,
        headRender: () => `<center>${localize("Actions")}</center>`,
        headPdfRender: function() {
            return this.headRender();
        },
        bodyRender: (row) => {
            return `
                <action-tools 
                    target="${row.id}" 
                    csrf="${Csrf}"
                    scene="${Scene}"
                    print="${Print}"
                    patch="${Patch}"
                    clear="${Clear}"
                />
            `;
        },
        bodyPdfRender: () => "",
        bodyCsvRender: () => "",
    }],
    invoices: ({
        Currency,
        Csrf,
        Scene,
        Print,
        Patch,
        Clear
    }) => [{
        name: "id",
        text: localize("Id"),
        width: 20,
        headRender: () => `<center>${localize("Id")}</center>`,
        headPdfRender: function() {
            return this.headRender();
        },
        bodyRender: (row) =>
            `<span style="font-weight: 500; text-align: center; display: block;">#${row.id}</span>`,
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "reference",
        text: localize('Reference'),
        width: 20,
        headRender: () => `<center>${localize('Reference')}</center>`,
        headPdfRender: function() {
            return this.headRender();
        },
        bodyRender: (row) =>
            `<span style="text-align: center; display: block;">#${row.reference}</span>`,
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "type",
        text: localize('Type'),
        bodyRender: (row) => camelize(row.type),
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "name",
        text: localize('Name'),
        bodyRender: (row) => camelize(row.name),
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "email",
        text: localize('Email'),
        visible: false,
    }, {
        name: "phone",
        text: localize('Phone'),
        visible: false,
    }, {
        name: "count",
        text: localize('Products Count'),
        width: 160,
        headRender: () => `<center>${localize('Products Count')}</center>`,
        headPdfRender: function() {
            return this.headRender();
        },
        bodyRender: (row) =>
            `<center>${row.items.length} (${row.items.reduce((a, e) => a + e.quantity, 0)})</center>`,
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return `${row.items.length} (${row.items.reduce((a, e) => a + e.quantity, 0)})`;
        },
    }, {
        name: "total",
        text: localize('Total') + ` (${Currency})`,
        width: 20,
        headRender: () => `<center>${localize('Total')} (${Currency})</center>`,
        headPdfRender: function() {
            return this.headRender();
        },
        bodyRender: (row) =>
            `<center>${monitize(row.total)}</center>`,
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "charges",
        text: localize('Charges') + ` (${Currency})`,
        width: 20,
        headRender: () => `<center>${localize('Charges')} (${Currency})</center>`,
        headPdfRender: function() {
            return this.headRender();
        },
        bodyRender: (row) =>
            `<center>${monitize(row.total * (row.charges / 100))}</center>`,
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "note_en",
        text: localize('Note') + " (en)",
        visible: false,
        bodyRender: (row) => row.note_en ? capitalize(row.note_en) : "__",
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "note_it",
        text: localize('Note') + " (it)",
        visible: false,
        bodyRender: (row) => row.note_it ? capitalize(row.note_it) : "__",
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "note_fr",
        text: localize('Note') + " (fr)",
        visible: false,
        bodyRender: (row) => row.note_fr ? capitalize(row.note_fr) : "__",
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "note_ar",
        text: localize('Note') + " (ar)",
        visible: false,
        bodyRender: (row) => row.note_ar ? capitalize(row.note_ar) : "__",
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "action",
        text: localize("Actions"),
        width: 20,
        headRender: () => `<center>${localize("Actions")}</center>`,
        headPdfRender: function() {
            return this.headRender();
        },
        bodyRender: (row) => {
            return `
                <action-tools 
                    target="${row.id}" 
                    csrf="${Csrf}"
                    scene="${Scene}"
                    print="${Print}"
                    patch="${Patch}"
                    clear="${Clear}"
                />
            `;
        },
        bodyPdfRender: () => "",
        bodyCsvRender: () => "",
    }],
    requests: ({
        Currency,
        Csrf,
        Scene,
        Clear
    }) => [{
        name: "id",
        text: localize("Id"),
        width: 20,
        headRender: () => `<center>${localize("Id")}</center>`,
        headPdfRender: function() {
            return this.headRender();
        },
        bodyRender: (row) =>
            `<span style="font-weight: 500; text-align: center; display: block;">#${row.id}</span>`,
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "name",
        text: localize('Name'),
        bodyRender: (row) => camelize(row.name),
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "email",
        text: localize('Email'),
    }, {
        name: "phone",
        text: localize('Phone'),
    }, {
        name: "count",
        text: localize('Products Count'),
        width: 160,
        headRender: () => `<center>${localize('Products Count')}</center>`,
        headPdfRender: function() {
            return this.headRender();
        },
        bodyRender: (row) =>
            `<center>${row.items.length} (${row.items.reduce((a, e) => a + e.quantity, 0)})</center>`,
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return `${row.items.length} (${row.items.reduce((a, e) => a + e.quantity, 0)})`;
        },
    }, {
        name: "total",
        text: localize('Total') + ` (${Currency})`,
        width: 20,
        headRender: () => `<center>${localize('Total')} (${Currency})</center>`,
        headPdfRender: function() {
            return this.headRender();
        },
        bodyRender: (row) =>
            `<center>${monitize(row.total)}</center>`,
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "message",
        text: localize('Message'),
        visible: false,
        bodyRender: (row) => row.message ? capitalize(row.message) : "__",
        bodyPdfRender: function(row) {
            return this.bodyRender(row);
        },
        bodyCsvRender: function(row) {
            return this.bodyRender(row);
        },
    }, {
        name: "action",
        text: localize("Actions"),
        width: 20,
        headRender: () => `<center>${localize("Actions")}</center>`,
        headPdfRender: function() {
            return this.headRender();
        },
        bodyRender: (row) => {
            return `
                <action-tools 
                    target="${row.id}" 
                    csrf="${Csrf}"
                    scene="${Scene}"
                    clear="${Clear}"
                />
            `;
        },
        bodyPdfRender: () => "",
        bodyCsvRender: () => "",
    }],
}

function localize(str) {
    const locale = Locale;
    return (Dictionary[locale] && Dictionary[locale][str]) || str;
}

function capitalize(string) {
    if (typeof string !== 'string' || string.length === 0)
        return string;
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function camelize(str) {
    return str.replace(/\w\S*/g, (txt) => txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase());
}

function imagelize(url) {
    return [window.location.origin, "storage/IMAGES", url].join("/");
}

function monitize(num) {
    let formatted = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'XXX'
    }).format(num).replace("XXX", "").trim();
    let decimalIndex = formatted.indexOf('.');
    let decimalPart = decimalIndex === -1 ? '00' : formatted.slice(decimalIndex + 1);
    decimalPart = decimalPart.padEnd(3, '0');
    if (decimalIndex === -1) formatted += '.' + decimalPart;
    else formatted = formatted.slice(0, decimalIndex) + '.' + decimalPart;
    return formatted;
}

function imagesUpdater(imageTransfer) {
    imageTransfer.addEventListener("delete", ({ detail: { data } }) => {
        if (data instanceof File) return;
        imageTransfer.insertAdjacentHTML("afterend", `<input type="hidden" name="deleted[]" value="${data.id}" />`);
    });
}

async function getData(url, createLinks) {
    const req = await fetch(url);
    const res = await req.json();
    createLinks && createLinks(res.prev_cursor, res.next_cursor, (new URL(url)).searchParams.get("search"));
    return res.data;
}

function TableVisualizer(dataVisualizer, Type, Data) {
    var timer;
    const Links = document.createElement("div");
    Links.innerHTML = `
        <a id="prev" slot="end"
            class="block w-6 h-6 text-x-black outline-none relative isolate before:content-[''] before:rounded-x-thin before:absolute before:block before:w-[130%] before:h-[130%] before:-inset-[15%] before:-z-[1] before:!bg-opacity-40 hover:before:bg-x-shade focus:before:bg-x-shade focus-within:before:bg-x-shade">
            <svg class="block w-6 h-6 pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960">
                <path
                    d="M452-219 190-481l262-262 64 64-199 198 199 197-64 65Zm257 0L447-481l262-262 63 64-198 198 198 197-63 65Z" />
            </svg>
        </a>
        <a id="next" slot="end"
            class="block w-6 h-6 text-x-black outline-none relative isolate before:content-[''] before:rounded-x-thin before:absolute before:block before:w-[130%] before:h-[130%] before:-inset-[15%] before:-z-[1] before:!bg-opacity-40 hover:before:bg-x-shade focus:before:bg-x-shade focus-within:before:bg-x-shade">
            <svg class="block w-6 h-6 pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960">
                <path
                    d="M388-481 190-679l64-64 262 262-262 262-64-65 198-197Zm257 0L447-679l63-64 262 262-262 262-63-65 198-197Z" />
            </svg>
        </a>
    `;

    async function event(e) {
        e.preventDefault();
        dataVisualizer.loading = true;
        dataVisualizer.rows = await getData(e.target.href, createLinks);
        dataVisualizer.loading = false;
    }

    function createLinks(prev, next, str) {
        const search = "?search" + (str ? ("=" + str) : "");
        const preva = document.querySelector("#prev");
        const nexta = document.querySelector("#next");
        if (prev) {
            const href = Data.Search + search + "&cursor=" + prev;
            if (preva) preva.href = href
            else {
                const _preva = Links.querySelector("#prev").cloneNode(true);
                _preva.addEventListener("click", event);
                if (nexta) dataVisualizer.insertBefore(_preva, nexta);
                else dataVisualizer.appendChild(_preva);
                _preva.title = localize("Prev");
                _preva.href = href;
            }
        } else {
            if (preva) {
                preva.removeEventListener("click", event);
                preva.remove();
            }
        }
        if (next) {
            const href = Data.Search + search + "&cursor=" + next;
            if (nexta) nexta.href = href
            else {
                const _nexta = Links.querySelector("#next").cloneNode(true);
                _nexta.addEventListener("click", event);
                dataVisualizer.appendChild(_nexta);
                _nexta.title = localize("Next");
                _nexta.href = href;
            }
        } else {
            if (nexta) {
                nexta.removeEventListener("click", event);
                nexta.remove();
            }
        }
    }

    (async function() {
        dataVisualizer.loading = true;
        dataVisualizer.rows = await getData(Data.Search + window.location.search, createLinks);
        dataVisualizer.loading = false;
    })();

    dataVisualizer.cols = Types[Type]({
        Currency: Data.Currency,
        Scene: Data.Scene,
        Print: Data.Print,
        Patch: Data.Patch,
        Clear: Data.Clear,
        Csrf: Data.Csrf,
    });

    dataVisualizer.addEventListener("search", async e => {
        e.preventDefault();
        if (timer) clearTimeout(timer);
        dataVisualizer.loading = true;
        dataVisualizer.rows = await new Promise((resolver, rejecter) => {
            timer = setTimeout(async() => {
                const data = await getData(Data.Search + "?search=" +
                    encodeURIComponent(e.detail
                        .data), createLinks);
                resolver(data);
            }, 2000);
        });
        dataVisualizer.loading = false;
    });
}

function ProductInitializer(List = [], imageTransfer) {
    ["#description_en", "#description_fr", "#description_it", "#description_ar"].forEach(editor => {
        new RichTextEditor(editor);
    });

    document.querySelectorAll("[rte-cmd-name=fullscreenenter]").forEach(el => {
        el.addEventListener("click", e => {
            OS.$Wrapper.closed = true;
            OS.$Wrapper.state.screen = false;
        })
    });

    document.querySelectorAll("[rte-cmd-name=fullscreenexit]").forEach(el => {
        el.addEventListener("click", e => {
            OS.$Wrapper.closed = false;
            OS.$Wrapper.state.screen = true;
        })
    });

    if (imageTransfer) imagesUpdater(imageTransfer);

    List.forEach(Item => {
        var timer;
        Item.Fillable.addEventListener("input", async(e) => {
            if (timer) clearTimeout(timer);
            Item.Fillable.results = await new Promise((resolver, rejecter) => {
                timer = setTimeout(async() => {
                    const data = await getData(Item.Link + "?search=" +
                        encodeURIComponent(
                            Item.Fillable.query.trim()));
                    resolver(data);
                }, 1000);
            });
        });
    });
}

function FinanceInitializer({ showcase, fillable, charges, finances }, data = []) {
    const finance = {
        SubTotal: finances.querySelector("[data-for=subtotal]"),
        Charges: finances.querySelector("[data-for=charges]"),
        Total: finances.querySelector("[data-for=total]"),
    }

    function clearFillable() {
        fillable.Fillable.query = "";
        fillable.Fillable.results = null;
    }

    function createRow(main, data) {
        const json = JSON.stringify({
            ...(data.id ? { id: data.id } : {}),
            quantity: data.quantity || 1,
            product: data.product,
            price: data.price,
        });

        const row = (new DOMParser).parseFromString(`
                <table>
                    <tr class="border-t border-x-black">
                        <td class="text-x-black text-base font-medium px-4 py-2 text-center w-[20px] first:ps-8 last:pe-8">
                            <input type="hidden" data-for="item" name="items[]" value='${json}' />
                            <span data-for="id">#${main.children.length + 1}</span>
                        </td>
                        <td data-for="sku" class="text-x-black text-base px-4 py-2 text-center w-[20px] first:ps-8 last:pe-8">
                            ${data.sku}    
                        </td>
                        <td data-for="name" class="text-x-black text-base px-4 py-2 first:ps-8 last:pe-8">
                            ${data.name}    
                        </td>
                        <td class="text-x-black text-base px-4 py-2 text-center w-[20px] first:ps-8 last:pe-8">
                            <input type="number" data-for="quantity" value="${data.quantity || 1}" class="w-24 text-sm font-medium text-center px-2 py-1 rounded-x-thin bg-transparent border border-x-black focus:outline-x-prime focus-within:outline-x-prime" />
                        </td>
                        <td class="text-x-black text-base px-4 py-2 text-center w-[140px] first:ps-8 last:pe-8">
                            <input type="number" data-for="price" value="${data.price}" class="w-24 text-sm font-medium text-center px-2 py-1 rounded-x-thin bg-transparent border border-x-black focus:outline-x-prime focus-within:outline-x-prime" />
                        </td>
                        <td data-for="total" class="text-x-black text-base font-medium  px-4 py-2 text-center w-[140px] first:ps-8 last:pe-8"></td>
                        <td class="text-x-black text-base px-4 py-2 text-center w-[20px] first:ps-8 last:pe-8">
                            <button class="flex px-2 py-1 outline-none rounded-x-thin bg-red-400 text-x-white hover:bg-opacity-60 focus:bg-opacity-60 focus-within:bg-opacity-60">
                                 <svg class="w-4 h-4 block pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960">
                                    <path
                                        d="M253-99q-36.462 0-64.231-26.775Q161-152.55 161-190v-552h-11q-18.75 0-31.375-12.86Q106-767.719 106-787.36 106-807 118.613-820q12.612-13 31.387-13h182q0-20 13.125-33.5T378-880h204q19.625 0 33.312 13.75Q629-852.5 629-833h179.921q20.279 0 33.179 13.375 12.9 13.376 12.9 32.116 0 20.141-12.9 32.825Q829.2-742 809-742h-11v552q0 37.45-27.069 64.225Q743.863-99 706-99H253Zm104-205q0 14.1 11.051 25.05 11.051 10.95 25.3 10.95t25.949-10.95Q431-289.9 431-304v-324q0-14.525-11.843-26.262Q407.313-666 392.632-666q-14.257 0-24.944 11.738Q357-642.525 357-628v324Zm173 0q0 14.1 11.551 25.05 11.551 10.95 25.8 10.95t25.949-10.95Q605-289.9 605-304v-324q0-14.525-11.545-26.262Q581.91-666 566.93-666q-14.555 0-25.742 11.738Q530-642.525 530-628v324Z" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                </table>
            `, "text/html").querySelector("tr");
        row.Id = row.querySelector("[data-for=id]");
        row.Sku = row.querySelector("[data-for=sku]");
        row.Name = row.querySelector("[data-for=name]");
        row.Item = row.querySelector("[data-for=item]");
        row.Quantity = row.querySelector("[data-for=quantity]");
        row.Price = row.querySelector("[data-for=price]");
        row.Total = row.querySelector("[data-for=total]");
        row.Btn = row.querySelector("button");

        function calculate() {
            row.Total.textContent = monitize(+row.Price.value * +row.Quantity.value);
            row.Item.value = JSON.stringify({
                ...(data.id ? { id: data.id } : {}),
                quantity: +row.Quantity.value,
                price: +row.Price.value,
                product: data.product,
            });
            window.dispatchEvent(new CustomEvent("table:change", {
                detail: data,
            }));
        }

        row.Quantity.addEventListener("input", calculate);
        row.Price.addEventListener("input", calculate);
        row.Btn.addEventListener("click", e => {
            row.remove(), calculate();
            window.dispatchEvent(new CustomEvent("table:delete", {
                detail: data,
            }));
        });
        row.Quantity.addEventListener("change", ({
            target
        }) => {
            if (+target.value > 0) return;
            target.value = 1;
            calculate();
        });

        calculate();
        main.insertAdjacentElement("afterbegin", row);
        window.dispatchEvent(new CustomEvent("table:create", {
            detail: data,
        }));
        clearFillable();
        return row;
    }

    function subTotal() {
        const subtotal = [...showcase.querySelectorAll("[data-for=total]")].map(e => +e.textContent.replace(/,/g, "")).filter(Boolean).reduce((a, e) => a + e, 0);
        finance.SubTotal.textContent = monitize(subtotal);
        return subtotal;
    }

    function subCharges() {
        const subtotal = subTotal();
        const charges$ = +(charges instanceof HTMLElement ? charges.value : charges) || 0;
        const _charges = subtotal * (charges$ / 100);
        finance.Charges.textContent = monitize(_charges);
        return [subtotal, _charges];
    }

    function total() {
        const total = subCharges().reduce((a, e) => a + e, 0);
        finance.Total.textContent = monitize(total);
        return total;
    }

    if (fillable) {
        var timer;
        fillable.Fillable.addEventListener("input", async(e) => {
            if (timer) clearTimeout(timer);
            fillable.Fillable.results = await new Promise((resolver, rejecter) => {
                timer = setTimeout(async() => {
                    const data = await getData(fillable.Link + "?search=" +
                        encodeURIComponent(
                            fillable.Fillable.query.trim()));
                    resolver(data);
                }, 1000);
            });
        });

        fillable.Fillable.addEventListener("select", (e) => {
            const data = e.detail.data;
            const row = createRow(showcase, {
                product: data.id,
                sku: data.sku,
                price: data.price,
                name: data[fillable.Fillable.setQuery]
            });

            setTimeout(() => {
                clearFillable();
                row.Quantity.focus();
            }, 500)
        });
    }

    window.addEventListener("table:create", total);
    window.addEventListener("table:change", total);
    window.addEventListener("table:delete", () => {
        total(), [...showcase.children]
            .reverse().forEach((r, i) => r.Id.textContent = "#" + (i + 1))
    });

    charges instanceof HTMLElement && charges.addEventListener("input", total);

    data.forEach(row => createRow(showcase, row));

    if (data.length)
        window.addEventListener("table:delete", ({ detail }) => {
            if (detail.type !== "default") return;
            fillable.Fillable.insertAdjacentHTML("afterend", `<input type="hidden" name="deleted[]" value="${detail.id}" />`);
        });

    total();
}

function parse(str) {
    if (!str) return '""';
    str = String(str).replace(/"/g, `""`);
    if (/[",\n]/.test(str)) {
        str = `"${str}"`;
    }
    return str;
}

async function ChartVisualizer(chart, { Currency, Link }) {
    const base = await getData(Link);
    const data = Locale === 'ar' ? base.map(e => e.reverse()) : base;
    const labels = ["", `${localize("Requests")} (${Currency})`, `${localize("Quotations")} (${Currency})`, `${localize("Invoices")} (${Currency})`];
    const csv = data.reduce((a, c, i) => {
        a.push(Locale === 'ar' ? [...c, labels[i]] : [labels[i], ...c]);
        return a;
    }, []).map(e => e.map(c => parse(typeof c === "number" ? monitize(c) : c)).join(',')).join("\n");

    document.querySelector("#downloader").href = URL.createObjectURL(new Blob([csv], {
        type: "text/csv",
    }));

    new Chart(chart, {
        type: "bar",
        data: {
            labels: data[0],
            datasets: [{
                label: labels[1],
                data: data[1],
                borderWidth: 1,
                backgroundColor: "#f44336",
                borderColor: "#f44336",
                order: 1,
            }, {
                label: labels[2],
                data: data[2],
                borderWidth: 1,
                backgroundColor: "#14B8A6",
                borderColor: "#14B8A6",
                order: 2,
            }, {
                label: labels[3],
                data: data[3],
                borderWidth: 1,
                backgroundColor: "#06B6D4",
                borderColor: "#06B6D4",
                order: 3,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    rtl: Locale === "ar",
                    padding: 16
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    position: Locale === "ar" ? "right" : "left",
                },
            }
        }
    });

    chart.parentElement.classList.remove("aspect-video");
    chart.nextElementSibling.remove();

    document.querySelector("#printer").addEventListener("click", () => {
        document.querySelector("#chart-viewer").src = chart.toDataURL();
        document.querySelector("os-printable").print();
    });

    function resize() {
        chart.style.height = "100%";
        chart.style.width = "100%";
    }

    window.addEventListener("resize", () => setTimeout(resize, 500));
    document.querySelector("#trigger")
        .addEventListener("click", () => setTimeout(resize, 500));
}