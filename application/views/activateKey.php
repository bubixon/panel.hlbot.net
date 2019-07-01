<div class="content-wrapper">
    <div class="page-heading">
        <h1 class="page-title">Aktywuj Klucz</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Aktywujesz tu otrzymany w nagrodzie lub zakupiony przez bitcoiny klucz</li>
        </ol>
    </div>
    <!-- START PAGE CONTENT-->
    <div class="page-content fade-in-up">
        <?php echo viewMessage(); ?>
        <div class="row">
            <div class="col-md-4 mx-auto">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Aktywuj Klucz</div>
                    </div>
                    <div class="ibox-body">
                        <?php echo form_open(base_url('/activateKey'), array('class' => 'form-horizontal')); ?>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Klucz</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="key" placeholder="xxxx-xxxx-xxxx-xxxx">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10 ml-sm-auto">
                                    <button class="btn btn-info btn-block" type="submit">Aktywuj Klucz</button>
                                </div>
                            </div>
                        <?php echo form_close(); ?>
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
