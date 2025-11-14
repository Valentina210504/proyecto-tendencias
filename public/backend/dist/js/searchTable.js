document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchTable');
    const table = document.getElementById('example1');

    if (!searchInput || !table) return; // Evita errores si la vista no tiene estos elementos

    const tbody = table.querySelector('tbody');
    const rows = tbody.querySelectorAll('tr');

    searchInput.addEventListener('keyup', function() {
        const searchTerm = this.value.toLowerCase().trim();

        rows.forEach(function(row) {
            const cells = Array.from(row.cells);
            const match = cells.some(cell =>
                cell.textContent.toLowerCase().includes(searchTerm)
            );

            row.style.display = match ? '' : 'none';
        });
    });
});
