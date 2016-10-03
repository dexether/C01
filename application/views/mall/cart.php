<div class="container">
    <header class="page-header">
        <h1 class="page-title">
            <?php echo $this->lang->line('cart_title'); ?>
        </h1>
    </header>
    <div class="row">
        <div class="col-md-10">
            <table class="table table table-shopping-cart">
                <thead>
                    <tr>
                        <th>
                            Product
                        </th>
                        <th>
                            Title
                        </th>
                        <th>
                            Price
                        </th>
                        <th>
                            Quality
                        </th>
                        <th>
                            Total
                        </th>
                        <th>
                            Remove
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php
                foreach ($list as $key => $value) {
                    # code...
                ?>
                    <tr>
                        <td class="table-shopping-cart-img">
                            <a href="#">
                                <img alt="Image Alternative text" src="<?php echo base_url().$value['prod_images'] ?>" title="<?php echo $value['prod_alias'] ?>"/>
                            </a>
                        </td>
                        <td class="table-shopping-cart-title">
                            <a href="#">
                                <?php echo $value['prod_alias'] ?>
                            </a>
                        </td>
                        <td>
                            <?php echo $this->format->set_rp($value['final_price']) ?>
                        </td>
                        <td>
                            <input class="form-control table-shopping-qty" type="text" value="<?php echo $value['qty'] ?>" readonly/>
                        </td>
                        <td>
                            <?php echo $this->format->set_rp($value['final_price'] * $value['qty']) ?>
                        </td>
                        <td>
                            <a class="fa fa-close table-shopping-remove" id="removethis" href="<?php echo base_url('cart/alter/'.$value['id']) ?>">
                            </a>
                        </td>
                    </tr>
                <?php
                @$total = @$total + $value['final_price'] * $value['qty'];
                @$qty = @$qty + $value['qty'];
                }

                ?>
                </tbody>
            </table>
            <div class="gap gap-small">
            </div>
        </div>
        <div class="col-md-2">
            <ul class="shopping-cart-total-list">
                <li>
                    <span>
                        <?php echo $this->lang->line('cart_qty'); ?>
                    </span>
                    <span>
                        <?php echo $qty;  ?>
                    </span>
                </li>
                <li>
                    <span>
                        <?php echo $this->lang->line('cart_total'); ?>
                    </span>
                    <span>
                        <!-- $total -->
                        <?php echo $this->format->set_rp($total) ?>
                    </span>
                </li>
            </ul>
            <a class="btn btn-primary" href="<?php echo base_url()?>cart/checkout">
                <?php echo $this->lang->line('cart_checkout'); ?>
            </a>
        </div>
    </div>
    <ul class="list-inline">
        <li>
            <a class="btn btn-default" href="<?php echo base_url() ?>">
                <?php echo $this->lang->line('cart_continue'); ?>
            </a>
        </li>
    </ul>
</div>
<!-- <script type="text/javascript">
    $('table').on('click', '#removethis', function(e){
       $(this).closest('tr').fadeOut('fast');
    })
</script> -->