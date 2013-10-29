<?php
class OrdersAction extends CAction
{
    public function run()
    {
        $controller=$this->getController();
        $controller->allowUser(MANAGER);
        $customer = Yii::app()->user->tokenCustomer;
        
        $criteria = new CDbCriteria();
        $criteria->limit = 50;
        $criteria->order = 'event_time DESC';
        $criteria->alias = 'order';
        
        $criteria->with = 'company.tokenKey.tokenCustomer';
        
        $criteria->addCondition("order.active=1");
        $criteria->addCondition("tokenCustomer.id={$customer->id}");;
        $automatedOrders = Order::model()->findAll($criteria);
        
        $controller->render('orders',array(
            'automatedOrders'=>$automatedOrders,
        ));
    }
}
?>