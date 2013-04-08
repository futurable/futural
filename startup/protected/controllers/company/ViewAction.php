<?php
class ViewAction extends CAction
{
    
    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function run($id)
    {
            $controller=$this->getController();

            $controller->render('view',array(
                'model'=>$controller->loadModel($id),
            ));
    }
}
?>
