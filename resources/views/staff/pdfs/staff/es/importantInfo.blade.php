@extends('staff.pdfs.header')
@section('content')
    <style>
        p {
            margin-bottom: 16px;
        }

        li {
            margin-bottom: 8px;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
    <div class="" style="margin: 50px!important">
        <h1 style="text-align: center">INFORMACIÓN IMPORTANTE</h1>
        <p>Estimado <b>{{ $data['patient']->name }}</b>,</p>
        <p>Lea la siguiente carta, contiene información muy importante que necesita
            saber para obtener un alto porcentaje para lograr un procedimiento sin complicaciones y
            obtener los mejores resultados posibles.</p>

        <h2 style="text-align: center">INDICACIONES PREQUIRÚRGICAS</h2>

        <ul style="estilo-lista: ninguno">
            <li><b>FUMAR/VAPEAR</b>: Los pacientes deben dejar de fumar/vapear 5 semanas antes de la cirugía,
                incluyendo marihuana y nicotina en cualquier presentación (parches, chicles, etc).</li>
            <li><b>TODAS LAS DROGAS RECREATIVAS</b>: deben suspenderse 5 semanas antes de la cirugía, incluidas
                comestibles.</li>
            <li><b>HORMONAS/ANTICONCEPTIVOS</b>S: suspender 30 días antes de la cirugía.</li>
            <li>Si está tomando medicamentos para <b>TIROIDES Y PRESIÓN ARTERIAL</b>, continúe tomándolos
                así que hasta la mañana del preoperatorio con un poco de agua.</li>
            <li>Si toma <b>ANTIDEPRESIVOS</b>, no los suspenda y tómelos en la mañana del
                preoperatorios con un poco de agua.</li>
            <li>Si es un paciente que necesita usar un <b>CPAP</b>, tráigalo con usted.</li>
            <li>Si toma <b>Anticoagulantes</b>, suspéndalos 10 días antes de la cirugía.</li>
            <li>Los pacientes deben suspender <b>ESTEROIDES E INMUNOSUPRESORES</b> 1 mes antes de
                cirugía</li>
            <li>Si tiene un <b>DIU</b>, retírelo 2 meses antes de la cirugía.</li>
            <li>Los pacientes deben suspender <b>ASPIRINA</b> y todos los <b>AINE</b> 7 días antes de la cirugía:</li>
            <li>
                <ul>
                    <li>Aspirina (Bayer)</li>
                    <li>Ibuprofeno (Advil, Motrin)</li>
                    <li>Naproxeno (Aleve, AnaproxDS, Naprosyn Diclocenac)</li>
                    <li>celecoxib (Celebrex)</li>
                    <li>ácido mefenámico.</li>
                    <li>etoricoxib.</li>
                    <li>indometacina.</li>
                    <li>Meloxicam</li>
                </ul>
            </li>
            <li>Por favor, no suspenda <b>METFORMINA</b></li>
            <li><b>NO ESMALTE DE UÑAS NI UÑAS ACRÍLICAS</b> (manos y dedos de los pies)</li>
            <li><b>SIN PERFORACIONES</b>: elimínelas todas, sin excepción.</li>
            <li><b>SIN PESTAÑAS POSTIZAS.</b></li>
            <li>Recomendamos <b>NO</b> llevar ningún tipo de joyería</li>
            <li><b>PROPINAS</b> para nuestros conductores y personal médico están permitidos pero <b>NO SON
                    OBLIGATORIOS</b>.</li>
        </ul>
        <div class="salto de página"></div>
        <p>Nos esforzamos por ofrecer la mejor atención posible y la salud y el bienestar de nuestros pacientes es nuestro
            máxima prioridad.</p>
        <p>Es muy importante que siga estas indicaciones, el no hacerlo pondrá en peligro su
            salud en riesgo y la cirugía puede ser cancelada. Si se cancela la cirugía por no seguir
            las indicaciones anteriores, tenga en cuenta que el costo de cancelación es el costo total de la
            cirugía.</p>
        <p>Por favor escriba su nombre y firme en el botón indicando que ha leído todo lo anterior
            y envíeme un correo electrónico de vuelta. El no hacerlo contará como su aceptación de este importante
            carta de información.</p>

        <h2 style="text-align: center">LISTA DE EMBALAJE</h2>

        <p>RECUERDA EMPACAR LIGERO, UNA MOCHILA PEQUEÑA, BOLSO DE VIAJE O PEQUEÑO
            EL EQUIPAJE DE MANO SIRVE. NO QUIERES LEVANTAR NADA PESADO
            VOLVER A CASA.</p>

        <ul style="estilo-lista: ninguno">
            <li><b>DOCUMENTACIÓN</b>:
                <ul>
                    <li>Prueba de ciudadanía: certificado de nacimiento original o identificación válida (licencia de
                        conducir).</li>
                </ul>
            </li>
            <li><b>ROPA</b>:
                <ul>
                    <li>Ajuste holgado y cómodo: sujetador, ropa interior, pijama, calcetines cálidos, pantuflas
                        (Haga que su ropa de salida sea fácil de poner, zapatos fáciles de poner.</li>
                </ul>
            </li>
            <li><b>ARTÍCULOS PERSONALES</b>:
                <ul>
                    <li>Teléfono celular.</li>
                    <li>Cargador de celular.</li>
                    <li>Book, Ipad, kindle (lo que necesite para entretenerse mientras espera la cirugía).</li>
                    <li>Gafas para leer, sin lentes de contacto para cirugía./li>
                    <li>Pequeña almohada de viaje que puedes abrazar en tu vuelo de regreso a casa.</li>
                </ul>
            </li>
            <li><b>Tenemos WIFI en el centro quirúrgico y la casa de recuperación.</b></li>
            <li>
                <b>PRODUCTOS FARMACÉUTICOS</b>:
                <ul>
                    <li>
                        <b>Tamaño de viaje</b>:
                        <ul>
                            <li>Pasta de dientes/cepillo de dientes</li>
                            <li>Acondicionador,</li>
                            <li>Lavado corporal</li>
                            <li>Loción</li>
                            <li>Desodorante</li>
                            <li>Cepillo para el cabello</li>
                            <li>Bálsamo labial</li>
                            <li>Medicamentos recetados en su frasco original etiquetado,</li>
                            <li>Triturador de pastillas</li>
                            <li>Tiritas de gasa adicionales (en caso de que necesite cambiarlas en su vuelo de regreso a
                                casa).</li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
        <br>
        <p>Si vas a volar o manejar de regreso a casa, trae algo que puedas mezclar con agua o agua tibia.
            agua como pólvora de propulsión. Crystal light, gatorade en polvo (G2 tiene menos azúcar), polvo
            caldo de pollo.</p>
        <br>
        <h5 style="text-align: center">Es muy importante que te mantengas hidratado</h5>

        <p><b>POR FAVOR LEA NUESTRAS 83 PREGUNTAS FRECUENTES OPRIMIENDO EL ENLACE A CONTINUACIÓN</b></p>

        <a href="https://jlpradosc.com/faqs/" target="_blank">https://jlpradosc.com/faqs/</a>
        <br>

        <p>Si tiene alguna pregunta o necesita ayuda, no dude en ponerse en contacto conmigo.</p>
        <p>Atentamente,</p>
        <p >{{ $data['coordinator']->name }}</p>
        <p>COORDINADOR {{ strtoupper($data['brand']->acronym) }}</p>
        <p>phone: {{ $data['coordinator']->phone }}</p>
        <p>Email: {{ $data['coordinator']->email }}</p>


        <br>
        <br>
        <br>
        <br>

        <p style="text-align: center">___________________________________</p>
        <p style="text-align: center">Nombre y firma</p>
        <p style="text-align: center">Por favor envíenos un correo electrónico)</p>
    </div>
@endsection
