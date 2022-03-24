var calculate, formatPrice, calculateWithNewAdded,
    addRow, setHandlers, removeHandlers, updateHandlers,
    getData, parseGet;

$(document).on('ready', function () {
    var rows, total;

    setHandlers();
    rows = calculate();
    total = $('.total');

    total.html('Total: $' + formatPrice(rows.total));
});

setHandlers = function(){
    var inputs, quantity, product, price, rowTotal, cartSelect;

    inputs = $('#table_background').find('input');
    cartSelect = $( ".cart-select" );

    inputs.on('keydown', function (e) {
        if(!$(e.currentTarget).hasClass('product')){
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||//, 190
                (e.keyCode == 65 && e.ctrlKey === true) ||
                (e.keyCode == 67 && e.ctrlKey === true) ||
                (e.keyCode == 88 && e.ctrlKey === true) ||
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                return;
            }

            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105 && e.keyCode !== 189 && e.keyCode !== 190)) {
                e.preventDefault();
            }
        }
    });

    inputs.on('input', function(e){
        e.preventDefault ? e.preventDefault() : (e.returnValue=false);
        var resultPrise, parent;

        parent = $(e.currentTarget).parent().parent();
        quantity = parent.find('.quantity');
        price = parent.find('.price');
        rowTotal = parent.find('.row-total');

        if(!$(e.currentTarget).hasClass('product')){
            resultPrise = quantity.val() * price.val();

            if(resultPrise !== 0){
                if(rowTotal.length === 0){
                    rowTotal = parent.find('.row-total');
                }

                rowTotal.html('$' + formatPrice(resultPrise));

                if(parent.find('.del-cell').html() === ''){
                    updateHandlers();
                }

            }else{
                rowTotal.html('$0.00');

                if(parent.find('.del-cell').html() !== ''){
                    updateHandlers();
                }
            }

            calculateWithNewAdded();
        }
    });

    $('.delete').on('click', function(e){
        e.preventDefault ? e.preventDefault() : (e.returnValue=false);
        var el, last ;

        last = ($('#table_background').find('tbody').find('tr').length - 1 === 1);
        el = $(e.currentTarget).parent().parent();

        if(!el.hasClass('table_bottum') && !last && el.attr('class').indexOf('_custom_') !== -1){
            el.remove();
        }else{
            el.find('.quantity').val(null).trigger("change");
            el.find('.quantity').html('');
            el.find('.row-total').html('$0.00');
        }

        updateHandlers();
        calculateWithNewAdded();
    });

    $('#submit_payment').on('click', function(e){
        e.preventDefault ? e.preventDefault() : (e.returnValue=false);
        var data, invite, action, urlMainPart;

        urlMainPart = location.origin + '/wp-admin/users.php?page=custom-invoice';
        data = getData();
        action = parseGet('action');
        invite = (action === 'invite');

        jQuery.ajax({
            type: 'POST',
            url: location.origin + '/wp-admin/admin-ajax.php',
            data: {
                action: 'storeDraft',
                draft_id: (action === 'Not found' || invite) ? 'new' : parseGet('invoice'),
                user_id: (action === 'Not found' || invite) ? parseGet('user') : parseGet('from_user'),
                total: data.total,
                data: JSON.stringify(data)
            },
            success: function(response){
                var res = JSON.parse(response);

                jQuery.ajax({
                    type: 'POST',
                    url: location.origin + '/wp-admin/admin-ajax.php',
                    data: {
                        action: 'submitPayment',
                        draft_id: res.id,
                        user_id: res.user_id
                    },
                    success: function(response){
                        var res = JSON.parse(response);
                        window.location.replace(urlMainPart + '&action=view&from_user='+ res.user_id +'&invoice=' + res.id);
                    }
                });
            }
        });
    });

    $('#save_draft').on('click', function(e){
        e.preventDefault ? e.preventDefault() : (e.returnValue=false);
        var data, invite, action, urlMainPart;

        data = getData();
        action = parseGet('action');
        invite = (action === 'invite');
        urlMainPart = location.origin + '/wp-admin/users.php?page=custom-invoice';

        if(data.total !== parseInt($('#hiddden-total').val())){
            jQuery.ajax({
                type: 'POST',
                url: location.origin + '/wp-admin/admin-ajax.php',
                data: {
                    action: 'storeDraft',
                    draft_id: (action === 'Not found' || invite) ? 'new' : parseGet('invoice'),
                    user_id: (action === 'Not found' || invite) ? parseGet('user') : parseGet('from_user'),
                    total: data.total,
                    data: JSON.stringify(data)
                },
                success: function(){
                    window.location.replace(urlMainPart + '&user=' + ((action === 'Not found' || invite) ? parseGet('user') : parseGet('from_user')));
                }
            });
        }else{
            if(data.total !== 0){
                window.location.replace(urlMainPart + '&user=' + ((action === 'Not found' || invite) ? parseGet('user') : parseGet('from_user')));
            }
        }
    });

    $('#refund_draft').on('click', function(e){
        e.preventDefault ? e.preventDefault() : (e.returnValue=false);

        jQuery.ajax({
            type: 'POST',
            url: location.origin + '/wp-admin/admin-ajax.php',
            data: {
                action: 'refundDraft',
                draft_id: parseGet('invoice'),
                user_id: parseGet('from_user')
            },
            success: function(){
                location.reload();
            }
        });
    });

    $('.add-row').on('click', function(e){
        e.preventDefault ? e.preventDefault() : (e.returnValue=false);
        addRow();
    });

    $('.add_btn').on('click', function(e){
        e.preventDefault ? e.preventDefault() : (e.returnValue=false);
        $("#fade").css("display", "block");
        $(".add_payment_popup").css("display", "block");
    });

    $( "#fade" ).on('click', function(e){
        e.preventDefault ? e.preventDefault() : (e.returnValue=false);
        $("#fade").css("display", "none");
        $(".add_payment_popup").css("display", "none");
    });

    $( ".add_cancel_btn" ).on('click', function(e){
        e.preventDefault ? e.preventDefault() : (e.returnValue=false);
        $("#fade").css("display", "none");
        $(".add_payment_popup").css("display", "none");
    });

    cartSelect.on('click', function(e){
        var target, parent;

        target = $(e.currentTarget);
        parent = target.parent().parent();

        if(target.prop('checked')){
            $.each(cartSelect, function( index, value) {
                var _value, parent;

                _value = $(value);
                parent = _value.parent().parent();

                if(parent.hasClass('active')){
                    parent.removeClass('active');
                    _value.attr("checked", false);
                }
            });
            parent.addClass('active');
        }else{
            parent.removeClass('active');
        }

    });
};

