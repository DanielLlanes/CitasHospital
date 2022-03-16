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
				'name_es' => 'Efectivo',
				'name_en' => 'Cash',
				'active' => true,
				'code' => time().uniqid(Str::random(30)),
			],
			[
				'id' => 2,
				'code' => '02',
				'name_es' => 'Cheque nominativo',
				'name_en' => 'Check',
				'active' => true,
				'code' => time().uniqid(Str::random(30)),
			],
			[
				'id' => 3,
				'code' => '03',
				'name_es' => 'Transferencia electrónica de fondos',
                'name_en' => 'Wire Transfer',
				'active' => true,
				'code' => time().uniqid(Str::random(30)),
			],
			[
				'id' => 4,
				'code' => '04',
				'name_es' => 'Tarjeta de crédito',
				'name_en' => 'Credid Card',
				'active' => true,
				'code' => time().uniqid(Str::random(30)),
			],
			[
				'id' => 5,
				'code' => '05',
				'name_es' => 'Monedero electrónico',
                'name_en' => 'Electronic wallet',
				'active' => false,
				'code' => time().uniqid(Str::random(30)),
			],
			[
				'id' => 6,
				'code' => '06',
				'name_es' => 'Dinero electrónico',
                'name_en' => 'Electronic money',
				'active' => false,
				'code' => time().uniqid(Str::random(30)),
			],
			[
				'id' => 7,
				'code' => '08',
				'name_es' => 'Vales de despensa',
				'name_en' => 'Pantry vouchers',
				'active' => false,
				'code' => time().uniqid(Str::random(30)),
			],
			[
				'id' => 8,
				'code' => '12',
				'name_es' => 'Dación en pago',
				'name_en' => 'Dación en pago',
				'active' => false,
				'code' => time().uniqid(Str::random(30)),
			],
			[
				'id' => 9,
				'code' => '13',
				'name_es' => 'Pago por subrogación',
                'name_en' => 'Surrogacy payment',
				'active' => false,
				'code' => time().uniqid(Str::random(30)),
			],
			[
				'id' => 10,
				'code' => '14',
				'name_es' => 'Pago por consignación',
				'name_en' => 'Payment by consignment',
				'active' => false,
				'code' => time().uniqid(Str::random(30)),
			],
			[
				'id' => 11,
				'code' => '15',
				'name_es' => 'Condonación',
                'name_en' => 'Condonation',
				'active' => false,
				'code' => time().uniqid(Str::random(30)),
			],
			[
				'id' => 12,
				'code' => '17',
				'name_es' => 'Compensación',
				'name_en' => 'Compensation',
				'active' => false,
				'code' => time().uniqid(Str::random(30)),
			],
			[
				'id' => 13,
				'code' => '23',
				'name_es' => 'Novación',
				'name_en' => 'Novation',
				'active' => false,
				'code' => time().uniqid(Str::random(30)),
			],
			[
				'id' => 14,
				'code' => '24',
				'name_es' => 'Confusión',
				'name_en' => 'Confusion',
				'active' => false,
				'code' => time().uniqid(Str::random(30)),
			],
			[
				'id' => 15,
				'code' => '25',
				'name_es' => 'Remisión de deuda',
				'name_en' => 'Debt remittance',
				'active' => false,
				'code' => time().uniqid(Str::random(30)),
			],
			[
				'id' => 16,
				'code' => '26',
				'name_es' => 'Prescripción o caducidad',
				'name_en' => 'Prescription or expiration',
				'active' => false,
				'code' => time().uniqid(Str::random(30)),
			],
			[
				'id' => 17,
				'code' => '27',
				'name_es' => 'A satisfacción del acreedor',
                'name_en' => 'To the satisfaction of the creditor',
				'active' => false,
				'code' => time().uniqid(Str::random(30)),
			],
			[
				'id' => 18,
				'code' => '28',
				'name_es' => 'Tarjeta de débito',
				'name_en' => 'debit Card',
				'active' => false,
				'code' => time().uniqid(Str::random(30)),
			],
			[
				'id' => 19,
				'code' => '29',
				'name_es' => 'Tarjeta de servicios',
                'name_en' => 'Services card',
				'active' => false,
				'code' => time().uniqid(Str::random(30)),
			],
			[
				'id' => 20,
				'code' => '30',
				'name_es' => 'Aplicación de anticipos',
				'name_en' => 'Application of advances',
				'active' => false,
				'code' => time().uniqid(Str::random(30)),
			],
			[
				'id' => 21,
				'code' => '99',
				'name_es' => 'Por definir',
				'name_en' => 'To define',
				'active' => false,
				'code' => time().uniqid(Str::random(30)),
			],
        ]);
    }
}
