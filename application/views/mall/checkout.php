<div class="container">
    <header class="page-header">
        <h1 class="page-title">
            <?php echo $this->
            lang->line('checkout_title'); ?>
        </h1>
    </header>
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
                        <tr>
                            <td>
                                Gucci Patent Leather Open Toe Platform
                            </td>
                            <td>
                                1
                            </td>
                            <td>
                                $499
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Nikon D5200 24.1 MP Digital SLR Camera
                            </td>
                            <td>
                                1
                            </td>
                            <td>
                                $350
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Apple 11.6" MacBook Air Notebook
                            </td>
                            <td>
                                1
                            </td>
                            <td>
                                $1100
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Fossil Women's Original Boyfriend
                            </td>
                            <td>
                                1
                            </td>
                            <td>
                                $250
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Subtotal
                            </td>
                            <td>
                            </td>
                            <td>
                                $2199
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Shipping
                            </td>
                            <td>
                            </td>
                            <td>
                                $0
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Total
                            </td>
                            <td>
                            </td>
                            <td>
                                $2199
                            </td>
                        </tr>
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
                <div class="form-group">
                    <label>
                        Country
                    </label>
                    <input class="form-control" type="text" value="<?php echo $user['nationality'] ?>" readonly/>
                </div>
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
            <div class="cc-form">
                <p>Silahkan transfer Ke :</p>
                <p><strong>No : 1111111</strong></p>
                <p><strong>A.n : AgendaFX</strong></p>
            </div>
            <a class="btn btn-primary">
                Proceed Payment
            </a>
        </div>
    </div>
</div>