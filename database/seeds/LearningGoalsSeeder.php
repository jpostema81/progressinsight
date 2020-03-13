<?php

use Illuminate\Database\Seeder;
use App\Topic;

class LearningGoalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('learning_goals')->delete();

        $topicHTML = Topic::where('name', '=', 'HTML');
        $topicHTMLVerdieping = Topic::where('name', '=', 'HTML verdieping');
        $topicCSS = Topic::where('name', '=', 'CSS');
        $topicCSSVerdieping = Topic::where('name', '=', 'CSS verdieping');
        $topicGit = Topic::where('name', '=', 'Git');
        $topicJavaScript = Topic::where('name', '=', 'JavaScript');
        $topicJavaScriptVerdieping = Topic::where('name', '=', 'JavaScript verdieping');
        $topicPHP = Topic::where('name', '=', 'PHP');
        $topicPHPVerdieping = Topic::where('name', '=', 'PHP verdieping');
        $topicTheorieen = Topic::where('name', '=', 'Theorieën');
        $topicLaravel = Topic::where('name', '=', 'Laravel');
        $topicLaravelVerdieping = Topic::where('name', '=', 'Laravel verdieping');
        $topicVueJs = Topic::where('name', '=', 'Vue.js');
        //$topicVueJsVerdieping = Topic::where('name', '=', 'Vue.js verdieping');
        $topicVueX = Topic::where('name', '=', 'VueX');
        $topicDeployment = Topic::where('name', '=', 'Deployment');
        // $topicScrum = Topic::where('name', '=', 'Scrum');

        if($topicHTML->count() && $topicHTMLVerdieping->count() && $topicCSS->count() && $topicCSSVerdieping->count() && $topicGit->count() 
            && $topicJavaScript->count() && $topicJavaScriptVerdieping->count() && $topicPHP->count() && $topicPHPVerdieping->count()
            && $topicTheorieen->count() && $topicVueJs->count() && $topicVueX->count() && $topicDeployment->count())
        {
            $data = array(
                // HTML
                array(
                    'description' => 'Leren werken met een code editor (Microsoft Visual Studio Code)', 
                    'criterion' => 'Kan een map aan workspace toevoegen; kan nieuwe bestanden en mappen in Visual Studio Code maken; kan projecten uitwerken in code editor',
                    'topic_id' => $topicHTML->first()->id,
                ),
                array(
                    'description' => 'Een basis HTML pagina maken', 
                    'criterion' => 'Kan een HTML pagina maken waar ten minste een head, body, title, header, paragraph, hyperlink en table element in voor komt. Ook wordt het juiste DocType gebruikt.',
                    'topic_id' => $topicHTML->first()->id,
                ),
                array(
                    'description' => 'Een HTML pagina syntax valideren met behulp van een tool (bijv. m.b.v. W3C online validator)', 
                    'criterion' => 'Kan een bestaande HTML pagina invoeren in de validator en kan de gemelde fouten zelf verhelpen en kan het document net zo lang valideren tot deze helemaal valide is',
                    'topic_id' => $topicHTML->first()->id,
                ),

                array(
                    'description' => 'Een afbeelding aan een webpagina toevoegen', 
                    'criterion' => 'Kan een afbeelding aan pagina toevoegen en kan de width, height en alt attributen toepassen',
                    'topic_id' => $topicHTML->first()->id,
                ),
                array(
                    'description' => 'Paragrafen aan een webpagina toevoegen', 
                    'criterion' => 'Kan een tekst in een paragraaf zetten',
                    'topic_id' => $topicHTML->first()->id,
                ),
                array(
                    'description' => 'Een hyperlink aan een webpagina toevoegen', 
                    'criterion' => 'Kan een hyperlink maken, kan een link-locatie in een nieuwe pagina laten openen',
                    'topic_id' => $topicHTML->first()->id,
                ),
                array(
                    'description' => 'Vetgedrukte tekst aan een webpagina toevoegen', 
                    'criterion' => 'Kan vetgedrukte tekst aan een webpagina toevoegen',
                    'topic_id' => $topicHTML->first()->id,
                ),
                array(
                    'description' => 'Cursieve tekst aan een webpagina toevoegen', 
                    'criterion' => 'Kan cursieve tekst aan een webpagina toevoegen',
                    'topic_id' => $topicHTML->first()->id,
                ),
                array(
                    'description' => 'Een tabel aan een webpagina toevoegen', 
                    'criterion' => 'Kan een tabel met meerdere regels, meerdere kolommen kolommen, een table headers en een table footers en een colspan maken',
                    'topic_id' => $topicHTML->first()->id,
                ),
                array(
                    'description' => 'Kopjes (headings) aan een webpagina toevoegen', 
                    'criterion' => 'Kan ten minste drie kopjes met drie verschillende headings (tekst groottes) toevoegen aan pagina',
                    'topic_id' => $topicHTML->first()->id,
                ),
                array(
                    'description' => 'Een geordende en ongeordende lijst aan een webpagina toevoegen', 
                    'criterion' => 'Kan een lijst van ten minste 3 willekeurige items toevoegen',
                    'topic_id' => $topicHTML->first()->id,
                ),
                array(
                    'description' => 'Een formulier aan een webpagina toevoegen', 
                    'criterion' => 'Kan een formulier maken met ten minste 1 text input field, 1 select field met ten minste 3 options en 1 textarea',
                    'topic_id' => $topicHTML->first()->id,
                ),
                array(
                    'description' => 'Commentaarregels in HTML code toevoegen', 
                    'criterion' => 'Kan aan een willekeurige webpagina in de body sectie het commentaar "Dit is commentaar en wordt niet op de webpagina weergegeven" toevoegen',
                    'topic_id' => $topicHTML->first()->id,
                ),
                array(
                    'description' => 'HTML DOM (Document Object Model) structuur begrijpen: HTML elementen zijn objecten met eigen properties. Later in JavaScript leer je dat er ook functies en events (gebeurtenissen) zijn die gekoppeld kunnen worden aan deze objecten / elementen', 
                    'criterion' => 'Kan uitleggen dat ieder element een node is die parent en / of child nodes heeft en dat nodes eigen properties hebben zoals een id en / of een class',
                    'topic_id' => $topicHTML->first()->id,
                ),

                // HTML verdieping
                array(
                    'description' => 'Leren wat het verschil is tussen semantische elemeneten (header, nav, section, aside, footer, form, table elementen) en niet-semantische elementen (div, span)', 
                    'criterion' => 'Uit kunnen leggen waarom je voor semantische elementen kies: betere leesbaarheid voor programmeur, betere accessibility voor search-engines en screen-readers',
                    'topic_id' => $topicHTMLVerdieping->first()->id,
                ),

                // CSS
                array(
                    'description' => 'Weten hoe je de afmetingen, marges, borders en paddings van elementen kunt aanpassen', 
                    'criterion' => 'Kan een container van 100px breed en 200px hoog maken met een blauwe border van 5 pixels groot en een margin van 5 pixels en een padding van 10 pixels',
                    'topic_id' => $topicCSS->first()->id,
                ),
                array(
                    'description' => 'Verschil kennen tussen inline, inline-block en block elementen', 
                    'criterion' => 'Kan uitleggen waarin inline, inline-block en block elementen onderling van elkaar verschillen',
                    'topic_id' => $topicCSS->first()->id,
                ),
                array(
                    'description' => 'Kunnen toepassen van classes en id\'s en weten wanneer je welke (class of id) moet kiezen', 
                    'criterion' => 'Kan een table maken waarbij de rows om-en-om rood en blauw gekleurd zijn d.m.v. css-classes. kan de table een border van 5 pixels geven d.m.v. een id',
                    'topic_id' => $topicCSS->first()->id,
                ),
                array(
                    'description' => 'Een CSS bestand toevoegen aan een HTML document', 
                    'criterion' => 'Kan een CSS bestand toevoegen aan een HTML document',
                    'topic_id' => $topicCSS->first()->id,
                ),
                array(
                    'description' => 'Pagina indeling kunnen maken d.m.v. CSS Grid Layout ', 
                    'criterion' => 'Kan afbeelding uit deze bijlage namaken met grid-layout 1. op basis van grid-column <start> / <end> 2. en ook <start> / <column span>',
                    'topic_id' => $topicCSS->first()->id,
                ),

                // CSS verdieping
                array(
                    'description' => 'CSS kunnen aanpassen in de browser met behulp van de Developer Tool(s)', 
                    'criterion' => '1. script logo op www.script.nl m.b.v. browser Developer Tools vervangen voor logo op https://www.w3.org/2008/site/images/logo-w3c-screen-lg 2. kan  de letterkleur van het menu op www.script.nl veranderen in rood door de styling m.b.v. browser Developer Tools aan te passen',
                    'topic_id' => $topicCSSVerdieping->first()->id,
                ),
                array(
                    'description' => 'Begrip krijgen hoe diverse elementen t.o.v. elkaar op de pagina geplaatst worden', 
                    'criterion' => 'Je kunt uitleggen hoe diverse elementen t.o.v. elkaar op de pagina geplaatst worden',
                    'topic_id' => $topicCSSVerdieping->first()->id,
                ),
                array(
                    'description' => 'Begrip krijgen van het box model (betekenis van display, border, width, height, padding en margin eigenschappen leren)', 
                    'criterion' => 'Je kunt uitleggen a.d.h.v. een tekening waar een border, padding en margin zich bevinden en hoe je deze kunt stylen. Ook weet je wat een width en height property met een element doet',
                    'topic_id' => $topicCSSVerdieping->first()->id,
                ),

                // Git
                array(
                    'description' => 'Leren wat versiebeheer inhoudt', 
                    'criterion' => 'De deelnemer moet de voor - en nadelen kunnen benoemen: acties terug kunnen draaien d.m.v. snapshots (commits), samenwerken aan 1 project op verschillende branches, logging / history, redundantie (Git)',
                    'topic_id' => $topicGit->first()->id,
                ),
                array(
                    'description' => 'Leren werken met de basis Git commando\'s: config, init, clone, add, commit, diff, status, log, status, branch, checkout, merge, remote, push, pull, stash, rm', 
                    'criterion' => 'Kan zelf een repository online aanmaken op GitHub of BitBucket, kan deze repository clonen, kan bestanden toevoegen (tracken), kan een commit maken, kan pushen, kan pullen, kan merge conflicten oplossen',
                    'topic_id' => $topicGit->first()->id,
                ),

                // JavaScript
                array(
                    'description' => 'Je weet wat een variabele is en hoe je deze zelf declareert en initialiseert', 
                    'criterion' => 'Kan een variabele voor leeftijd declareren en een waarde van 50 toekennen',
                    'topic_id' => $topicJavaScript->first()->id,
                ),
                array(
                    'description' => 'Leren wat variable scopes zijn: global en local scope', 
                    'criterion' => 'Kan een foutmelding veroorzaken door een variabele met een local scope aan te roepen binnen de global scope',
                    'topic_id' => $topicJavaScript->first()->id,
                ),
                array(
                    'description' => 'Leren wat een datatype inhoudt en welke datatypes er allemaal zijn binnen JavaScript', 
                    'criterion' => 'Kan uitleggen wat een number (int), string, boolean, null, undefined en object zijn',
                    'topic_id' => $topicJavaScript->first()->id,
                ),
                array(
                    'description' => 'Keren wat een operator is en welke operatoren er zijn binnen JavaScript en hoe je deze toepast', 
                    'criterion' => '1. Kan het verschil tussen 100 en 50 toekennen aan een variabele. 2. kan het resultaat van 100 gedeeld door 50 aan een variabele toekennen. 3. kan een voornaam en achternaam aan twee variabelen toekennen en kan beide aan elkaar plakken (concateneren) en het resultaat aan een derde variabele toekennen',
                    'topic_id' => $topicJavaScript->first()->id,
                ),
                array(
                    'description' => 'Leren wat functies zijn, wat functie parameters zijn en wat return statements zijn', 
                    'criterion' => 'Kan een functie schrijven die twee getallen bij elkaar optelt. deze functie heeft twee parameters (getal1, getal2) en de functie retourneert de som van beide getallen',
                    'topic_id' => $topicJavaScript->first()->id,
                ),
                array(
                    'description' => 'Leren werken met de console van de webbrowser', 
                    'criterion' => '1. Kan output lezen (bijv. error messages) om fouten op te sporen binnen eigen JavaScript code. 2. kan zelf JavaScript code invoeren om eigen JavaScript code te testen / debuggen: schrijf in de console een functie die twee getallen bij elkaar optelt zoals hiervoor omschreven en voer deze functie uit vanuit de console om het resultaat binnen de console te bekijken',
                    'topic_id' => $topicJavaScript->first()->id,
                ),
                array(
                    'description' => 'Leren werken met de browser Developer Tool(s): debugger', 
                    'criterion' => '1. Kan een breakpoint setten 2. kan single-steppen 3. kan een watch toevoegen',
                    'topic_id' => $topicJavaScript->first()->id,
                ),
                array(
                    'description' => 'Code opmaak: inspringen, functienamen camelCase', 
                    'criterion' => 'Herschrijf deze code <insert link> en voorzie code van juiste inspringen, camelcase notatie',
                    'topic_id' => $topicJavaScript->first()->id,
                ),
                array(
                    'description' => 'Leren wat for - en while loops zijn', 
                    'criterion' => '1. Kan m.b.v. een for-loop de getallen 1 t/m 10 op het scherm weergeven 2. kan m.b.v. een while-loop de getallen 1 t/m 10 op het scherm weergeven',
                    'topic_id' => $topicJavaScript->first()->id,
                ),
                array(
                    'description' => 'Leren wat een Class is, gebruik kunnen maken van getters, setters, constructors, properties', 
                    'criterion' => '1. Kan een User class schrijven 2. kan een constructor toevoegen met 2 parameters: firstname, lastname en age. de constructor set de firstname, lastname en age properties. 3. kan een class getter "fullName" toevoegen die een stringcombinatie van firstname en lastname returned. 4. kan een setter "age" toevoegen die de leeftijd van de user toekent.',
                    'topic_id' => $topicJavaScript->first()->id,
                ),

                // JavaScript verdieping
                array(
                    'description' => 'Leren wat JavaScript linting inhoudt', 
                    'criterion' => '',
                    'topic_id' => $topicJavaScriptVerdieping->first()->id,
                ),
                array(
                    'description' => 'Leren wat het verschil is tussen var, const en let', 
                    'criterion' => '',
                    'topic_id' => $topicJavaScriptVerdieping->first()->id,
                ),
                array(
                    'description' => 'Leren werken met JavaScript arrow functions', 
                    'criterion' => '',
                    'topic_id' => $topicJavaScriptVerdieping->first()->id,
                ),
                array(
                    'description' => 'Weten wat het verschil is tussen arrow functions en "gewone" functions', 
                    'criterion' => '',
                    'topic_id' => $topicJavaScriptVerdieping->first()->id,
                ),
                array(
                    'description' => 'Leren wat hoisting is en hoe dat bij JavaScript werkt', 
                    'criterion' => '',
                    'topic_id' => $topicJavaScriptVerdieping->first()->id,
                ),
                array(
                    'description' => 'Leren werken met Promises', 
                    'criterion' => '',
                    'topic_id' => $topicJavaScriptVerdieping->first()->id,
                ),
                array(
                    'description' => 'Leren werken met modules, leren hoe je de import - en export directives toepast, het verschil kunnen uitleggen tussen default en named exports', 
                    'criterion' => '',
                    'topic_id' => $topicJavaScriptVerdieping->first()->id,
                ),

                // PHP
                array(
                    'description' => 'Je weet wat een variabele is en hoe je deze zelf declareert en initialiseert', 
                    'criterion' => 'Kan een variabele voor leeftijd declareren en een waarde van 50 toekennen',
                    'topic_id' => $topicPHP->first()->id,
                ),
                array(
                    'description' => 'Leren wat variable scopes zijn: global en local scope', 
                    'criterion' => 'Kan een foutmelding veroorzaken door een variabele met een local scope aan te roepen binnen de global scope',
                    'topic_id' => $topicPHP->first()->id,
                ),
                array(
                    'description' => 'Leren wat een datatype inhoudt en welke datatypes er allemaal zijn binnen PHP. leren wat een loosely typed language zoals PHP inhoudt', 
                    'criterion' => 'Kan uitleggen wat een number (int), string, boolean, null, undefined en object zijn',
                    'topic_id' => $topicPHP->first()->id,
                ),
                array(
                    'description' => 'Leren wat een operator is en welke operatoren er zijn binnen PHP en hoe je deze toepast', 
                    'criterion' => '1. Kan het verschil tussen 100 en 50 toekennen aan een variabele. 2. kan het resultaat van 100 gedeeld door 50 aan een variabele toekennen. 3. kan een voornaam en achternaam aan twee variabelen toekennen en kan beide aan elkaar plakken (concateneren) en het resultaat aan een derde variabele toekennen',
                    'topic_id' => $topicPHP->first()->id,
                ),
                array(
                    'description' => 'Leren wat functies zijn, wat functie parameters zijn en wat return statements zijn', 
                    'criterion' => 'Kan een functie schrijven die twee getallen bij elkaar optelt. deze functie heeft twee parameters (getal1, getal2) en de functie retourneert de som van beide getallen',
                    'topic_id' => $topicPHP->first()->id,
                ),
                array(
                    'description' => 'Leren debuggen met de var_dump, print_r en exit functies en met error reporting en error logs', 
                    'criterion' => 'Kan de inhoud van een variabele met genoemde functies op scherm tonen en inzetten bij het opsporen van fouten in de code',
                    'topic_id' => $topicPHP->first()->id,
                ),
                array(
                    'description' => 'Leren wat for - en while loops zijn', 
                    'criterion' => '',
                    'topic_id' => $topicPHP->first()->id,
                ),
                array(
                    'description' => 'Leren wat composer is (ook als voorbereiding op de installatie van Laravel)', 
                    'criterion' => '',
                    'topic_id' => $topicPHP->first()->id,
                ),
                array(
                    'description' => 'Leren wat een Class is, gebruik kunnen maken van constructors', 
                    'criterion' => '1. Kan een User class schrijven 2. kan een constructor toevoegen met 2 parameters: firstname, lastname en age. de constructor set de firstname, lastname en age properties. 3. kan een class getter "fullName" toevoegen die een stringcombinatie van firstname en lastname returned. 4. kan een setter "age" toevoegen die de leeftijd van de user toekent.',
                    'topic_id' => $topicPHP->first()->id,
                ),

                // PHP verdieping
                array(
                    'description' => 'Leren wat Closures zijn en hoe je ze kan toepassen', 
                    'criterion' => 'Kan een closure als functieparameter meegeven',
                    'topic_id' => $topicPHPVerdieping->first()->id,
                ),
                array(
                    'description' => 'Leren wat type hinting is en hoe je dit kan toepassen', 
                    'criterion' => 'Kan typehinting aan functie parameters toevoegen en kan uitleggen waarom dit duidelijkere error messages oplevert',
                    'topic_id' => $topicPHPVerdieping->first()->id,
                ),

                // Theorieën
                array(
                    'description' => 'Leren wat seperation of concerns inhoudt', 
                    'criterion' => '',
                    'topic_id' => $topicTheorieen->first()->id,
                ),
                array(
                    'description' => 'Leren wat het MVC design pattern inhoudt', 
                    'criterion' => 'Kan uitleggen wat een Model, View en Controller inhouden en hoe hun onderlinge relatie is',
                    'topic_id' => $topicTheorieen->first()->id,
                ),
                array(
                    'description' => 'Leren wat CRUD inhoudt', 
                    'criterion' => '',
                    'topic_id' => $topicTheorieen->first()->id,
                ),
                array(
                    'description' => 'Leren wat het HTTP protocol inhoudt', 
                    'criterion' => '',
                    'topic_id' => $topicTheorieen->first()->id,
                ),

                // Laravel
                array(
                    'description' => 'Leren werken met redirects', 
                    'criterion' => 'kan redirect helper functies toepassen',
                    'topic_id' => $topicLaravel->first()->id,
                ),
                array(
                    'description' => 'Leren wat migrations zijn', 
                    'criterion' => 'Kan uitleggen wat een migration inhoudt en wat de voordelen zijn, bijv. wanneer men in teamverband werkt en wijzigingen aan het databaseschama wil doorvoeren',
                    'topic_id' => $topicLaravel->first()->id,
                ),
                array(
                    'description' => 'Leren wat models zijn', 
                    'criterion' => '',
                    'topic_id' => $topicLaravel->first()->id,
                ),
                array(
                    'description' => 'Leren wat routes zijn', 
                    'criterion' => '',
                    'topic_id' => $topicLaravel->first()->id,
                ),
                array(
                    'description' => 'Leren wat controllers zijn', 
                    'criterion' => '',
                    'topic_id' => $topicLaravel->first()->id,
                ),
                array(
                    'description' => 'Leren wat layouts en views zijn', 
                    'criterion' => '',
                    'topic_id' => $topicLaravel->first()->id,
                ),
                array(
                    'description' => 'Leren wat tinker is', 
                    'criterion' => '',
                    'topic_id' => $topicLaravel->first()->id,
                ),
                array(
                    'description' => 'Leren hoe je gegevens valideert met behulp van laravel', 
                    'criterion' => '',
                    'topic_id' => $topicLaravel->first()->id,
                ),
                array(
                    'description' => 'Leren wat eloquent is', 
                    'criterion' => '',
                    'topic_id' => $topicLaravel->first()->id,
                ),
                array(
                    'description' => 'Leren wat middleware is', 
                    'criterion' => '',
                    'topic_id' => $topicLaravel->first()->id,
                ),
                array(
                    'description' => 'Leren wat recources zijn', 
                    'criterion' => '',
                    'topic_id' => $topicLaravel->first()->id,
                ),
                array(
                    'description' => 'Leren hoe je een betaalprovider (PSP) in laravel kunt integreren', 
                    'criterion' => '',
                    'topic_id' => $topicLaravel->first()->id,
                ),
                array(
                    'description' => 'Leren hoe je tests voor je Laravel applicatie schrijft', 
                    'criterion' => '',
                    'topic_id' => $topicLaravel->first()->id,
                ),
                array(
                    'description' => 'Leren wat seeders zijn', 
                    'criterion' => '',
                    'topic_id' => $topicLaravel->first()->id,
                ),
                array(
                    'description' => 'Leren wat factories zijn', 
                    'criterion' => '',
                    'topic_id' => $topicLaravel->first()->id,
                ),
                array(
                    'description' => 'Leren werken met Mailable', 
                    'criterion' => '',
                    'topic_id' => $topicLaravel->first()->id,
                ),
                array(
                    'description' => 'Basis authenticatie kunnen toepassen in een project', 
                    'criterion' => '',
                    'topic_id' => $topicLaravel->first()->id,
                ),
                array(
                    'description' => 'Leren werken met de File driver om bijvoorbeeld plaatjes op te slaan', 
                    'criterion' => '',
                    'topic_id' => $topicLaravel->first()->id,
                ),
                array(
                    'description' => 'Leren werken met flash messages', 
                    'criterion' => '',
                    'topic_id' => $topicLaravel->first()->id,
                ),

                // Laravel verdieping
                array(
                    'description' => 'Leren wat repositories zijn en hoe dit kan toepassen in een project', 
                    'criterion' => '',
                    'topic_id' => $topicLaravelVerdieping->first()->id,
                ),
                array(
                    'description' => 'Leren wat service containers en providers zijn en hoe je dit kan toepassen in een project', 
                    'criterion' => '',
                    'topic_id' => $topicLaravelVerdieping->first()->id,
                ),
                array(
                    'description' => 'Leren werken met gates en policies', 
                    'criterion' => 'Kan zelf een gate en policy schrijven en kan uitleggen wat het verschil tussen autorizatie en authenticatie is',
                    'topic_id' => $topicLaravelVerdieping->first()->id,
                ),

                // Vue.js
                array(
                    'description' => 'Weten wat 2-way data binding is', 
                    'criterion' => '',
                    'topic_id' => $topicVueJs->first()->id,
                ),
                array(
                    'description' => 'Vue Devtools', 
                    'criterion' => 'kan Vue Devtools toepassen om componenten, properties, store, commits in te zien en Vue Devtools inzetten bij het traceren van fouten in de code',
                    'topic_id' => $topicVueJs->first()->id,
                ),
                array(
                    'description' => 'Event listeners', 
                    'criterion' => '',
                    'topic_id' => $topicVueJs->first()->id,
                ),
                array(
                    'description' => 'Attribute and class binding', 
                    'criterion' => '',
                    'topic_id' => $topicVueJs->first()->id,
                ),
                array(
                    'description' => 'Component Properties & Computed properties', 
                    'criterion' => '',
                    'topic_id' => $topicVueJs->first()->id,
                ),
                array(
                    'description' => 'Components', 
                    'criterion' => '',
                    'topic_id' => $topicVueJs->first()->id,
                ),
                array(
                    'description' => 'Nested Components', 
                    'criterion' => '',
                    'topic_id' => $topicVueJs->first()->id,
                ),
                array(
                    'description' => 'Custom Events (communication), event dispatching', 
                    'criterion' => '',
                    'topic_id' => $topicVueJs->first()->id,
                ),
                array(
                    'description' => 'Named Slots', 
                    'criterion' => '',
                    'topic_id' => $topicVueJs->first()->id,
                ),
                array(
                    'description' => 'Inline Templates', 
                    'criterion' => '',
                    'topic_id' => $topicVueJs->first()->id,
                ),
                array(
                    'description' => 'Leren hoe je van child naar parent communiceert ($emit)', 
                    'criterion' => '',
                    'topic_id' => $topicVueJs->first()->id,
                ),
                array(
                    'description' => 'Leren hoe je van parent naar child communiceert (props)', 
                    'criterion' => '',
                    'topic_id' => $topicVueJs->first()->id,
                ),

                // VueX
                array(
                    'description' => 'Leren wat een store is en wanneer / waarvoor je deze toepast', 
                    'criterion' => 'Uit kunnen leggen hoe een store een parent / child communication tussen componentss vervangt en hoe een store met components communiceert; uit kunnen leggen wat een single source of truth is',
                    'topic_id' => $topicVueX->first()->id,
                ),
                array(
                    'description' => 'Leren wat een state binnen een store is', 
                    'criterion' => '',
                    'topic_id' => $topicVueX->first()->id,
                ),
                array(
                    'description' => 'Leren wat store commits zijn', 
                    'criterion' => '',
                    'topic_id' => $topicVueX->first()->id,
                ),
                array(
                    'description' => 'Leren wat store actions zijn', 
                    'criterion' => '',
                    'topic_id' => $topicVueX->first()->id,
                ),
                array(
                    'description' => 'Leren wat store getters zijn', 
                    'criterion' => '',
                    'topic_id' => $topicVueX->first()->id,
                ),
                array(
                    'description' => 'Vuex helpers (mapState, mapGetters, mapMutations, mapActions)', 
                    'criterion' => '',
                    'topic_id' => $topicVueX->first()->id,
                ),

                // Deployment
                array(
                    'description' => 'Leren hoe je een Laravel applicatie naar Heroku deployed', 
                    'criterion' => 'Een Laravel project naar Heroku kunnen deployen',
                    'topic_id' => $topicDeployment->first()->id,
                )

                // SCRUM...
            );

            DB::table('learning_goals')->insert($data);
        }
    }
}
