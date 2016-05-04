<?php

use yii\db\Migration;

/**
 * Handles the creation for table `feedback_messages`.
 */
class m160504_061141_create_feedback_messages extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
	
		$this->createTable('feedback_themes', [
            'theme_id' => $this->primaryKey(),
			'theme_name' => 'varchar(1000) NOT NULL'
        ], $tableOptions);
		
        $this->createTable('feedback_messages', [
            'message_id' => $this->primaryKey(),
			'theme_id' =>  'int(11) NOT NULL',
			'message_body' => 'varchar(4000) NOT NULL',
			'file_name'  => 'varchar(1000) NULL',
			'file_info'  => 'varchar(100) NULL',
        ], $tableOptions);
		
		$this->addForeignKey('FK_themes', 'feedback_messages', 'theme_id', 'feedback_themes', 'theme_id');
       
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
		$this->dropTable('feedback_themes');
        $this->dropTable('feedback_messages');
    }
}
