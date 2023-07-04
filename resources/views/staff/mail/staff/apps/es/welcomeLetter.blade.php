@extends('staff.mail.header')
@section('content')
    <table class="body-wrap" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;width: 100%;margin-top: -2px;">
        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
            <td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"></td>
            <td class="container" style="margin: 0 auto!important;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;background-color: #F2F2F2;display: block!important;max-width: 600px!important;clear: both!important;">
                <div class="content" style="margin: 0 auto;padding: 15px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;max-width: 600px;display: block;">
                    <table style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;width: 100%;">
                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
                            <td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
                                <p>Estimado <b>{{ $patient->name }}</b></p>
                                @if (strtolower($treatment->service->brand->brand) == 'a beautiful me')
                                    <br>
                                    <p>Gracias por tu interés en <b>{{ getUcWords($treatment->service->brand->brand) }}!</b></p>
                                    <br>
                                    <p>Nuestro cirujano revisará tu solicitud y en cuanto tengamos un presupuesto para ti, se enviará a tu correo electrónico.</p>
                                    <p>Mientras tanto, aquí tienes información importante que debes saber.</p>
                                    <br>
                                    <p>Para someterte a cirugía plástica, tu IMC debe ser inferior a 32.</p>
                                    <br>
                                    <p>Si tu IMC es superior a 32 en el momento de tu solicitud, no se enviará un presupuesto hasta que pierdas peso y tu IMC sea de 32 o menos.</p>
                                    <br>
                                    <p>El nivel de hemoglobina debe ser de al menos 14.</p>
                                    <br>
                                    <p>Trabajamos para ofrecer la mejor atención posible, la salud y el bienestar de nuestros pacientes es nuestra principal prioridad.</p>
                                    <br>
                                    <p>Si tienes alguna pregunta o necesitas ayuda, no dudes en contactarme.</p>
                                    <br>
                                    <p>Te deseo un maravilloso día lleno de bendiciones y espero tener noticias tuyas pronto.</p>
                                @elseif (strtolower($treatment->service->brand->brand) == 'a slimmer me')
                                    <p>Estamos encantados y emocionados de que hayas elegido <b>{{ getUcWords($treatment->service->brand->brand) }}</b> para tu proceso de pérdida de peso. Mi nombre es </b>{{ $coordinator->name }}</b> y seré tu coordinador médico. Hemos recibido tu solicitud y está siendo revisada para su aprobación. Esperamos tener una respuesta en las próximas 24-48 horas y queremos agradecerte por tu paciencia.</p>
                                    <br>
                                    <p>Estaré encantado de responder todas tus preguntas sobre la cirugía de pérdida de peso y aclarar cualquier duda sobre tu paquete. Una vez que tu solicitud sea aprobada, recibirás una <b>CARTA DE APROBACIÓN</b> con la <b>INFORMACIÓN DE RESERVA Y PAGO.</b></p>
                                    <br>
                                    <p>Por favor, avísame si tienes alguna pregunta o necesitas ayuda.</p>
                                    <br>
                                @endif

                                <p>Un cordial saludo,</p>

                                <hr>
                                <p style="margin: 0;padding: 0;">{{ ucfirst($role = $coordinator->roles[0]->name_es ) }} de {{ strtoupper($treatment->service->brand->acronym) }} 
                                <p style="margin: 0;padding: 0;"></b>{{ $coordinator->name }}</b></p>
                                <p style="margin: 0;padding: 0;">{{ $coordinator->phone }}</p>
                                <p style="margin: 0;padding: 0;">Horario de atención:</p>
                                <p style="margin: 0;padding: 0;">Lun-Vie 9am-5pm</p>
                                <p style="margin: 0;padding: 0;">Sábado 9 am-2pm</p>
                                <p style="margin: 0;padding: 0;">Domingos CERRADO</p>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
@endsection