<?php
/* @var $scenario Codeception\Scenario */
error_reporting(0);
$I = new FunctionalTester($scenario);
$I->wantTo('ensure that index page works');
$I->amOnPage('/measure/manage/index');
$I->seeElement('.btn.btn-success');
$I->seeNumberOfElements('table tbody tr', 17);
