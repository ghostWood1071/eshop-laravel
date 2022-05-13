window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const datatablesSimple = document.getElementById('datatablesSimple');
    if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple, {
            searchable: false,
            paging: false,
            sortable: false
        });
    }

    const colorTable = document.getElementById('color-table');
    if (colorTable) {
        new simpleDatatables.DataTable(colorTable, {
            searchable: false,
            paging: false,
            sortable: false
        });
    }


    const productTable = document.getElementById('producttable');
    if (productTable) {
        new simpleDatatables.DataTable(productTable, {
            searchable: false,
            paging: false,
            sortable: false
        });
    }

    const imporDetailTable = document.getElementById('impordetailtable');
    if (imporDetailTable) {
        new simpleDatatables.DataTable(imporDetailTable, {
            searchable: false,
            paging: false,
            sortable: false
        });
    }
});
