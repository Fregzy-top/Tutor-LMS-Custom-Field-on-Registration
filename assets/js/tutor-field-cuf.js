document.addEventListener('DOMContentLoaded', function() {
    // Navigation tab switching logic
    document.querySelectorAll('.nav-tab').forEach(function(tab) {
        tab.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelectorAll('.nav-tab').forEach(function(tab) {
                tab.classList.remove('nav-tab-active');
            });
            tab.classList.add('nav-tab-active');
            document.querySelectorAll('.tab-content').forEach(function(content) {
                content.style.display = 'none';
            });
            document.querySelector(tab.getAttribute('href')).style.display = 'block';
        });
    });

    // Adding fields logic for cuf_fields_table
    document.getElementById('cuf_add_field').addEventListener('click', function() {
        var table = document.getElementById('cuf_fields_table');
        var newRow = table.rows[table.rows.length - 1].cloneNode(true);
        newRow.querySelectorAll('input').forEach(function(input) {
            input.value = '';
        });
        table.appendChild(newRow);
    });

    // Adding fields logic for cif_fields_table
    document.getElementById('cif_add_field').addEventListener('click', function() {
        var table = document.getElementById('cif_fields_table');
        var newRow = table.rows[table.rows.length - 1].cloneNode(true);
        newRow.querySelectorAll('input').forEach(function(input) {
            input.value = '';
        });
        table.appendChild(newRow);
    });

    // Removing cuf fields
    document.querySelectorAll('.cuf_remove_field').forEach(function(button) {
        button.addEventListener('click', function() {
            if (document.querySelectorAll('.cuf_remove_field').length > 1) {
                this.closest('tr').remove();
            } else {
                alert('You must have at least one field.');
            }
        });
    });

    // Removing cif fields
    document.querySelectorAll('.cif_remove_field').forEach(function(button) {
        button.addEventListener('click', function() {
            if (document.querySelectorAll('.cif_remove_field').length > 1) {
                this.closest('tr').remove();
            } else {
                alert('You must have at least one field.');
            }
        });
    });
});
