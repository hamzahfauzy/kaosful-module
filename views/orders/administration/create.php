<?php 
get_header() ;
$attr  = ['class'=>"form-control"];
?>
<style>.select2 {width: 350px;}</style>
<div class="card">
    <div class="card-header d-flex flex-grow-1 align-items-center">
        <p class="h4 m-0"><?php get_title() ?></p>
        <div class="right-button ms-auto">
            <a href="<?= routeTo('kaosful/orders/administration') ?>" class="btn btn-warning btn-sm">
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
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="row mb-3">
                        <label class="mb-2 col-4">No. Order</label>
                        <div class="col-8">
                            <input type="text" class="form-control" readonly value="<?=$data->order_number?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="mb-2 col-4">Tgl. Order</label>
                        <div class="col-8">
                            <input type="text" class="form-control" readonly value="<?=$data->order_date?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="mb-2 col-4">Customer</label>
                        <div class="col-8">
                            <input type="text" class="form-control" readonly value="<?=$data->customer->name?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="mb-2 col-4"></label>
                        <div class="col-8" style="height: 38.94px;">
                            No. Hp : <?=$data->customer->phone?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="mb-2 col-4">Total Nilai Order</label>
                        <div class="col-8">
                            <input type="text" class="form-control" readonly value="Rp. <?=number_format($data->total_value)?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="mb-2 col-4">Foto Depan</label>
                        <div class="col-8">
                            <input type="file" class="form-control" name="pic_1">

                            <?php if($data->pic_1): ?>
                                <a href="<?=asset($data->pic_1)?>" class="btn btn-sm btn-secondary mt-2" target="_blank">Preview</a>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="row mb-3">
                        <label class="mb-2 col-4">Jenis Order</label>
                        <div class="col-8">
                            <input type="text" class="form-control" readonly value="<?=$data->order_type->name?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="mb-2 col-4">Tgl. Est Selesai</label>
                        <div class="col-8">
                            <input type="text" class="form-control" readonly value="<?=$data->order_done_date?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="mb-2 col-4">Karyawan</label>
                        <div class="col-8">
                            <input type="text" class="form-control" readonly value="<?=$data->employee->name?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="mb-2 col-4">Keterangan</label>
                        <div class="col-8">
                            <input type="text" class="form-control" readonly value="<?=$data->description?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="mb-2 col-4">Total Qty</label>
                        <div class="col-8">
                            <input type="text" class="form-control" readonly value="<?=$data->total_qty?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="mb-2 col-4">Foto Belakang</label>
                        <div class="col-8">
                            <input type="file" class="form-control" name="pic_2">

                            <?php if($data->pic_2): ?>
                                <a href="<?=asset($data->pic_2)?>" class="btn btn-sm btn-secondary mt-2" target="_blank">Preview</a>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
            <?= csrf_field() ?>
            <div class="form-group mb-3">
                <table class="table table-bordered table-item">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Item</th>
                            <th>Nama</th>
                            <th>Nomor</th>
                            <th>Catatan</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td>
                                <?= \Core\Form::input('options-obj:trn_order_items,id,name|order_id,'.$data->id, 'item', array_merge($attr, ['class' => 'form-control', 'placeholder' => 'Pilih'])) ?>
                            </td>
                            <td>
                                <input type="text" name="name" id="name" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="number_description" id="number_description" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="description" id="description" class="form-control">
                            </td>
                            <td><button type="button" class="btn btn-info btn-sm add-item-button">Tambah Item</button></td>
                        </tr>
                        <?php foreach($data->names as $item): ?>
                        <tr>
                            <td><?=$item->order_number?></td>
                            <td><?=$item->item->name?></td>
                            <td><?=$item->name?></td>
                            <td><?=$item->number_description?></td>
                            <td><?=$item->description?></td>
                            <td><a href="<?=routeTo('crud/delete',['table'=>'trn_order_names','id'=>$item->id])?>" onclick="if(confirm('Apakah anda yakin akan menghapus data ini ?')){return true}else{return false}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a></td>
                        </tr>
                        <?php endforeach ?>
                        <tr id="empty_item" <?= !empty($data->names) ? 'style="display:none"' : ''?>>
                            <td colspan="6" class="text-center"><i>Belum ada item</i></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Simpan Order</button>
            </div>
        </form>
    </div>
</div>

<?php get_footer() ?>
