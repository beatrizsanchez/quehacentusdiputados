<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "votacion_diputado".
 *
 * @property string $id
 * @property string $diputado_id
 * @property string $iniciativa_id
 * @property string $voto
 * @property string $comentario
 *
 * @property Diputado $diputado
 * @property Iniciativa $iniciativa
 */
class VotacionDiputado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'votacion_diputado';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['diputado_id', 'iniciativa_id', 'voto'], 'required'],
            [['diputado_id', 'iniciativa_id', 'voto'], 'integer'],
            [['comentario'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'diputado_id' => 'Diputado ID',
            'iniciativa_id' => 'Iniciativa ID',
            'voto' => 'Voto',
            'comentario' => 'Comentario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiputado()
    {
        return $this->hasOne(Diputado::className(), ['id' => 'diputado_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIniciativa()
    {
        return $this->hasOne(Iniciativa::className(), ['id' => 'iniciativa_id']);
    }

    public function votacion($iniciativa, $diputado)
    {
        
        $voto = $this->find()->where(['iniciativa_id' => $iniciativa, 'diputado_id' => $diputado])->one();
        $texto="";
        switch ($voto['voto']) {
            case '0':
                $texto="Favor"; 
                break;
            case '1':
                $texto="Contra";
                break;
            case '2':
                $texto="Ausente";
                break;
            default:
                $texto="Sin voto";
                break;
        }
        return $texto;
    }
    /*

    public function votacionCiudadano($iniciativa, $diputado)
    {
        $favor = $this->find()->where(['voto' => 0, 'iniciativa_id' => $iniciativa, 'diputado_id' => $diputado])->count('voto');
        $contra = $this->find()->where(['voto' => 1, 'iniciativa_id' => $iniciativa, 'diputado_id' => $diputado])->count('voto');
        $ausente = $this->find()->where(['voto' => 2, 'iniciativa_id' => $iniciativa, 'diputado_id' => $diputado])->count('voto');
        $no_voto = $this->find()->where(['voto' => 3, 'iniciativa_id' => $iniciativa, 'diputado_id' => $diputado])->count('voto');

        return [
            'favor' => $favor,
            'contra' => $contra,
            'ausente' => $ausente,
            'no_voto' => $no_voto,
        ];

    }*/
}
