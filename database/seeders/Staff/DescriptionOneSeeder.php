<?php

namespace Database\Seeders\Staff;

use App\Models\Staff\Procedure;
use App\Models\Staff\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DescriptionOneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //service
        DB::table('description_ones')->insert([
            [
                "description_en" => "Is the Aesthetic, Reconstructive, Cosmetic and Weight loss plastic surgery program of J. L. Prado Surgical Center, designed to help you keep seeing and feeling incredible about yourself",
                "description_es" => "Es el programa de Cirugía Plástica Estética, Reparadora, Estética y de Adelgazamiento del Centro Quirúrgico J. L. Prado, diseñado para ayudarte a seguir viéndote y sintiéndote increíble contigo mismo.",//
                "descriptionOneable_id" => 2,
                "descriptionOneable_type" => 'App\Models\Staff\Service',
                'code' => time().uniqid(Str::random(30)),
            ],
        ]);
        DB::table('description_ones')->insert([
            [
                "description_en" => "Our specialists in this discipline have the knowledge, skill, and understanding of the basic medical sciences necessary for the genitourinary tract and the adrenal glands.",
                "description_es" => "Nuestros especialistas en esta disciplina tienen el conocimiento, la habilidad y la comprensión de las ciencias médicas básicas necesarias para el tracto genitourinario y las glándulas suprarrenales..",//
                "descriptionOneable_id" => 3,
                "descriptionOneable_type" => 'App\Models\Staff\Service',
                'code' => time().uniqid(Str::random(30)),
            ],
        ]);
        DB::table('description_ones')->insert([
            [
                "description_en" => "<h4>WE HAVE CREATED A DENTAL PROGRAM WITH AFFORDABLE PRICES SO YOU CAN HAVE THE SMILE YOU DESERVE</h4><h4>Tijuana is known to be the mayor city in Mexico when it comes to medical tourism, here we have the best doctors in the country, excellent results and the best prices.</h4><p>You are not only getting the best dental work, you are also exposed to our famous gastronomy, accommodations, bars and many more at a walking distance.</p>",
                "description_es" => "<h4>HEMOS CREADO UN PROGRAMA DENTAL CON PRECIOS ACCESIBLES PARA QUE PUEDAS TENER LA SONRISA QUE MERECES</h4><h4>Tijuana es conocida por ser la ciudad más importante de México en cuanto a turismo médico se refiere, aquí contamos con los mejores médicos en el país, excelentes resultados y los mejores precios.</h4><p>No solo estás recibiendo el mejor trabajo dental, también estás expuesto a nuestra famosa gastronomía, alojamientos, bares y mucho más a poca distancia.</ p>",//
                "descriptionOneable_id" => 4,
                "descriptionOneable_type" => 'App\Models\Staff\Service',
                'code' => time().uniqid(Str::random(30)),
            ],
        ]);
        //procedures
        //gastric slave
        DB::table('description_ones')->insert([
            [
                "description_en" => "This is the gold standard treatment for obesity in the world. With this operation, the surgeon removes between 70 to 80% of the stomach leaving the rest in the form of a tube or sleeve.",
                "description_es" => "Este es el tratamiento estándar de oro para la obesidad en el mundo. Con esta operación, el cirujano extirpa entre el 70 y el 80% del estómago dejando el resto en forma de tubo o manga.",//
                "descriptionOneable_id" => 1,
                "descriptionOneable_type" => 'App\Models\Staff\Procedure',
                'code' => time().uniqid(Str::random(30)),
            ],
            //revision
            [
                "description_en" => "Procedure for patients who have already had previous bariatric surgery. An example of this procedure would be a revision surgery from lap band to gastric sleeve.",
                "description_es" => "Procedimiento para pacientes que ya han tenido cirugía bariátrica previa. Un ejemplo de este procedimiento sería una cirugía de revisión de banda gástrica a manga gástrica.",//
                "descriptionOneable_id" => 2,
                "descriptionOneable_type" => 'App\Models\Staff\Procedure',
                'code' => time().uniqid(Str::random(30)),
            ],
            //lipo
            [
                "description_en" => "With liposculpture we will contour your body giving definition to the areas that are needed, leaving or eliminating the fat in an inhomogeneous way.",
                "description_es" => "Con la lipoescultura contornearemos tu cuerpo dando definición a las zonas que se necesiten, dejando o eliminando la grasa de forma no homogénea.",//
                "descriptionOneable_id" => 8,
                "descriptionOneable_type" => 'App\Models\Staff\Procedure',
                'code' => time().uniqid(Str::random(30)),
            ],
            //senos aumento
            [
                "description_en" => "Breast implants are designed to increase the volume of your breasts. The breasts will still retain their original shape and position, which will make your silhouette look better..",
                "description_es" => "Los implantes mamarios están diseñados para aumentar el volumen de sus senos. Los senos aún conservarán su forma y posición original, lo que hará que tu silueta se vea mejor.",//
                "descriptionOneable_id" => 9,
                "descriptionOneable_type" => 'App\Models\Staff\Procedure',
                'code' => time().uniqid(Str::random(30)),
            ],
            //senos reduccion
            [
                "description_en" => "A breast lift, also known as a mastopexy, lifts the breasts by removing excess skin and tightening the surrounding tissue to reshape and support the new contour of the breasts.",
                "description_es" => "Un levantamiento de senos, también conocido como mastopexia, levanta los senos eliminando el exceso de piel y tensando el tejido circundante para remodelar y sostener el nuevo contorno de los senos.",//
                "descriptionOneable_id" => 10,
                "descriptionOneable_type" => 'App\Models\Staff\Procedure',
                'code' => time().uniqid(Str::random(30)),
            ],

            // abdominoplastia
            [
                "description_en" => "Also known as a Tummy Tuck, it removes excess fat and skin and, in most cases, restores weakened or separated muscles creating an abdominal profile that is softer and firmer.",
                "description_es" => "También conocida como abdominoplastia, elimina el exceso de grasa y piel y, en la mayoría de los casos, restaura los músculos debilitados o separados creando un perfil abdominal más suave y firme.",//
                "descriptionOneable_id" => 7,
                "descriptionOneable_type" => 'App\Models\Staff\Procedure',
                'code' => time().uniqid(Str::random(30)),
            ],
            //brazilian butt
            [
                "description_en" => "It consists of contouring the gluteus with the fat obtained from around it, or from another liposuction area of the body. It produces an increase in volume and definition creating a more aesthetic gluteus.",
                "description_es" => "Consiste en contornear el glúteo con la grasa obtenida de su alrededor, o de otra zona del cuerpo lipoaspirada. Produce un aumento de volumen y definición creando un glúteo más estético.",//
                "descriptionOneable_id" => 11,
                "descriptionOneable_type" => 'App\Models\Staff\Procedure',
                'code' => time().uniqid(Str::random(30)),
            ],
            // estiramiento facial
            [
                "description_en" => "Clinically known as rhytidectomy, it is a procedure used to reduce the appearance of facial wrinkles and other signs of aging, with the aim of improving the overall appearance of the face and jaw.",
                "description_es" => "Clínicamente conocida como ritidectomía, es un procedimiento utilizado para reducir la apariencia de las arrugas faciales y otros signos de envejecimiento, con el objetivo de mejorar la apariencia general de la cara y la mandíbula.",//
                "descriptionOneable_id" => 14,
                "descriptionOneable_type" => 'App\Models\Staff\Procedure',
                'code' => time().uniqid(Str::random(30)),
            ],
            //Blefaroplastia
            [
                "description_en" => "Also called eye lifting, reduces the lower eyelid pocket and removes excess skin from the upper eyelids. This surgery is usually done for aesthetic reasons. It is also an effective way to improve eyesight in older people whose drooping upper eyelids stand in the way of their vision.",
                "description_es" => "También llamado lifting de ojos, reduce la bolsa del párpado inferior y elimina el exceso de piel de los párpados superiores. Esta cirugía generalmente se realiza por razones estéticas. También es una forma efectiva de mejorar la vista en personas mayores cuyos párpados superiores caídos les impiden ver.",//
                "descriptionOneable_id" => 15,
                "descriptionOneable_type" => 'App\Models\Staff\Procedure',
                'code' => time().uniqid(Str::random(30)),
            ],
            //Brazos
            [
                "description_en" => "This procedure allows us to remove excess skin and accumulated fat on the upper part of the arms. The skin located in this area has several problems; It is extremely thin, has little elasticity and is not exactly vulnerable to exercise. Therefore, the last alternative available to correct the flaccidity of this area is brachioplasty, which removes excess skin and fat to restore the shape of the arm. This surgery has several modalities which differ according to the type of incision that is made. The selection of the type of incision will depend on the amount of excess skin and accumulated fat that the patient has. It must be taken into account that the length of the incision is proportional to the amount of loose skin that exists. The looser skin the longer the incision will be..",
                "description_es" => "Este procedimiento nos permite eliminar el exceso de piel y grasa acumulada en la parte superior de los brazos. La piel ubicada en esta zona tiene varios problemas; Es extremadamente delgada, tiene poca elasticidad y no es precisamente vulnerable al ejercicio. Por ello, la última alternativa disponible para corregir la flacidez de esta zona es la braquioplastia, que elimina el exceso de piel y grasa para devolver la forma al brazo. Esta cirugía tiene varias modalidades que se diferencian según el tipo de incisión que se realice. La selección del tipo de incisión dependerá de la cantidad de exceso de piel y grasa acumulada que tenga el paciente. Hay que tener en cuenta que el largo de la incisión es proporcional a la cantidad de piel suelta que existe. Cuanto más suelta sea la piel, más larga será la incisión.",//
                "descriptionOneable_id" => 12,
                "descriptionOneable_type" => 'App\Models\Staff\Procedure',
                'code' => time().uniqid(Str::random(30)),
            ],
            //rhino
            [
                "description_en" => "The procedure commonly known as nose job, is a plastic surgery procedure to correct and reconstruct the shape and functions of the nose, combined with correction of the airway, and aesthetically improve the nose when resolving the nasal trauma (blunt, penetrating, blast). Congenital, respiratory defect. The method used depends on the present deformity and the patient’s expectation. The external approach is necessary if a lot of work is needed at the tip of the nose, but the internal approach can be used if the deformity is mainly limited to the dorsal hump or to correct the deviation of the nose.",
                "description_es" => "El procedimiento comúnmente conocido como cirugía de nariz, es un procedimiento de cirugía plástica para corregir y reconstruir la forma y funciones de la nariz, combinado con la corrección de la vía aérea, y mejorar estéticamente la nariz al resolver el trauma nasal (contuso, penetrante, por explosión). Defecto respiratorio congénito. El método utilizado depende de la deformidad presente y de las expectativas del paciente. El abordaje externo es necesario si se necesita mucho trabajo en la punta de la nariz, pero el abordaje interno puede usarse si la deformidad se limita principalmente a la joroba dorsal o para corregir la desviación de la nariz.",//
                "descriptionOneable_id" => 16,
                "descriptionOneable_type" => 'App\Models\Staff\Procedure',
                'code' => time().uniqid(Str::random(30)),
            ],
            //Levantamiento de muslos
            [
                "description_en" => "A thigh lift can reshape the thighs by reducing excess skin and fat, resulting in smoother skin and better contours for the thighs and lower body.",
                "description_es" => "Un levantamiento de muslos puede remodelar los muslos al reducir el exceso de piel y grasa, lo que da como resultado una piel más suave y mejores contornos para los muslos y la parte inferior del cuerpo.",//
                "descriptionOneable_id" => 13,
                "descriptionOneable_type" => 'App\Models\Staff\Procedure',
                'code' => time().uniqid(Str::random(30)),
            ],
            //green light
            [
                "description_en" => "Low risk surgery using the best technology for the treatment of urinary obstruction due to prostatic growth that affects the vast majority of older adults.",
                "description_es" => "Cirugía de bajo riesgo con la mejor tecnología para el tratamiento de la obstrucción urinaria por crecimiento prostático que afecta a la gran mayoría de los adultos mayores.",//
                "descriptionOneable_id" => 22,
                "descriptionOneable_type" => 'App\Models\Staff\Procedure',
                'code' => time().uniqid(Str::random(30)),
            ],
            //revelsal vacectomi
            [
                "description_en" => "Vasovasostomy, surgical procedure of microsurgery for fertility.",
                "description_es" => "Vasovasostomía, procedimiento quirúrgico de microcirugía para la fertilidad.",//
                "descriptionOneable_id" => 23,
                "descriptionOneable_type" => 'App\Models\Staff\Procedure',
                'code' => time().uniqid(Str::random(30)),
            ],
            //incontinencia
            [
                "description_en" => "Vaginal surgery with mesh placement (sling). Outpatient procedure with rapid recovery and few complications for stress urinary incontinence",
                "description_es" => "Cirugía vaginal con colocación de malla (sling). Procedimiento ambulatorio con recuperación rápida y pocas complicaciones para la incontinencia urinaria de esfuerzo",//
                "descriptionOneable_id" => 24,
                "descriptionOneable_type" => 'App\Models\Staff\Procedure',
                'code' => time().uniqid(Str::random(30)),
            ],
            //coronas
            [
                "description_en" => "<p><strong>PORCELAIN FUSED TO METAL CROWN</strong> <br>it is a prosthesis to replace lost teeth that cannot be removed from the mouth by the patient, it is made of metal, that is covered with porcelain. The bridge is closed on prepared teeth or on implants.</p>",
                "description_es" => "<p><strong>CORONA DE PORCELANA FUNDIDA A METAL</strong> <br>es una prótesis para reponer dientes perdidos que el paciente no puede sacar de la boca, es de metal, es decir recubierta de porcelana. El puente se cierra sobre dientes preparados o sobre implantes.</p>",//
                "descriptionOneable_id" => 26,
                "descriptionOneable_type" => 'App\Models\Staff\Procedure',
                'code' => time().uniqid(Str::random(30)),
            ],
            //rellenos
            [
                "description_en" => "<p><strong>COMPOSITE FILLING</strong> <br>They are used to rapair damaged teeth by cracks or cavities, without affecting the aesthetics of your smile.</p>",
                "description_es" => "<p><strong>RELLENO COMPUESTO</strong> <br>Se utilizan para reparar dientes dañados por grietas o caries, sin afectar la estética de tu sonrisa.</p>",//
                "descriptionOneable_id" => 24,
                "descriptionOneable_type" => 'App\Models\Staff\Procedure',
                'code' => time().uniqid(Str::random(30)),
            ],
            //denta
            [
                "description_en" => "<p><strong>PARTIAL DENTURE METAL FRAME</strong> <br>

                designed andn structured in such a way that the patient can install and remove them from the mouth, thus facilitating the cleaning and
                maintenance of oral hygiene.</p><p><strong>PARTIAL DENTURE FLEXIBLE FRAME</strong> <br>

                designed and structured in such a way that the patient can install and remove them from the mouth, thus facilitating the cleaning and maintenance of oral hygiene. The material is free of metal and adheres better to soft tissues (gum). </p><p><strong>PARTIAL DENTURE FLEXIBLE FRAME</strong> <br>

                designed and structured in such a way that the patient can install and remove them from the mouth, thus facilitating the cleaning and maintenance of oral hygiene. The material is free of metal and adheres better to soft tissues (gum). </p><p><strong>PARTIAL DENTURE FLEXIBLE FRAME</strong> <br>

                designed and structured in such a way that the patient can install and remove them from the mouth, thus facilitating the cleaning and maintenance of oral hygiene. The material is free of metal and adheres better to soft tissues (gum). </p><p><strong>PARTIAL DENTURE FLEXIBLE FRAME</strong> <br>

                designed and structured in such a way that the patient can install and remove them from the mouth, thus facilitating the cleaning and maintenance of oral hygiene. The material is free of metal and adheres better to soft tissues (gum). </p>",
                "description_es" => "<p><strong>ESTRUCTURA METÁLICA PARA PRÓTESIS PARCIAL</strong> <br>

                diseñados y estructurados de tal manera que el paciente pueda colocarlos y retirarlos de la boca, facilitando así la limpieza y
                mantenimiento de la higiene bucal.</p><p><strong>ESTRUCTURA FLEXIBLE PARA PRÓTESIS PARCIAL</strong> <br>

                diseñados y estructurados de tal manera que el paciente pueda colocarlos y retirarlos de la boca, facilitando así la limpieza y mantenimiento de la higiene bucal. El material no contiene metal y se adhiere mejor a los tejidos blandos (encía). </p><p><strong>ESTRUCTURA FLEXIBLE PARA PRÓTESIS PARCIAL</strong> <br>

                diseñados y estructurados de tal manera que el paciente pueda colocarlos y retirarlos de la boca, facilitando así la limpieza y mantenimiento de la higiene bucal. El material no contiene metal y se adhiere mejor a los tejidos blandos (encía). </p><p><strong>ESTRUCTURA FLEXIBLE PARA PRÓTESIS PARCIAL</strong> <br>
                diseñados y estructurados de tal manera que el paciente pueda colocarlos y retirarlos de la boca, facilitando así la limpieza y mantenimiento de la higiene bucal. El material no contiene metal y se adhiere mejor a los tejidos blandos (encía). </p><p><strong>ESTRUCTURA FLEXIBLE PARA PRÓTESIS PARCIAL</strong> <br>
                diseñados y estructurados de tal manera que el paciente pueda colocarlos y retirarlos de la boca, facilitando así la limpieza y mantenimiento de la higiene bucal. El material no contiene metal y se adhiere mejor a los tejidos blandos (encía). </p>",//
                "descriptionOneable_id" => 27,
                "descriptionOneable_type" => 'App\Models\Staff\Procedure',
                'code' => time().uniqid(Str::random(30)),
            ],
            //root canal
            [
                "description_en" => "<p><strong>MOLAR ROOT CANAL</strong> <br>
                the dentist makes a small hole in the crown of the molar tooth to be able to reach the pulp chamber and eliminate tooth decay, remove the infected pulp, clean the root canal, fill the ducts with resins, prepare the tooth to place a dental crown, cement the crown of the tooth and finish the treatment. </p>
                <p><strong>ROOT CANAL RETREATMENT</strong> <br>
                the retreatment of ducts should always be the first therapeutic option to solve an endodontic failure. It consists in the elimination of the present filling, the new cleaning and shaping of the ducts, as well as the identification and correction of the cause of the failure of the previous treatment. The ducts are re-filled and sealed, in order to subsequently follow up to assess the evolution. </p>
                <p><strong>POST/CORE BUILD UP</strong> <br>
                the posts are elements that the dentist uses in the dental clinic to give greater retention to the reconstruction of composite teeth with destroyed crowns.</p>
                <p><strong>FULL DENTURE CONFORT</strong> <br>
                a removable total prosthesis is intgrated by two essential elements; the base prosthesic and artificial teeth.The material is free of metal and adheres better to soft tissues (gum). </p>
                <p><strong>REPAIR OF DENTURE</strong> <br>
                normally if a tooth or hook has been broken or has been cracked cleanly, the prosthesis can be repaired by using a thermo polymerization resin or a self-curing acrylic resin. </p>",
                "description_es" => "<p><strong>MOLAR CONDUCTO RADICULAR</strong> <br>
                el odontólogo realiza un pequeño orificio en la corona del molar para poder llegar a la cámara pulpar y eliminar la caries, extraer la pulpa infectada, limpiar el conducto radicular, rellenar los conductos con resinas, preparar el diente para colocar una corona dental , cementar la corona del diente y finalizar el tratamiento. </p>
                <p><strong>RETRATAMIENTO DEL CONDUCTO RADICULAR</strong> <br>
                el retratamiento de conductos debe ser siempre la primera opción terapéutica para solucionar un fracaso endodóntico. Consiste en la eliminación del empaste presente, la nueva limpieza y conformación de los conductos, así como la identificación y corrección de la causa del fracaso del tratamiento anterior. Se rellenan y sellan los conductos, para posteriormente realizar un seguimiento para valorar la evolución. </p>
                <p><strong>CONSTRUCCIÓN POST/CORE</strong> <br>
                los postes son elementos que el odontólogo utiliza en la clínica dental para dar mayor retención a la reconstrucción de dientes de composite con coronas destruidas.</p>
                <p><strong>DENTADURA COMPLETA CONFORT</strong> <br>
                una prótesis total removible está integrada por dos elementos esenciales; la base prótesis y dientes artificiales. El material está libre de metal y se adhiere mejor a los tejidos blandos (encía). </p>
                <p><strong>REPARACIÓN DE DENTADURA</strong> <br>
                normalmente si un diente o gancho se ha roto o se ha fisurado limpiamente, la prótesis se puede reparar utilizando una resina de termopolimerización o una resina acrílica autopolimerizable. </p>",//
                "descriptionOneable_id" => 28,
                "descriptionOneable_type" => 'App\Models\Staff\Procedure',
                'code' => time().uniqid(Str::random(30)),
            ],
            //blanqueamiento
            [
                "description_en" => "<p><strong>REGULAR CLEANING</strong> <br>
                simple procedure to eliminate all the accumulated tartar from the teeth, the line of the gum and the interdental spaces.</p>
                <p><strong>DEEP CLEANING</strong> <br>
                the dentist will use a dental scraping instrument to remove plaque and tartar from the surface aof the tooth root.</p>
                <p><strong>HOME WHITENING</strong> <br>
                It consists of a splint, a syringe with bleaching agent (usually a carbamide or hydrogen peroxide gel). </p>
                <p><strong>OFFICE WHITENING</strong> <br>
                the mouth is protected with a rubber protector on the gums around the dental necks and then the gel that is an antioxidant agent is applied. Therefore the oxidizing agent is applied.</p>",
                "description_es" => "<p><strong>LIMPIEZA REGULAR</strong> <br>
                sencillo procedimiento para eliminar todo el sarro acumulado de los dientes, la línea de la encía y los espacios interdentales.</p>
                <p><strong>LIMPIEZA PROFUNDA</strong> <br>
                el dentista utilizará un instrumento de raspado dental para eliminar la placa y el sarro de la superficie de la raíz del diente.</p>
                <p><strong>BLANQUEAMIENTO EN CASA</strong> <br>
                Consiste en una férula, una jeringa con un agente blanqueador (generalmente un gel de carbamida o peróxido de hidrógeno). </p>
                <p><strong>BLANQUEAMIENTO DE OFICINA</strong> <br>
                se protege la boca con un protector de goma en las encías alrededor de los cuellos dentales y luego se aplica el gel que es un agente antioxidante. Por lo tanto, se aplica el agente oxidante.</p>",//
                "descriptionOneable_id" => 30,
                "descriptionOneable_type" => 'App\Models\Staff\Procedure',
                'code' => time().uniqid(Str::random(30)),
            ],
            //extraciones
            [
                "description_en" => "<p><strong>EXTRACTION</strong> <br>
                removing a teeth is usually because of some disease or trauma or because there are piled teeth.</p>
                <p><strong>WISDOM TOOTH EXTRACTION</strong> <br>
                an incision is made in the tissue of the gums so that the tooth and bone are exposed. The tooth is divided into sections and then is extracted.</p>
                <p><strong>SURGICAL EXTRACTION</strong> <br>
                this involves the removal of teeth that are not easily accessible inside the mouth. This can be because they have not erupted through the rubber completely or they have fractured under the rubber line. It is neccesary to make an incision in the connective tissue that surrounds the tooth to access it for extraction.</p>",
                "description_es" => "<p><strong>EXTRACCIÓN</strong> <br>
                la extracción de una muela suele ser por alguna enfermedad o traumatismo o porque hay dientes amontonados.</p>
                <p><strong>EXTRACCIÓN DE Muelas del Juicio</strong> <br>
                se hace una incisión en el tejido de las encías para que el diente y el hueso queden expuestos. El diente se divide en secciones y luego se extrae.</p>
                <p><strong>EXTRACCIÓN QUIRÚRGICA</strong> <br>
                esto implica la extracción de dientes que no son fácilmente accesibles dentro de la boca. Esto puede deberse a que no han erupcionado completamente la goma o se han fracturado debajo de la línea de goma. Es necesario realizar una incisión en el tejido conectivo que rodea el diente para acceder a él para su extracción.</p>",
                "descriptionOneable_id" => 31,
                "descriptionOneable_type" => 'App\Models\Staff\Procedure',
                'code' => time().uniqid(Str::random(30)),
            ],
            //implantes
            [
                "description_en" => "<p><strong>STANDARD TITANIUM DENTAL IMPLANT (IMPLANT ONLY)</strong> <br>

                the most commonly used type of dental implant, since titanium is naturally bonded to bone. The body does not reject it, it is resistant, it is not magnetic and it is also quite light.</p>

                <p><strong>STANDARD IMPLANT CROWN</strong> <br>

                the attachment is a piece of high precision that needs a compatible design and adapts to the implant. It’s function is to fix, retain and stabilize a prosthesis (crown) to the dental implant. </p>

                <p><strong>BONE GRAFT PER TOOTH</strong> <br>

                surgical procedure consisting on the placement of a bone filling material and a biological membrane which protects this bone graft, in order to regenerate an area affected by bone loss. </p>

                <p><strong>SINUS LIFTING</strong> <br>

                surgical technique that allows the increase of bone in the upper arch, with the aim of obtaining an adequate bone base in which to place osseo integrated implants. </p>

                <p><strong>IMPLANT SUPPORTED OVERDENTURE REMOVABLE (4)</strong> <br>

                the overdenture is a complete but attached or grabbed to two implants in the lower case and four in the upper one. This difference is due to the fact that the maxillary bone is spongy and less strong that the lower one and therefore needs more implants so that the prosthesis can be attached.</p>


                <p><strong>IMPLANT SUPPORTED OVERDENTURE REMOVABLE (6)</strong> <br>

                the overdenture is a complete but attached or grabbed to two implants in the lower case and four in the upper one. This difference is due to the fact that the maxillary bone is spongy and less strong that the lower one and therefore needs more implants so that the prosthesis can be attached.</p>


                <p><strong>ALL ON FOUR SYSTEM WITH ACRYLIC HIBRYD FIXED DENTURE</strong> <br>

                consists of a dental prosthesis of complete arcade that fix screwed or cemented on 6 or 8 implants.</p>

                <p><strong>ALL ON SIX SYSTEM WITH IMPLANTS (UPPER OR LOWER ARCH)</strong> <br>

                consists of a dental prosthesis of complete arcade that fix screwed or cemented on 6 or 8 implants.</p>

                <p><strong>ALL ON EIGHT SYSTEM WITH PORCELAIN HYBRID FIXED DENTURE (UPPER OR LOWER)</strong> <br>

                permanent solution in which the dental pieces are placed on a number of biocompatible titanium implants, which is determinated after TAC assessment by a specialist, in su a way that all the teeth of the mouth are replaced and the aesthetics and functionality of the teeth are imitated a denture of its own.</p>
                ",
                "description_es" => "<p><strong>IMPLANTE DENTAL DE TITANIO ESTÁNDAR (SOLO IMPLANTE)</strong> <br>

                el tipo de implante dental más utilizado, ya que el titanio se adhiere naturalmente al hueso. El cuerpo no lo rechaza, es resistente, no es magnético y además es bastante ligero.</p>

                <p><strong>CORONA SOBRE IMPLANTE ESTÁNDAR</strong> <br>

                el atache es una pieza de alta precisión que necesita un diseño compatible y se adapta al implante. Su función es fijar, retener y estabilizar una prótesis (corona) al implante dental. </p>

                <p><strong>INJERTO ÓSEO POR DIENTE</strong> <br>

                procedimiento quirúrgico que consiste en la colocación de un material de relleno óseo y una membrana biológica que protege este injerto óseo, con el fin de regenerar una zona afectada por la pérdida ósea. </p>

                <p><strong>ELEVACIÓN DE SENOS</strong> <br>

                técnica quirúrgica que permite el aumento de hueso en la arcada superior, con el objetivo de obtener una base ósea adecuada en la que colocar implantes osteointegrados. </p>

                <p><strong>SOBREDENTADURA IMPLANTASOPORTADA REMOVIBLE (4)</strong> <br>

                la sobredentadura es una completa pero unida o agarrada a dos implantes en el caso inferior y cuatro en el superior. Esta diferencia se debe a que el hueso maxilar es esponjoso y menos fuerte que el inferior y por lo tanto necesita más implantes para poder colocar la prótesis.</p>


                <p><strong>SOBREDENTADURA SOBRE IMPLANTE SOPORTADA REMOVIBLE (6)</strong> <br>

                la sobredentadura es una completa pero unida o agarrada a dos implantes en el caso inferior y cuatro en el superior. Esta diferencia se debe a que el hueso maxilar es esponjoso y menos fuerte que el inferior y por lo tanto necesita más implantes para poder colocar la prótesis.</p>


                <p><strong>SISTEMA ALL ON FOUR CON PRÓTESIS FIJA ACRÍLICA HIBRYD</strong> <br>

                consiste en una prótesis dental de arcada completa que se fija atornillada o cementada sobre 6 u 8 implantes.</p>

                <p><strong>SISTEMA ALL ON SIX CON IMPLANTES (ARCADA SUPERIOR O INFERIOR)</strong> <br>

                consiste en una prótesis dental de arcada completa que se fija atornillada o cementada sobre 6 u 8 implantes.</p>

                <p><strong>SISTEMA ALL ON EIGHT CON PRÓTESIS FIJA HÍBRIDA DE PORCELANA (SUPERIOR O INFERIOR)</strong> <br>

                solución permanente en la que las piezas dentales se colocan sobre una serie de implantes de titanio biocompatible, que se determina tras la valoración del TAC por un especialista, de tal forma que se reponen todos los dientes de la boca y se imita la estética y funcionalidad de los dientes una dentadura propia.</p>",
                "descriptionOneable_id" => 32,
                "descriptionOneable_type" => 'App\Models\Staff\Procedure',
                'code' => time().uniqid(Str::random(30)),
            ],
        ]);
    }
}
