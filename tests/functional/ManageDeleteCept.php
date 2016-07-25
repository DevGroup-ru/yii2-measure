<?php
/* @var $scenario Codeception\Scenario */
error_reporting(0);
$I = new FunctionalTester($scenario);
$I->wantTo('ensure that delete page works');
$I->amOnPage('/measure/manage/index');
$I->seeNumberOfElements('table tbody tr', 17);
$I->click('a[href="/measure/manage/delete?id=1"]');
$I->seeNumberOfElements('table tbody tr', 16);
