var _slicedToArray = function () { function sliceIterator(arr, i) { var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"]) _i["return"](); } finally { if (_d) throw _e; } } return _arr; } return function (arr, i) { if (Array.isArray(arr)) { return arr; } else if (Symbol.iterator in Object(arr)) { return sliceIterator(arr, i); } else { throw new TypeError("Invalid attempt to destructure non-iterable instance"); } }; }();

function _toConsumableArray(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } else { return Array.from(arr); } }

function AddTransaksi() {
    var _React$useState = React.useState({
        nama: "",
        jatuh_tempo: "",
        tipe: "makan ditempat",
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
                            { className: "col-12" },
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
                                                    "Data Transaksi:"
                                                ),
                                                React.createElement(
                                                    "div",
                                                    { className: "invoice-address-client-fields" },
                                                    React.createElement(
                                                        "div",
                                                        { className: "form-group row mb-4" },
                                                        React.createElement(
                                                            "label",
                                                            { htmlFor: "nama_pembeli", className: "col-sm-3 col-form-label col-form-label-sm" },
                                                            "Tipe Pembelian"
                                                        ),
                                                        React.createElement(
                                                            "div",
                                                            { className: "col-sm-9" },
                                                            React.createElement(
                                                                "select",
                                                                { onChange: function onChange(e) {
                                                                        setModel(Object.assign({}, model, {
                                                                            tipe: e.target.value
                                                                        }));
                                                                    }, defaultValue: "bayar ditempat", className: "custom-select custom-select-sm", name: "tipe" },
                                                                React.createElement(
                                                                    "option",
                                                                    { value: "makan ditempat" },
                                                                    "Makan Ditempat"
                                                                ),
                                                                React.createElement(
                                                                    "option",
                                                                    { value: "online" },
                                                                    "Online"
                                                                )
                                                            )
                                                        )
                                                    )
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
                                                            model.tipe == "online" ? "Nama Pembeli" : "Nomor Meja"
                                                        ),
                                                        React.createElement(
                                                            "div",
                                                            { className: "col-sm-9" },
                                                            React.createElement("input", { required: true, type: "text", value: model.nama, onChange: function onChange(e) {
                                                                    e.target.value = e.target.value.trimStart();
                                                                    setModel(Object.assign({}, model, { nama: e.target.value }));
                                                                }, className: "form-control form-control-sm", placeholder: model.tipe == "online" ? "Nama Pembeli" : "Nomor Meja" })
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
                                                        new Date().toLocaleDateString().replace(/\//g, "-")
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
                                                            "Jumlah"
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
                                            React.createElement("div", { className: "col-12" })
                                        ),
                                        React.createElement(
                                            "div",
                                            { onClick: handleSubmit, className: "" },
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
            React.createElement("input", { type: "text", name: "nomor_meja", value: model.nama }),
            React.createElement("input", { type: "text", name: "tipe", value: model.tipe }),
            React.createElement("input", { type: "text", name: "menu", value: JSON.stringify(menuList) })
        )
    );
}

var container = document.getElementById('root');
var root = ReactDOM.createRoot(container);
root.render(React.createElement(AddTransaksi, null));