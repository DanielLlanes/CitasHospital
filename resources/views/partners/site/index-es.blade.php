<!doctype html>
<html lang="{{ $lang }}">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ env('APP_URL_PARTNER') }}/siteFiles/assets/vendor/dropify/dist/css/dropify.min.css" rel="stylesheet">
    <link href="{{ env('APP_URL_PARTNER') }}/siteFiles/css/apiApps.css" rel="stylesheet">
    <title>Applications</title>

    
  </head>
  <body id="top">
    <div class="loading"></div>
    </div>
    <div class="col-12" style="margin-bottom: 100px;"></div>
    <div class="col-12">
      <style>
      input[type="text"], input[type="email"], input[type="url"], input[type="password"], input[type="search"], input[type="tel"], input[type="number"], input[type="range"], input[type="date"], input[type="month"], input[type="week"], input[type="time"], input[type="datetime"], input[type="datetime-local"], input[type="color"], textarea, select, .nice-select {
           background-color: transparent!important; 
          -webkit-border-radius: 4px;
          -khtml-border-radius: 4px;
          -moz-border-radius: 4px;
          -ms-border-radius: 4px;
          -o-border-radius: 4px;
           border-radius: 4px; 
           border: 1px solid #ced4da; 
          color: #848e9f;
          padding: 0 20px;
          line-height: normal;
           height: calc(1.5em + 0.5rem + 2px); 
          font-size: .875rem;
          -webkit-transition: all 300ms linear 0ms;
          -khtml-transition: all 300ms linear 0ms;
          -moz-transition: all 300ms linear 0ms;
          -ms-transition: all 300ms linear 0ms;
          -o-transition: all 300ms linear 0ms;
          transition: all 300ms linear 0ms;
          -webkit-box-shadow: none;
          -khtml-box-shadow: none;
          -moz-box-shadow: none;
          -ms-box-shadow: none;
          -o-box-shadow: none;
          box-shadow: none;
          width: 100%;
          outline: none;
      }
      .nice-select span.current {
          display: block;
          overflow: hidden;
          text-overflow: ellipsis;
          white-space: nowrap;
          line-height: 30px;
      }
    </style>
      <section id="team" class="team">
        <div class="container">
          <div class="section-title mb-5" data-aos="fade-up">
          </div>
        </div>
        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6 px-5 p-md-0">
            <div class="d-none progress">
              <div class="progress-bar progress-bar-striped bg-danger" id="steps" role="progressbar" style="width: 0;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">0%</div>
            </div>
            <form class="appsForm" enctype="multipart/form-data mt-3 mb-3">
              <div class="step">
                <div class="mb-2 row">
                  <div class="col-3"></div>
                  <div class="col-sm-9">
                    <p for="staticEmail" class="col-form-label col-form-label-sm text-center">¿Has recibido algún tratamiento con nosotros anteriormente?</p>
                  </div>
                </div>
                <div class="row mb-5">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm"></label>
                  <div class="col-sm-9 text-center checkBox">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="treatmentBefore" id="treatmentBeforeYes" value="1" >
                      <label class="form-check-label" for="treatmentBeforeYes">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="treatmentBefore" checked id="treatmentBeforeNo" value="0" >
                      <label class="form-check-label" for="treatmentBeforeNo">No</label>
                    </div>
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Correo electrónico</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="email" name="email" value="" placeholder="email@example.com">
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Nombre</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="name" name="name" value="" placeholder="Name">
                  </div>
                </div>
                <div id="data-hidde">
                  <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Sexo biologico</label>
                    <div class="col-sm-9">
                      <select name="sex" id="sex" class="form-select form-select-sm">
                        <option value="" disabled selected>Selecionar....</option>
                        <option value="male" >Male</option>
                        <option value="female" >Female</option>
                      </select>
                      <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Fecha de naciemiento</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control form-control-sm fecha" id="dob" name="dob" value="" placeholder="Fecha de naciemiento" data-inputmask="'alias': 'datetime', 'inputFormat': 'dd/mm/yyyy'">
                      <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Edad</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control form-control-sm" id="age" name="age" value="" placeholder="Age">
                      <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Teléfono</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control form-control-sm" id="phone" name="phone" value="" placeholder="phone">
                      <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Movil</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control form-control-sm" id="mobile" name="mobile" value="" placeholder="Mobile">
                      <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Dirección</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control form-control-sm" id="address" name="address" value="" placeholder="Address">
                      <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Pais</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control form-control-sm" name="country_id" id="country_id" value="" placeholder="Pais">
                      <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Estado </label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control form-control-sm" name="state_id" state="" id="state_id" value="" placeholder="Estado">
                      <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Ciudad</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control form-control-sm" id="city" name="city" value="" placeholder="City">
                      <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Código Postal</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control form-control-sm" id="zip" name="zip" value="" placeholder="Zip">
                      <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Nombre de contacto de emergencia</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control form-control-sm" id="ecn" name="ecn" value="" placeholder="Emergency Contact Name">
                      <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Teléfono de contacto de emergencia</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control form-control-sm" id="ecp" name="ecp" value="" placeholder="Emergency Contact Phone">
                      <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Seleccionar servicio </label>
                    <div class="col-sm-9">
                      <select name="service" id="select-service-select" class="form-control form-control-sm w-100">
                        <option value="" disabled selected>Selecionar....</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Seleccionar procedimiento</label>
                  <div class="col-sm-9">
                    <select name="procedure" id="select-procedure-select" class="form-control form-control-sm w-100">
                      <option value="" disabled selected>Selecionar....</option>
                    </select>
                  </div>
                </div>
                <div class="mb-3 row d-none" id="package">
                  <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Seleccionar paquete</label>
                  <div class="col-sm-9">
                  <select name="package" id="select-package-select" class="form-control form-control-sm w-100" style="width: 100%;">
                    <option value="" disabled selected>Selecionar....</option>
                  </select>
                  </div>
                </div>
                <span class="invalid-feedback text-center" id="treatment" style="display: block!important;" role="alert"></span>
              </div>
              <div class="step">
                <div class="row" id="images-area">
                 <div id="images_all" class="text-center invalid-feedback"></div>
                </div>
              </div>
              <div class="step">
                <div class="mb-2 row">
                  <div class="col-3"></div>
                  <div class="col-sm-9">
                    <p for="staticEmail" class="col-form-label col-form-label-sm text-center">Seleccione su sistema de medición preferido</p>
                  </div>
                </div>
                <div class="row mb-5">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm"></label>
                  <div class="col-sm-9 text-center checkBox">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="mesure_sistem" checked id="mesureSistemMetric" value="M" >
                      <label class="form-check-label" for="mesureSistemMetric">Metrico ( kg-metros )</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="mesure_sistem" id="mesureSistemImperial" value="I" >
                      <label class="form-check-label" for="mesureSistemImperial"> Imperial ( lb-in )</label>
                    </div>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Peso máximo <span class="fw-bold" id="mw"> (Kg)</span></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="max_weigh" name="max_weigh" value="" placeholder="">
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Peso actual <span class="fw-bold" id="cw"> (Kg)</span></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="weight" name="weight" value="" placeholder="">
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Altura <span class="fw-bold" id="h"> (Mts)</span></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="height" name="height" value="" placeholder="">
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">IMC</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="imc" name="imc" value="" placeholder="">
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-2 row">
                  <div class="col-3 d-none d-md-block"></div>
                  <div class="col-sm-9">
                    <p for="staticEmail" class="col-form-label col-form-label-sm">¿Toma algún medicamento o droga?</p>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm"></label>
                  <div class="col-sm-9 checkBox">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="take_medication" id="take_medication_yes" value="1" >
                      <label class="form-check-label" for="take_medication_yes">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="take_medication" id="take_medication_no" value="0" >
                      <label class="form-check-label" for="take_medication_no">No</label>
                    </div>
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="col-12" id="medication_table" style="display: none">
                  <table class="table">
                    <thead>
                      <tr>
                        <th style="font-weight: 600; font-size: .9rem; display: none">Orden</th>
                        <th style="font-weight: 600; font-size: .9rem;">Nombre del medicamento</th>
                        <th style="font-weight: 600; font-size: .9rem;">Razón</th>
                        <th style="font-weight: 600; font-size: .9rem;">Dosis</th>
                        <th style="font-weight: 600; font-size: .9rem;">Frecuencia</th>
                        <th style="font-weight: 600; font-size: .9rem;">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                  <div class="col-12 d-flex justify-content-end">
                    <button type="button" class="btn btn-primary text-white mb-3 btn-sm" id="medicationTableAdd">Agregar medicamento</button>
                  </div>
                </div>
                <div class="mb-2 row">
                  <div class="col-3 d-none d-md-block"></div>
                  <div class="col-sm-9">
                    <p for="staticEmail" class="col-form-label col-form-label-sm">¿Toma o ha tomado en el pasado anticoagulantes?</p>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm"></label>
                  <div class="col-sm-9 checkBox">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="blood_thinners" id="blood_thinners_yes" value="1" >
                      <label class="form-check-label" for="blood_thinners_yes">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="blood_thinners" id="blood_thinners_no" value="0" >
                      <label class="form-check-label" for="blood_thinners_no">No</label>
                    </div>
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row" id="rbt" style="display: none">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Explica la razón</span></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="razon_blood_thinners" name="razon_blood_thinners" value="" placeholder="">
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-2 row">
                  <div class="col-3 d-none d-md-block"></div>
                  <div class="col-sm-9">
                    <p for="staticEmail" class="col-form-label col-form-label-sm">¿Sufres de reflujo ácido?</p>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm"></label>
                  <div class="col-sm-9 checkBox">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="acid_reflux" id="if_acid_reflux_ralery" value="rarely" >
                      <label class="form-check-label" for="if_acid_reflux_ralery">Raramente</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="acid_reflux" id="if_acid_reflux_occasionally" value="occasionally" >
                      <label class="form-check-label" for="if_acid_reflux_occasionally">Ocasionalmente</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="acid_reflux" id="if_acid_reflux_frequently" value="frequently" >
                      <label class="form-check-label" for="if_acid_reflux_frequently">Frequentemente</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="acid_reflux" id="if_acid_reflux_no" value="no"  checked >
                      <label class="form-check-label" for="if_acid_reflux_no">No</label>
                    </div>
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-2 row">
                  <div class="col-3 d-none d-md-block"></div>
                  <div class="col-sm-9">
                    <p for="staticEmail" class="col-form-label col-form-label-sm">alergia a la penicilina</p>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm"></label>
                  <div class="col-sm-9 checkBox">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="penicilin" id="penicilin_yes" value="1" >
                      <label class="form-check-label" for="penicilin_yes">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="penicilin" id="penicilin_no" value="0" >
                      <label class="form-check-label" for="penicilin_no">No</label>
                    </div>
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-2 row">
                  <div class="col-3 d-none d-md-block"></div>
                  <div class="col-sm-9">
                    <p for="staticEmail" class="col-form-label col-form-label-sm">Medicamentos con sulfa</p>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm"></label>
                  <div class="col-sm-9 checkBox">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="drugs_sulfa" id="drugs_sulfa_yes" value="1" >
                      <label class="form-check-label" for="drugs_sulfa_yes">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="drugs_sulfa" id="drugs_sulfa_no" value="0" >
                      <label class="form-check-label" for="drugs_sulfa_no">No</label>
                    </div>
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-2 row">
                  <div class="col-3 d-none d-md-block"></div>
                  <div class="col-sm-9">
                    <p for="staticEmail" class="col-form-label col-form-label-sm">Alergia al yodo</p>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm"></label>
                  <div class="col-sm-9 checkBox">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="iodine" id="iodine_yes" value="1" >
                      <label class="form-check-label" for="iodine_yes">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="iodine" id="iodine_no" value="0" >
                      <label class="form-check-label" for="iodine_no">No</label>
                    </div>
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-2 row">
                  <div class="col-3 d-none d-md-block"></div>
                  <div class="col-sm-9">
                    <p for="staticEmail" class="col-form-label col-form-label-sm">Alergia a la cinta adhesiva</p>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm"></label>
                  <div class="col-sm-9 checkBox">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="tape" id="tape_yes" value="1" >
                      <label class="form-check-label" for="tape_yes">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="tape" id="tape_no" value="0" >
                      <label class="form-check-label" for="tape_no">No</label>
                    </div>
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-2 row">
                  <div class="col-3 d-none d-md-block"></div>
                  <div class="col-sm-9">
                    <p for="staticEmail" class="col-form-label col-form-label-sm">Alergia al látex</p>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm"></label>
                  <div class="col-sm-9 checkBox">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="latex" id="latex_yes" value="1" >
                      <label class="form-check-label" for="latex_yes">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="latex" id="latex_no" value="0" >
                      <label class="form-check-label" for="latex_no">No</label>
                    </div>
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-2 row">
                  <div class="col-3 d-none d-md-block"></div>
                  <div class="col-sm-9">
                    <p for="staticEmail" class="col-form-label col-form-label-sm">Alergia a la aspirina</p>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm"></label>
                  <div class="col-sm-9 checkBox">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="aspirin" id="aspirin_yes" value="1" >
                      <label class="form-check-label" for="aspirin_yes">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="aspirin" id="aspirin_no" value="0" >
                      <label class="form-check-label" for="aspirin_no">No</label>
                    </div>
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row mt-1">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Otras alergias </span></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="describe_other_allergy" name="describe_other_allergy" value="" placeholder="">
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
              </div>
              <div class="step">
                <div class="mb-2 row">
                  <div class="col-3 d-none d-md-block"></div>
                  <div class="col-sm-9">
                    <p for="staticEmail" class="col-form-label col-form-label-sm">¿Se ha sometido anteriormente a alguna intervención quirúrgica?</p>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm"></label>
                  <div class="col-sm-9 checkBox">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="previus_surgery" id="if_take_medication_yes" value="1" >
                      <label class="form-check-label" for="if_take_medication_yes">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="previus_surgery" id="if_take_medication_no" value="0" >
                      <label class="form-check-label" for="if_take_medication_no">No</label>
                    </div>
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>

                <div class="col-12" id="surgery_table" style="display: none">
                  <table class="table">
                    <thead>
                      <tr>
                        <th style="font-weight: 600; font-size: .9rem; display: none">Orden</th>
                        <th style="font-weight: 600; font-size: .9rem;">Tipo</th>
                        <th style="font-weight: 600; font-size: .9rem;">Nombre</th>
                        <th style="font-weight: 600; font-size: .9rem;">Edad</th>
                        <th style="font-weight: 600; font-size: .9rem;">Año</th>
                        <th style="font-weight: 600; font-size: .9rem;">Complicaciones</th>
                        <th style="font-weight: 600; font-size: .9rem;">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                  <div class="col-12 d-flex justify-content-end">
                    <button type="button" class="btn btn-primary btn-sm text-white mb-3" id="surgeyTableAdd">Añadir cirugía</button>
                  </div>
                </div>
              </div>
              <div class="step">
                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Adicciones</label>
                  <div class="col-sm-9 checkBox">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="addiction" id="addiction_yes" value="1" >
                      <label class="form-check-label" for="addiction_yes">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="addiction" id="addiction_no" value="0" >
                      <label class="form-check-label" for="if_take_medication_no">No</label>
                    </div>
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row" id="which_one"  style="display: none" >
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">¿Cuál? </span></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="which_one_adiction" name="which_one_adiction" value="" placeholder="">
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Niveles elevados de lípidos</label>
                  <div class="col-sm-9 checkBox">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="high_lipid_levels" id="high_lipid_levels_yes" value="1" >
                      <label class="form-check-label" for="if_take_medication_yes">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="high_lipid_levels" id="high_lipid_levels_no" value="0" >
                      <label class="form-check-label" for="if_take_medication_no">No</label>
                    </div>
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row mt-1 high_lipid_levels"  style="display: none">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Fecha de diagnóstico</span></label>
                  <div class="col-sm-9">
                    <input type="input" class="form-control form-control-sm" id="date_high_lipid_levels" name="date_high_lipid_levels" value="" placeholder="Fecha" data-inputmask="'alias': 'datetime', 'inputFormat': 'dd/mm/yyyy'">
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row mt-1 high_lipid_levels"  style="display: none">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Tratamiento</span></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="treatment_high_lipid_levels" name="treatment_high_lipid_levels" value="" placeholder="">
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>

                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Artritis</label>
                  <div class="col-sm-9 checkBox">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="arthritis" id="arthritis_yes" value="1" >
                      <label class="form-check-label" for="arthritis_yes">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="arthritis" id="arthritis_no" value="0" >
                      <label class="form-check-label" for="arthritis_no">No</label>
                    </div>
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row mt-1 arthritis"  style="display: none">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Fecha de diagnóstico </span></label>
                  <div class="col-sm-9">
                    <input type="input" class="form-control form-control-sm" id="date_arthritis" name="date_arthritis" value="" placeholder="Fecha" data-inputmask="'alias': 'datetime', 'inputFormat': 'dd/mm/yyyy'">
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row mt-1 arthritis"  style="display: none">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Tratamiento</span></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="treatment_arthritis" name="treatment_arthritis" value="" placeholder="">
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Cancer</label>
                  <div class="col-sm-9 checkBox">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="cancer" id="cancer_yes" value="1" >
                      <label class="form-check-label" for="cancer_yes">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="cancer" id="cancer_no" value="0" >
                      <label class="form-check-label" for="cancer_no">No</label>
                    </div>
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row mt-1 cancer"  style="display: none">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Fecha de diagnóstico </span></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="date_cancer" name="date_cancer" value="" placeholder="Fecha" data-inputmask="'alias': 'datetime', 'inputFormat': 'dd/mm/yyyy'">
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row mt-1 cancer"  style="display: none">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Tratamiento</span></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="treatment_cancer" name="treatment_cancer" value="" placeholder="">
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Colesterol</label>
                  <div class="col-sm-9 checkBox">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="cholesterol" id="cholesterol_yes" value="1" >
                      <label class="form-check-label" for="cholesterol_yes">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="cholesterol" id="cholesterol_no" value="0" >
                      <label class="form-check-label" for="cholesterol_no">No</label>
                    </div>
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row mt-1 cholesterol"  style="display: none">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Fecha de diagnóstico </span></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="date_cholesterol" name="date_cholesterol" value="" placeholder="Fecha" data-inputmask="'alias': 'datetime', 'inputFormat': 'dd/mm/yyyy'">
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row mt-1 cholesterol"  style="display: none">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Tratamiento</span></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="treatment_cholesterol" name="treatment_cholesterol" value="" placeholder="">
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Triglicéridos</label>
                  <div class="col-sm-9 checkBox">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="triglycerides" id="triglycerides_yes" value="1" >
                      <label class="form-check-label" for="triglycerides_yes">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="triglycerides" id="triglycerides_no" value="0" >
                      <label class="form-check-label" for="triglycerides_no">No</label>
                    </div>
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row mt-1 triglycerides"  style="display: none">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Fecha de diagnóstico </span></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="date_triglycerides" name="date_triglycerides" value="" placeholder="Fecha" data-inputmask="'alias': 'datetime', 'inputFormat': 'dd/mm/yyyy'">
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row mt-1 triglycerides"  style="display: none">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Tratamiento</span></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="treatment_triglycerides" name="treatment_triglycerides" value="" placeholder="">
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>

                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Apoplejía</label>
                  <div class="col-sm-9 checkBox">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="stroke" id="stroke_yes" value="1" >
                      <label class="form-check-label" for="stroke_yes">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="stroke" id="stroke_no" value="0" >
                      <label class="form-check-label" for="stroke_no">No</label>
                    </div>
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row mt-1 stroke"  style="display: none">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Fecha de diagnóstico </span></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="date_stroke" name="date_stroke" value="" placeholder="Fecha" data-inputmask="'alias': 'datetime', 'inputFormat': 'dd/mm/yyyy'">
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row mt-1 stroke"  style="display: none">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Tratamiento</span></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="treatment_stroke" name="treatment_stroke" value="" placeholder="">
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Diabetes</label>
                  <div class="col-sm-9 checkBox">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="diabetes" id="diabetes_yes" value="1" >
                      <label class="form-check-label" for="diabetes_yes">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="diabetes" id="diabetes_no" value="0" >
                      <label class="form-check-label" for="diabetes_no">No</label>
                    </div>
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row mt-1 diabetes"  style="display: none">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Fecha de diagnóstico </span></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="date_diabetes" name="date_diabetes" value="" placeholder="Fecha" data-inputmask="'alias': 'datetime', 'inputFormat': 'dd/mm/yyyy'">
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row mt-1 diabetes"  style="display: none">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Tratamiento</span></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="treatment_diabetes" name="treatment_diabetes" value="" placeholder="">
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Enfermedad arterial coronaria</label>
                  <div class="col-sm-9 checkBox">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="coronary_artery_disease" id="coronary_artery_disease_yes" value="1" >
                      <label class="form-check-label" for="coronary_artery_disease_yes">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="coronary_artery_disease" id="coronary_artery_disease_no" value="0" >
                      <label class="form-check-label" for="coronary_artery_disease_no">No</label>
                    </div>
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row mt-1 coronary_artery_disease"  style="display: none">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Fecha de diagnóstico </span></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="date_coronary_artery_disease" name="date_coronary_artery_disease" value="" placeholder="Fecha" data-inputmask="'alias': 'datetime', 'inputFormat': 'dd/mm/yyyy'">
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row mt-1 coronary_artery_disease"  style="display: none">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Tratamiento</span></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="treatment_coronary_artery_disease" name="treatment_coronary_artery_disease" value="" placeholder="">
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Enfermedades del hígado</label>
                  <div class="col-sm-9 checkBox">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="liver_disease" id="liver_disease_yes" value="1" >
                      <label class="form-check-label" for="liver_disease_yes">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="liver_disease" id="liver_disease_no" value="0" >
                      <label class="form-check-label" for="liver_disease_no">No</label>
                    </div>
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row mt-1 liver_disease"  style="display: none">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Fecha de diagnóstico </span></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="date_liver_disease" name="date_liver_disease" value="" placeholder="Fecha" data-inputmask="'alias': 'datetime', 'inputFormat': 'dd/mm/yyyy'">
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row mt-1 liver_disease"  style="display: none">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Tratamiento</span></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="treatment_liver_disease" name="treatment_liver_disease" value="" placeholder="">
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Enfermedad pulmonar</label>
                  <div class="col-sm-9 checkBox">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="lugn_disease" id="lugn_disease_yes" value="1" >
                      <label class="form-check-label" for="lugn_disease_yes">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="lugn_disease" id="lugn_disease_no" value="0" >
                      <label class="form-check-label" for="lugn_disease_no">No</label>
                    </div>
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row mt-1 lugn_disease"  style="display: none">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Fecha de diagnóstico </span></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="date_lugn_disease" name="date_lugn_disease" value="" placeholder="Fecha" data-inputmask="'alias': 'datetime', 'inputFormat': 'dd/mm/yyyy'">
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row mt-1 lugn_disease"  style="display: none">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Tratamiento</span></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="treatment_lugn_disease" name="treatment_lugn_disease" value="" placeholder="">
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Enfermedad renal</label>
                  <div class="col-sm-9 checkBox">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="renal_disease" id="renal_disease_yes" value="1" >
                      <label class="form-check-label" for="renal_disease_yes">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="renal_disease" id="renal_disease_no" value="0" >
                      <label class="form-check-label" for="irenal_disease_no">No</label>
                    </div>
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row mt-1 renal_disease"  style="display: none">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Fecha de diagnóstico </span></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="date_renal_disease" name="date_renal_disease" value="" placeholder="Fecha" data-inputmask="'alias': 'datetime', 'inputFormat': 'dd/mm/yyyy'">
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row mt-1 renal_disease"  style="display: none">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Tratamiento</span></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="treatment_renal_disease" name="treatment_renal_disease" value="" placeholder="">
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Enfermedad tiroidea</label>
                  <div class="col-sm-9 checkBox">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="thyroid_disease" id="thyroid_disease_yes" value="1" >
                      <label class="form-check-label" for="thyroid_disease_yes">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="thyroid_disease" id="thyroid_disease_no" value="0" >
                      <label class="form-check-label" for="thyroid_disease_no">No</label>
                    </div>
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row mt-1 thyroid_disease"  style="display: none">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Fecha de diagnóstico </span></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="date_thyroid_disease" name="date_thyroid_disease" value="" placeholder="Fecha" data-inputmask="'alias': 'datetime', 'inputFormat': 'dd/mm/yyyy'">
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row mt-1 thyroid_disease"  style="display: none">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Tratamiento</span></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="treatment_thyroid_disease" name="treatment_thyroid_disease" value="" placeholder="">
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>

                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Hipertensión</label>
                  <div class="col-sm-9 checkBox">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="hypertension" id="hypertension_yes" value="1" >
                      <label class="form-check-label" for="hypertension_yes">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="hypertension" id="hypertension_no" value="0" >
                      <label class="form-check-label" for="hypertension_no">No</label>
                    </div>
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row mt-1 hypertension"  style="display: none">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Fecha de diagnóstico </span></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="date_hypertension" name="date_hypertension" value="" placeholder="Fecha" data-inputmask="'alias': 'datetime', 'inputFormat': 'dd/mm/yyyy'">
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row mt-1 hypertension"  style="display: none">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Tratamiento</span></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="treatment_hypertension" name="treatment_hypertension" value="" placeholder="">
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>

                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Cualquier otra enfermedad</label>
                  <div class="col-sm-9">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="any_other_illnesses" id="any_other_illnesses_yes" value="1" >
                      <label class="form-check-label" for="any_other_illnesses_yes">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="any_other_illnesses" id="any_other_illnesses_no" value="0" >
                      <label class="form-check-label" for="any_other_illnesses_no">No</label>
                    </div>
                  </div>
                </div>
                <div class="col-12" id="illness_table" style="display: none">
                  <table class="table">
                    <thead>
                      <tr>
                        <th style="font-weight: 600; font-size: .9rem;">¿Qué otra enfermedad? </th>
                        <th style="font-weight: 600; font-size: .9rem;">Fecha de diagnóstico</th>
                        <th style="font-weight: 600; font-size: .9rem;">Tratamiento</th>
                        <th style="font-weight: 600; font-size: .9rem;">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                  <div class="col-12 d-flex justify-content-end">
                    <button type="button" class="btn btn-primary btn-sm text-white mb-3" id="illnessTableAdd">Add illness</button>
                  </div>
                </div>
              </div>
              <div class="step">
                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">¿Fuma cigarrillos?</label>
                  <div class="col-sm-9 checkBox">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="smoke" id="smoke_yes" value="1" >
                      <label class="form-check-label" for="smoke_yes">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="smoke" id="smoke_no" value="0" >
                      <label class="form-check-label" for="smoke_no">No</label>
                    </div>
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row mt-1 smoke"  style="display: none">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Cantidad </span></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="cigars_smoke" name="cigars_smoke" value="" placeholder="">
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row mt-1 smoke"  style="display: none">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Numero de años </span></label>
                  <div class="col-sm-9">
                    <input type="number" class="form-control form-control-sm" id="years_smoke" name="years_smoke" value="" placeholder="">
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row smoke"  style="display: none">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">¿Has dejado de fumar?</label>
                  <div class="col-sm-9 checkBox">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="stop_smoking" id="stop_smoking_yes" value="1" >
                      <label class="form-check-label" for="stop_smoking_yes">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="stop_smoking" id="stop_smoking_no" value="0" >
                      <label class="form-check-label" for="stop_smoking_no">No</label>
                    </div>
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row mt-1 smoke_quit"  style="display: none">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">¿Cuánto tiempo? </span></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="when_stop_smoking" name="when_stop_smoking" value="" placeholder="">
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>

                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Vape</label>
                  <div class="col-sm-9 checkBox">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="vape" id="vape_yes" value="1" >
                      <label class="form-check-label" for="vape_yes">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="vape" id="vape_no" value="0" >
                      <label class="form-check-label" for="vape_no">No</label>
                    </div>
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>

                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">¿Consume usted alcohol?</label>
                  <div class="col-sm-9 checkBox">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="alcohol" id="alcohol_yes" value="1" >
                      <label class="form-check-label" for="alcohol_yes">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="alcohol" id="alcohol_no" value="0" >
                      <label class="form-check-label" for="alcohol_no">No</label>
                    </div>
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row mt-1 alcohol"  style="display: none">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Cantidad </span></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="volumen_alcohol" name="volumen_alcohol" value="" placeholder="">
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>

                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">¿Consume drogas recreativas?</label>
                  <div class="col-sm-9 checkBox">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="recreative_drugs" id="recreative_drugs_yes" value="1" >
                      <label class="form-check-label" for="recreative_drugs_yes">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="recreative_drugs" id="recreative_drugs_no" value="0" >
                      <label class="form-check-label" for="recreative_drugs_no">No</label>
                    </div>
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row mt-1 recreative_drugs"  style="display: none">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Amount </span></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="total_recreative_drugs" name="total_recreative_drugs" value="" placeholder="">
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="mb-3 row recreative_drugs"  style="display: none">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">¿Has consumido alguna vez drogas intravenosas (o de piel)?</label>
                  <div class="col-sm-9 checkBox">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="intravenous_drugs" id="intravenous_drugs_yes" value="1" >
                      <label class="form-check-label" for="intravenous_drugs_yes">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="intravenous_drugs" id="intravenous_drugs_no" value="0" >
                      <label class="form-check-label" for="intravenous_drugs_no">No</label>
                    </div>
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>

                <div class="mb-3 row mt-1 intravenous_drugs"  style="display: none">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Describir las drogas intravenosas </span></label>
                  <div class="col-sm-9">
                    <textarea type="text" class="form-control form-control-sm" id="description_intravenous_drugs" name="description_intravenous_drugs" value="" placeholder=""></textarea>
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>

                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">¿Se fatiga con facilidad?</label>
                  <div class="col-sm-9 checkBox">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="fatigue" id="fatigue_yes" value="1" >
                      <label class="form-check-label" for="fatigue_yes">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="fatigue" id="fatigue_no" value="0" >
                      <label class="form-check-label" for="fatigue_no">No</label>
                    </div>
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>

                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">¿Le falta el aire?</label>
                  <div class="col-sm-9 checkBox">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="trouble_breathe" id="trouble_breathe_yes" value="1" >
                      <label class="form-check-label" for="trouble_breathe_yes">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="trouble_breathe" id="trouble_breathe_no" value="0" >
                      <label class="form-check-label" for="trouble_breathe_no">No</label>
                    </div>
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>

                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">¿Tienes asma?</label>
                  <div class="col-sm-9 checkBox">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="asthma" id="asthma_yes" value="1" >
                      <label class="form-check-label" for="asthma_yes">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="asthma" id="asthma_no" value="0" >
                      <label class="form-check-label" for="asthma_no">No</label>
                    </div>
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>

                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">¿Utiliza un B-PAP o C-PAP mientras duerme?</label>
                  <div class="col-sm-9 checkBox">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="bipap_cpap" id="bipap_cpap_yes" value="1" >
                      <label class="form-check-label" for="bipap_cpap_yes">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="bipap_cpap" id="bipap_cpap_no" value="0" >
                      <label class="form-check-label" for="bipap_cpap_no">No</label>
                    </div>
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">¿Hace ejercicio?</label>
                  <div class="col-sm-9 checkBox">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="exercise" id="exercise_yes" value="1" >
                      <label class="form-check-label" for="exercise_yes">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" checked type="radio" name="exercise" id="exercise_no" value="0" >
                      <label class="form-check-label" for="exercise_no">No</label>
                    </div>
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>

                <div class="col-12" id="exercise_table" style="display: none">
                  <table class="table">
                    <thead>
                      <tr>
                        <th style="font-weight: 600; font-size: .9rem; display: none">Orden</th>
                        <th style="font-weight: 600; font-size: .9rem;">Tipo</th>
                        <th style="font-weight: 600; font-size: .9rem;">¿Cuánto tiempo?</th>
                        <th style="font-weight: 600; font-size: .9rem;">Frecuencia</th>
                        <th style="font-weight: 600; font-size: .9rem;">Horas al día</th>
                        <th style="font-weight: 600; font-size: .9rem;">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                  <div class="col-12 d-flex justify-content-end">
                    <button type="button" class="btn btn-second text-white mb-3" id="exerciceTableAdd">Añadir ejercicio</button>
                  </div>
                </div>






                <div class="div-service" style="display: none;">
                  <div class="mb-3 row mt-1">
                    <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">Hours you sleep at night?</span></label>
                    <div class="col-sm-6">
                      <input type="number" class="form-control form-control-sm" id="hours_you_sleep_at_night" name="hours_you_sleep_at_night" value="" placeholder="">
                      <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">¿Tomas pastillas para dormir?</label>
                    <div class="col-sm-6 checkBox">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="do_you_take_sleeping_pills" id="do_you_take_sleeping_pills_yes" value="1" >
                        <label class="form-check-label" for="do_you_take_sleeping_pills_yes">Si</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="do_you_take_sleeping_pills" id="do_you_take_sleeping_pills_no" value="0" >
                        <label class="form-check-label" for="do_you_take_sleeping_pills_no">No</label>
                      </div>
                      <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">¿Sufre de ansiedad o depresión?</label>
                    <div class="col-sm-6 checkBox">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="do_you_suffer_from_anxiety_or_depression" id="do_you_suffer_from_anxiety_or_depression_yes" value="1" >
                        <label class="form-check-label" for="do_you_suffer_from_anxiety_or_depression_yes">Si</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="do_you_suffer_from_anxiety_or_depression" id="do_you_suffer_from_anxiety_or_depression_no" value="0" >
                        <label class="form-check-label" for="do_you_suffer_from_anxiety_or_depression_no">No</label>
                      </div>
                      <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">¿Toma pastillas para la ansiedad o la depresión?</label>
                    <div class="col-sm-6 checkBox">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="do_you_take_pills_for_anxiety_or_depression" id="do_you_take_pills_for_anxiety_or_depression_yes" value="1" >
                        <label class="form-check-label" for="do_you_take_pills_for_anxiety_or_depression_yes">Si</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="do_you_take_pills_for_anxiety_or_depression" id="do_you_take_pills_for_anxiety_or_depression_no" value="0" >
                        <label class="form-check-label" for="do_you_take_pills_for_anxiety_or_depression_no">No</label>
                      </div>
                      <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">¿Se siente estresado?</label>
                    <div class="col-sm-6 checkBox">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="do_you_feel_under_stress" id="do_you_feel_under_stress_yes" value="1" >
                        <label class="form-check-label" for="do_you_feel_under_stress_yes">Si</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="do_you_feel_under_stress" id="do_you_feel_under_stress_no" value="0" >
                        <label class="form-check-label" for="do_you_feel_under_stress_no">No</label>
                      </div>
                      <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                    </div>
                  </div>
                  <div class="div-gender" style="display: none;">
                    <div class="mb-3 row">
                      <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">¿Tienes erecciones por la mañana?</label>
                      <div class="col-sm-6 checkBox">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="do_you_have_erections_at_the_morning" id="do_you_have_erections_at_the_morning_yes" value="1" >
                          <label class="form-check-label" for="do_you_have_erections_at_the_morning_yes">Si</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="do_you_have_erections_at_the_morning" id="do_you_have_erections_at_the_morning_no" value="0" >
                          <label class="form-check-label" for="do_you_have_erections_at_the_morning_no">No</label>
                        </div>
                        <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                      </div>
                    </div>
                    <div class="mb-3 row mt-1 do_you_have_erections_at_the_morning"  style="display: none" >
                      <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">¿Cuántos por semana?</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-sm" id="how_many_per_week" name="how_many_per_week" value="" placeholder="">
                        <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">¿Tiene problemas de erección?</label>
                      <div class="col-sm-6 checkBox">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="do_you_have_problems_getting_erections" id="do_you_have_problems_getting_erections_yes" value="1" >
                          <label class="form-check-label" for="do_you_have_problems_getting_erections_yes">Si</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="do_you_have_problems_getting_erections" id="do_you_have_problems_getting_erections_no" value="0" >
                          <label class="form-check-label" for="do_you_have_problems_getting_erections_no">No</label>
                        </div>
                        <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                      </div>
                    </div>
                    <div class="mb-3 row mt-1 do_you_have_problems_getting_erections"   style="display: none" >
                      <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">Since when?</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-sm" id="since_when" name="since_when" value="" placeholder="">
                        <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                      </div>
                    </div>
                    <div class="mb-3 row mt-1 do_you_have_problems_getting_erections"   style="display: none" >
                      <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">Describe</label>
                      <div class="col-sm-6">
                        <textarea class="form-control form-control-sm" id="describe_your_erection_problem" name="describe_your_erection_problem" value="" placeholder=""></textarea>
                        <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">¿Tiene problemas para mantener la erección?</label>
                      <div class="col-sm-6 checkBox">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="do_you_have_problems_maintaining_an_erection" id="do_you_have_problems_maintaining_an_erection_yes" value="1" >
                          <label class="form-check-label" for="do_you_have_problems_maintaining_an_erection_yes">Si</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="do_you_have_problems_maintaining_an_erection" id="do_you_have_problems_maintaining_an_erection_no" value="0" >
                          <label class="form-check-label" for="do_you_have_problems_maintaining_an_erection_no">No</label>
                        </div>
                        <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">¿Toma algún remedio natural para la disfunción eréctil?</label>
                      <div class="col-sm-6 checkBox">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="do_you_take_any_natural_remedy_for_erectile_dysfunction" id="do_you_have_problems_maintaining_an_erection_yes" value="1" >
                          <label class="form-check-label" for="do_you_have_problems_maintaining_an_erection_yes">Si</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="do_you_take_any_natural_remedy_for_erectile_dysfunction" id="do_you_have_problems_maintaining_an_erection_no" value="0" >
                          <label class="form-check-label" for="do_you_have_problems_maintaining_an_erection_no">No</label>
                        </div>
                        <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                      </div>
                    </div>
                    <div class="mb-3 row mt-1 do_you_take_any_natural_remedy_for_erectile_dysfunction"  style="display: none" >
                      <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">¿De qué tipo?</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-sm" id="what_kind" name="what_kind" value="" placeholder="">
                        <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                      </div>
                    </div>
                    <div class="mb-3 row mt-1 do_you_take_any_natural_remedy_for_erectile_dysfunction"  style="display: none" >
                      <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">¿Cómo han funcionado?</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-sm" id="how_did_it_work_natural_remedy" name="how_did_it_work_natural_remedy" value="" placeholder="">
                        <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                      </div>
                    </div>
                    <div class="mb-3 row mt-1 do_you_take_any_natural_remedy_for_erectile_dysfunction"  style="display: none" >
                      <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">¿De dónde los has sacado?</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-sm" id="where_did_you_get_them" name="where_did_you_get_them" value="" placeholder="">
                        <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">¿Se ha inyectado medicación para la disfunción eréctil?</label>
                      <div class="col-sm-6 checkBox">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="has_medication_been_injected_for_dysfunction_erectile" id="has_medication_been_injected_for_dysfunction_erectile_yes" value="1" >
                          <label class="form-check-label" for="has_medication_been_injected_for_dysfunction_erectile_yes">Si</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="has_medication_been_injected_for_dysfunction_erectile" id="has_medication_been_injected_for_dysfunction_erectile_no" value="0" >
                          <label class="form-check-label" for="has_medication_been_injected_for_dysfunction_erectile_no">No</label>
                        </div>
                        <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                      </div>
                    </div>
                    <div class="mb-3 row mt-1 has_medication_been_injected_for_dysfunction_erectile"  style="display: none" >
                      <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">¿Cuántas veces?</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-sm" id="how_many_times_have_injected" name="how_many_times_have_injected" value="" placeholder="">
                        <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                      </div>
                    </div>
                    <div class="mb-3 row mt-1 has_medication_been_injected_for_dysfunction_erectile"  style="display: none" >
                      <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">¿Cómo han funcionado?</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-sm" id="how_did_it_work" name="how_did_it_work" value="" placeholder="">
                        <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">¿Ha tenido una erección de más de 6 horas?</label>
                      <div class="col-sm-6 checkBox">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="have_you_had_an_erection_longer_than_six_hours" id="have_you_had_an_erection_longer_than_six_hours_yes" value="1" >
                          <label class="form-check-label" for="have_you_had_an_erection_longer_than_six_hours_yes">Si</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="have_you_had_an_erection_longer_than_six_hours" id="have_you_had_an_erection_longer_than_six_hours_no" value="0" >
                          <label class="form-check-label" for="have_you_had_an_erection_longer_than_six_hours_no">No</label>
                        </div>
                        <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                      </div>
                    </div>
                    <div class="mb-3 row mt-1 have_you_had_an_erection_longer_than_six_hours"  style="display: none" >
                      <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">¿Cuándo?</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-sm" id="when_you_had_a_six_hours_erection" name="when_you_had_a_six_hours_erection" value="" placeholder="">
                        <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                      </div>
                    </div>
                    <div class="mb-3 row mt-1 have_you_had_an_erection_longer_than_six_hours"  style="display: none" >
                      <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">¿Cómo se resolvió?</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-sm" id="how_was_it_resolved" name="how_was_it_resolved" value="" placeholder="">
                        <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                      </div>
                    </div>
                    <div class="mb-3 row mt-1 have_you_had_an_erection_longer_than_six_hours"  style="display: none" >
                      <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">¿Recibió atención médica?</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-sm" id="did_you_get_medical_attention" name="did_you_get_medical_attention" value="" placeholder="">
                        <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">¿Sufre de curvatura del pene?</label>
                      <div class="col-sm-6 checkBox">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="do_you_suffer_from_penile_curvature" id="do_you_suffer_from_penile_curvature_yes" value="1" >
                          <label class="form-check-label" for="do_you_suffer_from_penile_curvature_yes">Si</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="do_you_suffer_from_penile_curvature" id="do_you_suffer_from_penile_curvature_no" value="0" >
                          <label class="form-check-label" for="do_you_suffer_from_penile_curvature_no">No</label>
                        </div>
                        <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                      </div>
                    </div>
                    <div class="mb-3 row mt-1 do_you_suffer_from_penile_curvature"  style="display: none" >
                      <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">¿Cómo de intenso?</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-sm" id="how_intense" name="how_intense" value="" placeholder="">
                        <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                      </div>
                    </div>
                    <div class="mb-3 row mt-1 do_you_suffer_from_penile_curvature"  style="display: none" >
                      <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">¿En qué dirección?</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-sm" id="which_direction" name="which_direction" value="" placeholder="">
                        <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                      </div>
                    </div>
                    <div class="mb-3 row mt-1 do_you_suffer_from_penile_curvature"  style="display: none" >
                      <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">¿Duele?</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-sm" id="does_it_hurt" name="does_it_hurt" value="" placeholder="">
                        <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                      </div>
                    </div>
                    <div class="mb-3 row mt-1 do_you_suffer_from_penile_curvature"  style="display: none" >
                      <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">¿Impide las relaciones sexuales?</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-sm" id="does_it_prevent_intercourse" name="does_it_prevent_intercourse" value="" placeholder="">
                        <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">¿Se ha inyectado PRP para la disfunción eréctil?</label>
                      <div class="col-sm-6 checkBox">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="has_prp_been_injected_for_erectile_dysfunction" id="has_prp_been_injected_for_erectile_dysfunction_yes" value="1" >
                          <label class="form-check-label" for="has_prp_been_injected_for_erectile_dysfunction_yes">Si</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="has_prp_been_injected_for_erectile_dysfunction" id="has_prp_been_injected_for_erectile_dysfunction_no" value="0" >
                          <label class="form-check-label" for="has_prp_been_injected_for_erectile_dysfunction_no">No</label>
                        </div>
                        <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">¿Ha recibido tratamiento con células madre para la disfunción eréctil?</label>
                      <div class="col-sm-6 checkBox">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="have_you_received_stem_cell_treatment_for_erectile_dysfunction" id="have_you_received_stem_cell_treatment_for_erectile_dysfunction_yes" value="1" >
                          <label class="form-check-label" for="have_you_received_stem_cell_treatment_for_erectile_dysfunction_yes">Si</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="have_you_received_stem_cell_treatment_for_erectile_dysfunction" id="have_you_received_stem_cell_treatment_for_erectile_dysfunction_no" value="0" >
                          <label class="form-check-label" for="have_you_received_stem_cell_treatment_for_erectile_dysfunction_no">No</label>
                        </div>
                        <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">¿Ha recibido terapia de regeneración vascular con terapia de ondas de baja intensidad para la disfunción eréctil?</label>
                      <div class="col-sm-6 checkBox">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="hyrvrntwliwtfed" id="hyrvrntwliwtfed_yes" value="1" >
                          <label class="form-check-label" for="hyrvrntwliwtfed_yes">Si</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="hyrvrntwliwtfed" id="hyrvrntwliwtfed_no" value="0" >
                          <label class="form-check-label" for="hyrvrntwliwtfed_no">No</label>
                        </div>
                        <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="step">
                <div class="row mb-3">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Fecha de la última menstruación</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="last_menstrual_period" name="last_menstrual_period" value="" placeholder="Fecha" data-inputmask="'alias': 'datetime', 'inputFormat': 'dd/mm/yyyy'" >
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">¿El sangrado era?</label>
                  <div class="col-sm-9 checkBox">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="bleeding_whas" id="bleeding_whasyes" value="normal"  checked >
                      <label class="form-check-label" for="bleeding_whas_normal">Normal</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="bleeding_whas" id="bleeding_whas_no" value="light" >
                      <label class="form-check-label" for="bleeding_whas_light">Ligero</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="bleeding_whas" id="bleeding_whas_yes" value="heavy" >
                      <label class="form-check-label" for="bleeding_whas_heavy">Pesado</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="bleeding_whas" id="bleeding_whas_no" value="irregular" >
                      <label class="form-check-label" for="bleeding_whas_irregular">Irregular</label>
                    </div>
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">¿Has estado embarazada?</label>
                  <div class="col-sm-9 checkBox">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="have_you_been_pregnant" id="have_you_been_pregnant_yes" value="1" >
                      <label class="form-check-label" for="have_you_been_pregnant_yes">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="have_you_been_pregnant" id="have_you_been_pregnant_no" value="0" >
                      <label class="form-check-label" for="have_you_been_pregnant_no">No</label>
                    </div>
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="row mb-3 have_you_been_pregnant"  style="display: none">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">¿Cuántas veces?</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="how_many_times" name="how_many_times" value="" placeholder="">
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="row mb-3 have_you_been_pregnant"  style="display: none">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Fecha de la última menstruación</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="c_section" name="c_section" value="" placeholder="">
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">¿Utiliza algún tipo de método anticonceptivo?</label>
                  <div class="col-sm-9 checkBox">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="birth_control" id="birth_control_yes" value="1" >
                      <label class="form-check-label" for="birth_control_yes">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="birth_control" checked id="birth_control_no" value="0" >
                      <label class="form-check-label" for="birth_control_no">No</label>
                    </div>
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
                <div class="col-12" id="birth_control_table" style="display: none">
                  <table class="table">
                    <thead>
                      <tr>
                        <th style="font-weight: 600; font-size: .9rem; display: none">Orden</th>
                        <th style="font-weight: 600; font-size: .9rem;">Tipo</th>
                        <th style="font-weight: 600; font-size: .9rem;">¿Durante cuánto tiempo ha utilizado este anticonceptivo?</th>
                        <th style="font-weight: 600; font-size: .9rem;">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                  <div class="col-12 d-flex justify-content-end">
                    <button type="button" class="btn btn-second text-white mb-3" id="birthControlTableAdd">Añadir el control de la natalidad</button>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Hormonas</label>
                  <div class="col-sm-9 checkBox">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="use_hormones" id="use_hormones_yes" value="1" >
                      <label class="form-check-label" for="use_hormones_yes">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" checked name="use_hormones" id="use_hormones_no" value="0" >
                      <label class="form-check-label" for="use_hormones_no">No</label>
                    </div>
                  </div>
                </div>
                <div class="col-12" id="hormones_table" style="display: none">
                  <table class="table">
                    <thead>
                      <tr>
                        <th style="font-weight: 600; font-size: .9rem; display: none">Orden</th>
                        <th style="font-weight: 600; font-size: .9rem;">Tipo</th>
                        <th style="font-weight: 600; font-size: .9rem;">¿Cuánto tiempo lleva usando esta hormona?</th>
                        <th style="font-weight: 600; font-size: .9rem;">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                  <div class="col-12 d-flex justify-content-end">
                    <button type="button" class="btn btn-primary text-white mb-3" id="hormoneTableAdd">Add hormone</button>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">¿está usted embarazada? o ¿existe la posibilidad de que lo esté?</label>
                  <div class="col-sm-9 checkBox">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="is_or_can_be_pregman" id="bleeding_whasyes" value="1" >
                      <label class="form-check-label" for="bleeding_whas_normal">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="is_or_can_be_pregman" id="bleeding_whas_no" value="0" >
                      <label class="form-check-label" for="bleeding_whas_light">No</label>
                    </div>
                    <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                  </div>
                </div>
              </div>
              <div class="step">
                <div class="row mb-3">
                    <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Google</label>
                    <div class="col-sm-9">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="about_us_google" name="about_us_google">
                            <label class="form-check-label" for="flexCheckDefault">

                            </label>
                        </div>
                        <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Facebook</label>
                    <div class="col-sm-9">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1"  id="about_us_facebook" name="about_us_facebook">
                            <label class="form-check-label" for="about_us_facebook">

                            </label>
                        </div>
                        <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">YouTube/vimeo</label>
                    <div class="col-sm-9">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="about_us_youtube" name="about_us_youtube">
                            <label class="form-check-label" for="about_us_youtube">

                            </label>
                        </div>
                        <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Twitter</label>
                    <div class="col-sm-9">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="about_us_twiter" name="about_us_twiter">
                            <label class="form-check-label" for="about_us_twiter">

                            </label>
                        </div>
                        <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Web forums</label>
                    <div class="col-sm-9">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="about_us_forums" name="about_us_forums">
                            <label class="form-check-label" for="about_us_forums">

                            </label>
                        </div>
                        <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Instagram</label>
                    <div class="col-sm-9">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="about_us_instagram" name="about_us_instagram">
                            <label class="form-check-label" for="about_us_instagram">

                            </label>
                        </div>
                        <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Radio</label>
                    <div class="col-sm-9">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="about_us_radio" name="about_us_radio">
                            <label class="form-check-label" for="about_us_radio">

                            </label>
                        </div>
                        <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Email</label>
                    <div class="col-sm-9">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="about_us_email" name="about_us_email">
                            <label class="form-check-label" for="about_us_email">

                            </label>
                        </div>
                        <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Referred by friend</label>
                    <div class="col-sm-9">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="about_us_frend" name="about_us_frend">
                            <label class="form-check-label" for="about_us_frend">

                            </label>
                        </div>
                        <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                    </div>
                </div>

                <div class="mb-3 row mt-1 about_us_frend" >
                    <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Friends name</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" id="friend_name" name="friend_name" value="" placeholder="">
                        <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Other</label>
                    <div class="col-sm-9">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="about_us_other" name="about_us_other">
                            <label class="form-check-label" for="about_us_other">

                            </label>
                        </div>
                        <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                    </div>
                </div>

                <div class="mb-3 row mt-1 about_us_other">
                    <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Specify media</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" id="about_us_description_other" name="about_us_description_other" value="" placeholder="">
                        <span class="invalid-feedback" style="display: block!important;" role="alert"></span>
                    </div>
                </div>
              </div>
              <div class="result d-none">
                <div class="jumbotron jumbotron-fluid">
                  <div class="container">
                    <h1 class="display-4 text-success font-weight-bolder fw-bolder">Gracias por su interes</h1>
                    <p class="lead">En 24 horas un asesor se comunicara con usted para darle seguimiento a su formulario</p>
                  </div>
                </div>
              </div>
              <div class="mb-3 row">
                <div class="col-6">
                </div>
                <div class="col-6 d-flex justify-content-end">
                  <button type="button" class="btn btn-primary btn-sm mx-1 cancel" id="prev-btn">Anterior</button>
                  <button type="button" class="btn btn-primary btn-sm mx-1" id="next-btn">Siguiente</button>
                  <button type="button" class="btn btn-primary btn-sm mx-1" id="submit-btn">Enviar</button>
                  <button type="reset" class="d-none reset">Reset</button>
                </div>
              </div>
            </form>
            <div class="col-md-3"></div>
          </div>
        </section>
        </div>
      <div class="modal fade" id="medicationModal" tabindex="-1" aria-labelledby="medicationModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Formulario de medicacimentos</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form id="FormModalMedication">
                          <div class="modal-body">
                              <div class="mb-3 row">
                                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Nombre del medicamento</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control form-control-sm" id="medicationNameForm" name="medicationNameForm" value="" placeholder="">
                                  </div>
                              </div>
                              <div class="mb-3 row">
                                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Razón</span></label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control form-control-sm" id="medicationRazonForm" name="medicationRazonForm" placeholder="">
                                  </div>
                              </div>
                              <div class="mb-3 row">
                                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Dosis</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control form-control-sm" id="medicationDoseForm" name="medicationDoseForm" placeholder="">
                                  </div>
                              </div>
                              <div class="mb-3 row">
                                  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Frecuencia</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control form-control-sm" id="medicationFrecuencyForm" name="medicationFrecuencyForm" placeholder="">
                                  </div>
                              </div>
                              <div class="formError text-danger"></div>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-second text-white cancel" id="medicationFormCancel" data-bs-dismiss="modal">Cancelar</button>
                              <button type="button" class="btn btn-main" id="medicationFormSave">Save Medication</button>
                              <button type="button" class="btn btn-warning text-white" id="medicationFormEdit">Editar medicamento</button>
                              <button type="reset" class="d-none reset" id="medicationFormReset">Reset</button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
