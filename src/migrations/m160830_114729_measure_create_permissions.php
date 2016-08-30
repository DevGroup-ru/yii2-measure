<?php

use yii\db\Migration;

class m160830_114729_measure_create_permissions extends Migration
{
    const ADMIN_ROLE_NAME = 'MeasureAdministrator';

    protected $permissions = [
        'measure-view-measure' => 'You can see measures list and measure details',
        'measure-create-measure' => 'You can create a new measure',
        'measure-edit-measure' => 'You can edit an existing measure',
        'measure-delete-measure' => 'You can delete a measure',
    ];

    protected function error($message)
    {
        $length = strlen($message);
        echo "\n" . str_repeat('=', $length) . "\n" . $message . "\n" . str_repeat('=', $length) . "\n\n";
    }

    public function up()
    {
        $auth = Yii::$app->authManager;
        if ($auth === null) {
            $this->error('Please configure AuthManager before');
            return false;
        }
        try {
            $role = $auth->createRole(self::ADMIN_ROLE_NAME);
            $role->description = 'This role allows to manage a measures extension';
            $auth->add($role);
            foreach ($this->permissions as $name => $description) {
                $permission = $auth->createPermission($name);
                $permission->description = $description;
                $auth->add($permission);
                $auth->addChild($role, $permission);
            }
        } catch (Exception $e) {
            $this->error($e->getMessage());
            return false;
        }
        return true;
    }

    public function down()
    {
        $auth = Yii::$app->authManager;
        if ($auth !== null) {
            $role = $auth->getRole(self::ADMIN_ROLE_NAME);
            if ($role !== null) {
                $auth->remove($role);
                foreach ($this->permissions as $name => $description) {
                    $permission = $auth->getPermission($name);
                    if ($permission === null) {
                        continue;
                    }
                    $auth->remove($permission);
                }
            }
        }
    }
}
