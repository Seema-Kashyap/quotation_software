@extends('layout.app')
@section('content')
    <!-- Button trigger modal -->
    <a class="btn btn-primary" id="" href="{{ route('quotations.create') }}" data-toggle="tooltip"
       title="Create">Create Quotations</a>
{{--    <input type="text" name="customer_search" id="customer_search">--}}
    <table id="customers_table" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Name</th>
            <th>Phone</th>
            <th>Email ID</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
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
