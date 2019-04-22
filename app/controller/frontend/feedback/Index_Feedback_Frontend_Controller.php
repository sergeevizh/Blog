<?php
/**
 * Класс Index_Feedback_Frontend_Controller фомирует форму обратной связи
 * общедоступной части сайта
 */
class Index_Feedback_Frontend_Controller extends Index_Frontend_Controller {

    public function __construct($params = null) {
        parent::__construct($params);
    }

    /**
     * Функция получает от модели данные, необходимые для формирования
     * формы обратной связи
     */
    protected function input() {

        /*
         * сначала обращаемся к родительскому классу FeedbackFrontend_Controller,
         * чтобы установить значения переменных, которые нужны для работы всех
         * его потомков, потом переопределяем эти переменные (если необходимо) и
         * устанавливаем значения перменных, которые нужны для работы только
         * Index_Feedback_Frontend_Controller
         */
        parent::input();

        // если данные формы были отправлены
        if ($this->isPostMethod()) {
            $this->validateForm();
            $this->redirect($this->feedbackFrontendModel->getURL('frontend/feedback/index'));
        }

        $this->title = 'Обратная связь. ' . $this->title;

        // формируем хлебные крошки
        $breadcrumbs = array(
            array(
                'name' => 'Главная',
                'url' => $this->feedbackFrontendModel->getURL('frontend/index/index')
            ),
        );

        /*
         * переменные, которые будут переданы в шаблон center.php
         */
        $this->centerVars = array(
            'breadcrumbs' => $breadcrumbs,
            'action' => $this->feedbackFrontendModel->getURL('frontend/feedback/index'),
        );

        // если были ошибки при заполнении формы, передаем в шаблон массив сообщений об ошибках
        if ($this->issetSessionData('feedback')) {
            $this->centerVars['savedFormData'] = $this->getSessionData('feedback');
            $this->centerVars['errorMessage'] = $this->centerVars['savedFormData']['errorMessage'];
            unset($this->centerVars['savedFormData']['errorMessage']);
            $this->unsetSessionData('feedback');
        }
        
        // данные формы успешно отправлены
        if ($this->issetSessionData('success')) {
            $this->centerVars['success'] = true;
            $this->unsetSessionData('success');
        }

    }

    /**
     * Функция проверяет корректность введенных пользователем данных; если были допущены ошибки,
     * функция возвращает false; если ошибок нет, функция добавляет свежую статью и возвращает true
     */
    private function validateForm() {

        /*
         * обрабатываем данные, полученные из формы
         */
        $data['name']    = trim(iconv_substr(strip_tags($_POST['name']), 0, 50)); // имя пользователя
        $data['email']   = trim(iconv_substr(strip_tags($_POST['email']), 0, 50)); // e-mail пользователя
        $data['message'] = trim(iconv_substr(strip_tags($_POST['message']), 0, 1000)); // текст сообщения

        // были допущены ошибки при заполнении формы?
        if (empty($data['name'])) {
            $errorMessage[] = 'Не заполнено обязательное поле «Имя»';
        }
        if (empty($data['email'])) {
            $errorMessage[] = 'Не заполнено обязательное поле «E-mail»';
        }
        if (empty($data['message'])) {
            $errorMessage[] = 'Не заполнено обязательное поле «Сообщение»';
        }

        /*
         * были допущены ошибки при заполнении формы, сохраняем введенные
         * пользователем данные, чтобы после редиректа снова показать форму,
         * заполненную введенными ранее даннными и сообщением об ошибке
         */
        if ( ! empty($errorMessage)) {
            $data['errorMessage'] = $errorMessage;
            $this->setSessionData('feedback', $data);
            return false;
        }

        /*
         * Отправляем письмо
         */
        $result = $this->feedbackFrontendModel->sendMessage($data);

        if ( ! $result) {
            $data['errorMessage'] = array('Произошла ошибка при отправке сообщения, попробуйте еще раз');
            $this->setSessionData('feedback', $data);
            return false;
        }

        $this->setSessionData('success', true);
        return true;

    }

}
