<?php

use yii\db\Migration;

/**
 * Class m191212_200329_init_rbac
 */
class m191212_200329_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     *
    public function safeUp()
    {
    }
    /**
     * {@inheritdoc}
     *
    public function safeDown()
    {
        echo "m191212_200329_init_rbac cannot be reverted.\n";
        return false;
    }*/

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $auth = Yii::$app->authManager;

        // add "createProduct" permission
        $createProduct = $auth->createPermission('createProduct');
        $createProduct->description = 'Create a products';
        $auth->add($createProduct);

        // add "updatePost" permission
        $updateProduct = $auth->createPermission('updateProduct');
        $updateProduct->description = 'Update partners';
        $auth->add($updateProduct);

        // add "partner" role and give this role the "createPost" permission
        $partner = $auth->createRole('partner');
        $auth->add($partner);
        $auth->addChild($partner, $updateProduct);

        // add "admin" role and give this role the "updateProduct" permission
        // as well as the permissions of the "partner" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $updateProduct);
        $auth->addChild($admin, $partner);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($partner, 2);
        $auth->assign($admin, 1);
    }

    public function down()
    {
        echo "m191212_200329_init_rbac cannot be reverted.\n";

        return false;
    }

}
