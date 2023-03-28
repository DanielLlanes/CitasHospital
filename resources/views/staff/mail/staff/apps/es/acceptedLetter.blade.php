@extends('staff.mail.header')
@section('content')
    <table class="body-wrap" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;width: 100%;margin-top: -2px;">
        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
            <td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"></td>
            <td class="container" style="margin: 0 auto!important;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;background-color: #F2F2F2;display: block!important;max-width: 600px!important;clear: both!important;">
                <div class="content" style="margin: 0 auto;padding: 15px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;max-width: 600px;display: block;">
                    <table style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;width: 100%;">
                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
                            <td style="margin: 0 auto!important;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;background-color: #F2F2F2;display: block!important;max-width: 600px!important;clear: both!important;">
                                <p>Estimado/a <b>{{ $patient }}</b></p>

                                <p>Felicitaciones, usted ha sido aprobado para un/a cirugía de <b>{{ $procedure }}</b>.</p>

                                <p>Su paquete incluye lo siguiente:</b></p>

                                    <ul>
                                        @foreach ($includes as $item)
                                        <li>{{ $item->contain_es }}</li>
                                    @endforeach
                                    </ul>

                                <p>
                                    Thank you for your application with <b>{{ $brand->brand }}</b>!! We are excited and thrilled that you have chosen us to begin a new journey.
                                </p>

                                <p>
                                    Sus indicaciones directas de nuestro médico son:
                                </p>
                                <p>
                                    <b>
                                        Indicationes
                                    </b>
                                </p>
                                {!! $indications !!}
                                <p><b>Recomendaciones</b></p>
                                {!! $recomendations !!}
                                <br>
                                <p>
                                    Tómese un minuto para ver nuestra guía paso a paso.
                                </p>

                                <p>
                                    <a href="">
                                        Step by step
                                    </a>
                                </p>

                                <p>
                                    Para programar su cirugía, se requiere un depósito del 10% para fijar la fecha de su cirugía,
                                    que en este caso es  <b>$ {{ $downPayment }}</b> of <b>${{ $price }}</b>.
                                    Una vez que haya hecho este depósito,
                                    tome una fotografía del comprobante de depósito y envíesela a su coordinador para comenzar el proceso de programación.
                                </p>

                                <p>
                                    <b>Indicaciones prequirúrgicas</b>
                                </p>
                                <p>
                                    Ahora que ha sido aprobado por nuestro Cirujano, siga estas indicaciones antes de la cirugía:
                                </p>

                                <p>
                                    1.Sin alcohol (dieta preoperatoria), una vez que comience su dieta, no debe beber alcohol.
                                </p>
                                <p>
                                    2.No fumar de ningún tipo (VAPING / TABACO / MARIHUANA), necesario al menos 5 semanas antes de la cirugía.
                                </p>
                                <p>
                                    3.Sin Aspirina, Necesaria por lo menos una semana antes de la cirugía.
                                </p>
                                <p>
                                    4.Sin control de la natalidad ni tratamiento hormonal (anticonceptivos orales), necesario suspender 30 días antes de la cirugía.
                                </p>
                                <p>
                                    5.Sin esmalte de uñas ni acrílicos (manos y dedos de los pies), ya que dificulta la lectura del oxímetro y debemos asegurarnos de que su cuerpo se oxigene correctamente.
                                </p>
                                <p>
                                    6.Sin pestañas postizas.
                                </p>
                                <p>
                                    7.Sin perforaciones, quíteselas todas sin excepción.
                                </p>
                                <br>
                                <h3>
                                    <b>TENGA EN CUENTA:</b>
                                </h3>
                                <ul>
                                    <li>Si está tomando medicamentos para la tiroides o la presión arterial, continúe haciéndolo hasta la mañana del preoperatorio con un poco de agua.</li>
                                     <li>Si toma antidepresivos, no los suspenda y tómelos en la mañana del preoperatorio con un poco de agua.</li>
                                     <li>Si es un paciente que necesita usar un CPAP, tráigalo con usted.</li>
                                     <li>Si toma anticoagulantes, suspéndalos 10 días antes de la cirugía.</li>
                                     <li>Los pacientes deben suspender esteroides e inmunodepresores 1 mes antes de la cirugía.</li>
                                     <li>Los pacientes deben suspender la aspirina y cualquier AINE de 7 a 10 días antes de la cirugía.</li>
                                     <li>NSAID’s:</li>
                                     <li>Ibuprofina, naproxeno, diclofenaco, celecoxib, ácido nefenámico, etoricoxib, indometacina, dosis altas de aspirina.</li>
                                </ul>
                                <p>
                                    Es muy importante que sigas estas indicaciones y si tienes alguna duda no dudes en ponerte en contacto con tu coordinador estaremos encantados de atender cualquiera de tus consultas.
                                </p>

                                <h5  style="text-align: center">
                                    <b>Prueba PCR Covid19 es obligatoria para pacientes y acompañantes.</b>
                                </h5>
                                <p>
                                    Debe realizarse con menos de 5 días antes de la fecha de la cirugía (no antes) por favor envíeme los resultados.
                                </p>
                                <p>
                                    <b>
                                        <i>
                                            Todos en Centro Quirúrgico J.L.Prado queremos felicitarte y juntos abriremos este nuevo capítulo en tu vida.
                                        </i>
                                    </b>
                                </p>

                                <h5 style="text-align: center">
                                    <b>INFORMACIÓN DE DEPÓSITO Y RESERVA.</b>
                                </h5>
                                <p>- Transferencia bancaria a nuestra cuenta</p>
                                <p>- Depósito directo a nuestra cuenta</p>
                                <p>- Efectivo</p>
                                <p>- Tarjeta de crédito (tarifa del 3,9 % por procesamiento de tarjeta)</p>
                                <p><b>*La tarjeta debe estar a nombre del paciente*</b></p>
                                <p>- Cheque certificado o cheque de caja a nombre de:</p>
                                <h3><b>JLPRADO & ASSOCIATES, INC</b></h3>
                                <p>Número de cuenta bancaria</p>
                                <p><b>JL Prado & Associates Inc.</b></p>
                                <p>FIRST BANK</p>
                                <p>Routing #081009428</p>
                                <p>Account #1048742079</p>
                                <br>
                                <p>FIRST BANK</p>
                                <p>878 Eastlake Pkwy Suite 1310</p>
                                <p>Chula Vista Ca 91914</p>
                                <br>
                                <p><b>** SIN PAGOS EN LÍNEA**</b></p>
                                <p><b>** NO HAY TARJETAS FSA**</b></p>
                                <hr>
                                <ul>
                                    <li>
                                        El saldo restante se puede pagar antes de la fecha de su cirugía (1 semana antes si
                                        cableado).
                                    </li>
                                    <li>
                                        Puede realizar tantos pagos por adelantado como desee, completando el saldo total "antes de la cirugía".
                                    </li>
                                    <li>
                                        Puede pagar su saldo el día de su llegada en efectivo o cheque certificado/de caja.
                                    </li>
                                </ul>
                                <br>
                                <h5 style="text-align: center">
                                    <b>
                                        POLÍTICA DE CANCELACIÓN
                                    </b>
                                </h5>
                                <p>
                                    <b>**</b> Tiene 24 horas para cancelar después de realizar el depósito para recibir un reembolso completo <b>**</b>
                                </p>
                                <p>
                                    <b>**</b> Si un paciente cancela la cirugía una vez en el Centro Quirúrgico J.L.Prado por razones personales y no médicas, el monto pagado por la cirugía se perderá para cubrir el costo de los servicios prestados, así como el costo cancelado de la cirugía.
                                 </p>
                                 <p>
                                    <b><i>Coste cancelado:</i></b> es la pérdida de ingresos por cancelaciones. No está influenciado por su política de cancelación, simplemente muestra los ingresos potenciales totales que podría haber generado sin las cancelaciones.
                                </p>
                                <br>
                                <h5 style="text-align: center">
                                    <b>
                                        POLÍTICA DE REPROGRAMACIÓN
                                    </b>
                                </h5>
                                <p>
                                    La reprogramación debe hacerse 3 semanas antes de la fecha de la cirugía para no perder el depósito inicial (10% del costo de la cirugía).
                                </p>
                                <p>
                                    Reprogramación una sola vez, una segunda reprogramación, el paciente perderá el depósito inicial y tendrá que comenzar todo el proceso, incluido el depósito inicial.
                                </p>
                                <br>
                                <p>
                                    - Si se cancela la cirugía por no seguir la dieta o indicaciones pre quirúrgicas no se devolverá el dinero pagado por la cirugía.
                                </p>
                                <p>
                                    - Si la cirugía es cancelada por un problema de salud durante la evaluación pre operatoria, se descontarán $1200 dlls para cubrir los gastos médicos y el resto será reembolsado al paciente.
                                </p>
                                <p style="margin: 0;padding: 0;"><b>{{ strtoupper($brand->acronym) }}</b></p>
                                <p style="margin: 0;padding: 0;">{{ $coordinator->name }}</p>
                                <p style="margin: 0;padding: 0;">{{ $coordinator->email }}</p>
                                <p style="margin: 0;padding: 0;">{{ $coordinator->phone }}</p>
                                <p style="margin: 0;padding: 0;">Business Hours:</p>
                                <p style="margin: 0;padding: 0;">Mon-Fri 9am-5pm</p>
                                <p style="margin: 0;padding: 0;">Sat 9 am-2pm</p>
                                <p style="margin: 0;padding: 0;">Sundays CLOSED</p>
                            </td>
                        </tr>
                    </table>
                </div>
                {{-- @include('staff.mail.email-footer') --}}
            </td>
        </tr>
    </table>
@endsection
