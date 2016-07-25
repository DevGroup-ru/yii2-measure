<?php 
$I = new FunctionalTester($scenario);
$I->amOnPage('/measure/manage/index');
$I->seeElement('.btn.btn-success');
$I->seeNumberOfElements('table tbody tr', 17);

