<?php

use App\Domain;
use Illuminate\Database\Seeder;

class DomainTableSeeder extends Seeder {

    public function run() {
        $domain = new Domain();
        $domain->domain = 'Computer Science';
        $domain->save();

        $domain = new Domain();
        $domain->domain = 'Electronics and Communication';
        $domain->save();

        $domain = new Domain();
        $domain->domain = 'Civil';
        $domain->save();

        $domain = new Domain();
        $domain->domain = 'Electrical';
        $domain->save();

        $domain = new Domain();
        $domain->domain = 'Mechanical';
        $domain->save();
    }

}