<option value=""></option>
    <!-- Optional JavaScript; choose one of the two! -->
    @section('styles')
      <link rel="stylesheet" type="text/css" href="{{ env('APP_URL_PARTNER') }}/staffFiles/assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" />
    @endsection



    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ env('APP_URL_PARTNER') }}/siteFiles/assets/vendor/dropify/dist/js/dropify.min.js"></script>
    <script src="{{ env('APP_URL_PARTNER') }}/staffFiles/assets/plugins/moment/moment.min.js " ></script>
    <script src="{{ env('APP_URL_PARTNER') }}/staffFiles/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
    <script src="{{ env('APP_URL_PARTNER') }}/staffFiles/assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
    <script src="{{ env('APP_URL_PARTNER') }}/staffFiles/assets/plugins/moment/moment.min.js"></script>
    <script src="{{ env('APP_URL_PARTNER') }}/staffFiles/assets/plugins/Inputmask-5.x/dist/jquery.inputmask.min.js"></script>
    <script src="{{ env('APP_URL_PARTNER') }}/staffFiles/assets/plugins/Inputmask-5.x/dist/bindings/inputmask.binding.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js" integrity="sha512-NqYds8su6jivy1/WLoW8x1tZMRD7/1ZfhWG/jcRQLOzV1k1rIODCpMgoBnar5QXshKJGV7vi0LXLNXPoFsM5Zg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.socket.io/4.4.0/socket.io.min.js" integrity="sha384-1fOn6VtTq3PWwfsOrk45LnYcGosJwzMHv+Xh/Jx5303FVOXzEnw0EpLv30mtjmlj" crossorigin="anonymous"></script>
    <script>
      let step = document.getElementsByClassName('step');
      let prevBtn = document.getElementById('prev-btn');
      let nextBtn = document.getElementById('next-btn');
      let submitBtn = document.getElementById('submit-btn');
      let form = document.getElementsByTagName('form')[0];
      let preloader = document.getElementById('preloader-wrapper');
      let bodyElement = document.querySelector('body');
      let succcessDiv = document.getElementById('success');
      let progressBar = document.getElementById('steps');
      let code = '{{ $code }}';
      let lang = '{{ $lang }}';
      let domain = '{{ env('APP_URL_PARTNER') }}';
      let endPoint = domain + '/partners/' + lang + '/' + code;
      var ip_address = window.location.protocol + '//' + window.location.hostname;;
      var socket_port = '3000';
      var socket = io(ip_address + ':' + socket_port );
      form.onsubmit = () => {
          return false
      }

      $('.date').inputmask({"mask": "(999) 999-9999"});

      checkBox = $("input[type='radio'][value='0']")
      checkBox.each(function(index, el) {
        $(this).attr('checked', 'true');
      });
      let current_step = 0;
      let stepCount = step.length;
      if (current_step == 0) {
          prevBtn.classList.add('d-none');
          submitBtn.classList.add('d-none');
          nextBtn.classList.add('d-inline-block');
          nextBtn.setAttribute('data-step', current_step);
      }

      for (var i = 0; i < stepCount; i++) {
        step[i].classList.add('d-none')
      }

      step[current_step].classList.remove('d-none');
      step[current_step].classList.add('d-block');

      var drEvent = $('.dropify').dropify({
        messages: {
          'default': 'Drag and drop a file here or click',
          'replace': 'Drag and drop or click to replace',
          'remove':  'Remove',
          'error':   'Ooops, something wrong happended.'
        },
        tpl: {
          message:'<div class="dropify-message"><span class="file-icon" /> <p style="font-size: 16px">Drag and Drop a file or cleck here</p></div>',

        }
      });

      fetch( endPoint + '/services ')
      .then(response => response.json())
      .then(json => getServices(json))

    
      $(document).on('change', '#select-service-select', function(event) {
        event.preventDefault();
        var id = $( "#select-service-select option:selected" ).val();
        $("#package").addClass('d-none')
        $( "#select-procedure-select" ).prop("selectedIndex", 0);
        $( "#select-procedure-select" ).find('option').not(':first').remove();
        getProcedures(id);
      });
      $(document).on('change', '#select-procedure-select', function(event) {
        event.preventDefault();
        var id = $( "#select-procedure-select option:selected" ).val();
        var paq = $( "#select-procedure-select option:selected" ).attr('package');
        $("#package").addClass('d-none')
        if (paq == 1) {getPackages(id, paq)}
      });
      
      function getServices(data){
        for (var dat of data) {
          let option = `<option value="${dat.id}">${dat.text}</option>`;
          let li = `<li data-value="${dat.id}">${dat.text}</li>`;
          $('#select-service-select').append(option)
          //$('#select-service-select').next('.nice-select').find('.list').append(li)
          $('select').niceSelect('update');
        }
      }
      function getProcedures(id){
        console.log("id", id);
          let data = new FormData();
          data.append('id', id)
          fetch( endPoint + '/procedures', {
              method: "POST",
              body: data
          })
          .then(response => response.json())
          .then( function(data) {
            console.log("data", data);
            for (var dat of data) {
              let option = `<option package="${dat.package}" value="${dat.id}">${dat.text}</option>`;
              $('#select-procedure-select').append(option)
              $('select').niceSelect('update');
            }
          })
      }
      function getPackages(id, paq){
          let data = new FormData();
          $( "#select-package-select" ).prop("selectedIndex", 0);
          $( "#select-package-select" ).find('option').not(':first').remove();
          if (paq == 1) { 
            $("#package").removeClass('d-none') }
            else { 
              $("#package").addClass('d-none') 
          }
              data.append('id', id)
          fetch( endPoint + '/packages', {
              method: "POST",
              body: data
          })
          .then(response => response.json())
          .then( function(data) {
              // $('#select-package-select').empty().attr('placeholder', "Seleccionar ...").trigger('change')
              // $('#select-package-select').prepend('<option selected></option>').select2({
              //     placeholder: 'Selecciona un estado o provincia',
              //     data: data
              // })
              for (var dat of data) {
                let option = `<option value="${dat.id}">${dat.text}</option>`;
                $('#select-package-select').append(option)
                $('select').niceSelect('update');
              }
          })
      }
      
      function toTop(){
        $("html, body").animate({ scrollTop: 0 }, "fast");
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
      }
      nextBtn.addEventListener('click', () => {
          $('.invalid-feedback').html('');
          let data_service = 0;
          let data_procedure = 0;
          let data_package = 0;
          let data_sex = '';
          if ($('#select-service-select').data('select2')){
              if ($('#select-service-select').select2('data').length > 0) {data_service = $('#select-service-select').select2('data')[0].id;}else {data_service = 0;}
          }
          if ($('#select-procedure-select').data('select2')){
              if ($('#select-procedure-select').select2('data').length > 0) {data_procedure = $('#select-procedure-select').select2('data')[0].id;}else {data_procedure = 0;}
          }
          if ($('#select-package-select').data('select2')){
              if ($('#select-package-select').select2('data').length > 0) {data_package = $('#select-package-select').select2('data')[0].id;}else {data_package = 0;}
          }

          if ($('#sex').data('select2')){
              if ($('#sex').select2('data').length > 0) {data_sex = $('#sex').select2('data')[0].id;}else {data_sex = 0;}
          }

          $("#medication_table tbody tr").each(function(index, el) {
              $(this).find('input[name*="medication_name"]').attr('id', 'medication_name-'+index)
              $(this).find('input[name*="medication_reason"]').attr('id', 'medication_reason-'+index)
              $(this).find('input[name*="medication_dosage"]').attr('id', 'medication_dosage-'+index)
              $(this).find('input[name*="medication_frecuency"]').attr('id', 'medication_frecuency-'+index)
          });
          $("#surgery_table tbody tr").each(function(index, el) {
              $(this).find('input[name*="surgey_type"]').attr('id', 'surgey_type-'+index)
              $(this).find('input[name*="surgey_name"]').attr('id', 'surgey_name-'+index)
              $(this).find('input[name*="surgey_age"]').attr('id', 'surgey_age-'+index)
              $(this).find('input[name*="surgey_year"]').attr('id', 'surgey_year-'+index)
              $(this).find('input[name*="surgey_complications"]').attr('id', 'surgey_complications-'+index)
          });
          $("#illness_table tbody tr").each(function(index, el) {
              $(this).find('input[name*="illness"]').attr('id', 'illness-'+index)
              $(this).find('input[name*="diagnostic_date"]').attr('id', 'diagnostic_date-'+index)
              $(this).find('input[name*="treatment"]').attr('id', 'treatment-'+index)
          });
          $("#exercise_table tbody tr").each(function(index, el) {
              $(this).find('input[name*="exercise_type"]').attr('id', 'exercise_type-'+index)
              $(this).find('input[name*="exercise_how_long"]').attr('id', 'exercise_how_long-'+index)
              $(this).find('input[name*="exercise_how_frecuent"]').attr('id', 'exercise_how_frecuent-'+index)
              $(this).find('input[name*="exercise_hours"]').attr('id', 'exercise_hours-'+index)
          });

          $("#hormones_table tbody tr").each(function(index, el) {
              $(this).find('input[name*="hormone_type"]').attr('id', 'hormone_type-'+index)
              $(this).find('input[name*="hormone_how_long"]').attr('id', 'hormone_how_long-'+index)
          });

          $("#birth_control_table tbody tr").each(function(index, el) {
              $(this).find('input[name*="birthControl_type"]').attr('id', 'birthControl_type-'+index)
              $(this).find('input[name*="birthControl_how_long"]').attr('id', 'birthControl_how_long-'+index)
          });

          form = document.querySelector('form.appsForm')
          var form_data = new FormData(form);
          form_data.append('step', current_step);
          fetch( endPoint + '/checkData', {
              method: "POST",
              body: form_data
          })
          .then(response => response.json())
          .then( function(data) {
            console.log(data);
            toTop()
              if (data.hasOwnProperty('exist') ){$('#treatment').html('<strong>'+data.msg+'</strong>')}
                  if (data.hasOwnProperty('success')) {
                      if (!data.success) {
                          $.each( data.errors, function( key, value ) {
                              $real = key.replace('.', '-')
                              $('*[id^='+$real+']').parent().find('.invalid-feedback').append('<strong>' + value + '</strong>')
                              $('*[id^='+$real+']').parents('.dropify-wrapper').next('.invalid-feedback').append('<strong>' + value + '</strong>')
                              $('*[id^='+$real+']').parents('.checkBox').find('.invalid-feedback').append('<strong>' + value + '</strong>')
                          });
                      } else {
                          nextStep(data.images, data.service, data.gender)
                      }
                  }
              })
      });
      prevBtn.addEventListener('click', () => {
          form = document.getElementsByTagName('form')[0]
          var form_data = new FormData(form);
          form_data.append('step', current_step);
          fetch( endPoint + '/getData', {
              method: "POST",
              body: form_data
          })
          .then(response => response.json())
          .then( function(data) {
            toTop()
            prevStep(data.images, data.service, data.gender)
          })
      });
      submitBtn.addEventListener('click', () =>{
          form = document.getElementsByTagName('form')[0]
          var form_data = new FormData(form);
          $('.loading').css('display', 'block');
          form_data.append('step', current_step);
          fetch( endPoint + '/storeData', {
              method: "POST",
              body: form_data
          })
          .then(response => response.json())
          .then( function(data) {
            console.log("data", data);
              toTop()
              $('.loading').css('display', 'none');
              if (!data.success) {
                  $.each( data.errors, function( key, value ) {
                      $real = key.replace('.', '-')
                      $('*[id^='+$real+']').parent().find('.invalid-feedback').append('<strong>' + value + '</strong>')
                      $('*[id^='+$real+']').parents('.dropify-wrapper').next('.invalid-feedback').append('<strong>' + value + '</strong>')
                      $('*[id^='+$real+']').parents('.checkBox').find('.invalid-feedback').append('<strong>' + value + '</strong>')
                  });
                  //$('.loading').css('display', 'block');
              } else {
                  socket.emit('updateDataTablesToServer');
                  //window.location.href = "https://es.jlpradosc.com"; 
                  for (var i = 0; i < stepCount; i++) {
                      step[i].classList.add('d-none')
                  }

                  prevBtn.classList.add('d-none');
                  submitBtn.classList.add('d-none');
                  nextBtn.classList.add('d-none');
                  $('.progress').addClass('d-none');
                  $('.result').removeClass('d-none')
                  $('.result').addClass('d-block')
                  $('.loading').css('display', 'none');
              }
          })
      })
      function nextStep(images = null, service, gender){
          $imagesArea = $('#images-area')
          current_step++
          if (images.need_images == 1) {
              let dropifyCount = $('.dropify').length
              if (dropifyCount < 4) {
                  for (var i = 0; i < images.qty_images; i++) {
                      var $fortify = `<div class="col-md-6 my-3">
                      <input type="file"class="dropify"order="1"data-height="200" name="imagenes[]" data-allowed-file-extensions="png jpeg jpg" id="imagenes-${i}"/>
                      <span class="invalid-feedback text-center" id="treatment" style="display: block!important;" role="alert"></span>
                      </div>
                      `;
                      $imagesArea.append($fortify);
                  }
              }
              $('.dropify').dropify();
          } else {
              if (current_step == 1) {current_step++;}
          }

          if (gender != "female") {
              if (current_step == 6) {current_step++;}
          }

          for (var i = 0; i < stepCount; i++) {
              step[i].classList.add('d-none')
          }

          let previous_step = current_step - 1

          if (service == 3) {
              $('.div-service').show('fast')
              if (gender == "male") {
                  $('.div-gender').show('fast')
              }
          } 


          if ((current_step > 0) && (current_step < stepCount)) {

              prevBtn.classList.remove('d-none');
              prevBtn.classList.add('d-inline-block');

              step[current_step].classList.remove('d-none');
              step[current_step].classList.add('d-block');

              step[previous_step].classList.remove('d-block');
              step[previous_step].classList.add('d-none');

              if (current_step == 7) {
                  nextBtn.classList.remove('d-inline-block');
                  nextBtn.classList.add('d-none');
                  submitBtn.classList.remove('d-none');
                  submitBtn.classList.add('d-inline-block');
              }

              barra = 7;

              let progress = ((100 / barra) * current_step)
              progressBar.style.width = Math.round(progress) + '%';
              progressBar.innerText = Math.round(progress) + '%'
          }
      }
      function prevStep(images = null, service, gender){

          if (current_step > 0) {
              current_step--;
              console.log("current_step", current_step);
              let previous_step = current_step - 1;
              // console.log("previous_step", previous_step);

              if (images.need_images != 1) {
                  if (current_step == 1) {current_step--;}
              }
              if (gender != "female") {
                  if (current_step == 6) {current_step--;}
              }

              for (var i = 0; i < stepCount; i++) {
                  step[i].classList.add('d-none')
                  if (i == current_step) {
                      step[i].classList.remove('d-none');
                      step[i].classList.add('d-block');
                  }
              }

              prevBtn.classList.add('d-none');
              prevBtn.classList.add('d-inline-block');
              // step[current_step].classList.remove('d-none');
              // step[current_step].classList.add('d-block')
              // step[previous_step].classList.remove('d-block');
              // step[previous_step].classList.add('d-none');
              if (current_step < stepCount) {
                  submitBtn.classList.remove('d-inline-block');
                  submitBtn.classList.add('d-none');
                  nextBtn.classList.remove('d-none');
                  nextBtn.classList.add('d-inline-block');
                  prevBtn.classList.remove('d-none');
                  prevBtn.classList.add('d-inline-block');
              }
          }

          if (current_step == 0) {
              prevBtn.classList.remove('d-inline-block');
              prevBtn.classList.add('d-none');
          }


          barra = 7;
          let progress = ((100 / barra) * current_step)
          progressBar.style.width = Math.round(progress) + '%';
          progressBar.innerText = Math.round(progress) + '%'
      }
      function submStep(){
          for (var i = 0; i < stepCount; i++) {
              step[i].classList.add('d-none')
          }
          step[7].classList.remove('d-none')
          step[7].classList.add('d-inline-block')
      }


      function needImages(){
        $('#select-service-select').on('select2:select', function(e){
            let data = e.params.data;
            if (data.need_images == 1) { return true } else { return false }
        })
      }
      drEvent.on('dropify.afterClear', function(event, element){
          alert('File deleted');
      });

    
      const containerMedicactionModal = document.getElementById("medicationModal");
      const medicationModal = new bootstrap.Modal(containerMedicactionModal);
      const medication_cadena = [];
      $(document).ready(function() {
        $('#imc').attr('readOnly', true);
      });

      $(document).on("change", "#weight", function () {
        var sistem = $("input[type=radio][name=mesure_sistem]:checked").val()
        if ($("#height").val()!= "") {
          ImcCalculate(sistem)
        }
      });

      $(document).on("change", "#height", function () {
        var sistem = $("input[type=radio][name=mesure_sistem]:checked").val()
        if ($("#weight").val()!= "") {
          ImcCalculate(sistem)
        }
      });

      $(document).on('click', '#medicationFormSave', function () {
        $('#medicationFormSave').show('fast');
        $('.formError').html('')
      });

      $(document).on('click', '.deleteMedication', function(event) {
        $(this).parents('tr').remove()

        if ($("#medication_table tbody tr").length < 1) {
          addMedicationFields()
        }
      });
      $(document).on('click', '#medicationTableAdd',function () {
        $('.formError').html('')
        addMedicationFields()
      });
      function ImcCalculate(sistem) {
        if (sistem == "M") {
          var altura = $("#height").val()
          var peso = $("#weight").val()

          var formula = peso / (altura * altura);
          $("#imc").val(formula.toFixed(2))
        } else if (sistem =="I"){
          var altura = $("#height").val() * $("#height").val();
          var peso = $("#weight").val() * 703;

          var formula = peso / altura;
          $('#imc').attr('readOnly', false);
          $("#imc").val(formula.toFixed(2))
          $('#imc').attr('readOnly', true);
        }
      }
      $(document).on('change', 'input[type=radio][name=take_medication]',  function (e) {
        if ($("input[type=radio][name=take_medication]:checked").val() == '1') {
          $('#medication_table').show('fast')
          $('#medicationFormEdit').hide('fast');
          $('.formError').html('')
          addMedicationFields()
        } else {
          $('#medication_table').hide('fast')
          $('#medication_table').find('tbody').html('');
        }
      });
      
      $(document).on('change', 'input[type=radio][name=mesure_sistem]',  function() {
        $("#max_weigh").val("");
        $("#weight").val("");
        $("#height").val("");
        $("#imc").val("");
        if ($(this).val() == 'I') {
          $('#mw').html(' (Lb)')
          $('#cw').html(' (Lb)')
          $('#h').html(' (Ft)')
        } else if($(this).val() == 'M'){
          $('#mw').html(' (Kg)')
          $('#cw').html(' (Kg)')
          $('#h').html(' (Mts)')
        }
      });
      $(document).on('change', 'input[type=radio][name=blood_thinners]',  function() {
        if ($("input[type=radio][name=blood_thinners]:checked").val() == '1') {
          $("#rbt").show('fast')
        } else {
          $("#rbt").hide('fast')
          $('#razon_blood_thinners').val('')
        }
      });
      $(document).on('click', '.send', function(e){
        e.preventDefault();
        if (medication_cadena.length > 0) {
          $('#formHealthData').append("<input type='hidden' name='medication_cadena' value='" + JSON.stringify(medication_cadena) +"'>")
        }
        $('form#formHealthData').submit();
      });

      function createTableRow(){
        var tableRow = '';
        tableRow += '<tr>'
        tableRow += '<th style="font-weight: 500; font-size: .9rem;"></th>'
        tableRow += '<td style="font-weight: 500; font-size: .9rem;"></td>'
        tableRow += '<td style="font-weight: 500; font-size: .9rem;"></td>'
        tableRow += '<td style="font-weight: 500; font-size: .9rem;"></td>'
        tableRow += '<td style="font-weight: 500; font-size: .9rem;">'
        tableRow += '<div class="row">'
        tableRow += '<div class="col-4 g-0 text-center"><i class="bi bi-trash"></i></div>'
        tableRow += '<div class="col-4 g-0 text-center"><i class="bi bi-trash"></i></div>'
        tableRow += '<div class="col-4 g-0 text-center"><i class="bi bi-trash"></i></div>'
        tableRow += '</div>'
        tableRow += '</td>'
        tableRow += '</tr>'

        $('#medication_table  tbody').append(tableRow)
      }
      $('#medicationModal').on('hidden.bs.modal', function(e) {
        var nFilas = $("#medication_table .table tbody tr").length;
        if (nFilas == '0') {
          $('#medication_table').hide('fast')
          $('#medication_table').find('tbody').html('');
          $("input[name=take_medication][value=0]").prop('checked', true);
        }
        $("#FormModalMedication")[0].reset();
      });

      function addMedicationFields() {
        var medicationField = '';
        medicationField += '<tr>'
        medicationField += '<td>'
        medicationField += '<input type="text" name="medication_name[]" class="form-control form-control-sm" >'
        medicationField += '<span class="invalid-feedback" style="display: block!important;" role="alert"></span>'
        medicationField += '</td>'
        medicationField += '<td>'
        medicationField += '<input type="text" name="medication_reason[]" class="form-control form-control-sm">'
        medicationField += '<span class="invalid-feedback" style="display: block!important;" role="alert"></span>'
        medicationField += '</td>'
        medicationField += '<td>'
        medicationField += '<input type="text" name="medication_dosage[]" class="form-control form-control-sm">'
        medicationField += '<span class="invalid-feedback" style="display: block!important;" role="alert"></span>'
        medicationField += '</td>'
        medicationField += '<td>'
        medicationField += '<input type="text" name="medication_frecuency[]" class="form-control form-control-sm"">'
        medicationField += '<span class="invalid-feedback" style="display: block!important;" role="alert"></span>'
        medicationField += '</td>'
        medicationField += '<td class="text-center">'
        medicationField += '<button class="btn btn-danger btn-sm btn-block deleteMedication" type="button" id="addon-wrapping">Eliminar</i></button>'
        medicationField += '</td>'
        medicationField += '</tr>'
        $('#medication_table tbody').append(medicationField)
      }
      $(document).on('click', '.deleteSurgey', function(event) {
          $(this).parents('tr').remove()
          if ($("#surgery_table tbody tr").length < 1) {
              addMedicationFields()
          }
      });

      $(document).on('click', '#surgeyTableAdd',function () {
          $('.formError').html('')
          addSurgeryFields()
      });

      $(document).on('change', 'input[type=radio][name=previus_surgery]',  function (e) {
          if ($("input[type=radio][name=previus_surgery]:checked").val() == '1') {
              $('#surgery_table').show('fast')
              
              addSurgeryFields()
          } else {
              $('#surgery_table').hide('fast')
              $('#surgery_table').find('tbody').html('');
          }
      });

      function addSurgeryFields() {
          var surgeryField = '';
          surgeryField += '<tr>'
          surgeryField += '<td>'
          surgeryField += '<input type="text" name="surgey_type[]" class="form-control form-control-sm">'
          surgeryField += '<span class="invalid-feedback" style="display: block!important;" role="alert"></span>'
          surgeryField += '</td>'
          surgeryField += '<td>'
          surgeryField += '<input type="text" name="surgey_name[]" class="form-control form-control-sm">'
          surgeryField += '<span class="invalid-feedback" style="display: block!important;" role="alert"></span>'
          surgeryField += '</td>'
          surgeryField += '<td>'
          surgeryField += '<input type="text" name="surgey_age[]" class="form-control form-control-sm" onkeypress="return (event.charCode !=8 && event.charCode ==0 || ( event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57)))">'
          surgeryField += '<span class="invalid-feedback" style="display: block!important;" role="alert"></span>'
          surgeryField += '</td>'
          surgeryField += '<td>'
          surgeryField += '<input type="text" name="surgey_year[]" class="form-control form-control-sm">'
          surgeryField += '<span class="invalid-feedback" style="display: block!important;" role="alert"></span>'
          surgeryField += '</td>'
          surgeryField += '<td>'
          surgeryField += '<input type="text" name="surgey_complications[]" class="form-control form-control-sm">'
          surgeryField += '<span class="invalid-feedback" style="display: block!important;" role="alert"></span>'
          surgeryField += '</td>'
          surgeryField += '<td class="text-center">'
          surgeryField += '<button class="btn btn-danger btn-sm btn-block deleteSurgey" type="button" id="addon-wrapping">Eliminar</i></button>'
          surgeryField += '</td>'
          surgeryField += '</tr>'
          $('#surgery_table tbody').append(surgeryField)
      }

      $(document).on('change', 'input[type=radio][name=addiction]',  function (e) {
          if ($("input[type=radio][name=addiction]:checked").val() == '1') {
              $('#which_one').show('fast')
          } else {
              $('#which_one').hide('fast')
              $('#which_one_adiction').val('');
          }
      });

      $(document).on('change', 'input[type=radio][name=high_lipid_levels]',  function (e) {
          if ($("input[type=radio][name=high_lipid_levels]:checked").val() == '1') {
              $('.high_lipid_levels').show('fast')
          } else {
              $('.high_lipid_levels').hide('fast')
              $('#date_high_lipid_levels').val('');
              $('#treatment_high_lipid_levels').val('');
          }
      });

      $(document).on('change', 'input[type=radio][name=arthritis]',  function (e) {
          if ($("input[type=radio][name=arthritis]:checked").val() == '1') {
              $('.arthritis').show('fast')
          } else {
              $('.arthritis').hide('fast')
              $('#date_arthritis').val('');
              $('#treatment_arthritis').val('');
          }
      });
      $(document).on('change', 'input[type=radio][name=cancer]',  function (e) {
          if ($("input[type=radio][name=cancer]:checked").val() == '1') {
              $('.cancer').show('fast')
          } else {
              $('.cancer').hide('fast')
              $('#date_cancer').val('');
              $('#treatment_cancer').val('');
          }
      });

      $(document).on('change', 'input[type=radio][name=cholesterol]',  function (e) {
          if ($("input[type=radio][name=cholesterol]:checked").val() == '1') {
              $('.cholesterol').show('fast')
          } else {
              $('.cholesterol').hide('fast')
              $('#date_cholesterol').val('');
              $('#treatment_cholesterol').val('');
          }
      });

      $(document).on('change', 'input[type=radio][name=triglycerides]',  function (e) {
          if ($("input[type=radio][name=triglycerides]:checked").val() == '1') {
              $('.triglycerides').show('fast')
          } else {
              $('.triglycerides').hide('fast')
              $('#date_triglycerides').val('');
              $('#treatment_triglycerides').val('');
          }
      });

      $(document).on('change', 'input[type=radio][name=stroke]',  function (e) {
          if ($("input[type=radio][name=stroke]:checked").val() == '1') {
              $('.stroke').show('fast')
          } else {
              $('.stroke').hide('fast')
              $('#date_stroke').val('');
              $('#treatment_stroke').val('');
          }
      });

      $(document).on('change', 'input[type=radio][name=diabetes]',  function (e) {
          if ($("input[type=radio][name=diabetes]:checked").val() == '1') {
              $('.diabetes').show('fast')
          } else {
              $('.diabetes').hide('fast')
              $('#date_diabetes').val('');
              $('#treatment_diabetes').val('');
          }
      });

      $(document).on('change', 'input[type=radio][name=coronary_artery_disease]',  function (e) {
          if ($("input[type=radio][name=coronary_artery_disease]:checked").val() == '1') {
              $('.coronary_artery_disease').show('fast')
          } else {
              $('.coronary_artery_disease').hide('fast')
              $('#date_coronary_artery_disease').val('');
              $('#treatment_coronary_artery_disease').val('');
          }
      });

      $(document).on('change', 'input[type=radio][name=liver_disease]',  function (e) {
          if ($("input[type=radio][name=liver_disease]:checked").val() == '1') {
              $('.liver_disease').show('fast')
          } else {
              $('.liver_disease').hide('fast')
              $('#date_liver_disease').val('');
              $('#treatment_liver_disease').val('');
          }
      });

      $(document).on('change', 'input[type=radio][name=lugn_disease]',  function (e) {
          if ($("input[type=radio][name=lugn_disease]:checked").val() == '1') {
              $('.lugn_disease').show('fast')
          } else {
              $('.lugn_disease').hide('fast')
              $('#date_lugn_disease').val('');
              $('#treatment_lugn_disease').val('');
          }
      });

      $(document).on('change', 'input[type=radio][name=renal_disease]',  function (e) {
          if ($("input[type=radio][name=renal_disease]:checked").val() == '1') {
              $('.renal_disease').show('fast')
          } else {
              $('.renal_disease').hide('fast')
              $('#date_renal_disease').val('');
              $('#treatment_renal_disease').val('');
          }
      });

      $(document).on('change', 'input[type=radio][name=thyroid_disease]',  function (e) {
          if ($("input[type=radio][name=thyroid_disease]:checked").val() == '1') {
              $('.thyroid_disease').show('fast')
          } else {
              $('.thyroid_disease').hide('fast')
              $('#date_thyroid_disease').val('');
              $('#treatment_thyroid_disease').val('');
          }
      });

      $(document).on('change', 'input[type=radio][name=hypertension]',  function (e) {
          if ($("input[type=radio][name=hypertension]:checked").val() == '1') {
              $('.hypertension').show('fast')
          } else {
              $('.hypertension').hide('fast')
              $('#date_hypertension').val('');
              $('#treatment_hypertension').val('');
          }
      });

      $(document).on('change', 'input[type=radio][name=any_other_illnesses]',  function (e) {
          if ($("input[type=radio][name=any_other_illnesses]:checked").val() == '1') {
              $('#illness_table').show('fast')
              addillnessFields()
          } else {
              $('#illness_table').hide('fast')
              $('#illness_table').find('tbody').html('');
          }
      });

      $(document).on('click', '#illnessTableAdd',function () {
          $('.formError').html('')
          addillnessFields()
      });

      $(document).on('click', '.deleteillness', function(event) {
          $(this).parents('tr').remove()


          if ($("#illness_table tbody tr").length < 1) {
              addillnessFields()
          }
      });

      function addillnessFields() {
          var illnessField = '';
          illnessField += '<tr>'
          illnessField += '<td>'
          illnessField += '<input type="text" name="illness[]" class="form-control form-control-sm">'
          illnessField += '<span class="invalid-feedback" style="display: block!important;" role="alert"></span>'
          illnessField += '</td>'
          illnessField += '<td>'
          illnessField += `<input type="text" name="diagnostic_date[]" class="form-control form-control-sm dinamicDate" placeholder="Fecha" data-inputmask="'alias': 'datetime', 'inputFormat': 'dd/mm/yyyy'">`
          illnessField += '<span class="invalid-feedback" style="display: block!important;" role="alert"></span>'
          illnessField += '</td>'
          illnessField += '<td>'
          illnessField += '<input type="text" name="treatment[]" class="form-control form-control-sm">'
          illnessField += '<span class="invalid-feedback" style="display: block!important;" role="alert"></span>'
          illnessField += '</td>'
          illnessField += '<td>'
          illnessField += '<td class="text-center">'
          illnessField += '<button class="btn btn-danger btn-sm deleteillness" type="button" id="addon-wrapping">Eliminar</i></button>'
          illnessField += '</td>'
          illnessField += '</tr>'
          $('#illness_table tbody').append(illnessField)
          // .dinamicDate
      }

      var amount = $('#smoke_cigars').val();
      var present=0;

      $(document).on('keypress', '#smoke_cigars', function (evt) {
          var code = (evt.which) ? evt.which : evt.keyCode;
          var amount = $('#smoke_cigars').val();
          if ((amount.indexOf('.') >= 0)) {
              console.log('ke', amount);
          } else {
              console.log('no');
          }
      });
      $(document).on('click', '.deleteSurgey', function(event) {
          $(this).parents('tr').remove()

          if ($("#medication_table tbody tr").length < 1) {
              addExerciseFields()
          }

      });

      $(document).on('click', '#exerciceTableAdd',function () {
          $('.formError').html('')
          addExerciseFields()
      });

      $(document).on('change', 'input[type=radio][name=smoke]',  function (e) {

          if ($("input[type=radio][name=smoke]:checked").val() == '1') {
              $('.smoke').show('fast')

          } else {
              $('.smoke').hide('fast')
              $('#smoke_cigars').val('')
              $('#smoke_years').val('')
              $('.smoke_quit').hide('fast')
              $('input[name=stop_smoking]').prop('checked', false);
              $('#when_stop_smoking').val('');

          }
      });

      $(document).on('change', 'input[type=radio][name=exercise]',  function (e) {
          if ($("input[type=radio][name=exercise]:checked").val() == '1') {
              $('#exercise_table').show('fast')
              addExerciseFields()
          } else {
              $('#exercise_table').hide('fast')
              $('#when_stop_smoking').val('');
              $('#medication_table').find('tbody').html('');
          }
      });

      $(document).on('change', 'input[type=radio][name=stop_smoking]',  function (e) {
          if ($("input[type=radio][name=stop_smoking]:checked").val() == '1') {
              $('.smoke_quit').show('fast')
          } else {
              $('.smoke_quit').hide('fast')

              $('#when_stop_smoking').val('');
          }
      });

      $(document).on('change', 'input[type=radio][name=recreative_drugs]',  function (e) {
          if ($("input[type=radio][name=recreative_drugs]:checked").val() == '1') {
              $('.recreative_drugs').show('fast')
          } else {
              $('.recreative_drugs').hide('fast')
              $('#total_recreative_drugs').val('');
              $("input[name=intravenous_drugs][value=0]").prop('checked', true);
          }
      });

      $(document).on('change', 'input[type=radio][name=do_you_have_erections_at_the_morning]', function(){
          if ($("input[type=radio][name=do_you_have_erections_at_the_morning]:checked").val() == '1') {
              $('.do_you_have_erections_at_the_morning').show('fast')
          } else {
              $('.do_you_have_erections_at_the_morning').hide('fast')
              $('#how_many_per_week').val('');
          }
      })

      $(document).on('change', 'input[type=radio][name=do_you_have_problems_getting_erections]', function(){
          if ($("input[type=radio][name=do_you_have_problems_getting_erections]:checked").val() == '1') {
              $('.do_you_have_problems_getting_erections').show('fast')
          } else {
              $('.do_you_have_problems_getting_erections').hide('fast')
              $('#since_when').val('');
              $('#describe_your_erection_problem').val('');
              $('#describe_your_erection_problem').val('');
          }
      })

      $(document).on('change', 'input[type=radio][name=do_you_take_any_natural_remedy_for_erectile_dysfunction]', function(){
          if ($("input[type=radio][name=do_you_take_any_natural_remedy_for_erectile_dysfunction]:checked").val() == '1') {
              $('.do_you_take_any_natural_remedy_for_erectile_dysfunction').show('fast')
          } else {
              $('.do_you_take_any_natural_remedy_for_erectile_dysfunction').hide('fast')
              $('#what_kind').val('');
              $('#how_did_it_work_natural_remedy').val('');
              $('#where_did_you_get_them').val('');
          }
      })

      $(document).on('change', 'input[type=radio][name=has_medication_been_injected_for_dysfunction_erectile]', function(){
          if ($("input[type=radio][name=has_medication_been_injected_for_dysfunction_erectile]:checked").val() == '1') {
              $('.has_medication_been_injected_for_dysfunction_erectile').show('fast')
          } else {
              $('.has_medication_been_injected_for_dysfunction_erectile').hide('fast')
              $('#how_many_times_have_injected').val('');
              $('#how_did_it_work').val('');
          }
      })

      $(document).on('change', 'input[type=radio][name=has_medication_been_injected_for_dysfunction_erectile]', function(){
          if ($("input[type=radio][name=has_medication_been_injected_for_dysfunction_erectile]:checked").val() == '1') {
              $('.has_medication_been_injected_for_dysfunction_erectile').show('fast')
          } else {
              $('.has_medication_been_injected_for_dysfunction_erectile').hide('fast')
              $('#how_many_times_have_injected').val('');
              $('#how_did_it_work').val('');
          }
      })

      $(document).on('change', 'input[type=radio][name=alcohol]', function(){
          if ($("input[type=radio][name=alcohol]:checked").val() == '1') {
              $('.alcohol').show('fast')
          } else {
              $('.alcohol').hide('fast')
              $('#volumen_alcohol').val('');
          }
      })

      $(document).on('change', 'input[type=radio][name=intravenous_drugs]', function(){
          if ($("input[type=radio][name=intravenous_drugs]:checked").val() == '1') {
              $('.intravenous_drugs').show('fast')
          } else {
              $('.intravenous_drugs').hide('fast')
              $('#description_intravenous_drugs').val('');
          }
      })

      $(document).on('change', 'input[type=radio][name=have_you_had_an_erection_longer_than_six_hours]', function(){
          if ($("input[type=radio][name=have_you_had_an_erection_longer_than_six_hours]:checked").val() == '1') {
              $('.have_you_had_an_erection_longer_than_six_hours').show('fast')
          } else {
              $('.have_you_had_an_erection_longer_than_six_hours').hide('fast')
              $('#when_you_had_a_six_hours_erection').val('');
              $('#how_was_it_resolved').val('');
              $('#did_you_get_medical_attention').val('');
          }
      })

      $(document).on('change', 'input[type=radio][name=do_you_suffer_from_penile_curvature]', function(){
          if ($("input[type=radio][name=do_you_suffer_from_penile_curvature]:checked").val() == '1') {
              $('.do_you_suffer_from_penile_curvature').show('fast')
          } else {
              $('.do_you_suffer_from_penile_curvature').hide('fast')
              $('#how_intense').val('');
              $('#which_direction').val('');
              $('#does_it_hurt').val('');
              $('#does_it_prevent_intercourse').val('');
          }
      })
      
      function addExerciseFields() {
          var exerciseField = '';
          exerciseField += '<tr>'
          exerciseField += '<td>'
          exerciseField += '<input type="text" name="exercise_type[]" class="form-control form-control-sm">'
          exerciseField += '<span class="invalid-feedback" style="display: block!important;" role="alert"></span>'
          exerciseField += '</td>'
          exerciseField += '<td>'
          exerciseField += '<input type="text" name="exercise_how_long[]" class="form-control form-control-sm">'
          exerciseField += '<span class="invalid-feedback" style="display: block!important;" role="alert"></span>'
          exerciseField += '</td>'
          exerciseField += '<td>'
          exerciseField += '<input type="text" name="exercise_how_frecuent[]" class="form-control form-control-sm">'
          exerciseField += '<span class="invalid-feedback" style="display: block!important;" role="alert"></span>'
          exerciseField += '</td>'
          exerciseField += '<td>'
          exerciseField += '<input type="text" name="exercise_hours[]" class="form-control form-control-sm">'
          exerciseField += '<span class="invalid-feedback" style="display: block!important;" role="alert"></span>'
          exerciseField += '</td>'
          exerciseField += '<td class="text-center">'
          exerciseField += '<button class="btn btn-danger btn-sm btn-block deleteSurgey" type="button" id="addon-wrapping">Eliminar</i></button>'
          exerciseField += '</td>'
          exerciseField += '</tr>'
          $('#exercise_table tbody').append(exerciseField)
      }

      $(document).on('change', 'input[type=radio][name=have_you_been_pregnant]',  function (e) {
        if ($("input[type=radio][name=have_you_been_pregnant]:checked").val() == '1') {
          $('.have_you_been_pregnant').show('fast')
          addHormoneFields()
        } else {
          $('.have_you_been_pregnant').hide('fast')
          $('#how_many_times').val('')
          $('#c_section').val('')
        }
      });

      $(document).on('click', '.deleteHormone', function(event) {
        $(this).parents('tr').remove()

        if ($("#hormones_table tbody tr").length < 1) {
          addHormoneFields()
        }

      });

      $(document).on('click', '.deletebirthControl', function(event) {
        $(this).parents('tr').remove()

        if ($("#birth_control_table tbody tr").length < 1) {
          addbirthControlFields()
        }

      });

      $(document).on('click', '#hormoneTableAdd',function () {
        $('.formError').html('')
        addHormoneFields()
      });

      $(document).on('click', '#birthControlTableAdd',function () {
        $('.formError').html('')
        addbirthControlFields()
      });

      $(document).on('change', 'input[type=radio][name=use_hormones]',  function (e) {

        if ($("input[type=radio][name=use_hormones]:checked").val() == '1') {
          $('#hormones_table').show('fast')
          addHormoneFields()
        } else {
          $('#hormones_table').hide('fast')
          $('#hormones_table').find('tbody').html('');
        }
      });

      $(document).on('change', 'input[type=radio][name=birth_control]',  function (e) {

        if ($("input[type=radio][name=birth_control]:checked").val() == '1') {
          $('#birth_control_table').show('fast')
          addbirthControlFields()
        } else {
          $('#birth_control_table').hide('fast')
          $('#birth_control_table').find('tbody').html('');
        }
      });

      function addHormoneFields() {
        var medicationField = '';
        medicationField += '<tr>'
        medicationField += '<th>'
        medicationField += '<input type="text" name="hormone_type[]" class="form-control form-control-sm">'
        medicationField += '<span class="invalid-feedback" style="display: block!important;" role="alert"></span>'
        medicationField += '</th>'
        medicationField += '<td>'
        medicationField += '<input type="text" name="hormone_how_long[]" class="form-control form-control-sm">'
        medicationField += '<span class="invalid-feedback" style="display: block!important;" role="alert"></span>'
        medicationField += '</td>'
        medicationField += '<td>'
        medicationField += '<td class="text-center">'
        medicationField += '<button class="btn btn-danger btn-sm btn-block deleteHormone" type="button" id="addon-wrapping">Eliminar</i></button>'
        medicationField += '</td>'
        medicationField += '</tr>'
        $('#hormones_table tbody').append(medicationField)
      }
      function addbirthControlFields() {
        var medicationField = '';
        medicationField += '<tr>'
        medicationField += '<th>'
        medicationField += '<input type="text" name="birthControl_type[]" class="form-control form-control-sm">'
        medicationField += '<span class="invalid-feedback" style="display: block!important;" role="alert"></span>'
        medicationField += '</th>'
        medicationField += '<td>'
        medicationField += '<input type="text" name="birthControl_how_long[]" class="form-control form-control-sm">'
        medicationField += '<span class="invalid-feedback" style="display: block!important;" role="alert"></span>'
        medicationField += '</td>'
        medicationField += '<td class="text-center">'
        medicationField += '<button class="btn btn-danger btn-sm btn-block deletebirthControl" type="button" id="addon-wrapping">Eliminar</i></button>'
        medicationField += '</td>'
        medicationField += '</tr>'
        $('#birth_control_table tbody').append(medicationField)
      }
      $("select").change(function () {
          if(!$(this).val()) $(this).addClass("empty");
          else $(this).removeClass("empty")
      });
      $("select").change();

      (function($) {
            $.fn.inputFilter = function(inputFilter) {
                return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
                if (inputFilter(this.value)) {
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                } else if (this.hasOwnProperty("oldValue")) {
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                } else {
                    this.value = "";
                }
                });
            };
        }(jQuery));

        $(function () {
            $(".intTextBox").inputFilter(function(value) { // solo numeros
                return /^-?\d*$/.test(value); 
            });
            $(".uintTextBox").inputFilter(function(value) { // solo enteros > 0
                return /^\d*$/.test(value); 
            });
            $(".intLimitTextBox").inputFilter(function(value) { // limitado a 500
                return /^\d*$/.test(value) && (value === "" || parseInt(value) <= parseInt(number)); 
            });
            $(".floatTextBox").inputFilter(function(value) { // con decimales
                return /^-?\d*[.,]?\d*$/.test(value); 
            });
            $(".currencyTextBox").inputFilter(function(value) { //modeda
                return /^-?\d*[.,]?\d{0,2}$/.test(value); 
            });
            $(".latinTextBox").inputFilter(function(value) { // solo letas
                return /^[a-z]*$/i.test(value); 
            });
            $(".hexTextBox").inputFilter(function(value) { // exadecimal letas y numeros
                return /^[0-9a-f]*$/i.test(value); 
            });
            function validarFecha(fecha) {
              var formato = "MM/DD/YYYY";
              return moment(fecha, formato, true).isValid();
            }
            $(document).on('change', '.fecha', function(event) {
              event.preventDefault();
              date = $(this).val();
              if (!validarFecha(date)) {

              }
            });
        });
    </script>
  </body>
</html>