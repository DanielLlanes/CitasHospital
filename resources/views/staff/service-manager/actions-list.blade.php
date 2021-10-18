

@php
    $btn_delete = '<button type="submit" class="btn btn-tbl-delete btn-xs eliminar mb-1" data-id=" '.$id.' "><i class="fa fa-trash-o"></i></button>';
    $btn_edit = '<button type="submit" class="btn btn-tbl-edit btn-xs editar mb-1" data-id=" '.$id.' "><i class="fa fa-pencil"></i></button>';
@endphp

<ul class="table_icons">
    <li>
        <button type="button" class="tbl-edit mb-1 bg-secondary" data-id="{{ $id }}" >
            <span class="icon fa fa fa-pencil"></span>
        </button>
    </li>
    <li>
        <button type="button" class="eliminar mb-1 bg-danger" data-id="{{ $id }}">
            <span class="icon fa fa-trash-o"></span>
        </button>
    </li>
</ul>
