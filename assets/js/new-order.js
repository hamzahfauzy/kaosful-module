// var items = []
$('.add-item-button').click(function(){
    const selectedItem = {
        category: $('select[name=category]').find(':selected')[0],
        size: $('select[name=size]').find(':selected')[0],
        product: $('select[name=product]').find(':selected')[0],
        pattern: $('select[name=pattern]').find(':selected')[0],
        collar: $('select[name=collar]').find(':selected')[0],
        variant: $('select[name=variant]').find(':selected')[0],
        variant_2: $('select[name=variant_2]').find(':selected')[0],
        variant_3: $('select[name=variant_3]').find(':selected')[0],
        variant_4: $('select[name=variant_4]').find(':selected')[0],
        variant_5: $('select[name=variant_5]').find(':selected')[0],
    }
    
    const selectedData = {
        category: sanitizeSelected(selectedItem.category.text),
        size: sanitizeSelected(selectedItem.size.text),
        product: sanitizeSelected(selectedItem.product.text),
        pattern: sanitizeSelected(selectedItem.pattern.text),
        collar: sanitizeSelected(selectedItem.collar.text),
        variant: sanitizeSelected(selectedItem.variant.text),
        variant_2: sanitizeSelected(selectedItem.variant_2.text),
        variant_3: sanitizeSelected(selectedItem.variant_3.text),
        variant_4: sanitizeSelected(selectedItem.variant_4.text),
        variant_5: sanitizeSelected(selectedItem.variant_5.text),
    }
    
    const data = {
        key:items.length+1,
        name: (selectedData.product + ' ' + selectedData.size + ' ' + selectedData.pattern + ' ' + selectedData.collar + ' ' + selectedData.variant + ' ' + selectedData.variant_2 + ' ' + selectedData.variant_3 + ' ' + selectedData.variant_4 + ' ' + selectedData.variant_5).trim(),
        qty: 1,
        price: (parseInt(selectedItem.product.dataset.price) + parseInt(selectedItem.pattern.dataset.price) + parseInt(selectedItem.collar.dataset.price) + parseInt(selectedItem.variant.dataset.price) + parseInt(selectedItem.variant_2.dataset.price) + parseInt(selectedItem.variant_3.dataset.price) + parseInt(selectedItem.variant_4.dataset.price) + parseInt(selectedItem.variant_5.dataset.price)),
        total_price: 0,
        unit: selectedItem.product.dataset.unit,
        category: $('select[name=category]').val(),
        size: $('select[name=size]').val(),
        product: $('select[name=product]').val(),
        pattern: $('select[name=pattern]').val(),
        collar: $('select[name=collar]').val(),
        variant: $('select[name=variant]').val(),
        variant_2: $('select[name=variant_2]').val(),
        variant_3: $('select[name=variant_3]').val(),
        variant_4: $('select[name=variant_4]').val(),
        variant_5: $('select[name=variant_5]').val(),
    }

    data.total_price = data.price * data.qty
    
    const row = `<tr id="item_${items.length+1}">
                <td>
                <input type="hidden" name="items[${items.length}][ordering_number]" value="${items.length+1}">
                <input type="hidden" name="items[${items.length}][unit]" value="${data.unit}">
                <input type="hidden" name="items[${items.length}][name]" value="${data.name}">
                <input type="hidden" name="items[${items.length}][category_id]" value="${data.category}">
                <input type="hidden" name="items[${items.length}][size_id]" value="${data.size}">
                <input type="hidden" name="items[${items.length}][product_id]" value="${data.product}">
                <input type="hidden" name="items[${items.length}][pattern_id]" value="${data.pattern}">
                <input type="hidden" name="items[${items.length}][collar_id]" value="${data.collar}">
                <input type="hidden" name="items[${items.length}][variant_id]" value="${data.variant}">
                <input type="hidden" name="items[${items.length}][variant_2_id]" value="${data.variant_2}">
                <input type="hidden" name="items[${items.length}][variant_3_id]" value="${data.variant_3}">
                <input type="hidden" name="items[${items.length}][variant_4_id]" value="${data.variant_4}">
                <input type="hidden" name="items[${items.length}][variant_5_id]" value="${data.variant_5}">
                <input type="hidden" name="items[${items.length}][price]" value="${data.price}">
                ${items.length+1}
                </td>
                <td>${data.name}</td>
                <td>Rp. ${format_number(data.price)}</td>
                <td><input type="number" class="form-control qty-input" min="${selectedItem.product.dataset.min}" max="${selectedItem.product.dataset.max}" style="width:100px" name="items[${items.length}][qty]" value="${data.qty}" data-key="${items.length+1}"></td>
                <td>${data.unit}</td>
                <td id="total_price_${items.length+1}">Rp. ${format_number(data.total_price)}</td>
                <td><button class="btn btn-sm btn-danger remove-item-button" type="button" data-target="#item_${items.length+1}" data-key="${items.length+1}"><i class="fas fa-trash"></i></button></td>
                </tr>
                `
    $('.table-item tbody').append(row)
    items.push(data)

    $('select[name=category]').val('').trigger('change')
    $('select[name=size]').val('').trigger('change')
    $('select[name=product]').val('').trigger('change')
    $('select[name=pattern]').val('').trigger('change')
    $('select[name=collar]').val('').trigger('change')
    $('select[name=variant]').val('').trigger('change')
    $('select[name=variant_2]').val('').trigger('change')
    $('select[name=variant_3]').val('').trigger('change')
    $('select[name=variant_4]').val('').trigger('change')
    $('select[name=variant_5]').val('').trigger('change')

    calculateTotalOrder()

    refreshRow()
});

