<?php

use App\Topic;
use Illuminate\Database\Seeder;

class TopicTableSeeder extends Seeder {

    public function run() {
        $topic = new Topic();
        $topic->domain_id = 1;
        $topic->topic = 'BlockChain';
        $topic->save();

        $topic = new Topic();
        $topic->domain_id = 1;
        $topic->topic = 'AI';
        $topic->save();

        $topic = new Topic();
        $topic->domain_id = 2;
        $topic->topic = 'IOT';
        $topic->save();

        $topic = new Topic();
        $topic->domain_id = 2;
        $topic->topic = 'Arduino';
        $topic->save();

        $topic = new Topic();
        $topic->domain_id = 3;
        $topic->topic = 'Bridge';
        $topic->save();

        $topic = new Topic();
        $topic->domain_id = 3;
        $topic->topic = 'Building';
        $topic->save();

        $topic = new Topic();
        $topic->domain_id = 4;
        $topic->topic = 'Transformer';
        $topic->save();

        $topic = new Topic();
        $topic->domain_id = 4;
        $topic->topic = 'Motor';
        $topic->save();

        $topic = new Topic();
        $topic->domain_id = 5;
        $topic->topic = 'Heat';
        $topic->save();

        $topic = new Topic();
        $topic->domain_id = 5;
        $topic->topic = 'Engine';
        $topic->save();
    }
}