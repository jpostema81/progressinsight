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
        $topic = Topic::where('name', '=', 'HTML');

        if($topic->count())
        {
            $topicId = $topic->first()->id;

            $data = array(
                array(
                    'description' => 'leren werken met een code editor (Microsoft Visual Studio Code)', 
                    'criterion' => 'kan een map aan workspace toevoegen; kan plugins installeren; kan projecten uitwerken in code editor',
                    'topic_id' => $topicId,
                ),
                array(
                    'description' => 'een basis HTML pagina maken', 
                    'criterion' => 'kan een HTML pagina maken waar ten minste een head, body, title, header, paragraph, hyperlink en table element in voor komt. Ook wordt het juiste DocType gebruikt.',
                    'topic_id' => $topicId,
                ),
                array(
                    'description' => 'een HTML pagina syntax valideren met behulp van een tool (bijv. m.b.v. W3C online validator)', 
                    'criterion' => 'kan een bestaande HTML pagina invoeren in de validator en kan de gemelde fouten zelf verhelpen en kan het document net zo lang valideren tot deze helemaal valide is',
                    'topic_id' => $topicId,
                ),  
            );

            DB::table('learning_goals')->insert($data);
        }
    }
}
