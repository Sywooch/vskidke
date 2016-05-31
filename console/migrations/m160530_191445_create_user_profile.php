<?php

use yii\db\Migration;

/**
 * Handles the creation for table `user_profile`.
 * Has foreign keys to the tables:
 *
 * - `user`
 */
class m160530_191445_create_user_profile extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user_profile', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'profile_name' => $this->string(255),
            'profile_phone' => $this->string(20),
            'profile_site' => $this->string(255),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-user_profile-user_id',
            'user_profile',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-user_profile-user_id',
            'user_profile',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-user_profile-user_id',
            'user_profile'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-user_profile-user_id',
            'user_profile'
        );

        $this->dropTable('user_profile');
    }
}
