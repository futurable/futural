<?php
class ListAction extends CAction
{
    public function run()
    {
        $controller=$this->getController();
        $model = null;
        
        $controller->render('list',array(
            'model'=>$model,
        ));
    }
}
?>