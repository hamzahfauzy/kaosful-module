window.reportTransaction = $('.datatable-report-transaction').DataTable({
    // stateSave:true,
    pagingType: 'full_numbers_no_ellipses',
    processing: true,
    search: {
        return: true
    },
    serverSide: true,
    ajax: {
        url: location.href,
        data: function(data){
            // Read values
            var startDate = $('input[name=start_date]').val()
            var endDate = $('input[name=end_date]').val()
            var order_type = $('select[name=order_type]').val()
            var customer = $('select[name=customer]').val()
            var employee = $('select[name=employee]').val()
            var category = $('select[name=category]').val()
            var status = $('select[name=status]').val()

            // Append to data
            data.searchByDate = {
                startDate,
                endDate
            }

            data.filter = {}
            if(order_type)
            {
                data.filter.order_type_id = order_type
            }
            
            if(customer)
            {
                data.filter.customer_id = customer
            }
            
            if(employee)
            {
                data.filter.employee_id = employee
            }
            
            if(category)
            {
                data.filter.category = category
            }
            
            if(status)
            {
                data.filter.status = status
            }

            if(!Object.keys(data.filter).length)
            {
                delete data.filter
            }

            // console.log(data)
        }
    },
    aLengthMenu: [
        [25, 50, 100, 200],
        [25, 50, 100, 200]
    ],
})

window.reportFulfillment = $('.datatable-report-fulfillment').DataTable({
    // stateSave:true,
    pagingType: 'full_numbers_no_ellipses',
    processing: true,
    search: {
        return: true
    },
    serverSide: true,
    ajax: {
        url: location.href,
        data: function(data){
            // Read values
            var startDate = $('input[name=start_date]').val()
            var endDate = $('input[name=end_date]').val()
            var order_type = $('select[name=order_type]').val()
            var customer = $('select[name=customer]').val()
            var size = $('select[name=size]').val()
            var category = $('select[name=category]').val()
            var fulfillment = $('select[name=fulfillment]').val()

            // Append to data
            data.searchByDate = {
                startDate,
                endDate
            }

            data.filter = {}
            if(order_type)
            {
                data.filter.order_type_id = order_type
            }
            
            if(customer)
            {
                data.filter.customer_id = customer
            }
            
            if(size)
            {
                data.filter.size = size
            }
            
            if(category)
            {
                data.filter.category = category
            }
            
            if(fulfillment)
            {
                data.filter.fulfillment_status = fulfillment
            }

            if(!Object.keys(data.filter).length)
            {
                delete data.filter
            }

            // console.log(data)
        }
    },
    aLengthMenu: [
        [25, 50, 100, 200],
        [25, 50, 100, 200]
    ],
})

window.reportPayment = $('.datatable-report-payment').DataTable({
    // stateSave:true,
    pagingType: 'full_numbers_no_ellipses',
    processing: true,
    search: {
        return: true
    },
    serverSide: true,
    ajax: {
        url: location.href,
        data: function(data){
            // Read values
            var startDate = $('input[name=start_date]').val()
            var endDate = $('input[name=end_date]').val()
            var payment_type = $('select[name=payment_type]').val()
            var payment_method = $('select[name=payment_method]').val()
            var bank = $('select[name=bank]').val()
            var status = $('select[name=status]').val()

            // Append to data
            data.searchByDate = {
                startDate,
                endDate
            }

            data.filter = {}
            if(payment_type)
            {
                data.filter.payment_type = payment_type
            }
            
            if(payment_method)
            {
                data.filter.payment_method = payment_method
            }
            
            if(bank)
            {
                data.filter.bank_id = bank
            }
            
            if(status)
            {
                data.filter.status = status
            }

            if(!Object.keys(data.filter).length)
            {
                delete data.filter
            }

            // console.log(data)
        }
    },
    aLengthMenu: [
        [25, 50, 100, 200],
        [25, 50, 100, 200]
    ],
})

