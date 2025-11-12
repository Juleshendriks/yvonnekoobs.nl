<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Verwijder eventueel bestaand profiel
        Profile::truncate();

        Profile::create([
            'photo' => null,
            'naam' => 'Jan van der Berg',
            'introduction_title' => 'Welkom bij mijn portfolio',
            'introduction_description' => 'Ik ben een gepassioneerde full-stack developer met meer dan 5 jaar ervaring in het bouwen van moderne webapplicaties. Mijn focus ligt op het creëren van gebruiksvriendelijke en schaalbare oplossingen.',

            'why_title' => 'Mijn Missie',
            'why_description' => 'Ik geloof dat technologie de wereld kan verbeteren. Daarom streef ik ernaar om software te ontwikkelen die niet alleen functioneel is, maar ook een positieve impact heeft op het leven van gebruikers. Elke regel code die ik schrijf, heeft als doel problemen op te lossen en processen te verbeteren.',

            'what_title' => 'Mijn Diensten',
            'what_description' => 'Ik bied een breed scala aan diensten, waaronder webapplicatie ontwikkeling, API design, database optimalisatie en consultancy. Of het nu gaat om een eenvoudige website of een complexe enterprise-applicatie, ik help je van concept tot lancering.',

            'how_title' => 'Mijn Aanpak',
            'how_description' => 'Ik werk volgens de Agile methodologie en geloof in transparante communicatie. Door regelmatige feedback momenten en iteratieve ontwikkeling zorg ik ervoor dat het eindresultaat exact aansluit bij jouw verwachtingen. Kwaliteit en onderhoudbaarheid staan altijd voorop.',

            'outro_message' => 'Bedankt voor het bekijken van mijn profiel! Ik ben altijd geïnteresseerd in nieuwe uitdagingen en interessante projecten. Laten we samen bouwen aan de toekomst van het web.',

            'cta_image' => null,
            'cta_title' => 'Klaar om samen te werken?',
            'cta_description' => 'Heb je een project in gedachten of wil je gewoon een keer brainstormen? Ik hoor graag van je!',
            'cta_text' => 'Neem contact op',
        ]);
    }
}
