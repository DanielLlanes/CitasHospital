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
    <h1>IMPORTANT INFORMATION</h1>

    <p>Dear <b>{{ $data['patient']->name }}</b>,</p>
    
    <p>ABM welcomes you, please read the following letter, it contains very important information you need to know in order to get a high percentage to achieve a complication-free procedure and obtain the best possible results.</p>
    
    <p>We are so happy that you decide to have your procedure with us. The following pre-op indications will guide you through the last part of your surgery with us. I will be answering all your questions and provide everything you need to know to make an informed decision regarding any of our plastic surgery procedures.</p>
    
    <p>Our surgeon is requesting the following blood work a month prior to surgery:</p>
    
    <ul>
      <li>CBC</li>
      <li>COAGULATION TIMES</li>
      <li>CHEM PANEL (IT HAS TO INCLUDE BUN, CREAT, GLUCOSE)</li>
      <li>BLOOD TYPE</li>
      <li>HEPATIC FUNCTION</li>
      <li>LDH</li>
    </ul>

    <h3>PRE-OP INSTRUCTIONS</h3>

    <p>DO NOT TAKE THE FOLLOWING PRODUCTS 10 DAYS BEFORE SURGERY</p>

    <ol>
        <li>Any medication that contains Aspirin because of bleeding risk.</li>
        <li>Motrin, Advil. Ask us if you need to take something for pain.</li>
        <li>Oral contraceptives and IUD please stop them 2 months prior surgery.</li>
        <li>Natural products, vitamins, Panax, Ginseng/Ginko Biloba, Slimming products or Green Tea.</li>
        <li>NO alcohol 4 days before surgery.</li>
        <li>Quit smoking/vaping 4 weeks before surgery.</li>
        <li>NO acrylic nails or nail polish and remove Piercings (Need to be removed before surgery)</li>
        <li>Avoid contact with sick people.</li>
        <li>8 hours fasting prior to your surgery time (no Food or Water)</li>
        <li>Shower the night before surgery and shave yourself (Only if your procedure involves armpits or pubic Area).</li>
        <li>If you suffer from a health condition requiring to take medications (e.g., Thyroid, high blood pressure and diabetes) DO NOT SUSPEND until you have consulted your doctor.</li>
        <li>No makeup the day of surgery.</li>
        <li>If you usually use any stool softeners keep taking it and bring them with you as well.</li>
        <li>Only one Companion Allowed / No Children Permitted.</li>
    </ol>

    <h3>POST OP INSTRUCTIONS</h3>

    <p>DRAINS</p>
    <p>Can be there from 14-21 days. If you’re staying less than a week, the possibility of returning home with them is very high. If this is the case, you will receive instructions on how to remove them. They are always stitched to the skin, so be careful.</p>

    <p>COMPRESSION GARMENTS</p>
    <p>Girdles, compression garments, post-op bras MUST be worn at least 6 weeks. If you have a breast band, it must be used for 2-3 weeks.</p>

    <p>STITCHES</p>
    <p>We use dissolvable and non-dissolvable stitches as a large number of our patients live too far away to come back and have our doctors remove them. You will trim your stitches above skin level. It’s very important that you don’t pull, dig or otherwise put tension on the stitches. They will be there 2-3 weeks depending on your specific surgery. Once removed, you will need to spray this area with the antiseptic spray to prevent further delay in the healing process.</p>

    <p>POST OP PICTURES</p>
    <p>Must be emailed to the doctors every week for one month.</p>

    <p>WOUND OPENING</p>
    <p>If for any reason you have an area of the incision that opens, please use the antiseptic spray without delay. Please send a PM or an email to the doctors so we are aware. WLS patients have a low protein count; this is one of the main factors that can cause this to happen.</p>

    <p>BATHING</p>
    <p>While treating fresh scabs, you CAN NOT take baths, swim in lakes, beaches, pools, hot tubs, etc.</p>

    <p>SUN EXPOSURE</p>
    <p>Please don’t expose your scars or skin to the sun while bruises are fresh and visible.</p>

    <p>ALCOHOL</p>
    <p>You can drink one or two (no more) cup of wine or alcohol.</p>

    <p>DIET</p>
    <p>Take supplementary protein shakes or increase your protein intake.</p>

    <p>STOOL SOFTENER</p>
    <p>You’re able to take any kind of stool softeners the next day of the surgery.</p>

    <p>SCAR MANAGEMENT</p>
    <p>You can start scar management with gels, silicone patches or others at the second week from your surgery. Just avoid them at moist areas of the wounds.</p>

    <p>SWELLING</p>
    <p>Swelling of the feet can occur during the first week. Try to walk often. But don’t overdo it. It can last up to 3 weeks. It will increase if you fly home, but it will go away.</p>

    <p>BELLY BUTTON</p>
    <p>You have to spray it starting the next day of your surgery.</p>

    <p>SMOKING/VAPING</p>
    <p>NO smoking/vaping for 4 weeks before and after surgery. You risk incisions re-opening and delayed healing.</p>

    <p>EXERCISE</p>
    <p>You can start exercise between 4-6 weeks following your surgery. Please resume slowly with brisk walking. Avoid weightlifting.</p>

    <p>SEXUAL ACTIVITY</p>
    <p>You can resume sexual activity three weeks following surgery. But be careful.</p>

    <p>BUYING BRAS</p>
    <p>Don’t buy bras until all swelling has ceased. Usually between 3-4 weeks.</p>

    <p>ADDITIONAL SURGERY</p>
    <p>Additional procedures can be done between 3-6 months following your initial surgery.</p>

    <p>SHOPPING/SIGHT SEEING</p>
    <p>As you know, plastic surgery is not even close to WLS. You most likely will not have time or want to do a lot of physically draining activity. If you think you’re up for it, please discuss with the doctors or your Case Manager.</p>

    <p>NIGHT LIFE</p>
    <p>-----Please avoid this----- for at least a month-----</p>

    <p>During your stay in Tijuana, we will not be responsible if you go out from the hotel to bars or nightclubs. Please avoid this during your stay.</p>

    <p>During the first month, you should expect to see a fair result that will improve over time. The final result of your surgery will be apparent between 3-4 months.</p>

    <p>HAVE I PACK THESE ITEMS,</p>
    <ul>
    <li>Passport / Birth certificate</li>
    <li>Travel Itinerary</li>
    <li>Airline Tickets</li>
    <li>Driver’s License or valid picture ID</li>
    <li>Prescription medications</li>
    <li>Your glasses or contact lenses</li>
    <li>Front closure nightclothes</li>
    <li>Sleeping mask/ear plugs (essential to a restful sleep)</li>
    <li>Dark coloured loose clothing that is easy to take on and off (front zip and button down shirt options are great)</li>
    <li>Underwear</li>
    <li>Chapstick</li>
    <li>Boppy pillow or seating donut. Neck pillow (for BBL)</li>
    <li>Canned protein shakes (weight loss patients)</li>
    <li>Cell phone charger, long extension cord</li>
    <li>Arnica Gel or cream</li>
    <li>Hand Sanitizer</li>
    <li>Stool Softener</li>
    <li>Lanyard to hold drains</li>
    <li>Slippers or socks with grip</li>
    <li>Slip on, flat shoes</li>
    <li>Travel size toiletries</li>
    </ul>

    <p>“We encourage you to NOT bring any jewelry of any kind.”</p>

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