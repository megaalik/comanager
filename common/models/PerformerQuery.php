<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Performer]].
 *
 * @see Performer
 */
class PerformerQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Performer[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Performer|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
