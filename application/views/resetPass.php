<div class="wrapper">
    <div class="page-header">
        <div class="page-header-image"></div>
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-6 offset-lg-0 offset-md-3">
                        <div id="square7" class="square square-7"></div>
                        <div id="square8" class="square square-8"></div>
                        <?php echo viewMessage(); ?>
                        <div class="card card-register">
                            <div class="card-header">
                                <img class="card-img" src="assets/img/square1.png" alt="Card image">
                                <h4 class="card-title">Rejestracja</h4>
                            </div>
                            <div class="card-body">
                                <?php echo form_open(base_url('/register'), array('class' => 'form', 'id' => 'register')); ?>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tim-icons icon-email-85"></i>
                                        </div>
                                    </div>
                                    <input type="email" name="email" placeholder="Email" value="<?php echo set_value('email'); ?>" class="form-control" required="">
                                    <?php echo form_error('email'); ?>
                                </div>
                                <div class="form-check text-left">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox">
                                        <span class="form-check-sign"></span>
                                        Akceptuje
                                        <a href="javascript:void(0)">Regulamin Serwisu</a>.
                                    </label>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                            <div class="card-footer">
                                <button type="submit" form="register" class="btn btn-info btn-round btn-lg">Zarejestruj</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
