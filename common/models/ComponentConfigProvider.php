<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[ComponentConfig]].
 *
 * @see ComponentConfig
 */
class ComponentConfigProvider extends \yii\data\ArrayDataProvider
{
    /**
     * Initialize the dataprovider by filling allModels
     */
    public function init()
    {
        //Get all all authors with their articles
        $query = ComponentConfig::find()->with('component');
        foreach($query->all() as $component_config) {

            //Add rows with the Author, # of articles and last publishing date
            $this->allModels[] = [
                'name' => $component_config->getComponentName(),
            ];
        }
    }
}