window.reportNoPaidOff = $('.datatable-report-no-paid-off').DataTable({
    // stateSave:true,
    pagingType: 'full_numbers_no_ellipses',
    processing: true,
    search: {
        return: true
    },
    serverSide: true,
    ajax: {
        url: location.href,
        data: function(data){
            // Read values
            var startDate = $('input[name=start_date]').val()
            var order_type = $('select[name=order_type]').val()
            var customer = $('select[name=customer]').val()
            var employee = $('select[name=employee]').val()
            var category = $('select[name=category]').val()

            // Append to data
            data.searchByDate = {
                startDate
            }

            data.filter = {}
            if(order_type)
            {
                data.filter.order_type_id = order_type
            }
            
            if(customer)
            {
                data.filter.customer_id = customer
            }
            
            if(employee)
            {
                data.filter.employee_id = employee
            }
            
            if(category)
            {
                data.filter.category = category
            }
            
            if(!Object.keys(data.filter).length)
            {
                delete data.filter
            }

            // console.log(data)
        }
    },
    aLengthMenu: [
        [25, 50, 100, 200],
        [25, 50, 100, 200]
    ],
})

window.reportOutstandingOrder = $('.datatable-report-outstanding-order').DataTable({
    // stateSave:true,
    pagingType: 'full_numbers_no_ellipses',
    processing: true,
    search: {
        return: true
    },
    serverSide: true,
    ajax: {
        url: location.href,
        data: function(data){
            // Read values
            var startDate = $('input[name=start_date]').val()
            var endDate = $('input[name=end_date]').val()
            var order_type = $('select[name=order_type]').val()
            var customer = $('select[name=customer]').val()
            var employee = $('select[name=employee]').val()
            var category = $('select[name=category]').val()
            var status = $('select[name=status]').val()

            // Append to data
            data.searchByDate = {
                startDate,
                endDate
            }

            data.filter = {}
            if(order_type)
            {
                data.filter.order_type_id = order_type
            }
            
            if(customer)
            {
                data.filter.customer_id = customer
            }
            
            if(employee)
            {
                data.filter.employee_id = employee
            }
            
            if(category)
            {
                data.filter.category = category
            }
            
            if(status)
            {
                data.filter.status_order = status
            }

            if(!Object.keys(data.filter).length)
            {
                delete data.filter
            }

            // console.log(data)
        }
    },
    aLengthMenu: [
        [25, 50, 100, 200],
        [25, 50, 100, 200]
    ],
})

window.reportOrder = $('.datatable-report-order').DataTable({
    // stateSave:true,
    pagingType: 'full_numbers_no_ellipses',
    processing: true,
    search: {
        return: true
    },
    serverSide: true,
    ajax: {
        url: location.href,
        data: function(data){
            // Read values
            var startDate = $('input[name=start_date]').val()
            var endDate = $('input[name=end_date]').val()
            var order_type = $('select[name=order_type]').val()
            var customer = $('select[name=customer]').val()
            var employee = $('select[name=employee]').val()
            var category = $('select[name=category]').val()
            var status = $('select[name=status]').val()

            // Append to data
            data.searchByDate = {
                startDate,
                endDate
            }

            data.filter = {}
            if(order_type)
            {
                data.filter.order_type_id = order_type
            }
            
            if(customer)
            {
                data.filter.customer_id = customer
            }
            
            if(employee)
            {
                data.filter.employee_id = employee
            }
            
            if(category)
            {
                data.filter.category = category
            }
            
            if(status)
            {
                data.filter.status = status
            }

            if(!Object.keys(data.filter).length)
            {
                delete data.filter
            }

            // console.log(data)
        }
    },
    aLengthMenu: [
        [25, 50, 100, 200],
        [25, 50, 100, 200]
    ],
})

