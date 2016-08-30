<?php
/* @var $scenario Codeception\Scenario */
//error_reporting(0);
ini_set('error_reporting', 0);
$I = new FunctionalTester($scenario);
$I->wantTo('ensure that update page works');
$I->amOnPage('/measure/measures-manage/update');
$I->seeElement('#measure-format');
$I->seeElement('button[type=submit]');
$I->see('Create');
$I->cantSee('Update');
$I->click('Create');
$I->seeElement('.field-measure-type.has-error');
$I->selectOption('#measure-type', 'Acceleration');
$I->fillField('#measure-name', 'qwe');
$I->fillField('#measure-unit', 'qwe');
$I->fillField('#measure-rate', '1');
$I->click('Create');
$I->see('Update');
$I->amOnPage('/measure/measures-manage/update?id=0');
$I->canSeeResponseCodeIs(404);
