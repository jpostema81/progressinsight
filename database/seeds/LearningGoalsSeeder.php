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
        DB::table('learning_goals')->delete();

        $topicHTML = Topic::where('name', '=', 'HTML');
        $topicCSS = Topic::where('name', '=', 'CSS');
        $topicGit = Topic::where('name', '=', 'Git');
        $topicJavaScript = Topic::where('name', '=', 'JavaScript');
        $topicPHP = Topic::where('name', '=', 'PHP');

        if($topicHTML->count() && $topicCSS->count() && $topicGit->count() 
            && $topicJavaScript->count() && $topicPHP->count())
        {
            $data = array(
                // HTML
                array(
                    'description' => 'leren werken met een code editor (Microsoft Visual Studio Code)', 
                    'criterion' => 'kan een map aan workspace toevoegen; kan plugins installeren; kan projecten uitwerken in code editor',
                    'topic_id' => $topicHTML->first()->id,
                ),
                array(
                    'description' => 'een basis HTML pagina maken', 
                    'criterion' => 'kan een HTML pagina maken waar ten minste een head, body, title, header, paragraph, hyperlink en table element in voor komt. Ook wordt het juiste DocType gebruikt.',
                    'topic_id' => $topicHTML->first()->id,
                ),
                array(
                    'description' => 'een HTML pagina syntax valideren met behulp van een tool (bijv. m.b.v. W3C online validator)', 
                    'criterion' => 'kan een bestaande HTML pagina invoeren in de validator en kan de gemelde fouten zelf verhelpen en kan het document net zo lang valideren tot deze helemaal valide is',
                    'topic_id' => $topicHTML->first()->id,
                ),
                // CSS
                array(
                    'description' => 'weten hoe je de afmetingen, marges, borders en paddings van elementen kunt aanpassen', 
                    'criterion' => 'kan een container van 100px breed en 200px hoog maken met een blauwe border van 5 pixels groot en een margin van 5 pixels en een padding van 10 pixels',
                    'topic_id' => $topicCSS->first()->id,
                ),

                // Git
                array(
                    'description' => 'leren wat versiebeheer inhoudt', 
                    'criterion' => 'De deelnemer moet de voor - en nadelen kunnen benoemen: acties terug kunnen draaien d.m.v. snapshots (commits), samenwerken aan 1 project op verschillende branches, logging / history, redundantie (Git)',
                    'topic_id' => $topicGit->first()->id,
                ),

                // JavaScript
                array(
                    'description' => 'je weet wat een variabele is en hoe je deze zelf declareert en initialiseert', 
                    'criterion' => 'kan een variabele voor leeftijd declareren en een waarde van 50 toekennen',
                    'topic_id' => $topicJavaScript->first()->id,
                ),

                // PHP
                array(
                    'description' => 'je weet wat een variabele is en hoe je deze zelf declareert en initialiseert', 
                    'criterion' => 'kan een variabele voor leeftijd declareren en een waarde van 50 toekennen',
                    'topic_id' => $topicPHP->first()->id,
                ),
            );

            DB::table('learning_goals')->insert($data);
        }
    }
}
