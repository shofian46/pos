<?php
$queryMenu = mysqli_query($conn, "SELECT * FROM menus WHERE parent_id = 0 OR parent_id = ''");
$rowsMenu = mysqli_fetch_all($queryMenu, MYSQLI_ASSOC);
?>

<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">


    <!-- End Dashboard Nav -->
    <?php foreach ($rowsMenu as $mainMenu): ?>
      <?php
      $id_menu = $mainMenu['id'];
      $querySubMenu = mysqli_query($conn, "SELECT * FROM menus WHERE parent_id = '$id_menu' ORDER BY urutan ASC");
      $rowsSubMenu = mysqli_fetch_all($querySubMenu, MYSQLI_ASSOC);
      ?>
      <?php if (mysqli_num_rows($querySubMenu) > 0): ?>
        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#menu-<?= $mainMenu['id'] ?>" data-bs-toggle="collapse" href="#">
            <i class="<?= $mainMenu['icon']; ?>"></i><span><?= $mainMenu['name']; ?></span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="menu-<?= $mainMenu['id'] ?>" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <?php foreach ($rowsSubMenu as $subMenu): ?>
              <li class="nav-item <?= $mainMenu['url'] != '' ? 'active' : '' ?>">
                <a href="?page=<?= $subMenu['url']; ?>">
                  <i class="<?= $subMenu['icon']; ?>"></i><span><?= $subMenu['name']; ?></span>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </li>
      <?php elseif (!empty($mainMenu['url'])): ?>
        <li class="nav-item">
          <a class="nav-link collapsed" href="<?= $mainMenu['url']; ?>">
            <i class="<?= $mainMenu['icon']; ?>"></i>
            <span><?= $mainMenu['name']; ?></span>
          </a>
        </li>
      <?php endif; ?>
    <?php endforeach; ?>
    <!-- End Components Nav -->

  </ul>

</aside><!-- End Sidebar-->