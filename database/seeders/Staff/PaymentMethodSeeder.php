<?php

namespace Database\Seeders\Staff;

use Illuminate\Database\Seeder;
use DB;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_methods')->insert([

        	[
            	'id' => 1,
				'code' => '01',
				'description_es' => 'Efectivo',
				'description_en' => 'Cash',
				'active' => true
			],
			[
				'id' => 2,
				'code' => '02',
				'description_es' => 'Cheque nominativo',
				'description_es' => 'Check',
				'active' => true
			],
			[
				'id' => 3,
				'code' => '03',
				'description_es' => 'Transferencia electrónica de fondos',
                'descripcion_en' => 'Wire Transfer',
				'active' => true
			],
			[
				'id' => 4,
				'code' => '04',
				'description_es' => 'Tarjeta de crédito',
				'description_es' => 'Credid Card',
				'active' => true
			],
			[
				'id' => 5,
				'code' => '05',
				'description_es' => 'Monedero electrónico',
                'description_en' => 'Electronic wallet',
				'active' => true
			],
			[
				'id' => 6,
				'code' => '06',
				'description_es' => 'Dinero electrónico',
                'description_en' => 'Electronic money',
				'active' => true
			],
			[
				'id' => 7,
				'code' => '08',
				'description_es' => 'Vales de despensa',
				'description_en' => 'Pantry vouchers',
				'active' => true
			],
			[
				'id' => 8,
				'code' => '12',
				'description_es' => 'Dación en pago',
				'description_es' => 'Dación en pago',
				'active' => true
			],
			[
				'id' => 9,
				'code' => '13',
				'description_es' => 'Pago por subrogación',
                'description_en' => 'Surrogacy payment',
				'active' => true
			],
			[
				'id' => 10,
				'code' => '14',
				'description_es' => 'Pago por consignación',
				'description_es' => 'Payment by consignment',
				'active' => true
			],
			[
				'id' => 11,
				'code' => '15',
				'description_es' => 'Condonación',
                'description_en' => 'Condonation',
				'active' => true
			],
			[
				'id' => 12,
				'code' => '17',
				'description_es' => 'Compensación',
				'description_es' => 'Compensation',
				'active' => true
			],
			[
				'id' => 13,
				'code' => '23',
				'description_es' => 'Novación',
				'description_es' => 'Novation',
				'active' => true
			],
			[
				'id' => 14,
				'code' => '24',
				'description_es' => 'Confusión',
				'description_es' => 'Confusion',
				'active' => true
			],
			[
				'id' => 15,
				'code' => '25',
				'description_es' => 'Remisión de deuda',
				'description_es' => 'Debt remittance',
				'active' => true
			],
			[
				'id' => 16,
				'code' => '26',
				'description_es' => 'Prescripción o caducidad',
				'description_es' => 'Prescription or expiration',
				'active' => true
			],
			[
				'id' => 17,
				'code' => '27',
				'description_es' => 'A satisfacción del acreedor',
                'description_en' => 'To the satisfaction of the creditor',
				'active' => true
			],
			[
				'id' => 18,
				'code' => '28',
				'description_es' => 'Tarjeta de débito',
				'description_es' => 'debit Card',
				'active' => true
			],
			[
				'id' => 19,
				'code' => '29',
				'description_es' => 'Tarjeta de servicios',
                'description_en' => 'Services card',
				'active' => true
			],
			[
				'id' => 20,
				'code' => '30',
				'description_es' => 'Aplicación de anticipos',
				'description_es' => 'Application of advances',
				'active' => true
			],
			[
				'id' => 21,
				'code' => '99',
				'description_es' => 'To define                ',
				'active' => true
			],
        ]);
    }
}
