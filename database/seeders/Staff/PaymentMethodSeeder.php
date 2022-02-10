<?php

namespace Database\Seeders\Staff;

use DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
				'active' => true,
				'code' => time().uniqid(Str::random(30)),
			],
			[
				'id' => 2,
				'code' => '02',
				'description_es' => 'Cheque nominativo',
				'description_en' => 'Check',
				'active' => true,
				'code' => time().uniqid(Str::random(30)),
			],
			[
				'id' => 3,
				'code' => '03',
				'description_es' => 'Transferencia electrónica de fondos',
                'descripcion_en' => 'Wire Transfer',
				'active' => true,
				'code' => time().uniqid(Str::random(30)),
			],
			[
				'id' => 4,
				'code' => '04',
				'description_es' => 'Tarjeta de crédito',
				'description_en' => 'Credid Card',
				'active' => true,
				'code' => time().uniqid(Str::random(30)),
			],
			[
				'id' => 5,
				'code' => '05',
				'description_es' => 'Monedero electrónico',
                'description_en' => 'Electronic wallet',
				'active' => false,
				'code' => time().uniqid(Str::random(30)),
			],
			[
				'id' => 6,
				'code' => '06',
				'description_es' => 'Dinero electrónico',
                'description_en' => 'Electronic money',
				'active' => false,
				'code' => time().uniqid(Str::random(30)),
			],
			[
				'id' => 7,
				'code' => '08',
				'description_es' => 'Vales de despensa',
				'description_en' => 'Pantry vouchers',
				'active' => false,
				'code' => time().uniqid(Str::random(30)),
			],
			[
				'id' => 8,
				'code' => '12',
				'description_es' => 'Dación en pago',
				'description_en' => 'Dación en pago',
				'active' => false,
				'code' => time().uniqid(Str::random(30)),
			],
			[
				'id' => 9,
				'code' => '13',
				'description_es' => 'Pago por subrogación',
                'description_en' => 'Surrogacy payment',
				'active' => false,
				'code' => time().uniqid(Str::random(30)),
			],
			[
				'id' => 10,
				'code' => '14',
				'description_es' => 'Pago por consignación',
				'description_en' => 'Payment by consignment',
				'active' => false,
				'code' => time().uniqid(Str::random(30)),
			],
			[
				'id' => 11,
				'code' => '15',
				'description_es' => 'Condonación',
                'description_en' => 'Condonation',
				'active' => false,
				'code' => time().uniqid(Str::random(30)),
			],
			[
				'id' => 12,
				'code' => '17',
				'description_es' => 'Compensación',
				'description_en' => 'Compensation',
				'active' => false,
				'code' => time().uniqid(Str::random(30)),
			],
			[
				'id' => 13,
				'code' => '23',
				'description_es' => 'Novación',
				'description_en' => 'Novation',
				'active' => false,
				'code' => time().uniqid(Str::random(30)),
			],
			[
				'id' => 14,
				'code' => '24',
				'description_es' => 'Confusión',
				'description_en' => 'Confusion',
				'active' => false,
				'code' => time().uniqid(Str::random(30)),
			],
			[
				'id' => 15,
				'code' => '25',
				'description_es' => 'Remisión de deuda',
				'description_en' => 'Debt remittance',
				'active' => false,
				'code' => time().uniqid(Str::random(30)),
			],
			[
				'id' => 16,
				'code' => '26',
				'description_es' => 'Prescripción o caducidad',
				'description_en' => 'Prescription or expiration',
				'active' => false,
				'code' => time().uniqid(Str::random(30)),
			],
			[
				'id' => 17,
				'code' => '27',
				'description_es' => 'A satisfacción del acreedor',
                'description_en' => 'To the satisfaction of the creditor',
				'active' => false,
				'code' => time().uniqid(Str::random(30)),
			],
			[
				'id' => 18,
				'code' => '28',
				'description_es' => 'Tarjeta de débito',
				'description_en' => 'debit Card',
				'active' => false,
				'code' => time().uniqid(Str::random(30)),
			],
			[
				'id' => 19,
				'code' => '29',
				'description_es' => 'Tarjeta de servicios',
                'description_en' => 'Services card',
				'active' => false,
				'code' => time().uniqid(Str::random(30)),
			],
			[
				'id' => 20,
				'code' => '30',
				'description_es' => 'Aplicación de anticipos',
				'description_en' => 'Application of advances',
				'active' => false,
				'code' => time().uniqid(Str::random(30)),
			],
			[
				'id' => 21,
				'code' => '99',
				'description_es' => 'Por definir',
				'description_en' => 'To define',
				'active' => false,
				'code' => time().uniqid(Str::random(30)),
			],
        ]);
    }
}
