<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex">
            <div>
                <img src="<?php echo getAvatar(getUser()['email']); ?>" width="45px" />
            </div>
            <div class="admin-info">
                <div class="font-strong"><?php echo getUser()['email']; ?></div><small><?php echo getUser()['type'] == "admin" ? "Administrator" : "Użytkownik"; ?></small></div>
        </div>
        <ul class="side-menu metismenu">
            <li <?php echo $this->uri->segment(1) == "" ? 'class="active"' : ''; ?>>
                <a href="<?php echo base_url('/'); ?>"><i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Strona Główna</span>
                </a>
            </li>
            <li class="heading">Inne</li>
            <li <?php echo $this->uri->segment(1) == "profile" ? 'class="active"' : ''; ?>>
                <a href="<?php echo base_url('/profile'); ?>"><i class="sidebar-item-icon fas fa-id-card-alt"></i>
                    <span class="nav-label">Profil</span>
                </a>
            </li>
            <li <?php echo $this->uri->segment(1) == "transactions" ? 'class="active"' : ''; ?>>
                <a href="<?php echo base_url('/transactions'); ?>"><i class="sidebar-item-icon fas fa-clipboard-list"></i>
                    <span class="nav-label">Twoje Transakcje</span>
                </a>
            </li>
            <li <?php echo $this->uri->segment(1) == "servers" ? 'class="active"' : ''; ?>>
                <a href="<?php echo base_url('/servers'); ?>"><i class="sidebar-item-icon fas fa-server"></i>
                    <span class="nav-label">Lista Serwerów</span>
                </a>
            </li>
            <li class="heading">Licencja</li>
            <li <?php echo $this->uri->segment(1) == "activateKey" ? 'class="active"' : ''; ?>>
                <a href="<?php echo base_url('/activateKey'); ?>"><i class="sidebar-item-icon fas fa-key"></i>
                    <span class="nav-label">Aktywuj Klucz</span>
                </a>
            </li>
            <li <?php echo $this->uri->segment(1) == "plans" || $this->uri->segment(1) == "buy" ? 'class="active"' : ''; ?>>
                <a href="<?php echo base_url('/plans'); ?>"><i class="sidebar-item-icon fas fa-shopping-basket"></i>
                    <span class="nav-label">Kup Klucz</span>
                </a>
            </li>
            <li class="heading">Pomoc</li>
            <li <?php echo $this->uri->segment(1) == "support" ? 'class="active"' : ''; ?>>
                <a href="<?php echo base_url('/support'); ?>"><i class="sidebar-item-icon fas fa-life-ring"></i>
                    <span class="nav-label">Support</span>
                </a>
            </li>
            <li <?php echo $this->uri->segment(1) == "faq" ? 'class="active"' : ''; ?>>
                <a href="<?php echo base_url('/faq'); ?>"><i class="sidebar-item-icon fas fa-question-circle"></i>
                    <span class="nav-label">FAQ</span>
                </a>
            </li>
            <?php if (getUser()['type'] == "admin"): ?>
            <li class="heading">Admin</li>
            <li <?php echo $this->uri->segment(2) == "generateKey" ? 'class="active"' : ''; ?>>
                <a href="<?php echo base_url('/admin/generateKey'); ?>"><i class="sidebar-item-icon fas fa-plus"></i>
                    <span class="nav-label">Wygeneruj Klucz</span>
                </a>
            </li>
            <li <?php echo $this->uri->segment(2) == "support" ? 'class="active"' : ''; ?>>
                <a href="<?php echo base_url('/admin/support'); ?>"><i class="sidebar-item-icon fa fa-calendar"></i>
                    <span class="nav-label">Panel Support</span>
                </a>
            </li>
            <li <?php echo $this->uri->segment(2) == "users" ? 'class="active"' : ''; ?>>
                <a href="<?php echo base_url('/admin/users'); ?>"><i class="sidebar-item-icon fas fa-users"></i>
                    <span class="nav-label">Użytkownicy</span>
                </a>
            </li>
            <li <?php echo $this->uri->segment(2) == "paysafecard" ? 'class="active"' : ''; ?>>
                <a href="javascript:;" aria-expanded="<?php echo $this->uri->segment(2) == "paysafecard" ? 'true' : 'false'; ?>"><i class="sidebar-item-icon fas fa-money-bill-wave"></i>
                    <span class="nav-label">Płatności</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse" aria-expanded="<?php echo $this->uri->segment(2) == "paysafecard" ? 'true' : 'false'; ?>" style="<?php echo $this->uri->segment(2) == "paysafecard" ? 'height: 0px;' : ''; ?>">
                    <li>
                        <a href="<?php echo base_url('/admin/paypal'); ?>">PayPal</a>
                    </li>
                    <li <?php echo $this->uri->segment(2) == "paysafecard" ? 'class="active"' : ''; ?>>
                        <a href="<?php echo base_url('/admin/paysafecard'); ?>">PaySafeCard</a>
                    </li>
                </ul>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>