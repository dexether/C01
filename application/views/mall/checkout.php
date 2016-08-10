<div class="container">
    <header class="page-header">
        <h1 class="page-title">
            <?php echo $this->
            lang->line('checkout_title'); ?>
        </h1>
    </header>
    <?php
    if (empty($user['address']) || $user['address'] == "") {
        $this->nativesession->set('page','profile');
    ?>
    <div class="alert alert-warning">Profile anda belum lengkap, silahkan lengkapi <a href="<?php echo base_url('web2/mainmenu.php') ?>" target="_blank">disini</a></div>
    <?php
    }
    ?>
    <div class="row row-col-gap" data-gutter="60">
        <div class="col-md-4">
            <h3 class="widget-title">
                <?php echo $this->
                lang->line('checkout_order_info'); ?>
            </h3>
            <div class="box">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                Product
                            </th>
                            <th>
                                QTY
                            </th>
                            <th>
                                Price
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($list as $key => $value) {
                            # code...
                        ?>

                        <tr>
                            <td>
                                <?php echo $value['prod_alias']; ?>
                            </td>
                            <td>
                                <?php echo $value['qty']; ?>
                            </td>
                            <td>
                                <?php echo $this->format->set_rp($value['final_price']); ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-4">
            <h3 class="widget-title">
                <?php echo $this->
                lang->line('checkout_alamat_info'); ?>
            </h3>
            <form>
                <div class="form-group">
                    <label>
                        First & Last Name
                    </label>
                    <input class="form-control" type="text" name="name" value="<?php echo $user['name'] ?>" readonly />
                </div>
                <div class="form-group">
                    <label>
                        E-mail
                    </label>
                    <input class="form-control" type="text" value="<?php echo $user['email'] ?>" readonly />
                </div>
               <!--  <div class="form-group">
                    <label>
                        Phone Number
                    </label>
                    <input class="form-control" type="text" value="<?php echo $user['name'] ?>" readonly/>
                </div> -->
                <!-- <div class="checkbox">
                    <label>
                        <input class="i-check" id="create-account-checkbox" type="checkbox"/>
                        Create TheBox Profile
                    </label>
                </div> -->
                <!-- <div class="form-group">
                    <label>
                        Country
                    </label>
                    <input class="form-control" type="text" value="<?php echo $user['nationality'] ?>" readonly/>
                </div> -->
                <div class="form-group">
                    <label>
                        Address
                    </label>
                    <textarea class="form-control" readonly><?php echo $user['address'] ?></textarea>
                    <!-- <input class="form-control" type="text"/> -->
                </div>
            </form>
        </div>
        <div class="col-md-4">
            <h3 class="widget-title">
                <?php echo $this->lang->line('checkout_payment_info'); ?>
            </h3>
            <img src="<?php echo base_url() ?>assets/logo/atm_bca.gif" style="height: 100px" class="img-responsive img-rounded">
            <div class="cc-form">
                <p>Silahkan transfer Ke :</p>
                <p><strong>No : 2218050455</strong></p>
                <p><strong>A.n : Roby Martiarto</strong></p>
            </div>
            <?php 
            if (empty($user['address']) || $user['address'] == "") {
            }else{
            ?>
            <?php echo form_open('checkout', array("name" => 'payform'));
            echo form_input(array('type' => 'submit', 'name' => 'submit', 'value' => 'Proceed Payment', 'class' => 'btn btn-primary'));
            echo form_input(array('type' => 'hidden', 'name' => 'invoice', 'value' => $this->uri->segment(2)));
            ?>           
            <?php
            form_close();
            }
            ?>
        </div>
    </div>
</div>