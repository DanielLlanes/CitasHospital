<?php




function facilities($lang)
{
	if ($lang == 'en') {
		return 
		'<div class="section-title mb-5" data-aos="fade-up">
                <h2>Our<strong> Facilities</strong></h2>

                    <h3>Welcome to JLPrado HOSPITAL</h3> 
                    <h4>The first of its kind</h4>

            </div>

            <div class="row" data-aos="fade-up">
                <p class="text-left">Why have a surgery and recover in a hospital when you can have both a Hospital and a Hotel in one place at the same time?</p>

                <p class="text-left">In JLPrado HOSPITAL not only will you have the best results and excellent care, you will also feel like you are on vacation in a friendly environment.</p>

                <p class="text-left">We have upgraded our facilities.</p>

                <p class="text-left">Now with our own ICU and our private hospital rooms considered each one of them an Intermediate care unit where you are monitorized all the way to our nurses station 24/7 with our new telemetry system, you can feel more safer being attended every moment from a closer watch.</p>
            </div>';
	} else {
			return 
			'<div class="section-title mb-5" data-aos="fade-up">
	                <h2>Nuestras<strong> Instalaciones</strong></h2>

	                    <h3>Bienvenido a JLPrado JLPrado HOSPITAL</h3> 
	                    <h4>El primero de su clase</h4>

	            </div>

	            <div class="row" data-aos="fade-up">
	                <p class="text-left">¿Por qué operarse y recuperarse en un hospital cuando puede tener un Hospital y un Hotel en un mismo lugar al mismo tiempo?</p>

	                <p class="text-left">En JLPrado HOSPITAL no sólo tendrá los mejores resultados y una excelente atención, sino que además se sentirá como si estuviera de vacaciones en un ambiente agradable.</p>

	                <p class="text-left">Hemos mejorado nuestras instalaciones.</p>

	                <p class="text-left">Ahora con nuestra propia UCI y nuestras habitaciones privadas de hospitalización consideradas cada una de ellas como una unidad de cuidados intermedios en la que usted está monitorizado hasta nuestro puesto de enfermería las 24 horas del día con nuestro nuevo sistema de telemetría, podrá sentirse más seguro siendo atendido en todo momento desde una vigilancia más cercana.</p>
	            </div>';
	}
}