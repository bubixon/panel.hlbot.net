<div class="content-wrapper">
    <div class="page-heading">
        <h1 class="page-title">Status</h1>
    </div>
    <!-- START PAGE CONTENT-->
    <div class="page-content fade-in-up">
        <?php echo viewMessage(); ?>
        <div class="row">
            <?php if ($payment['status'] == "new"): ?>
            <div class="col-md-4 mx-auto">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Płatność za Pakiet <?php echo $payment['serviceId']; ?> / <?php echo $payment['price']; ?> PLN</div>
                    </div>
                    <div class="ibox-body">
                        <h2 class="font-bold text-center mt-3 mb-2">Status <p class="text-info">Oczekuje</p></h2>
                        <p class="text-center">Twoja płatność oczekuje na weryfikacje może to potrwać nawet kilka godzin.</p>
                    </div>
                </div>
            </div>
            <?php elseif ($payment['status'] == "bad"): ?>
            <div class="col-md-4 mx-auto">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Płatność za Pakiet <?php echo $payment['serviceId']; ?> / <?php echo $payment['price']; ?> PLN</div>
                    </div>
                    <div class="ibox-body">
                        <h2 class="font-bold text-center mt-3 mb-2">Status <p class="text-danger"> <?php echo $payment['badType'] == "code" ? "Błędny Kod" : ($payment['badType'] == "funds" ? "Niewystarczające Środki" : "Inny"); ?></p></h2>
                        <p class="text-center">
                            <?php echo $payment['badType'] == "code" ? "Twoja płatność została odrzucona, ponieważ podałeś nieprawidłowy kod/kody paysafecard." : ($payment['badType'] == "funds" ? "Twoja płatność została odrzucona, ponieważ kody jakie podałeś nie miały wystarczających środków." : "Inny"); ?>
                        </p>
                    </div>
                </div>
            </div>
            <?php elseif ($payment['status'] == "ok"): ?>
            <div class="col-md-4 mx-auto">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Płatność za Pakiet <?php echo $payment['serviceId']; ?> / <?php echo $payment['price']; ?> PLN</div>
                    </div>
                    <div class="ibox-body">
                        <h2 class="font-bold text-center mt-3 mb-2">Status <p class="text-success">Płatność Zrealizowana</p></h2>
                        <p class="text-center">Gratulacje! Twoja płatność została akceptowana :) Możesz już pobrać i grać na naszym multihacku</p>
                    </div>
                </div>
            </div>
            <?php endif; ?>
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