window.reportDetailOrder = $('.datatable-report-detail-order').DataTable({
    // stateSave:true,
    pagingType: 'full_numbers_no_ellipses',
    processing: true,
    search: {
        return: true
    },
    serverSide: true,
    ajax: {
        url: location.href,
        data: function(data){
            // Read values
            var startDate = $('input[name=start_date]').val()
            var endDate = $('input[name=end_date]').val()
            var size = $('select[name=size]').val()
            var product = $('select[name=product]').val()
            var category = $('select[name=category]').val()
            var status = $('select[name=status]').val()

            // Append to data
            data.searchByDate = {
                startDate,
                endDate
            }

            data.filter = {}
            if(size)
            {
                data.filter.size = size
            }
            
            if(product)
            {
                data.filter.product_id = product
            }
            
            if(category)
            {
                data.filter.category = category
            }
            
            if(status)
            {
                data.filter.status = status
            }

            if(!Object.keys(data.filter).length)
            {
                delete data.filter
            }

            // console.log(data)
        }
    },
    aLengthMenu: [
        [25, 50, 100, 200],
        [25, 50, 100, 200]
    ],
})

function downloadReportTransaction()
{
    var data = {}
    var startDate = $('input[name=start_date]').val()
    var endDate = $('input[name=end_date]').val()
    var order_type = $('select[name=order_type]').val()
    var customer = $('select[name=customer]').val()
    var employee = $('select[name=employee]').val()
    var category = $('select[name=category]').val()
    var status = $('select[name=status]').val()

    // Append to data
    data.searchByDate = {
        startDate,
        endDate
    }

    data.filter = {}
    if(order_type)
    {
        data.filter.order_type = order_type
    }
    
    if(customer)
    {
        data.filter.customer = customer
    }
    
    if(employee)
    {
        data.filter.employee = employee
    }
    
    if(category)
    {
        data.filter.category = category
    }
    
    if(status)
    {
        data.filter.status = status
    }

    if(!Object.keys(data.filter).length)
    {
        delete data.filter
    }
    
    var search = window.reportTransaction.search()
    if(search)
    {
        data.search = search
    }
    const url = Qs.stringify(data, { encode: false })

    window.location = "/kaosful/reports/transaction/download?"+url
}

function downloadReportFulfillment()
{
    var data = {}
    var startDate = $('input[name=start_date]').val()
    var endDate = $('input[name=end_date]').val()
    var order_type = $('select[name=order_type]').val()
    var customer = $('select[name=customer]').val()
    var size = $('select[name=size]').val()
    var category = $('select[name=category]').val()
    var fulfillment = $('select[name=fulfillment]').val()

    // Append to data
    data.searchByDate = {
        startDate,
        endDate
    }

    data.filter = {}
    if(order_type)
    {
        data.filter.order_type_id = order_type
    }
    
    if(customer)
    {
        data.filter.customer_id = customer
    }
    
    if(size)
    {
        data.filter.size = size
    }
    
    if(category)
    {
        data.filter.category = category
    }
    
    if(fulfillment)
    {
        data.filter.fulfillment_status = fulfillment
    }

    if(!Object.keys(data.filter).length)
    {
        delete data.filter
    }
    
    var search = window.reportTransaction.search()
    if(search)
    {
        data.search = search
    }
    const url = Qs.stringify(data, { encode: false })

    window.location = "/kaosful/reports/fulfillment-order/download?"+url
}

function downloadReportPayment()
{
    var data = {}
    var startDate = $('input[name=start_date]').val()
    var endDate = $('input[name=end_date]').val()
    var payment_type = $('select[name=payment_type]').val()
    var payment_method = $('select[name=payment_method]').val()
    var bank = $('select[name=bank]').val()
    var status = $('select[name=status]').val()

    // Append to data
    data.searchByDate = {
        startDate,
        endDate
    }

    data.filter = {}
    if(payment_type)
    {
        data.filter.payment_type = payment_type
    }
    
    if(payment_method)
    {
        data.filter.payment_method = payment_method
    }
    
    if(bank)
    {
        data.filter.bank_id = bank
    }
    
    if(status)
    {
        data.filter.status = status
    }

    if(!Object.keys(data.filter).length)
    {
        delete data.filter
    }
    
    var search = window.reportTransaction.search()
    if(search)
    {
        data.search = search
    }
    const url = Qs.stringify(data, { encode: false })

    window.location = "/kaosful/reports/payment-order/download?"+url
}

