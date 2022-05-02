<?php

namespace Database\Seeders\Site;

use App\Models\Site\Faq;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
            'order' => '1',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'When can I exercise?',
            'awnser_en' => 'Low impact exercise can be done 4 weeks post op, weight lifting two months post op.',
            'question_es' => '¿Cuándo puedo hacer ejercicio?',
            'awnser_es' => 'El ejercicio de bajo impacto se puede hacer 3 semanas después de la operación y el levantamiento de pesas dos meses después de la operación.',
            'order' => '2',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'When can I sunbathe?',
            'awnser_en' => 'One month after surgery.',
            'question_es' => '¿Cuándo puedo tomar el sol?',
            'awnser_es' => 'Un mes después de la cirugía.',
            'order' => '3',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'When can I have sexual relations?',
            'awnser_en' => 'Two weeks after surgery.',
            'question_es' => '¿Cuándo puedo tener relaciones sexuales?',
            'awnser_es' => 'Dos semanas después de la cirugía.',
            'order' => '4',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'When can I do my regular activities?',
            'awnser_en' => 'Right after surgery, as long it is not involves heavy lifting 15 lbs and over or straining.',
            'question_es' => '¿Cuándo puedo realizar mis actividades habituales?',
            'awnser_es' => 'Inmediatamente después de la cirugía, siempre y cuando no implique levantar objetos pesados ​​de 15 libras o más o esforzarse.',
            'order' => '5',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'When can I use a body shaper?',
            'awnser_en' => 'One week after surgery.',
            'question_es' => '¿Cuándo puedo usar un modelador de cuerpo?',
            'awnser_es' => 'Una semana después de la cirugía.',
            'order' => '6',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'Is it normal to have acne after surgery?',
            'awnser_en' => 'The body changes with surgery, and among these changes, some patients can experience acne, always remember... everyone is different',
            'question_es' => '¿Es normal tener acné después de la cirugía?',
            'awnser_es' => 'El cuerpo cambia con la cirugía, y entre estos cambios, algunos pacientes pueden experimentar acné, recuerda siempre... cada uno es diferente',
            'order' => '7',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'Is it normal that my hair falls after surgery?',
            'awnser_en' => 'Yes, its normal. Some patients can experience hair loss after surgery, its temporary and it will start regrowing by itself around 6 months after... Always remember... everyone is different ',
            'question_es' => '¿Es normal que mi cabello se caiga después de la cirugía?',
            'awnser_es' => 'Sí, es normal. Algunos pacientes pueden experimentar pérdida de cabello después de la cirugía, es temporal y comenzará a crecer por sí solo alrededor de 6 meses después...  recuerda siempre... cada uno es diferente',
            'order' => '8',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'Can I take vitamins/gummy vitamins?',
            'awnser_en' => 'Yes, The nutritionist will let you know which vitamins and how often.',
            'question_es' => '¿Puedo tomar vitaminas / vitaminas gomosas?',
            'awnser_es' => 'Sí, el nutriologa te indicará qué vitaminas y con qué frecuencia.',
            'order' => '9',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'When can I start weight lifting?',
            'awnser_en' => 'Two months after surgery.',
            'question_es' => '¿Cuándo puedo empezar a levantar pesas?',
            'awnser_es' => 'Dos meses después de la cirugía.',
            'order' => '10',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'When can I ride a roller coaster?',
            'awnser_en' => 'One month after surgery.',
            'question_es' => '¿Cuándo puedo subirme a una montaña rusa?',
            'awnser_es' => 'Un mes después de la cirugía.',
            'order' => '11',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'When can I swim?',
            'awnser_en' => 'Two weeks after surgery.',
            'question_es' => '¿Cuándo puedo nadar?',
            'awnser_es' => 'Dos semanas después de la cirugía.',
            'order' => '12',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'How long does the stall last?',
            'awnser_en' => 'It depends, don’t get unmotivated. For most patients during the stall, they tend to lose clothes sizes.',
            'question_es' => '¿Cuánto dura el puesto?',
            'awnser_es' => 'Depende, no te desmotives. Para la mayoría de los pacientes durante el puesto, tienden a perder tallas de ropa.',
            'order' => '13',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'When can I have solid food?',
            'awnser_en' => 'When your body allows it. It varies from patient to patient, and in some cases it can take up to two months.
            The nutritionist will guide you but always remember everyone is different.',
            'question_es' => '¿Cuándo puedo tomar alimentos sólidos?',
            'awnser_es' => 'Cuando tu cuerpo te lo permita. Varía de un paciente a otro y, en algunos casos, puede demorar hasta dos meses.
            El nutriologo te guiará pero recuerda siempre que cada persona es diferente.',
            'order' => '14',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'When can I get pregnant?',
            'awnser_en' => 'The best time to get pregnant after bariatric surgery is two years postop. But after a year, the risks get lower. (risks of having a miscarriage, the baby being born with low birth weight).',
            'question_es' => '¿Cuándo puedo quedar embarazada?',
            'awnser_es' => 'El mejor momento para quedarse embarazada después de una operación bariátrica es a los dos años. Pero después de un año, los riesgos son menores. (riesgos de tener un aborto espontáneo, de que el bebé nazca con bajo peso).',
            'order' => '15',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'When can I get a tanning?',
            'awnser_en' => 'One month postop.',
            'question_es' => '¿Cuándo me puedo broncear?',
            'awnser_es' => 'Un mes después de la cirugía.',
            'order' => '16',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'Can we use crystal light in pre-op diet?',
            'awnser_en' => 'Yes.',
            'question_es' => '¿Podemos usar crystal light en la dieta preoperatoria?',
            'awnser_es' => 'Si.',
            'order' => '17',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'While in pre-op diet can we take our regular medicine?',
            'awnser_en' => 'During the pre-op diet you have to continue taking your regular medications (Thyroid, blood pressure, diabetes medication) other medications please ask your coordinator',
            'question_es' => '¿Mientras estemos en la dieta preoperatoria podemos tomar nuestra medicina regular?',
            'awnser_es' => 'Durante la dieta preoperatoria tiene que seguir tomando sus medicamentos habituales (tiroides, presión arterial, medicación para la diabetes) otros medicamentos por favor pregunte a su coordinador.',
            'order' => '18',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'Can I have coffee on the pre op-diet?',
            'awnser_en' => 'No.',
            'question_es' => '¿Puedo tomar café con la dieta preoperatoria?',
            'awnser_es' => 'No.',
            'order' => '19',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'When can you have coffee after surgery?',
            'awnser_en' => 'Preferably one year after surgery. Caffeine can stimulate hunger, and lead you to eat more, and that is why we prefer that you don’t drink coffee or caffeine based drinks.',
            'question_es' => '¿Cuándo se puede tomar café después de una operación?',
            'awnser_es' => 'Preferiblemente un año después de la cirugía. La cafeína puede estimular el hambre, y llevarle a comer más, y por eso preferimos que no tome café o bebidas con cafeína.',
            'order' => '20',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'When can I start working?',
            'awnser_en' => 'Most patients can return to work, with restrictions (no heavy lifting) one week after surgery.',
            'question_es' => '¿Cuándo puedo empezar a trabajar?',
            'awnser_es' => 'La mayoría de los pacientes pueden volver al trabajo, con restricciones (no levantar objetos pesados) una semana después de la cirugía.',
            'order' => '21',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'How long after surgery can I go to my PCP?',
            'awnser_en' => 'Regular visits with your PCP are encouraged, and the first visit is two weeks after surgery.',
            'question_es' => '¿Cuánto tiempo después de la operación puedo acudir a mi médico de cabecera?',
            'awnser_es' => 'Se recomienda visitar regularmente a su médico de cabecera, y la primera visita es dos semanas después de la cirugía.',
            'order' => '22',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'When after surgery can I start taking vitamins?',
            'awnser_en' => 'The body will require vitamins after surgery, and you can start taking them once you finish your post op medication package.
            The Nutritionist will indicate when to start your vitamins.',
            'question_es' => '¿Puedo tomar café con la dieta preoperatoria?',
            'awnser_es' => 'El cuerpo necesitará vitaminas después de la cirugía, y usted puede comenzar a tomarlas una vez que termine su paquete de medicamentos postoperatorios.
            El nutriologo le indicará cuándo debe empezar a tomar las vitaminas.',
            'order' => '23',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'Can I have the procedure done if I am on my period?',
            'awnser_en' => 'Yes.',
            'question_es' => '¿Puedo someterme a la intervención si estoy en periodo de menstruación?',
            'awnser_es' => 'Yes.',
            'order' => '24',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'If I am on my period can I use the blood thinner?',
            'awnser_en' => 'Yes.',
            'question_es' => 'Si estoy con la regla, ¿puedo utilizar el anti coagulante?',
            'awnser_es' => 'Yes.',
            'order' => '25',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'Can I use acrylic nails, nail polish, gel (hands and toes) on surgery?',
            'awnser_en' => 'No, this is to get a better reading of your levels of oxygen.',
            'question_es' => '¿Puedo utilizar uñas acrílicas, esmalte de uñas, gel (manos y dedos de los pies) en la cirugía?',
            'awnser_es' => 'No, esto es para obtener una mejor lectura de sus niveles de oxígeno.',
            'order' => '26',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'Can I chew gum before and after surgery?',
            'awnser_en' => 'No, chewing gum can lead your stomach to produce excess acid, and that in return can produce an ulcer in your stomach.',
            'question_es' => '¿Puedo masticar chicle antes y después de la operación?',
            'awnser_es' => 'No, mascar chicle puede hacer que tu estómago produzca un exceso de ácido, y eso a su vez puede producir una úlcera en tu estómago.',
            'order' => '27',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'What is the boogie size the Dr. uses?',
            'awnser_en' => '36 french.',
            'question_es' => '¿Cuál es la talla de boogie que utiliza el Dr.?',
            'awnser_es' => '36 francés.',
            'order' => '28',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'Can I have the procedure if I have an ulcer?',
            'awnser_en' => 'No. it’s a relative contraindication, but we do not perform surgery on patients with ulcers. You have to get treatment first.',
            'question_es' => '¿Puedo someterme a la intervención si tengo una úlcera?',
            'awnser_es' => 'No. Es una contraindicación relativa, pero no operamos a pacientes con úlceras. Primero tiene que recibir tratamiento.',
            'order' => '29',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'How do I clean my incisions?',
            'awnser_en' => 'During your daily bath, just as you would clean your body and don’t forget to apply your antiseptic spray.',
            'question_es' => '¿Cómo debo limpiar mis incisiones?',
            'awnser_es' => 'Durante el baño diario, al igual que si limpiaras tu cuerpo y no olvides aplicar tu spray antiséptico.',
            'order' => '30',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'What is an endoscopy?',
            'awnser_en' => 'It’s a medical procedure that uses a camera inside a scope, to see the inside of the esophagus, stomach and first part of the intestine.',
            'question_es' => '¿Qué es una endoscopia?',
            'awnser_es' => 's un procedimiento médico que utiliza una cámara dentro de un visor, para ver el interior del esófago, el estómago y la primera parte del intestino.',
            'order' => '31',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'Does the endoscopy hurt?',
            'awnser_en' => 'No, it’s done under sedation, although due to COVID-19 endoscopies are not performed, this is for safety reasons since they are done through the airways.',
            'question_es' => '¿Duele la endoscopia?',
            'awnser_es' => 'No, se realiza bajo anestesia, aunque debido al COVID-19 no se realizan endoscopias, esto es por razones de seguridad ya que se realizan a través de las vías respiratorias',
            'order' => '32',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'Is it normal to feel a pain on the left side of my tummy post-op?',
            'awnser_en' => 'Yes, because of the port sites, you can experience some pain there.',
            'question_es' => '¿Es normal sentir un dolor en el lado izquierdo de mi vientre después de la operación?',
            'awnser_es' => 'Sí, debido a los sitios del puerto, puede experimentar algo de dolor allí.',
            'order' => '33',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'Is sneezing pain normal?',
            'awnser_en' => 'Yes, after surgery, any sudden movements can cause pain.',
            'question_es' => '¿Es normal el dolor al estornudar?',
            'awnser_es' => 'Sí, después de la cirugía, cualquier movimiento brusco puede causar dolor.',
            'order' => '34',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'Is there a reversal for VSG?',
            'awnser_en' => 'No, it’s a permanent surgery.',
            'question_es' => '¿Existe una reversión para la VSG?',
            'awnser_es' => 'No, es una cirugía permanente.',
            'order' => '35',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'What can I do if I hit a Stall?',
            'awnser_en' => 'Stay calm, continue to exercise and eat properly. In time, you will get out of the stall.',
            'question_es' => '¿Qué puedo hacer si me encuentro con un estancamiento?',
            'awnser_es' => 'Mantén la calma, sigue haciendo ejercicio y comiendo bien. Con el tiempo, saldrás del atasco.',
            'order' => '36',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'What are the things we can’t eat after VSG?',
            'awnser_en' => 'Try to stay away from sweets, greasy and high carb foods.',
            'question_es' => '¿Qué cosas no podemos comer después de la VSG?',
            'awnser_es' => 'Intenta mantenerte alejado de los dulces, los alimentos grasos y con alto contenido en carbohidratos.',
            'order' => '37',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'What vitamins can I take post-op?',
            'awnser_en' => 'Any multivitamin is good, The Nutritionist will indicate which vitamins you can take.',
            'question_es' => '¿Qué vitaminas puedo tomar después de la operación?',
            'awnser_es' => 'Cualquier multivitamínico es bueno, la nutrióloga te indicará qué vitaminas puedes tomar.',
            'order' => '38',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'What lab works can I have after post-op?',
            'awnser_en' => 'CBC, complete Blood chemistry, liver function tests, lipid profile, thyroid tests, coagulation tests, blood typing, urinalysis, folic acid, vitamin b12.',
            'question_es' => '¿Qué pruebas de laboratorio puedo realizar después del post operatorio?',
            'awnser_es' => 'Hemograma, química sanguínea completa, pruebas de función hepática, perfil lipídico, pruebas de tiroides, pruebas de coagulación, tipificación sanguínea, análisis de orina, ácido fólico, vitamina b12.',
            'order' => '39',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'What are the risks of not taking the blood thinner? (your surgeon will indicate if you need it post-op) ',
            'awnser_en' => 'Getting a blood clot in your legs. That blood clots can travel to you brain, causing a stroke, travel to your heart, causing a heart attack, and travel to your lungs causing a pulmonary embolism.',
            'question_es' => '¿Cuáles son los riesgos de no tomar el anticoagulante? (su cirujano le indicará si lo necesita en el postoperatorio) ',
            'awnser_es' => 'Tener un coágulo de sangre en las piernas. Los coágulos de sangre pueden viajar a su cerebro, causando un derrame cerebral, viajar a su corazón, causar un ataque cardíaco y viajar a sus pulmones causando una embolia pulmonar.',
            'order' => '40',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'What can I do for hair loss?',
            'awnser_en' => 'If your start losing your hair during the first two years after the surgery, you can take biotin capsules, although they might not help. Eventually it will start regrowing by it self. If its after the two year mark of the surgery, take multivitamins and biotin capsules, increase your protein intake and add a shampoo for hair growth.',
            'question_es' => '¿Qué puedo hacer por la caída del cabello?',
            'awnser_es' => 'Si empiezas a perder el pelo durante los dos primeros años después de la operación, puedes tomar cápsulas de biotina, aunque puede que no te ayuden. Con el tiempo empezará a crecer por sí mismo. Si es después de los dos años de la cirugía, tome multivitaminas y cápsulas de biotina, aumente su consumo de proteínas y añada un champú para el crecimiento del cabello.',
            'order' => '41',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'How long until you can sleep on your tummy or side?',
            'awnser_en' => 'One week average.',
            'question_es' => '¿Cuánto tiempo hasta que pueda dormir boca abajo o de lado?',
            'awnser_es' => 'Promedio de una semana.',
            'order' => '42',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'What do I do in case a have a flu after pneumonia?',
            'awnser_en' => 'Go to your primary physician and get checked out.',
            'question_es' => '¿Qué hago en caso de que tenga gripe después de una neumonía?',
            'awnser_es' => 'Vaya a su médico de cabecera y hágase un chequeo.',
            'order' => '43',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'What are the risks of having a VSG?',
            'awnser_en' => 'Leaks, bleeding, pain, hernia at trocar site.',
            'question_es' => '¿Cuáles son los riesgos de tener un VSG?',
            'awnser_es' => 'Fugas, hemorragia, dolor, hernia en el lugar del trocar.',
            'order' => '44',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'Do I need to crush my pills?',
            'awnser_en' => 'we recommend that you crush your pills the first 3 days after surgery.',
            'question_es' => '¿Necesito triturar mis pastillas?',
            'awnser_es' => 'Sí, le recomendamos que triture sus pastillas los primeros 3 días después de la cirugía.',
            'order' => '45',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'Can I use a medical assistant at the airport?',
            'awnser_en' => 'Yes you can, patient must request it at airport.',
            'question_es' => '¿Cuáles son los riesgos de tener un VSG?',
            'awnser_es' => 'Sí se puede, el paciente debe solicitarlo en el aeropuerto.',
            'order' => '46',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'How long it takes for swelling to go down after surgery?',
            'awnser_en' => 'It varies from person to person, but on average about 7 days',
            'question_es' => '¿Cuánto tiempo tarda en bajar la hinchazón después de la operación?',
            'awnser_es' => 'Varía de una persona a otra, pero la media es de unos 7 días.',
            'order' => '47',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'Is incision draining normal?',
            'awnser_en' => 'If it’s clear, even with a little bit of blood is fine.
            Yellowish or geenish No, you should go to your primary physician and have it checked out.',
            'question_es' => '¿Es normal el drenaje de la incisión?',
            'awnser_es' => 'Si es claro, incluso con un poco de sangre está bien.
            Amarillento o geenish No, usted debe ir a su médico de cabecera y hacer que se revise.',
            'order' => '48',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'What can I take for pain?',
            'awnser_en' => 'Tylenol, aleve.',
            'question_es' => '¿Qué puedo tomar para el dolor?',
            'awnser_es' => 'Tylenol, aleve.',
            'order' => '49',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'Do you fill out FMLA forms?',
            'awnser_en' => 'Yes we do, only after your surgery is performed',
            'question_es' => '¿Completa formularios FMLA?',
            'awnser_es' => 'Sí, lo hacemos, solo después de que se haya realizado la cirugía.',
            'order' => '50',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'What are the benefits of having the VSG?',
            'awnser_en' => 'Weightloss, sometimes complete remission of diabetes and elevated blood pressure, joint pain relief after losing weight.',
            'question_es' => '¿Cuáles son los beneficios de someterse a la VSG?',
            'awnser_es' => 'Pérdida de peso, a veces remisión completa de la diabetes y de la tensión arterial elevada, alivio del dolor articular tras la pérdida de peso.',
            'order' => '51',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'Do I need extra money on the trip?',
            'awnser_en' => 'Yes, in case you want a souvenir.',
            'question_es' => '¿Necesito dinero extra para el viaje?',
            'awnser_es' => 'Sí, por si quieres un souvenir.',
            'order' => '52',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'Do I need to bring a companion?',
            'awnser_en' => 'Not necessarily, you will always be surrounded by members of our staff (nurses, doctors, drivers).',
            'question_es' => '¿Necesito traer una compañera / o?',
            'awnser_es' => 'No necesariamente, siempre estará rodeado de miembros de nuestro personal (enfermeras, médicos, conductores).',
            'order' => '53',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'How long do I have to wear compression socks?',
            'awnser_en' => 'We recommend using the socks for seven days after the surgery.',
            'question_es' => '¿Cuánto tiempo tengo que usar calcetines de compresión?',
            'awnser_es' => 'Recomendamos usar los calcetines durante los siete días posteriores a la cirugía.',
            'order' => '54',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'Why do I need to stop smoking?',
            'awnser_en' => 'Because smoking interferes with the healing process, and it can interfere with your stomach healing properly, causing a leak or bleeding.',
            'question_es' => '¿Por qué debo dejar de fumar?',
            'awnser_es' => 'Porque el tabaquismo interfiere en el proceso de cicatrización, y puede interferir en la correcta cicatrización del estómago, provocando una fuga o una hemorragia.',
            'order' => '55',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'What to expect if there’s a complication after surgery during your stay with us?',
            'awnser_en' => 'If there’s a complication, it will be taken care off, at an extra cost to you, unless the patient purchases one of our plus packages that includes insurance. ',
            'question_es' => '¿Qué se puede esperar si hay una complicación después de la cirugía durante su estancia con nosotros?',
            'awnser_es' => 'Si hay una complicación, será atendida, con un coste adicional para usted, a menos que el paciente adquiera uno de nuestros paquetes plus que incluye un seguro .',
            'order' => '56',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'How long before surgery can I take aspirin?',
            'awnser_en' => 'You have to stop taking aspirin 7 days before surgery.',
            'question_es' => '¿Cuánto tiempo antes de la cirugía puedo tomar aspirina?',
            'awnser_es' => 'Debe dejar de tomar aspirina 7 días antes de la cirugía.',
            'order' => '57',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'What should I ask my pcp to check for me pre-op?',
            'awnser_en' => 'CBC, complete Blood chemistry, liver function tests, lipid profile, thyroid tests, coagulation tests, blood typing, urinalysis, folic acid, vitamin b12.',
            'question_es' => '¿Qué debo pedirle a mi médico que me revise antes de la operación?',
            'awnser_es' => 'Hemograma, química sanguínea completa, pruebas de función hepática, perfil lipídico, pruebas de tiroides, pruebas de coagulación, tipificación sanguínea, análisis de orina, ácido fólico, vitamina b12.',
            'order' => '58',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'Will my Surgeon give me a list of labs and things that my pcp will need to monitor post-op',
            'awnser_en' => 'Yes, as soon as your pcp requests it from Our surgeon, letterhead needed.',
            'question_es' => 'Mi cirujano me dará una lista de laboratorios y cosas que mi doctor de cabezera tendrá que controlar después de la operación',
            'awnser_es' => 'Sí, tan pronto como su PCP lo solicite a nuestro cirujano, con membrete.',
            'order' => '59',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'What should I do if my sugar goes too low on pre-op diet?',
            'awnser_en' => 'You should eat something sweet, like a candy or a piece of fruit, contact the Nutritionist so she can guide you.',
            'question_es' => '¿Qué debo hacer si mi nivel de azúcar baja demasiado en la dieta preoperatoria?',
            'awnser_es' => 'Debes comer algo dulce, como un caramelo o una pieza de fruta, contacta con la nutrióloga para que te oriente.',
            'order' => '60',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'How many oz should I consume after 1 month of surgery',
            'awnser_en' => 'It varies from patient to patient. But it should be around 4 oz, Nutritionist will give you more information on this.',
            'question_es' => '¿Cuántas onzas debo consumir después de un mes de la cirugía?',
            'awnser_es' => 'Varía de un paciente a otro. Pero debe ser alrededor de 4 oz, nutriólogo le dará más información sobre esto.',
            'order' => '61',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'Is sugar free gum ok?',
            'awnser_en' => 'No,  don’t chew gum for it may cause an ulcer.',
            'question_es' => '¿Está bien la goma de mascar sin azúcar?',
            'awnser_es' => 'No, no mastiques chicle porque puede provocar una úlcera.',
            'order' => '62',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'what meds can I take for headache after post-op surgery?',
            'awnser_en' => 'Tylenol, aleve.',
            'question_es' => '¿Qué medicamentos puedo tomar para el dolor de cabeza después de la cirugía posoperatoria?',
            'awnser_es' => 'Tylenol, aleve.',
            'order' => '63',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'At what point after surgery can I eat salads?',
            'awnser_en' => 'When you are on stage 3.',
            'question_es' => '¿En qué momento después de la cirugía puedo comer ensaladas?',
            'awnser_es' => 'Cuando estés en la etapa 3.',
            'order' => '64',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'When do you remove the bandages?',
            'awnser_en' => 'Every day, when you are taking a shower, you should remove the bandages, and place new ones after the shower, for 7 days.',
            'question_es' => '¿Cuándo te quitas los vendajes?',
            'awnser_es' => 'Todos los días, cuando esté tomando una ducha, debe quitarse los vendajes y colocarse unos nuevos después de la ducha, durante 7 días.',
            'order' => '65',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'If my incision over my belly button leaked gunk all night, like a pink color then red, is it normal?',
            'awnser_en' => 'No its not normal, you should go to your primary physician and have it looked at.',
            'question_es' => 'Si mi incisión sobre el ombligo gotea mugre toda la noche, como un color rosa y luego rojo, ¿es normal?',
            'awnser_es' => 'No, no es normal, deberías ir a tu médico de cabecera para que te lo vea.',
            'order' => '66',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'Is Tijuana Mexico a safe city?',
            'awnser_en' => 'Yes it is, in fact we are located just 5 minutes from the international border.',
            'question_es' => '¿Es Tijuana México una ciudad segura?',
            'awnser_es' => 'Sí lo es, de hecho estamos situados a sólo 5 minutos de la frontera internacional.',
            'order' => '67',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'Can I take Phentermine during pre-op?',
            'awnser_en' => 'No, Phentermine (all weight loss pills) must be suspended 2 weeks prior surgery.',
            'question_es' => '¿Puedo tomar Fentermina durante el preoperatorio?',
            'awnser_es' => 'No, la fentermina (todas las pastillas para adelgazar) debe suspenderse 2 semanas antes de la cirugía.',
            'order' => '68',
            'code' => time().uniqid(Str::random(30)),
        ]);

        Faq::create([
            'question_en' => 'Can I smoke marijuana?',
            'awnser_en' => 'No, it must be suspended 5 weeks prior surgery.',
            'question_es' => '¿Puedo fumar marihuana?',
            'awnser_es' => 'No, debe ser suspendido 5 semanas antes de la cirugía.',
            'order' => '69',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'If I take oral contraceptives, can I continue taking them prior to surgery?',
            'awnser_en' => 'No, you need to suspend them 30 days prior to surgery.',
            'question_es' => 'Si tomo anticonceptivos orales, ¿puedo seguir tomándolos antes de la cirugía?',
            'awnser_es' => 'No, hay que suspenderlos 30 días antes de la cirugía.',
            'order' => '70',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'If I have a IUD should I remove it?',
            'awnser_en' => 'If possible, remove it, if not, you can leave it.',
            'question_es' => '¿Si tengo un DIU, ¿debo quitármelo?',
            'awnser_es' => 'Si es posible, quítalo, si no, puedes dejarlo.',
            'order' => '71',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'Can I pay with Care credit?',
            'awnser_en' => 'Care credit, insurance, FSA cards, HSA cards are NOT accepted.',
            'question_es' => '¿Puedo pagar con el crédito Care?',
            'awnser_es' => 'NO se aceptan tarjetas de crédito, seguros, tarjetas FSA, tarjetas HSA.',
            'order' => '72',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'Can I pay my balance with zelle?',
            'awnser_en' => 'Yes, you can pay your deposit and your balance through zelle. (ZELLE IS NOT AN OPTION RIGHT NOW UNTIL FUTHER NOTICE).',
            'question_es' => '¿Puedo pagar mi saldo con zelle?',
            'awnser_es' => 'Sí, puedes pagar tu depósito y tu saldo a través de zelle. (ZELLE NO ES UNA OPCIÓN AHORA MISMO HASTA NUEVO AVISO).',
            'order' => '73',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'If there is “medical condition” that prevents me from having surgery while I am at the faciity, will my money be refunded?',
            'awnser_en' => 'Yes your money will be refunded, ASM will charge $580 dlls to cover medical expenses and the rest will be refunded.',
            'question_es' => 'Si hay una "condición médica" que me impide operarme mientras estoy en el centro, ¿se me devolverá el dinero?',
            'awnser_es' => 'Sí se te devolverá el dinero, ASM cobrará 580 dlls para cubrir los gastos médicos y el resto se te devolverá.',
            'order' => '74',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'Can my surgery be canceled due to omiting medical information in my application that can put my life at risk?',
            'awnser_en' => 'Yes, it can be canceled, causing this to penalize your full payment.',
            'question_es' => '¿Pueden cancelar mi operación por omitir información médica en mi solicitud que pueda poner en peligro mi vida?',
            'awnser_es' => 'Sí, se puede cancelar, lo que hace que se penalice su pago completo.',
            'order' => '75',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'If I call my coordinator and I don’t hear back from her in 24 hours what should I do?',
            'awnser_en' => 'Email her and she will reply at her earliest convenience.',
            'question_es' => 'Si llamo a mi coordinadora y no me contesta en 24 horas, ¿qué debo hacer?',
            'awnser_es' => 'Envíele un correo electrónico y le responderá lo antes posible.',
            'order' => '76',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'How long does it take for the surgeons to approve patients?',
            'awnser_en' => 'From 24-72 hours to send in approvals to every coordinator (always check spam folder).',
            'question_es' => '¿Cuánto tiempo tardan los cirujanos en aprobar a los pacientes?',
            'awnser_es' => 'De 24 a 72 horas para enviar las aprobaciones a cada coordinador (compruebe siempre la carpeta de spam).',
            'order' => '77',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'Can I use a heating pad after surgery?',
            'awnser_en' => ' No, you can experience numbness in your stomach and not feel the heat causing skin burn and damaging your skin permanently.',
            'question_es' => '¿Puedo utilizar una almohadilla térmica después de la operación?',
            'awnser_es' => 'No, puedes experimentar un entumecimiento en el estómago y no sentir el calor, causando una quemadura en la piel y dañándola permanentemente..',
            'order' => '78',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'When do I start back my birth control pills?',
            'awnser_en' => '30 days post surgery.',
            'question_es' => '¿Cuándo vuelvo a tomar las píldoras anticonceptivas?',
            'awnser_es' => '30 días después de la cirugía.',
            'order' => '79',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'Can I get COVID-19 vaccine prior to surgery?',
            'awnser_en' => 'Yes, it is suggested to get vaccinated one week prior (or before) to avoid effects that can prevent the patient from having surgery such as fever etc.',
            'question_es' => '¿Puedo recibir la vacuna COVID-19 antes de la cirugía?',
            'awnser_es' => 'Sí, se sugiere vacunarse una semana antes (o antes) para evitar efectos que impidan al paciente operarse como fiebre, etc.',
            'order' => '80',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'If I have the COVID-19 vaccine, do I still need to get tested prior to surgery?',
            'awnser_en' => 'Yes, Covid test is still required as well as companions .',
            'question_es' => 'Si tengo la vacuna COVID-19, ¿tengo que hacerme la prueba antes de la cirugía?',
            'awnser_es' => 'Sí, la prueba Covid sigue siendo necesaria, así como los compañeros .',
            'order' => '81',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Faq::create([
            'question_en' => 'What should I do if I miss my flight or there is a delay in the day of arrival/pre-op evaluation?',
            'awnser_en' => 'Patient must stay at a hotel near the airport in San Diego, request the hotel list to your coordinator and the drivers will pick you up the next morning for pre-ops along with surgery (patient is in charge of paying this fee).',
            'question_es' => '¿Qué debo hacer si pierdo mi vuelo o hay un retraso en el día de llegada/evaluación preoperatoria?',
            'awnser_es' => 'El paciente debe hospedarse en un hotel cercano al aeropuerto de San Diego, solicite la lista de hoteles a su coordinador y los choferes lo recogerán a la mañana siguiente para las preoperaciones junto con la cirugía (el paciente es el encargado de pagar esta cuota).',
            'order' => '82',
            'code' => time().uniqid(Str::random(30)),
        ]);

        Faq::create([
            'question_en' => 'Which documents do I need to travel across the border?',
            'awnser_en' => 'If you are a US Citizen born in the USA, you can cross the border (ground transportations) with any of the following:
            <br><br>
            Passport (book)<br>
            Passport card<br>
            Original copy of birth certificate and a valid ID. (Both)<br>
            <br>
            <br>
            If you are a Naturalized US Citizen, bring any of the following:
            <br><br>
            Naturalization certificate (original) and valid ID<br>
            US passport book<br>
            US passport Card<br>
            <br>
            <br>
            If you are married and changed your last name bring the following
            <br><br>
            Original copy of birth certificate and valid ID (both things)
            <br><br>
            The CBP officer will verify in the system this last two and should match your current information. (First name/dob, for example)
            <br><br>
            If you are flying into Mexico,  bring the following:<br>
            US Passport BOOK  % required
            ',
            'question_es' => '¿Qué documentos necesito para cruzar la frontera?',
            'awnser_es' => 'Si usted es un ciudadano estadounidense nacido en los EE.UU., puede cruzar la frontera (transportes terrestres) con cualquiera de los siguientes:
            <br><br>
            Pasaporte (libro)<br>
            Tarjeta de pasaporte<br>
            Copia original del certificado de nacimiento y un documento de identidad válido. (Ambos)<br>
            <br>
            <br>
            Si usted es un ciudadano estadounidense naturalizado, traiga cualquiera de los siguientes:
            <br><br>
            Certificado de naturalización (original) y documento de identidad válido<br>
            Libreta de pasaporte de EE.UU.<br>
            Tarjeta de pasaporte de EE.UU.<br>
            <br>
            <br>
            Si está casado y ha cambiado su apellido traiga lo siguiente
            <br><br>
            Copia original del certificado de nacimiento y una identificación válida (ambas cosas)
            <br><br>
            El oficial de CBP verificará en el sistema estos dos últimos y debe coincidir con su información actual. (Nombre/dob, por ejemplo)
            <br><br>
            Si va a volar a México, traiga lo siguiente:<br>
            Pasaporte de EE.UU. LIBRO % requerido',
            'order' => '83',
            'code' => time().uniqid(Str::random(30)),
        ]);

    }
}
