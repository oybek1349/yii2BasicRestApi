<?php

namespace app\modules\valute\models;

use Yii;

/**
 * This is the model class for table "currency".
 *
 * @property int $id
 * @property string $valuteID
 * @property string $numCode
 * @property string $charCode
 * @property string $name
 * @property float $value
 * @property int $date
 */
class Currency extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%currency}}';
    }

    /**
     * {@inheritdoc}
     */
    
    public function fields(){
      

        return parent::fields();

    }

    public function rules()
    {
        return [
            [['valuteID', 'numCode', 'charCode', 'name', 'value', 'date'], 'required'],
            [['value'], 'string', 'max' => 20],
            [['date'], 'integer'],
            [['valuteID', 'numCode', 'charCode'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 255],
        ];
    }

  
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'valuteID' => 'Valute ID',
            'numCode' => 'Num Code',
            'charCode' => 'Char Code',
            'name' => 'Name',
            'value' => 'Value',
            'date' => 'Date',
        ];
    }

    /**
     * {@inheritdoc}
     * @return CurrencyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CurrencyQuery(get_called_class());
    }
}
