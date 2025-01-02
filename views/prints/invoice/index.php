<?php 
get_header() ;
$attr  = ['class'=>"form-control"];
?>
<style>.select2 {width:100% !important}</style>
<div class="card">
    <div class="card-header d-flex flex-grow-1 align-items-center">
        <p class="h4 m-0"><?php get_title() ?></p>
    </div>
    <div class="card-body">
        <div class="form-group mb-3">
            <label for="">No Order</label>
            <?= \Core\Form::input('options-obj:trn_orders,id,order_number', 'item', ['class' => 'form-control select2', 'placeholder' => 'Pilih']) ?>
        </div>
        <div class="form-group">
            <button class="btn btn-primary" onclick="printOrder()">Cetak</button>
        </div>
    </div>
</div>
<script>
function printOrder()
{
    const order_number = $('select[name=item]').find(':selected')[0].text
    window.location.href = '<?=routeTo('kaosful/prints/invoice/view', ['order_number' => 'varOrderNumber1'])?>'.replace('varOrderNumber1', order_number)
}

</script>
<?php get_footer() ?>
