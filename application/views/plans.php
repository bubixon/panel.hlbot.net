<div class="content-wrapper">
    <div class="page-heading">
        <h1 class="page-title">Zakup Licencji</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Zakupisz tu licencje do multihacka</li>
        </ol>
    </div>
    <!-- START PAGE CONTENT-->
    <div class="page-content fade-in-up">
        <div class="row">
            <?php foreach ($plans as $plan): ?>
            <div class="col-md-4 mx-auto">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title"><?php echo $plan['name']; ?></div>
                    </div>
                    <div class="ibox-body">
                        <h4 class="font-bold text-center mt-3 mb-3">Cena: <?php echo $plan['price']; ?> PLN</h4>
                        <a href="<?php echo base_url('/buy/pp/' . $plan['id']); ?>" role="button" class="btn btn-info btn-block"><i class="fab fa-paypal"></i> Kup PayPalem</a>
                        <a href="<?php echo base_url('/buy/psc/' . $plan['id']); ?>" role="button" class="btn btn-success btn-block"><i class="fas fa-ticket-alt"></i> Kup PaySafeCardem</a>
                        <?php if ($plan['btc']): ?>
                        <button class="btn btn-warning btn-block"><i class="fab fa-bitcoin"></i> Kup Bitcoinem</button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
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
