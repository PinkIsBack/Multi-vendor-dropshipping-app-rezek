$(document).ready(function () {
    // Bank  Amount Logic
    $('body').on('change', '#exchange-rates', function(){
        var bank_id = $('input[name=bank]:checked', '#exchange-rates').val();

        $.ajax({
            url: `/app/wallet-bank-details/${bank_id}`,
            type: 'GET',
            success(response) {
                $('.js-selected-bank').empty().append(response);
            }
        });
    });

    $('body').on('keyup','#js-exchange-amount', function() {
        var rate = $('#js-selected-exhange-rate').val();
        var original_amount = $(this).val();

        if(rate == undefined || rate == '')
            rate = 1;

        $('#js-usd-amount').val((rate * original_amount).toFixed(2));
    });

    // Bulk Import Logic

    $('.check-bulk-products-all').change(function () {
        if($(this).is(':checked')){
            $('.check-bulk-products').each(function(index, selector){
                var deleted = $(selector).data('deleted');
                if(!deleted) {
                    $(selector).prop('checked','checked');
                    $('.bulk-import-div').show();
                    unset_bulk_product_array()
                    set_bulk_product_array();
                }
            });

        }
        else{
            $('.check-bulk-products').prop('checked','');
            $('.bulk-import-div').hide();
            unset_bulk_product_array()
            set_bulk_product_array();
        }



    });

    $('.check-bulk-products').change(function () {
        if($(this).is(':checked')){
            var checkbox = $(this);
            var deleted = $(this).data('deleted');

            if(deleted) {
                if (confirm('You have deleted this same product from your store before, are you sure to relist this product again')) {
                    $('.bulk-import-div').show();
                    unset_bulk_product_array();
                    set_bulk_product_array();
                }
                else {
                    checkbox.prop('checked','');
                    unset_bulk_product_array();
                    set_bulk_product_array();
                    if($('.check-bulk-products:checked').length === 0){
                        $('.bulk-import-div').hide();
                    }
                }
            }
            else {
                $('.bulk-import-div').show();
                unset_bulk_product_array();
                set_bulk_product_array();
            }

        }
        else{
            unset_bulk_product_array();
            set_bulk_product_array();
            if($('.check-bulk-products:checked').length === 0){
                $('.bulk-import-div').hide();
            }

        }

    });

    $('.js-main-import-btn').click(function () {

        var btn = $(this);
        var deleted = $(this).data('deleted');

        if(deleted) {
            if (confirm('You have deleted this same product from your store before, are you sure to relist this product again')) {
                window.location = btn.data('href');
            }
            else {

            }
        }
        else {
            window.location = btn.data('href');
        }
    });

    function set_bulk_product_array() {
        var values = [];
        $('.check-bulk-products:checked').each(function () {
            values.push($(this).val());
        });

        $('#bulk-import-products').find('input:hidden[name=products]').val(values);

    }
    function unset_bulk_product_array() {
        $('#bulk-import-products').find('input:hidden[name=products]').val('');

    }
    $('.bulk-import-btn').click(function () {
        $('#bulk-import-products').submit();
    });


    // Dynamic Import List Product Price Updation (non-variant product)
    $('body').on('change', '.js-retailer-product-price-update', function() {
        let url = $(this).data('route');
        let price = $(this).val();
        let id = $(this).data('product-id');

        $.ajax({
            url: url,
            type: 'GET',
            data: {
                price : price
            },
            success:function (response) {
                if(response.status == 'success')
                    alertify.success('Product Price Updated Successfully!');
            }
        });
    });

    // Dynamic Import List Product Price Updation (variant product)
    $('body').on('change', '.js-retailer-product-variant-price-update', function() {
        let url = $(this).data('route');
        let price = $(this).val();
        let variant_id = $(this).data('variant-id');

        $.ajax({
            url: url,
            type: 'GET',
            data: {
                price : price,
                variant_id : variant_id
            },
            success:function (response) {
                if(response.status == 'success')
                    alertify.success('Product Price Updated Successfully!');
            }
        });
    });

    // Text Editor Settings without image selector
    $('.js-summernote').summernote({
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'video']],
            ['height', ['height']]
        ]
    });

    /*Dropship request Create Shipping Mark Popup Code*/
    var dropship_url = new URL(window.location.href);
    var param = dropship_url.searchParams.get("sm");
    if(param !== null){
        $('#create-shipping-label-modal').modal('show');
    }


    // Dropship Request Download Shipping Label Pop-up
    var dropship_url = new URL(window.location.href);
    var param = dropship_url.searchParams.get("download");
    if(param !== null){
        $('#download-shipping-label-modal').modal('show');
    }

    // Dropship Request Mark as Shipped Pop-up
    var dropship_url = new URL(window.location.href);
    var param = dropship_url.searchParams.get("shipped");
    if(param !== null){
        $('#mark-shipped-modal').modal('show');
    }

    // Accept Wishlist Button
    $(document).on('click', '.js-accept-wishlist-btn', function() {
        $('#mark-approved-modal').modal('hide');
        $('#mark-approved-modal-for-id').modal('show');
    });


    // Platform Selector on Questionnaire
    $(document).on('change', '#others-checkbox', function() {
        if($(this).is(':checked')){
            $('.js-platform-name').show();
            $('#platform-name').attr('required',true);
        }
        else {
            $('.js-platform-name').hide();
            $('#platform-name').attr('required',false);
        }
    });

    // warehouse selection on order details page
    $('.warehouse-selector').change(function(){
        var data = $(this).val().split(",");
        var id = data[0];
        var product = data[1];
        var order = data[2];
        var line_item = data[3];


        $.ajax({
            url: `/get-warehouse/shipping-price`,
            type: 'GET',
            data: {
                product: product,
                id: id,
                order: order,
                line_item: line_item,
            },
            success:function (response) {

                $('.js-warehouse-shipping').empty().append(response);
            }
        });

    });

    // Grapgh checkbox dashboard
    $('body').on('change','#graph_checkbox',function () {
        if($(this).is(':checked')){
            $('#canvas-graph-two-store').show();
            $('#canvas-graph-one-store').hide();
        }
        else{
            $('#canvas-graph-two-store').hide();
            $('#canvas-graph-one-store').show();
        }
    });

    // Inventory Management Status Checkbox
    $(document).on('change','.inventory-checkbox',function () {
        if($(this).is(':checked')){
            $('.warehouses').show();
        }
        else{
            $('.warehouses').hide();
        }

    });


    $('.custom-order-btn').click(function () {
        console.log(324);
        $(this).prop('disabled', true);
    });

    // Wallet Setting Switch
    $('body').on('change','.wallet-switch',function () {
        var status = '';
        if($(this).is(':checked')){
            status = 1;
            $('.status-text').text('Enabled')
        }
        else{
            status = 0;
            $('.status-text').text('Disabled')
        }
        $.ajax({
            url: $(this).data('route'),
            type: 'post',
            data:{
                _token: $(this).data('csrf'),
                status : status
            }
        })
    });

    // Shipping Setting Switch
    $('body').on('change','.shipping-switch',function () {
        console.log(34);
        var status = '';
        if($(this).is(':checked')){
            status = 1;
            $('.shipping-status-text').text('Enabled')
        }
        else{
            status = 0;
            $('.shipping-status-text').text('Disabled')
        }
        $.ajax({
            url: $(this).data('route'),
            type: 'post',
            data:{
                _token: $(this).data('csrf'),
                status : status
            }
        })
    });



    /*BULK ORDER PAY*/
    $('.check-order-all').change(function () {
        unset_bulk_array();
        set_bulk_array();

        if($(this).is(':checked')){
            $('.bulk-div').show();
        }
        else{
            $('.bulk-div').hide();

        }

    });

    $('.check-order').change(function () {
        if($(this).is(':checked')){
            $('.bulk-div').show();
            unset_bulk_array();
            set_bulk_array();
        }
        else{
            unset_bulk_array();
            set_bulk_array();
            if($('.check-order:checked').length === 0){
                $('.bulk-div').hide();
            }

        }

    });
    function set_bulk_array() {
        var values = [];
        $('.check-order:checked').each(function () {
            values.push($(this).val());
        });
        $('#bulk-payment').find('input:hidden[name=orders]').val(values);

    }
    function unset_bulk_array() {
        $('#bulk-payment').find('input:hidden[name=orders]').val('');

    }

    $('.bulk-wallet-btn').click(function () {
        $('#bulk-payment').submit();
    });


    /*Popup Code*/

    var url_string = window.location.href;
    var url = new URL(url_string);
    var c = url.searchParams.get("ftl");
    if(c !== null){
        $.ajax({
            url:$('#questionnaire_modal').data('route'),
            type: 'GET',
            data:{
                shop : $('#questionnaire_modal').data('shop'),
            },
            success:function (response) {
                if(response.popup === 'yes'){
                    $('#questionnaire_modal').modal();
                }
            }

        });
    }


    $('body').on('click','.upload-manager-profile',function () {
        $('.manager-profile').trigger('click');
    });

    $('body').on('change','.manager-profile',function () {
        readURL(this);
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.image-drop').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }

    }


    $('body').on('click','.authenticate_user',function () {
        $('#authenticate_user_form').find('input[type=submit]').trigger('click');
    });
    $('body').on('submit','#authenticate_user_form',function (e) {
        e.preventDefault();
        $('.pre-loader').css('display','flex');
        var form  = $(this);
        $.ajax({
            url : form.attr('action'),
            type : 'post',
            data:form.serialize(),
            success:function (response) {
                $('.pre-loader').css('display','none');
                alertify.set('notifier','position', 'top-right');
                if(response.authenticate === true){
                    $('#associate_modal').modal('hide');
                    Swal.fire({
                        title: ' Are you sure?',
                        html:'<p>You want to Associate this store with this email ('+form.find('#user-email').val()+')</p>',
                        icon: 'primary',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, Associate it!'
                    }).then((result) => {
                        if (result.value) {
                            $('.pre-loader').css('display','flex');
                            $.ajax({
                                url : form.data('route'),
                                type:'post',
                                data:{
                                    _token :form.data('token'),
                                    store:form.data('store'),
                                    email :form.find('#user-email').val(),
                                    name: form.find('#user-name').val(),
                                    password: form.find('#user-password').val(),
                                },
                                success:function (response) {
                                    $('.pre-loader').css('display','none');
                                    if(response.status === 'error'){
                                        alertify.error('Assigning Process Failed');
                                    }
                                    else{
                                        if(response.status === 'already_assigned'){
                                            alertify.message('Store ALready Assigned To Given Credentials');
                                        }
                                        else{
                                            Swal.fire(
                                                'Associated!',
                                                'Your store associated with given authentic credentials',
                                                'success'
                                            );
                                        }
                                        location.reload();
                                    }

                                }
                            })
                        }
                        else{
                            location.reload();
                        }
                    });
                }
                else{
                    alertify.error('Credentials Not Correct');
                }
            },
        });
    });

    $('body').on('click','.see-more-block',function () {
        $('.after12').show();
        $(this).hide();
    });
    $('body').on('click','.see-less-block',function () {
        $('.after12').hide();
        $('.see-more-block').show();

    });

    $('.js-tags-input').tagsInput({
        height: '36px',
        width: '100%',
        defaultText: 'Add tag',
        removeWithBackspace: true,
        delimiter: [',']
    });
    /*Retailer Module - Images Update JS*/
    $('body').on('click','.delete-file',function () {
        var $this = $(this);
        var file = $(this).data("file");
        $.ajax({
            url: $(this).data('route'),
            type: 'post',
            data: {
                _token: $(this).data('token'),
                request_type: $(this).data('type'),
                file: file,
            },
            success:function (data) {
                if(data.success === 'ok'){
                    $this.parents('.preview-image').remove();
                }
            }
        });
    });
    $('body').on('click','.img-avatar-variant',function () {
        var target = $(this).data('form');
        $(target).find('input[type=file]').trigger('click');
    });
    $('.varaint_file_input').change(function () {
        $(this).parents('form').submit();
    });

    /* Admin Module - Images UPLOAD JS */
    $('body').on('click','.dropzone',function () {
        $(this).next().trigger('click');
    });
    $('body').on('change','.images-upload',function (e) {
        var $this = $(this);
        var files = e.target.files;
        var filesArr = Array.prototype.slice.call(files);
        filesArr.forEach(function (f) {
            //$this.parent().find('.preview-drop').empty();
            var reader = new FileReader();
            reader.onload = function (e) {
                $this.parent().find('.preview-drop').append(' <div class="col-lg-4 preview-image animated fadeIn">\n' +
                    '            <div class="img-fluid options-item">\n' +
                    '                <img class="img-fluid options-item" src="'+e.target.result+'" alt="">\n' +
                    '            </div>\n' +
                    '        </div>');

            };
            reader.readAsDataURL(f);
        });
    });
/*
    $('body').on('submit','.product-images-form',function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url : $(this).attr('action'),
            type : $(this).attr('method'),
            data : formData,
            cache:false,
            contentType: false,
            processData: false,
        });
    });
*/
    /*Ajax Forms Save*/
    /*Admin Module - Update Product  Save JS*/

    $('.btn_save_retailer_product').click(function () {
        var forms_div =  $(this).data('tabs');
        console.log($(forms_div).find('form').length);
        if($(forms_div).find('form').length > 0){
            let forms = [];
            $(forms_div).find('form').each(function () {
                if($(this).hasClass('product-images-form')){
                    $(this).submit();
                }
                else{
                    forms.push({
                        'data' : $(this).serialize(),
                        'url' : $(this).attr('action'),
                        'method' : $(this).attr('method'),
                    });
                }

            });
            ajaxCall(forms);
        }
    });

    $('.btn_save_my_product').click(function () {
        $('.pre-loader').css('display','flex');
        var forms_div = '.my_product_form_div';
        console.log($(forms_div).find('form').length);
        if($(forms_div).find('form').length > 0){
            let forms = [];
            $(forms_div).find('form').each(function () {
                if($(this).hasClass('product-images-form')){
                    $(this).submit();
                }
                else{
                    forms.push({
                        'data' : $(this).serialize(),
                        'url' : $(this).attr('action'),
                        'method' : $(this).attr('method'),
                    });
                }

            });
            ajaxCall(forms);
        }
    });

    /*Stack ajax*/
    function ajaxCall(toAdd) {
        if (toAdd.length) {
            var request = toAdd.shift();
            var data = request.data;
            var url = request.url;
            var type = request.method;

            $.ajax({
                url: url,
                type:type,
                data: data,
                success: function(response) {
                    ajaxCall(toAdd);
                },
                error:function () {
                    ajaxCall(toAdd);
                }
            });

        } else {
            Swal.fire(
                'Updated!',
                'Your Product has been Updated Successfully',
                'success',
                '#DD6B55',
            );
            // setTimeout(function () {
            //     window.location.reload();
            // },1000)

        }
    }

    $('body').on('change','.select_all_checkbox',function () {
        if($(this).is(':checked')){
            $('.select_one_checkbox').prop('checked','checked');
            onSelectAllCommon();
        }
        else{
            $('.select_one_checkbox').prop('checked','');
            display($('.product-count'),true);
            display($('.selected-product-count'),false);
            display($('.checkbox_selection_options'),false);
        }
    });

    $('body').on('change','.select_one_checkbox',function () {
        if ($(this).is(':checked')) {
            $('.select_all_checkbox').prop('checked','checked');
            onSelectAllCommon();
        }
        else{
            var checked = $('.select_one_checkbox:checked').length;
            $('.selected-product-count').empty();
            $('.selected-product-count').append('  <p style="font-size: 13px;font-weight: 600">  Selected  '+checked+' products </p>');
            if(checked === 0){
                $('.select_all_checkbox').prop('checked','');
                display($('.product-count'),true);
                display($('.selected-product-count'),false);
                display($('.checkbox_selection_options'),false);
            }
        }
    });

    // $('body').on('click','.import_all_btn ',function () {
    //     $('.pre-loader').css('display','flex');
    //     let forms = [];
    //     if($('.select_one_checkbox:checked').length > 0){
    //
    //         $('.select_one_checkbox:checked').each(function () {
    //             forms.push({
    //                 'url' : $(this).data('url'),
    //                 'method' : $(this).data('method'),
    //             });
    //         });
    //        // StackAjax(forms,'import');
    //     }
    //     else{
    //         $('.pre-loader').css('display','none');
    //         alertify.error('Please Select One Product To Import!');
    //     }
    // });

    $('body').on('click','.import_all_btn ',function () {
        $('.pre-loader').css('display','flex');
        let ids = [];
        if($('.select_one_checkbox:checked').length > 0){

            $('.select_one_checkbox:checked').each(function () {
                ids.push($(this).data('retailer-id'));
            });
            $.ajax({
                url: "/bulk/import/to-shopify-store",
                method: 'GET',
                data: {ids: ids},
                dataType: 'json',
                success: function (data) {

                    alertify.success('Products Will be imported Shortly');
                    location.reload();
                }
            })
            // StackAjax(forms,'import');
        }
        else{
            $('.pre-loader').css('display','none');
            alertify.error('Please Select One Product To Import!');
        }
    });

    $('body').on('click','.remove_all_btn ',function () {
        $('.pre-loader').css('display','flex');
        let forms = [];
        if($('.select_one_checkbox:checked').length > 0){

            $('.select_one_checkbox:checked').each(function () {
                forms.push({
                    'url' : $(this).data('remove_url'),
                    'method' : $(this).data('method'),
                });
            });
            StackAjax(forms,'remove');
        }
        else{
            $('.pre-loader').css('display','none');
            alertify.error('Please Select One Product To Remove!');
        }
    });

    function display($this,$option) {
        if($option){
            $this.addClass('d-inline-block');
            $this.removeClass('d-none');
        }
        else{
            $this.addClass('d-none');
            $this.removeClass('d-inline-block');
        }

    }

    function onSelectAllCommon() {

        display($('.product-count'),false);
        var selected = $('.select_one_checkbox:checked').length;
        $('.selected-product-count').empty();
        $('.selected-product-count').append('  <p style="font-size: 13px;font-weight: 600">  Selected  '+selected+' products </p>');
        display($('.selected-product-count'),true);
        display($('.checkbox_selection_options'),true);
    }
    function StackAjax(toAdd,call) {
        if (toAdd.length) {
            var request = toAdd.shift();
            var url = request.url;
            var type = request.method;

            $.ajax({
                url: url,
                type:type,
                success: function(response) {
                    StackAjax(toAdd,call);
                },
                error:function () {
                    StackAjax(toAdd,call);
                }
            });

        } else {
            $('.pre-loader').css('display', 'none');
            if(call === 'import'){
                Swal.fire(
                    'Imported!',
                    'Your Products Has Been Imported To Your Store Successfully',
                    'success'
                );
            }
            else{
                Swal.fire(
                    'Deleted!',
                    'Your Products Has Been Deleted Successfully',
                    'success'
                );
            }

            setTimeout(function () {
                window.location.reload();
            },1000)

        }
    }
    /*Select Photos From Existing*/
    $('.choose-variant-image').click(function () {
        var current = $(this);
        $.ajax({
            url: '/variant/'+$(this).data('variant')+'/change/image/'+$(this).data('image')+'?type='+$(this).data('type'),
            type: 'GET',
            success:function (response) {
                if(response.message == 'success'){
                    current.removeClass('bg-primary');
                    current.addClass('bg-success');
                    current.text('Updated');
                    alertify.success('Variant image has been updated!');
                    current.parents('.modal').prev()
                        .attr('src', current.prev().attr('src'));
                }
                else{
                    alertify.error('Something went wrong!');
                }
            }
        })

    });

    // $('#paypal_pay_trigger').on('shown.bs.modal', function (e) {
    //     var $this= $('.paypal-pay-button');
    //     var html = '<div class="text-center"> <p>Subtotal: '+ $this.data('subtotal')+' USD<br>WeFullFill Paypal Fee ('+$this.data('percentage')+'%): '+ $this.data('fee')+' USD <br>Total Cost : '+ $this.data('pay')+'</p>  </div><p> A amount of '+ $this.data('pay') +' will be deducted through your Paypal Account</p>';
    //     $('#paypal_pay_trigger').find('.block-content ').html(html);
    // });

    /*Paypal Order Payment Button JS*/
    $('body').on('click','.paypal-pay-button',function () {
        // var button = $(this);
        // $('#paypal_pay_trigger').modal('show');

        // Swal.fire({
        //     title: ' Are you sure?',
        //     html:'<div class="text-center"> <p>Subtotal: '+ $(this).data('subtotal')+' USD<br>WeFullFill Paypal Fee ('+$(this).data('percentage')+'%): '+ $(this).data('fee')+' USD <br>Total Cost : '+ $(this).data('pay')+'</p>  </div><p> A amount of '+ $(this).data('pay') +' will be deducted through your Paypal Account</p>',
        //     icon: 'warning',
        //     showCancelButton: true,
        //     confirmButtonColor: '#3085d6',
        //     cancelButtonColor: '#d33',
        //     confirmButtonText: 'Pay'
        // }).then((result) => {
        //     console.log();
        //     if (result.value) {
        //         Swal.fire(
        //             'Processing!',
        //             'You will be redirected to paypal in seconds!',
        //             'success'
        //         );
        //         window.location.href = button.data('href');
        //     }
        // });
    });


    function PaypalCalc(price){
        paypal.Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: price
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    console.log(details);
                    // Show a success message to the buyer
                    alert('Transaction completed by ' + details.payer.name.given_name + '!');
                });
            }
        }).render('#paypal-button-container');
    }

    /*Wallet Order Payment Button JS*/
    $('body').on('click','.wallet-pay-button',function () {
        var button = $(this);
        Swal.fire({
            title: ' Are you sure?',
            html:'<p> A amount of '+ $(this).data('pay') +' will be deducted through your wallet </p>',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Pay'
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                    'Processing!',
                    'Payment Processing Please Wait!',
                    'success'
                );
                window.location.href = button.data('href')+"?cost_to_pay="+button.data('pay');
            }
        });
    });

    $('body').on('click','.bulk-wallet-pay-button',function () {
        var button = $(this);
        Swal.fire({
            title: ' Are you sure?',
            html:'<p> A amount of '+ $(this).data('pay') +' will be deducted through your wallet </p>',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Pay'
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                    'Processing!',
                    'Payment Processing Please Wait!',
                    'success'
                );
                $('.bulk-payment-form').submit();
                //window.location.href = button.data('href');
            }

            //$('.bulk-payment-form').submit();
            // if (result.value) {
            //     Swal.fire(
            //         'Processing!',
            //         'Payment Processing Please Wait!',
            //         'success'
            //     );
            // }
        });
    });

    $('body').on('click', '.bulk-card-btn', function () {
        console.log($('.bulk-card-form'));
        $('.bulk-card-form').submit();
    });

    // Product Listing page quick shipping calculator
    $('body').on('click','.quick-shipping-btn',function () {
        var button = $(this);
        $.ajax({
            url:$(this).data('route'),
            type: 'GET',
            data:{
                product: $(this).data('product'),
                retailer_product : $(this).data('retailer-product'),
                warehouse_id : $(this).data('warehouse')
            },
            success:function (response) {
                var dropdown = button.next();
                $(dropdown).find('.loader-div').hide();
                $(dropdown).find('.drop-content').empty();
                $(dropdown).find('.drop-content').append(response.html);

            }
        });
    });

    $('body').on('click', '.js-shipping-dropdown', function() {
        return false;
    });

    $('body').on('click', '.js-warehouse-tab-selector', function() {
        let warehouse_id = $(this).data('id');
        let tab = $(this);
        $.ajax({
            url:$(this).data('route'),
            type: 'GET',
            data:{
                product: $(this).data('product'),
                warehouse_id : warehouse_id
            },
            success:function (response) {
                var dropdown = $(tab).closest('.block').find('.tab-pane');
                //$(dropdown).find('.loader-div').hide();
                $(dropdown).empty();
                $(dropdown).append(response.html);

            }
        });
        // $(this).closest('.block').find('.tab-pane').removeClass('active').removeClass('show');
        // $(this).closest('.block').find(`#tab_${id}`).addClass('active').addClass('show');
    });

    $('body').on('click','.js-see-more-countries',function () {
        $('.after-12').show();
        $(this).hide();
    });


    // Import list shipping calculator
    $('body').on('click','.calculate_shipping_btn',function () {
        var button = $(this);
        $.ajax({
            url:$(this).data('route'),
            type: 'GET',
            data:{
                product: $(this).data('product'),
                retailer_product : $(this).data('retailer-product'),
                warehouse_id : $(this).data('warehouse')
            },
            success:function (response) {
                var modal = button.data('target');
                $(modal).find('.loader-div').hide();
                $(modal).find('.drop-content').empty();
                $(modal).find('.drop-content').append(response.html);

            }
        });
    });

    $('body').on('change','.shipping_country_select',function () {
        $(this).parents('.modal').find('.drop-content').hide();
        $(this).parents('.modal').find('.loader-div').show();

        var select = $(this);
        $.ajax({
            url:$(this).data('route'),
            type: 'GET',
            data:{
                product: $(this).data('product'),
                country :$(this).val(),
                retailer_product : $(this).data('retailer-product'),
                warehouse_id : $(this).data('warehouse')
            },
            success:function (response) {
                var modal = '#'+select.parents('.modal').attr('id');
                console.log(modal);
                $(modal).find('.loader-div').hide();
                $(modal).find('.drop-content').empty();
                $(modal).find('.drop-content').append(response.html);
                $(modal).find('.drop-content').show();

            }
        });
    });

    $('body').on('change','.shipping_price_radio',function () {
        if($(this).is(':checked')){
            $(this).parents('.block-content').find('.drop-shipping').text($(this).data('price'));
            $(this).parents('.block-content').find('.calculate_shipping_btn').text($(this).data('country'));
        }
    });



    // Profit Tool
    $('body').on('click','.profit_tool_btn',function () {
        var button = $(this);
        $.ajax({
            url:$(this).data('route'),
            type: 'GET',
            data:{
                product: $(this).data('product'),
                retailer_product : $(this).data('retailer-product'),
                warehouse_id : $(this).data('warehouse')
            },
            success:function (response) {
                var modal = button.data('target');
                $(modal).find('.loader-div').hide();
                $(modal).find('.drop-content').empty();
                $(modal).find('.drop-content').append(response.html);

            }
        });
    });

    $('body').on('change','.profit-tool-country-select',function () {
        $('input[type="text"][name="shipping_cost"]').val('Calculating..');
        $('input[type="text"][name="profit"]').val('');


        var select = $(this);
        $.ajax({
            url:$(this).data('route'),
            type: 'GET',
            data:{
                product: $(this).data('product'),
                country :$(this).val(),
                retailer_product : $(this).data('retailer-product'),
                warehouse_id : $(this).data('warehouse')
            },
            success:function (response) {
                console.log(response);
                $('input[type="text"][name="shipping_cost"]').val(response.shipping_price);

                // var modal = '#'+select.parents('.modal').attr('id');
                // console.log(modal);
                // $(modal).find('.loader-div').hide();
                // $(modal).find('.drop-content').empty();
                // $(modal).find('.drop-content').append(response.html);
                // $(modal).find('.drop-content').show();

            }
        });
    });

    $('body').on('click', '.calculate-profit-btn', function() {
        let profit =   $('input[type="text"][name="selling_price"]').val() - $('input[type="text"][name="product_cost"]').val() - $('input[type="text"][name="shipping_cost"]').val() - $('input[type="text"][name="ads_cost"]').val();
        $('input[type="text"][name="profit"]').val(profit);
    })

    /*Wishlist Switch for has_product*/
    $('body').on('change','#sw-custom',function () {
        if($(this).is(':checked')){
            $(this).next('.custom-control-label').text('Yes');
            $('#product_shopify_id').attr('required',true);
            $('.product-shopify').show();
        }
        else{
            $(this).next('.custom-control-label').text('No');
            $('#product_shopify_id').attr('required',false);
            $('.product-shopify').hide();
        }
    });
    if(!$('body').find('.rating-stars').hasClass('disabled')){
        /* 1. Visualizing things on Hover - See next part for action on click */
        $('body').on('mouseover','#stars li',function(){
            // $('#stars li').on('mouseover', function(){
            var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

            // Now highlight all the stars that's not after the current hovered star
            $(this).parent().children('li.star').each(function(e){
                if (e < onStar) {
                    $(this).addClass('hover');
                }
                else {
                    $(this).removeClass('hover');
                }
            });

        })
        $('body').on('mouseout','#stars li',function(){
            $(this).parent().children('li.star').each(function(e){
                $(this).removeClass('hover');
            });
        });


        /* 2. Action to perform on click */
        $('body').on('click','#stars li',function(){
            // $('#stars li').on('click', function(){
            $('#rating-input').val($(this).data('value'));
            var onStar = parseInt($(this).data('value'), 10); // The star currently selected
            var stars = $(this).parent().children('li.star');

            for (i = 0; i < stars.length; i++) {
                $(stars[i]).removeClass('selected');
            }

            for (i = 0; i < onStar; i++) {
                $(stars[i]).addClass('selected');
            }



        });
    }

    if($('body').find('input[name=rating]').length > 0){
        $('input[name=rating]').each(function () {
            var rating = $(this).val();
            $(this).closest('div').find('.star').each(function (index) {
                if(index < rating){
                    $(this).addClass('selected');
                }
            })
        });

    }

    if($('body').find('#canvas-graph-one-store').length > 0){
        console.log('ok');
        var config = {
            type: 'bar',
            data: {
                labels: JSON.parse($('#canvas-graph-one-store').attr('data-labels')),
                datasets: [{
                    label: 'Order Count',
                    backgroundColor: '#00e2ff',
                    borderColor: '#00e2ff',
                    data: JSON.parse($('#canvas-graph-one-store').attr('data-values')),
                    fill: false,
                }]
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: 'Summary Orders Count'
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Date'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Value'
                        }
                    }]
                }
            }
        };

        var ctx = document.getElementById('canvas-graph-one-store').getContext('2d');
        window.myBar = new Chart(ctx, config);
    }

    if($('body').find('#canvas-graph-two-store').length > 0){
        console.log('ok');
        var config = {
            type: 'line',
            data: {
                labels: JSON.parse($('#canvas-graph-two-store').attr('data-labels')),
                datasets: [{
                    label: 'Orders Sales',
                    backgroundColor: '#5c80d1',
                    borderColor: '#5c80d1',
                    data: JSON.parse($('#canvas-graph-two-store').attr('data-values')),
                    fill: false,
                }]
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: 'Summary Orders Sales'
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Date'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        ticks: {
                            beginAtZero: true
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Sales'
                        }
                    }]
                }
            }
        };

        var ctx_2 = document.getElementById('canvas-graph-two-store').getContext('2d');
        window.myLine = new Chart(ctx_2, config);
    }

    if($('body').find('#canvas-graph-three-store').length > 0){
        console.log('ok');
        var config = {
            type: 'bar',
            data: {
                labels: JSON.parse($('#canvas-graph-three-store').attr('data-labels')),
                datasets: [{
                    label: 'Profit',
                    backgroundColor: '#89d18a',
                    borderColor: '#5fd154',
                    data: JSON.parse($('#canvas-graph-three-store').attr('data-values')),
                    fill: 'start',
                }]
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: 'Summary Profit'
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Date'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        ticks: {
                            beginAtZero: true
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Profit'
                        }
                    }]
                }
            }
        };

        var ctx_3 = document.getElementById('canvas-graph-three-store').getContext('2d');
        window.myLine = new Chart(ctx_3, config);
    }

    if($('body').find('#canvas-graph-four-store').length > 0){
        console.log('ok');
        var config = {
            type: 'line',
            data: {
                labels: JSON.parse($('#canvas-graph-four-store').attr('data-labels')),
                datasets: [{
                    label: 'Products',
                    backgroundColor: '#cd99d1',
                    borderColor: '#cd2bd1',
                    data: JSON.parse($('#canvas-graph-four-store').attr('data-values')),
                    fill: false,
                }]
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: 'Summary New Products'
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Date'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Products'
                        }
                    }]
                }
            }
        };

        var ctx_4 = document.getElementById('canvas-graph-four-store').getContext('2d');
        window.myLine = new Chart(ctx_4, config);
    }

});
