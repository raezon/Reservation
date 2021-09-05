<?php

namespace app\models\forms;

class ServicesAndPriceForm extends \yii\base\Model
{
    public $produit_nom;
    public $produit_option;
    public $produit_type;
    public $nombre_de_persson;
    public $quantite;
    public $description;
    public $price;
    public $diet;
    public $imageFile;
    public $prix_livraison;
    public $prix_day;
    public $prix_night;
    public $duration;
    public $adress;
    public $prix_serveur;
    public $area;
    public $extra;
    public $caution;


    public function rules()
    {
        return [
            // username rules
            [['produit_nom','produit_option','produit_type','nombre_de_persson','quantite','description','price','diet','imageFile','prix_livraison','adress','prix_serveur','area','extra','caution','duration'], 'required'],
        
        ];
    }

    /**
     * @inheritdoc
     */

   
    public function attributeLabels()
    {
        return [
              'produit_nom' => \Yii::t('app', 'Nom du Produit'),
              'produit_option' => \Yii::t('app', 'Option du Produit'),
              'produit_type' => \Yii::t('app', 'Type du Produit'),
              'nombre_de_persson' => \Yii::t('app', 'Nombre de perssone'),
              'quantite' => \Yii::t('app', 'Quantité'),
              'description' => \Yii::t('app', 'Discription'),
              'price' => \Yii::t('app', 'Price'),
              'diet' => \Yii::t('app', 'Price'),
              'imageFile' => \Yii::t('app','imageFile'),
              'prix_livraison' => \Yii::t('app','Prix livraison'),
              'adress' => \Yii::t('app','Notre Adress'),
              'prix_serveur' => \Yii::t('app','Prix Serveur'),
              'area' => \Yii::t('app','espace'),
              'extra' => \Yii::t('app','extra'),
              'caution' => \Yii::t('app','caution'),
              'duration' => \Yii::t('app','Duration'),
              'prix_day' => \Yii::t('app','Prix Day'),
              'prix_night' => \Yii::t('app','Prix Night'),
        ];
    }

}