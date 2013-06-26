<?php
class ActiveRecord extends CActiveRecord{
    
    private static $dbopenerp = null;
    
    protected static function getOpenerpDbConnection()
    {
        if (self::$dbopenerp !== null)
            return self::$dbopenerp;
        else
        {
            self::$dbopenerp = Yii::app()->dbopenerp;
            if (self::$dbopenerp instanceof CDbConnection)
            {
                self::$dbopenerp->setActive(true);
                return self::$dbopenerp;
            }
            else
                throw new CDbException(Yii::t('yii','Active Record requires a "db" CDbConnection application component.'));
        }
    }
}
?>
