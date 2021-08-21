<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('temp_code');
            $table->bigInteger('patient_id')->unsigned();

            $table->bigInteger('product_id')->unsigned()->nullable();
            $table->string('mesure_sistem')->nullable();

            $table->float('weight', 5, 2)->nullable();
            $table->float('max_weigh', 5, 2)->nullable();
            $table->float('height', 5, 2)->nullable();
            $table->float('imc', 5, 2)->nullable();
            $table->boolean('if_take_medication')->nullable();
            $table->boolean('if_take_blood_thinners')->nullable();
            $table->text('razon_blood_thinners')->nullable();
            $table->enum('acid_reflux', ['rarely', 'occasionally', 'frequently', 'no'])->default('no');
            $table->boolean('penicilin')->nullable();
            $table->boolean('drugs_sulfa')->nullable();
            $table->boolean('iodine')->nullable();
            $table->boolean('tape')->nullable();
            $table->boolean('latex')->nullable();
            $table->boolean('aspirin')->nullable();
            $table->boolean('other_allergy')->nullable();
            $table->text('describe_other_allergy')->nullable();
            $table->longText('mediacation_cadena')->nullable();

            $table->boolean('previous_surgery')->nullable();
            $table->longText('surgery_cadena')->nullable();

            $table->boolean('has_addiction')->nullable();
            $table->date('date_addiction')->nullable();
            $table->text('addiction_treatment')->nullable();
            $table->boolean('has_cancer')->nullable();
            $table->date('date_cancer')->nullable();
            $table->text('cancer_treatment')->nullable();
            $table->boolean('has_diabetes')->nullable();
            $table->date('date_diabetes')->nullable();
            $table->text('diabetes_treatment')->nullable();
            $table->boolean('has_hypertension')->nullable();
            $table->date('date_hypertension')->nullable();
            $table->text('hypertension_treatment')->nullable();
            $table->boolean('has_crebral_shedding')->nullable();
            $table->date('date_crebral_shedding')->nullable();
            $table->text('crebral_shedding_treatment')->nullable();
            $table->boolean('has_disease_heart')->nullable();
            $table->date('date_disease_heart')->nullable();
            $table->text('disease_heart_treatment')->nullable();
            $table->boolean('has_disease_lung')->nullable();
            $table->date('date_disease_lung')->nullable();
            $table->text('disease_lung_treatment')->nullable();
            $table->boolean('has_disease_thyroid')->nullable();
            $table->date('date_disease_thyroid')->nullable();
            $table->text('disease_thyroid_treatment')->nullable();
            $table->boolean('has_disease_kidney')->nullable();
            $table->date('date_disease_kidney')->nullable();
            $table->text('disease_kidney_treatment')->nullable();
            $table->boolean('has_disease_liver')->nullable();
            $table->date('date_disease_liver')->nullable();
            $table->text('disease_liver_treatment')->nullable();
            $table->boolean('has_disease_stroke')->nullable();
            $table->date('date_disease_stroke')->nullable();
            $table->text('disease_stroke_treatment')->nullable();
            $table->boolean('has_disease_arthritis')->nullable();
            $table->date('date_disease_arthritis')->nullable();
            $table->text('disease_arthritis_treatment')->nullable();
            $table->boolean('has_disease_other')->nullable();
            $table->date('date_disease_other')->nullable();
            $table->text('disease_other_treatment')->nullable();

            $table->boolean('smoke')->nullable();
            $table->tinyInteger('smoke_cigars')->nullable();
            $table->tinyInteger('smoke_years')->nullable();
            $table->boolean('stop_smoking')->nullable();
            $table->date('when_stop_smoking')->nullable();
            $table->boolean('alcohol')->nullable();
            $table->text('volumen_alcohol')->nullable();
            $table->boolean('recreative_drugs')->nullable();
            $table->tinyInteger('total_recreative_drugs')->nullable();
            $table->boolean('intravenous_drugs')->nullable();
            $table->string('description_intravenous_drugs', 255)->nullable();
            $table->boolean('tire')->nullable();
            $table->boolean('trouble_breathe')->nullable();
            $table->boolean('bipap_cpap')->nullable();
            $table->boolean('asthma')->nullable();

            $table->date('last_menstrual_period')->nullable();
            $table->string('flow_type')->nullable();
            $table->boolean('previous_pregnancy')->nullable();
            $table->integer('number_pregnancies')->nullable();
            $table->boolean('caesarean')->nullable();
            $table->boolean('birth_control')->nullable();
            $table->string('description_birth_control')->nullable();
            $table->boolean('use_oral_contraceptives')->nullable();
            $table->string('description_use_oral_contraceptives')->nullable();
            $table->boolean('use_hormones')->nullable();
            $table->string('description_hormones')->nullable();
            $table->boolean('is_or_can_be_pregmant')->nullable();


            $table->boolean('about_us_google')->default(false);
            $table->boolean('about_us_facebook')->default(false);
            $table->boolean('about_us_youtube')->default(false);
            $table->boolean('about_us_twiter')->default(false);
            $table->boolean('about_us_forums')->default(false);
            $table->boolean('about_us_friend')->default(false);
            $table->boolean('about_us_instagram')->default(false);
            $table->boolean('about_us_radio')->default(false);
            $table->boolean('about_us_email')->default(false);
            $table->boolean('about_us_other')->default(false);
            $table->string('about_us_description_other', 255)->nullable();
            $table->boolean('is_complete')->default(false);
            $table->enum('status', ['waiting', 'denied', 'debate', 'second_opinion', 'accepted', 'scheduled', 'in_surgery', 'finalized'])->default('waiting');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('applications', function($table) {
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
}
