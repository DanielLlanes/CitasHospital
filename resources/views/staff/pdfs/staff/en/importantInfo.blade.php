@extends('staff.pdfs.header')
@section('content')
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
</style>
<div class="" style="margin: 50px!important">
    <h1 style="text-align: center">IMPORTANT INFORMATION</h1>
    <p>Dear <b>{{ $data['patient']->name }}</b>,</p>
    <p>Please read the following letter, it contains very important information you need to
        know in order to get a high percentage to achieve a complication-free procedure and
        obtain the best possible results.</p>

    <h2 style="text-align: center">PRE-SURGICAL INDICATIONS</h2>

    <ul style="list-style: none">
        <li><b>SMOKING/VAPING</b>: Patients must stop smoking/vaping 5 weeks prior to surgery,
            including marihuana and nicotine on any presentation (patches, gum, etc).</li>
        <li><b>ALL RECREATIONAL DRUGS</b>: Must be suspended 5 weeks prior surgery including
            edibles.</li>
        <li><b>HORMONES/CONTRACEPTIVES</b>S: uspend 30 days prior to surgery.</li>
        <li>If you are taking <b>THYROID & BLOOD PRESSURE</b> medication, please continue to do
            so until the morning of pre-ops with a little bit of water.</li>
        <li>If you take <b>ANTI-DEPRESSANTS</b>, please do not suspend and take them morning of
            pre-ops with little bit of water.</li>
        <li>If you are a patient that needs to use a <b>CPAP</b>, please bring it with you.</li>
        <li>If you take <b>BLOOD THINNERS</b>, please suspend them 10 days prior to surgery.</li>
        <li>Patients must suspend <b>STEROIDS & IMMUNOSUPPRESSANTS</b> 1 month prior to
            surgery</li>
        <li>If you have an <b>IUD</b> please remove it 2 months before surgery.</li>
        <li>Patients must suspend <b>ASPIRIN</b> and all <b>NSAID’s</b> 7 days prior to surgery:</li>
        <li>
            <ul>
                <li>Aspirin ( Bayer)</li>
                <li>Ibuprofen (Advil, Motrin)</li>
                <li>Naproxen (Aleve, AnaproxDS, Naprosyn Diclocenac)</li>
                <li>celecoxib (Celebrex)</li>
                <li>mefenamic acid.</li>
                <li>etoricoxib.</li>
                <li>indomethacin.</li>
                <li>Meloxicam</li>
            </ul>
        </li>
        <li>Please do not suspend <b>METFORMIN</b></li>
        <li><b>NO NAIL POLISH OR ACRYLIC NAILS</b> (Hands and Toes)</li>
        <li><b>NO PIERCINGS</b>: Please remove them all, no exceptions.</li>
        <li><b>NO FALSE EYELASHES.</b></li>
        <li>We recommend <b>NOT</b> to bring any type of jewelry</li>
        <li><b>TIPS</b> to our drivers and medical staff are allowed but <b>NOT MANDATORY</b>.</li>
    </ul>
    <div class="page-break"></div>
    <p>We strive to o er the best care possible and our patient’s health and well- being is our
        top priority.</p>
    <p>It is very important for you to follow these indications, failure to do so will put your
        health at risk and surgery may be cancelled. If surgery is canceled due to not following
        the above indications, please note that the cancellation cost is the total cost of the
        surgery.</p>
    <p>Please write your name and sign at the botton stating you have read all of the above
        and email me back. Failure to do so will count as your agreement to this important
        information letter.</p>

        <h2 style="text-align: center">PACKING LIST</h2>

        <p>REMEMBER TO PACK LIGHT, A SMALL BACKPACK, DUFFLE BAG OR SMALL
            CARRY-ON LUGGAGE WILL DO. YOU DON’T WANT TO LIFT ANYTHING HEAVY
            GOING BACK HOME.</p>
        
            <ul style="list-style: none">
                <li><b>DOCUMENTATION</b>: 
                    <ul>
                        <li>Proof of citizenship: original birth certi cate or Valid ID (drivers license).</li>
                    </ul>
                </li>
                <li><b>CLOTHES</b>: 
                    <ul>
                        <li>Loose tting and comfortable: bra, underwear, pajamas, warm socks, house slippers
                            (Make your departure clothes easy to put on, easy slip on shoes.</li>
                    </ul>
                </li>
                <li><b>PERSONAL ITEMS</b>:
                    <ul>
                        <li>Cell phone.</li>
                        <li>Cell phone charger.</li>
                        <li>Book, Ipad, kindle (whatever you need to keep entertained while you wait for surgery).</li>
                        <li>Reading Glasses, no contact lenses for surgery./li>
                        <li>Small travel pillow you can hug on your ight back home.</li>
                    </ul>
                </li>
                <li><b>We do have WIFI at the surgical center and recovery house.</b></li>
                <li>
                    <b>PHARMACEUTICALS</b>:
                    <ul>
                        <li>
                            <b>Travel Size</b>:
                            <ul>
                                <li>Toothpaste/toothbrush</li>
                                <li>Conditioner,</li>
                                <li>Body wash</li>
                                <li>Lotion</li>
                                <li>Deodorant</li>
                                <li>Hair brush</li>
                                <li>Lip balm</li>
                                <li>Prescription medication in its original labeled jar,</li>
                                <li>Pill  crusher</li>
                                <li>Extra gauze bandaids (just in case you need to change them on your ight back home).</li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
            <br>
            <p>If you are ying or driving back home, bring something you can mix with water or warm
                water like propel powder. Crystal light, powder gatorade (G2 has less sugar), powder
                chicken broth.</p>
                <br>
            <h5 style="text-align: center">It’s very important you keep yourself hydrated</h5>

            <p><b>PLEASE READ OUR 83 FREQUENTLY ASKED QUESTIONS BY PRESSING THE LINK BELOW</b></p>

            <a href="https://jlpradosc.com/faqs/" target="_blank">https://jlpradosc.com/faqs/</a>
            <br>

            <p>If you have any questions or are in need of assistance, please feel free to contact me.</p>
            <p>Sincerely,</p>
            <p >{{ $data['coordinator']->name }}</p>
            <p>{{ strtoupper($data['brand']->acronym) }} COORDINATOR</p>
            <p>phone: {{ $data['coordinator']->phone }}</p>
            <p>Email: {{ $data['coordinator']->email }}</p>
            

            <br>
            <br>
            <br>
            <br>

            <p style="text-align: center">___________________________________</p>
            <p style="text-align: center">Name and signature</p>
            <p style="text-align: center">Please email back)</p>
</div>
@endsection