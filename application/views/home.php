<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-content fade-in-up">
        <?php echo viewMessage(); ?>
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-success color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">201</h2>
                        <div class="m-b-5">Sprzedanych Licencji</div><i class="ti-shopping-cart widget-stat-icon"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-info color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">3.0.1</h2>
                        <div class="m-b-5">Wersja HLbota</div><i class="ti-bar-chart widget-stat-icon"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-warning color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong"><?php echo $countServers; ?></h2>
                        <div class="m-b-5">Aktualnie Serwerów</div><i class="fa fa-money widget-stat-icon"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-danger color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong"><?php echo $countUsers; ?></h2>
                        <div class="m-b-5">Zarejestrowanych Kont</div><i class="ti-user widget-stat-icon"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Informacje</div>
                    </div>
                    <div class="ibox-body">
                        <ul class="media-list media-list-divider m-0">
                            <li class="media">
                                <div class="media-body">
                                    <div class="media-heading">Poprawki Tamidia <small class="float-right text-muted">11 minut temu</small></div>
                                    <div class="font-13">Zaktualizowano multihacka na tamidie poprawiono inject i wydajność.</div>
                                </div>
                            </li>
                            <li class="media">
                                <div class="media-body">
                                    <div class="media-heading">Nowa aplikacja <small class="float-right text-muted">1 godzinę temu</small></div>
                                    <div class="font-13">W zakładce download można pobrać nową wersje multihacka.</div>
                                </div>
                            </li>
                            <li class="media">
                                <div class="media-body">
                                    <div class="media-heading">Płatności <small class="float-right text-muted">3 godziny temu</small></div>
                                    <div class="font-13">Dzisiaj zostały dodane płatności paypalem zapraszamy.</div>
                                </div>
                            </li>
                            <li class="media">
                                <div class="media-body">
                                    <div class="media-heading">Poprawki <small class="float-right text-muted">7 godziny temu</small></div>
                                    <div class="font-13">Poprawiono błędy związane z pickupem na wszystkich serwerach.</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Informacje o koncie</div>
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
