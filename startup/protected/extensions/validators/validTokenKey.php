<?php
class validTokenKey extends CValidator
{
    /**
     * Validates token key from database
     * 
     * @param type $controller
     * @param type $token
     */
    protected function validateAttribute($object, $attribute){
        $value=$object->$attribute;

        $record=TokenKey::model()->find(array(
            'select'=>'token_key, reclaim_date',
            'condition'=>'token_key=:token_key',
            'params'=>array(':token_key'=>$value),
        ));

        if($record===null)
        {
            $this->addError($object, $attribute, "Invalid token key '$value'");
        }
        else if($record->reclaim_date !== NULL){
            $formattedDate=Yii::app()->dateFormatter->formatDateTime($record->reclaim_date, 'medium', 'medium');
            $this->addError($object, $attribute, Yii::t('TokenKey', "TokenKey_'{value}'_AlreadyUsedOn_{formattedDate}", array('{value}'=>$value, '{formattedDate}'=>$formattedDate)));
        }
    }
}