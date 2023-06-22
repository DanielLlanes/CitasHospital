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
                                Estimado/a <b>{{ $patient }}</b>,
                                @if (  strtolower($brand->brand)  == 'a beautiful me')
                                {{-- ABM --}}
                                    <p>¡Felicitaciones, ha sido aprobado para la cirugía plástica!</p>

                                    @isset($sugerencias)
                                        <br>
                                        @if (count($sugerencias) > 0)
                                        <p>Estos son los procedimientos que sugerimos que pueden ayudarte a lograr tus objetivos:</p>
                                            <ul style="list-style-type: none;">
                                                @foreach ($sugerencias as $s)
                                                    @if ($s->name !== 'Sin Sugerencias')
                                                        <li>
                                                            <strong>{{ $s->name }}</strong>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        @endif
                                    @endisset
                                    <br>
                                    <p>El precio total del paquete es de US${{ $price }}, y esta cotización es válida por 3 meses. Queremos que te sientas tranquilo, por eso nuestro paquete incluye todos los servicios necesarios para que tu experiencia sea lo más completa posible:</p>
                                    <br>
                                    <ul style="list-style-type: none;">
                                        @foreach ($includes as $item)
                                            <li>{{ $item->contain_es }}</li>
                                        @endforeach
                                    </ul>
                                @elseif ( strtolower($brand->brand) == 'a slimmer me')
                                {{-- ASM --}}
                                    <br>
                                    <p>¡Felicidades, ha sido aprobado para una Cirugía de {{ $procedure }}!, Su paquete incluye lo siguiente:</p>
                                    <br>
                                    <ul style="list-style-type: none;">
                                        @foreach ($includes as $item)
                                            <li>{{ $item->contain_en }}</li>
                                        @endforeach
                                    </ul>

                                    
                                @endif
                                 <p>Para reservar la fecha de su cirugía, requerimos un depósito del 10%. Que en este caso es ${{ $downPayment }} de ${{ $price }}. Una vez que haya realizado este depósito, envíe una foto del recibo a su coordinador para iniciar el proceso de programación.</p>

                                 <p>En <b>J.L.Prado Surgical Center</b>, nos enorgullecemos de brindar la mejor atención posible, y cuidar su salud y bienestar es nuestra principal prioridad. Queremos que te sientas cómodo y seguro durante todo el proceso, por eso hemos preparado varias opciones de pago para tu comodidad:</p>
                                 <br>
                                 <p>
                                    INFORMACIÓN DE DEPÓSITO Y RESERVAS.<br>
                                    Estas son las opciones que ofrecemos para realizar su depósito/pago:<br>
                                    - Transferencia bancaria a nuestra cuenta<br>
                                    - Depósito directo a nuestra cuenta<br>
                                    - Efectivo<br>
                                    - Tarjeta de crédito (tarifa del 3.9% por procesamiento de la tarjeta)<br>
                                    NOTA: La tarjeta debe estar a nombre del paciente<br>
                                    - Cheque certificado o cheque de caja a nombre de: JL Prado & Associates, Inc.
                                </p>
                                
                                <p>
                                    PAGO DEL SALDO<br>
                                    Puede pagar el saldo en efectivo, tarjeta, transferencia bancaria, cheque de caja a: JLPRADO & ASSOCIATES, INC.<br>
                                    * El saldo puede pagarse por adelantado o el día de llegada, debe pagarse antes de iniciar la evaluación preoperatoria.<br>
                                    Nombre del banco: FIRST BANK<br>
                                    JL Prado & Associates, inc.<br>
                                    CUENTA: 1048742079<br>
                                    RUTA: 081009428<br>
                                    2494 Roll Dr<br>
                                    San Diego, Ca 92154<br>
                                    ** NO SE ACEPTAN PAGOS EN LÍNEA**<br>
                                    ** NO SE ACEPTAN TARJETAS FSA (Cuentas de gastos flexibles)**
                                </p>
                                
                                <p>
                                    • El 35% del paquete debe cubrirse dos semanas antes de la cirugía.<br>
                                    • El saldo restante (65%) puede pagarse antes de la fecha de la cirugía (1 semana antes si es por transferencia bancaria)<br>
                                    • Puede realizar tantos pagos anticipados como desee, completando el saldo total "antes de la cirugía"<br>
                                    • Puede pagar el saldo el día de su llegada en efectivo, cheque certificado/cheque de caja o tarjeta de crédito (con una tarifa de servicio del 3.9%)
                                </p>
                                
                                <p>
                                    POLÍTICA DE CANCELACIÓN<br>
                                    ** El 10% del depósito no es reembolsable **<br>
                                    ** Si un paciente cancela la cirugía una vez en J.L.Prado Surgical Center por razones personales y no médicas, el monto pagado por la cirugía se perderá para cubrir el costo de los servicios prestados, así como el costo cancelado de la cirugía.<br>
                                    Costo cancelado: es la pérdida de ingresos por cancelaciones. No está influenciado por su política de cancelación, simplemente muestra los ingresos potenciales totales que podría haber generado sin las cancelaciones.<br>
                                    - Si se cancela la cirugía debido a no seguir la dieta o las indicaciones prequirúrgicas, el dinero pagado por la cirugía no será reembolsado.<br>
                                    - Si se cancela la cirugía debido a un problema de salud durante la evaluación preoperatoria, se deducirán $1200 dólares para cubrir gastos médicos y el resto se reembolsará al paciente.<br>
                                    - Si se cancela la cirugía dentro de las dos semanas previas a la fecha de la cirugía, no se realizará ningún reembolso.
                                </p>
                                
                                <p>
                                    POLÍTICA DE CAMBIO DE FECHA<br>
                                    El cambio de fecha debe hacerse 3 semanas antes de la fecha de la cirugía para que su depósito inicial sea válido, de lo contrario, deberá realizar un depósito inicial para programar una nueva fecha.<br>
                                    Solo se permite cambiar la fecha una vez, en caso de un segundo cambio de fecha, el paciente deberá comenzar el proceso nuevamente, incluido el depósito inicial.
                                </p>
                                 <br>
                                 <p>Un cordial saludo,</p>
                                <br>
                                <p style="margin: 0;padding: 0;">{{ $coordinator->name }}</p>
                                <p style="margin: 0;padding: 0;"{{ strtoupper($brand->acronym) }} Coordinador</p>
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
