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
            'order' => '1',
        ]);
        Faq::create([
            'question_en' => 'When can I exercise?',
            'awnser_en' => 'Low impact exercise can be done 3 weeks post op, weight lifting two months post op.',
            'question_es' => '¿Cuándo puedo hacer ejercicio?',
            'awnser_es' => 'El ejercicio de bajo impacto se puede hacer 3 semanas después de la operación y el levantamiento de pesas dos meses después de la operación.',
            'order' => '2',
        ]);
        Faq::create([
            'question_en' => 'When can I sunbathe?',
            'awnser_en' => 'One month after surgery.',
            'question_es' => '¿Cuándo puedo tomar el sol?',
            'awnser_es' => 'Un mes después de la cirugía.',
            'order' => '3',
        ]);
        Faq::create([
            'question_en' => 'When can I have sex?',
            'awnser_en' => 'One month after surgery.',
            'question_es' => '¿Cuándo puedo tener relaciones sexuales?',
            'awnser_es' => 'Dos semanas después de la cirugía.',
            'order' => '4',
        ]);
        Faq::create([
            'question_en' => 'When can I do my regular activities?',
            'awnser_en' => 'Right after surgery, as long it is not involves heavy lifting or straining.',
            'question_es' => '¿Cuándo puedo realizar mis actividades habituales?',
            'awnser_es' => 'Inmediatamente después de la cirugía, siempre que no implique levantar objetos pesados ​​o hacer esfuerzos.',
            'order' => '5',
        ]);
        Faq::create([
            'question_en' => 'When can I use a body shaper?',
            'awnser_en' => 'One week after surgery.',
            'question_es' => '¿Cuándo puedo usar un modelador de cuerpo?',
            'awnser_es' => 'Una semana después de la cirugía.',
            'order' => '6',
        ]);
        Faq::create([
            'question_en' => 'Is it normal to have acne after surgery?',
            'awnser_en' => 'The body changes with surgery, and among these changes, some patients can experience acne..',
            'question_es' => '¿Es normal tener acné después de la cirugía?',
            'awnser_es' => 'El cuerpo cambia con la cirugía y, entre estos cambios, algunos pacientes pueden experimentar acné..',
            'order' => '7',
        ]);
        Faq::create([
            'question_en' => 'Is it normal that my hair falls after surgery?',
            'awnser_en' => 'Yes, its normal. Some patients can experience hair loss after surgery, its temporary and it will start regrowing by itself around 6 months after.',
            'question_es' => '¿Es normal que mi cabello se caiga después de la cirugía?',
            'awnser_es' => 'Sí, es normal. Algunos pacientes pueden experimentar pérdida de cabello después de la cirugía, es temporal y comenzará a crecer por sí solo alrededor de 6 meses después.',
            'order' => '1',
        ]);
        Faq::create([
            'question_en' => 'Can I take vitamins/gummy vitamins?',
            'awnser_en' => 'Yes, take a normal dose for an adult.',
            'question_es' => '¿Puedo tomar vitaminas / vitaminas gomosas?',
            'awnser_es' => 'Sí, tome una dosis normal para un adulto.',
            'order' => '8',
        ]);
        Faq::create([
            'question_en' => 'When can I start weight lifting?',
            'awnser_en' => 'Two months after surgery.',
            'question_es' => '¿Cuándo puedo empezar a levantar pesas?',
            'awnser_es' => 'Dos meses después de la cirugía.',
            'order' => '9',
        ]);
        Faq::create([
            'question_en' => 'When can I ride a roller coaster?',
            'awnser_en' => 'One month after surgery.',
            'question_es' => '¿Cuándo puedo subirme a una montaña rusa?',
            'awnser_es' => 'Un mes después de la cirugía.',
            'order' => '10',
        ]);
        Faq::create([
            'question_en' => 'When can I swim?',
            'awnser_en' => 'Two weeks after surgery.',
            'question_es' => '¿Cuándo puedo nadar?',
            'awnser_es' => 'Dos semanas después de la cirugía.',
            'order' => '11',
        ]);
        Faq::create([
            'question_en' => 'How long does the stall last?',
            'awnser_en' => 'It depends, don’t get unmotivated. For most patients during the stall, they tend to lose clothes sizes.',
            'question_es' => '¿Cuánto dura el puesto?',
            'awnser_es' => 'Depende, no te desmotives. Para la mayoría de los pacientes durante el puesto, tienden a perder tallas de ropa.',
            'order' => '12',
        ]);
        Faq::create([
            'question_en' => 'When can I have solid food?',
            'awnser_en' => 'When your body allows it. It varies from patient to patient, and in some cases it can take up to two months.',
            'question_es' => '¿Cuándo puedo tomar alimentos sólidos?',
            'awnser_es' => 'Cuando su cuerpo lo permita. Varía de un paciente a otro, y en algunos casos puede tardar hasta dos meses.',
            'order' => '13',
        ]);
        Faq::create([
            'question_en' => 'When can I get pregnant?',
            'awnser_en' => 'The best time to get pregnant after bariatric surgery is two years post op. But after a year, the risks get lower. (risks of having a miscarriage, the baby being born with low birth weight).',
            'question_es' => '¿Cuándo puedo quedar embarazada?',
            'awnser_es' => 'El mejor momento para quedarse embarazada después de una operación bariátrica es a los dos años. Pero después de un año, los riesgos son menores. (riesgos de tener un aborto espontáneo, de que el bebé nazca con bajo peso).',
            'order' => '14',
        ]);
        Faq::create([
            'question_en' => 'When can I get a tanning?',
            'awnser_en' => 'One month after surgery.',
            'question_es' => '¿Cuándo me puedo broncear?',
            'awnser_es' => 'Un mes después de la cirugía.',
            'order' => '15',
        ]);
        Faq::create([
            'question_en' => 'Can we use crystal light in pre op diet?',
            'awnser_en' => 'Yes.',
            'question_es' => '¿Podemos usar crystal light en la dieta preoperatoria?',
            'awnser_es' => 'Si.',
            'order' => '16',
        ]);
        Faq::create([
            'question_en' => 'While in pre op diet can we take our regular medicine?',
            'awnser_en' => 'During the pre op diet you have to keep taking your regular medications..',
            'question_es' => '¿Mientras estemos en la dieta pre operatoria podemos tomar nuestra medicina regular?',
            'awnser_es' => 'Durante la dieta pre operatoria tienes que seguir tomando tus medicamentos habituales.',
            'order' => '17',
        ]);
        Faq::create([
            'question_en' => 'Can I have coffee on the pre op diet?',
            'awnser_en' => 'No.',
            'question_es' => '¿Puedo tomar café con la dieta preoperatoria?',
            'awnser_es' => 'No.',
            'order' => '18',
        ]);
        Faq::create([
            'question_en' => 'When can you have coffee after surgery?',
            'awnser_en' => 'Preferably one year after surgery. Caffeine can stimulate hunger, and lead you to eat more, and that is why we prefer that you don’t drink coffee or caffeine based drinks.',
            'question_es' => '¿Cuándo se puede tomar café después de una operación?',
            'awnser_es' => 'Preferiblemente un año después de la cirugía. La cafeína puede estimular el hambre, y llevarle a comer más, y por eso preferimos que no tome café o bebidas con cafeína.',
            'order' => '19',
        ]);
        Faq::create([
            'question_en' => 'When can I start working?',
            'awnser_en' => 'Most patients can return to work, with restrictions (no heavy lifting) one month after surgery.',
            'question_es' => '¿Cuándo puedo empezar a trabajar?',
            'awnser_es' => 'La mayoría de los pacientes pueden volver al trabajo, con restricciones (no levantar objetos pesados) un mes después de la cirugía.',
            'order' => '20',
        ]);
        Faq::create([
            'question_en' => 'How long after surgery can I go to my PCP?',
            'awnser_en' => 'Regular visits with your PCP are encouraged, and the first visit is two weeks after surgery.',
            'question_es' => '¿Cuánto tiempo después de la operación puedo acudir a mi médico de cabecera?',
            'awnser_es' => 'Se recomienda visitar regularmente a su médico de cabecera, y la primera visita es dos semanas después de la cirugía.',
            'order' => '21',
        ]);
        Faq::create([
            'question_en' => 'When after surgery can I start taking vitamins?',
            'awnser_en' => 'The body will require vitamins after surgery, and you can start taking them one month after surgery.',
            'question_es' => '¿Puedo tomar café con la dieta preoperatoria?',
            'awnser_es' => 'El cuerpo necesitará vitaminas después de la cirugía, y puede empezar a tomarlas un mes después de la cirugía.',
            'order' => '22',
        ]);
        Faq::create([
            'question_en' => 'Can I have the procedure done if I am on my period?',
            'awnser_en' => 'Yes.',
            'question_es' => '¿Puedo someterme a la intervención si estoy en periodo de menstruación?',
            'awnser_es' => 'Yes.',
            'order' => '23',
        ]);
        Faq::create([
            'question_en' => 'If I am on my period can I use the blood thinner?',
            'awnser_en' => 'Yes.',
            'question_es' => 'Si estoy con la regla, ¿puedo utilizar el anti coagulante?',
            'awnser_es' => 'Yes.',
            'order' => '24',
        ]);
        Faq::create([
            'question_en' => 'Can I use nails on surgery?',
            'awnser_en' => 'Yes, although we get a better reading of your levels of oxygen if you don’t have long or painted nails.',
            'question_es' => '¿Puedo utilizar las uñas en la cirugía?',
            'awnser_es' => 'Sí, aunque obtendremos una mejor lectura de sus niveles de oxígeno si no tiene las uñas largas o pintadas.',
            'order' => '25',
        ]);
        Faq::create([
            'question_en' => 'Can I use nails on surgery?',
            'awnser_en' => 'Yes, although we get a better reading of your levels of oxygen if you don’t have long or painted nails.',
            'question_es' => '¿Puedo utilizar las uñas en la cirugía?',
            'awnser_es' => 'Sí, aunque obtendremos una mejor lectura de sus niveles de oxígeno si no tiene las uñas largas o pintadas.',
            'order' => '26',
        ]);
        Faq::create([
            'question_en' => 'Can I chew gum before and after surgery?',
            'awnser_en' => 'Preferably no. Chewing gum can lead your stomach to produce excess acid, and that in return can produce an ulcer in your stomach.',
            'question_es' => '¿Puedo masticar chicle antes y después de la operación?',
            'awnser_es' => 'Preferiblemente no. Masticar chicle puede hacer que su estómago produzca un exceso de ácido, y eso a su vez puede producir una úlcera en su estómago.',
            'order' => '27',
        ]);
        Faq::create([
            'question_en' => 'What is the boogie size the Dr. uses?',
            'awnser_en' => '36 french.',
            'question_es' => '¿Cuál es la talla de boogie que utiliza el Dr.?',
            'awnser_es' => '36 francés.',
            'order' => '28',
        ]);
        Faq::create([
            'question_en' => 'Can I have the procedure if I have an ulcer?',
            'awnser_en' => 'No. it’s a relative contraindication, but we do not perform surgery on patients with ulcers. You have to get treatment first.',
            'question_es' => '¿Puedo someterme a la intervención si tengo una úlcera?',
            'awnser_es' => 'No. Es una contraindicación relativa, pero no operamos a pacientes con úlceras. Primero tiene que recibir tratamiento.',
            'order' => '29',
        ]);
        Faq::create([
            'question_en' => 'How do I clean my incisions?',
            'awnser_en' => 'During your daily bath, just as you would clean your body.',
            'question_es' => '¿Cómo debo limpiar mis incisiones?',
            'awnser_es' => 'Durante su baño diario, igual que limpiaría su cuerpo.',
            'order' => '30',
        ]);
        Faq::create([
            'question_en' => 'What is an endoscopy?',
            'awnser_en' => 'It’s a medical procedure that uses a camera inside of a scope, to see the inside of the esophagus, stomach and first part of the intestine.',
            'question_es' => '¿Qué es una endoscopia?',
            'awnser_es' => 'Es un procedimiento médico que utiliza una cámara dentro de un endoscopio, para ver el interior del esófago, el estómago y la primera parte del intestino.',
            'order' => '31',
        ]);
        Faq::create([
            'question_en' => 'Does the endoscopy hurt?',
            'awnser_en' => 'No, it’s done under sedation.',
            'question_es' => '¿Duele la endoscopia?',
            'awnser_es' => 'No, se realiza bajo sedición.',
            'order' => '32',
        ]);
        Faq::create([
            'question_en' => 'Is it normal to feel a pain on the left side of my tummy?',
            'awnser_en' => 'Yes, because of the port sites, you can experience some pain there.',
            'question_es' => '¿Es normal sentir un dolor en el lado izquierdo de mi vientre?',
            'awnser_es' => 'Sí, debido a los sitios del puerto, puede experimentar algo de dolor allí.',
            'order' => '33',
        ]);
        Faq::create([
            'question_en' => 'Is sneezing pain normal?',
            'awnser_en' => 'Yes, after surgery, any sudden movements can cause pain.',
            'question_es' => '¿Es normal el dolor al estornudar?',
            'awnser_es' => 'Sí, después de la cirugía, cualquier movimiento brusco puede causar dolor.',
            'order' => '34',
        ]);
        Faq::create([
            'question_en' => 'Is there a reversal for VSG?',
            'awnser_en' => 'No, it’s a permanent surgery.',
            'question_es' => '¿Existe una reversión para la VSG?',
            'awnser_es' => 'No, es una cirugía permanente.',
            'order' => '35',
        ]);
        Faq::create([
            'question_en' => 'What can I do if I hit a Stall?',
            'awnser_en' => 'Stay calm, continue to exercise and eat properly. In time, you will get out of the stall.',
            'question_es' => '¿Qué puedo hacer si me encuentro con un estancamiento?',
            'awnser_es' => 'Mantén la calma, sigue haciendo ejercicio y comiendo bien. Con el tiempo, saldrás del atasco.',
            'order' => '36',
        ]);
        Faq::create([
            'question_en' => 'What are the things we can’t eat after VSG?',
            'awnser_en' => 'Try to stay away from sweets, greasy and high carb foods.',
            'question_es' => '¿Qué cosas no podemos comer después de la VSG?',
            'awnser_es' => 'Intenta mantenerte alejado de los dulces, los alimentos grasos y con alto contenido en carbohidratos.',
            'order' => '37',
        ]);
        Faq::create([
            'question_en' => 'What vitamins can I take post op?',
            'awnser_en' => 'Any multivitamin is good.',
            'question_es' => '¿Qué vitaminas puedo tomar después de la operación?',
            'awnser_es' => 'Cualquier multivitamina es buena.',
            'order' => '38',
        ]);
        Faq::create([
            'question_en' => 'What lab works can I have after post-op?',
            'awnser_en' => 'CBC, complete Blood chemistry, liver function tests, lipid profile, thyroid tests, coagulation tests, blood typing, urinalysis, folic acid, vitamin b12.',
            'question_es' => '¿Qué pruebas de laboratorio puedo realizar después del post operatorio?',
            'awnser_es' => 'Hemograma, química sanguínea completa, pruebas de función hepática, perfil lipídico, pruebas de tiroides, pruebas de coagulación, tipificación sanguínea, análisis de orina, ácido fólico, vitamina b12.',
            'order' => '39',
        ]);
        Faq::create([
            'question_en' => 'What are the risks of not taking the blood thinner?',
            'awnser_en' => 'Getting a blood clot in your legs. That blood clots can travel to you brain, causing a stroke, travel to your heart, causing a heart attack, and travel to your lungs causing a pulmonary embolism.',
            'question_es' => '¿Cuáles son los riesgos de no tomar el anticoagulante?',
            'awnser_es' => 'Tener un coágulo de sangre en las piernas. Los coágulos de sangre pueden viajar a su cerebro, causando un derrame cerebral, viajar a su corazón, causar un ataque cardíaco y viajar a sus pulmones causando una embolia pulmonar.',
            'order' => '40',
        ]);
        Faq::create([
            'question_en' => 'What can I do for hair loss?',
            'awnser_en' => 'If your start losing your hair during the first two years after the surgery, you can take biotin capsules, although they might not help. Eventually it will start regrowing by it self. If its after the two year mark of the surgery, take multivitamins and biotin capsules.',
            'question_es' => '¿Qué puedo hacer por la caída del cabello?',
            'awnser_es' => 'Si comienza a perder el cabello durante los primeros dos años después de la cirugía, puede tomar cápsulas de biotina, aunque es posible que no le ayuden. Con el tiempo, empezará a crecer por sí solo. Si es después de los dos años de la cirugía, tome multivitaminas y cápsulas de biotina.',
            'order' => '41',
        ]);
        Faq::create([
            'question_en' => 'How long until you can sleep on your tummy or side?',
            'awnser_en' => 'One week average.',
            'question_es' => '¿Cuánto tiempo hasta que pueda dormir boca abajo o de lado?',
            'awnser_es' => 'Promedio de una semana.',
            'order' => '42',
        ]);
        Faq::create([
            'question_en' => 'What do I do in case a have a flu after pneumonia?',
            'awnser_en' => 'Go to your primary physician and get checked out.',
            'question_es' => '¿Qué hago en caso de que tenga gripe después de una neumonía?',
            'awnser_es' => 'Vaya a su médico de cabecera y hágase un chequeo.',
            'order' => '43',
        ]);
        Faq::create([
            'question_en' => 'What are the risks of having a VSG?',
            'awnser_en' => 'Leaks, bleeding, pain, hernia at trocar site.',
            'question_es' => '¿Cuáles son los riesgos de tener un VSG?',
            'awnser_es' => 'Fugas, hemorragia, dolor, hernia en el lugar del trocar.',
            'order' => '44',
        ]);
        Faq::create([
            'question_en' => 'Do I need to crush my pills?',
            'awnser_en' => 'Yes, we recommend that you crush your pills the first 3 days after surgery.',
            'question_es' => '¿Necesito triturar mis pastillas?',
            'awnser_es' => 'Sí, le recomendamos que triture sus pastillas los primeros 3 días después de la cirugía.',
            'order' => '45',
        ]);
        Faq::create([
            'question_en' => 'Can I use a medical assistant at the airport?',
            'awnser_en' => 'Yes you can.',
            'question_es' => '¿Cuáles son los riesgos de tener un VSG?',
            'awnser_es' => 'Sí puedes..',
            'order' => '46',
        ]);
        Faq::create([
            'question_en' => 'How long it takes for swelling to go down after surgery?',
            'awnser_en' => 'It varies from person to person, but on average about 7 days',
            'question_es' => '¿Cuánto tiempo tarda en bajar la hinchazón después de la operación?',
            'awnser_es' => 'Varía de una persona a otra, pero la media es de unos 7 días.',
            'order' => '47',
        ]);
        Faq::create([
            'question_en' => 'What can I take for pain?',
            'awnser_en' => 'Advil, Tylenol, aleve.',
            'question_es' => '¿Qué puedo tomar para el dolor?',
            'awnser_es' => 'Advil, Tylenol, aleve.',
            'order' => '48',
        ]);
        Faq::create([
            'question_en' => 'Do you fill out FMLA forms?',
            'awnser_en' => 'Yes we do, only after you had your surgery done.',
            'question_es' => '¿Completa formularios FMLA?',
            'awnser_es' => 'Sí, lo hacemos, solo después de que se haya realizado la cirugía.',
            'order' => '49',
        ]);
        Faq::create([
            'question_en' => 'What are the benefits of having the VSG?',
            'awnser_en' => 'Weight loss, sometimes complete remission of diabetes and elevated blood pressure, joint pain relief after losing weight.',
            'question_es' => '¿Cuáles son los beneficios de someterse a la VSG?',
            'awnser_es' => 'Pérdida de peso, a veces remisión completa de la diabetes y de la tensión arterial elevada, alivio del dolor articular tras la pérdida de peso.',
            'order' => '50',
        ]);
        Faq::create([
            'question_en' => 'Do I need extra money on the trip?',
            'awnser_en' => 'Yes, in case you want a souvenir.',
            'question_es' => '¿Necesito dinero extra para el viaje?',
            'awnser_es' => 'Sí, por si quieres un souvenir.',
            'order' => '51',
        ]);
        Faq::create([
            'question_en' => 'Do I need to bring a companion?',
            'awnser_en' => 'No.',
            'question_es' => '¿Necesito traer una compañera / o?',
            'awnser_es' => 'No.',
            'order' => '52',
        ]);
        Faq::create([
            'question_en' => 'How long do I have to wear compression socks?',
            'awnser_en' => 'We recommend using the socks for seven days after the surgery.',
            'question_es' => '¿Cuánto tiempo tengo que usar calcetines de compresión?',
            'awnser_es' => 'Recomendamos usar los calcetines durante los siete días posteriores a la cirugía.',
            'order' => '53',
        ]);
        Faq::create([
            'question_en' => 'Why do I need to stop smoking?',
            'awnser_en' => 'Because smoking interferes with the healing process, and it can interfere with your stomach healing properly.',
            'question_es' => '¿Por qué debo dejar de fumar?',
            'awnser_es' => 'Porque fumar interfiere con el proceso de curación y puede interferir con la curación adecuada de su estómago.',
            'order' => '54',
        ]);
        Faq::create([
            'question_en' => 'What to expect if there’s a complication after surgery during your stay with us?',
            'awnser_en' => 'If there’s a complication, it will be taken care off, at an extra cost to you.',
            'question_es' => '¿Necesito traer una compañera / o?',
            'awnser_es' => 'Si hay una complicación, será atendida, con un costo adicional para usted.',
            'order' => '55',
        ]);
        Faq::create([
            'question_en' => 'How long before surgery can I take aspirin?',
            'awnser_en' => 'You have to stop taking aspirin 7 days before surgery.',
            'question_es' => '¿Cuánto tiempo antes de la cirugía puedo tomar aspirina?',
            'awnser_es' => 'Debe dejar de tomar aspirina 7 días antes de la cirugía.',
            'order' => '56',
        ]);
        Faq::create([
            'question_en' => 'What should I ask my pcp to check for me pre op?',
            'awnser_en' => 'CBC, complete Blood chemistry, liver function tests, lipid profile, thyroid tests, coagulation tests, blood typing, urinalysis, folic acid, vitamin b12.',
            'question_es' => '¿Qué debo pedirle a mi médico que me revise antes de la operación?',
            'awnser_es' => 'Hemograma, química sanguínea completa, pruebas de función hepática, perfil lipídico, pruebas de tiroides, pruebas de coagulación, tipificación sanguínea, análisis de orina, ácido fólico, vitamina b12.',
            'order' => '57',
        ]);
        Faq::create([
            'question_en' => 'Will Dr. Montano give me a list of labs and things that my pcp will need to monitor postop?',
            'awnser_en' => 'Yes, as soon as your pcp request them from Dr. Montano.',
            'question_es' => '¿Necesito traer una compañera / o?',
            'awnser_es' => 'Sí, tan pronto como su médico lo solicite a la Dra. Montano.',
            'order' => '58',
        ]);
        Faq::create([
            'question_en' => 'What should I do if my sugar goes too low on preop diet?',
            'awnser_en' => 'You should eat something sweet, like a candy or a piece of fruit.',
            'question_es' => '¿Qué debo hacer si mi nivel de azúcar baja demasiado en la dieta preoperatoria?',
            'awnser_es' => 'Debes comer algo dulce, como un caramelo o una pieza de fruta.',
            'order' => '59',
        ]);
        Faq::create([
            'question_en' => 'Is sugar free gum ok?',
            'awnser_en' => 'Yes, but we prefer you don’t chew gum for it may cause an ulcer.',
            'question_es' => '¿Está bien la goma de mascar sin azúcar?',
            'awnser_es' => 'Sí, pero preferimos que no mastique gama de mascar porque puede causar una úlcera.',
            'order' => '60',
        ]);
        Faq::create([
            'question_en' => 'what meds can I take for headache after post-op surgery?',
            'awnser_en' => 'Advil, Tylenol, aleve.',
            'question_es' => '¿Qué medicamentos puedo tomar para el dolor de cabeza después de la cirugía posoperatoria?',
            'awnser_es' => 'Advil, Tylenol, aleve.',
            'order' => '61',
        ]);
        Faq::create([
            'question_en' => 'When do you remove the bandages?',
            'awnser_en' => 'Every day, when you are taking a shower, you should remove the bandages, and place new ones after the shower, for 7 days.',
            'question_es' => '¿Cuándo te quitas los vendajes?',
            'awnser_es' => 'Todos los días, cuando esté tomando una ducha, debe quitarse los vendajes y colocarse unos nuevos después de la ducha, durante 7 días.',
            'order' => '62',
        ]);
        Faq::create([
            'question_en' => 'If my incision over my belly button leaked gunk all night, like a pink color then red, is it normal?',
            'awnser_en' => 'No its not normal, you should go to your primary physician and have it looked at.',
            'question_es' => 'Si mi incisión sobre el ombligo gotea mugre toda la noche, como un color rosa y luego rojo, ¿es normal?',
            'awnser_es' => 'No, no es normal, deberías ir a tu médico de cabecera para que te lo vea.',
            'order' => '63',
        ]);
        Faq::create([
            'question_en' => 'Is Tijuana Mexico a safe city?',
            'awnser_en' => 'Yes it is, in fact we are located just 5 minutes from the international border.',
            'question_es' => '¿Es Tijuana México una ciudad segura?',
            'awnser_es' => 'Yes it is, in fact we are located just 5 minutes from the international border.',
            'order' => '64',
        ]);
    }
}