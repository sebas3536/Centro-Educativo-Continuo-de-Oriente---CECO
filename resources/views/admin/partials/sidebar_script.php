<script>
(function () {
    const sidebar    = document.getElementById('sidebar');
    const mainEl     = document.getElementById('adminMain') 
                    || document.getElementById('programaMain');
    const overlay    = document.getElementById('sidebarOverlay');
    const toggleBtn  = document.getElementById('sidebarToggle');
    const hamburger  = document.getElementById('hamburgerBtn');

    // Desktop: colapsar / expandir
    toggleBtn?.addEventListener('click', () => {
        sidebar.classList.toggle('collapsed');
        mainEl?.classList.toggle('expanded');
        localStorage.setItem('sidebar_collapsed',
            sidebar.classList.contains('collapsed'));
    });

    // Mobile: abrir / cerrar con overlay
    hamburger?.addEventListener('click', () => {
        sidebar.classList.toggle('open');
        overlay?.classList.toggle('active');
    });

    overlay?.addEventListener('click', () => {
        sidebar.classList.remove('open');
        overlay.classList.remove('active');
    });

    // Restaurar estado guardado
    if (localStorage.getItem('sidebar_collapsed') === 'true') {
        sidebar.classList.add('collapsed');
        mainEl?.classList.add('expanded');
    }
})();
</script>