<?php

namespace Database\Seeders\Site;

use App\Models\Site\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Faq::create([
            'question_en' => 'When can I drink alcohol?',
            'awnser_en' => 'Preferably one year after surgery.',
            'question_es' => '¿Cuándo puedo beber alcohol?',
            'awnser_es' => 'Preferiblemente un año después de la cirugía.',
        ]);
        Faq::create([
            'question_en' => 'When can I exercise?',
            'awnser_en' => 'Low impact exercise can be done 3 weeks post op, weight lifting two months post op.',
            'question_es' => '¿Cuándo puedo hacer ejercicio?',
            'awnser_es' => 'El ejercicio de bajo impacto se puede hacer 3 semanas después de la operación y el levantamiento de pesas dos meses después de la operación.',
        ]);
        Faq::create([
            'question_en' => 'When can I sunbathe?',
            'awnser_en' => 'One month after surgery.',
            'question_es' => '¿Cuándo puedo tomar el sol?',
            'awnser_es' => 'Un mes después de la cirugía.',
        ]);
        Faq::create([
            'question_en' => 'When can I have sex?',
            'awnser_en' => 'One month after surgery.',
            'question_es' => '¿Cuándo puedo tener relaciones sexuales?',
            'awnser_es' => 'Dos semanas después de la cirugía.',
        ]);
        Faq::create([
            'question_en' => 'When can I do my regular activities?',
            'awnser_en' => 'Right after surgery, as long it is not involves heavy lifting or straining.',
            'question_es' => '¿Cuándo puedo realizar mis actividades habituales?',
            'awnser_es' => 'Inmediatamente después de la cirugía, siempre que no implique levantar objetos pesados ​​o hacer esfuerzos.',
        ]);
        Faq::create([
            'question_en' => 'When can I use a body shaper?',
            'awnser_en' => 'One week after surgery.',
            'question_es' => '¿Cuándo puedo usar un modelador de cuerpo?',
            'awnser_es' => 'Una semana después de la cirugía.',
        ]);
        Faq::create([
            'question_en' => 'Is it normal to have acne after surgery?',
            'awnser_en' => 'The body changes with surgery, and among these changes, some patients can experience acne..',
            'question_es' => '¿Es normal tener acné después de la cirugía?',
            'awnser_es' => 'El cuerpo cambia con la cirugía y, entre estos cambios, algunos pacientes pueden experimentar acné..',
        ]);
        Faq::create([
            'question_en' => 'Is it normal that my hair falls after surgery?',
            'awnser_en' => 'Yes, its normal. Some patients can experience hair loss after surgery, its temporary and it will start regrowing by itself around 6 months after.',
            'question_es' => '¿Es normal que mi cabello se caiga después de la cirugía?',
            'awnser_es' => 'Sí, es normal. Algunos pacientes pueden experimentar pérdida de cabello después de la cirugía, es temporal y comenzará a crecer por sí solo alrededor de 6 meses después.',
        ]);
        Faq::create([
            'question_en' => 'Can I take vitamins/gummy vitamins?',
            'awnser_en' => 'Yes, take a normal dose for an adult.',
            'question_es' => '¿Puedo tomar vitaminas / vitaminas gomosas?',
            'awnser_es' => 'Sí, tome una dosis normal para un adulto.',
        ]);
        Faq::create([
            'question_en' => 'When can I start weight lifting?',
            'awnser_en' => 'Two months after surgery.',
            'question_es' => '¿Cuándo puedo empezar a levantar pesas?',
            'awnser_es' => 'Dos meses después de la cirugía.',
        ]);
        Faq::create([
            'question_en' => 'When can I ride a roller coaster?',
            'awnser_en' => 'One month after surgery.',
            'question_es' => '¿Cuándo puedo subirme a una montaña rusa?',
            'awnser_es' => 'Un mes después de la cirugía.',
        ]);
        Faq::create([
            'question_en' => 'When can I swim?',
            'awnser_en' => 'Two weeks after surgery.',
            'question_es' => '¿Cuándo puedo nadar?',
            'awnser_es' => 'Dos semanas después de la cirugía.',
        ]);
        Faq::create([
            'question_en' => 'How long does the stall last?',
            'awnser_en' => 'It depends, don’t get unmotivated. For most patients during the stall, they tend to lose clothes sizes.',
            'question_es' => '¿Cuánto dura el puesto?',
            'awnser_es' => 'Depende, no te desmotives. Para la mayoría de los pacientes durante el puesto, tienden a perder tallas de ropa.',
        ]);
        Faq::create([
            'question_en' => 'When can I have solid food?',
            'awnser_en' => 'When your body allows it. It varies from patient to patient, and in some cases it can take up to two months.',
            'question_es' => '¿Cuándo puedo tomar alimentos sólidos?',
            'awnser_es' => 'Cuando su cuerpo lo permita. Varía de un paciente a otro, y en algunos casos puede tardar hasta dos meses.',
        ]);
        Faq::create([
            'question_en' => 'When can I get pregnant?',
            'awnser_en' => 'The best time to get pregnant after bariatric surgery is two years post op. But after a year, the risks get lower. (risks of having a miscarriage, the baby being born with low birth weight).',
            'question_es' => '¿Cuándo puedo quedar embarazada?',
            'awnser_es' => 'El mejor momento para quedarse embarazada después de una operación bariátrica es a los dos años. Pero después de un año, los riesgos son menores. (riesgos de tener un aborto espontáneo, de que el bebé nazca con bajo peso).',
        ]);
        Faq::create([
            'question_en' => 'When can I get a tanning?',
            'awnser_en' => 'One month after surgery.',
            'question_es' => '¿Cuándo me puedo broncear?',
            'awnser_es' => 'Un mes después de la cirugía.',
        ]);
        Faq::create([
            'question_en' => 'Can we use crystal light in pre op diet?',
            'awnser_en' => 'Yes.',
            'question_es' => '¿Podemos usar crystal light en la dieta preoperatoria?',
            'awnser_es' => 'Si.',
        ]);
        Faq::create([
            'question_en' => 'While in pre op diet can we take our regular medicine?',
            'awnser_en' => 'During the pre op diet you have to keep taking your regular medications..',
            'question_es' => '¿Mientras estemos en la dieta pre operatoria podemos tomar nuestra medicina regular?',
            'awnser_es' => 'Durante la dieta pre operatoria tienes que seguir tomando tus medicamentos habituales.',
        ]);
        Faq::create([
            'question_en' => 'Can I have coffee on the pre op diet',
            'awnser_en' => 'No.',
            'question_es' => '¿Puedo tomar café con la dieta preoperatoria?',
            'awnser_es' => 'No.',
        ]);
    }
}
