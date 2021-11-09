<?php

namespace Database\Seeders\Staff;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	app()['cache']->forget('spatie.permission.cache');
        //Permission list
        //calendar
        Permission::create([
            'name' => 'calendar.list',
            'guard_name' => 'staff',
            'description_es' => 'Mostrar eventos calendario',
            'group_es' => 'Calendario',
            'description_en' => 'Show calendar events',
            'group_en' => 'Calendar'
        ]);
        Permission::create([
            'name' => 'calendar.edit',
            'guard_name' => 'staff',
            'description_es' => 'Editar eventos de calendario',
            'group_es' => 'Calendario',
            'description_en' => 'Edit calendar events',
            'group_en' => 'Calendar'
        ]);
        Permission::create([
            'name' => 'calendar.create',
            'guard_name' => 'staff',
            'description_es' => 'Crear eventos de calendario',
            'group_es' => 'Calendario',
            'description_en' => 'Create calendar events',
            'group_en' => 'Calendar'
        ]);
        Permission::create([
            'name' => 'calendar.destroy',
            'guard_name' => 'staff',
            'description_es' => 'Eliminar eventos de calendario',
            'group_es' => 'Calendario',
            'description_en' => 'Delete calendar events',
            'group_en' => 'Calendar'
        ]);
        Permission::create([
            'name' => 'calendar.show',
            'guard_name' => 'staff',
            'description_es' => 'ver detalles de eventos',
            'group_es' => 'Calendario',
            'description_en' => 'view event details',
            'group_en' => 'Calendar'
        ]);

        //team
        Permission::create([
            'name' => 'staff.list',
            'guard_name' => 'staff',
            'description_es' => 'Mostrar listado personal',
            'group_es' => 'Personal',
            'description_en' => 'Show staff list',
            'group_en' => 'Staff'
        ]);
        Permission::create([
            'name' => 'staff.create',
            'guard_name' => 'staff',
            'description_es' => 'Crear miembros del staff',
            'group_es' => 'Personal',
            'description_en' => 'Create staff',
            'group_en' => 'Staff'
        ]);
        Permission::create([
            'name' => 'staff.edit',
            'guard_name' => 'staff',
            'description_es' => 'Editar personal',
            'group_es' => 'Personal',
            'description_en' => 'Edit staff',
            'group_en' => 'Staff'
        ]);
        Permission::create([
            'name' => 'staff.activate',
            'guard_name' => 'staff',
            'description_es' => 'Activar y desactivar personal',
            'group_es' => 'Personal',
            'description_en' => 'Activate and deactivate staff',
            'group_en' => 'Staff'
        ]);
        Permission::create([
            'name' => 'staff.destroy',
            'guard_name' => 'staff',
            'description_es' => 'Eliminar personal',
            'group_es' => 'Personal',
            'description_en' => 'Delete staff',
            'group_en' => 'Staff'
        ]);
        Permission::create([
            'name' => 'staff.show',
            'guard_name' => 'staff',
            'description_es' => 'ver detalles de personal',
            'group_es' => 'Personal',
            'description_en' => 'view staff details',
            'group_en' => 'Staff'
        ]);
        Permission::create([
            'name' => 'staff.reset.password',
            'guard_name' => 'staff',
            'description_es' => 'Restablecer contraseña del personal',
            'group_es' => 'Personal',
            'description_en' => 'Reset staff password',
            'group_en' => 'Staff'
        ]);
        Permission::create([
            'name' => 'staff.create.permisions',
            'guard_name' => 'staff',
            'description_es' => 'Asignar permisos a personal',
            'group_es' => 'Personal',
            'description_en' => 'Assign permissions to staff',
            'group_en' => 'Staff'
        ]);
        Permission::create([
            'name' => 'staff.edit.permisions',
            'guard_name' => 'staff',
            'description_es' => 'Editar permisos a personal',
            'group_es' => 'Personal',
            'description_en' => 'Edit permissions to staff',
            'group_en' => 'Staff'
        ]);
        //admin
        Permission::create([
            'name' => 'staff.list.admins',
            'guard_name' => 'staff',
            'description_es' => 'Mostrar listado admin\'s',
            'group_es' => 'Administrador',
            'description_en' => 'Show admin\'s list',
            'group_en' => 'Administrator'
        ]);
        Permission::create([
            'name' => 'staff.create.admins',
            'guard_name' => 'staff',
            'description_es' => 'Crear admin\'s',
            'group_es' => 'Administrador',
            'description_en' => 'Create admin\'s',
            'group_en' => 'Administrator'
        ]);
        Permission::create([
            'name' => 'staff.edit.admins',
            'guard_name' => 'staff',
            'description_es' => 'Editar admin\'s',
            'group_es' => 'Administrador',
            'description_en' => 'Edit admin\'s',
            'group_en' => 'Administrator'
        ]);
        Permission::create([
            'name' => 'staff.activate.admins',
            'guard_name' => 'staff',
            'description_es' => 'Activar y desactivar admin\'s',
            'group_es' => 'Administrador',
            'description_en' => 'Activate and deactivate admin\'s',
            'group_en' => 'Administrator'
        ]);
        Permission::create([
            'name' => 'staff.destroy.admins',
            'guard_name' => 'staff',
            'description_es' => 'Eliminar admin\'s',
            'group_es' => 'Administrador',
            'description_en' => 'Delete admin\'s',
            'group_en' => 'Administrator'
        ]);
        Permission::create([
            'name' => 'staff.show.admins',
            'guard_name' => 'staff',
            'description_es' => 'ver detalles de admin\'s',
            'group_es' => 'Administrador',
            'description_en' => 'view admin\'s details',
            'group_en' => 'Administrator'
        ]);
        Permission::create([
            'name' => 'staff.reset.password.admins',
            'guard_name' => 'staff',
            'description_es' => 'Restablecer contraseña de admin\'s',
            'group_es' => 'Administrador',
            'description_en' => 'Reset admin\'s password',
            'group_en' => 'Administrator'
        ]);
        Permission::create([
            'name' => 'staff.create.permisions.admins',
            'guard_name' => 'staff',
            'description_es' => 'Asignar permisos a admin\'s',
            'group_es' => 'Administrador',
            'description_en' => 'Assign permissions to Admin\'s',
            'group_en' => 'Administrator'
        ]);
        Permission::create([
            'name' => 'staff.edit.permisions.admins',
            'guard_name' => 'staff',
            'description_es' => 'Editar permisos de admin\'s',
            'group_es' => 'Administrador',
            'description_en' => 'Edit permissions to Admin\'s',
            'group_en' => 'Administrator'
        ]);
        // applications
        Permission::create([
            'name' => 'applications.list',
            'guard_name' => 'staff',
            'description_es' => 'Listado aplicaciones',
            'group_es' => 'Aplicaciones',
            'description_en' => 'List applications',
            'group_en' => 'Applications'
        ]);
        Permission::create([
            'name' => 'applications.edit',
            'guard_name' => 'staff',
            'description_es' => 'Editar Aplicaciones',
            'group_es' => 'Aplicaciones',
            'description_en' => 'Editar applications',
            'group_en' => 'Applications'
        ]);
        Permission::create([
            'name' => 'applications.create',
            'guard_name' => 'staff',
            'description_es' => 'Crear aplicaciones',
            'group_es' => 'Aplicaciones',
            'description_en' => 'Create applications',
            'group_en' => 'Applications'
        ]);
        Permission::create([
            'name' => 'applications.destroy',
            'guard_name' => 'staff',
            'description_es' => 'Eliminar aplicaciones',
            'group_es' => 'Aplicaciones',
            'description_en' => 'Delete applications',
            'group_en' => 'Applications'
        ]);
        Permission::create([
            'name' => 'applications.details',
            'guard_name' => 'staff',
            'description_es' => 'Mostrar detalles aplicaciones',
            'group_es' => 'Aplicaciones',
            'description_en' => 'Show applications details',
            'group_en' => 'Applications'
        ]);
        Permission::create([
            'name' => 'applications.setprice',
            'guard_name' => 'staff',
            'description_es' => 'Establecer y editar precio de aplicaciones',
            'group_es' => 'Aplicaciones',
            'description_en' => 'Set and edit app pricing',
            'group_en' => 'Applications'
        ]);
        Permission::create([
            'name' => 'applications.changeStaff',
            'guard_name' => 'staff',
            'description_es' => 'Establecer y editar personal de aplicaciones',
            'group_es' => 'Aplicaciones',
            'description_en' => 'Set and edit application staff',
            'group_en' => 'Applications'
        ]);
        Permission::create([
            'name' => 'applications.show',
            'guard_name' => 'staff',
            'description_es' => 'Ver detalles de aplications',
            'group_es' => 'Aplicaciones',
            'description_en' => 'View aplication details',
            'group_en' => 'Applications'
        ]);
        //patients
        Permission::create([
            'name' => 'patients.list',
            'guard_name' => 'staff',
            'description_es' => 'Mostrar listado Pacientes',
            'group_es' => 'Pacientes',
            'description_en' => 'Show patients list',
            'group_en' => 'Patients'
        ]);
        Permission::create([
            'name' => 'patients.edit',
            'guard_name' => 'staff',
            'description_es' => 'Editar información pacientes',
            'group_es' => 'Pacientes',
            'description_en' => 'Edit patients info',
            'group_en' => 'Patients'
        ]);
        Permission::create([
            'name' => 'patients.create',
            'guard_name' => 'staff',
            'description_es' => 'Crear nuevos pacientes',
            'group_es' => 'Pacientes',
            'description_en' => 'Create new patients',
            'group_en' => 'Patients'
        ]);
        Permission::create([
            'name' => 'patients.destroy',
            'guard_name' => 'staff',
            'description_es' => 'Eliminar Pacientes',
            'group_es' => 'Pacientes',
            'description_en' => 'Delete patients',
            'group_en' => 'Patients'
        ]);
        Permission::create([
            'name' => 'patients.details',
            'guard_name' => 'staff',
            'description_es' => 'Ver información de pacientes',
            'group_es' => 'Pacientes',
            'description_en' => 'View patient information',
            'group_en' => 'Patients'
        ]);
        Permission::create([
            'name' => 'patients.show',
            'guard_name' => 'staff',
            'description_es' => 'ver datos generales de patientes',
            'group_es' => 'Pacientes',
            'description_en' => 'view general patient data',
            'group_en' => 'Patients'
        ]);
        
        //payments
        Permission::create([
            'name' => 'payments.list',
            'guard_name' => 'staff',
            'description_es' => 'Mostrar pagos',
            'group_es' => 'packages',
            'description_en' => 'Show payments',
            'group_en' => 'Payments'
        ]);
        Permission::create([
            'name' => 'payments.edit',
            'guard_name' => 'staff',
            'description_es' => 'Editar pagos',
            'group_es' => 'packages',
            'description_en' => 'Edit payments',
            'group_en' => 'Payments'
        ]);
        Permission::create([
            'name' => 'payments.create',
            'guard_name' => 'staff',
            'description_es' => 'Agregar pagos',
            'group_es' => 'packages',
            'description_en' => 'Add payments',
            'group_en' => 'Payments'
        ]);
        Permission::create([
            'name' => 'payments.destroy',
            'guard_name' => 'staff',
            'description_es' => 'Eliminar pagos',
            'group_es' => 'packages',
            'description_en' => 'Delete payments',
            'group_en' => 'Payments'
        ]);
        Permission::create([
            'name' => 'payments.show',
            'guard_name' => 'staff',
            'description_es' => 'Ver detalles de pagos',
            'group_es' => 'packages',
            'description_en' => 'view payments details',
            'group_en' => 'Payments'
        ]);
        //configuration
        Permission::create([
            'name' => 'specialties.list',
            'guard_name' => 'staff',
            'description_es' => 'Mostrar Lista de especialidades',
            'group_es' => 'Especialidades',
            'description_en' => 'Show specialities list',
            'group_en' => 'Specialties'
        ]);
        Permission::create([
            'name' => 'specialties.edit',
            'guard_name' => 'staff',
            'description_es' => 'Editar especialidades',
            'group_es' => 'Procedimientos',
            'description_en' => 'Edit specialties',
            'group_en' => 'Specialties'
        ]);
        Permission::create([
            'name' => 'specialties.create',
            'guard_name' => 'staff',
            'description_es' => 'Crear nuevas especialidades',
            'group_es' => 'Especialidades',
            'description_en' => 'create new specialities',
            'group_en' => 'Specialties'
        ]);
        Permission::create([
            'name' => 'specialties.destroy',
            'guard_name' => 'staff',
            'description_es' => 'Eliminar especialidades',
            'group_es' => 'Especialidades',
            'description_en' => 'Delete specialties',
            'group_en' => 'Specialties'
        ]);
        Permission::create([
            'name' => 'specialties.activate',
            'guard_name' => 'staff',
            'description_es' => 'Activar especialidades',
            'group_es' => 'Especialidades',
            'description_en' => 'Activate specialties',
            'group_en' => 'Specialties'
        ]);
        //Services
        Permission::create([
            'name' => 'services.list',
            'guard_name' => 'staff',
            'description_es' => 'Mostrar Lista de servicios',
            'group_es' => 'Servicios',
            'description_en' => 'Show services list',
            'group_en' => 'Services'
        ]);
        Permission::create([
            'name' => 'services.edit',
            'guard_name' => 'staff',
            'description_es' => 'Editar Servicios',
            'group_es' => 'Servicios',
            'description_en' => 'Edit services',
            'group_en' => 'Services'
        ]);
        Permission::create([
            'name' => 'services.create',
            'guard_name' => 'staff',
            'description_es' => 'Crear nuevos servicios',
            'group_es' => 'Servicios',
            'description_en' => 'create new services',
            'group_en' => 'Services'
        ]);
        Permission::create([
            'name' => 'services.destroy',
            'guard_name' => 'staff',
            'description_es' => 'Eliminar servicios',
            'group_es' => 'Servicios',
            'description_en' => 'Delete services',
            'group_en' => 'Services'
        ]);
        Permission::create([
            'name' => 'services.activate',
            'guard_name' => 'staff',
            'description_es' => 'Activar servicios',
            'group_es' => 'Servicios',
            'description_en' => 'Activate services',
            'group_en' => 'Services'
        ]);
        //packages
        Permission::create([
            'name' => 'packages.list',
            'guard_name' => 'staff',
            'description_es' => 'Mostrar Lista de paquetes',
            'group_es' => 'Paquetes',
            'description_en' => 'Show packages list',
            'group_en' => 'Packages'
        ]);
        Permission::create([
            'name' => 'packages.edit',
            'guard_name' => 'staff',
            'description_es' => 'Editar paquetes',
            'group_es' => 'Paquetes',
            'description_en' => 'Edit packages',
            'group_en' => 'Packages'
        ]);
        Permission::create([
            'name' => 'packages.create',
            'guard_name' => 'staff',
            'description_es' => 'Crear nuevos paquetes',
            'group_es' => 'Paquetes',
            'description_en' => 'create new packages',
            'group_en' => 'Packages'
        ]);
        Permission::create([
            'name' => 'packages.destroy',
            'guard_name' => 'staff',
            'description_es' => 'Eliminar paquetes',
            'group_es' => 'Paquetes',
            'description_en' => 'Edit packages',
            'group_en' => 'Packages'
        ]);
        Permission::create([
            'name' => 'packages.activate',
            'guard_name' => 'staff',
            'description_es' => 'Activar paquetes',
            'group_es' => 'Paquetes',
            'description_en' => 'Activate packages',
            'group_en' => 'Packages'
        ]);
        //Brand
        Permission::create([
            'name' => 'brand.list',
            'guard_name' => 'staff',
            'description_es' => 'Mostrar lista de marcas',
            'group_es' => 'Marcas',
            'description_en' => 'Show brand list',
            'group_en' => 'Brands'
        ]);
        Permission::create([
            'name' => 'brand.edit',
            'guard_name' => 'staff',
            'description_es' => 'Editar marcas',
            'group_es' => 'Marcas',
            'description_en' => 'Edit brand',
            'group_en' => 'Brands'
        ]);
        Permission::create([
            'name' => 'brand.create',
            'guard_name' => 'staff',
            'description_es' => 'Crear nuevos marcas',
            'group_es' => 'Marcas',
            'description_en' => 'Create new brand',
            'group_en' => 'Brands'
        ]);
        Permission::create([
            'name' => 'brand.destroy',
            'guard_name' => 'staff',
            'description_es' => 'Eliminar marcas',
            'group_es' => 'Marcas',
            'description_en' => 'Delete brand',
            'group_en' => 'Brands'
        ]);
        Permission::create([
            'name' => 'brand.activate',
            'guard_name' => 'staff',
            'description_es' => 'Activar marcas',
            'group_es' => 'Marcas',
            'description_en' => 'Activate brand',
            'group_en' => 'Brands'
        ]);
        //procedures
        Permission::create([
            'name' => 'procedures.list',
            'guard_name' => 'staff',
            'description_es' => 'Mostrar listade Procedimientos',
            'group_es' => 'Procedimientos',
            'description_en' => 'Show procedures list',
            'group_en' => 'Procedures'
        ]);
        Permission::create([
            'name' => 'procedures.edit',
            'guard_name' => 'staff',
            'description_es' => 'Editar Procedimientos',
            'group_es' => 'Procedimientos',
            'description_en' => 'Edit procedures',
            'group_en' => 'Procedures'
        ]);
        Permission::create([
            'name' => 'procedures.create',
            'guard_name' => 'staff',
            'description_es' => 'Crear nuevos Procedimientos',
            'group_es' => 'Procedimientos',
            'description_en' => 'Create new procedures',
            'group_en' => 'Procedures'
        ]);
        Permission::create([
            'name' => 'procedures.destroy',
            'guard_name' => 'staff',
            'description_es' => 'Eliminar Procedimientos',
            'group_es' => 'Procedimientos',
            'description_en' => 'Delete procedures',
            'group_en' => 'Procedures'
        ]);
        Permission::create([
            'name' => 'procedures.activate',
            'guard_name' => 'staff',
            'description_es' => 'Activar Procedimientos',
            'group_es' => 'Procedimientos',
            'description_en' => 'Activate procedures',
            'group_en' => 'Procedures'
        ]);
        //Treatment
        Permission::create([
            'name' => 'treatment.list',
            'guard_name' => 'staff',
            'description_es' => 'Mostrar Lista de tratamientos',
            'group_es' => 'Tratamientos',
            'description_en' => 'Show treatment list',
            'group_en' => 'Treatment'
        ]);
        Permission::create([
            'name' => 'treatment.edit',
            'guard_name' => 'staff',
            'description_es' => 'Editar tratamientos',
            'group_es' => 'Tratamientos',
            'description_en' => 'Edit treatment',
            'group_en' => 'Treatment'
        ]);
        Permission::create([
            'name' => 'treatment.create',
            'guard_name' => 'staff',
            'description_es' => 'Crear nuevos tratamientos',
            'group_es' => 'Tratamientos',
            'description_en' => 'create new treatment',
            'group_en' => 'Treatment'
        ]);
        Permission::create([
            'name' => 'treatment.destroy',
            'guard_name' => 'staff',
            'description_es' => 'Eliminar tratamientos',
            'group_es' => 'Tratamientos',
            'description_en' => 'Edit treatment',
            'group_en' => 'Treatment'
        ]);
        Permission::create([
            'name' => 'treatment.activate',
            'guard_name' => 'staff',
            'description_es' => 'Activar tratamientos',
            'group_es' => 'Tratamientos',
            'description_en' => 'Activate treatment',
            'group_en' => 'Treatment'
        ]);

        //Dashboard
        Permission::create([
            'name' => 'dashboard.wiew',
            'guard_name' => 'staff',
            'description_es' => 'Ver tablero',
            'group_es' => 'Tablero',
            'description_en' => 'view dashboard',
            'group_en' => 'Dashboard'
        ]);

    }
}
