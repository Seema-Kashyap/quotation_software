@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="items-page content-panel">
    <div class="content-header">
        <div class="row">
            <div class="col-8">
                <div class="page_title">
                    <h4>List Of Items</h4>
                </div>
            </div>
            <div class="col-4 text-right">   
                <div class="button_block">
                    <a class="items_popup_open btn btn-dark" id="items-0" href="javascript:void(0);" title="Create">Add Item</a>
                </div>             
            </div>
        </div>
     </div>
    <!-- Button trigger modal -->
    
{{--    <input type="text" name="customer_search" id="customer_search">--}}
    <table id="items_table" class="table table-striped items-table">
        <thead>
        <tr>
            <th>Name</th>
            <th>HSC Code</th>
            <th>Vendor Name</th>
            <th class="text-center">Edit</th>
        </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="items_model" role="dialog" tabindex="-1" aria-labelledby="itemsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body" id="itmes_popup_html">
                    
                </div>
            </div>
        </div>
    </div>
</div>
    @stop

   @section('js')
    <script>
        var items_id_jquery = 0;
        var items_table = '';
        $(function () {
            items_table = $("#items_table").DataTable({
                // "paging": false,
                // "bPaginate": false, //hide pagination
                "lengthChange": false,
                "responsive": true,
                "searching": false,
                'processing': true,
                'serverSide': true,
                "info": false, 
                'serverMethod': 'post',
                'ajax': {
                    'url': '{{ route("items.list") }}',
                    'type': 'POST',
                    'dataType': 'json',
                    'data': function (data) {
                        data._token = "{{ csrf_token() }}";
                        // data.status_filter = $('#status_filter').val();
                    }
                },
                'columns': [
                    {
                        data: 'item_name'
                    },
                    {
                        data: 'item_hsn_code'
                    },
                    {
                        data: 'item_vendor'
                    },
                    {
                        data: 'action'
                    },
                ]
            });
        });

        $(document).on('click', '.items_popup_open', function () {
            var url = '';
            var full_id = $(this).attr('id');
            var id = full_id.split('-')[1];
            if (id == 0) {
                url = '{{ route("items.create") }}';
            } else {
                url = '{{ route("items.edit") }}';
            }
            items_id_jquery = id;
            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
                data: {
                    '_token': '{{ csrf_token() }}', id: id,
                },
                success: function (response) {
                    if (response.status) {
                        $('#itmes_popup_html').html('');
                        $('#itmes_popup_html').html(response.items_html);
                        $('#items_model').modal('show');
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

        $(document).on('click', '#items_submit', function () {
            if (items_id_jquery == 0) {
                var itmes_validation_form = $("#items_form").valid();
                var form = $('#items_form')[0];
            } else {
                var itmes_validation_form = $("#items_edit_form").valid();
                var form = $('#items_edit_form')[0];
            }

            if(itmes_validation_form) {
                var url = '';
                if (items_id_jquery == 0) {
                    url = '{{ route("items.store") }}';
                } else {
                    url = '{{ route("items.update") }}';
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
                            $('#items_model').modal('hide');
                            // $('.modal-backdrop').remove();
                            items_table.draw();
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
