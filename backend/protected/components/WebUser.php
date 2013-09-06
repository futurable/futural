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
 
  // This is a function that checks the field 'role'
  // in the User model to be equal to 1, that means it's admin
  // access it by Yii::app()->user->isAdmin()
    function isAdmin(){
        $user = $this->loadUser(Yii::app()->user->id);
        return intval($user->role) == 1;
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