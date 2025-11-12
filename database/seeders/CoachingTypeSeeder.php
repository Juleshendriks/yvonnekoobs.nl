<?php

namespace Database\Seeders;

use App\Models\CoachingType;
use Illuminate\Database\Seeder;

class CoachingTypeSeeder extends Seeder
{
    public function run(): void
    {
        $coachingTypes = [
            [
                'title' => 'Burnout Coaching',
                'slug' => 'burnout-coaching',
                'subtitle' => 'Herstel je energie en vind weer balans',
                'summary' => 'Burnout coaching helpt je om uit de uitputting te komen en duurzame veranderingen aan te brengen in je werk-privé balans. We werken samen aan het herkennen van signalen en het ontwikkelen van gezonde copingstrategieën.',
                'challenges' => 'Voel je je constant uitgeput, gestrest of overweldigd door je werk? Heb je moeite met slapen, concentreren of ervaar je fysieke klachten door stress? Burnout kan je leven volledig ontwrichten en het is belangrijk om tijdig hulp te zoeken. Veel mensen herkennen de signalen niet of denken dat ze het zelf moeten oplossen.',
                'approach' => 'Mijn aanpak bij burnout coaching is holistisch en gericht op herstel op meerdere niveaus. We beginnen met het herkennen en accepteren van de huidige situatie. Vervolgens werken we aan praktische stappen voor stressreductie, het herstellen van grenzen en het ontwikkelen van gezonde gewoonten. We kijken naar zowel de werksituatie als persoonlijke patronen die hebben bijgedragen aan de burnout.',
                'target_audience' => 'Deze coaching is bedoeld voor professionals die signalen van burnout ervaren, mensen die net uit een burnout komen en willen voorkomen dat het terugkeert, leidinggevenden die veel stress ervaren, en iedereen die structureel overbelast is en hulp nodig heeft bij het vinden van balans.',
                'benefits' => 'Na burnout coaching ervaar je meer energie en motivatie, heb je betere grenzen in werk en privé, verbeterde stresshantering en meer zelfkennis. Je leert signalen tijdig herkennen en preventief handelen. Veel cliënten rapporteren betere slaap, meer rust in het hoofd en een verbeterde werk-privé balans.',
                'call_to_action' => 'Herken je de signalen van burnout? Wacht niet tot het te laat is. Neem contact op voor een vrijblijvend gesprek en ontdek hoe burnout coaching je kan helpen om weer energie en balans te vinden in je leven.',
                'sort_order' => 1
            ],
            [
                'title' => 'Mindfulness Coaching',
                'slug' => 'mindfulness-coaching',
                'subtitle' => 'Leef bewuster en vind inner rust',
                'summary' => 'Mindfulness coaching leert je om in het moment te leven, stress te reduceren en bewuster keuzes te maken. Door mindfulness technieken ontwikkel je meer zelfbewustzijn en emotionele stabiliteit.',
                'challenges' => 'Leef je vaak in de automatische piloot? Voel je je overweldigd door gedachten en emoties? Heb je moeite om stil te zitten en ervaar je vaak stress of angst? In onze drukke maatschappij zijn we vaak bezig met multitasken en constant connected zijn, waardoor we de verbinding met onszelf kwijtraken.',
                'approach' => 'Mindfulness coaching combineert praktische oefeningen met persoonlijke begeleiding. We verkennen verschillende mindfulness technieken zoals ademhalingsoefeningen, body scans en bewuste meditatie. De coaching is praktisch gericht - je leert technieken die je direct kunt toepassen in je dagelijks leven. We werken aan het ontwikkelen van bewuste gewoonten en het doorbreken van automatische reactiepatronen.',
                'target_audience' => 'Mindfulness coaching is geschikt voor iedereen die meer bewustzijn wil ontwikkelen, professionals die last hebben van stress, mensen die worstelen met angst of piekeren, en iedereen die meer rust en stabiliteit zoekt. Ook geschikt voor beginners die nog nooit gemediteerd hebben.',
                'benefits' => 'Mindfulness coaching brengt meer rust en helderheid in je leven. Je ontwikkelt betere stressbestendigheid, verbeterde concentratie en meer emotionele stabiliteit. Cliënten ervaren vaak betere slaap, minder piekeren en meer tevredenheid. Je leert bewuster te reageren in plaats van automatisch te handelen.',
                'call_to_action' => 'Wil je meer rust en bewustzijn in je leven? Ontdek hoe mindfulness je kan helpen om bewuster te leven en beter om te gaan met stress. Plan een kennismakingsgesprek en begin je reis naar meer inner rust.',
                'sort_order' => 2
            ],
            [
                'title' => 'Loopbaancoaching',
                'slug' => 'loopbaancoaching',
                'subtitle' => 'Ontdek je passie en vorm je ideale carrière',
                'summary' => 'Loopbaancoaching helpt je om duidelijkheid te krijgen over je carrièredoelen, je talenten te ontdekken en strategische stappen te zetten richting je ideale baan. Of je nu aan het begin van je carrière staat of toe bent aan verandering.',
                'challenges' => 'Voel je je vast in je huidige baan? Ben je onzeker over je carrièrepad of weet je niet welke richting je op wilt? Misschien ervaar je een mismatch tussen je waarden en je werk, of zoek je meer uitdaging en zingeving. Loopbaantransities kunnen overweldigend aanvoelen, vooral als je niet weet waar je moet beginnen.',
                'approach' => 'Loopbaancoaching begint met zelfontdekking - we verkennen je talenten, waarden, interesses en motivaties. Via assessments en gesprekken krijgen we inzicht in wat je echt drijft. Vervolgens vertalen we deze inzichten naar concrete carrièremogelijkheden en maken we een actieplan. We werken aan je LinkedIn profiel, sollicitatievaardigheden en netwerkstrategieën.',
                'target_audience' => 'Loopbaancoaching is voor recent afgestudeerden die hun carrière willen starten, professionals die toe zijn aan een verandering, mensen die terugkeren naar de arbeidsmarkt, en iedereen die meer voldoening zoekt in hun werk. Ook geschikt voor ondernemers die hun business willen heroverwegen.',
                'benefits' => 'Loopbaancoaching geeft je helderheid over je carrièredoelen en meer zelfvertrouwen in je professionele keuzes. Je ontwikkelt een sterker professioneel netwerk, betere sollicitatievaardigheden en een duidelijke carrièrestrategie. Veel cliënten vinden werk dat beter aansluit bij hun waarden en talenten.',
                'call_to_action' => 'Klaar voor de volgende stap in je carrière? Of zoek je meer voldoening in je werk? Loopbaancoaching helpt je om je ideale carrièrepad te ontdekken en concrete stappen te zetten. Boek een vrijblijvend gesprek en start je carrièretransformatie.',
                'sort_order' => 3
            ]
        ];

        foreach ($coachingTypes as $coachingType) {
            CoachingType::create($coachingType);
        }
    }
}
