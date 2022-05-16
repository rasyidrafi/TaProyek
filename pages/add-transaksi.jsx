function AddTransaksi() {
    const [model, setModel] = React.useState({
        nama: "",
        jatuh_tempo: "",
        tipe: "bayar ditempat",
        pembayaran: "cash",
        lokasi_pembeli: "",
        ongkir: 0,
    });

    $('input[type=radio]').change(function () {
        if (this.value == 'qris' || this.value == "debit") {
            $("#jatuh-tempo").removeClass('d-none');
        } else {
            $("#jatuh-tempo").addClass("d-none");
        }
        setModel({
            ...model,
            pembayaran: this.value
        })
    });

    const allMenu = JSON.parse($("#all-menu").html().trim());

    const [menuList, setMenuList] = React.useState([]);

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
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    const handleSubmit = () => {
        $("#add-transaksi-form").submit();
    }

    return (
        <React.Fragment>
            <div className="row invoice layout-top-spacing layout-spacing">
                <div className="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                    <div className="doc-container">

                        <div className="row">
                            <div className="col-xl-9">

                                <div className="invoice-content">

                                    <div className="invoice-detail-body">

                                        <div className="invoice-detail-header">

                                            <div className="row justify-content-between">
                                                <div className="col-12 invoice-address-client">

                                                    <h4>Data Customer:</h4>

                                                    <div className="invoice-address-client-fields">
                                                        <div className="form-group row">
                                                            <label htmlFor="nama_pembeli" className="col-sm-3 col-form-label col-form-label-sm">Nama Pembeli</label>
                                                            <div className="col-sm-9">
                                                                <input required type="text" value={model.nama} onChange={(e) => {
                                                                    e.target.value = e.target.value.trimStart();
                                                                    setModel({ ...model, nama: e.target.value });
                                                                }} className="form-control form-control-sm" placeholder="Nama Pembeli" />
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>


                                            </div>
                                        </div>

                                        <div className="invoice-detail-terms">

                                            <div className="row d-flex">

                                                <div className="col-md-3">

                                                    <div className="form-group mb-4">
                                                        <label htmlFor="number">ID Transaksi</label>
                                                        <span className="d-flex align-items-center form-control form-control-sm">
                                                            Otomatis
                                                        </span>
                                                    </div>
                                                </div>

                                                <div className="col-md-3">

                                                    <div className="form-group mb-4">
                                                        <label htmlFor="number">Tgl Transaksi</label>
                                                        <span className="d-flex align-items-center form-control form-control-sm">
                                                            Otomatis
                                                        </span>
                                                    </div>
                                                </div>

                                                <div className="col-md-3 d-none" id="jatuh-tempo">
                                                    <div className="form-group mb-4">
                                                        <label htmlFor="due">Jatuh Tempo</label>
                                                        <input type="date" value={model.jatuh_tempo} name="jatuh_tempo" className="form-control form-control-sm" id="due" placeholder="None" onChange={(e) => {
                                                            setModel({
                                                                ...model,
                                                                jatuh_tempo: e.target.value
                                                            })
                                                        }} />
                                                    </div>

                                                </div>

                                            </div>

                                        </div>


                                        <div className="invoice-detail-items">
                                            <div className="table-responsive">
                                                <table className="table table-bordered item-table">
                                                    <thead>
                                                        <tr>
                                                            <th className=""></th>
                                                            <th>Menu</th>
                                                            <th className="">Harga</th>
                                                            <th className="">Jumlah</th>
                                                            <th className="text-right">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        {menuList.map((item, index) => (
                                                            <tr key={index}>
                                                                <td onClick={() => {
                                                                    menuList.splice(index, 1);
                                                                    setMenuList([...menuList]);
                                                                }}>
                                                                    <div className="d-flex align-items-center justify-content-center pt-2">
                                                                        <a href="javascript:void(0);" className="delete-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" className="feather feather-x-circle">
                                                                            <circle cx="12" cy="12" r="10"></circle>
                                                                            <line x1="15" y1="9" x2="9" y2="15"></line>
                                                                            <line x1="9" y1="9" x2="15" y2="15"></line>
                                                                        </svg>
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <select onChange={(e) => {
                                                                        let current = allMenu.find(menu => menu.id === e.target.value);
                                                                        menuList[index].harga = current.harga;
                                                                        menuList[index].id = current.id;
                                                                        setMenuList([...menuList]);
                                                                    }} className="form-control form-control-sm pilih-menu">
                                                                        {allMenu.map((v, i) => (
                                                                            <option key={i} value={v.id}>
                                                                                {v.nama}
                                                                            </option>
                                                                        ))}
                                                                    </select>
                                                                </td>
                                                                <td className="rate">
                                                                    <span className="form-control form-control-sm d-flex align-items-center">
                                                                        {item.harga}
                                                                    </span>
                                                                </td>
                                                                <td className="text-right qty">
                                                                    <input type="number" onInput={(e) => {
                                                                        e.target.value = e.target.value.trim().replace(/[^0-9]/g, '');
                                                                        if (e.target.value.startsWith('0')) {
                                                                            e.target.value = e.target.value.substring(1);
                                                                        }
                                                                    }} onChange={(e) => {
                                                                        menuList[index].jumlah = e.target.value;
                                                                        setMenuList([...menuList]);
                                                                    }} className="form-control form-control-sm" placeholder="Jumlah" />
                                                                </td>
                                                                <td className="text-right amount">
                                                                    <span className="d-flex align-items-center justify-content-center form-control form-control-sm">
                                                                        {function () {
                                                                            let harga = item.harga.toString();
                                                                            harga = harga.replace(/[.]/g, '');
                                                                            harga = parseInt(harga);
                                                                            let total = "" + harga * item.jumlah;
                                                                            return formatRupiahReact(total);
                                                                        }()}
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                        ))}
                                                    </tbody>
                                                </table>
                                            </div>

                                            <button onClick={() => {
                                                let temp = {
                                                    harga: 0,
                                                    jumlah: 0,
                                                }
                                                setMenuList([...menuList, temp]);
                                            }} className="btn btn-secondary btn-sm">Add Item</button>

                                        </div>


                                        <div className="invoice-detail-total">

                                            <div className="row">

                                                <div className="col-md-6">
                                                </div>

                                                <div className="col-md-6">
                                                    <div className="totals-row">
                                                        <div className="invoice-totals-row invoice-summary-subtotal">

                                                            <div className="invoice-summary-label">Subtotal</div>

                                                            <div className="invoice-summary-value">
                                                                <div className="subtotal-amount">
                                                                    {function () {
                                                                        let total = 0;
                                                                        menuList.forEach(item => {
                                                                            let harga = "" + item.harga;
                                                                            harga = harga.replace(/[.]/g, '');
                                                                            total = total + parseInt(harga) * parseInt(item.jumlah);
                                                                        });
                                                                        total = "" + total;
                                                                        // if (!total) total = "0";
                                                                        // else total = total + "000";
                                                                        return formatRupiahReact(total);
                                                                    }()}
                                                                </div>
                                                            </div>

                                                        </div>



                                                        <div className="invoice-totals-row invoice-summary-total">

                                                            <div className="invoice-summary-label">Discount</div>

                                                            <div className="invoice-summary-value">
                                                                <div className="total-amount">
                                                                    -
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div className="invoice-totals-row invoice-summary-tax">

                                                            <div className="invoice-summary-label">Pajak</div>

                                                            <div className="invoice-summary-value">
                                                                <div className="tax-amount">
                                                                    <span>10%</span>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div className="invoice-totals-row invoice-summary-balance-due">

                                                            <div className="invoice-summary-label">Total</div>

                                                            <div className="invoice-summary-value">
                                                                <div className="balance-due-amount">
                                                                    {function () {
                                                                        let total = 0;
                                                                        menuList.map(item => {
                                                                            let harga = "" + item.harga;
                                                                            harga = harga.replace(/[.]/g, '');
                                                                            total = total + parseInt(harga) * parseInt(item.jumlah);
                                                                        });

                                                                        let res = total;

                                                                        // 10 % of res
                                                                        let tax = res * 0.1;

                                                                        let hasil = parseInt(res) + parseInt(tax);

                                                                        return formatRupiahReact(hasil + "");
                                                                    }()}
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>


                                    </div>

                                </div>

                            </div>

                            <div className="col-xl-3">

                                <div className="invoice-actions">

                                    <div className="invoice-action-tax mt-0 pt-0">

                                        <h5>Pajak</h5>

                                        <div className="invoice-action-tax-fields">

                                            <div className="row">

                                                <div className="col-6">

                                                    <div className="form-group mb-0">
                                                        <label htmlFor="type">Type</label>

                                                        <div className="dropdown selectable-dropdown invoice-tax-select">
                                                            <a className="dropdown-toggle">
                                                                <span className="selectable-text">Total</span>
                                                            </a>
                                                        </div>

                                                    </div>

                                                </div>

                                                <div className="col-6">
                                                    <div className="form-group mb-0 tax-rate-deducted">
                                                        <label htmlFor="rate">Rate (%)</label>
                                                        <input readOnly type="number" className="form-control input-rate" id="rate" placeholder="Rate" value="10" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div className="invoice-action-discount">

                                        <h5>Pembayaran</h5>

                                        <div className="invoice-action-discount-fields">

                                            <div className="row">

                                                <div className="col-12">
                                                    <div className="form-group mb-0">
                                                        <div className="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" value="debit" id="debit" name="pembayaran" className="custom-control-input" />
                                                            <label className="custom-control-label" htmlFor="debit">Debit</label>
                                                        </div>
                                                        <div className="custom-control custom-radio custom-control-inline">
                                                            <input value="cash" defaultChecked type="radio" id="cash" name="pembayaran" className="custom-control-input" />
                                                            <label className="custom-control-label" htmlFor="cash">Cash</label>
                                                        </div>

                                                        <div className="custom-control custom-radio custom-control-inline">
                                                            <input value="qris" type="radio" id="qris" name="pembayaran" className="custom-control-input" />
                                                            <label className="custom-control-label" htmlFor="qris">QRIS</label>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div className="invoice-action-discount">

                                        <h5>Tipe Pembelian</h5>

                                        <div className="invoice-action-discount-fields">

                                            <div className="row">

                                                <div className="col-12">
                                                    <div className="form-group mb-0">
                                                        <select onChange={(e) => {
                                                            setModel({
                                                                ...model,
                                                                tipe: e.target.value
                                                            })
                                                        }} defaultValue="bayar ditempat" className="custom-select custom-select-sm" name="tipe">
                                                            <option value="bayar ditempat">Bayar Ditempat</option>
                                                            <option value="online">Online</option>
                                                        </select>
                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div className={model.tipe == "online" ? "" : "d-none"}>

                                        <div className="invoice-action-discount">

                                            <h5>Lokasi Pembeli</h5>

                                            <div className="invoice-action-discount-fields">

                                                <div className="row">
                                                    <div className="col-12">
                                                        <div className="form-group mb-0">
                                                            <textarea onChange={(e) => {
                                                                e.target.value = e.target.value.trimStart();
                                                                setModel({
                                                                    ...model,
                                                                    lokasi_pembeli: e.target.value
                                                                })
                                                            }} required name="lokasi_pembeli" className="form-control" rows="5"></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div className="invoice-action-discount">

                                            <h5>Ongkir</h5>

                                            <div className="invoice-action-discount-fields">

                                                <div className="row">
                                                    <div className="col-12">
                                                        <div className="form-group mb-0">
                                                            <input value={model.ongkir} onChange={(e) => {
                                                                let val = formatRupiahReact(e.target.value);
                                                                e.target.value = val;
                                                                // let val = e.target.value
                                                                setModel({
                                                                    ...model,
                                                                    ongkir: val
                                                                })
                                                            }} required name="ongkir" className="form-control form-control-sm" />
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div className="invoice-action-discount">

                                            <h5>Diskon</h5>

                                            <div className="invoice-action-discount-fields">

                                                <div className="row">

                                                    <div className="col-6">
                                                        <div className="form-group mb-0">
                                                            <label htmlFor="type">Type</label>

                                                            <div className="dropdown selectable-dropdown invoice-discount-select">
                                                                <a id="currencyDropdown" className="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span className="selectable-text">None</span> <span className="selectable-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"
                                                                    strokeLinecap="round" strokeLinejoin="round" className="feather feather-chevron-down">
                                                                    <polyline points="6 9 12 15 18 9"></polyline>
                                                                </svg></span></a>
                                                                <div className="dropdown-menu" aria-labelledby="currencyDropdown">
                                                                    <a className="dropdown-item" data-value="Percent" href="javascript:void(0);">Percent</a>
                                                                    <a className="dropdown-item" data-value="None" href="javascript:void(0);">None</a>
                                                                </div>
                                                            </div>

                                                        </div>


                                                    </div>

                                                    <div className="col-6">
                                                        <div className="form-group mb-0 discount-amount" style={{ display: "none" }}>
                                                            <label htmlFor="rate">Amount</label>
                                                            <input type="number" className="form-control input-rate" id="rate" placeholder="Rate" value="25" />
                                                        </div>

                                                        <div className="form-group mb-0 discount-percent" style={{ display: "none" }}>
                                                            <label htmlFor="rate">Percent</label>
                                                            <input type="number" className="form-control input-rate" id="rate" placeholder="Rate" value="10" />
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                        </div>
                                    </div>


                                </div>

                                <div className="invoice-actions-btn">

                                    <div className="invoice-action-btn">

                                        <div className="row">
                                            <div onClick={handleSubmit} className="col-xl-12 col-md-4">
                                                <a href="javascript:void(0);" className="btn btn-primary btn-send">Submit</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>


                    </div>

                </div>
            </div>
            <form id="add-transaksi-form" method="post" action="../pages/add-transaksi-object.php" className="d-none">
                <input type="text" name="total_harga" value={
                    function () {
                        let total = 0;
                        menuList.map(item => {
                            let harga = "" + item.harga;
                            harga = harga.replace(/[.]/g, '');
                            total = total + (parseInt(harga) * parseInt(item.jumlah));
                        });
                        return total;
                    }()} />

                <input type="text" name="total_jumlah_pesanan" value={function () {
                    let total = 0;
                    menuList.map(item => {
                        total = total + parseInt(item.jumlah || 0);
                    });
                    return total;
                }()} />

                <input type="text" name="nama_pembeli" value={model.nama} />
                <input type="text" name="pembayaran" value={model.pembayaran} />
                <input type="text" name="diskon" value={0} />
                <input type="text" name="pajak" value={10} />
                <input type="text" name="tipe" value={model.tipe} />
                <input type="text" name="ongkir" value={function () {
                    let a = "" + model.ongkir;
                    a = a.replace(/[.]/g, '');
                    return a;
                }()} />
                <input type="text" name="lokasi_pembeli" value={model.lokasi_pembeli} />
                <input type="text" name="menu" value={JSON.stringify(menuList)} />
            </form>
        </React.Fragment>
    );
}

const container = document.getElementById('root');
const root = ReactDOM.createRoot(container);
root.render(<AddTransaksi />);
