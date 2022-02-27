
@php

$viewUrl = route('staff.applications.show', ["id" => $id]);
$btn_delete = '<button type="submit" class="btn btn-tbl-delete btn-xs eliminar mb-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete!" data-id=" '.$id.' "><i class="fa fa-trash-o"></i></button>';
$btn_view = '<a href="'.$viewUrl.'" class="btn btn-tbl-view btn-xs mb-1 text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="View!"><i class="fa fa-eye"></i></a>';
$btn_editPrice = '<button type="button" class="btn btn-tbl-editPrice btn-xs mb-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Price!" data-id=" '.$id.' "><i class="fa fa-money"></i></button>';
$btn_edit = '<button type="submit" class="btn btn-tbl-edit btn-xs editar mb-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit!" data-id=" '.$id.' "><i class="fa fa-pencil"></i></button>';
$btn_payment = '<button type="submit" class="btn btn-tbl-payment btn-xs payment mb-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Payment!" data-id=" '.$id.' "><i class="fa fa-usd"></i></button>';


@endphp



<ul class="table_icons">
    <li>
        <a href="{{ route('staff.applications.show', $id) }}" title="" class="bg-info" title="view details" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete!">
            <span class="icon fa fa-eye"></span>
        </a>
    </li>
    {{-- <li>
        <button class="eliminar mb-1 bg-success">
            <span class="icon fa fa fa-money"></span>
        </button>
    </li>
    <li>
        <button class="eliminar mb-1 bg-warning">
            <span class="icon fa fa-usd"></span>
        </button>
    </li> --}}
</ul>
