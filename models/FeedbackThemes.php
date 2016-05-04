<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "feedback_themes".
 *
 * @property integer $theme_id
 * @property string $theme_name
 *
 * @property FeedbackMessages[] $feedbackMessages
 */
class FeedbackThemes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feedback_themes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['theme_id', 'theme_name'], 'required'],
            [['theme_id'], 'integer'],
            [['theme_name'], 'string', 'max' => 1000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'theme_id' => 'Theme ID',
            'theme_name' => 'Theme Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeedbackMessages()
    {
        return $this->hasMany(FeedbackMessages::className(), ['theme_id' => 'theme_id']);
    }
}
