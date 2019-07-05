<div class="content-wrapper">
    <div class="page-heading">
        <h1 class="page-title">Lista Transakcji</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Znajdziesz tu liste i status twoich zakupów</li>
        </ol>
    </div>
    <!-- START PAGE CONTENT-->
    <div class="page-content fade-in-up">
        <?php echo viewMessage(); ?>
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="ibox">
                    <div class="ibox-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Status</th>
                                    <th>Akcje</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($pscs as $psc): ?>
                                    <tr>
                                        <td><?php echo $psc['date']; ?></td>
                                        <td><?php

                                            $status = $psc['status'];

                                            switch ($status)
                                            {
                                                case 'new':
                                                    echo '<p class="text-info">Oczekuje</p>';
                                                    break;

                                                case 'bad':
                                                    echo '<p class="text-danger">Odrzucona</p>';
                                                    break;

                                                case 'ok':
                                                    echo '<p class="text-success">Zrealizowana</p>';
                                                    break;
                                            }

                                        ?></td>
                                        <td>
                                                <a href="<?php echo base_url('/buy/status/psc/' . $psc['id']); ?>" role="button" class="btn btn-success"><i class="fas fa-location-arrow" aria-hidden="true"></i> Otwórz Transakcje</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
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
