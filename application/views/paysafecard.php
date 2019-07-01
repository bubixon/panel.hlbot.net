<div class="content-wrapper">
    <div class="page-heading">
        <h1 class="page-title">Zakup</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Strona Płatności</li>
        </ol>
    </div>
    <!-- START PAGE CONTENT-->
    <div class="page-content fade-in-up">
        <?php echo viewMessage(); ?>
        <div class="row">
            <div class="col-md-4 mx-auto">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Płatność Paysafecard - <?php echo $service['name']; ?></div>
                    </div>
                    <div class="ibox-body">
                        <?php echo form_open(base_url('/buy/psc/' . $service['id']), array('class' => 'form-horizontal')); ?>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Kod 1</label>
                                <div class="col-sm-10">
                                    <input class="form-control paysafecard" name="code1" type="text" placeholder="xxxx-xxxx-xxxx-xxxx" required="">
                                    <p class="text-muted">Pola kodu 2 i 3 wypełniamy kiedy płacimy więcej niż jednym kodem paysafecard.</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Kod 2</label>
                                <div class="col-sm-10">
                                    <input class="form-control paysafecard" name="code2" type="text" placeholder="xxxx-xxxx-xxxx-xxxx (Opcjonalnie)">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Kod 3</label>
                                <div class="col-sm-10">
                                    <input class="form-control paysafecard" name="code3" type="text" placeholder="xxxx-xxxx-xxxx-xxxx (Opcjonalnie)">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10 ml-sm-auto">
                                    <h4 class="font-bold text-center mt-3 mb-3">Płacisz <?php echo $service['price']; ?> PLN</h4>
                                    <button class="btn btn-info btn-block" type="submit"><i class="fas fa-ticket-alt"></i> Zapłać PaySafeCard'em</button>
                                    <p class="mt-4">Uwaga! Aktywacja usługi przy zakupie paysafecardem trwa zazwyczaj od 5 do 20 minut. Jednak czasami może trwać to dłużej.</p>
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