$(document.body).on('click', '.remove-item-button', function(){
    var target = $(this).data('target')
    var key = $(this).data('key')
    $(target).remove()
    const index = items.findIndex(item => item.key == key);
    if (index > -1) { // only splice array when item is found
        items.splice(index, 1); // 2nd parameter means remove one item only
    }

    calculateTotalOrder()
    refreshRow()
})

$(document.body).on('change', '.qty-input', function(){
    var key = $(this).data('key')
    const index = items.findIndex(item => item.key == key);
    const item = items[index]

    item.qty = parseInt($(this).val())
    item.total_price = item.price * item.qty
    $('#total_price_'+key).html('Rp. ' + format_number(item.total_price))
    calculateTotalOrder()
})

$('select[name=category]').on('select2:selecting', function(e) {
    // retrieve product by category
    const category_id = e.params.args.data.id
    fetch('/kaosful/orders/new/load-form-item-options?category_id='+category_id).then(res => res.json())
    .then(res => {
        $('select[name=product]').html('<option value="" data-price="0" data-unit="PCS">- Pilih -</option>')
        $('select[name=pattern]').html('<option value="" data-price="0">- Pilih -</option>')
        $('select[name=collar]').html('<option value="" data-price="0">- Pilih -</option>')
        $('select[name=variant]').html('<option value="" data-price="0">- Pilih -</option>')
        $('select[name=variant_2]').html('<option value="" data-price="0">- Pilih -</option>')
        $('select[name=variant_3]').html('<option value="" data-price="0">- Pilih -</option>')
        $('select[name=variant_4]').html('<option value="" data-price="0">- Pilih -</option>')
        $('select[name=variant_5]').html('<option value="" data-price="0">- Pilih -</option>')
        
        res.data.products.forEach(data => {
            var newOption = `<option value="${data.id}" data-price="${data.price}" data-min="${data.min_order}" data-max="${data.max_order}" data-unit="${data.unit}">${data.name}</option>`
            $('select[name=product]').append(newOption)
        })
        res.data.patterns.forEach(data => {
            var newOption = `<option value="${data.id}" data-price="${data.price}">${data.name}</option>`
            $('select[name=pattern]').append(newOption)
        })
        res.data.collars.forEach(data => {
            var newOption = `<option value="${data.id}" data-price="${data.price}">${data.name}</option>`
            $('select[name=collar]').append(newOption)
        })
        res.data.variants.forEach(data => {
            var newOption = `<option value="${data.id}" data-price="${data.price}">${data.name}</option>`
            $('select[name=variant]').append(newOption)
        })
        res.data.variants_2.forEach(data => {
            var newOption = `<option value="${data.id}" data-price="${data.price}">${data.name}</option>`
            $('select[name=variant_2]').append(newOption)
        })
        res.data.variants_3.forEach(data => {
            var newOption = `<option value="${data.id}" data-price="${data.price}">${data.name}</option>`
            $('select[name=variant_3]').append(newOption)
        })
        res.data.variants_4.forEach(data => {
            var newOption = `<option value="${data.id}" data-price="${data.price}">${data.name}</option>`
            $('select[name=variant_4]').append(newOption)
        })
        res.data.variants_5.forEach(data => {
            var newOption = `<option value="${data.id}" data-price="${data.price}">${data.name}</option>`
            $('select[name=variant_5]').append(newOption)
        })
    })
});


function refreshRow()
{
    if(items.length)
    {
        $('#empty_item').hide()
    }
    else
    {
        $('#empty_item').show()
    }
}

function sanitizeSelected(value)
{
    return value.replace('- Pilih -','')
}

function format_number(value)
{
    return new Intl.NumberFormat().format(value)
}

function calculateTotalOrder()
{
    var totalOrder = 0
    items.forEach(item => {
        totalOrder += item.total_price
    })

    $('input[name="trn_orders[total_value]"]').val(format_number(totalOrder))

    if($('input[name="trn_orders[total_qty]"]'))
    {
        $('input[name="trn_orders[total_qty]"]').val(items.length)
    }
}