window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const datatablesSimple = document.getElementById('datatablesSimple');
    if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple);
    }
});
document.addEventListener('DOMContentLoaded', function() {
    const table = new DataTable('#datatablesSimple', {
        serverSide: true,
        ajax: {
            url: 'data.php',
            method: 'POST'
        }
    });
});
