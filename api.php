<?php
// require_once "libs/core/database/mysql.php";
// $db = new MySQLDBHelper();

require_once "controllers/health.controller.php";
$method = "";
$action = "";

if(isset($_GET["method"])){
    $method = isset($_GET["method"])? $_GET["method"] :"";
    $action = isset($_GET["action"])? $_GET["action"] :"";
}

switch ($method) {
    case 'post':
        switch ($action) {
            case 'update':
                break;
            case 'delete':
                break;
            case 'create':
                    $request = "";
                    $data = array();
                    foreach ($_POST['data']  as $key => $value) {
                        $data[$value['name']] = $value['value'];
                    }
                    $healthinfo = new HealthInformationClass();
                    $result = $healthinfo->addNewCase($data);
                    header("Content-type: application/json; charset=utf-8");
                    echo json_encode($result);
                break;
            
        }
    break;
    case 'get':
        switch ($action) {
            case 'update':
                break;
            case 'dummy':
                require_once 'faker/autoload.php';
                $faker = new Faker\Generator();
                $faker->addProvider(new Faker\Provider\es_ES\Person($faker));
                $faker->addProvider(new Faker\Provider\es_ES\Address($faker));
                $faker->addProvider(new Faker\Provider\en_US\Company($faker));
                $barangay = array("PENACIO","DON BERNARDO NERY POB. (TRES DE MAYO)","COLUPAN BAJO","CAPUCAO P.","PANALSALAN","SAN ISIDRO","DUANGUICAN","SINIAN","LUPAGAN","LANGUB","PUNTOD","SILANGA","BALUK","TINAGO","SAN ISIDRO BAJO","MANINGCOL","SETI","POBLACION I","MACALIBRE BAJO","BUENA VOLUNTAD","SINONOC","LUTAO","BANISILON","RIZAL UPPER","CASUSAN","BAGONG NAYON","LUMIPAC","DINAS","MOLATUHAN ALTO","TITURON","VILLABA","TABO O","MALINDANG","MASUBONG","SAN LORENZO RUIZ (SUNGAN)","SALIMPUNO","BUENAVISTA","TABID","COLUPAN ALTO","LANGCANGAN LOWER","MANGA","PETIANAN","ADORABLE","MITACAS","TANGAB","MANGIDKID","GUIBAN","KAUSWAGAN","CABOL ANONAN","DALACON","LAWA AN","KATIPUNAN","MALIBANGCAO","GATA DIOT","GUINGONA","EMBARGO","CANIBUNGAN PROPER","NORTHERN POBLACION","SANTA MARIA (BAGA)","LAO SANTA CRUZ","LIBERTAD ALTO","LAYAWAN","UPPER SALIMPONO","BONIFACIO","LOBOC UPPER","MEDALLO","CORRALES","TAGUANAO","MAGSAYSAY","SINAAD","DOLIPOS BAJO","NAMUT","ESTRELLA","LAPASAN","LITAPAN","BURACAN","POBLACION","AGAPITO YAP, SR. (NAPILAN)","BINTANA","LIBERTAD BAJO","NABUROS","SALVADOR","CENTRO UPPER (POB.)","OSPITAL (POB.)","SALIMPUNO","DAPACAN BAJO","CIRIACO C. PASTRANO (NILABO)","SAN VICENTE BAJO","LABO","TIPAN","GUINTOMOYAN","MATUGNAW","CALARAN","SE??OR","MASABUD","PANGABUAN","MAUSWAGON","MARAMARA","MANLA","ISIDRO D. TAN (DIMALOC OC)","BATO","CANIBUNGAN PUTOL","NEW CARTAGENA","DULLAN","TUYABANG ALTO","POBLACION II","MALIBACSAN","POBLACION","SANTA ANA","MITAZAN","CAMANUCAN","MENTERING","LANDING","LAM AN","TAGUIMA","SAPANG AMA","SAN ROQUE","TUBURAN","CASILAK SAN AGUSTIN","CATADMAN MANABAY","MARUGANG","PISA AN","MATUGAS ALTO","SEBASI","IBABAO","MIALEN","AGUNOD","CALAMBUTAN SETTLEMENT","CAPUCAO C.","PUNTOD","BAGONG SILANG","LAMPASAN","BAGAKAY","KINANGAY SUR","BAYBAY SANTA CRUZ","BAYBAY","MOHON","BARANGAY III  MARKET KALUBIAN (POB.)","LOOC PROPER","GOTOKAN DIOT","CALAMBUTAN BAJO","MAQUILAO","SAN AGUSTIN","TARAKA (POB.)","CAPUTOL","SINUZA","NACIONAL (POB.)","SAN ISIDRO ALTO","BUNGA","NEW LOOK","DASA","DULLAN SUR","DULAPO","GUINABOT","CAMANSE","SAN ISIDRO (SAN ISIDRO SAN PEDRO)","CARMEN","BUTUAY","CAPUNDAG","BERNAD","NORTHERN POBLACION","GATA DAKU","LAMAC LOWER","SEBAC","BOUNDARY","LUSOT","BARANGAY II MARILOU ANNEX (POB.)","DIMALCO","CALUBE","NAILON","MAULAR","RIZAL","LABINAY","KINUMAN NORTE","SUMIRAP","SIBUYON","SAN PEDRO","CABUNGA AN","DO??A CONSUELO","AGUADA (POB.)","BALON","MABINI","MIALEM","SILOY","NORTHERN POBLACION","APIL","TINACLA AN","DIGSON","SICOT","TUSIK","MANSABAY ALTO","CALABAYAN","PULOT","PUNTA SULONG","SULIPAT","HUYOHOY","BAYBAY TRIUNFO","MAGCAMIGUING","MANAMONG","MISOM","PALAYAN","TUGAS","LABUYO","GALA","SOUTHERN POBLACION","GUMBIL","DAMPALAN","DIVISORIA","DAPACAN ALTO","TABOC SUR","SEGATIC DIOT","GANDAWAN","EL PARAISO","LALUD","DANAO","EASTERN POBLACION","SOUTHERN POBLACION","KATIPUNAN","PUNTA MIRAY","MATUGAS BAJO","POBLACION (CENTRO)","SOUTHERN LOOC","MONTERICO","CAPALARAN","MOLATUHAN BAJO","SAN VICENTE","LOWER USUGAN","RIZAL (POB.)","DALAPANG","DEMETRIO FERNAN","SINARA BAJO","SINARA ALTO","BONGABONG","LUMBAYAO","TALAIRON","UPPER DIOYO","LIPOSONG","LUMBAN","SAN JUAN","PAITON","SOLINOG","NABUNA","TRIGOS","LABO","LAYA AN","GUINABOT","DEL PILAR","CARMEN (MISAMIS ANNEX)","CASUL","BOLINSONG","DALINGAP","CENTRO NAPU (POB.)","MOBOD","CONAT","TIGDOK","GUBA (OZAMIS)","VENTURA","GUIMAD","POBLACION I","NEW CASUL","TUYABANG PROPER","BARANGAY VII UPPER POLAO (POB.)","POBLACION IV","CANIANGAN","LAO PROPER","MAKAWA","BANGKO","BAG ONG ANONANG","BONGBONG","CAVINTE","PELONG","MIGPANGE","QUIRINO","MALIGUBAAN","LIBERTAD","MALAUBANG","CENTRO HULPA (POB.)","LOBOC LOWER","CALACA AN","BOLIBOL","DOLORES","CANIPACAN","SALIMPUNO","SIBULA","TABOC NORTE","LIBORON","LANGCANGAN UPPER","CEBULIN","LIBERTAD","GARANG","SAN ANTONIO","KINUMAN SUR","MAGSAYSAY","SIBAROC","DIOYO","MACALIBRE ALTO","SANTA CRUZ","SILONGON","SAN VICENTE ALTO","BUENAVISTA","GUINALABAN","BOCATOR","CALUYA","ROXAS","LORENZO TAN","LANGCANGAN PROPER","BINUANGAN","SINUZA","SAN VICENTE","JASA AN","POBLACION","BANGLAY","STIMSON ABORDO (MONTOL)","PANALSALAN","TORIL","MONTOL","RUFINO LUMAPAS","BANADERO (POB.)","BAGA","OWAYAN","PAYPAYAN","UPPER BAUTISTA","PANTAON","MAPUROG (MIGSALE)","LUZARAN","MANTUKOY","CAPULE","SMALL POTONGAN","ILISAN","LINGATONGAN","LOBOGON","TUYABANG BAJO","TIPAN","BARANGAY VI LOWER POLAO (POB.)","COGON","MINSUBONG","TIAMAN","TAGUITE","MIALEN","SILANGIT","DULLAN NORTE","MAP-AN","CLARIN","BASIRANG","MANAKA","UPPER POTONGAN","CANIBUNGAN DAKU","MANGUEHAN","PALILAN","GANGO","BAGUMBANG","SEGATIC DAKU","DALISAY","WESTERN POBLACION","KAUSWAGAN","MACABIBO","DIMALUNA","MANTIC","MOLICAY","YAHONG","MACUBON (SINA AD)","BURGOS","SOSO ON","MABAS","GOTOKAN DAKU","REMEDIOS","SANGAY DIOT","DICOLOC","SINGALAT","SOUTHWESTERN POBLACION","UPPER DAPITAN","RIZAL LOWER","GALA","BUNTAWAN","DISOY","CARTAGENA PROPER","TAWI TAWI","SIMASAY","VILLALIN","SUMASAP","CAGAY ANON","MACABAYAO","ESTANTE","KATIPA","BARRA","MANSABAY BAJO","BURGOS","DALUMPINAS","LOCSO ON","BARANGAY IV ST. MICHAEL (POB.)","CATAGAN","MAMANGA DAKU","MAHAYAHAY","DELA PAZ","BONIFACIO","BALINTONGA","GATA","POGAN","CALOLOT","PAN AY DIOT","TIPOLO","EASTERN LOOC","SINAMPONGAN","NUEVA VISTA (MASAWAN)","SENOTE","DEBOLOC","MAMALAD","MATIPAZ","CARANGAN","SIBUGON","LOCUS","BARANGAY I CITY HALL (POB.)","SANTO NI??O","SAN APOLINARIO","BACOLOD","BONGABONG","LAMAC UPPER","LINCONAN","CATARMAN","TUBOD`(JUAN BACAYO)","CANUBAY","CAMATING","NAPUROG","POBLACION","MALORO","SAN ANDRES","KANAOKANAO","SAN ANTONIO","CLARIN SETTLEMENT","BAGONG CLARIN","MIGCANAWAY","TUGAS","POBLACION III","PAN AY","VILLAFLOR","AQUINO (MARCOS)","BALATACAN","DIGUAN","MAHON","PENIEL","BARANGAY V MALUBOG (POB.)","SANTA CRUZ","CAHAYAG","SIXTO VELEZ, SR.","UNIDOS","USOCAN","CULPAN","KINANGAY NORTE","BIASONG","SAN NICOLAS","PRENZA","BAYBAY SAN ROQUE","TUNO","MAMANGA GAMAY","TUGAYA","VIRAYAN","SEBUCAL","LILOAN","MARIBOJOC","TOLIYOK","POBLACION II","PUNTA","SIPAC","ALEGRIA","BAUTISTA","TALIC","NAPANGAN","BITO ON","PINES","UPPER USOGAN","DELA PAZ","NAGA (POB.)","SANTA CRUZ (POB.)","BUENAVISTA","50TH DISTRICT (POB.)","KIMAT","VICTORIA","LAKE DUMINAGAT","DOLIPOS ALTO","BUNAWAN","MAIKAY","ZAMORA","LODIONG","BURGOS","BALINTAWAK","MITUGAS","DON ANDRES SORIANO","SANGAY DAKU","BITIBUT","DULLAN");
                $citymun = array("PANAON","BONIFACIO","SAPANG DALAGA","OROQUIETA CITY","JIMENEZ","OZAMIS CITY","BALIANGAO","TUDELA","LOPEZ JAENA","DON VICTORIANO","PLARIDEL","ALORAN","SINACABAN","CLARIN","CALAMBA","CONCEPCION","TANGUB CITY");
                $diseases = array("Alzheimer's disease","Parkinson's disease","Multiple sclerosis","Malaria","Tuberculosis","HIV/AIDS","Cancer","Diabetes","Hypertension","Asthma","Arthritis","Epilepsy","Schizophrenia","Depression","Anxiety disorders","Anemia","Hemophilia","Sickle cell anemia","Cystic fibrosis","Influenza","Pneumonia","Cholera","Typhoid fever","Yellow fever","Dengue fever","Chikungunya","Zika virus","Ebola virus disease","Measles","Rubella","Chickenpox","Shingles","Hepatitis B","Hepatitis C","Cirrhosis","Heart disease","Stroke","Kidney disease","Meningitis","Encephalitis","Rabies","Lyme disease","Chlamydia","Gonorrhea","Syphilis","Trichomoniasis","Human papillomavirus (HPV)","Herpes simplex virus","Varicella-zoster virus","West Nile virus","Leukemia","Lymphoma","Melanoma","Bladder cancer","Breast cancer","Colorectal cancer","Lung cancer","Prostate cancer","Ovarian cancer","Pancreatic cancer","Rheumatoid arthritis","Lupus","Psoriasis","Eczema","Acne","Vitiligo","Alopecia","Osteoporosis","Gout","Crohn's disease","Ulcerative colitis","Irritable bowel syndrome (IBS)","Diverticulitis","Celiac disease","Food allergies","Hay fever","Hives","Asthma","Chronic obstructive pulmonary disease (COPD)","Sleep apnea","Chronic fatigue syndrome","Fibromyalgia","Chronic pain","Carpal tunnel syndrome","Tennis elbow","Plantar fasciitis","Osteoarthritis","Sciatica","Scoliosis","Glaucoma","Cataracts","Macular degeneration","Retinopathy","Diabetes-related complications","Hypothyroidism","Hyperthyroidism","Addison's disease","Cushing's syndrome","Polycystic ovary syndrome (PCOS)","Endometriosis");
                $bloodtype = array("op","om","ap","am","bp","bm","abp","abm");
                $healthinfo = new HealthInformationClass();
                for ($i = 0; $i < 100; $i++) {
                    $i1 = $faker->numberBetween(0, count($barangay)-1);
                    $i2 = $faker->numberBetween(0, count($citymun)-1);
                    $i3 = $faker->numberBetween(0, count($diseases)-1);
                    $i4 = $faker->numberBetween(0, count($bloodtype)-1);
                    $sex = $faker->randomElement(['m', 'f']);
                    $firstName = $faker->firstName;
                    $lastName = $faker->lastName;
                    $lastName = $faker->lastName;                        
                    $date=date_create($faker->numberBetween(1950,2023)."-".$faker->numberBetween(1,12)."-".$faker->numberBetween(1,31));
                    $data["fname"] = $firstName;
                    $data["mname"] = $lastName;
                    $data["lname"] = $lastName;
                    $data["suffix"] = "";
                    $data["sex"] = ( str_ends_with($firstName, "a") ? "f" : "m" );
                    $data["civilstatus"] = $faker->numberBetween(0,2);
                    $data["birthdate"] =  date_format($date,"Y-m-d");
                    $data["height"] = $faker->numberBetween(140,200);
                    $data["weight"] = $faker->numberBetween(40,80);
                    $data["bloodtype"] = $bloodtype[$i4];
                    $data["barangay"] =  $barangay[$i1];
                    $data["citymun"] =  $citymun[$i2];
                    $data["province"] = "Misamis Occidental";
                    $data["email"] = strtolower( $faker->firstName)."@dummymail.com";
                    $data["contactno"] = "0912". $faker->numberBetween(1000007,1999999);
                    $data["contactno2"] = "0917". $faker->numberBetween(1000007,1999999);
                    $data["isvaccinated"] = $faker->numberBetween(0,2);
                    $data["vaccinedetails"] = "-";
                    $data["disease"] = $diseases[$i3];
                    $data["symptoms"] = "";
                    $data["medicationdetails"] =  "";
                    $data["recommendation"] =  "";
                    $healthinfo->addNewCase($data);
                }
                echo json_encode(array("result"=>"success","message"=>"Dummy data Initialized"));
                break;
            case 'all':
                    $healthinfo = new HealthInformationClass();
                    $result = $healthinfo->getAllEntities();
                    header("Content-type: application/json; charset=utf-8");
                    echo json_encode(array( "data"=>$result));
                break;
                
            case 'top3diseases':
                    $healthinfo = new HealthInformationClass();
                    $result = $healthinfo->getTopDiseases(2);
                    header("Content-type: application/json; charset=utf-8");
                    echo json_encode(array( "data"=>$result));
                break;
                
            }
        break;
    default:
            $healthinfo = new HealthInformationClass();
            $result = $healthinfo->getAllEntities();
            header("Content-type: application/json; charset=utf-8");
            echo json_encode(array( "data"=>$result));
        break;
}