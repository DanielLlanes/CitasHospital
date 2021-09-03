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

            $table->boolean('previous_surgery')->nullable();
            $table->boolean('if_have_surgeries')->nullable();


            $table->boolean('addiction')->nullable();
            $table->text('which_one_adiction')->nullable();

            $table->boolean('high_lipid_levels')->nullable();
            $table->date('date_high_lipd_levels')->nullable();
            $table->text('high_lipid_levels_treatment')->nullable();

            $table->boolean('cancer')->nullable();
            $table->date('date_cancer')->nullable();
            $table->text('cancer_treatment')->nullable();

            $table->boolean('arthritis')->nullable();
            $table->date('date_arthritis')->nullable();
            $table->text('arthritis_treatment')->nullable();

            $table->boolean('cholesterol')->nullable();
            $table->date('date_cholesterol')->nullable();
            $table->text('cholesterol_treatment')->nullable();

            $table->boolean('triglycerides')->nullable();
            $table->date('date_triglycerides')->nullable();
            $table->text('triglycerides_treatment')->nullable();

            $table->boolean('disease_stroke')->nullable();
            $table->date('date_disease_stroke')->nullable();
            $table->text('disease_stroke_treatment')->nullable();

            $table->boolean('diabetes')->nullable();
            $table->date('date_diabetes')->nullable();
            $table->text('diabetes_treatment')->nullable();

            $table->boolean('coronary_artery_disease')->nullable();
            $table->date('date_coronary_artery_disease')->nullable();
            $table->text('coronary_artery_disease_treatment')->nullable();

            $table->boolean('disease_liver')->nullable();
            $table->date('date_disease_liver')->nullable();
            $table->text('disease_liver_treatment')->nullable();

            $table->boolean('disease_lung')->nullable();
            $table->date('date_disease_lung')->nullable();
            $table->text('disease_lung_treatment')->nullable();

            $table->boolean('disease_renal')->nullable();
            $table->date('date_disease_renal')->nullable();
            $table->text('disease_renal_treatment')->nullable();

            $table->boolean('disease_thyroid')->nullable();
            $table->date('date_disease_thyroid')->nullable();
            $table->text('disease_thyroid_treatment')->nullable();

            $table->boolean('ypertension')->nullable();
            $table->date('hypertension')->nullable();
            $table->text('hypertension_treatment')->nullable();

            $table->boolean('disease_other')->nullable();
            $table->date('date_disease_other')->nullable();
            $table->text('disease_other_treatment')->nullable();


            $table->boolean('crebral_shedding')->nullable();
            $table->date('date_crebral_shedding')->nullable();
            $table->text('crebral_shedding_treatment')->nullable();

            $table->boolean('disease_heart')->nullable();
            $table->date('date_disease_heart')->nullable();
            $table->text('disease_heart_treatment')->nullable();



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
            $table->boolean('fatigue')->nullable();
            $table->boolean('trouble_breathe')->nullable();
            $table->boolean('bipap_cpap')->nullable();
            $table->boolean('asthma')->nullable();
            $table->boolean('exercise')->nullable();

            $table->date('last_menstrual_period')->nullable();
            $table->enum('bleeding_whas', ["normal", "light", "heavy", "irregular"])->default("normal");
            $table->boolean('have_you_been_pregnant')->nullable();
            $table->integer('how_many_times')->nullable();
            $table->integer('c_section')->nullable();
            $table->boolean('caesarean')->nullable();
            $table->boolean('birth_control')->nullable();

            $table->string('description_birth_control')->nullable();
            $table->boolean('use_oral_contraceptives')->nullable();
            $table->string('description_use_oral_contraceptives')->nullable();
            $table->boolean('use_hormones')->nullable();

            $table->boolean('is_or_can_be_pregmant')->nullable();

            $table->string('hours_you_sleep_at_night')->nullable();
            $table->boolean('do_you_take_sleeping_pills')->nullable();
            $table->boolean('do_you_suffer_from_anxiety_or_depression')->nullable();
            $table->boolean('do_you_take_pills_for_anxiety_or_depression')->nullable();
            $table->boolean('do_you_feel_under_stress')->nullable();

            $table->boolean('do_you_have_erections_at_the_morning')->nullable();
            $table->string('how_many_per_week')->nullable();
            $table->boolean('do_you_have_problems_getting_erections')->nullable();
            $table->string('since_when')->nullable();
            $table->string('describe_your_erection_problem')->nullable();
            $table->boolean('do_you_have_problems_maintaining_an_erection')->nullable();
            $table->boolean('do_you_take_any_natural_remedy_for_erectile_dysfunction')->nullable();
            $table->string('what_kind')->nullable();
            $table->string('how_did_it_work_natural_remedy')->nullable();
            $table->string('where_did_you_get_them')->nullable();
            $table->boolean('has_medication_been_injected_for_dysfunction_erectile')->nullable();
            $table->string('how_many_times_have_injected')->nullable();
            $table->string('how_did_it_work')->nullable();
            $table->boolean('have_you_had_an_erection_longer_than_six_hours')->nullable();
            $table->string('when_you_had_a_six_hours_erection')->nullable();
            $table->string('how_was_it_resolved')->nullable();
            $table->string('did_you_get_medical_attention')->nullable();
            $table->boolean('do_you_suffer_from_penile_curvature')->nullable();
            $table->string('how_intense')->nullable();
            $table->string('which_direction')->nullable();
            $table->string('does_it_hurt')->nullable();
            $table->string('does_it_prevent_intercourse')->nullable();
            $table->boolean('has_prp_been_injected_for_erectile_dysfunction')->nullable();
            $table->boolean('have_you_received_stem_cell_treatment_for_erectile_dysfunction')->nullable();
            $table->boolean('hyrvrntwliwtfed')->nullable();


            $table->boolean('about_us_google')->default(false);
            $table->boolean('about_us_facebook')->default(false);
            $table->boolean('about_us_youtube')->default(false);
            $table->boolean('about_us_twiter')->default(false);
            $table->boolean('about_us_forums')->default(false);
            $table->boolean('about_us_friend')->default(false);
            $table->boolean('about_us_instagram')->default(false);
            $table->boolean('about_us_radio')->default(false);
            $table->boolean('about_us_email')->default(false);
            $table->boolean('about_us_frend')->default(false);
            $table->boolean('friend_name')->default(false);
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
