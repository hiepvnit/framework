@extends('mage2-framework::layouts.admin')

@section('content')
    <h1>
        <span class="main-title-wrap">Product Attribute List</span>
        <a style="" href="{{ route('admin.attribute.create') }}" class="btn btn-primary float-right">Create
            Attribute</a>
    </h1>


    <table class="table table-bordered table-responsive" id="attribute-table">
        <thead class="bg-primary text-white">
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Identifier</th>

            <th>Edit</th>
            <th>Destroy</th>
        </tr>
        </thead>
    </table>

@stop
@push('scripts')
<script>
    $(function () {
        $('#attribute-table').DataTable({
            processing: true,
            searching: false,
            serverSide: true,
            ajax: '{!! route('admin.attribute.data-grid-table.get-data') !!}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'title', name: 'title'},
                {data: 'identifier', name: 'identifier'},
                {
                    data: 'edit',
                    name: 'edit',
                    sortable: false,
                    render: function (data, type, object, meta) {

                        return '<a href="/admin/attribute/' + object.id + '/edit">Edit</a>';
                    }
                },
                {
                    data: 'destroy',
                    name: 'destroy',
                    sortable: false,
                    render: function (data, type, object, meta) {
                        return '<form id="admin-attribute-destroy-' + object.id + '" method="post"  action="/admin/attribute/' + object.id + '" ><input type="hidden" name="_method" value="DELETE"/><input type="hidden" name="_token" value="{{ csrf_token() }}"/> </form> <a onclick="event.preventDefault();jQuery(\'#admin-attribute-destroy-' + object.id + '\').submit()"  href="/admin/attribute/' + object.id + '">Destroy</a>';
                    }
                }
            ]
        });
    });
</script>
@endpush

@push('styles')
<style>
    .dt-bootstrap .row {
        width: 100%;
        margin: 0px;

    }
    .dt-bootstrap .dataTables_length {
        float: left;
        margin-bottom: 10px;
    }

    .dt-bootstrap .dataTables_info {
        margin-top: 25px;

    }

    .dt-bootstrap .pagination {
        display: inline-block;
        float: right;
        padding-left: 0;
        margin: 20px 0 15px;
        border-radius: 4px;
    }

    .dt-bootstrap .pagination > li {
        display: inline;
    }

    .dt-bootstrap .pagination > li > a,
    .dt-bootstrap .pagination > li > span {
        position: relative;
        float: left;
        padding: 6px 12px;
        margin-left: -1px;
        line-height: 1.42857143;
        color: #007bff;
        text-decoration: none;
        background-color: #fff;
        border: 1px solid #ddd;
    }

    .dt-bootstrap .pagination > li:first-child > a,
    .pagination > li:first-child > span {
        margin-left: 0;
        border-top-left-radius: 4px;
        border-bottom-left-radius: 4px;
    }

    .dt-bootstrap .pagination > li:last-child > a,
    .dt-bootstrap .pagination > li:last-child > span {
        border-top-right-radius: 4px;
        border-bottom-right-radius: 4px;
    }

    .dt-bootstrap .pagination > li > a:hover,
    .dt-bootstrap .pagination > li > span:hover,
    .dt-bootstrap .pagination > li > a:focus,
    .dt-bootstrap .pagination > li > span:focus {
        z-index: 2;
        color: #007bff;
        background-color: #eee;
        border-color: #ddd;
    }

    .dt-bootstrap .pagination > .active > a,
    .dt-bootstrap .pagination > .active > span,
    .dt-bootstrap .pagination > .active > a:hover,
    .dt-bootstrap .pagination > .active > span:hover,
    .dt-bootstrap .pagination > .active > a:focus,
    .dt-bootstrap .pagination > .active > span:focus {
        z-index: 3;
        color: #fff;
        cursor: default;
        background-color: #007bff;
        border-color: #337ab7;
    }

    .dt-bootstrap .pagination > .disabled > span,
    .dt-bootstrap .pagination > .disabled > span:hover,
    .dt-bootstrap .pagination > .disabled > span:focus,
    .dt-bootstrap .pagination > .disabled > a,
    .dt-bootstrap .pagination > .disabled > a:hover,
    .dt-bootstrap .pagination > .disabled > a:focus {
        color: #777;
        cursor: not-allowed;
        background-color: #fff;
        border-color: #ddd;
    }
</style>
@endpush
