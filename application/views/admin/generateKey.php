<div class="content-wrapper">
    <div class="page-heading">
        <h1 class="page-title">Generowanie Kluczy</h1>
    </div>
    <!-- START PAGE CONTENT-->
    <div class="page-content fade-in-up">
        <?php echo viewMessage(); ?>
        <div class="row">
            <div class="col-md-4 mx-auto">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Generator Kluczy</div>
                    </div>
                    <div class="ibox-body">
                        <?php echo form_open(base_url('/admin/generateKey'), array('class' => 'form-horizontal')); ?>
                            <div class="form-group">
                                <label>Czas</label>
                                <select class="form-control" name="days">
                                    <option value="30">Na 30 dni</option>
                                    <option value="60">Na 60 dni</option>
                                    <option value="90">Na 90 dni</option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12 ml-sm-auto">
                                    <button class="btn btn-info btn-block" type="submit">Generuj</button>
                                </div>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Historia wygenerowanych kluczy</div>
                    </div>
                    <div class="ibox-body">
                        <ul class="media-list media-list-divider m-0">
                            <?php foreach ($licenses as $license): ?>
                            <li class="media">
                                <div class="media-body">
                                    <div class="media-heading">Na <?php echo $license['days']; ?> dni <small class="float-right text-muted">Wygenerowany przez <?php echo $license['admin']; ?> <?php echo $license['date']; ?></small></div>
                                    <div class="font-13"><?php echo $license['license']; ?></div>
                                </div>
                            </li>
                            <?php endforeach; ?>
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
