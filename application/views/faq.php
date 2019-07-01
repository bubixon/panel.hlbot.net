<div class="content-wrapper">
    <div class="page-heading">
        <h1 class="page-title">FAQ</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Znajdziesz tu odpowiedzi na najczęściej zadawane pytania</li>
        </ol>
    </div>
    <!-- START PAGE CONTENT-->
    <div class="page-content fade-in-up">
        <div class="row">
            <?php foreach ($faq as $f): ?>
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title"><?php echo $f['question']; ?></div>
                        <div class="ibox-tools">
                            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                            <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                        </div>
                    </div>
                    <div class="ibox-body" style="">
                        <?php echo $f['answer']; ?>
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
