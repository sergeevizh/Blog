<?php
/**
 * Класс Feedback_Frontend_Model для показа формы обратной связи,
 * общедоступная часть сайта
 */
class Feedback_Frontend_Model extends Frontend_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Отправляет сообщение на e-mail администратора сайта
     */
    public function sendMessage($data) {

        $subject = '=?utf-8?b?' . base64_encode('Заполнена форма обратной свзяи').'?=';
        $headers = 'From: =?utf-8?b?' . base64_encode($this->config->site->name) . '?= <' . $this->config->site->email . '>' . "\r\n";
        $headers = $headers . 'Date: ' . date('r') . "\r\n";
        $headers = $headers . 'Content-type: text/plain; charset="utf-8"' . "\r\n";
        $headers = $headers . 'Content-Transfer-Encoding: base64';

        $message = 'Автор: ' . $data['name'] . "\r\n\r\n";
        $mesasage = $message . 'E-mail: ' . $data['email'] . "\r\n\r\n";
        $mesasage = $message . 'Сообщение: ' . "\r\n" . $data['message'];

        $message = chunk_split(base64_encode($message));

        if (mail($this->config->admin->email, $subject, $message, $headers)) {
            return true;
        }
        
        return false;
    }

}
