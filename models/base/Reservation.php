<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "reservation".
 *
 * @property integer $id
 * @property string $reservation_date
 * @property string $piece_jointe
 * @property integer $status
 * @property double $montant
 * @property integer $product_item_id
 * @property integer $partner_id 
 * @property \app\models\User $user
 * @property \app\models\ProductItem $productItem
 */
class Reservation extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reservation_date','partner_id', 'piece_jointe', 'user_id', 'product_item_id'], 'required'],
            [['reservation_date'], 'safe'],
            [['piece_jointe'], 'string'],
            [['status', 'user_id','partner_id', 'product_item_id'], 'integer'],
            [['montant'], 'number']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reservation';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'reservation_date' => 'Reservation Date',
            'piece_jointe' => 'Piece Jointe',
            'status' => 'Status',
            'montant' => 'Montant',
            'user_id' => 'User ID',
            'product_item_id' => 'Product Item ID',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\app\models\User::className(), ['id' => 'user_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductItem()
    {
        return $this->hasOne(\app\models\ProductItem::className(), ['id' => 'product_item_id']);
    }
    	        
   /** 
    * @return \yii\db\ActiveQuery 
    */ 
   public function getPartner() 
   { 
       return $this->hasOne(\app\models\Partner::className(), ['id' => 'partner_id']); 
   } 
    
    /**
     * @inheritdoc
     * @return \app\models\ReservationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\ReservationQuery(get_called_class());
    }
    public function upload()
    {

      
            $image = 'piece' . time();
            $path = 'uploads/' . $image . '.' . $this->file->extension;
            $this->file->saveAs($path, false);
            $this->file = $image;
            return true;
       
    }
}
