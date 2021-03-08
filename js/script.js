document.addEventListener('DOMContentLoaded', function() {
    const select_filters = document.querySelector('.filters-sort');
    select_filters.addEventListener('change', (event) => {
        document.cookie = 'sort=' + event.currentTarget.value + '; path=/';
        location.reload();
    });
}, false);