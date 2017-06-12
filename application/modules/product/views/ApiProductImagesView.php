<div class="row" id="eachImagesUploaded">
<?php foreach($images as $key => $row): ?>
    <div class="col-sm-3">
        <img src="<?= $row->image_location ?>" data-id="<?= $row->id ?>" class="img-selected img-thumbnail img-responseve">
    </div>
<?php endforeach; ?>
</div>