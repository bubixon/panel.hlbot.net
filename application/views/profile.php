<div class="content-wrapper">
    <div class="page-heading">
        <h1 class="page-title">Profil</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Informacje i ustawienia twojego konta</li>
        </ol>
    </div>
    <!-- START PAGE CONTENT-->
    <div class="page-content fade-in-up">
        <?php echo viewMessage(); ?>
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="ibox">
                    <div class="ibox-body">
                        <ul class="nav nav-tabs tabs-line">
                            <li class="nav-item">
                                <a class="nav-link active" href="#tab-1" data-toggle="tab" aria-expanded="true"><i class="ti-settings"></i> Zmiana Hasła</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#tab-3" data-toggle="tab" aria-expanded="false"><i class="fas fa-history"></i> Historia Logowań</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="tab-1" aria-expanded="true">
                                <?php echo form_open(base_url('/changePass')); ?>
                                    <div class="form-group">
                                        <label>Aktualne hasło</label>
                                        <input class="form-control" name="password" type="password" placeholder="Aktualne hasło">
                                    </div>
                                    <div class="form-group">
                                        <label>Nowe hasło</label>
                                        <input class="form-control" name="newPassword" type="password" placeholder="Nowe hasło">
                                    </div>
                                    <div class="form-group">
                                        <label>Powtórz nowe hasło</label>
                                        <input class="form-control" name="newPasswordConf" type="password" placeholder="Powtórz nowe hasło">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-default" type="submit">Zmień hasło</button>
                                    </div>
                                <?php echo form_close(); ?>
                            </div>
                            <div class="tab-pane fade" id="tab-3" aria-expanded="false">
                                <ul class="media-list media-list-divider m-0">
                                    <?php foreach ($history as $h) : ?>
                                    <li class="media">
                                        <div class="media-body">
                                            <div class="media-heading">(<?php echo $h['browser']; ?>) - <?php echo $h['platform']; ?></div>
                                            <div class="font-13"><?php echo $h['date']; ?></div>
                                        </div>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Informacje</div>
                    </div>
                    <div class="ibox-body">
                        <ul class="list-group list-group-divider list-group-full">
                            <li class="list-group-item">Ważność licencji:
                                <span class="float-right text-<?php echo getUser()['license_id'] > 0 ? 'success' : 'danger'; ?>"><?php echo getUser()['license_id'] > 0 ? getUser()['l_end_date'] : "Brak"; ?></span>
                            </li>
                            <li class="list-group-item">Data Rejestracji:
                                <span class="float-right text-danger"><?php echo date('d-m-Y', strtotime($account['register_date'])); ?></span>
                            </li>
                            <li class="list-group-item">E-mail:
                                <span class="float-right"><?php echo $this->session->email; ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .visitors-table tbody tr td:last-child {
                display: flex;
                align-items: center;
            }

            .visitors-table .progress {
                flex: 1;
            }

            .visitors-table .progress-parcent {
                text-align: right;
                margin-left: 10px;
            }
        </style>
    </div>
