<?php
$currentPage = $_GET['page'] ?? '';
function navItem(string $page, string $icon, string $label, string $current): string
{
    $active = $page === $current ? 'active' : '';

    return "
    <li class='nav-item'>
        <a class='nav-link d-flex align-items-center gap-3 px-3 py-3 mb-1 rounded {$active}'
           href='?page={$page}'>
            <i class='bi {$icon}'></i>
            <span class='nav-label'>{$label}</span>
        </a>
    </li>";
}
?>
<aside id="sidebar"
    class="sidebar d-flex flex-column position-fixed top-0 start-0 vh-100 overflow-hidden border-end bg-white">
    <div class="sidebar-header d-flex align-items-center justify-content-between p-3 border-bottom">
        <img src="/img/logo.png" alt="CECO" class="sidebar-logo img-fluid">
        <button class="btn btn-light rounded-circle shadow-sm" id="sidebarToggle" aria-label="Colapsar menú">
            <i class="bi bi-layout-sidebar-reverse"></i>
        </button>
    </div>

    <nav class="sidebar-nav flex-grow-1 py-3">
        <ul class="nav flex-column px-2">
            <?= navItem('admin_dashboard', 'bi-speedometer2', 'Dashboard', $currentPage) ?>
            <?= navItem('admin_programas', 'bi-mortarboard', 'Programas', $currentPage) ?>
            <?= navItem('admin_multimedia', 'bi-images', 'Multimedia', $currentPage) ?>
            <?= navItem('usuarios', 'bi-people', 'Usuarios', $currentPage) ?>
        </ul>
    </nav>

    <div class="sidebar-footer p-3 border-top d-flex flex-column gap-2">
        <div class="user-info d-flex align-items-center gap-2">
            <div
                class="user-avatar rounded-circle d-flex align-items-center justify-content-center fw-semibold flex-shrink-0">
                <?= strtoupper(substr($_SESSION['user']['nombre'], 0, 1)) ?>
            </div>
            <div class="user-details nav-label">
                <span class="user-name d-block fw-semibold"><?= htmlspecialchars($_SESSION['user']['nombre']) ?></span>
                <span class="user-role d-block text-muted"><?= htmlspecialchars($_SESSION['user']['rol']) ?></span>
            </div>
        </div>
        <a href="?page=logout"
            class="btn-logout nav-label d-flex align-items-center gap-2 text-danger text-decoration-none rounded px-1 py-1"
            title="Cerrar sesión">
            <i class="bi bi-box-arrow-right"></i>
            <span>Salir</span>
        </a>
    </div>
</aside>