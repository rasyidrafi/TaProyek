var _slicedToArray = function () { function sliceIterator(arr, i) { var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"]) _i["return"](); } finally { if (_d) throw _e; } } return _arr; } return function (arr, i) { if (Array.isArray(arr)) { return arr; } else if (Symbol.iterator in Object(arr)) { return sliceIterator(arr, i); } else { throw new TypeError("Invalid attempt to destructure non-iterable instance"); } }; }();

function _toConsumableArray(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } else { return Array.from(arr); } }

function AddTransaksi() {
    var _React$useState = React.useState({
        nama: "",
        jatuh_tempo: "",
        tipe: "bayar ditempat",
        pembayaran: "cash",
        lokasi_pembeli: "",
        ongkir: 0
    }),
        _React$useState2 = _slicedToArray(_React$useState, 2),
        model = _React$useState2[0],
        setModel = _React$useState2[1];

    $('input[type=radio]').change(function () {
        if (this.value == 'qris' || this.value == "debit") {
            $("#jatuh-tempo").removeClass('d-none');
        } else {
            $("#jatuh-tempo").addClass("d-none");
        }
        setModel(Object.assign({}, model, {
            pembayaran: this.value
        }));
    });

    var allMenu = JSON.parse($("#all-menu").html().trim());

    var _React$useState3 = React.useState([]),
        _React$useState4 = _slicedToArray(_React$useState3, 2),
        menuList = _React$useState4[0],
        setMenuList = _React$useState4[1];

    function formatRupiahReact(angka, prefix) {
        if (angka[0] == '0') {
            angka = angka.substr(1);
        }

        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : rupiah ? 'Rp. ' + rupiah : '';
    }

    var handleSubmit = function handleSubmit() {
        $("#add-transaksi-form").submit();
    };

    return React.createElement(
        React.Fragment,
        null,
        React.createElement(
            "div",
            { className: "row invoice layout-top-spacing layout-spacing" },
            React.createElement(
                "div",
                { className: "col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" },
                React.createElement(
                    "div",
                    { className: "doc-container" },
                    React.createElement(
                        "div",
                        { className: "row" },
                        React.createElement(
                            "div",
                            { className: "col-xl-9" },
                            React.createElement(
                                "div",
                                { className: "invoice-content" },
                                React.createElement(
                                    "div",
                                    { className: "invoice-detail-body" },
                                    React.createElement(
                                        "div",
                                        { className: "invoice-detail-header" },
                                        React.createElement(
                                            "div",
                                            { className: "row justify-content-between" },
                                            React.createElement(
                                                "div",
                                                { className: "col-12 invoice-address-client" },
                                                React.createElement(
                                                    "h4",
                                                    null,
                                                    "Data Customer:"
                                                ),
                                                React.createElement(
                                                    "div",
                                                    { className: "invoice-address-client-fields" },
                                                    React.createElement(
                                                        "div",
                                                        { className: "form-group row" },
                                                        React.createElement(
                                                            "label",
                                                            { htmlFor: "nama_pembeli", className: "col-sm-3 col-form-label col-form-label-sm" },
                                                            "Nama Pembeli"
                                                        ),
                                                        React.createElement(
                                                            "div",
                                                            { className: "col-sm-9" },
                                                            React.createElement("input", { required: true, type: "text", value: model.nama, onChange: function onChange(e) {
                                                                    e.target.value = e.target.value.trimStart();
                                                                    setModel(Object.assign({}, model, { nama: e.target.value }));
                                                                }, className: "form-control form-control-sm", placeholder: "Nama Pembeli" })
                                                        )
                                                    )
                                                )
                                            )
                                        )
                                    ),
                                    React.createElement(
                                        "div",
                                        { className: "invoice-detail-terms" },
                                        React.createElement(
                                            "div",
                                            { className: "row d-flex" },
                                            React.createElement(
                                                "div",
                                                { className: "col-md-3" },
                                                React.createElement(
                                                    "div",
                                                    { className: "form-group mb-4" },
                                                    React.createElement(
                                                        "label",
                                                        { htmlFor: "number" },
                                                        "ID Transaksi"
                                                    ),
                                                    React.createElement(
                                                        "span",
                                                        { className: "d-flex align-items-center form-control form-control-sm" },
                                                        "Otomatis"
                                                    )
                                                )
                                            ),
                                            React.createElement(
                                                "div",
                                                { className: "col-md-3" },
                                                React.createElement(
                                                    "div",
                                                    { className: "form-group mb-4" },
                                                    React.createElement(
                                                        "label",
                                                        { htmlFor: "number" },
                                                        "Tgl Transaksi"
                                                    ),
                                                    React.createElement(
                                                        "span",
                                                        { className: "d-flex align-items-center form-control form-control-sm" },
                                                        "Otomatis"
                                                    )
                                                )
                                            ),
                                            React.createElement(
                                                "div",
                                                { className: "col-md-3 d-none", id: "jatuh-tempo" },
                                                React.createElement(
                                                    "div",
                                                    { className: "form-group mb-4" },
                                                    React.createElement(
                                                        "label",
                                                        { htmlFor: "due" },
                                                        "Jatuh Tempo"
                                                    ),
                                                    React.createElement("input", { type: "date", value: model.jatuh_tempo, name: "jatuh_tempo", className: "form-control form-control-sm", id: "due", placeholder: "None", onChange: function onChange(e) {
                                                            setModel(Object.assign({}, model, {
                                                                jatuh_tempo: e.target.value
                                                            }));
                                                        } })
                                                )
                                            )
                                        )
                                    ),
                                    React.createElement(
                                        "div",
                                        { className: "invoice-detail-items" },
                                        React.createElement(
                                            "div",
                                            { className: "table-responsive" },
                                            React.createElement(
                                                "table",
                                                { className: "table table-bordered item-table" },
                                                React.createElement(
                                                    "thead",
                                                    null,
                                                    React.createElement(
                                                        "tr",
                                                        null,
                                                        React.createElement("th", { className: "" }),
                                                        React.createElement(
                                                            "th",
                                                            null,
                                                            "Menu"
                                                        ),
                                                        React.createElement(
                                                            "th",
                                                            { className: "" },
                                                            "Harga"
                                                        ),
                                                        React.createElement(
                                                            "th",
                                                            { className: "" },
                                                            "Jumlah"
                                                        ),
                                                        React.createElement(
                                                            "th",
                                                            { className: "text-right" },
                                                            "Total"
                                                        )
                                                    )
                                                ),
                                                React.createElement(
                                                    "tbody",
                                                    null,
                                                    menuList.map(function (item, index) {
                                                        return React.createElement(
                                                            "tr",
                                                            { key: index },
                                                            React.createElement(
                                                                "td",
                                                                { onClick: function onClick() {
                                                                        menuList.splice(index, 1);
                                                                        setMenuList([].concat(_toConsumableArray(menuList)));
                                                                    } },
                                                                React.createElement(
                                                                    "div",
                                                                    { className: "d-flex align-items-center justify-content-center pt-2" },
                                                                    React.createElement(
                                                                        "a",
                                                                        { href: "javascript:void(0);", className: "delete-item", "data-toggle": "tooltip", "data-placement": "top", title: "", "data-original-title": "Delete" },
                                                                        React.createElement(
                                                                            "svg",
                                                                            { xmlns: "http://www.w3.org/2000/svg", width: "24", height: "24", viewBox: "0 0 24 24", fill: "none", stroke: "currentColor", "stroke-width": "2", "stroke-linecap": "round", "stroke-linejoin": "round", className: "feather feather-x-circle" },
                                                                            React.createElement("circle", { cx: "12", cy: "12", r: "10" }),
                                                                            React.createElement("line", { x1: "15", y1: "9", x2: "9", y2: "15" }),
                                                                            React.createElement("line", { x1: "9", y1: "9", x2: "15", y2: "15" })
                                                                        )
                                                                    )
                                                                )
                                                            ),
                                                            React.createElement(
                                                                "td",
                                                                null,
                                                                React.createElement(
                                                                    "select",
                                                                    { onChange: function onChange(e) {
                                                                            var current = allMenu.find(function (menu) {
                                                                                return menu.id === e.target.value;
                                                                            });
                                                                            menuList[index].harga = current.harga;
                                                                            menuList[index].id = current.id;
                                                                            setMenuList([].concat(_toConsumableArray(menuList)));
                                                                        }, className: "form-control form-control-sm pilih-menu" },
                                                                    allMenu.map(function (v, i) {
                                                                        return React.createElement(
                                                                            "option",
                                                                            { key: i, value: v.id },
                                                                            v.nama
                                                                        );
                                                                    })
                                                                )
                                                            ),
                                                            React.createElement(
                                                                "td",
                                                                { className: "rate" },
                                                                React.createElement(
                                                                    "span",
                                                                    { className: "form-control form-control-sm d-flex align-items-center" },
                                                                    item.harga
                                                                )
                                                            ),
                                                            React.createElement(
                                                                "td",
                                                                { className: "text-right qty" },
                                                                React.createElement("input", { type: "number", onInput: function onInput(e) {
                                                                        e.target.value = e.target.value.trim().replace(/[^0-9]/g, '');
                                                                        if (e.target.value.startsWith('0')) {
                                                                            e.target.value = e.target.value.substring(1);
                                                                        }
                                                                    }, onChange: function onChange(e) {
                                                                        menuList[index].jumlah = e.target.value;
                                                                        setMenuList([].concat(_toConsumableArray(menuList)));
                                                                    }, className: "form-control form-control-sm", placeholder: "Jumlah" })
                                                            ),
                                                            React.createElement(
                                                                "td",
                                                                { className: "text-right amount" },
                                                                React.createElement(
                                                                    "span",
                                                                    { className: "d-flex align-items-center justify-content-center form-control form-control-sm" },
                                                                    function () {
                                                                        var harga = item.harga.toString();
                                                                        harga = harga.replace(/[.]/g, '');
                                                                        harga = parseInt(harga);
                                                                        var total = "" + harga * item.jumlah;
                                                                        return formatRupiahReact(total);
                                                                    }()
                                                                )
                                                            )
                                                        );
                                                    })
                                                )
                                            )
                                        ),
                                        React.createElement(
                                            "button",
                                            { onClick: function onClick() {
                                                    var temp = {
                                                        harga: 0,
                                                        jumlah: 0
                                                    };
                                                    setMenuList([].concat(_toConsumableArray(menuList), [temp]));
                                                }, className: "btn btn-secondary btn-sm" },
                                            "Add Item"
                                        )
                                    ),
                                    React.createElement(
                                        "div",
                                        { className: "invoice-detail-total" },
                                        React.createElement(
                                            "div",
                                            { className: "row" },
                                            React.createElement("div", { className: "col-md-6" }),
                                            React.createElement(
                                                "div",
                                                { className: "col-md-6" },
                                                React.createElement(
                                                    "div",
                                                    { className: "totals-row" },
                                                    React.createElement(
                                                        "div",
                                                        { className: "invoice-totals-row invoice-summary-subtotal" },
                                                        React.createElement(
                                                            "div",
                                                            { className: "invoice-summary-label" },
                                                            "Subtotal"
                                                        ),
                                                        React.createElement(
                                                            "div",
                                                            { className: "invoice-summary-value" },
                                                            React.createElement(
                                                                "div",
                                                                { className: "subtotal-amount" },
                                                                function () {
                                                                    var total = 0;
                                                                    menuList.forEach(function (item) {
                                                                        var harga = "" + item.harga;
                                                                        harga = harga.replace(/[.]/g, '');
                                                                        total = total + parseInt(harga) * parseInt(item.jumlah);
                                                                    });
                                                                    total = "" + total;
                                                                    // if (!total) total = "0";
                                                                    // else total = total + "000";
                                                                    return formatRupiahReact(total);
                                                                }()
                                                            )
                                                        )
                                                    ),
                                                    React.createElement(
                                                        "div",
                                                        { className: "invoice-totals-row invoice-summary-total" },
                                                        React.createElement(
                                                            "div",
                                                            { className: "invoice-summary-label" },
                                                            "Discount"
                                                        ),
                                                        React.createElement(
                                                            "div",
                                                            { className: "invoice-summary-value" },
                                                            React.createElement(
                                                                "div",
                                                                { className: "total-amount" },
                                                                "-"
                                                            )
                                                        )
                                                    ),
                                                    React.createElement(
                                                        "div",
                                                        { className: "invoice-totals-row invoice-summary-tax" },
                                                        React.createElement(
                                                            "div",
                                                            { className: "invoice-summary-label" },
                                                            "Pajak"
                                                        ),
                                                        React.createElement(
                                                            "div",
                                                            { className: "invoice-summary-value" },
                                                            React.createElement(
                                                                "div",
                                                                { className: "tax-amount" },
                                                                React.createElement(
                                                                    "span",
                                                                    null,
                                                                    "10%"
                                                                )
                                                            )
                                                        )
                                                    ),
                                                    React.createElement(
                                                        "div",
                                                        { className: "invoice-totals-row invoice-summary-balance-due" },
                                                        React.createElement(
                                                            "div",
                                                            { className: "invoice-summary-label" },
                                                            "Total"
                                                        ),
                                                        React.createElement(
                                                            "div",
                                                            { className: "invoice-summary-value" },
                                                            React.createElement(
                                                                "div",
                                                                { className: "balance-due-amount" },
                                                                function () {
                                                                    var total = 0;
                                                                    menuList.map(function (item) {
                                                                        var harga = "" + item.harga;
                                                                        harga = harga.replace(/[.]/g, '');
                                                                        total = total + parseInt(harga) * parseInt(item.jumlah);
                                                                    });

                                                                    var res = total;

                                                                    // 10 % of res
                                                                    var tax = res * 0.1;

                                                                    var hasil = parseInt(res) + parseInt(tax);

                                                                    return formatRupiahReact(hasil + "");
                                                                }()
                                                            )
                                                        )
                                                    )
                                                )
                                            )
                                        )
                                    )
                                )
                            )
                        ),
                        React.createElement(
                            "div",
                            { className: "col-xl-3" },
                            React.createElement(
                                "div",
                                { className: "invoice-actions" },
                                React.createElement(
                                    "div",
                                    { className: "invoice-action-tax mt-0 pt-0" },
                                    React.createElement(
                                        "h5",
                                        null,
                                        "Pajak"
                                    ),
                                    React.createElement(
                                        "div",
                                        { className: "invoice-action-tax-fields" },
                                        React.createElement(
                                            "div",
                                            { className: "row" },
                                            React.createElement(
                                                "div",
                                                { className: "col-6" },
                                                React.createElement(
                                                    "div",
                                                    { className: "form-group mb-0" },
                                                    React.createElement(
                                                        "label",
                                                        { htmlFor: "type" },
                                                        "Type"
                                                    ),
                                                    React.createElement(
                                                        "div",
                                                        { className: "dropdown selectable-dropdown invoice-tax-select" },
                                                        React.createElement(
                                                            "a",
                                                            { className: "dropdown-toggle" },
                                                            React.createElement(
                                                                "span",
                                                                { className: "selectable-text" },
                                                                "Total"
                                                            )
                                                        )
                                                    )
                                                )
                                            ),
                                            React.createElement(
                                                "div",
                                                { className: "col-6" },
                                                React.createElement(
                                                    "div",
                                                    { className: "form-group mb-0 tax-rate-deducted" },
                                                    React.createElement(
                                                        "label",
                                                        { htmlFor: "rate" },
                                                        "Rate (%)"
                                                    ),
                                                    React.createElement("input", { readOnly: true, type: "number", className: "form-control input-rate", id: "rate", placeholder: "Rate", value: "10" })
                                                )
                                            )
                                        )
                                    )
                                ),
                                React.createElement(
                                    "div",
                                    { className: "invoice-action-discount" },
                                    React.createElement(
                                        "h5",
                                        null,
                                        "Pembayaran"
                                    ),
                                    React.createElement(
                                        "div",
                                        { className: "invoice-action-discount-fields" },
                                        React.createElement(
                                            "div",
                                            { className: "row" },
                                            React.createElement(
                                                "div",
                                                { className: "col-12" },
                                                React.createElement(
                                                    "div",
                                                    { className: "form-group mb-0" },
                                                    React.createElement(
                                                        "div",
                                                        { className: "custom-control custom-radio custom-control-inline" },
                                                        React.createElement("input", { type: "radio", value: "debit", id: "debit", name: "pembayaran", className: "custom-control-input" }),
                                                        React.createElement(
                                                            "label",
                                                            { className: "custom-control-label", htmlFor: "debit" },
                                                            "Debit"
                                                        )
                                                    ),
                                                    React.createElement(
                                                        "div",
                                                        { className: "custom-control custom-radio custom-control-inline" },
                                                        React.createElement("input", { value: "cash", defaultChecked: true, type: "radio", id: "cash", name: "pembayaran", className: "custom-control-input" }),
                                                        React.createElement(
                                                            "label",
                                                            { className: "custom-control-label", htmlFor: "cash" },
                                                            "Cash"
                                                        )
                                                    ),
                                                    React.createElement(
                                                        "div",
                                                        { className: "custom-control custom-radio custom-control-inline" },
                                                        React.createElement("input", { value: "qris", type: "radio", id: "qris", name: "pembayaran", className: "custom-control-input" }),
                                                        React.createElement(
                                                            "label",
                                                            { className: "custom-control-label", htmlFor: "qris" },
                                                            "QRIS"
                                                        )
                                                    )
                                                )
                                            )
                                        )
                                    )
                                ),
                                React.createElement(
                                    "div",
                                    { className: "invoice-action-discount" },
                                    React.createElement(
                                        "h5",
                                        null,
                                        "Tipe Pembelian"
                                    ),
                                    React.createElement(
                                        "div",
                                        { className: "invoice-action-discount-fields" },
                                        React.createElement(
                                            "div",
                                            { className: "row" },
                                            React.createElement(
                                                "div",
                                                { className: "col-12" },
                                                React.createElement(
                                                    "div",
                                                    { className: "form-group mb-0" },
                                                    React.createElement(
                                                        "select",
                                                        { onChange: function onChange(e) {
                                                                setModel(Object.assign({}, model, {
                                                                    tipe: e.target.value
                                                                }));
                                                            }, defaultValue: "bayar ditempat", className: "custom-select custom-select-sm", name: "tipe" },
                                                        React.createElement(
                                                            "option",
                                                            { value: "bayar ditempat" },
                                                            "Bayar Ditempat"
                                                        ),
                                                        React.createElement(
                                                            "option",
                                                            { value: "online" },
                                                            "Online"
                                                        )
                                                    )
                                                )
                                            )
                                        )
                                    )
                                ),
                                React.createElement(
                                    "div",
                                    { className: model.tipe == "online" ? "" : "d-none" },
                                    React.createElement(
                                        "div",
                                        { className: "invoice-action-discount" },
                                        React.createElement(
                                            "h5",
                                            null,
                                            "Lokasi Pembeli"
                                        ),
                                        React.createElement(
                                            "div",
                                            { className: "invoice-action-discount-fields" },
                                            React.createElement(
                                                "div",
                                                { className: "row" },
                                                React.createElement(
                                                    "div",
                                                    { className: "col-12" },
                                                    React.createElement(
                                                        "div",
                                                        { className: "form-group mb-0" },
                                                        React.createElement("textarea", { onChange: function onChange(e) {
                                                                e.target.value = e.target.value.trimStart();
                                                                setModel(Object.assign({}, model, {
                                                                    lokasi_pembeli: e.target.value
                                                                }));
                                                            }, required: true, name: "lokasi_pembeli", className: "form-control", rows: "5" })
                                                    )
                                                )
                                            )
                                        )
                                    ),
                                    React.createElement(
                                        "div",
                                        { className: "invoice-action-discount" },
                                        React.createElement(
                                            "h5",
                                            null,
                                            "Ongkir"
                                        ),
                                        React.createElement(
                                            "div",
                                            { className: "invoice-action-discount-fields" },
                                            React.createElement(
                                                "div",
                                                { className: "row" },
                                                React.createElement(
                                                    "div",
                                                    { className: "col-12" },
                                                    React.createElement(
                                                        "div",
                                                        { className: "form-group mb-0" },
                                                        React.createElement("input", { value: model.ongkir, onChange: function onChange(e) {
                                                                var val = formatRupiahReact(e.target.value);
                                                                e.target.value = val;
                                                                // let val = e.target.value
                                                                setModel(Object.assign({}, model, {
                                                                    ongkir: val
                                                                }));
                                                            }, required: true, name: "ongkir", className: "form-control form-control-sm" })
                                                    )
                                                )
                                            )
                                        )
                                    ),
                                    React.createElement(
                                        "div",
                                        { className: "invoice-action-discount" },
                                        React.createElement(
                                            "h5",
                                            null,
                                            "Diskon"
                                        ),
                                        React.createElement(
                                            "div",
                                            { className: "invoice-action-discount-fields" },
                                            React.createElement(
                                                "div",
                                                { className: "row" },
                                                React.createElement(
                                                    "div",
                                                    { className: "col-6" },
                                                    React.createElement(
                                                        "div",
                                                        { className: "form-group mb-0" },
                                                        React.createElement(
                                                            "label",
                                                            { htmlFor: "type" },
                                                            "Type"
                                                        ),
                                                        React.createElement(
                                                            "div",
                                                            { className: "dropdown selectable-dropdown invoice-discount-select" },
                                                            React.createElement(
                                                                "a",
                                                                { id: "currencyDropdown", className: "dropdown-toggle", "data-toggle": "dropdown", "aria-haspopup": "true", "aria-expanded": "false" },
                                                                " ",
                                                                React.createElement(
                                                                    "span",
                                                                    { className: "selectable-text" },
                                                                    "None"
                                                                ),
                                                                " ",
                                                                React.createElement(
                                                                    "span",
                                                                    { className: "selectable-arrow" },
                                                                    React.createElement(
                                                                        "svg",
                                                                        { xmlns: "http://www.w3.org/2000/svg", width: "24", height: "24", viewBox: "0 0 24 24", fill: "none", stroke: "currentColor", strokeWidth: "2",
                                                                            strokeLinecap: "round", strokeLinejoin: "round", className: "feather feather-chevron-down" },
                                                                        React.createElement("polyline", { points: "6 9 12 15 18 9" })
                                                                    )
                                                                )
                                                            ),
                                                            React.createElement(
                                                                "div",
                                                                { className: "dropdown-menu", "aria-labelledby": "currencyDropdown" },
                                                                React.createElement(
                                                                    "a",
                                                                    { className: "dropdown-item", "data-value": "Percent", href: "javascript:void(0);" },
                                                                    "Percent"
                                                                ),
                                                                React.createElement(
                                                                    "a",
                                                                    { className: "dropdown-item", "data-value": "None", href: "javascript:void(0);" },
                                                                    "None"
                                                                )
                                                            )
                                                        )
                                                    )
                                                ),
                                                React.createElement(
                                                    "div",
                                                    { className: "col-6" },
                                                    React.createElement(
                                                        "div",
                                                        { className: "form-group mb-0 discount-amount", style: { display: "none" } },
                                                        React.createElement(
                                                            "label",
                                                            { htmlFor: "rate" },
                                                            "Amount"
                                                        ),
                                                        React.createElement("input", { type: "number", className: "form-control input-rate", id: "rate", placeholder: "Rate", value: "25" })
                                                    ),
                                                    React.createElement(
                                                        "div",
                                                        { className: "form-group mb-0 discount-percent", style: { display: "none" } },
                                                        React.createElement(
                                                            "label",
                                                            { htmlFor: "rate" },
                                                            "Percent"
                                                        ),
                                                        React.createElement("input", { type: "number", className: "form-control input-rate", id: "rate", placeholder: "Rate", value: "10" })
                                                    )
                                                )
                                            )
                                        )
                                    )
                                )
                            ),
                            React.createElement(
                                "div",
                                { className: "invoice-actions-btn" },
                                React.createElement(
                                    "div",
                                    { className: "invoice-action-btn" },
                                    React.createElement(
                                        "div",
                                        { className: "row" },
                                        React.createElement(
                                            "div",
                                            { onClick: handleSubmit, className: "col-xl-12 col-md-4" },
                                            React.createElement(
                                                "a",
                                                { href: "javascript:void(0);", className: "btn btn-primary btn-send" },
                                                "Submit"
                                            )
                                        )
                                    )
                                )
                            )
                        )
                    )
                )
            )
        ),
        React.createElement(
            "form",
            { id: "add-transaksi-form", method: "post", action: "../pages/add-transaksi-object.php", className: "d-none" },
            React.createElement("input", { type: "text", name: "total_harga", value: function () {
                    var total = 0;
                    menuList.map(function (item) {
                        var harga = "" + item.harga;
                        harga = harga.replace(/[.]/g, '');
                        total = total + parseInt(harga) * parseInt(item.jumlah);
                    });
                    return total;
                }() }),
            React.createElement("input", { type: "text", name: "total_jumlah_pesanan", value: function () {
                    var total = 0;
                    menuList.map(function (item) {
                        total = total + parseInt(item.jumlah || 0);
                    });
                    return total;
                }() }),
            React.createElement("input", { type: "text", name: "nama_pembeli", value: model.nama }),
            React.createElement("input", { type: "text", name: "pembayaran", value: model.pembayaran }),
            React.createElement("input", { type: "text", name: "diskon", value: 0 }),
            React.createElement("input", { type: "text", name: "pajak", value: 10 }),
            React.createElement("input", { type: "text", name: "tipe", value: model.tipe }),
            React.createElement("input", { type: "text", name: "ongkir", value: function () {
                    var a = "" + model.ongkir;
                    a = a.replace(/[.]/g, '');
                    return a;
                }() }),
            React.createElement("input", { type: "text", name: "lokasi_pembeli", value: model.lokasi_pembeli }),
            React.createElement("input", { type: "text", name: "menu", value: JSON.stringify(menuList) })
        )
    );
}

var container = document.getElementById('root');
var root = ReactDOM.createRoot(container);
root.render(React.createElement(AddTransaksi, null));