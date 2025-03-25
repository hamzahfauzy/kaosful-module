// var items = []
$('.add-item-button').click(function(){
    const itemValue = {
        item: $('select[name=item]').find(':selected')[0],
        name: $('input[name=name]'),
        number_description: $('input[name=number_description]'),
        description: $('input[name=description]'),
    }
    
    const data = {
        key:items.length+1,
        item: itemValue.item.text,
        name: itemValue.name.val(),
        size_name: $('#size_selected_label').html(),
        number_description: itemValue.number_description.val(),
        description: itemValue.description.val(),
    }
    
    const row = `<tr id="item_${items.length+1}">
                <td>
                <input type="hidden" name="items[${items.length}][order_number]" value="${items.length+1}">
                <input type="hidden" name="items[${items.length}][order_item_id]" value="${itemValue.item.value}">
                <input type="hidden" name="items[${items.length}][name]" value="${data.name}">
                <input type="hidden" name="items[${items.length}][description]" value="${data.description}">
                <input type="hidden" name="items[${items.length}][number_description]" value="${data.number_description}">
                ${items.length+1}
                </td>
                <td>${data.item}</td>
                <td>${data.size_name}</td>
                <td>${data.name}</td>
                <td>${data.number_description}</td>
                <td>${data.description}</td>
                <td><button class="btn btn-sm btn-danger remove-item-button" type="button" data-target="#item_${items.length+1}" data-key="${items.length+1}"><i class="fas fa-trash"></i></button></td>
                </tr>
                `
    $('.table-item tbody').append(row)
    items.push(data)

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

    refreshRow()
})

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
    return new Intl.NumberFormat('en-US').format(value)
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

$('select[name=item]').change(function(){
    const item_id = $(this).val()
    fetch('/kaosful/orders/items?id='+item_id)
    .then(res => res.json())
    .then(res => {
        $('#size_selected_label').html(res.data.size_name)
    })

})