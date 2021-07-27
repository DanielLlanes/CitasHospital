

<div class="d-md-flex flex-md-nowrap">
		{{-- {!! HTML::decode(link_to_route('admin.admininstadores.edit', $title = '<i class="fa fa-edit m-r-5"></i> Editar', $parameters = ['id' => $id], $attributes = ['id' => 'view', 'class' => 'btn btn-warning waves-effect btn-sm m-2 editar-admin'])) !!}
		{{ Form::button('<i class="fa fa-trash m-r-5"></i>Eliminar', ['type' => 'submit', 'class' => 'btn btn-danger waves-effect btn-sm m-2 eliminar', 'data-id' => $id] )  }} --}}
        <button type="button" class="btn btn-tbl-delete btn-xs" style="visibility: hidden;"><i class="fa fa-pencil"></i></button>
        <button type="button" class="btn btn-tbl-delete btn-xs" style="visibility: hidden;"><i class="fa fa-trash-o"></i></button>'
</div>
