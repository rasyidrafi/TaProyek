function AddTransaksi() {
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

    return (
        <React.Fragment>
           
        </React.Fragment>
    );
}

const container = document.getElementById('root');
const root = ReactDOM.createRoot(container);
root.render(<AddTransaksi />);
