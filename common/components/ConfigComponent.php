<?

namespace common\components;

use yii\base\Component;

class ConfigComponent extends Component{

    public static function getConfigImage($id){
        $base = \Yii::$app->params['baseUrl'].'/uploads/configs/';
        return $base.(($original) ? $id : 'small_'.$id).'.jpg';
    }
}
