<div class="content-wrapper">
    <div class="page-heading">
        <h1 class="page-title">Support</h1>
    </div>
    <!-- START PAGE CONTENT-->
    <div class="page-content fade-in-up">
        <?php echo viewMessage(); ?>
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="ibox">
                    <div class="ibox-body">
                        <?php if ($page == "index") : ?>
                        <a href="<?php echo base_url('/support/create'); ?>" role="button" class="btn btn-success">Stwórz</a>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Temat</th>
                                    <th>Data</th>
                                    <th>Status</th>
                                    <th>Akcje</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($tickets as $ticket): ?>
                                <tr>
                                    <td><?php echo $ticket['title']; ?></td>
                                    <td><?php echo date('H:i:s d/m/Y', strtotime($ticket['date'])); ?></td>
                                    <td><p class="text-<?php echo $ticket['admin'] == 0 ? 'danger' : 'success'; ?>"><?php echo $ticket['admin'] == 0 ? 'Czeka na odpowiedź supportu' : 'Odpowiedź została udzielona'; ?></p></td>
                                    <td>
                                        <div class="btn-group m-b-10 btn-rounded">
                                            <a href="<?php echo base_url('/support/view/' . $ticket['id']); ?>" role="button" class="btn btn-success"><i class="fas fa-location-arrow"></i> Zobacz</a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php elseif ($page == "create"): ?>
                            <div class="ibox-head">
                                <div class="ibox-title">Aktywuj Klucz</div>
                            </div>
                            <div class="ibox-body">
                                <?php echo form_open(base_url('/support/create'), array('class' => 'form-horizontal')); ?>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tytuł</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="title" placeholder="Krótki tytuł zgłoszenia, np. Zmiana hwid">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Opis zgłoszenia</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="desc" placeholder="Krótki tytuł zgłoszenia, np. Zmiana hwid">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10 ml-sm-auto">
                                        <button class="btn btn-info btn-block" type="submit">Stwórz zgłoszenie</button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        <?php elseif ($page == "view" && is_numeric($id)): ?>
                            <?php foreach($ticket['replices'] as $replice): ?>
                            <?php if ($replice['admin'] == 0): ?>
                            <div class="col-md-10 mx-auto mt-2">
                                <div class="card">
                                    <div class="p-2 card-body">
                                        <p class="mb-1"><?php echo $replice['desc']; ?></p>
                                        <div><small class="opacity-60"><i class="far fa-clock"></i> <?php echo $replice['date']; ?> napisał <?php echo $this->session->email; ?></small></div>
                                    </div>
                                </div>
                            </div>
                            <?php else: ?>
                            <div class="col-md-10 mx-auto mt-2">
                                <div class="card">
                                    <div class="p-2 card-body">
                                        <p class="mb-1"><?php echo $replice['desc']; ?></p>
                                        <div><small class="opacity-60 text-danger"><i class="far fa-clock"></i> <?php echo $replice['date']; ?> napisał Administrator</small></div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php endforeach; ?>
                                <?php if ($ticket['ticket'][0]['status'] == "open"): ?>
                                <div class="ibox-body">
                                    <div class="form-horizontal">
                                        <div class="d-block card-footer"><?php echo form_open(base_url('/support/view/') . $id, array('class' => 'align-items-center')); ?><div class="d-flex form-control-lg input-group"><div class="d-flex input-group-prepend"><span class="input-group-text"><i class="tim-icons icon-pencil"></i></span></div><input placeholder="Wiadomość..." type="text" name="desc" class="form-control"><button class="btn-simple ml-2 btn btn-primary"><i class="fas fa-location-arrow"></i> Wyślij</button></div><?php echo form_close(); ?></div>
                                        <?php echo form_error('desc'); ?>
                                </div>
                                    <?php endif; ?>

                        <?php endif; ?>
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
