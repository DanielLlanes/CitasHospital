@extends('staff.pdfs.header')
@section('content')
<body bgcolor="#F7F7F7" style="margin: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;-webkit-font-smoothing: antialiased;-webkit-text-size-adjust: none;height: 100%;width: 100%!important;">

<style>
    p{
        margin-bottom: 16px;
    }
    li{
        margin-bottom: 8px;
    }
    .page-break {
        page-break-after: always;
    }
    h1, h2 {
        text-align: center;
    }
    ul, ol {
        list-style: none;
    }
</style>
<div class="" style="margin: 50px!important">
    <h1>INFORMACIÓN IMPORTANTE</h1>

       <p>Estimado <b>{{ $data['patient']->name }}</b>,</p>
    
       <p>ABM le da la bienvenida, por favor lea la siguiente carta, contiene información muy importante que usted necesita saber para obtener un alto porcentaje para lograr un procedimiento sin contratiempos y obtener los mejores resultados posibles.</p>
    
       <p>Estamos muy contentos de que haya decidido realizarse su procedimiento con nosotros. Las siguientes instrucciones preoperatorias lo guiarán a través de la última parte de su cirugía con nosotros. Contestaré todas sus preguntas y le proporcionaré todo lo que necesita saber para tomar una decisión informada con respecto a cualquiera de nuestros procedimientos de cirugía plástica.</p>
    
       <p>Nuestro cirujano solicita los siguientes análisis de sangre un mes antes de la cirugía:</p>
    
       <ul>
         <li>CBC</li>
         <li>TIEMPOS DE COAGULACIÓN</li>
         <li>PANEL QUÍMICO (DEBE INCLUIR BUN, CREAT, GLUCOSA)</li>
         <li>TIPO DE SANGRE</li>
         <li>FUNCIÓN DEL HÍGADO</li>
         <li>LDH</li>
       </ul>

       <h3>INSTRUCCIONES PREOPERATORIAS</h3>

       <p>NO TOME LOS SIGUIENTES PRODUCTOS 10 DÍAS ANTES DE LA CIRUGÍA</p>

       <ol>
           <li>Cualquier medicamento que contenga Aspirina debido al riesgo de sangrado.</li>
           <li>Motrín, Advil. Consúltenos si necesita tomar algo para el dolor.</li>
           <li>Anticonceptivos orales y DIU, deje de usarlos 2 meses antes de la cirugía.</li>
           <li>Productos naturales, vitaminas, Panax, Ginseng/Ginko Biloba, Productos para adelgazar o Té verde.</li>
           <li>NO alcohol 4 días antes de la cirugía.</li>
           <li>Deje de fumar/vapear 4 semanas antes de la cirugía.</li>
           <li>NO use uñas acrílicas o esmalte de uñas y quite los piercings (es necesario quitarlos antes de la cirugía)</li>
           <li>Evite el contacto con personas enfermas.</li>
           <li>8 horas de ayuno antes del momento de la cirugía (sin comida ni agua)</li>
           <li>Dúchese la noche anterior a la cirugía y aféitese (solo si su procedimiento involucra las axilas o el área púbica).</li>
           <li>Si tiene una condición de salud que requiere medicación (por ejemplo, tiroides, presión arterial alta y diabetes) NO DEJE de hacerlo hasta que haya consultado a su médico.</li>
           <li>Sin maquillaje el día de la cirugía.</li>
           <li>Si usa regularmente ablandadores de heces, continúe tomándolos y llévelos con usted también.</li>
           <li>Solo se permite un acompañante / No se permiten niños.</li>
       </ol>

       <h3>INSTRUCCIONES POSTERIORES</h3>

       <p>DRENAJES</p>
       <p>Puede estar de 14 a 21 días. Si te quedas menos de una semana, la posibilidad de volver a casa con ellos es muy alta. Si este es el caso, recibirá instrucciones sobre cómo eliminarlos. Siempre van cosidos a la piel, así que ten cuidado.</p>

       <p>PRENDAS DE COMPRESIÓN</p>
       <p>Las fajas, las prendas de compresión y los sostenes posoperatorios DEBEN usarse durante al menos 6 semanas. Si tiene una correa para el pecho, debe usarla durante 2-3 semanas.</p>

       <p>PUNTADAS</p>
       <p>Usamos puntos de sutura solubles y no solubles, ya que una gran cantidad de nuestros pacientes viven demasiado lejos para regresar y nuestros médicos los retiran. Cortará los puntos por encima del nivel de la piel. Es muy importante que no tire, cave ni ejerza presión sobre los puntos de sutura. Estarán allí durante 2-3 semanas dependiendo de su cirugía específica. Una vez retirado, deberá rociar esta área con el spray antiséptico para evitar más retrasos en el proceso de curación.</p>

       <p>FOTOS POSTERIORES</p>
       <p>Debe enviarse por correo electrónico a los médicos cada semana durante un mes.</p>

       <p>APERTURA DE LA HERIDA</p>
       <p>Si por alguna razón tiene un área de incisión que se rompe, use el spray antiséptico sin demora. Envía un mensaje privado o un correo electrónico a los médicos para informarnos. Los pacientes con WLS tienen un recuento bajo de proteínas; este es uno de los principales factores que pueden hacer que esto suceda.</p>

       <p>BAÑO</p>
       <p>Mientras trata costras frescas, NO PUEDE bañarse, nadar en lagos, playas, piscinas, jacuzzis, etc.</p>

    <p>EXPOSICIÓN SOLAR</p>
    <p>Por favor, no exponga sus cicatrices o piel al sol mientras los moretones estén frescos y visibles.</p>

    <p>ALCOHOL</p>
    <p>Puedes beber una o dos (no más) copa de vino o alcohol.</p>

    <p>DIETA</p>
    <p>Toma batidos de proteínas complementarios o aumenta tu ingesta de proteínas.</p>

    <p>ABLANDADOR DE HECES</p>
    <p>Puede tomar cualquier tipo de ablandadores de heces al día siguiente de la cirugía.</p>

    <p>MANEJO DE CICATRICES</p>
    <p>Puede iniciar el manejo de cicatrices con geles, parches de silicona u otros a la segunda semana de su cirugía. Solo evítelos en las áreas húmedas de las heridas.</p>

    <p>HINCHAZÓN</p>
    <p>La hinchazón de los pies puede ocurrir durante la primera semana. Trate de caminar con frecuencia. Pero no te excedas. Puede durar hasta 3 semanas. Aumentará si vuela a casa, pero desaparecerá.</p>

    <p>ombligo</p>
    <p>Tienes que rociarlo a partir del día siguiente de tu cirugía.</p>

    <p>FUMAR/VAPEAR</p>
    <p>NO fumar/vapear durante 4 semanas antes y después de la cirugía. Corre el riesgo de que las incisiones se vuelvan a abrir y se retrase la cicatrización.</p>

    <p>EJERCICIO</p>
    <p>Puede comenzar a hacer ejercicio entre 4 y 6 semanas después de la cirugía. Reanude lentamente con una caminata rápida. Evite el levantamiento de pesas.</p>

    <p>ACTIVIDAD SEXUAL</p>
    <p>Puede reanudar la actividad sexual tres semanas después de la cirugía. Pero ten cuidado.</p>

    <p>COMPRAR SUJETADORES</p>
    <p>No compre sostenes hasta que haya cesado toda la hinchazón. Por lo general, entre 3 y 4 semanas.</p>

    <p>CIRUGÍA ADICIONAL</p>
    <p>Se pueden realizar procedimientos adicionales entre 3 y 6 meses después de la cirugía inicial.</p>

    <p>COMPRAS/VISTAS TURÍSTICAS</p>
    <p>Como sabes, la cirugía plástica ni siquiera se acerca a WLS. Lo más probable es que no tenga tiempo o no desee realizar muchas actividades físicamente agotadoras. Si cree que está preparado para ello, hable con los médicos o con su administrador de casos.</p>

    <p>VIDA NOCTURNA</p>
    <p>-----Evite esto----- durante al menos un mes-----</p>

    <p>Durante su estancia en Tijuana, no seremos responsables si sale del hotel a bares o discotecas. Evite esto durante su estadía.</p>

    <p>Durante el primer mes, debe esperar ver un resultado justo que mejorará con el tiempo. El resultado final de su cirugía será evidente entre 3-4 meses.</p>

    <p>HE EMBALADO ESTOS ARTÍCULOS,</p>
    <ul>
    <li>Pasaporte/certificado de nacimiento</li>
    <li>Itinerario de viaje</li>
    <li>Billetes de avión</li>
    <li>Licencia de conducir o identificación válida con fotografía</li>
    <li>Medicamentos recetados</li>
    <li>Tus anteojos o lentes de contacto</li>
    <li>Ropa de noche con cierre frontal</li>
    <li>Máscara para dormir/tapones para los oídos (esenciales para un sueño reparador)</li>
    <li>Ropa holgada de colores oscuros que sea fácil de poner y quitar (las opciones de camisa con cremallera frontal y botones son excelentes)</li>
    <li>Ropa interior</li>
    <li>lápiz labial</li>
    <li>Almohada Boppy o rosquilla para sentarse. Almohada para el cuello (para BBL)</li>
    <li>Batidos de proteínas enlatados (pacientes con pérdida de peso)</li>
    <li>Cargador de teléfono celular, cable de extensión largo</li>
    <li>Gel o crema de árnica</li>
    <li>Desinfectante de manos</li>
    <li>Suavizante de heces</li>
    <li>Cordón para sujetar desagües</li>
    <li>Zapatillas o calcetines con grip</li>
    <li>Slip on, zapatos planos</li>
    <li>Artículos de tocador de tamaño viaje</li>
    </ul>

    <p>“Le recomendamos que NO traiga joyas de ningún tipo”.</p>

    <p>Atentamente,</p>


    <p >{{ $data['coordinator']->name }}</p>
    <p>{{ strtoupper($data['brand']->acronym) }} COORDINATOR</p>
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