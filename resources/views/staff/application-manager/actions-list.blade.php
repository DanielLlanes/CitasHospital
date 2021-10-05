
@php

$viewUrl = route('staff.applications.show', ["id" => $id]);
$btn_delete = '<button type="submit" class="btn btn-tbl-delete btn-xs eliminar mb-1" data-id=" '.$id.' "><i class="fa fa-trash-o"></i></button>';
$btn_view = '<a href="'.$viewUrl.'" class="btn btn-tbl-view btn-xs mb-1 text-white"><i class="fa fa-eye"></i></a>';
$btn_editPrice = '<button type="button" class="btn btn-tbl-editPrice btn-xs mb-1" data-id=" '.$id.' "><i class="fa fa-money"></i></button>';
$btn_edit = '<button type="submit" class="btn btn-tbl-edit btn-xs editar mb-1" data-id=" '.$id.' "><i class="fa fa-pencil"></i></button>';
@endphp

{!! $btn_view !!}
{!! $btn_editPrice !!}
{!! $btn_edit !!}
{!! $btn_delete !!}
