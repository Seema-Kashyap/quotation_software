@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="items-page content-panel">
    <div class="content-header">
        <div class="row">
            <div class="col-8">
                <div class="page_title">
                    <h4>List Of Customer</h4>
                </div>
            </div>
            <div class="col-4 text-right">   
                <div class="button_block">
                    <a class="customer_popup_open btn btn-dark" id="customer-0" href="javascript:void(0);" title="Create">Add Customer</a>
                </div>             
            </div>
        </div>
     </div>
    <!-- Button trigger modal -->   
{{--    <input type="text" name="customer_search" id="customer_search">--}}
    <table id="customers_table" class="table table-striped customers-table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Phone</th>
            <!-- <th>City</th> -->
            <th>Email ID</th>
            <th class="text-center">Edit</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="customer_model" tabindex="-1" aria-labelledby="customerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body" id="customer_popup_html">
                    
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
    <script>
        var customer_id_jquery = 0;
        var customer_table = '';
        $(function () {
            customer_table = $("#customers_table").DataTable({
                "responsive": true,
                "searching": false,
                'processing': true,
                'serverSide': true,
                "info": false, 
                "lengthChange": false,
                'serverMethod': 'post',
                'ajax': {
                    'url': '{{ route("customers.list") }}',
                    'type': 'POST',
                    'dataType': 'json',
                    'data': function (data) {
                        data._token = "{{ csrf_token() }}";
                        // data.status_filter = $('#status_filter').val();
                    }
                },
                'columns': [
                    {
                        data: 'customer_name'
                    },
                    {
                        data: 'customer_phone'
                    },
                    {
                        data: 'customer_email'
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
{{-- @endsection --}}

