<?php
class App_View_Helper_FlashMessages extends Zend_View_Helper_Abstract {

    public static function flashMessages() {
        $messages = Zend_Controller_Action_HelperBroker::getStaticHelper('FlashMessenger') -> getMessages();
        $output = '';

        if (!empty($messages)) {
            foreach ($messages as $message) {
                $output .= '<div class="alert alert-' . key($message) . '">';
                $output .= '<a type="button" class="close" data-dismiss="alert">&times;</a>';
                $output .= current($message);
                $output .= '</div>';
            }
        }
        return $output;
    }
}