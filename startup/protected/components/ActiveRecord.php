<?php
class ActiveRecord extends CActiveRecord{
    
    private static $dbbank = null;

    protected static function getBankDbConnection()
    {
        if (self::$dbbank !== null){
            return self::$dbbank;
        }
        else{
            self::$dbbank = Yii::app()->dbbank;
            if (self::$dbbank instanceof CDbConnection){
                self::$dbbank->setActive(true);
                return self::$dbbank;
            }
            else
                throw new CDbException(Yii::t('yii','Active Record requires a "db" CDbConnection application component.'));
        }
    }
}
?>
