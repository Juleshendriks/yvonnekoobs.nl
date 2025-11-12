<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            // Algemeen categorie
            [
                'question' => 'Wat is coaching precies?',
                'answer' => 'Coaching is een vorm van persoonlijke begeleiding waarbij een coach je helpt om je doelen te bereiken, obstakels te overwinnen en je potentieel te ontdekken. In tegenstelling tot therapie, richt coaching zich op de toekomst en wat je wilt bereiken, in plaats van op problemen uit het verleden.',
                'category' => 'algemeen',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'question' => 'Voor wie is coaching geschikt?',
                'answer' => 'Coaching is geschikt voor iedereen die meer uit het leven wil halen. Of je nu worstelt met carrièrekeuzes, stress ervaart, persoonlijke doelen wilt bereiken, of gewoon meer voldoening zoekt in je leven - coaching kan je helpen.',
                'category' => 'algemeen',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'question' => 'Wat is het verschil tussen coaching en therapie?',
                'answer' => 'Therapie richt zich vaak op het verwerken van trauma en problemen uit het verleden, terwijl coaching zich focust op de toekomst en het bereiken van doelen. Een coach helpt je vooruit te komen, terwijl een therapeut je helpt genezen van wonden.',
                'category' => 'algemeen',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'question' => 'Hoe weet ik of coaching iets voor mij is?',
                'answer' => 'Als je het gevoel hebt vast te zitten, niet weet welke richting je op wilt, stress ervaart, of gewoon meer uit jezelf wilt halen, dan kan coaching je helpen. Het beste is om een vrijblijvend kennismakingsgesprek te plannen om te kijken of het bij je past.',
                'category' => 'algemeen',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'question' => 'Is alle informatie vertrouwelijk?',
                'answer' => 'Absoluut. Alles wat we bespreken tijdens onze sessies blijft strikt vertrouwelijk. Ik werk volgens professionele coaching standaarden en zal nooit informatie delen zonder jouw uitdrukkelijke toestemming.',
                'category' => 'algemeen',
                'is_active' => true,
                'sort_order' => 5,
            ],

            // Coaching categorie
            [
                'question' => 'Hoe lang duurt een coaching traject?',
                'answer' => 'De duur varieert per persoon en situatie. Gemiddeld werken we 3-6 maanden samen, met sessies om de 2 weken. Voor grote levensveranderingen kan het langer duren, terwijl specifieke doelen soms sneller bereikt worden.',
                'category' => 'coaching',
                'is_active' => true,
                'sort_order' => 6,
            ],
            [
                'question' => 'Hoe vaak hebben we contact?',
                'answer' => 'Meestal plannen we om de 1-2 weken een sessie van 60-90 minuten. Tussen de sessies door kun je me altijd een email sturen met vragen of inzichten. De frequentie stemmen we af op jouw behoefte en voortgang.',
                'category' => 'coaching',
                'is_active' => true,
                'sort_order' => 7,
            ],
            [
                'question' => 'Wat gebeurt er in de eerste sessie?',
                'answer' => 'In de eerste sessie leren we elkaar beter kennen, bespreken we jouw situatie, wensen en doelen. We kijken naar wat je wilt bereiken en maken samen een plan van aanpak. Deze intake sessie duurt meestal iets langer dan gewone sessies.',
                'category' => 'coaching',
                'is_active' => true,
                'sort_order' => 8,
            ],
            [
                'question' => 'Kan coaching ook online?',
                'answer' => 'Ja, online coaching via videobellen werkt uitstekend en is vaak praktischer. Je kunt vanuit je eigen vertrouwde omgeving deelnemen. Voor sommige mensen werkt face-to-face beter, dus we kijken samen wat voor jou het beste is.',
                'category' => 'coaching',
                'is_active' => true,
                'sort_order' => 9,
            ],
            [
                'question' => 'Wat als ik tussentijds wil stoppen?',
                'answer' => 'Je kunt altijd stoppen. We evalueren regelmatig je voortgang en of coaching nog de juiste fit is. Als je wilt stoppen, bespreken we dit altijd eerst om te kijken wat er speelt en of er aanpassingen mogelijk zijn.',
                'category' => 'coaching',
                'is_active' => true,
                'sort_order' => 10,
            ],
            [
                'question' => 'Krijg ik huiswerk of oefeningen?',
                'answer' => 'Ja, tussen sessies geef ik vaak praktische oefeningen, reflectievragen of kleine acties om uit te voeren. Dit helpt je om de inzichten uit onze gesprekken toe te passen in je dagelijks leven en sneller vooruitgang te boeken.',
                'category' => 'coaching',
                'is_active' => true,
                'sort_order' => 11,
            ],

            // Praktisch categorie
            [
                'question' => 'Waar vinden de sessies plaats?',
                'answer' => 'Sessies kunnen zowel online via videobellen als fysiek in mijn praktijkruimte. Online coaching is vaak praktischer en werkt uitstekend. Voor fysieke sessies spreken we een locatie af die voor beiden goed uitkomt.',
                'category' => 'praktisch',
                'is_active' => true,
                'sort_order' => 12,
            ],
            [
                'question' => 'Hoe plan ik een afspraak?',
                'answer' => 'Je kunt contact opnemen via het contactformulier, email of telefoon. We plannen dan eerst een vrijblijvend kennismakingsgesprek van 30 minuten om te kijken of we goed bij elkaar passen.',
                'category' => 'praktisch',
                'is_active' => true,
                'sort_order' => 13,
            ],
            [
                'question' => 'Wat als ik een afspraak moet verzetten?',
                'answer' => 'Dat kan gebeuren, geen probleem. Geef wel minimaal 24 uur van tevoren bescheid, dan kunnen we een nieuwe tijd inplannen. Bij last-minute afzeggingen kan ik de sessie helaas wel in rekening brengen.',
                'category' => 'praktisch',
                'is_active' => true,
                'sort_order' => 14,
            ],
            [
                'question' => 'Op welke tijden ben je beschikbaar?',
                'answer' => 'Ik ben flexibel met tijden en probeer altijd een moment te vinden dat jou uitkomt. Sessies kunnen doordeweeks overdag, \'s avonds of in het weekend plaatsvinden. We stemmen de planning altijd samen af.',
                'category' => 'praktisch',
                'is_active' => true,
                'sort_order' => 15,
            ],

            // Tarieven categorie
            [
                'question' => 'Wat kosten de coaching sessies?',
                'answer' => 'Mijn tarieven variëren afhankelijk van het type coaching en de duur van het traject. Een individuele sessie kost €85, maar ik werk meestal met pakketten die voordeliger zijn. Vraag naar de mogelijkheden tijdens ons kennismakingsgesprek.',
                'category' => 'tarieven',
                'is_active' => true,
                'sort_order' => 16,
            ],
            [
                'question' => 'Worden coaching kosten vergoed door de zorgverzekering?',
                'answer' => 'Coaching valt meestal niet onder de zorgverzekering, omdat het geen medische behandeling is. Sommige werkgevers vergoeden coaching wel als onderdeel van persoonlijke ontwikkeling. Check dit bij je werkgever of zorgverzekeraar.',
                'category' => 'tarieven',
                'is_active' => true,
                'sort_order' => 17,
            ],
            [
                'question' => 'Is het kennismakingsgesprek gratis?',
                'answer' => 'Ja, het eerste kennismakingsgesprek van 30 minuten is altijd gratis en vrijblijvend. Zo kunnen we elkaar leren kennen en kijken of er een goede klik is voordat je een beslissing neemt.',
                'category' => 'tarieven',
                'is_active' => true,
                'sort_order' => 18,
            ],
            [
                'question' => 'Kan ik in termijnen betalen?',
                'answer' => 'Voor langere coaching trajecten is betaling in termijnen mogelijk. We bespreken dit tijdens ons kennismakingsgesprek en maken afspraken die voor jou haalbaar zijn. Het belangrijkste is dat geld geen belemmering wordt voor jouw ontwikkeling.',
                'category' => 'tarieven',
                'is_active' => true,
                'sort_order' => 19,
            ],
            [
                'question' => 'Zijn er kortingen beschikbaar?',
                'answer' => 'Ik bied pakketprijzen aan die voordeliger zijn dan losse sessies. Voor studenten en mensen in een financieel moeilijke situatie bekijk ik altijd wat mogelijk is. Bespreek je situatie open met me, dan zoeken we samen naar een oplossing.',
                'category' => 'tarieven',
                'is_active' => true,
                'sort_order' => 20,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
