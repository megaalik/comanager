<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Component]].
 *
 * @see Component
 */
class ComponentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Component[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Component|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
