
@php
	$btn_delete = '<button type="submit" class="btn btn-tbl-delete btn-xs eliminar" data-id="$id"><i class="fa fa-trash-o"></i></button>';
	$btn_edit = '<a href="'.route("staff.staff.edit", $id).'" class="btn btn-tbl-edit btn-xs editar-staff"><i class="fa fa-pencil"></i></a>';
	$btn_reset_password = '<button type="submit" class="btn btn-tbl-delete btn-xs ressetPass bg-info" data-id="$id"><i class="fa fa-refresh"></i></button>';

	$staff_edit = Auth::guard('staff')->user()->can('staff.edit');
	$staff_edit_admins = Auth::guard('staff')->user()->can('staff.edit.admins');

	$staff_destroy = Auth::guard('staff')->user()->can('staff.destroy');
	$staff_destroy_admins = Auth::guard('staff')->user()->can('staff.destroy.admins');
	

	$staff_reset_password = Auth::guard('staff')->user()->can('staff.reset.password');
	$staff_reset_password_admins = Auth::guard('staff')->user()->can('staff.reset.password.admins');




	if (!$staff_edit_admins && !$staff_edit) {
		$btn_edit = '<button type="button" class="btn btn-tbl-delete btn-xs" style="visibility: hidden;"><i class="fa fa-pencil"></i></button>';
	} elseif (!$staff_edit_admins && $staff_edit) {
		if ($roles[0]['name'] == 'administrator') {
			$btn_edit = '<button type="button" class="btn btn-tbl-delete btn-xs" style="visibility: hidden;"><i class="fa fa-pencil"></i></button>';
		}
	} elseif ($staff_edit_admins && !$staff_edit) {
		if ($roles[0]['name'] != 'administrator') {
			$btn_edit = '<a href="'.route("staff.staff.edit", $id).'" class="btn btn-tbl-edit btn-xs editar-staff"><i class="fa fa-pencil"></i></a>';
		}
	} elseif ($staff_edit_admins && $staff_edit) {
		$btn_edit = '<a href="'.route("staff.staff.edit", $id).'" class="btn btn-tbl-edit btn-xs editar-staff"><i class="fa fa-pencil"></i></a>';
	}

	if (!$staff_destroy_admins && !$staff_destroy) {
		$btn_delete = '<button type="button" class="btn btn-tbl-delete btn-xs" style="visibility: hidden;"><i class="fa fa-trash-o"></i></button>';	
	} elseif (!$staff_destroy_admins && $staff_destroy) {
		if ($roles[0]['name'] == 'administrator') {
			$btn_delete = '<button type="button" class="btn btn-tbl-delete btn-xs" style="visibility: hidden;"><i class="fa fa-trash-o"></i></button>';	
		}
	} elseif ($staff_destroy_admins && !$staff_destroy) {
		if ($roles[0]['name'] != 'administrator') {
			$btn_delete = '<button type="submit" class="btn btn-tbl-delete btn-xs eliminar" data-id="'. $id .'"><i class="fa fa-trash-o"></i></button>';
		}
	} elseif ($staff_destroy_admins && $staff_destroy) {
		$btn_delete = '<button type="submit" class="btn btn-tbl-delete btn-xs eliminar" data-id="'. $id .'"><i class="fa fa-trash-o"></i></button>';
	}

	if (!$staff_reset_password_admins && !$staff_reset_password) {
		$btn_reset_password = '<button type="submit" class="btn btn-tbl-delete btn-xs bg-info"><i class="fa fa-refresh"></i></button>';
	} elseif (!$staff_reset_password_admins && $staff_reset_password) {
		if ($roles[0]['name'] == 'administrator') {
			$btn_reset_password = '<button type="submit" class="btn btn-tbl-delete btn-xs bg-info"><i class="fa fa-refresh"></i></button>';
		}
	} elseif ($staff_reset_password_admins && !$staff_reset_password) {
		if ($roles[0]['name'] != 'administrator') {
			$btn_reset_password = '<button type="submit" class="btn btn-tbl-delete btn-xs ressetPass bg-info" data-id="'.$id.'><i class="fa fa-refresh"></i></button>';
		}
	} elseif ($staff_reset_password_admins && $staff_reset_password) {
		$btn_reset_password = '<button type="submit" class="btn btn-tbl-delete btn-xs ressetPass bg-info" data-id="'.$id.'"><i class="fa fa-refresh"></i></button>';
	}

@endphp


@if (Auth::guard('staff')->user()->id != $id && Auth::guard('staff')->user()->can('staff.create.permisions.admins'))
	{!! $btn_edit !!}
@endif
@if (Auth::guard('staff')->user()->id != $id )
	{!! $btn_delete !!}
	{{-- {!! $btn_reset_password !!} --}}
@endif


