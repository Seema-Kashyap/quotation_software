@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="quatation-create-page content-panel">
    <div class="content-header">
        <form id="myForm" action="{{ route('quotations.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row customer-detail-wrapper align-items-center">
                <div class="col-md-7">
                    <div class="form-group d-flex align-items-center our_reference_formgrp mb-0">
                        <label id="customer_name"></label>&nbsp;
                        <label for="our_reference">Our Reference:</label>
                        <input name="our_reference" class="form-control mr-4" id="our_reference">
                        <a class="btn btn-dark customer_popup_open" id="customer-0" href="javascript:void(0);" data-toggle="tooltip" title="Create">Add Customer</a>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group customer-search mb-0 position-relative">
                        <input type="text" name="search_customer" id="search_customer" placeholder="Search by Customer Name" class="form-control">
                        <div class="search-icon">
                            <i class="fa fa-search"></i>
                        </div>
                    </div>
                    <div id="customer_list"></div>
                </div>
            </div>
            <div id="customer_list"></div>

            <input id="customer_id" name="customer_id" value="" type="hidden">
            <div class="table-responsive">
                <table class="table table-bordered table-create-quotations mb-0" id="quotations">
                    <thead>
                        <tr>
                            <th class="text-center" width="65">Sr No</th>
                            <th class="text-center">HSN Code</th>
                            <th class="text-center">Product Code</th>
                            <th class="text-center">Material Description</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">UOM</th>
                            <th class="text-center">List Price</th>
                            <th class="text-center">Discount</th>
                            <th class="text-center">Unit Cost in INR</th>
                            <th class="text-center">Factor</th>
                            <th class="text-center">Unit Price in INR</th>
                            <th class="text-center">Total Cost in INR</th>
                            <th class="text-center">Total Price in INR</th>
                            <th class="text-center">Profit</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr id="add-row-0">
                            <td class="row-index text-center" id="id-0" width="65">1</td>
                            <td class="row-index text-center hsn_search max-w-70" contenteditable="true" id="hsn_code-0"></td>
                            <td class="row-index text-center max-w-100" contenteditable="true" id="product_code-0"></td>
                            <td class="row-index text-left max-w-100 text-ellipsis" contenteditable="true" id="material_description-0"></td>
                            <td class="row-index text-right allownumeric quantities max-w-50" contenteditable="true" id="quantity-0"></td>
                            <td class="row-index text-center max-w-50" contenteditable="true" id="oum-0"></td>
                            <td class="row-index text-right allowdecimal max-w-100" contenteditable="true" id="list_price-0"></td>
                            <td class="row-index text-right allowdecimal max-w-50" contenteditable="true" id="discount-0"></td>
                            <td class="row-index text-right allowdecimal unit_cost_in_inrs max-w-100" contenteditable="true" id="unit_cost_in_inr-0"></td>
                            <td class="row-index text-center allowdecimal factors" contenteditable="true" id="factor-0"></td>
                            <td class="row-index text-right allowdecimal unit_price_in_inrs" contenteditable="true" id="unit_price_in_inr-0"></td>
                            <td class="row-index text-right total_cost_in_inrs" id="total_cost_in_inr-0"></td>
                            <td class="row-index text-right total_price_in_inrs" id="total_price_in_inr-0"></td>
                            <td class="row-index text-center profits max-w-70 profits-col" id="profit-0"></td>
                            <td class="row-index text-center add-row" id="change_button-0">
                                <a href="javascript:void(0);" class="btn btn-info add_button" id="row-0">+</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="quatation-card">
                <div class="quatation-total-wrapper right-section">
                    <table class="table table-bordered quatation-total-table mb-4">
                        <tbody>
                            <tr>
                                <td class="text-left subtotal-col-1">
                                    <label class="label-dark"> Sub Total in Figures in INR</label>
                                </td>
                                <td class="text-right subtotal-col-2" id="subtotal">
                                    
                                </td>
                                <td class="text-right subtotal-col-3" id="totalPriceINR">
                                    
                                </td>
                                <td class="text-center subtotal-col-4" id="profit">
                                    
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left subtotal-col-1">
                                    <label class="label-dark"> Discount on basic Amount </label>
                                </td>
                                <td id="discount" data-basic_discount="{{ isset($basic_gst_applicable)?$basic_gst_applicable->discount_basic_amount:'' }}" class="basic_discount-{{ isset($basic_gst_applicable)?$basic_gst_applicable->discount_basic_amount:'' }} text-right subtotal-col-2">
                                {!! isset($basic_gst_applicable)?$basic_gst_applicable->discount_basic_amount.'%':'' !!}
                                </td>
                                <td class="text-right subtotal-col-3" id="total_inr_price_discount">
                                    
                                </td>
                                <td class="text-center subtotal-col-4">

                                </td>
                                <input id="quotation_descount_basic_amount" name="quotation_descount_basic_amount" value="" type="hidden">
                            </tr>
                            <tr>
                                <td class="text-left subtotal-col-1">
                                    <label class="label-dark"> Subtotal in figure INR </label>
                                </td>
                                <td class="text-right  subtotal-col-2" >

                                </td>
                                <td class="text-right subtotal-col-3" id="subtotalfigure">
                                    
                                </td>
                                <td class="text-center subtotal-col-4" id="subtotalfigureProfit">
                                    
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left subtotal-col-1">
                                    <label class="gst-per-label label-dark"> GST Applicable </label>
                                    <select name="gst" id="gst_percentage">
                                        @if(isset($basic_amount))
                                            @foreach($basic_amount as $single_amount)
                                                <option value="{{ $single_amount['id'] }}">{{ $single_amount['gst_applicable'] }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </td>
                                <td class="text-right subtotal-col-2">

                                </td>
                                <td class="text-right subtotal-col-3" id="gst_amount">

                                </td>
                                <td class="text-center subtotal-col-4" id="totalmaount">

                                </td>
                            </tr>
                            <tr>
                                <td class="text-left subtotal-col-1">
                                    <label class="label-dark"> Total Amount in Figures in INR </label>
                                </td>
                                <td class="subtotal-col-2">

                                </td>
                                <td class="text-right subtotal-col-3">
                                    
                                </td>
                                <td class="subtotal-col-4"></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="add-note-card mb-4">
                        <div class="form-group mb-0">
                            <label for="note" class="label-dark">Note</label>
                            <div class="input-addons">
                                <input name="quotation_note" id="quotation_note" class="form-control dark-placeholder" placeholder="Add Note Here..">
                                <!-- <button type="button" class="btn btn-secondary button-addon">Add</button> -->
                            </div>
                        </div>
                    </div>

                    <div class="commercial-terms-box add-note-card mb-4">
                        <ul>
                            <li>
                                <h3>Commercial Terms:</h3>
                                <label class="label-light"> GST: Extra at actual, currently </label>
                                <select name="commercial_terms_gst" id="commercial_terms_gst">
                                    @if(isset($commercial_gst))
                                        @foreach($commercial_gst as $single_gst)
                                            <option value="{{ $single_gst['id'] }}">{{ $single_gst['gst'] }}%</option>
                                        @endforeach
                                    @endif
                                </select>
                            </li>
                            <li>
                                <label class="label-light"> Payment for Spares / Services </label>
                                <select name="payment_spares_or_service" id="payment_spares_or_service">
                                    @if(isset($spares_services))
                                        @foreach($spares_services as $single_spares_service)
                                            <option value="{{ $single_spares_service['id'] }}">{{ $single_spares_service['days_value'] }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </li>
                            <li>
                                <label class="label-light"> Delivery of Parts / services </label>
                                <select name="delivery_parts_service" id="delivery_parts_service">
                                    @if(isset($parts_service))
                                        @foreach($parts_service as $single_parts_service)
                                            <option value="{{ $single_parts_service['id'] }}">{{ $single_parts_service['delivery_days'] }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </li>
                            <li>
                                <label class="label-light"> Delivery Terms </label>
                                <select name="delivery_terms" id="delivery_terms">
                                    @if(isset($delivery_terms))
                                        @foreach($delivery_terms as $single_delivery_term)
                                            <option value="{{ $single_delivery_term['id'] }}">{{ $single_delivery_term['scopes'] }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </li>
                            <li class="mt-4">
                                <div class="form-group mb-0">
                                    <div class="input-addons">
                                        <input name="commercial_terms_note" id="commercial_terms_note" class="form-control dark-placeholder" placeholder="Add Note Here..">
                                        <!-- <button type="button" class="btn btn-secondary button-addon">Add</button> -->
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="button-block text-right">
                        <input type="submit" class="btn btn-dark" value="Save Quotation">
                    </div>
                </div>
            </div>

            <!-- <ul>
            <li>sub total <span id="subtotal"></span> | <span id="totalPriceINR"></span> | <span id="profit"></span> | </li>
            <li>discount on basic amount <span id="discount" class="basic_discount-{{ isset($basic_gst_applicable)?$basic_gst_applicable->discount_basic_amount:'' }}">{!! isset($basic_gst_applicable)?$basic_gst_applicable->discount_basic_amount.'%':'' !!}</span></li>
            <li>Total Inr Price Descount <span id="total_inr_price_discount"></span><input id="quotation_descount_basic_amount" name="quotation_descount_basic_amount" value="" type="hidden"></li>
            <li>sub total in figure in inr <span id="subtotalfigure"></span> | <span id="subtotalfigureProfit"></span></li>
            <li>gst applicable
                <select name="gst" id="gst_percentage">
                    @if(isset($basic_amount))
                        @foreach($basic_amount as $single_amount)
                            <option value="{{ $single_amount['id'] }}">{{ $single_amount['gst_applicable'] }}</option>
                        @endforeach
                    @endif
                </select>
                :
                <span id="gst_amount"></span>
            </li>
            <li>total amount <span id="totalmaount"></span></li>
        </ul> -->


            <!-- <textarea name="commercial_terms_note" id="commercial_terms_note" cols="30" rows="5" class="form-group"></textarea> -->

        </form>

    </div>

    <div class="modal fade bd-example-modal-lg" id="customer_model" tabindex="-1" aria-labelledby="customerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body" id="customer_popup_html">
                    <h5 class="modal-title" id="customerModalLabel">Add Customer Info</h5>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="customer_submit">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
        $(document).on('keyup', '#search_customer', function () {
            var customer_search = $(this).val();
            $.ajax({
            url: '{{ route("customers.search") }}',
                type: 'POST',
                dataType: 'json',
                data: {
                    '_token': '{{ csrf_token() }}', customer_search: customer_search,
                },
                success: function (response) {
                    $('#customer_list').html('');
                    $('#customer_list').html(response);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    if (jqXHR.status == 500) {
                        alert('Internal error: ' + jqXHR.responseText);
                    } else {
                        alert('There is some error.');
                    }
                }
            });
        });

        $(document).on('click', '.list-group-item', function(){
            // declare the value in the input field to a variable
            var value = $(this).text();
            var id = $(this).attr('data-id');
            // assign the value to the search box
            $('#search_customer').val(value);
            $('#customer_name').text(value);
            $('#customer_id').val(id);
            // after click is done, search results segment is made empty
            $('#customer_list').html("");
        });


        $(document).on('click', '.customer_popup_open', function () {
            var url = '';
            var full_id = $(this).attr('id');
            var id = full_id.split('-')[1];
            if (id == 0) {
                url = '{{ route("customers.create") }}';
            } else {
                url = '{{ route("customers.edit") }}';
            }
            customer_id_jquery = id;
            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
                data: {
                    '_token': '{{ csrf_token() }}', id: id,quotation:'create',
                },
                success: function (response) {
                    if (response.status) {
                        $('#customer_popup_html').html('');
                        $('#customer_popup_html').html(response.customers_html);
                        $('#customer_model').modal('show');
                    } else {
                        alert('There is some error.');
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    if (jqXHR.status == 500) {
                        alert('Internal error: ' + jqXHR.responseText);
                    } else {
                        alert('There is some error.');
                    }
                }
            });
        });

        $(document).on('click', '#customer_submit', function () {
            if (customer_id_jquery == 0) {
                var customers_validation_form = $("#customer_form").valid();
                var form = $('#customer_form')[0];
            } else {
                var customers_validation_form = $("#customer_edit_form").valid();
                var form = $('#customer_edit_form')[0];
            }

            if(customers_validation_form) {
                var url = '';
                if (customer_id_jquery == 0) {
                    url = '{{ route("customers.store") }}';
                } else {
                    url = '{{ route("customers.update") }}';
                }

                var formData = new FormData(form);
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function (response) {
                        if (response.status) {
                            $('#customer_model').modal('hide');
                            $('#customer_name').text(response.customer_detail_array.customer_name);
                            $('#customer_id').val(response.customer_detail_array.id);
                        } else {
                            alert('There is some error.');
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        if (jqXHR.status == 500) {
                            alert('Internal error: ' + jqXHR.responseText);
                        } else {
                            alert('There is some error.');
                        }
                    }
                });
            }
        });

        $(document).on('click', '.add_button', function () {
            var id = $(this).attr('id').split('-')[1];
            if (id) {
                $('#change_button-' + id).html('');
                $('#change_button-' + id).html('<a href="javascript:void(0);" class="btn btn-danger remove_button" id="row-' + id + '">-</a>')
                id++;
                $('#tbody').append(
                    '<tr id="add-row-' + id + '">' +
                    '<td class="row-index text-center" id="id-' + id + '">' + parseInt(id+1) + '</td>' +
                    '<td class="row-index text-center hsn_search" contenteditable="true" id="hsn_code-' + id + '"></td>' +
                    '<td class="row-index text-center" contenteditable="true" id="product_code-' + id + '"></td>' +
                    '<td class="row-index text-center" contenteditable="true" id="material_description-' + id + '"></td>' +
                    '<td class="row-index text-center allownumeric quantities" contenteditable="true" id="quantity-' + id + '"></td>' +
                    '<td class="row-index text-center" contenteditable="true" id="oum-' + id + '"></td>' +
                    '<td class="row-index text-center allowdecimal" contenteditable="true" id="list_price-' + id + '"></td>' +
                    '<td class="row-index text-center allowdecimal discounts" contenteditable="true" id="discount-' + id + '"></td>' +
                    '<td class="row-index text-center allowdecimal unit_cost_in_inrs" contenteditable="true" id="unit_cost_in_inr-' + id + '"></td>' +
                    '<td class="row-index text-center allowdecimal factors" contenteditable="true" id="factor-' + id + '"></td>' +
                    '<td class="row-index text-center allowdecimal unit_price_in_inrs" contenteditable="true" id="unit_price_in_inr-' + id + '"></td>' +
                    '<td class="row-index text-center total_cost_in_inrs" id="total_cost_in_inr-' + id + '"></td>' +
                    '<td class="row-index text-center total_price_in_inrs" id="total_price_in_inr-' + id + '"></td>' +
                    '<td class="row-index text-center profits" id="profit-' + id + '"></td>' +
                    '<td class="row-index text-center add-row" id="change_button-' + id + '">' +
                    '<a href="javascript:void(0);" class="btn btn-info add_button" id="row-' + id + '">+</a>' +
                    '</td>'
                );
                calculateTotalProfits();
                calculateTotalPriceINR();
                calculateSubTotal();
            } else {
                alert('There is some error please try again!');
            }
        });

        $("#myForm").submit(function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Create an empty array to store cell values
            var cellValues = [];

            // Loop through each table row
            $("#quotations tr").each(function() {
                var rowValues = [];

                // Loop through each cell in the row
                $(this).find("td").each(function() {
                    // Push the cell's text content to the rowValues array
                    rowValues.push($(this).text());
                });

                // Push the rowValues array to the cellValues array
                cellValues.push(rowValues);
            });

            // Convert the cellValues array to a JSON string
            var jsonData = JSON.stringify(cellValues);

            // Create a hidden input field to hold the JSON data
            $("<input>")
                .attr("type", "hidden")
                .attr("name", "cellValues")
                .val(jsonData)
                .appendTo("#myForm");

            // Submit the form with the hidden input
            $("#myForm").unbind("submit").submit();
        });

        $(document).on('keyup', '.hsn_search', function () {
            var id = $(this).attr('id').split('-')[1];
            var hsn_code = $(this).text().trim();

            if (hsn_code != '') {
                $.ajax({
                    url: '{{ route('quotations.search_hsn') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        '_token': '{{ csrf_token() }}', hsn_code: hsn_code,
                    },
                    success: function (response) {
                        if (response.status) {
                            $('#product_code-'+id).text('');
                            $('#material_description-'+id).text('');
                            $('#quantity-'+id).text('');
                            $('#oum-'+id).text('');
                            $('#list_price-'+id).text('');
                            $('#discount-'+id).text('');
                            $('#unit_cost_in_inr-'+id).text('');
                            $('#factor-'+id).text('');
                            $('#unit_price_in_inr-'+id).text('');
                            $('#total_cost_in_inr-'+id).text('');
                            $('#total_price_in_inr-'+id).text('');
                            $('#profit-'+id).text('');

                            // $('#hsn_code-'+).text(response.json_response.hsn_code);
                            $('#product_code-'+id).text(response.json_response.product_code);
                            $('#material_description-'+id).text(response.json_response.material_description);
                            $('#quantity-'+id).text(response.json_response.quantity);
                            $('#oum-'+id).text(response.json_response.uom);
                            $('#list_price-'+id).text(response.json_response.list_price);
                            $('#discount-'+id).text(response.json_response.discount);
                            $('#unit_cost_in_inr-'+id).text(response.json_response.unit_cost_in_inr);
                            $('#factor-'+id).text(response.json_response.factor);
                            $('#unit_price_in_inr-'+id).text(response.json_response.unit_price_in_inr);
                            $('#total_cost_in_inr-'+id).text(response.json_response.total_cost_in_inr);
                            $('#total_price_in_inr-'+id).text(response.json_response.total_price_in_inr);
                            $('#profit-'+id).text(response.json_response.profit);

                            // change_button
                            calulateSingleProfit(id);
                            calculateTotalProfits();
                            calculateTotalPriceINR();
                            calculateSubTotal();
                        } else {
                            $('#product_code-'+id).text('');
                            $('#material_description-'+id).text('');
                            $('#quantity-'+id).text('');
                            $('#oum-'+id).text('');
                            $('#list_price-'+id).text('');
                            $('#discount-'+id).text('');
                            $('#unit_cost_in_inr-'+id).text('');
                            $('#factor-'+id).text('');
                            $('#unit_price_in_inr-'+id).text('');
                            $('#total_cost_in_inr-'+id).text('');
                            $('#total_price_in_inr-'+id).text('');
                            $('#profit-'+id).text('');

                            calulateSingleProfit(id);
                            calculateTotalProfits();
                            calculateTotalPriceINR();
                            calculateSubTotal();
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        if (jqXHR.status == 500) {
                            alert('Internal error: ' + jqXHR.responseText);
                        } else {
                            alert('There is some error.');
                        }
                    }
                });
            } else {
                $('#product_code-'+id).text('');
                $('#material_description-'+id).text('');
                $('#quantity-'+id).text('');
                $('#oum-'+id).text('');
                $('#list_price-'+id).text('');
                $('#discount-'+id).text('');
                $('#unit_cost_in_inr-'+id).text('');
                $('#factor-'+id).text('');
                $('#unit_price_in_inr-'+id).text('');
                $('#total_cost_in_inr-'+id).text('');
                $('#total_price_in_inr-'+id).text('');
                $('#profit-'+id).text('');

                calulateSingleProfit(id);
                calculateTotalProfits();
                calculateTotalPriceINR();
                calculateSubTotal();
            }
        });

        // $(document).on('keyup', '.total_cost_in_inrs', function () {
        //     calculateSubTotal();
        // });
        //
        // $(document).on('keyup', '.profits', function () {
        //     calculateTotalProfits();
        // });
        //
        // $(document).on('keyup', '.total_price_in_inrs', function () {
        //     calculateTotalPriceINR();
        // });

        $(document).on('click', '.remove_button', function () {
            var get_remove_id = $(this).attr('id').split('-')[1];
            $('#add-row-'+get_remove_id).remove();

            calulateSingleProfit(get_remove_id);
            calculateTotalProfits();
            calculateTotalPriceINR();
            calculateSubTotal();
        });


        $(document).on('keyup change', '.unit_price_in_inrs', function () {
            var get_id = $(this).attr('id').split('-')[1];
            var unit_price_in_inrs_value = $(this).text();
            var get_quantity = $('#quantity-' + get_id).text();

            var total_price_in_inr_table_row = parseFloat(get_quantity * unit_price_in_inrs_value);
            $('#total_price_in_inr-' + get_id).text(total_price_in_inr_table_row);

            calulateSingleProfit(get_id);
            calculateTotalProfits();
            calculateTotalPriceINR();
            calculateSubTotal();
        });

        $(document).on('keyup change', '.unit_cost_in_inrs', function () {
            var get_id = $(this).attr('id').split('-')[1];
            var unit_cost_in_inrs_value = $(this).text();
            var unit_cost_get_quantity = $('#quantity-' + get_id).text();

            var single_factor = $('#factor-' + get_id).text();
            $('#unit_price_in_inr-' + get_id).text(parseFloat(unit_cost_in_inrs_value * single_factor));

            var total_cost_in_inr_table_row = parseFloat(unit_cost_get_quantity * unit_cost_in_inrs_value);
            $('#total_cost_in_inr-' + get_id).text(total_cost_in_inr_table_row);

            calulateSingleProfit(get_id);
            calculateTotalProfits();
            calculateTotalPriceINR();
            calculateSubTotal();
        });

        $(document).on('keyup', '.factors', function () {
            var factor_id = $(this).attr('id').split('-')[1];
            var single_factor = $(this).text();
            var unit_cost_in_inrs_value = $('#unit_cost_in_inr-' + factor_id).text();
            $('#unit_price_in_inr-' + factor_id).text(parseFloat(unit_cost_in_inrs_value * single_factor));
            var get_quantity = $('#quantity-' + factor_id).text();

            var unit_price_in_inrs_value = $('#unit_price_in_inr-' + factor_id).text();
            var total_price_in_inr_table_row = parseFloat(get_quantity * unit_price_in_inrs_value);
            $('#total_price_in_inr-' + factor_id).text(total_price_in_inr_table_row);

            calulateSingleProfit(factor_id);
            calculateTotalProfits();
            calculateTotalPriceINR();
            calculateSubTotal();
        });

        $(document).on('keyup', '.quantities', function () {
            var quantity_id = $(this).attr('id').split('-')[1];
            var single_quantity = $(this).text();

            var unit_cost_in_inrs_value = $('#unit_cost_in_inr-' + quantity_id).text();
            var total_cost_in_inr_table_row = parseFloat(single_quantity * unit_cost_in_inrs_value);
            $('#total_cost_in_inr-' + quantity_id).text(total_cost_in_inr_table_row);

            var unit_price_in_inrs_value = $('#unit_price_in_inr-' + quantity_id).text();
            var total_price_in_inr_table_row = parseFloat(single_quantity * unit_price_in_inrs_value);
            $('#total_price_in_inr-' + quantity_id).text(total_price_in_inr_table_row);

            calulateSingleProfit(quantity_id);
            calculateTotalProfits();
            calculateTotalPriceINR();
            calculateSubTotal();
        });

        calculateTotalProfits();
        calculateTotalPriceINR();
        calculateSubTotal();

        function calculateSubTotal() {
            var subtotal = 0;
            $('.total_cost_in_inrs').each(function () {
                if($(this).text()) {
                    subtotal += parseFloat($(this).text());
                }
            });
            $('#subtotal').text(subtotal);
        }

        function calulateSingleProfit(id) {
            var unit_price = $('#unit_price_in_inr-' + id).text();
            var unit_cost = $('#unit_cost_in_inr-' + id).text();
            var single_row_profit = 0;
            if (unit_price && unit_cost) {
                var single_row_profit = parseFloat(unit_price - unit_cost);
            }
            $('#profit-' + id).text(single_row_profit);
        }

        function calculateTotalPriceINR() {
            var totalPriceINR = 0;
            $('.total_price_in_inrs').each(function () {
                if($(this).text()) {
                    totalPriceINR += parseFloat($(this).text());
                }
            });
            $('#totalPriceINR').text(totalPriceINR);

            // var applicable_discount = $('#discount').attr('class').split('-')[1];
            var applicable_discount = $('#discount').attr('data-basic_discount');
            console.log(applicable_discount);

            var discount_count =  parseFloat(totalPriceINR*applicable_discount)/100;
            $('#total_inr_price_discount').text(discount_count);
            $('#quotation_descount_basic_amount').val(discount_count);

            var discount_amount = parseFloat(totalPriceINR-discount_count);
            $('#subtotalfigure').text(discount_amount);
            var total_profit = $('#profit').text();

            var subtotalfigureProfit = parseFloat(total_profit-discount_count);
            $('#subtotalfigureProfit').text(parseFloat(subtotalfigureProfit));

            var gst_percentage = $('#gst_percentage').text();
            var gst_calculate = ((parseFloat(gst_percentage)*parseFloat(discount_amount))/100);

            $('#gst_amount').text(gst_calculate);
            var total_amount = parseFloat(gst_calculate)+parseFloat(discount_amount);
            $('#totalmaount').text(total_amount);
        }

        function calculateTotalProfits() {
            var totalProfits = 0;
            $('.profits').each(function () {
                if ($(this).text()) {
                    totalProfits += parseFloat($(this).text());
                }
            });
            $('#profit').text(totalProfits);
        }

        $(document).on("keypress keyup blur", '.allowdecimal', function (event) {
            var $this = $(this);
            if ((event.which != 46 || $this.text().indexOf('.') != -1) &&
                ((event.which < 48 || event.which > 57) &&
                    (event.which != 0 && event.which != 8))) {
                event.preventDefault();
            }

            var text = $(this).text();
            if ((event.which == 46) && (text.indexOf('.') == -1)) {
                setTimeout(function () {
                    if ($this.text().substring($this.text().indexOf('.')).length > 3) {
                        $this.text($this.text().substring(0, $this.text().indexOf('.') + 3));
                    }
                }, 1);
            }

            if ((text.indexOf('.') != -1) &&
                (text.substring(text.indexOf('.')).length > 1) &&
                (event.which != 0 && event.which != 8) &&
                ($(this)[0].selectionStart >= text.length - 1)) {
                event.preventDefault();
            }
        });

        $(document).on("keypress keyup blur", '.allownumeric', function (event) {
            $(this).val($(this).val().replace(/[^\d].+/, ""));
            if ((event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });

        $(document).on("keypress keyup blur", '.allowstring', function (event) {
            $(this).val($(this).val().replace(/[^\w].+/, ""));
            if (!((event.which >= 65 && event.which < 92) ||
                (event.which >= 97 && event.which <= 122))) {
                event.preventDefault();
            }
        });

        $(document).bind("paste", '.allowdecimal,', function (e) {
            var text = e.originalEvent.clipboardData.getData('Text');
            if ($.isNumeric(text)) {
                if ((text.substring(text.indexOf('.')).length > 3) && (text.indexOf('.') > -1)) {
                    e.preventDefault();
                    $(this).val(text.substring(0, text.indexOf('.') + 3));
                }
            } else {
                e.preventDefault();
            }
        });

        $(document).on('change', '#gst_percentage', function () {
            var subtotal_val = $('#subtotalfigure').text();
            var gst_percentage_on_change = $("#gst_percentage option:selected").text();
            var gst_calculate_on_change = parseFloat(gst_percentage_on_change*subtotal_val)/100;
            $('#gst_amount').text(gst_calculate_on_change);
            $('#totalmaount').text('0');
            var total_amount_on_change = parseFloat(gst_calculate_on_change)+parseFloat(subtotal_val);
            $('#totalmaount').text(total_amount_on_change);
        });
    </script>
@stop