updateHandlers = function(){
    removeHandlers();
    setHandlers();
};

removeHandlers = function(){
    var inputs;

    inputs = $('#table_background').find('input');

    $('.delete').off( "click" );
    $('.draft_checkout').off( "click" );
    $('#submit_payment').off( "click" );
    $('#save_draft').off( "click" );
    $('#refund_draft').off( "click" );
    $('.cart-select').off( "click" );
    $('.add-row').off( "click" );
    /*popup*/
    $('.add_btn').off( "click" );
    $( "#fade" ).off( "click" );
    $( ".add_cancel_btn" ).off( "click" );
    /*popup*/
    inputs.off( "keydown" );
    inputs.off( "input" );
};

calculate = function(){
    var rows, tmpRows, totalUnit, parseUnit;

    tmpRows = $('#table_background').find('tbody').find('tr');
    rows = {};

    rows.all = [];
    rows.total = 0;

    $.each(tmpRows, function( index, value) {
        if(!$(value).hasClass('table_bottum')){
            totalUnit = $(value).find('td').eq(3).html().trim();
            if(parseInt(totalUnit) !== 0){
                totalUnit = totalUnit.substr(1);
                totalUnit = parseFloat(totalUnit.replace(/\,/g,''));
            }else{
                parseUnit = 0;
            }

            rows.all.push(totalUnit);
            rows.total += totalUnit;
        }
    });

    return rows;
};

calculateWithNewAdded = function(){
    var rows, total;

    rows = calculate();
    total = $('.total');

    total.html('Total: $' + formatPrice(rows.total));
};

addRow = function(){
    var row, table_bottum;

    row =
        '<tr class="row_custom_">' +
            '<td>' +
                '<input name="quantity" type="number" class="quantity" min="0" value=""/>' +
            '</td>' +
            '<td>' +
                '<input name="product" type="text" class="product"/>' +
            '</td>' +
            '<td class="td-rell">' +
                '<span class="visible-lg">$</span>' +
                '<input name="price" type="text" class="price"/>' +
            '</td>' +
            '<td class="row-total">' +
                '$0.00' +
            '</td>' +
            '<td class="del-cell">' +
                '<span class="delete preview button">Delete</span>' +
            '</td>' +
        '</tr>';

    table_bottum = $('.table_bottum');

    $(row).insertBefore(table_bottum);
    updateHandlers();
};

formatPrice = function (number){
    var decimal, separator, decpoint, formatString, parseNum, fixedNum, repNum, exp;

    decimal=2;
    separator=',';
    decpoint = '.';
    formatString = '.00';
    parseNum = parseFloat(number);
    exp = Math.pow(10,decimal);
    parseNum = Math.round(parseNum*exp)/exp;
    fixedNum = Number(parseNum).toFixed(decimal).toString().split('.');
    repNum=fixedNum[0].replace(/(\d{1,3}(?=(\d{3})+(?:\.\d|\b)))/g,"\$1"+separator);
    parseNum=(fixedNum[1]?repNum+ decpoint +fixedNum[1]:repNum);

    return (parseNum ^ 0) === parseNum ? parseNum + formatString : parseNum;
};

getData = function(){
    var rows, row, obj, counter, obj_child;

    rows = $('#table_background').find('tr:not(.table_top):not(.table_bottum)');
    obj = {};
    obj.rows = {};
    counter = 1;

    $.each(rows, function( index, value) {
        row = $(value).find('td');

        obj_child = {
            'quantity' : row.eq(0).find('input').val(),
            'product' : (row.eq(1).find('span').length !== 0) ? row.eq(1).find('.name-el').html() : row.eq(1).find('input').val(),
            'price' : row.eq(2).find('input').val()
        };

        if(row.eq(1).find('span').length !== 0){
            obj.rows[row.eq(1).find('span')[0].className] = obj_child;
        }else{
            obj.rows['custom_' + counter] = obj_child;
            counter++;
        }

        obj['total'] = calculate().total * 100;
    });

    return obj;
};

parseGet = function(val) {
    var result, tmp, items;

    result = "Not found";
    tmp = [];
    items = location.search.substr(1).split("&");

    for (var index = 0; index < items.length; index++) {
        tmp = items[index].split("=");
        if (tmp[0] === val) result = decodeURIComponent(tmp[1]);
    }
    return result;
};