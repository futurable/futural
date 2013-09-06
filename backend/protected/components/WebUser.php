<?php
class WebUser extends CWebUser {
 
    // Store model to not repeat query.
    private $_model;
 
    // Return email.
    // access it by Yii::app()->user->email
    function getEmail(){
        $user = $this->loadUser(Yii::app()->user->id);
        return $user->email;
    }
    
    // Return token customer
    function getTokenCustomer(){
        $user = $this->loadUser(Yii::app()->user->id);
        return $user->token_customer;
    }
 
    // Return user role
    function getRole(){
        $user = $this->loadUser(Yii::app()->user->id);
        return intval($user->role);
    }
 
  // Load user model.
    protected function loadUser($id=null){
        if($this->_model===null){
            if($id!==null)
                $this->_model=User::model()->findByPk($id);
        }
        return $this->_model;
    }
}
?>