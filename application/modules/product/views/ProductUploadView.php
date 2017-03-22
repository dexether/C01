<?php
add_js(base_url('assets/lib/dropzone/min/dropzone.min.js'));
add_js(base_url('assets/lib/formvalidator/formValidation.min.js'));
add_js(base_url('assets/lib/formvalidator/framework/bootstrap.min.js'));
add_js(base_url('assets/js/productupload.js'));
?>
<link rel="stylesheet" type="text/css" href="/assets/lib/dropzone/min/dropzone.min.css" />
<div class="columns-container">
      <div class="row">
        <div class="column col-lg-12" id="left_column">
            <div class="block left-module card-1">
                <p class="title_block">Jual produk baru</p>
                <div class="block_content">
                    <form class="form-horizontal" id="productUploadForm">
                    <?= form_open('/' , ['id' => 'productUploadForm']) ?>
                        <legend>Tentukan Barang Jualan</legend>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Nama Barang</label>
                            <div class="col-sm-8">
                                <input autofocus type="text" id="product_name" name="product_name" class="form-control" placeholder="Tulis nama barangmu disini ...."/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Kategori</label>
                            <div class="col-sm-3">
                                <select name="id_cat" class="form-control">
                                <?php foreach($categories as $key => $row): ?>
                                <option value="<?= $row->id ?>"><?= $row->cat_alias ?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <br/>
                        <legend>Tuliskan Deskripsi Barang</legend> 
                        <div class="form-group">
                            <label class="control-label col-sm-2">Perkiraan berat</label>
                            <div class="col-sm-3">
                                <!--<input autofocus type="text" name="product_weight" class="form-control" placeholder="Tulis nama barangmu disini ...."/>-->
                                <div class="input-group">
                                    <input type="text" class="form-control" id="product_weight" name="product_weight">
                                    <div class="input-group-addon">gram</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Harga Satuan</label>
                            <div class="col-sm-3">
                                <!--<input autofocus type="text" name="product_weight" class="form-control" placeholder="Tulis nama barangmu disini ...."/>-->
                                <div class="input-group">
                                    <div class="input-group-addon">Rp</div>
                                    <input type="text" class="form-control" id="product_price" name="product_price">
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-warning">
                            <strong>Tips laris berjualan</strong>: Upload foto barang jualanmu dari berbagai sisi. Cara ini dapat meningkatkan peluang terjualnya barang sebesar 60%.
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Gambar</label>
                            <div class="col-sm-8"> 
                                <div id="dropzoneupload" class="dropzone"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Deskripsi</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" rows="4" id="product_desc"  name="product_desc"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-8 col-sm-offset-2">
                                <button class="btn btn-default" type="reset">Cancel</button>
                                <!-- Button trigger modal -->
                                <button onclick="testDropzone()" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                                Launch demo modal
                                </button>
                                <button class="btn btn-primary pull-right" type="submit">Jual</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center" role="document">
            <div class="modal-content">
            <div class="modal-header modal-header-info">
                <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                <h4 class="modal-title" id="myModalLabel">Pilih Gambar Utama</h4>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                <button type="button" class="btn btn-primary btn-outline" onclick="setPrimaryImages()">Publish produk</button>
            </div>
            </div>
        </div>
    </div>
</div>