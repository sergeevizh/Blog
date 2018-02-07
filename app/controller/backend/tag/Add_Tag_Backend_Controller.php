<?php
/**
 * Класс Add_Tag_Backend_Controller формирует страницу с формой для
 * добавления нового тега, получает данные от модели Tag_Backend_Model
 */
class Add_Tag_Backend_Controller extends Tag_Backend_Controller {

    public function __construct($params = null) {
        parent::__construct($params);
    }

    /**
     * Функция получает от модели данные, необходимые для формирования страницы
     * с формой для добавления нового тега блога
     */
    protected function input() {

        /*
         * сначала обращаемся к родительскому классу Tag_Backend_Controller,
         * чтобы установить значения переменных, которые нужны для работы всех его
         * потомков, потом переопределяем эти переменные (если необходимо) и
         * устанавливаем значения перменных, которые нужны для работы только
         * Add_Tag_Backend_Controller
         */
        parent::input();

        // если данные формы были отправлены
        if ($this->isPostMethod()) {
            if (!$this->validateForm()) { // если при заполнении формы были допущены ошибки
                $this->redirect($this->tagBackendModel->getURL('backend/tag/add'));
            } else {
                $this->redirect($this->tagBackendModel->getURL('backend/tag/index'));
            }
        }

        $this->title = 'Новый тег. ' . $this->title;

        // формируем хлебные крошки
        $breadcrumbs = array(
            array('url' => $this->tagBackendModel->getURL('backend/index/index'), 'name' => 'Главная'),
            array('url' => $this->tagBackendModel->getURL('backend/tag/index'), 'name' => 'Теги'),
        );

        /*
         * массив переменных, которые будут переданы в шаблон center.php
         */
        $this->centerVars = array(
            // хлебные крошки
            'breadcrumbs' => $breadcrumbs,
            // атрибут action тега form
            'action' => $this->tagBackendModel->getURL('backend/tag/add'),
        );
        // если были ошибки при заполнении формы, передаем в шаблон массив сообщений об ошибках
        if ($this->issetSessionData('addTagForm')) {
            $this->centerVars['savedFormData'] = $this->getSessionData('addTagForm');
            $this->centerVars['errorMessage'] = $this->centerVars['savedFormData']['errorMessage'];
            unset($this->centerVars['savedFormData']['errorMessage']);
            $this->unsetSessionData('addTagForm');
        }

    }

    /**
     * Функция проверяет корректность введенных пользователем данных; если были допущены ошибки,
     * функция возвращает false; если ошибок нет, функция добавляет новый тег и возвращает true
     */
    private function validateForm() {

        /*
         * обрабатываем данные, полученные из формы
         */
        $data['name'] = trim(iconv_substr($_POST['name'], 0, 100)); // название тега

        // были допущены ошибки при заполнении формы?
        if (empty($data['name'])) {
            $errorMessage[] = 'Не заполнено обязательное поле «Название тега»';
        }

        /*
         * были допущены ошибки при заполнении формы, сохраняем введенные
         * пользователем данные, чтобы после редиректа снова показать форму,
         * заполненную введенными ранее данными и сообщением об ошибке
         */
        if ( ! empty($errorMessage)) {
            $data['errorMessage'] = $errorMessage;
            $this->setSessionData('addTagForm', $data);
            return false;
        }

        // обращаемся к модели для добавления нового тега
        $this->tagBackendModel->addTag($data);

        return true;

    }

}
