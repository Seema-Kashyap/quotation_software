@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="quatation-page content-panel">
    <div class="content-header">
        <div class="row">
            <div class="col-8">
                <div class="page_title">
                    <h4>List Of Quatation</h4>
                </div>
            </div>
            <div class="col-4 text-right">   
                <div class="button_block">
                    <a class="btn btn-dark quotation-button" id="" href="{{ route('quotations.create') }}" data-toggle="tooltip" title="Create">Create Quotation</a>
                </div>             
            </div>
        </div>
     </div>
    <!-- Button trigger modal -->
    
{{--    <input type="text" name="customer_search" id="customer_search">--}}
    <table id="quotations_table" class="table table-striped table-quatation">
        <thead>
        <tr>
            <th>Number</th>
            <th>Date</th>
            <th>Company name</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Export</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
@stop

@section('js')
    <script>
        var customer_id_jquery = 0;
        var customer_table = '';
        $(function () {
            customer_table = $("#quotations_table").DataTable({
                "responsive": true,
                "lengthChange": false,
                "searching": false,
                'processing': true,
                'serverSide': true,
                'info': false,
                'serverMethod': 'post',
                'ajax': {
                    'url': '{{ route("quotations.list") }}',
                    'type': 'POST',
                    'dataType': 'json',
                    'data': function (data) {
                        data._token = "{{ csrf_token() }}";
                        // data.status_filter = $('#status_filter').val();
                    }
                },
                'columns': [
                    {
                        data: 'id'
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'customer_name'
                    },
                    {
                        data: 'quotation_descount_basic_amount'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'export'
                    },
                    {
                        data: 'action'
                    },
                ]
            });
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
                    '_token': '{{ csrf_token() }}', id: id,
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
                            customer_table.draw();
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

    </script>
@stop
