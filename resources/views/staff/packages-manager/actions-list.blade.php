

@php
    $btn_delete = '<button type="submit" class="btn btn-tbl-delete btn-xs eliminar mb-1" data-id=" '.$id.' "><i class="fa fa-trash-o"></i></button>';
    $btn_edit = '<button type="submit" class="btn btn-tbl-edit btn-xs editar mb-1" data-id=" '.$id.' "><i class="fa fa-pencil"></i></button>';
@endphp

{!! $btn_edit !!}
{!! $btn_delete !!}
