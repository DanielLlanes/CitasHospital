{!! \HTML::decode(link_to_route('staff.staff.edit', $title = '<i class="fa fa-pencil"></i>', $parameters = ['id' => $id], $attributes = ['id' => 'view'.$id, 'class' => 'btn btn-tbl-edit btn-xs editar-staff'])) !!}
{{ Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'btn btn-tbl-delete btn-xs eliminar', 'data-id' => $id] )  }}

