<?php 
get_header() ;
$attr  = ['class'=>"form-control"];
?>
<style>.select2 {width:100% !important}</style>
<div class="card">
    <div class="card-header d-flex flex-grow-1 align-items-center">
        <p class="h4 m-0"><?php get_title() ?></p>
        <div class="right-button ms-auto">
            <a href="<?= routeTo('kaosful/jobs/fulfillment') ?>" class="btn btn-warning btn-sm">
                <?= __('crud.label.back') ?>
            </a>
        </div>
    </div>
    <div class="card-body">
        <?php if($error_msg): ?>
        <div class="alert alert-danger"><?=$error_msg?></div>
        <?php endif ?>
        <?php if($success_msg): ?>
        <div class="alert alert-success"><?=$success_msg?></div>
        <?php endif ?>
        <div class="form-group mb-3">
            <form action="" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <table class="table table-bordered table-item">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Deskripsi Keterangan Order</th>
                        <th>@Harga</th>
                        <th>Qty</th>
                        <th>Satuan</th>
                        <th>Jumlah Order</th>
                        <th>Completed</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($items as $item): ?>
                    <tr>
                        <td><?=$item->ordering_number?></td>
                        <td><?=$item->name?></td>
                        <td>Rp. <?=number_format($item->price)?></td>
                        <td><?=number_format($item->qty)?></td>
                        <td><?=$item->unit?></td>
                        <td>Rp. <?=number_format($item->order_amount)?></td>
                        <td>
                            <input type="hidden" name="completed[<?=$item->id?>]" value="<?=$item->qty == $item->qty_done ? $item->qty : 0 ?>" id="item_<?=$item->id?>">
                            <input type="checkbox" class="completed_checkbox" <?=$item->qty == $item->qty_done ? 'checked=""' : '' ?> data-value="<?=$item->qty?>" data-target="#item_<?=$item->id?>" onchange="document.querySelector('#item_<?=$item->id?>').value=this.checked ? <?=$item->qty?> : 0">
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <div class="form-group mt-3">
                <button class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
setTimeout(function(){
    document.querySelectorAll('.completed_checkbox').forEach(cb => {
        if(cb.checked)
        {
            document.querySelector(cb.dataset.target).value = cb.dataset.value
        }
    })
}, 1000)
</script>
<?php get_footer() ?>
