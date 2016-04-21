<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Org_type]].
 *
 * @see Org_type
 */
class Org_typeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Org_type[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Org_type|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