function downloadReportNoPaidOff()
{
    var data = {}
    var startDate = $('input[name=start_date]').val()
    var order_type = $('select[name=order_type]').val()
    var customer = $('select[name=customer]').val()
    var employee = $('select[name=employee]').val()
    var category = $('select[name=category]').val()

    // Append to data
    data.searchByDate = {
        startDate
    }

    data.filter = {}
    if(order_type)
    {
        data.filter.order_type = order_type
    }
    
    if(customer)
    {
        data.filter.customer = customer
    }
    
    if(employee)
    {
        data.filter.employee = employee
    }
    
    if(category)
    {
        data.filter.category = category
    }

    if(!Object.keys(data.filter).length)
    {
        delete data.filter
    }
    
    var search = window.reportTransaction.search()
    if(search)
    {
        data.search = search
    }
    const url = Qs.stringify(data, { encode: false })

    window.location = "/kaosful/reports/no-paid-off-order/download?"+url
}

function downloadReportOutstandingOrder()
{
    var data = {}
    var startDate = $('input[name=start_date]').val()
    var endDate = $('input[name=end_date]').val()
    var order_type = $('select[name=order_type]').val()
    var customer = $('select[name=customer]').val()
    var employee = $('select[name=employee]').val()
    var category = $('select[name=category]').val()
    var status = $('select[name=status]').val()

    // Append to data
    data.searchByDate = {
        startDate,
        endDate
    }

    data.filter = {}
    if(order_type)
    {
        data.filter.order_type = order_type
    }
    
    if(customer)
    {
        data.filter.customer = customer
    }
    
    if(employee)
    {
        data.filter.employee = employee
    }
    
    if(category)
    {
        data.filter.category = category
    }
    
    if(status)
    {
        data.filter.status_order = status
    }

    if(!Object.keys(data.filter).length)
    {
        delete data.filter
    }
    
    var search = window.reportTransaction.search()
    if(search)
    {
        data.search = search
    }
    const url = Qs.stringify(data, { encode: false })

    window.location = "/kaosful/reports/outstanding-order/download?"+url
}

function downloadReportOrder()
{
    var data = {}
    var startDate = $('input[name=start_date]').val()
    var endDate = $('input[name=end_date]').val()
    var order_type = $('select[name=order_type]').val()
    var customer = $('select[name=customer]').val()
    var employee = $('select[name=employee]').val()
    var category = $('select[name=category]').val()
    var status = $('select[name=status]').val()

    // Append to data
    data.searchByDate = {
        startDate,
        endDate
    }

    data.filter = {}
    if(order_type)
    {
        data.filter.order_type_id = order_type
    }
    
    if(customer)
    {
        data.filter.customer_id = customer
    }
    
    if(employee)
    {
        data.filter.employee_id = employee
    }
    
    if(category)
    {
        data.filter.category = category
    }
    
    if(status)
    {
        data.filter.status = status
    }

    if(!Object.keys(data.filter).length)
    {
        delete data.filter
    }
    
    var search = window.reportTransaction.search()
    if(search)
    {
        data.search = search
    }
    const url = Qs.stringify(data, { encode: false })

    window.location = "/kaosful/reports/order/download?"+url
}

function downloadReportDetailOrder()
{
    var data = {}
    var startDate = $('input[name=start_date]').val()
    var endDate = $('input[name=end_date]').val()
    var size = $('select[name=size]').val()
    var product = $('select[name=product]').val()
    var category = $('select[name=category]').val()
    var status = $('select[name=status]').val()

    // Append to data
    data.searchByDate = {
        startDate,
        endDate
    }

    data.filter = {}
    if(size)
    {
        data.filter.size = size
    }
    
    if(product)
    {
        data.filter.product_id = product
    }
    
    if(category)
    {
        data.filter.category = category
    }
    
    if(status)
    {
        data.filter.status = status
    }

    if(!Object.keys(data.filter).length)
    {
        delete data.filter
    }
    
    var search = window.reportTransaction.search()
    if(search)
    {
        data.search = search
    }
    const url = Qs.stringify(data, { encode: false })

    window.location = "/kaosful/reports/detail-order/download?"+url
}

try {
    $('select').select2()
} catch (error) {
    
}