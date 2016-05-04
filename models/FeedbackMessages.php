<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "feedback_messages".
 *
 * @property integer $message_id
 * @property integer $theme_id
 * @property string $message_body
 * @property string $file_name
 *
 * @property FeedbackThemes $theme
 */
class FeedbackMessages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
	 
	public $file;

	
    public static function tableName()
    {
        return 'feedback_messages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['theme_id', 'message_body'], 'required'],
            [['theme_id'], 'integer'],
            [['message_body'], 'string', 'max' => 4000],
			[['file_name'], 'string', 'max' => 500],
			[['file_info'], 'string', 'max' => 100],
			[['file'], 'file', 'mimeTypes'=>'image/jpeg, image/png, image/gif, application/pdf', 'maxSize'=>1024 * 1024 * 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'message_id' => 'ID обращения',
            'theme_id' => 'Tемa',
            'message_body' => 'Текст обращения',
            'file_name' => 'Файл',
			'file' =>'Файл'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTheme()
    {
        return $this->hasOne(FeedbackThemes::className(), ['theme_id' => 'theme_id']);
    }
	
	public function getThemeName()
	{
		$theme = $this->theme;
	 
		return $theme ? $theme->theme_name : '';
	}

	public function getFile() 
    {
        return isset($this->file_name) ? Yii::$app->params['fileUploadUrl'] . $this->file_name : null;
    }
	
	public function uploadFile() {

        $file = UploadedFile::getInstance($this, 'file');

        if (empty($file)) {
            return false;
        }

        $this->file_name = $file->name;
        $ext = end((explode(".", $file->name)));
		
		$this->file_info =  number_format($file->size / 1024, 1, ',', ' ') . ' Кб, ' . $file->type;
		
        $this->file_name = Yii::$app->security->generateRandomString().".{$ext}";

        return $file;
    }

}
