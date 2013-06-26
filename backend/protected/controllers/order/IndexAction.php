<?php
class IndexAction extends CAction
{
    /**
     * Lists all models.
     */
    public function run()
    {
        $controller=$this->getController();
    
        $dataProvider=new CActiveDataProvider('Order');
        $controller->render('index',array(
                'dataProvider'=>$dataProvider,
        ));
    }
}
?>